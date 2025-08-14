<?php
@session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
date_default_timezone_set('America/Mexico_City');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

$func = $_POST['func'];

if($func == 'saveDataBase'){
    if(isset($_FILES['file'])){

        $baseDir = '../uploads/';
        $folderName = 'base_aon/';

        $monthYear = date('m_Y');
        $targetDir = $baseDir . $folderName . $monthYear . '/';

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $archivo = $_FILES['file'];
        $targetFile = $targetDir . basename($archivo['name']);

        if (move_uploaded_file($archivo['tmp_name'], $targetFile)){

                $stmt = $pdo->prepare("SELECT idUser, names, paternal_last_name, maternal_last_name FROM add_users WHERE idUser = :idUser");
                $stmt->execute([
                    ':idUser' => $_SESSION['user_id'],
                ]);

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $stmt_insert = $pdo->prepare("
                        INSERT INTO insurance_base 
                        (user_id,base_path,created_at,uploaded_by_user) 
                        VALUES (?, ?, ?, ?)
                    ");

                    $nombreCompleto = $result['names'] . ' ' . $result['paternal_last_name'] . ' ' . $result['maternal_last_name'];

                    $stmt_insert->execute([
                        $result['idUser'],
                        $targetFile,
                        date('Y-m-d H:i:s'),
                        'El usuario ' . $nombreCompleto . ' ha cargado el archivo el ' . date('Y-m-d H:i:s'),
                    ]);

                    
                } 
                echo json_encode([
                    'success' => true,
                    'message' => 'Archivo guardado exitosamente.',
                ]);

        } else {
            echo json_encode([
                    'success' => false,
                    'message' => 'El archivo no ha guardado.',
           ]);
        }
       
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No se recibió archivo o texto.'
        ]);
    }
}

?>