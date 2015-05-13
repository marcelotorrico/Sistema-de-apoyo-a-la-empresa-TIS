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
    
       
    require '../../Controlador/ValidadorFormulario.php';
   //query para verificar si existe el nombre de usuario
    $cantidad = $conectar->consulta("select count(*) as cant from usuario where NOMBRE_U='$nombreU'");
    $cantidad = mysql_fetch_assoc($cantidad);    
    if ($cantidad['cant'] >= 1) {
       $mensaje = "El nombre de usuario no se encuentra disponible";
       echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarUsuario.php';</script>";            

     } else {
        $peticion=$conectar->consultaProcedimiento("CALL registro_usuario('$nombre','$apellido','$nombreU','$telefono','$password','$correo','$rol')");
        $mensaje= $peticion['mensaje'];
        echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarUsuario.php';</script>";            
       
    }
    

    
?>
