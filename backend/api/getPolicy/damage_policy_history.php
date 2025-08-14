<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

##Se consulta si la base fue aprobada para que pase al siguiente proceso

$func = $_POST['func'];
if ($func === 'consultStatusBase') {

    $year = date('Y');
    $month = date('m');
    $status = "Aprobar base";

    $stmt_consult= $pdo->prepare("SELECT * FROM damage_policy_history WHERE base_approval_status = ?
            AND YEAR(date_create_at) = ? AND MONTH(date_create_at) = ? ");

        
        $stmt_consult->execute([$status, $year, $month]);
        $result_consult = $stmt_consult->fetch(PDO::FETCH_ASSOC);

        if($result_consult){

            $response = [
                "success" => true,
                "message" => "El archivo ha sido aprobado"
            ];

        } else {

            $response = [
                "success" => false,
                "message" => "El archivo no ha sido aprobado"
            ];
        }
}

echo json_encode($response);
exit;


?>