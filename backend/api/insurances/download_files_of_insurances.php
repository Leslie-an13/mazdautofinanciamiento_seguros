<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

$month = (int) date('n'); 
$year = date('Y');     

    $stmt = $pdo->prepare("SELECT * FROM insurance_data 
                       WHERE file_path <> ''
                       AND report_month = ? 
                       AND report_year = ?");

    $stmt->execute([$month, $year]);
    
    $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($files){
        $response = [
                'success' => true,
                'message' => 'Los datos se procesaron correctamente',
                'files' => $files
            ];
            
            echo json_encode($response);
    } else {
        $response = [
                'success' => false,
                'message' => 'Los datos no se procesaron correctamente',
            ];
            
            echo json_encode($response);
    }


?>