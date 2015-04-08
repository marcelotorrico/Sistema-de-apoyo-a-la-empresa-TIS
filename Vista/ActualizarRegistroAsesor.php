<?php
session_start();
    include '../Modelo/conexion.php';
    $conectar = new conexion();
    $name = $_POST['nombreUsuario'];
    $RealName = $_POST['nombreReal'];
    $password = $_POST['password'];
    $emailUsuario = $_POST['email'];
    $apellidoUsuario = $_POST['apellido'];
    $telefonoUsuario = $_POST['telefono'];


$updLogin=$_SESSION['usuario'];




//Peticion------------------------------------------
$conectar->consulta("UPDATE usuario SET NOMBRE_U='$updLogin',PASSWORD_U='$password',TELEFONO_U='$telefonoUsuario',CORREO_ELECTRONICO_U='$emailUsuario'
WHERE  NOMBRE_U='$updLogin'");
$conectar->consulta("UPDATE asesor SET NOMBRE_U='$updLogin',NOMBRES_A='$RealName',APELLIDOS_A='$apellidoUsuario'
WHERE  NOMBRE_U='$updLogin'");
$conectar->consulta("UPDATE usuario_rol SET NOMBRE_U='$updLogin'
WHERE  NOMBRE_U='$updLogin'");


echo"<script type=\"text/javascript\">alert('Se modificaron los datos satisfactoriamente'); window.location='inicio_asesor.php';</script>";



   
 
   
?>
