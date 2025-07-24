<?php

$host = 'localhost';
$dbname = 'dash_seguros';
$user = 'root';
$pass = '';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa a la base de datos.";

} catch(PDOException $e){
    die(json_decode([
        'success' => false,
        'message' => 'Error de conexion'. $e->getMessage()
    ]));
}

?>
