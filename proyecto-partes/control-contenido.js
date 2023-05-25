$(document).ready(()=>{
  const menu = $('#menu');
  const seccion = $("#content");
  const botonContenido = $("#sig");
  var res = [];
  var ids = [];
  var lenRes = 0;
  var indiceContenido = 0;
  var avanzado = true;
  var player = null;
  var valor = '';
  var idActual = -1;
  var tipoActual = '';
  menu.click((event) => {
    const valor = event.target;
    if(valor.classList.value == 'tema' && avanzado){
      avanzado = false;
      seccion.empty();
      res = [];
      lenRes = 0;
      indiceContenido = 0;
      $.ajax({
        url: './controller/temas.php?idTema='+valor.id.substr(1),
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          res = response.contenido;
          ids = response.ids;
          console.log(ids)
          lenRes = res.length;
          appendContent();
        },
        error: function (xhr, status, error) {
          console.log(error);
        }
      });
    }else{
      console.log('Debe terminar el Avance');
    }
  });
  function appendContent(){
    if(indiceContenido < lenRes){
      console.log(`Se muestra el contenido ${indiceContenido} el ID es ${ids[indiceContenido][0]} , el tipo de contenido es ${ids[indiceContenido][1]}`);
      seccion.append(res[indiceContenido]);
      tipoContenido();
      document.getElementsByTagName('body')[0].scrollIntoView({ behavior: 'smooth', block: 'end' });
      indiceContenido++;
      eventsControll(indiceContenido-1);
    }else{
      avanzado = true;
      Swal.fire(
        '¡Buen Trabajo!',
        'Terminaste el tema',
        'success'
      );
      // setTimeout(()=>{
      //   location.reload();
      // }, 1900)
    }
  }

  function tipoContenido(){
    if(ids[indiceContenido][1] == 'video'){
      console.log(`Es video`)
      $("#sig").hide();
      idActual = ids[indiceContenido][0];
      return createYTObject();
    }else{
      botonContenido.show();
    }

  }
  /**
  eventsControll declaramos el estado actual.
  valores actuales 
    TIPO
    RESPUESTA (VALOR)
  */
  function eventsControll(actual){    
    idActual = ids[actual][0];
    tipoActual = ids[actual][1];
    // Evento para encuesta
    $(`#btns${idActual}`).on('click', '.btn', (event)=>{
      // console.log('CLICK En el boton')
      var boton = $(event.currentTarget);
      $(`.btn-group${idActual} .btn`).removeClass('btn-primary').addClass('btn-default');
      boton.removeClass('btn-default').addClass('btn-primary').addClass('active');
      valor = boton.children().first().val();
    });
    
    $(`#btn-foro${idActual}`).click(()=>{
      valor = $(`#respuesta${idActual}`).val();
      $(`#respuesta${idActual}`).prop('disabled', true);
    })
  }

  function createYTObject() {
    let video = document.getElementById('ytplayer');
    if (typeof window.YT !== 'undefined' && window.YT && typeof window.YT.Player !== 'undefined' && video != null) {
      player = new YT.Player('ytplayer', {
        events: {
          'onStateChange': eventos
        }
      });
    } else {
      setTimeout(createYTObject, 100);
    }
  }
  function eventos(event) {
    if (event.data == YT.PlayerState.PLAYING) {
      console.log('Video inició la reproducción');
    }
    if (event.data == YT.PlayerState.ENDED) {
      console.log('Video terminó la reproducción');
      // player.destroy();
      if(player.removeEventListener){
        player.removeEventListener('onStateChange', eventos);
        player = Object();
        $('#ytplayer').prop('id', '')
        registroAvance('video','', idActual);
        return appendContent();
      }
    }
  }

  botonContenido.click(function (){
    console.log(`Se registrará el tipo ${tipoActual}\nValor actual ${valor}\nID-Contenido Actual ${idActual}`)
    registroAvance(tipoActual, valor, idActual);
    tipoActual = '';
    valor = '';
    idActual = -1;
    console.log(`Cambiando al contenido # ${indiceContenido}`)
    appendContent();
  })

});
/* Fin Onload()*/

function registroAvance(tipo, value, id){
  let params = {value, id};
  if(tipo == 'encuesta' || tipo == 'seleccion'){
    $(`.btn-group${id} .btn`).prop('disabled', true);
    $(`.btn-group${id} .btn`).addClass('disabled');
  }
  $.ajax({
    type: "POST",
    url: "./controller/updateAvance.php",
    data: params,
    success: function (res) {
      console.log('Actualizado', res);
    },
  });
}


// }
// function appendContent(){
//     // $("#resEncuesta").html(`
//     // <div class="box box-danger">
//     //   <div class="box-header with-border">
//     //     <h3 class="box-title">Resultados de la encuesta</h3>
//     //   </div>
//     //   <div class="box-body chart-responsive">
//     //     <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
//     //   </div>
//     //   <!-- /.box-body -->
//     // </div>
//     // `);

//     // var donut = new Morris.Donut({
//     //   element: 'sales-chart',
//     //   resize: true,
//     //   colors: ["#3c8dbc", "#f56954", "#00a65a"],
//     //   data: [
//     //     {label: "Download Sales", value: 12},
//     //     {label: "In-Store Sales", value: 3},
//     //     {label: "Mail-Order Sales", value: 6}
//     //   ],
//     //   hideHover: 'auto'
//     // });
//   //});
// }

function foroResp(mostrar, self){
  $(self).prop('disabled', true);
  Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Respuesta registrada',
    showConfirmButton: false,
    timer: 1000
  });
  if(mostrar == 'SI'){
    $("#btn-ver").show();
  }
}

function respuestas(idCont){
  // seccion.empty();
  // // mostrar contenido respuestas
  // $.ajax({
  //   type: "POST",
  //   url: "./controller/foro-resp.php",
  //   data: {
  //     "idContenido": idCont,
  //   },
  //   success: function (res) {
  //     seccion.append(res);
  //   },
  // });
  $("#verForo").html(`
    <div class="row">
      <div class="col-md-12">
        <ul class="timeline">
          <li class="time-label">
            <span class="bg-yellow">
              Foro ID - ${idCont}
            </span>
          </li>
          
          <li>
            <i class="fa fa-user bg-blue"></i>
            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
              <h3 class="timeline-header"><a href="#">OTRO Usuario</a></h3>
              <div class="timeline-body">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                quora plaxo ideeli hulu weebly balihoo...
              </div>
            </div>
          </li>
          <li>
            <i class="fa fa-user bg-blue"></i>
            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
              <h3 class="timeline-header"><a href="#">OTRO Usuario</a></h3>
              <div class="timeline-body">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                quora plaxo ideeli hulu weebly balihoo...
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    `);
}


// Manejo de IFRAME YOUTUBE Iframe del tipo
//<iframe id="ytplayer" width="560" height="315" src="https://www.youtube.com/embed/MTn9lGKBteA?enablejsapi=1" title="Prueba corto 30 segundos" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>