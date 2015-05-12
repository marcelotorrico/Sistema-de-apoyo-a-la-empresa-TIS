<?php
    include '../conexion.php';
    $conectar = new conexion();
    session_start();

    $nombreU = htmlentities($_POST['nombreUsuario'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombreReal'], ENT_QUOTES);
    $apellido = htmlentities($_POST['apellido'], ENT_QUOTES);
    $password = htmlentities($_POST['password'], ENT_QUOTES);
    $correo = htmlentities($_POST['email'], ENT_QUOTES);
    $telefono = htmlentities($_POST['telefono'], ENT_QUOTES);
    $rol = htmlentities($_POST['UsuarioRol'], ENT_QUOTES);

    //include '../conexion.php';
    //require '../PHPMailerAutoload.php';
    //require '../class.phpmailer.php';
    
    //nombre y apellido capitalizado
    $nombreC = ucwords(strtolower($nombre));
    $apellidoC = ucwords(strtolower($apellido));
       
    require '../../Controlador/ValidadorFormulario.php';
    
    $peticion=$conectar->consultaProcedimiento("CALL registro_usuario('$nombreC','$apellidoC','$nombreU','$telefono','$password','$correo','$rol')");
    
    $mensaje= $peticion['mensaje'];

      echo "<script>alert('$mensaje'); window.location='../../index.php';</script>";            
   
?>
