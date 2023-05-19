$(".login").on('submit', () =>{
  username = $("#user").val();
  password = $("#pass").val();

  parametros = {
    "name": username,
    "pwd": password
  }
  console.log(parametros);

  $.ajax({
    type: "POST",
    url: "auth.php",
    data: parametros,
    success: function (html) {
      console.log(html);
      setTimeout(() => {
        if (html == 1) {

          $("#mensaje").hide().animate({ "opacity": "0", "bottom": "-80px"}, 0);
          $("#mensaje").css("background-color", "#2ecc71");
          document.getElementById("mensaje").className = "feedback";
          document.getElementById("mensaje").innerHTML = "Bienvenido!";
          $("#mensaje").show().animate({ "opacity": "1", "bottom": "-80px" }, 400);
          $("input").css({ "border-color": "#2ecc71" });

          setTimeout(() => {
            location.href = "../miscursos/";
          }, 1000);
        } else {
          $("#mensaje").hide().animate({ "opacity": "0", "bottom": "80px"}, 0);
          $("#mensaje").css("background-color","#e90505");
          
          document.getElementById("mensaje").innerHTML = "Usuario o contraseña incorrecta";
          $("#mensaje").show().animate({ "opacity": "1", "bottom": "-80px" }, 400);
          $("input").css({ "border-color": "#e90505" });
          
          $("input").on("focus",()=>{
            $("input").css({ "border": "1px solid #bdbdbd" });
          })
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