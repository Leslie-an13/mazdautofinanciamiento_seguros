<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

    $stmt_consult = $pdo->prepare("SELECT * FROM insurance_files_approval WHERE created_month > 0 AND created_year > 0");
    $stmt_consult->execute();
    $arrayInfo = [];

    while($result = $stmt_consult->fetch(PDO::FETCH_ASSOC)){
        $arrayInfo[] = $result;  
    }
    

    if(count($arrayInfo) > 0){

        $response = [
            'success' => true,
            'message' => 'Los datos se procesaron correctamente',
            'history' => $arrayInfo
        ];
        
        echo json_encode($response);
    } else {

        $response = [
            'success' => false,
            'message' => 'No se procesaron datos',
        ];
        
        echo json_encode($response);
    }


?>