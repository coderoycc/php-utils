<?php
// Guardar la imagen en JPG usando el ID
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST['id'];
  
  if(isset($_FILES['logo'])) {
    $targetDirectory = '../assets/logos/';
    $targetFile = $targetDirectory . 'logo_' . $id . '.' . 'jpg';
    $image = imagecreatefromstring(file_get_contents($_FILES['logo']['tmp_name']));
    if ($image !== false) {
      imagejpeg($image, $targetFile, 100); 
      imagedestroy($image);
      echo json_encode(array('status' => 'ok'));
      // echo "Imagen guardada exitosamente como JPG";
    } else {
      echo json_encode(array('status' => 'error'));
    }
  }
}
?>
