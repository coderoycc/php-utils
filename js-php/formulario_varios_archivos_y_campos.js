/*
Envio de un formnulario con varios archivos y varios campos
Usando jquery
*/
$("#form_register").on('submit', (e)=>{
  e.preventDefault();
  if(!tieneExtencion()){
    return;
  }
  var formData = new FormData();

  // Agregar los archivos seleccionados al FormData
  $('.filePdf').each(function() {
    var input = this;
    var fileName = $(input).data('filename');
    var file = input.files[0];
    if (file) {
      formData.append(fileName, file);
    }
  });

  // Obtener los otros campos del formulario y agregarlos al FormData
  var formFields = $(e.target).serializeArray();
  $.each(formFields, function(i, field) {
    formData.append(field.name, field.value);
  });

  // Enviar el FormData al servidor jquery
  $.ajax({
    url: '../api/socio/create',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    dataType: 'json',
    success: function(response) {
      if(response.status == 'success'){
        Swal.fire({
          icon: 'success',
          title: 'Registro exitoso',
          text: 'Ingrese con su correo y contraseña',
          showConfirmButton: true,
          timer: 3000
        })
        setTimeout(() => {
          window.location.href = '../auth';
        }, 3010)
      }
      else{
        Swal.fire({
          icon: 'error',
          title: 'Ocurrió un error en el registro',
          text: 'Intente nuevamente más tarde',
          showConfirmButton: true,
          timer: 1900
        })
      }
    },
    error: function(response) {
      Swal.fire({
        icon: 'error',
        title: 'Ocurrió un error en el registro',
        text: 'Intente nuevamente más tarde',
        showConfirmButton: true,
        timer: 1900
      }) 
    }
  })

  for (var pair of formData.entries()) {
    console.log(pair[0] + ': ' + pair[1]);
  }
})
