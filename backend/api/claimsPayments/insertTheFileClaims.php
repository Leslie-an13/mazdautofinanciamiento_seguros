<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

$func = $_POST['func'];

if($func == 'insertClaimsFiles'){

    $status_file = $_POST['status'];
    $baseDir = '../uploads/';
    $folderName = 'payment_claims/';

    $monthYear = date('m_Y');
    $targetDir = $baseDir . $folderName . $monthYear . '/';

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filesInputs = ['file1', 'file2', 'file3'];
  
    $routesFiles = [null,null,null];

    foreach($filesInputs as $index => $inputName){
        if(isset(($_FILES[$inputName])) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {

            $fileName = basename($_FILES[$inputName]['name']);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetFile)) {
                $routesFiles[$index] = $targetFile;
            }  else {
                 echo json_encode([
                    'success' => false,
                    'message' => 'Error al guardar el archivo.'
                ]);
            }

        }

    }

    $stmt = $pdo->prepare("SELECT idUser, names , paternal_last_name, maternal_last_name FROM add_users WHERE idUser = :idUser");
            $stmt->execute([
                ':idUser' => $_SESSION['user_id'],
            ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            $stmt_insert = $pdo->prepare("
                    INSERT INTO insurance_company_payment 
                    (user_id, file_upload_date, user_file_date, base1_file_path, base2_file_path, base3_file_path, status_upload_file, date_created_route) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ");

                $nombreCompleto = $result['names'] . ' ' . $result['paternal_last_name'] . ' ' . $result['maternal_last_name'];

                $texto = 'El usuario ' . $nombreCompleto . ' ha cargado el archivo de pago de la aseguradora 1 ' . date('Y-m-d H:i:s') . "\n" 
                . ' ha cargado el archivo de pago de la aseguradora 2 ' . date('Y-m-d H:i:s') . "\n" .
                ' ha cargado el archivo de pago de la aseguradora 3 ' . date('Y-m-d H:i:s');


                $stmt_insert->execute([
                    $result['idUser'],
                    $texto,
                    'El usuario ' . $nombreCompleto . ' aprobo el archivo el ' . date('Y-m-d H:i:s'),
                    $routesFiles[0],
                    $routesFiles[1],
                    $routesFiles[2],
                    $status_file,
                    date('Y-m-d H:i:s')
                ]);

                    echo json_encode([
                        'success' => true,
                        'message' => 'Archivo guardado exitosamente.',
                        'ruta' => $targetFile
                    ]);

            } else {

                 echo json_encode([
                    'success' => false,
                    'message' => 'Los archivos no se pudieron guardar correctamentes.',
                    'ruta' => $targetFile
                ]);

            }


}
  



?>