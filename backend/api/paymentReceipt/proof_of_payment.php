<?php
session_start();
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
//Se obtiene la ruta del pago, solo cuando la base haya sido aprobada

$stmt = $pdo->prepare("SELECT * FROM damage_policy_history WHERE base_approval_status = ?
                        AND YEAR(date_create_at) = ?
                        AND MONTH(date_create_at) = ? ");
    $stmt->execute([$status, $year, $month]);
    $file = $stmt->fetch(PDO::FETCH_ASSOC);

    if($file){

        $stmt_file = $pdo->prepare("SELECT * FROM insurance_base WHERE base_path <> ''
                    AND YEAR(created_at) = ? AND MONTH(created_at) = ?");

        $stmt_file->execute([$year,$month]);
        $result = $stmt_file->fetch(PDO::FETCH_ASSOC);

        if($result){
            $response = [
                'success' => true,
                'message' => 'Los datos se procesaron correctamente',
                'file' => $result['base_path']
            ];
            
            echo json_encode($response);
        } else {
            $response = [
                'success' => false,
                'message' => 'No existe la ruta',
            ];
            
            echo json_encode($response);
        }


       
    } else {
        $response = [
                'success' => false,
                'message' => 'Los datos no se procesaron correctamente',
            ];
            
            echo json_encode($response);
    }


?>