// Para poder encontrar los parametros del buscador
let params = new URLSearchParams(location.search);
var parametro = params.get("actividad")
/*
location.search --> https://www.dataprix.com/es/directorio/empresas?tecnologia=All&actividad=7751
parametro: 7751
*/
