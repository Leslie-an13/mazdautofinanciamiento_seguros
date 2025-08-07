<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($_FILES['filePayment']) && isset($_POST['status'])) {
    
    $status_file = $_POST['status'];
    $baseDir = '../uploads/';
    $folderName = 'payment_policy/';

    $monthYear = date('m_Y');
    $targetDir = $baseDir . $folderName . $monthYear . '/';


    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $archivo = $_FILES['filePayment'];
    $targetFile = $targetDir . basename($archivo['name']);

    if (move_uploaded_file($archivo['tmp_name'], $targetFile)) {
           $stmt = $pdo->prepare("SELECT idUser, name, paternal_last_name, maternal_last_name FROM add_users WHERE idUser = :idUser");
        $stmt->execute([
            ':idUser' => $_SESSION['user_id'],
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $stmt_insert = $pdo->prepare("
                INSERT INTO payment_proof_history 
                (user_id, proof_upload_date, user_approval_date, base_proof_path, status_upload_file, payment_file_created) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");

            $nombreCompleto = $result['name'] . ' ' . $result['paternal_last_name'] . ' ' . $result['maternal_last_name'];

            $stmt_insert->execute([
                $result['idUser'],
                'El usuario ' . $nombreCompleto . ' ha cargado el archivo el ' . date('Y-m-d H:i:s'),
                'El usuario ' . $nombreCompleto . ' aprobo el archivo el ' . date('Y-m-d H:i:s'),
                $targetFile,
                $status_file,
                date('Y-m-d H:i:s')
            ]);

             echo json_encode([
                'success' => true,
                'message' => 'Archivo guardado exitosamente.',
                'ruta' => $targetFile
            ]);
        }
    } else {
        
        echo json_encode([
            'success' => false,
            'message' => 'Error al guardar el archivo.'
        ]);
   
    }

} else {
    echo json_encode([
        'success' => false,
        'message' => 'No se recibió archivo o texto.'
    ]);
}

?>