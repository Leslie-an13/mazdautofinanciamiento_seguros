<?php

session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

$data = json_decode(file_get_contents("php://input"), true);

if (isset($_FILES['files']) && isset($_POST['textPolicy'])) {


    $status_file = $_POST['textPolicy'];
    $baseDir = '../uploads/';
    $folderName = 'base_aon/';

    $monthYear = date('m_Y');
    $targetDir = $baseDir . $folderName . $monthYear . '/';

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $archivo = $_FILES['files'];
    $targetFile = $targetDir . basename($archivo['name']);

    if (move_uploaded_file($archivo['tmp_name'], $targetFile)) {

        $stmt = $pdo->prepare("SELECT idUser, names, paternal_last_name, maternal_last_name FROM add_users WHERE idUser = :idUser");
        $stmt->execute([
            ':idUser' => $_SESSION['user_id'],
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $stmt_insert = $pdo->prepare("
                INSERT INTO damage_policy_history 
                (user_id, file_upload_date, user_file_date, base_file_path_aon, status_upload_file, date_route) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");

            $nombreCompleto = $result['names'] . ' ' . $result['paternal_last_name'] . ' ' . $result['maternal_last_name'];

            $stmt_insert->execute([
                $result['idUser'],
                'El usuario ' . $nombreCompleto . ' ha cargado el archivo el ' . date('Y-m-d H:i:s'),
                'El usuario ' . $nombreCompleto . ' aprobo el archivo el ' . date('Y-m-d H:i:s'),
                $targetFile,
                $status_file,
                date('Y-m-d H:i:s')
            ]);
        }

        echo json_encode([
            'success' => true,
            'message' => 'Archivo guardado exitosamente.',
            'ruta' => $targetFile
        ]);
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
