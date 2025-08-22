<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

$year = date('Y');
$month = date('m');
$status = "Aprobar base";

    $stmt = $pdo->prepare("SELECT * FROM claims_approval_history WHERE YEAR(date_create_at) = ?
        AND MONTH(date_create_at) = ? AND base_approval_status = ? ");
        
    $stmt->execute([$year, $month, $status]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result){

        $stmt_file = $pdo->prepare("SELECT claims_path FROM claims_database WHERE YEAR(created_at) = ?
            AND MONTH(created_at) = ? ");

        $stmt_file->execute([$year, $month]);

        $result_file = $stmt_file->fetch(PDO::FETCH_ASSOC);

        if($result_file){
                echo json_encode([
                'success' => true,
                'message' => 'Se proceso la informacion',
                'route' => $result_file['claims_path']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error no se pudo procesar la informacion',
            ]);
        }


    }

?>