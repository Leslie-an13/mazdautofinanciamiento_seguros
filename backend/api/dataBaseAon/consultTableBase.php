<?php
@session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');


require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

$func = $_POST['func'] ?? null;
date_default_timezone_set('America/Mexico_City');

if ($func === 'consultTable') {

    $year = date('Y');
    $month = date('m');

    $stmt_consult= $pdo->prepare("SELECT base_path FROM insurance_base WHERE base_path <> '' 
            AND YEAR(created_at) = ? AND MONTH(created_at) = ? ");

        $stmt_consult->execute([$year, $month]);
        $result_consult = $stmt_consult->fetch(PDO::FETCH_ASSOC);

        if($result_consult){

            $response = [
                "success" => true,
                "message" => "Existe la base de este mes"
            ];

        } else {

            $response = [
                "success" => false,
                "message" => "No existe la base de este mes"
            ];
        }
}

echo json_encode($response);
exit;

?>