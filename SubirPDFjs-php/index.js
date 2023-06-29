// resto de boton para recuperar los datos
// datos ...
// let datos = $('#form_registro_comprobante').serialize();
// datos = datos+"&total_asientos="+ASIENTOS.length;
var pdfFile = document.getElementById("pdfFile").files[0];
if(pdfFile != null && pdfFile != undefined){
    console.log("Existe archivo")
    var reader = new FileReader();
    reader.onloadend = function () {
        var base64Data = btoa(reader.result);
        datos += '&pdfFile=' + encodeURIComponent(base64Data);
        $.ajax({
            data: datos,
            url: 'services/archivo.php',
            type: 'POST',
            dataType: 'JSON',
            beforeSend: function(){
            },
            success:function(response){
                $('#modal_registrar_comprobante').modal('hide');
                listar_comprobantes()
                show_toast(
                    ACCION,
                    response.message,
                    response.success ? 'text-bg-success' : 'text-bg-danger'
                );
                console.log("["+ACCION+"] "+response.message);
                console.log("Mensaje PDF", response.pdf);
            },
            error: function(error){
                $('#modal_registrar_comprobante').modal('hide');
                show_toast(ACCION,error.statusText,'text-bg-danger');
                console.log("["+ACCION+"] ",error);
            }
        });
    }
    reader.readAsBinaryString(pdfFile);
}else{
  // enviar otra peticion o denegar form
}
