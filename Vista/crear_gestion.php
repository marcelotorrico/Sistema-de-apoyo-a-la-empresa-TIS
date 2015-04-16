<?php
include '../Modelo/conexion.php';
$conectar = new conexion();
session_start();

$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];


$addini = $_POST['ini'];
$addfin = $_POST['fin'];
$addRol = $_POST['rol'];

    
    $peticion = $conectar->consultaProcedimiento("call insert_gestion('$addRol','$addini','$addfin')") ;
    $result=$peticion['errno'];
  

    if($peticion['errno'] == 1){
      echo "<script type=\"text/javascript\">alert('Se registro satisfactoriamenta la gestion'); window.location='add_gestion.php';</script>";            
    }
    else      
    if($peticion['errno'] == 0)
    {
        echo "<script type=\"text/javascript\">alert('La fecha de inicio no puede ser mayor a la de fin'); window.location='add_gestion.php';</script>";
       
    }
    else 
     if($peticion['errno'] == 2)
     {
        echo "<script type=\"text/javascript\">alert('Las gestiones deben ser posteriores a la fecha actual'); window.location='add_gestion.php';</script>";
       
     }   
    else{
        echo "<script type=\"text/javascript\">alert('se produjo un error'); window.location='add_gestion.php';</script>";
    }

?>