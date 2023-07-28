-- REALIZAMOS LA CONSULTA EN ESTE CASO NOS DEVUELVE el ID del PRODUCTO y el VALOR CODIGO CLASIFICADOR que nos permitirá actualizar un campo en específico
select tp.idProducto, tmp.codigoClasificador from tblProductos tp
inner join (
	select tp.idPresentacion, tu.codigoClasificador from tblPresentacion as tp
	inner join tblUnidadMedida as tu
	on tp.presentacion like tu.descripcion
) as tmp
on tmp.idPresentacion = tp.presentacion
where tp.idUnidadMedidaHomologado is null OR tp.idUnidadMedidaHomologado = 0;
-- VERIFICAR BIEN LA CONSULTA, QUE NO EXISTAN REPETIDOS\DUPLICADOS, luego ver la cantidad de registros obtenidos


-- USANDO LA CONSULTA REALIZAMOS EL UPDATE DE LA TABLA tblProductos
UPDATE tblProductos -- tabla a actualizar
SET idUnidadMedidaHomologado = tmp2.codigoClasificador -- CAMPO A ACTUALIZAR
FROM tblProductos 
INNER JOIN (
  -- CONSULTA ANTERIOR
    SELECT tp.idProducto, tmp.codigoClasificador
    FROM tblProductos tp
    INNER JOIN (
        SELECT tp1.idPresentacion, tu.codigoClasificador
        FROM tblPresentacion AS tp1
        INNER JOIN tblUnidadMedida AS tu ON tp1.presentacion LIKE tu.descripcion
    ) AS tmp ON tmp.idPresentacion = tp.presentacion
    WHERE tp.idUnidadMedidaHomologado IS NULL OR tp.idUnidadMedidaHomologado = 0
  --
) AS tmp2 ON tblProductos.idProducto = tmp2.idProducto; -- CONDICION PARA ACTUALIZAR REGISTROS
-- Al actualiar si todo es correcto los registros actualizados deberian ser igual a cantidad de los registros obtenidos en la primera consulta.



-- ESTRUCTURA BASICA DE CONSULTA UPDATE CON INNER
UPDATE tabla_destino
SET columna_destino1 = valor_nuevo1,
    columna_destino2 = valor_nuevo2,
    ...
    columna_destinoN = valor_nuevoN
FROM tabla_destino as e
INNER JOIN tabla_origen|consulta a tablas 
  ON condicion_de_union --condicion para actualizar IDS
WHERE condicion_de_filtrado;

-- Ejemplo de condicion de filtrado
WHERE e.departamento = 'Ventas';
