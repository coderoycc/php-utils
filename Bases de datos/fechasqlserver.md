## Fecha automática al insertar un dato en SQL Server
Para tener una columna que sea de fecha que se inserte al mismo tiempo que creemos nuestro registro se usa la siguiente sentencia SQL.
```sql
ALTER TABLE tblAvance ADD fechaReg DATETIME DEFAULT (GetDate());
```
En este ejemplo, `tblAvance` es el nombre de la tabla y `fechaReg` es la columna que agregaremos.

## Extraer fecha de SQL Server
Si estás utilizando una consulta SQL para obtener la fecha desde SQL Server, primero lo convertimos en cadena, desde la consulta.

```sql
SELECT CONVERT(VARCHAR(19), tu_columna_fecha, 120) AS fecha FROM tu_tabla;
```

En este ejemplo, `tu_columna_fecha` es el nombre de la columna que contiene la fecha en SQL Server, y `tu_tabla` es el nombre de la tabla donde se encuentra la columna. La función `CONVERT()` con el estilo `120` se utiliza para convertir la fecha en formato "AAAA-MM-DD HH:MI:SS" a una cadena de texto.

Una vez que te asegures de que estás obteniendo la fecha como una cadena de texto desde SQL Server, puedes utilizarla en PHP y aplicar el resto del proceso que te mencioné anteriormente para formatearla como "DIA/MES HORA:MINUTO".