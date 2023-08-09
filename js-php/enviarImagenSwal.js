// enviar imagen con sweetalert2 y ajax()
const set_logo = async (self, root) => {
  console.log(self)
  const { value: file } = await Swal.fire({
    title: 'Seleccione una imagen',
    input: 'file',
    inputAttributes: {
      'accept': 'image/*',
      'aria-label': 'Upload your profile picture'
    }
  })
  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      Swal.fire({
        title: 'Su logo será...',
        imageUrl: e.target.result,
        imageAlt: 'Logo',
        showCancelButton: true,
        confirmButtonText: 'Ok, guardar'
      }).then((result) => {
        if(result.isConfirmed){
          console.log('Debemos guardar imagen')
          const id = $(self).data('id');
          const formData = new FormData();
          formData.append('logo', file, file.name);
          formData.append('id', id);
          $.ajax({
            url: root+"controllers/imageLogo.php",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function(response) {

              console.log('Imagen enviada exitosamente', response);
            },
            error: function(error) {
              console.error('Error al enviar la imagen', error);
            }
          });
        }
      })
    }
    reader.readAsDataURL(file)
  }
}
