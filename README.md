# PHP UTILS
Funciones, utiles para PHP acompañados de JS.

## Atributos SERVER
* Ver el nombre del servidor 
```php
$_SERVER['HOST_NAME'];
```
* Ver el puerto del servidor
```php
$_SERVER['SERVER_PORT']
```
* Poder reconocer el tipo de petición que se recibio en el servidor.
```php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  // codigo por verdadero
}
```

