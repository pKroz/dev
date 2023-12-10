<?php
require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

try {
    // Ruta a la plantilla de Word
    $templateProcessor = new TemplateProcessor('nombre.docx');

    // Recibir nombre y apellido por algún método, por ejemplo, POST
    $nombre = $_POST['nombre']; // Aquí deberías usar $_POST['nombre'] si esperas un POST
    $apellido = $_POST['apellido']; // Y $_POST['apellido'] para el apellido

    // Reemplazar los marcadores de posición en la plantilla
    $templateProcessor->setValue('nombre', $nombre);
    $templateProcessor->setValue('apellido', $apellido);

    // Guardar el documento resultante
    $documentPath = 'documento-final.docx';
    $templateProcessor->saveAs($documentPath);

    // Enviar el documento al navegador para la descarga
    header('Content-Disposition: attachment; filename=' . basename($documentPath));
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Length: ' . filesize($documentPath));
    header('Cache-Control: max-age=0');
    readfile($documentPath);
    exit;
} catch (Exception $e) {
    // Manejo de la excepción
    echo 'Error: ' . $e->getMessage();
}
?>