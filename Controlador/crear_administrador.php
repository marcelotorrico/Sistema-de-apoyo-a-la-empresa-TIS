<?php
 
    include '../Modelo/conexionPDO.php';
    $conectar = new Conexion();
    session_start();

      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $nombreU = $_POST['usuario'];
      $telefono = $_POST['telefono'];
      $password = ($_POST['contrasena']);
      $correo= $_POST['email'];
 

    $cantidad = $conectar->query("select count(*) as cant from usuario where NOMBRE_U='$nombreU'");
    $cantidad = $cantidad->fetch(PDO::FETCH_ASSOC);
    $cantidad = $cantidad['cant'];
    
    if ($cantidad > 0) {
      $mensaje = "El nombre de usuario ya fue registrado. Por favor cambie de nombre";
      echo "<script>alert('$mensaje'); window.location='../Vista/registro_administrador.php';</script>";          
    } else {
        $peticion=$conectar->query("CALL registro_administrador('$nombre','$apellido','$nombreU','$telefono','$password','$correo')");
        $peticion = $peticion->fetch(PDO::FETCH_ASSOC);
        $mensaje= $peticion['mensaje'];
          echo "<script>alert('$mensaje'); window.location='../Vista/registro_administrador.php';</script>";          
        }
      
   
?>                                        

     

