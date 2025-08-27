<?php
if (isset($_GET['file'])) {

    //Descarga asegura

    $insurance = strtolower($_GET['insurance']);// Lo convierte en minuscula en php
    $monthYear = $_GET['month']; 
    $file = $_GET['file'];

    $path = __DIR__ . "/uploads/insurers/$insurance/$monthYear/$file";

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Content-Length: ' . filesize($path));
    readfile($path);
    exit;
} else {
    http_response_code(404);
    echo "Archivo no encontrado: $path";
}
