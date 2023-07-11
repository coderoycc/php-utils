# PAGOS PAYPAL
## 1. Integracion de botones de pago para paypal

* Para la integracion inicialmente es necesario tener cuentas en SANDBOX para cliente y para vendedor.

* Las API de paypal es de tipo REST. 
* Usa enlaces HATEOAS Hypermedia As The Engine Of Application State (hipermedia como motor del estado de la aplicacion). Significa que en un determinado estado se puede descrubir recursos basandose unicamente en las respuestas del servidor (enlaces).
  * Respuesta normal
```json
{
    "id": 78,
    "nombre": "Juan",
    "apellido": "García",
    "coches": [
    	{
    		"id": 1033
    	},
    	{
    		"id": 3889
    	}
    ]
}
```
* 
  * Respuesta usando HATEOAS
```json
{
    "id": 78,
    "nombre": "Juan",
    "apellido": "García",
    "coches": [
    	{
    		"coche": "http://miservidor/concesionario/api/v1/clientes/78/coches/1033"
    	},
    	{
    		"coche": "http://miservidor/concesionario/api/v1/clientes/78/coches/3889"
    	}
    ]
}
```

## 2. Identificar las peticiones a realizar (En tu servidor dedicar endpoints para poder procesar el pago)
