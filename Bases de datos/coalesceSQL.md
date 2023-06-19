## Uso de COALESCE en SQL Server
### Caso: Obtener ids y nombres de una tabla y contar la cantidad de apariciones en otra tabla.
Nota. Siempre se debe mostrar todos los nombres y IDS de la primera tabla aunqueno aparezca en la segunda tabla (cero apariciones)

Para obtener todos los registros de la tabla `tblRespuestas` con `idContenido` igual a 45, incluyendo las respuestas que no tienen registros correspondientes en la tabla `tblAvance` (con una cantidad de respuestas de 0), puedes utilizar una consulta con una subconsulta y el operador `LEFT JOIN`. Aquí tienes el ejemplo de la consulta SQL:

```sql
SELECT r.idResp, r.respuesta, COALESCE(a.cantidad_respuestas, 0) AS cantidad_respuestas
FROM tblRespuestas r
LEFT JOIN (
  SELECT idResp, COUNT(*) AS cantidad_respuestas
  FROM tblAvance
  GROUP BY idResp
) a ON r.idResp = a.idResp
WHERE r.idContenido = 45
```

Explicación de la consulta:

1. La subconsulta interna realiza un `COUNT(*)` agrupado por `idResp` en la tabla `tblAvance` para obtener la cantidad de respuestas por `idResp`.
2. Luego, hacemos un `LEFT JOIN` entre la tabla `tblRespuestas` y la subconsulta utilizando el campo `idResp` para unir las dos tablas.
3. Utilizamos la función `COALESCE` para reemplazar cualquier valor `NULL` en `a.cantidad_respuestas` por 0, de modo que si no hay registros en `tblAvance` para una respuesta en particular, se mostrará una cantidad de respuestas de 0.
4. Finalmente, aplicamos el filtro `WHERE` para obtener solo los registros de `tblRespuestas` con `idContenido` igual a 45.

Con esta consulta, obtendrás todos los registros de la tabla `tblRespuestas` con `idContenido` igual a 45, y en caso de que no haya registros correspondientes en la tabla `tblAvance`, se mostrará una cantidad de respuestas de 0.
