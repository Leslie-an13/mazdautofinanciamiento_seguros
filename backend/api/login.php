<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../config/database.php';

file_put_contents('debug.log', file_get_contents('php://input'));

$data = json_decode(file_get_contents("php://input"), true);

$user = $data['user'] ?? '';
$pass = $data['pass'] ?? '';

/*echo json_encode([
    'debug_input' => $data,
    'user' => $user,
    'clave' => $pass
]);
exit;*/

if (empty($user) || empty($pass)) {
    echo json_encode([
        'success' => false,
        'message' => 'Correo y contraseña requeridos'
    ]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM add_users WHERE username = :user AND clave = :pass");
$stmt->execute([
    ':user' => $user,
    ':pass' => $pass
]);


$result = $stmt->fetch(PDO::FETCH_ASSOC);

if($result){
    echo json_encode([
        'success' => true,
        'message' => 'Inicio de sesión correcto',
    ]);

} else {

    echo json_encode([
        'success' => false,
        'message' => 'Credenciales inválidas'
    ]);
}

?>