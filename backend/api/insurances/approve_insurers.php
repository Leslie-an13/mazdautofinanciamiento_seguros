<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

$func = $_POST['func'];

if ($func == 'ApprovalInsurer') {
  
    $insurer = $_POST['insurer'];

    $stmt = $pdo->prepare("SELECT idUser, names , paternal_last_name, maternal_last_name FROM add_users WHERE idUser = :idUser");
            $stmt->execute([
                ':idUser' => $_SESSION['user_id'],
            ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result){

        $nombreCompleto = $result['names'] . ' ' . $result['paternal_last_name'] . ' ' . $result['maternal_last_name'];
        $month =  date('m');
        $year = date('Y');

        $stmt_insert = $pdo->prepare("INSERT INTO insurance_files_approval (insurance_name, user_id, approval_status, comments, created_month, created_year)
            VALUES(?,?,?,?,?,?)");
        
        $stmt_insert->execute([
                    $insurer,
                    $_SESSION['user_id'],
                    1,
                    'El usuario ' . $nombreCompleto . ' aprobo el archivo el ' . $insurer . ' ' . date('Y-m-d H:i:s'),
                    $month,
                    $year 
                ]);

        echo json_encode([
                'success' => true,
                'message' => 'Datos aprobados correctamente' . ' ' .$insurer,
        ]);


    } else {
         echo json_encode([
                'success' => false,
                'message' => 'No se insertaron los datos.',
        ]);
    }

} else {
     echo json_encode([
        'success' => false,
        'message' => 'Informacion invalida',
    ]);
}
  



?>