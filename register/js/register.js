$(document).ready(() => {
  $("#btn-submit").prop('disabled',true);

  $("#pass").focus(()=>{
    $("#verifyPass").show();
  });
  $("#nombre").focus(()=>{
    $("#verifyName").show();
  });

  $("#nombre").keyup(()=>{
    let name = $("#nombre").val();
    var vector = name.split(" ");
    if(vector.length >= 2 && vector[0].length >= 2){
      if(vector[1].length >= 3){
        $("#verifyName").hide();
      }
    }else{
      $("#verifyName").show();
    }
  })

  $("#pass").keyup(()=>{
    var password = $("#pass").val();
    var passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;
    console.log(password)
    if (!passwordRegex.test(password)) {
      $("#btn-submit").prop('disabled',true);
      $("#verifyPass").show();
    }else{
      $("#verifyPass").hide();
      $("#btn-submit").prop('disabled',false);
    }
  })


  $(".register").on('submit', () => {
    nombre = $("#nombre").val();
    email = $("#email").val();
    password = $("#pass").val();
    celular = $("#celular").val();
    pais = $("#pais").val();

    parametros = {
      "nombre": nombre,
      "email": email,
      "celular": celular,
      "pass": password,
      "pais":pais
    }
    console.log(parametros);

    $.ajax({
      type: "POST",
      url: "register.php",
      data: parametros,
      success: function (html) {
        console.log(html);
        setTimeout(() => {
          if (html == 1) {
            Swal.fire({
              icon:"success",
              title: 'Registro correcto',
              html: 'Ingresa con tus datos',
              timer: 3800,
            }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {
                console.log('Cerrado antes de terminar')
              }
            })
            $("#mensaje").hide().animate({ "opacity": "0", "bottom": "80px" }, 0);
            setTimeout(() => {
              location.href = "../auth/";
            }, 3900);
          } else {
            console.log("OCURRIO ERROR");
            Swal.fire({
              icon: 'error',
              title: 'UPS!',
              text: 'Ocurrió un error!'
            })
            $("#mensaje").hide().animate({ "opacity": "0", "bottom": "80px" }, 0);
            // $("#mensaje").css("background-color", "#e90505");

            // $("input").css({ "border-color": "#e90505" });
          }
        }, 1000);
      },
      beforeSend: function () {
        // document.getElementById("boton-estilo").innerHTML = '<i class="fa fa-arrow-right"></i>';
        // $(".submit").css({ "background": "#1f9cd6", "border-color": "#1f9cd6" });
        $("#mensaje").hide().animate({ "opacity": "0", "bottom": "-80px" }, 0);
        document.getElementById("mensaje").className = "carga";
        document.getElementById("mensaje").innerHTML = '<i class="fas fa-sync fa-spin"></i>';
        $("#mensaje").show().animate({ "opacity": "1", "bottom": "-80px" }, 400);
        // $("input").css({ "border-color": "#1f9cd6" });
      }
    });
    return false;
  });
})

