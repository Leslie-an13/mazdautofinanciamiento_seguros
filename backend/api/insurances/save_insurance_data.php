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

if ($func == 'insertInsurancePaths') {
  
    $userId = $_SESSION['user_id'] ?? 0; 

    $baseDir = '../uploads/';
    $folderName = 'insurers/';
    $targetBase = $baseDir . $folderName;

    // Crear carpeta base si no existe
    if (!file_exists($targetBase)) {
        mkdir($targetBase, 0755, true);
    }

    if (isset($_FILES['file'])) {
        $fileName = basename($_FILES['file']['name']); 

        $prefix = strtolower(strtok($fileName, '_'));

        $parts = explode('_', $fileName); 
        $reportMonth = intval($parts[1] ?? date('m'));
        $reportYear  = intval(pathinfo($parts[2] ?? date('Y'), PATHINFO_FILENAME));
        $monthYear   = $reportMonth . "_" . $reportYear;

        switch ($prefix) {
            case 'thona':
            case 'qualitas':
            case 'hdi':
            case 'gnp':
              
                $insurerDir = $targetBase . $prefix . '/';
                if (!file_exists($insurerDir)) {
                    mkdir($insurerDir, 0755, true);
                }

                $monthDir = $insurerDir . $monthYear . '/';
                if (!file_exists($monthDir)) {
                    mkdir($monthDir, 0755, true);
                }

                $targetFile = $monthDir . $fileName;

                // Evitar duplicados (mismo aseguradora + mes + año)
                $sqlCheck = "SELECT COUNT(*) FROM insurance_data 
                             WHERE insurance_name = :insurance_name 
                               AND report_month = :report_month 
                               AND report_year = :report_year";
                $stmtCheck = $pdo->prepare($sqlCheck);
                $stmtCheck->execute([
                    ':insurance_name' => ucfirst($prefix),
                    ':report_month'   => $reportMonth,
                    ':report_year'    => $reportYear
                ]);
                $exists = $stmtCheck->fetchColumn();

                if ($exists > 0) {
                    $response = [
                        'success' => true,
                        'message' => "Ya existe un archivo para $prefix en $monthYear."
                    ];
        
                    echo json_encode($response);

                    exit;
                }

                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
              
                    $sql = "INSERT INTO insurance_data 
                                (insurance_name, file_path, report_month, report_year, user_id, created_at) 
                            VALUES 
                                (:insurance_name, :file_path, :report_month, :report_year, :user_id, :created_at)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':insurance_name' => ucfirst($prefix),
                        ':file_path'      => $targetFile,
                        ':report_month'   => $reportMonth,
                        ':report_year'    => $reportYear,
                        ':user_id'        => $userId,
                        ':created_at'     => date('Y-m-d H:i:s')
                    ]);

                    $response = [
                        'success' => true,
                        'message' => 'Archivo guardado correctamente'
                    ];
        
                    echo json_encode($response);

                    
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Archivo no guardado'
                    ];
        
                    echo json_encode($response);
                }
                break;

            default:

                $response = [
                        'success' => false,
                        'message' => 'Aseguradora no reconocida'
                    ];
        
        }
    }
}
  



?>