<?php
 
    include '../Modelo/conexion.php';
    $conectar = new conexion();
    session_start();

      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $nombreU = $_POST['usuario'];
      $telefono = $_POST['telefono'];
      $password = ($_POST['contrasena']);
      $correo= $_POST['email'];
 

    $cantidad = $conectar->consulta("select count(*) as cant from usuario where NOMBRE_U='$nombreU'");
    $cantidad = mysql_fetch_assoc($cantidad);    
    $cantidad = $cantidad['cant'];
    
    if ($cantidad > 0) {
      $mensaje = "El nombre de usuario ya fue registrado por favor cambie de nombre ";
      echo "<script>alert('$mensaje'); window.location='../Vista/registro_administrador.php';</script>";          
    } else {
        $peticion=$conectar->consultaProcedimiento("CALL registro_administrador('$nombre','$apellido','$nombreU','$telefono','$password','$correo')");
        $mensaje= $peticion['mensaje'];
          echo "<script>alert('$mensaje'); window.location='../Vista/registro_administrador.php';</script>";          
        }
      
   
?>                                        

     

