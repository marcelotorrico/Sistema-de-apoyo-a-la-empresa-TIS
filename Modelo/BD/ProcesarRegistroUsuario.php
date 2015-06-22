<?php
    include '../conexionPDO.php';
    $conectar = new Conexion();
    session_start();

    $nombreU = htmlentities($_POST['nombreUsuario'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombreReal'], ENT_QUOTES);
    $apellido = htmlentities($_POST['apellido'], ENT_QUOTES);
    $password = htmlentities($_POST['password'], ENT_QUOTES);
    $correo = htmlentities($_POST['email'], ENT_QUOTES);
    $telefono = htmlentities($_POST['telefono'], ENT_QUOTES);
    $rol = htmlentities($_POST['UsuarioRol'], ENT_QUOTES);

    //require '../PHPMailerAutoload.php';
    //require '../class.phpmailer.php';
    
       
    require '../../Controlador/ValidadorFormulario.php';
   //query para verificar si existe el nombre de usuario
    $cantidad = $conectar->query("select count(*) as cant from usuario where NOMBRE_U='$nombreU'");
    $cantidad = $cantidad->fetch(PDO::FETCH_ASSOC);
    if ($cantidad['cant'] >= 1) {
       $mensaje = "El nombre de usuario ya fue registrado. Por favor cambie de nombre";
       echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarUsuario.php';</script>";            

     } else {
        $peticion=$conectar->query("CALL registro_usuario('$nombre','$apellido','$nombreU','$telefono','$password','$correo','$rol')");
        //verificar que la peticion se logró exitosamente!
        if ($peticion) {
            $peticion=$peticion->fetch(PDO::FETCH_ASSOC);
            $mensaje= $peticion['mensaje'];
            echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarUsuario.php';</script>";            
        } else {
            $mensaje = 'El correo ya esta siendo usado en otra cuenta, por favor cambie';
            echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarUsuario.php';</script>";            
        }
    } 
?>
