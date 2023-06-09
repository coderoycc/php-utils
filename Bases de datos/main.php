<?php
include_once('./conexion.php');
date_default_timezone_set('America/La_Paz');
$fecha = date('Y-M-d');
$res = '';
$res .= maximo($fecha, $con);

$res .= cufdVerificar($con);

$res .= minimo($fecha, $con);


echo $res;



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
      $resMax .= '<p>Ningún cliente excede el monto máximo de facturación</p>';
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

function cufdVerificar($con){
  $sql = "SELECT cufd, codigoControl, fecha FROM tblCufd 
  WHERE codigoClasificador != 0 
  AND (estado is null OR estado = '') 
  AND (codigoRecepcion is null OR codigoRecepcion = '')
  ";
  $stmt = sqlsrv_query($con, $sql);
  $resCuf = '<h2>Cufd con campos vacios</h2>';
  if($stmt){
    if(sqlsrv_has_rows($stmt) === false){
      $resCuf .= '<p> Sin anormalidades</p>';
    }else{
      while($row = sqlsrv_fetch_array($stmt)){
        $resCuf .= '<ul>
              <li>Cufd: '.$row['cufd'].'</li>
              <li>Codigo Control: '.$row['codigoControl'].'</li>
              <li>Fecha: '.date_format(date_create($row['fecha']), 'Y-m-d').'</li>
              </ul>';
      }
    }
  }
  return $resCuf.'<hr>';
}

function minimo($fecha, $con){
  $sql = "SELECT idVenta, cliente, codigoControl FROM tblVentasMaestro 
  WHERE montoTotalFactura < 2 
  AND fechaFacturacion = '$fecha';";
  $stmt = sqlsrv_query($con, $sql);
  $resMin = '<h2>Valores irregulares en Ventas (menor a 2Bs.)</h2>';
  if($stmt){
    if(sqlsrv_has_rows($stmt) === false){
      $resMin .= '<p> No hay irregularidades</p>';
    }else{
      while($row = sqlsrv_fetch_array($stmt)){
        $resMin .= '<ul>
              <li>ID Venta: '.$row['idVenta'].'</li>
              <li>Cliente: '.$row['cliente'].'</li>
              <li>Codigo Control: '.$row['codigoControl'].'</li>
              </ul>';
      }
    }
  }
  return $resMin.'</hr>';
}
?>