// Crear objeto XMLHttpRequest
const peticion = new XMLHttpRequest();

// crear un objeto para el formulario
var data = new FormData();

// obtener form con el nombre (ID)
data = getFormData(nombre_form, data);

// Enviamos peticion
peticion.open("POST", "../ruta/de/envio.php");
peticion.send(data);
// Recibimos la respuesta
peticion.onload = function () {}
