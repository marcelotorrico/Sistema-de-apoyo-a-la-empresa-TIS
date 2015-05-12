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
//El nombre de usuario ya fue registrado por favor cambie de nombre  
    $peticion=$conectar->consultaProcedimiento("CALL registro_administrador('$nombre','$apellido','$nombreU','$telefono','$password','$correo')");
    
    $mensaje= $peticion['mensaje'];

      echo "<script>alert('$mensaje'); window.location='../Vista/registro_administrador.php';</script>";          
?>                                        

     

