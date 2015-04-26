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
    
      echo "<script>alert('$result'); window.location='add_gestion.php';</script>";            
    
?>