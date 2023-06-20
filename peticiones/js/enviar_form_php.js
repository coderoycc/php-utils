/*
Esta funcion envia la peticion Mediante POST al archivo shop-details.php
Y en ese archivo se reciben los valores con 'name'
es decir, en shop-details se encuentran los valores "id", "idLinea"
para procesarlos ($_POST['id'])
*/
function ver_detalle(id, idLinea) {
  // console.log("id producto: ", id);
  var form = document.createElement("form");
  form.setAttribute("method", "POST");
  form.setAttribute("action", "shop-details.php");
  form.innerHTML = `
    <input type="hidden" name="id" value="${id}">
    <input type="hidden" name="idLinea" value="${idLinea}"
  `;
  document.body.appendChild(form);
  form.submit();
  form.remove();
}
