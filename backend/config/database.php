<?php

$host = 'localhost';
$dbname = 'dash_seguros';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //wecho "conexion exitosa";
} catch(PDOException $e) {
    die(json_encode([
        'success' => false,
        'message' => 'Error de conexión: ' . $e->getMessage()
    ]));
}

?>
