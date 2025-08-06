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


$stmt = $pdo->prepare("SELECT * FROM damage_policy_history WHERE base_file_path_aon <> ''
                        AND MONTH(date_route) = MONTH(CURDATE())
                        AND YEAR(date_route) = YEAR(CURDATE())");
       $stmt->execute();
$file = $stmt->fetch(PDO::FETCH_ASSOC);

if($file){
    $response = [
            'success' => true,
            'message' => 'Los datos se procesaron correctamente',
            'file' => $file['base_file_path_aon']
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