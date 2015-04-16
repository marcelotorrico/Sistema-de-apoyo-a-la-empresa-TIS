<?php
    include '../conexion.php';
    $conect = new conexion();
    session_start();
  
    $nombreU = $_SESSION['usuario']  ;
    
    require '../../Controlador/ValidadorInicioSesion.php';

    $verificar = new ValidadorInicioSesion();
    $verificar->validarInicioSesion($nombreU);

    $nombreUS = $_POST['nombreU'];
    $nombreS = $_POST['nombre'];
    $apellidoS = $_POST['apellido'];
    $contrasenaS = $_POST['contrasena1'];

    

    $conect->consulta(" UPDATE socio SET NOMBRES_S='$nombreS', APELLIDOS_S='$apellidoS', PASSWORD_S='$contrasenaS' WHERE LOGIN_S = '$nombreU'");

    echo"<script type=\"text/javascript\">alert('La modificacion ha sido satisfactoria'); window.location='../../Vista/ModificarSocio.php';</script>";
                   
         
     
  
    ?>