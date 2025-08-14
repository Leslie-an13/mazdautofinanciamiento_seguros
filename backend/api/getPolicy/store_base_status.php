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

$status_file = $_POST['textPolicy'];


    $stmt = $pdo->prepare("SELECT idUser, names, paternal_last_name, maternal_last_name FROM add_users WHERE idUser = :idUser");
    $stmt->execute([
        ':idUser' => $_SESSION['user_id'],
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $stmt_insert = $pdo->prepare("
            INSERT INTO damage_policy_history 
            (user_id, base_file_approved, invoice_approved, base_approval_status,invoice_approval_status,date_create_at) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $nombreCompleto = $result['names'] . ' ' . $result['paternal_last_name'] . ' ' . $result['maternal_last_name'];

        $stmt_insert->execute([
            $result['idUser'],
            'El usuario ' . $nombreCompleto . ' ha aprobado la base aon ' . date('Y-m-d H:i:s'),
            '',
            $status_file,
            '',
            date('Y-m-d H:i:s')
        ]);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Datos guardados correctamente.',
    ]);
 
?>
