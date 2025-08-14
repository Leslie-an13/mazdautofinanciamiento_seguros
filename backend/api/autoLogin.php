<?php
session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');


$clave_secret = "@fmZdS3gUro#2o25";
$id_user = $_GET['id'] ?? null;
$firm_re = $_GET['firma'] ?? null;

if($id_user && $firm){
    $firm_calculada = hash_hmac('sha256', $id_user, $clave_secret);
    
    if(hash_equals($firm_calculada, $firm_re)){
        $_SESSION['id_usuario'] = $id_user;
        header("Location: /dashboard");
        exit;
    }
}

header("Location: /login");
exit;

?>