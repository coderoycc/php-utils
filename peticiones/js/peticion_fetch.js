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
