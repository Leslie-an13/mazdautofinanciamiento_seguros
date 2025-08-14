<?php
@session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();


$year = date('Y');
$month = date('m');

    $stmt = $pdo->prepare("SELECT * FROM insurance_base WHERE YEAR(created_at) = ?
        AND MONTH(created_at) = ? ");
        
    $stmt->execute([$year, $month]);

    $arrayPayment = [];

    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $arrayPayment[] = $result;
    }

    if($arrayPayment){

        echo json_encode([
            'success' => true,
            'message' => 'Se proceso la informacion',
            'history' => $arrayPayment
        ]);
    } else{
        echo json_encode([
            'success' => false,
            'message' => 'Error no se pudo procesar la informacion',
        ]);
    }


?>