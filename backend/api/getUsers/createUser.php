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

if($func == 'createUserNew'){

    try{

        $valueUser = $_POST['valueUser'];
        $valuePaternal = $_POST['valuePaternal'];
        $valueEmail = $_POST['valueEmail'];
        $valueNames = $_POST['valueNames'];
        $valueMaternal = $_POST['valueMaternal'];
        $roleValue = $_POST['roleValue'];
        $valuePassword = $_POST['valuePassword'];

        $hashedPassword = password_hash($valuePassword, PASSWORD_DEFAULT);


        $stmt_insert = $pdo->prepare("
                INSERT INTO add_users 
                (username, clave, names, paternal_last_name, maternal_last_name, email, date_create, createdByUserId, role, update_date_user, edit_user)
                VALUES (?,?,?,?,?,?,?,?,?,?,?)");

        $success = $stmt_insert->execute([
                $valueUser,
                $hashedPassword,
                $valueNames,
                $valuePaternal,
                $valueMaternal,
                $valueEmail,
                date('Y-m-d H:i:s'),
                $_SESSION['user_id'],
                $roleValue,
                '',
                ''
            ]);


        if($success){
            echo json_encode([
                'success' => true,
                'message' => 'Usuario creado correctamente',
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'El usuario no se ha podido crear',
            ]);
        }
    } catch (PDOException $e) {
        http_response_code(500); 
        echo json_encode([
            'success' => false,
            'message' => 'Error en la base de datos',
            'error' => $e->getMessage() // Solo para debug, quítalo en producción
        ]);
    }
}

?>