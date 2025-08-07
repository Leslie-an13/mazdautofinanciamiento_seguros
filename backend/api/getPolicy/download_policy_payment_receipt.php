<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';

$dateActually = date('Y-m-d');
$monthActually = date('m', strtotime($dateActually));
$yearActually = date('Y', strtotime($dateActually));


$stmt = $pdo->prepare("SELECT * FROM payment_proof_history WHERE base_proof_path <> ''
                        AND MONTH(payment_file_created) = MONTH(CURDATE())
                        AND YEAR(payment_file_created) = YEAR(CURDATE())");
    $stmt->execute();
    $file = $stmt->fetch(PDO::FETCH_ASSOC);

    if($file){
        $response = [
                'success' => true,
                'message' => 'Los datos se procesaron correctamente',
                'file' => $file['base_proof_path']
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