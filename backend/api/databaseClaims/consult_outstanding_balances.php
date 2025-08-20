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
$status = "Aprobar base de saldo";

    $stmt = $pdo->prepare("SELECT * FROM claims_approval_history WHERE YEAR(created_at_balances) = ?
        AND MONTH(created_at_balances) = ? AND outstanding_balances_approval_status = ? ");
        
    $stmt->execute([$year, $month, $status]);

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