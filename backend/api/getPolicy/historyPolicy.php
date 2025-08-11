<?php

session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');


require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

$stmt = $pdo->prepare("SELECT * FROM damage_policy_history");
        $stmt->execute();

$arrayDamePolicy = [];

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $arrayDamePolicy[] = $result;
}

if($arrayDamePolicy){

    echo json_encode([
        'success' => true,
        'message' => 'Se proceso la informacion',
        'history' => $arrayDamePolicy
    ]);
} else{
     echo json_encode([
        'success' => false,
        'message' => 'Error no se pudo procesar la informacion',
    ]);
}


?>