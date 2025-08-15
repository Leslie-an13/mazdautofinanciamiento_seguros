<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

//Se muestra el comprobante de factura cuando se haya aprobado el pago por seguros
//Se visualiza la factura para AON

$year = date('Y');
$month = date('m');
$status_payment = "Aprobar pago"; 

$stmt = $pdo->prepare("SELECT * FROM damage_policy_history 
                       WHERE invoice_approval_status = ?
                       AND YEAR(create_at_payment) = ?
                       AND MONTH(create_at_payment) = ?");
$stmt->execute([$status_payment, $year, $month]);
$row_status = $stmt->fetch(PDO::FETCH_ASSOC); 

if ($row_status) {
    $stmt_file = $pdo->prepare("SELECT * FROM payment_proof_history 
                                WHERE base_proof_path <> ''
                                AND YEAR(payment_file_created) = ? 
                                AND MONTH(payment_file_created) = ?");
    $stmt_file->execute([$year, $month]);
    $result = $stmt_file->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Los datos se procesaron correctamente',
            'file' => $result['base_proof_path']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No existe la ruta',
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No existen registros',
    ]);
}

exit;


?>