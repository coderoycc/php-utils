<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRINCIPAL</title>
</head>
<body>
  <button>PETICION</button>
  <div id="content" style="margin:50px;">
    
  </div>
  <script>
    const btn = document.querySelector('button');
    btn.addEventListener('click', () => {
      const url = 'main.php';
      fetch(url)
        .then(res => res.text())
        .then(data => {
          let resultado = document.getElementById('content');
          resultado.innerHTML = data;
        })
        .catch(err => console.log(err));
    });
  </script>
</body>
</html>