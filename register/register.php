<?php
    include('../connections/conexion.php');

    $nombre ="";
    $password ="";
    $celular = null;
    $email = "";
    $pais = "";
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
    }
    if (isset($_POST['pass'])) {                        
        $password = $_POST['pass'];
    }
    if (isset($_POST['celular'])) {                        
        $celular = $_POST['celular'];
    }
    if (isset($_POST['email'])) {                        
        $email = $_POST['email'];
    }
    if (isset($_POST['pais'])) {                        
        $pais = $_POST['pais'];
    }
    
              
    $array=array($nombre, $email, $password, $celular, $pais);
    
    $consulta = "INSERT INTO tblEstudiante(nombre, usuario, password, celular, pais) VALUES(?,?,?,?,?)";
    $ejecutar=sqlsrv_query($con,$consulta,$array);
    if ($ejecutar){
        echo 1;
    }else{
        
        // $_SESSION['idEstudiante'] = $row['idEstudiante'];   $_SESSION['nombre'] = $row['nombre'];   $_SESSION['usuario'] = $row['usuario']; 
        echo 2;
    }
    
    
?>  
