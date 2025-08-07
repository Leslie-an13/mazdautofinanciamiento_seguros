<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';

$func = $_POST['func'];

if($func == 'editInformationUser'){

    try{

        $user = $_POST['user'];
        $paternal = $_POST['paternal'];
        $maternal = $_POST['maternal'];
        $names = $_POST['names'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $pass = $_POST['pass'];
        $userId = $_POST['userId'];

        $fields = [];
        $params = [];

        if(!empty($user)){
            $fields[] = "username = ?";
            $params[] = $user;
        }

        if(!empty($names)){
            $fields[] = "names = ?";
            $params[] = $names;
        }

        if(!empty($paternal)){
            $fields[] = "paternal_last_name = ?";
            $params[] = $paternal;
        }

        if(!empty($maternal)){
            $fields[] = "maternal_last_name = ?";
            $params[] = $maternal;
        }

        if(!empty($email)){
            $fields[] = "email = ?";
            $params[] = $email;
        }

        if(!empty($pass)){
            $fields[] = "clave = ?";
            $params[] = password_hash($pass, PASSWORD_DEFAULT);
        }

        if(!empty($role) && $role != "Selecciona..."){
            $fields[] = "role = ?";
            $params[] = $role;
        }

        $fields[] = "update_date_user = ?";
        $params[] = date('Y-m-d H:i:s');

        $fields[] = "edit_user = ?";
        $params[] = $_SESSION['user_id'];

        $params[] = $userId;

        $sql = "UPDATE add_users SET " . implode(', ', $fields) . " WHERE idUser = ?";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute($params);

        if($success){
            echo json_encode([
                'success' => true,
                'message' => 'Usuario actualizado correctamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar el usuario.'
            ]);
        }


    } catch(PDOException $e){
        http_response_code(500); 
        echo json_encode([
            'success' => false,
            'message' => 'Error en la base de datos',
            'error' => $e->getMessage() // Solo para debug, quítalo en producción
        ]);
    }


}


?>