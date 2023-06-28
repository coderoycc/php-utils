<?php

class ExcelController{

  var $ruta;
  var $sheet;
  function __construct(){
    if (isset($_FILES['excelFile'])) {
      $file = $_FILES['excelFile'];
      $fileName = 'data_'.time().'_'.$file['name'];
      $fileTmpPath = $file['tmp_name'];
  
      $destination = './FilesExcel/' . $fileName;
      move_uploaded_file($fileTmpPath, $destination);
      $this->ruta = $destination;
    }else{
      $this->ruta = '-1';
    }
  }

  public function readExcel(){
    if($this->ruta != '-1'){
      $inputFileType = PHPExcel_IOFactory::identify($this->ruta);
      $objReader = PHPExcel_IOFactory::createReader($inputFileType);
      $objPHPExcel = $objReader->load($this->ruta);
      $this->sheet = $objPHPExcel->getSheet(0);
    }else{
      $this->sheet = null;
    }
  }

  public function searchExcel(){
    $arrayUpdate = $this->noEmparejados();
    $respuesta = '';
    if(count($arrayUpdate) > 0){
      if($arrayUpdate['cantidad'] == count($arrayUpdate['idsAsientos'])){
        $respuesta = 'Se actualizaron todos los asientos no emparejados: '. $arrayUpdate['cantidad'];
      }else{
        $respuesta = 'Se actualizaron '. count($arrayUpdate['idsAsientos']) .' de '. $arrayUpdate['cantidad'] .' asientos no emparejados';
      }
    }else{
      $respuesta = 'No se encontraron asientos no emparejados';
    }
    return $respuesta;
  }
  
  private function noEmparejados(){
    include './controllers/conexion.php';
    $sql = "SELECT * FROM tblAsientos WHERE emparejado LIKE 'no%';";
    $stmt = sqlsrv_query($con, $sql);
    $idsAsientos = array();
    if($stmt){
      $cantidad = 0;
      while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
        $cantidad++;
        $idFact = $row['idFactCompra'];
        $sql_fact = "SELECT * FROM tblFacturaCompra WHERE idFactCompra = $idFact;";
        $stmt_fact = sqlsrv_query($con, $sql_fact);
        if(sqlsrv_has_rows($stmt_fact) > 0){
          $factura = sqlsrv_fetch_array($stmt_fact, SQLSRV_FETCH_ASSOC);
          $arrayDatos = array();
          if($factura['facturaNueva'] == 'si'){
            $arrayDatos = $this->buscaFacturaNueva($factura['codAutorizacion']);
          }else{
            $arrayDatos = $this->buscaFacturaAntigua($factura['nitProveedor'], $factura['nroFactura'], $factura['codAutorizacion']);
          }
          
          if(count($arrayDatos) > 0){
            // actualizamos con los registros toda la factura
            $ok_update = $this->updateFactura($con, $arrayDatos, $idFact);
            if($ok_update){
              // actualizamos los asiento de la factura
              $ok_update_asientos = $this->updateAsientos($con, $row['idAsiento']);
              
              if($ok_update_asientos){
                $idsAsientos[] = $row['idAsiento'];
              }
            }
          }
        }
      }
      return array('cantidad' => $cantidad, 'idsAsientos' => $idsAsientos);
    }
    return array();
  }

  private function updateFactura($con, $datos, $idFactura){
    // Los datos es un array con llaves que son los campos de la BD y el valor es el valor de la celda a insertar
    $sql = "UPDATE tblFacturaCompra SET ";
    foreach ($datos as $key => $value) {
      $sql .= $key." = '".$value."', ";
    }
    $sql = substr($sql, 0, -2);
    $sql .= " WHERE idFactCompra = $idFactura;";
    $stmt = sqlsrv_query($con, $sql);
    return $stmt;
  }

  private function updateAsientos($con, $idAsiento){
    $sql = "UPDATE tblAsientos SET emparejado = 'si' WHERE idAsiento = $idAsiento;";
    $stmt = sqlsrv_query($con, $sql);
    return $stmt;
  }

  private function buscaFacturaAntigua($nitProveedor, $nroFactura, $codAutorizacion){
    if($this->sheet != null){
      $rows = $this->sheet->getHighestRow();
      for ($row = 1; $row <= $rows; $row++) {
        $nit = $this->sheet->getCell('B'.$row)->getValue();
        $codAut = $this->sheet->getCell('D'.$row)->getValue();
        $nroFact = $this->sheet->getCell('E'.$row)->getValue();
      
        // Verificar si las columnas B, D y E coinciden con los parametros de busqueda
        if ($nit == $nitProveedor && $codAut == $codAutorizacion && $nroFact == $nroFactura) {
          $fila = [];
          // Obtenermos las celdas definidas
          $arrayCeldas = array(
            "razonSocial" => "C",
            "fechaFactura" => "G",
            "importeTotal" => "H",
            "importeICE" => "I",
            "importeIEHD" => "J",
            "importeIPJ" => "K",
            "otroNosujetoCredFis" => "M",
            "importesExentos" => "N",
            "importesTasaCero" => "O",
            "subTotal" => "P",
            "descuento" => "Q",
            "importeGiftCard" => "R",
            "importeBaseCF" => "S",
            "creditoFiscal" => "T",
            "tipoCompra" => "U",
            "codigoControl" => "V",
            "derechoCredFiscal" => "W",
            "estadoConsolidado" => "X"
          );

          foreach ($arrayCeldas as $key => $value) {
            if($key == 'fechaFactura'){
              $fecha = $this->sheet->getCell($value.$row)->getValue();
              $valores = explode('/', $fecha);
              if(count($valores) == 3){
                $fila[$key] = $valores[2].'-'.$valores[1].'-'.$valores[0];
              }
            }else{
              $fila[$key] = $this->sheet->getCell($value.$row)->getValue();
            }
          }
          return $fila;
        }
      }
      return array();
    }
    return array();
  }

  private function buscaFacturaNueva($codAutorizacion){
    if($this->sheet != null){
      $rows = $this->sheet->getHighestRow();
      for ($row = 1; $row <= $rows; $row++) {
        $codAut = $this->sheet->getCell('D'.$row)->getValue();
      
        // Verificar si la columna D coincide con el parametro de busqueda
        if ($codAut == $codAutorizacion) {
          $fila = [];
          // Obtenermos las celdas definidas
          $arrayCeldas = array(
            "razonSocial" => "C",
            "fechaFactura" => "G",
            "importeTotal" => "H",
            "importeICE" => "I",
            "importeIEHD" => "J",
            "importeIPJ" => "K",
            "otroNosujetoCredFis" => "M",
            "importesExentos" => "N",
            "importesTasaCero" => "O",
            "subTotal" => "P",
            "descuento" => "Q",
            "importeGiftCard" => "R",
            "importeBaseCF" => "S",
            "creditoFiscal" => "T",
            "tipoCompra" => "U",
            "codigoControl" => "V",
            "derechoCredFiscal" => "W",
            "estadoConsolidado" => "X"
          );

          foreach ($arrayCeldas as $key => $value) {
            if($key == 'fechaFactura'){
              $fecha = $this->sheet->getCell($value.$row)->getValue();
              $valores = explode('/', $fecha);
              if(count($valores) == 3){
                $fila[$key] = $valores[2].'-'.$valores[1].'-'.$valores[0];
              }
            }else{
              $fila[$key] = $this->sheet->getCell($value.$row)->getValue();
            }
          }
          return $fila;
        }
      }
      return array();
    }
    return array();
  }
  
}
?>