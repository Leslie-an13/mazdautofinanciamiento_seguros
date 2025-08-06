<?php
if (isset($_GET['file'])) {

    $file = basename($_GET['file']);
    $path = __DIR__ . "/uploads/base_aon/" . $file;

    if (file_exists($path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($path).'"');
        header('Content-Length: ' . filesize($path));
        flush();
        readfile($path);
        exit;
    } else {
        http_response_code(404);
        echo "Archivo no encontrado.";
    }
} else {
    http_response_code(400);
    echo "No se especificó archivo.";
}
