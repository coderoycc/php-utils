<?php
if (isset($_POST['pdfFile'])) {
    // Obtén el contenido del PDF en base64 enviado desde el cliente
    $base64Data = $_POST['pdfFile'];
    $pdfData = base64_decode($base64Data);         
    // Genera un nombre único para el archivo PDF
    $filename = 'pdf-'.time() . '.pdf';
    // Ruta de archivo
    $uploadPath = '../Files/' . $filename;
    
    // Guarda el archivo PDF en el servidor
    if (file_put_contents($uploadPath, $pdfData)) {
        $msgPdf = 'OK';
    } else {
        $msgPdf = 'NO OK';
    }
}
?>
