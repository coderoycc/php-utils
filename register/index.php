<?php 
session_start();

if(isset($_SESSION['id'])){
  header("Location: ../home/");
  die();
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="​Happiness &amp;amp; Mindfulness Courses, Welcome Message, Benefits of working with us​, 01, 02, 03, 04, 05, 06, ​How Coaching Works, ​How and where to learn mindfulness, Meet The Team
Our Professionals, ​Start using Our App for free">
  <meta name="description" content="">
  <title>Registrar</title>
  <link rel="stylesheet" href="../static/css/nicepage.css" media="screen">
  <link rel="stylesheet" href="../static/css/Inicio.css" media="screen">
  <script class="u-script" type="text/javascript" src="../static/js/jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="../static/js/nicepage.js" defer=""></script>
  <meta name="generator" content="Nicepage 5.5.0, nicepage.com">

  <link id="u-theme-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "Aprendizaje",
		"logo": "images/logo_en.png",
		"sameAs": []
}</script>
  <meta name="theme-color" content="#243f56">
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
  <style>
    @media (max-width: 720px){
      #regisForm{
        width:100%;
      }
      #logoRegis{
        display: none;
      }
    }
  </style>
</head>

<body data-home-page="../home/" data-home-page-title="Inicio" class="u-body u-xl-mode" data-lang="es">
  <?php include('../common/header.php'); ?>
  <section
    class="skrollable skrollable-between u-align-center u-clearfix u-container-align-center u-image u-shading u-section-2"
    id="carousel_e141" src="" data-image-width="1620" data-image-height="1080">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <div class="container">
        <div class="row">
          <div class="col-6" id="regisForm">
            <div class="card">
              <form class="register">
                <div class="card-header text-start">
                  <h3 class="card-title text-dark align-left mt-2"><i class="fas fa-table"></i> <b>Registrarse</b></h3>
                </div>
                <div class="card-body">
                  <div class="container">
                    <div class="row mb-4">
                      <div class="input-group flex-nowrap input-group-lg">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-circle-user"></i></span>
                        <input type="text" class="form-control" placeholder="Tu nombre completo" aria-label="Username"
                          aria-describedby="addon-wrapping" id="nombre" required />
                      </div>
                      <span id="verifyName" style="color:orange;display:none">Mínimo: un nombre y un apellido</span>
                    </div>
                    <div class="row mb-4">
                      <div class="input-group flex-nowrap input-group-lg">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" placeholder="Tu email" aria-label="Username"
                          aria-describedby="addon-wrapping" id="email" required />
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="input-group flex-nowrap input-group-lg">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-mobile-alt"></i></span>
                        <input type="text" class="form-control" placeholder="Tu celular" aria-label="Username"
                          aria-describedby="addon-wrapping" id="celular" />
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="input-group flex-nowrap input-group-lg">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-globe"></i></span>
                        <input type="text" class="form-control" placeholder="País de residencia" aria-describedby="addon-wrapping" id="pais" required/>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="input-group flex-nowrap input-group-lg">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" placeholder="Tu contraseña" aria-label="Username" aria-describedby="addon-wrapping" id="pass" required />
                      </div>
                      <span id="verifyPass" style="color:orange;display:none">8 caracteres alfanuméricos</span>
                    </div>
                    <!-- Checked checkbox -->
                    <div class="form-check text-start">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked />
                      <label class="form-check-label text-muted" for="flexCheckChecked">Al hacer click aquí, (i) estoy
                        de acuerdo con los <a class="text-primary" href="#">Terminos de Uso</a>
                        y <a class="text-primary" href="#">Políticas</a>.
                        (ii) Soy consciente de la <a class="text-primary" href="#">Política de Privacidad</a> de Mining Business School.
                      </label>
                    </div>
                  </div>
                  <a href="../home/" class="mt-4 btn btn-lg btn-rounded btn-danger text-light"><i
                      class="fas fa-xmark"></i> <b>Cancelar</b></a>
                  <button type="submit" id="btn-submit" class="btn btn-lg btn-rounded btn-success text-light"><i
                      class="fas fa-user-plus"></i> <b>Registrar</b></button>
                  <div id="mensaje" style="background-color: rgba(15,15,15,0.2);"></div>
                  <div class="row mt-4">
                    <div class="col-12 text-muted">
                      ¿Ya tienes una cuenta? <a class="text-primary" href="../auth/">Inicia Sesión aquí</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-6 ps-5 pe-5" id="logoRegis">
            <img src="../images/logo_en_negativo.png" class="img img-fluid" alt="" srcset="">
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include('../common/footer.php'); ?>
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
  <script src="../static/js/sweetalert2.min.js"></script>
  <script type="text/javascript" charset="utf8" src="../static/js/jquery.js"></script>
  <script src="./js/register.js"></script>
  <script src="../static/js/bootstrap.min.js"></script>
</body>

</html>