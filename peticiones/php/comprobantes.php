<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // obtenemos todos los campos
  $nro_comprobante = $_POST['nro_comprobante'];
  $tipo = $_POST['tipo'];
  $fecha = $_POST['fecha'];
  $tipo_cambio = $_POST['tipo_cambio'];
  $moneda = $_POST['moneda'];

  if (isset($_POST['facts'])) {
      $arrFacts = json_decode($_POST['facts'], true);
  }else{
    $arrFacts = array();
  }
  // en este caso arrFacts sera un array del tipo.
//  array(
//  "0"=>array("nit"=>"7832928",...),
//  "2"=>array(...)
//  )
  // Se puede acceder a cada objeto con
// $arrFacts[$i]

  // Procesar la parte de url que esta codificada
  $url = urldecode($arrFacts[$i]['url']);
  // Eso nos devuelve la url normal https://cocodod/dd?idsdkm=090909&sdfd=09909
}
?>
