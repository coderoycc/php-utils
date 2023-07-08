// Funcion para recuperar los demas datos del formulario
async function updateComprobante(c){
  const asientos = recuperarAsientos();
  let data = {};
  const existePDF = $("#namePDF").val();
  // llamamos a la funcion para recuperar el archivo.
  let pdf = await leerArchivo();
  // Validamos 
  if(pdf != -1){
    // llenamos los datos en data con pdf
    data = {pdf64: pdf}
  }else{
    // llenamos los datos en data sin pdf
  }
  // hacemos la peticion con los datos
  $.ajax({
    // 
  })
}

// Funcion de la promesa que lee el archivo PDF
function leerArchivo(){
  // OBtenemos el archivo por ID
  var pdfFile = document.getElementById("pdfFile").files[0];
  if(pdfFile == null || pdfFile == undefined){ // No existe archivo
    return new Promise((resolve, reject) => resolve(-1));
  }
  return new Promise((resolve, reject) => { // existe archivo
    var reader = new FileReader();
    reader.onloadend = function () {
      var base64Data = btoa(reader.result);
      resolve(base64Data);
    };
    reader.onerror = function (error) {
      reject(error);
    };
    reader.readAsBinaryString(pdfFile);
  });
}
