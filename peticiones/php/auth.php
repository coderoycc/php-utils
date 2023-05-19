<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    include('../connections/conexion.php');
    $username ="";
    $password ="";
    if (isset($_POST['name'])) {
        $username = $_POST['name'];
    }
    if (isset($_POST['pwd'])) {                        
        $password = $_POST['pwd'];
    }                
    
    $array=array($username,$password);
    
    $consulta = "SELECT * FROM tblEstudiante WHERE usuario=? AND password=?";
    $ejecutar=sqlsrv_query($con,$consulta,$array);
    $row_count = sqlsrv_has_rows($ejecutar);
    if ($row_count === false){
        echo 2;
    }else{
        $row = sqlsrv_fetch_array($ejecutar);
        $_SESSION['id'] = $row['idEstudiante'];   
        $_SESSION['nombre'] = $row['nombre'];   
        $_SESSION['email'] = $row['usuario'];
        $_SESSION['celular'] = $row['celular'];
        $_SESSION['sobremi'] = $row['acercademi'];
        $_SESSION['pais'] = $row['pais']; 
        echo 1;
    }
    
    
?>  
