# CONSULTAS ALTER
### Crear una nueva columna con un valor por defecto
Para crear una nueva columna en SQL Server con una sentencia SQL, puedes utilizar la siguiente sintaxis:

```sql
ALTER TABLE nombre_tabla
ADD nombre_columna VARCHAR(32) DEFAULT 'activo'
```

Reemplazar "nombre_tabla" con el nombre de la tabla a la que deseas agregar la nueva columna y "nombre_columna" con el nombre que deseas asignarle a la columna.

En este ejemplo, la nueva columna se define como VARCHAR(32), lo que significa que almacenará texto con una longitud máxima de 32 caracteres. Además, se establece un valor predeterminado utilizando la cláusula `DEFAULT 'activo'`, lo que significa que todos los registros existentes y los nuevos registros tendrán el valor 'activo' en esta columna, a menos que se especifique un valor diferente al insertar o actualizar los datos.
