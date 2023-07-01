# Agregar una nueva columna primaria para que sea unica e incremental.
```sql
ALTER TABLE tblFacturaCompra 
ADD idFacturaCompra INT IDENTITY(1,1) PRIMARY KEY;
```
