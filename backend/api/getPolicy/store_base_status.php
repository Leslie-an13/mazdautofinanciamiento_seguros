<?php

session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

$data = json_decode(file_get_contents("php://input"), true);

$status_file = $_POST['textPolicy'] ?? null;
$status_payment = $_POST['status_payment'] ?? null;

$year = date('Y');
$month = date('m'); 

$stmt_check = $pdo->prepare("SELECT * FROM damage_policy_history WHERE base_file_approved <> ''
                AND YEAR(date_create_at) = ? AND MONTH(date_create_at) = ?");
    
    $stmt_check->execute([$year,$month]);
    $result_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if($result_check){

        $stmt_user = $pdo->prepare("SELECT idUser, names, paternal_last_name, maternal_last_name FROM add_users WHERE idUser = :idUser");
        $stmt_user->execute([
            ':idUser' => $_SESSION['user_id'],
        ]);

        $result_user = $stmt_user->fetch(PDO::FETCH_ASSOC);

        $nombreCompleto_user = $result_user['names'] . ' ' . $result_user['paternal_last_name'] . ' ' . $result_user['maternal_last_name'];

        $stmt_update = $pdo->prepare("UPDATE damage_policy_history SET invoice_approved = ?, 
            invoice_approval_status = ?, create_at_payment = ? WHERE YEAR(date_create_at) = ? AND MONTH(date_create_at) = ? ");

        $stmt_update->execute([
            'El usuario ' . $nombreCompleto_user . ' ha aprobado la factura ' . date('Y-m-d H:i:s'),
            $status_payment,
            date('Y-m-d H:i:s'),
            $year,
            $month
        ]);

        echo json_encode([
                'success' => true,
                'message' => 'Datos actualizados correctamente.',
        ]);


        
    } else {
        $stmt = $pdo->prepare("SELECT idUser, names, paternal_last_name, maternal_last_name FROM add_users WHERE idUser = :idUser");
        $stmt->execute([
            ':idUser' => $_SESSION['user_id'],
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            $stmt_insert = $pdo->prepare("
                INSERT INTO damage_policy_history 
                (user_id, base_file_approved, invoice_approved, base_approval_status,invoice_approval_status,date_create_at, create_at_payment) 
                VALUES (?, ?, ?, ?, ?, ?, ?)");

            $nombreCompleto = $result['names'] . ' ' . $result['paternal_last_name'] . ' ' . $result['maternal_last_name'];

            $stmt_insert->execute([
                    $result['idUser'],
                    'El usuario ' . $nombreCompleto . ' ha aprobado la base aon ' . date('Y-m-d H:i:s'),
                    '',
                    $status_file,
                    '',
                    date('Y-m-d H:i:s'),
                    ''
                ]);
        }

            echo json_encode([
                'success' => true,
                'message' => 'Datos guardados correctamente.',
            ]);
    }
  
 
?>
