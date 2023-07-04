<?php
// Peticion desde PHP a otro PHP tipo POST
$url = 'http://'.$_SERVER['SERVER_NAME'].'/contabilidad/php/services/prueba.php';
$datos = ['fecha' => $fecha, "tipo" => "EGRESO"];
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($datos));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$resultado = curl_exec($curl);
if($resultado === false){
  $response['message'] = '[OK]: Fallido: PETICION '.curl_error($curl);
}else{
  // Procesar resultado
  print_r($resultado);
}


?>
