<?php
    include '../conexion.php';
    
    require '../../Controlador/ValidadorInicioSesion.php';
    
    $conectar = new conexion();
    session_start();
    $usuario = $_SESSION['usuario'];
    
    $verificar = new ValidadorInicioSesion();
    $verificar->validarInicioSesion($usuario);

//Crear variables--------------------------

$contrasena = $_SESSION['contrasena'];

$idgp = $_GET['id_us'];



	$peticion = $conectar->consulta(" DELETE FROM `socio` WHERE CODIGO_S='$idgp'");

         echo '<script>alert("Se elimino  correctamente");</script>';
         echo '<script>window.location="../Vista/lista_grupoEmpresa.php";</script>';

 
?>