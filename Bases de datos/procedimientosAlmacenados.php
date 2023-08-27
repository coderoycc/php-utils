<?php
// Procedimientos almacenados con una variable en sql server
function maximo($fecha, $con){
  $sql = "DECLARE @montoMaxFacturacion decimal(18, 2);
  SELECT @montoMaxFacturacion = montoMaxFacturacion
  FROM tblVariablesMaestro;
  SELECT idCliente, cliente, SUM(montoTotalFactura) as total 
  FROM tblVentasMaestro
  WHERE fechaFacturacion = '$fecha'
  GROUP BY idCliente, cliente
  HAVING SUM(montoTotalFactura) > @montoMaxFacturacion;";
  $stmt = sqlsrv_query($con, $sql, array());
  $resMax = '<h2>Usuario que exceden monto maximo de facturacion</h2>';
  if($stmt){
    if(sqlsrv_has_rows($stmt) === false){
      $resMax .= '<p style="color:green;">Ningún cliente excede el monto máximo de facturación el día de hoy</p>';
    }else{
      while($row = sqlsrv_fetch_array($stmt)){
        $resMax .= '<ul>
              <li>Usuario: '.$row['cliente'].'</li>
              <li>ID Usuario: '.$row['idCliente'].'</li>
              <li>Monto: '.$row['total'].'</li>
              </ul>';
      }
    }
  }
  return $resMax.'<hr>';
}

// function que verifica la correlatividad de un campo en una base de datos
function correlativo($idTienda, $con, $fecha){
  $res = '';
  $sql = "
  DECLARE @idVarDetalle INT;
  SELECT TOP 1 @idVarDetalle = idVariableDetalle FROM tblVariablesDetalle
  WHERE idTienda = $idTienda 
  AND fechaInicial <= '$fecha'
  AND fechalimiteEmision >= '$fecha';
  IF NOT (@idVarDetalle IS NULL OR @idVarDetalle = '')
  BEGIN
      SELECT idVenta, NoFactura, idVariableDetalle 
      FROM tblVentasMaestro 
      WHERE idVariableDetalle = @idVarDetalle
      AND NoFactura != 0
      ORDER BY NoFactura;
  END
  ELSE
  BEGIN
      PRINT '-1';
  END;";
  $stmt = sqlsrv_query($con, $sql, array());

  if($stmt){
    if(sqlsrv_has_rows($stmt) != false){
      $ant = 0;
      while($row = sqlsrv_fetch_array($stmt)){
        if(!((intval($row['NoFactura']) - $ant) == 1 ||
        (intval($row['NoFactura']) - $ant) == intval($row['NoFactura']))){
          if(intval($row['NoFactura']) - $ant == 0){
            $res .= '<p>La factura Nro. '.$row['NoFactura'].' esta repetida';
          }else{
            $res .= '<p>Falta la Factura Nro.: '.($ant+1).'. Antes de la Venta con ID: '.$row['idVenta'].' </p>';
          }
          
        }
        $ant = intval($row['NoFactura']);
      }
    }
  }
  if($res == ''){
    $res = '<p style="color:green;">La correlatividad está correcta</p>';
  }
  return '<h2>Verificacion de la correlatividad con ID tienda: '.$idTienda.'</h2>'.$res.'<hr>';
}
?>
