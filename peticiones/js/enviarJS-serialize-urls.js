// Enviar peticiones con serialize de jquery 

// obtenermos todos los campos del formulario (varios campos en vectores)
// Datos de tipo <input type="decimal" id="debe-1" name="debe[]" class="form-control"> vector "debe"
let datos = $("#form_registro_comprobante").serialize();

// A parte tenemos un objeto con urls
const objt = {
  0:{
    nit:'21412312',
    nroFact:'2929292',
    url: encodeURIComponent('https://dasdasd.com?data=324233&nombnre=sadsfa')
  },
  3:{
    nit:234.
    //...
  }
}
datos = datos + "&facts=" + encodeURIComponent(JSON.stringify(objt));

// La peticion se hace de la misma manera
$.ajax({
  data: datos,
  url: "services/registrar_comprobante.php",
  type: "POST",
  dataType: "JSON",
  success: function (response) {
    $("#modal_registrar_comprobante").modal("hide");
    console.log("[" + ACCION + "] " + response.message);
    console.log(response)
  },
})
