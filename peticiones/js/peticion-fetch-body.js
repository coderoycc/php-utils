function probar(){
  const url = 'app.php';
  const data = new URLSearchParams();
  data.append("id",21)
  data.append("palabra","Esta es una cadena para que se cuenten las palabras")
  
  fetch(url, {
    method:"POST",
    body:data
  })
    .then(res => res.text())
    .then(data => {
      let resultado = document.getElementById('content');
      resultado.innerHTML = data;
    })
    .catch(err => console.log(err));
}
