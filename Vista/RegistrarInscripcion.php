<?php
    include '../Modelo/conexion.php';
    $conect = new conexion();
    session_start();
  
    $nombreU = $_SESSION['usuario']  ;
    $codigoProyecto;

    
//Relacion entre gestion y proyecto, 1 gestion n proyectos
    $conect->consulta(" UPDATE inscripcion SET CODIGO_P='$codigoProyecto' WHERE NOMBRE_UA = '$nombreU'");

    echo"<script type=\"text/javascript\">alert('El registro ha sido satisfactorio'); window.location='ModificarSocio.php';</script>";
                   
         
     
  
    ?>