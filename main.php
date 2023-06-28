<?php
require_once './PHPExcel/Classes/PHPExcel.php';
require_once './controllers/conexion.php';

$stmt = sqlsrv_query($con, "SELECT * FROM tblAsientos;");
$resultado = sqlsrv_fetch_array($stmt);
var_dump($resultado);
$mostrar = '';

$archivo = "Compras.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

$variableB = '4293708019';
$variableD = '10193F3CD4741A';
$variableE = 166;



for ($row = 1; $row <= $highestRow; $row++) {
  $valorB = $sheet->getCell('B'.$row)->getValue();
  $valorD = $sheet->getCell('D'.$row)->getValue();
  $valorE = $sheet->getCell('E'.$row)->getValue();

  // Verificar si las columnas B, D y E coinciden con las variables
  if ($valorB == $variableB && $valorD == $variableD && $valorE == $variableE) {
    $fila = [];
    $highestColumn = $sheet->getHighestColumn();
    for ($col = 'A'; $col <= $highestColumn; $col++) {
      $cell = $sheet->getCell($col.$row);
      $valorCelda = $cell->getValue();
      $fila[$col] = $valorCelda;
    }
    $resultados[] = $fila;
  }
}

// Imprimir los resultados
foreach ($resultados as $registro) {
  foreach ($registro as $columna => $valor) {
      echo "Columna: ".$columna.", Valor: ".$valor."<br>";
  }
  echo "--------------------<br>";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Principal</title>
</head>
<body>
  <h1>Principal</h1>
  <div>
    <p><?php echo $mostrar ?></p>
  </div>

  <form id="uploadForm" enctype="multipart/form-data">
    <label for="excelFile">Subir archivo</label>
    <input id="excelFile" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
    <button type="button" onclick="enviar()">Enviar</button>
  </form>


  <script>
    function enviar(){
      var inputFile = document.getElementById("excelFile").files[0];
      var formData = new FormData();
      formData.append("excelFile", inputFile);

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "./principal.php", true);

      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Éxito: archivo enviado correctamente
            console.log(xhr.responseText);
          } else {
            // Error al enviar el archivo
            console.error("Error al enviar el archivo.");
          }
        }
      };

      xhr.send(formData);
    }
  </script>
</body>
</html>