<?php
@session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

date_default_timezone_set('America/Mexico_City');

$func = $_POST['func'];

if($func == 'updateInfoBase'){

    $year = date('Y');
    $month = date('m');
    $select = $_POST['statusFiles'];

    $stmt_consult = $pdo->prepare("SELECT * FROM claims_approval_history WHERE YEAR(created_at_balances) = ? AND
            MONTH(created_at_balances) = ?");

    $stmt_consult->execute([$year, $month]);

    $result_consult = $stmt_consult->fetch(PDO::FETCH_ASSOC);

    if($result_consult){
        $stmt = $pdo->prepare("SELECT idUser, names, paternal_last_name, maternal_last_name FROM add_users WHERE idUser = :idUser");
        
        $stmt->execute([':idUser' => $_SESSION['user_id']]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            $stmt_update = $pdo->prepare("UPDATE claims_approval_history 
                SET approve_payments = ?, payment_status = ?, create_at_payments = ? 
                WHERE YEAR(created_at_balances) = ? AND MONTH(created_at_balances) = ?");

            $nombreCompleto = $result['names'] . ' ' . $result['paternal_last_name'] . ' ' . $result['maternal_last_name'];

            $stmt_update->execute([
                'El usuario ' . $nombreCompleto . ' ha aprobado los archivos ' . date('Y-m-d H:i:s'),
                $select,
                date('Y-m-d H:i:s'),
                $year,
                $month
            ]);

            $rowsAffected = $stmt_update->rowCount();

            if($rowsAffected > 0){
                echo json_encode([
                    'success' => true,
                    'message' => 'Se aprobaron correctamente los archivos.'
                ]);
        
            } else {
                 echo json_encode([
                    'success' => false,
                    'message' => 'No se actualizo.'
                ]);
            }

        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error no hay informacion de este mes.'
        ]);
    }

}


?>