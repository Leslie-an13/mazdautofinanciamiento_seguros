<?php
if (isset($_GET['file'])) {

    ##Se descarga archivo del pago de poliza por parte de tesoreria
    $file = basename($_GET['file']);
    $monthYear = date('m_Y');
    $path = __DIR__ . "/../uploads/payment_policy/$monthYear/" . $file;

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