<?php

session_start();
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../../config/database.php';

$data = json_decode(file_get_contents("php://input"), true);

echo $_SESSION['user_id'];
echo "holis";

?>
