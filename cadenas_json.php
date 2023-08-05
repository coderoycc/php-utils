// Eliminar texto antes de la primera llave
$cadena_limpia = preg_replace('/^[^{]+/', '', $row['respuesta']);

// DECODIFICAR TEXTO A JSON VERIFICANDO ERRORES
$data = json_decode($cadena_limpia, true);
      
if (json_last_error() === JSON_ERROR_NONE) {
  // El JSON se decodificó correctamente
  print_r($data);
  echo '<br>-------------------------------------<br>';
} else {
  // Error al decodificar el JSON
  echo '<br>******************Error al decodificar el JSON
  <br>******************caddena: '.$cadena_limpia.'<br>';
}
