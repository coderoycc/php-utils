<?php
// hacer una peticion con GET desde un PHP a otro PHP
$url = 'http://'.$_SERVER['SERVER_NAME'].'/contabilidad/Comprobantes/services/obtener_numero_comprobante.php?fecha='.urlencode($fecha).'&tipo=EGRESO';
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$resultado = curl_exec($curl);
print_r($resultado);

?>
