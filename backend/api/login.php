<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../config/database.php';
$conexion = new conexionPDO();
$pdo = $conexion->getConexion();

//file_put_contents('debug.log', file_get_contents('php://input'));

$data = json_decode(file_get_contents("php://input"), true);

$user = $data['user'] ?? '';
$pass = $data['pass'] ?? '';

if (empty($user) || empty($pass)) {
    echo json_encode([
        'success' => false,
        'message' => 'Correo y contraseña requeridos'
    ]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM add_users WHERE username = :user");
$stmt->execute([':user' => $user]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if($result && password_verify($pass, $result['clave'])){

    $_SESSION['user_id'] = $result['idUser'];
    $_SESSION['username'] = $result['names'] . ' '. $result['paternal_last_name'] . ' ' .$result['maternal_last_name'] ;
    $_SESSION['role'] = $result['role'];
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