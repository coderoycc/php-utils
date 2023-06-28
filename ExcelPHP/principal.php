<?php
require_once './PHPExcel/Classes/PHPExcel.php';
include('./controllers/procesarArchivo.php');

$manejador = new ExcelController();

$manejador->readExcel();

$resp = $manejador->searchExcel();
echo $resp;
?>