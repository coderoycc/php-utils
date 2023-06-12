async function peticion(){
  const url = 'app.php';
  const data = {
    id:22,
    palabra:"hola async await"
  }
  try {
    const response = await fetch(url, {
      method:'POST',
      body: new URLSearchParams(data),
    })
    if(!response.ok){
      throw new Error('Peticion erronea');
    }
    // const responseData = await response.json();
    const responseData = await response.text();
    let resultado = document.getElementById('content');
    resultado.innerHTML = responseData;
  } catch (error) {
    console.log("ERROR: ", error);
  }
}
