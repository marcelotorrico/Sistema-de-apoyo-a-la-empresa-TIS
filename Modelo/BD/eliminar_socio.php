<?php
    include '../conexion.php';
    
    $conectar = new conexion();
    session_start();
    $usuario = $_SESSION['usuario'];
    
    $user = isset($usuario);

if($user == ''){
    
    echo '<script>alert("Primero debe iniciar sesión para acceder al sitio");</script>';
    echo '<script>window.location="../../index.php";</script>';
}

//Crear variables--------------------------

$contrasena = $_SESSION['contrasena'];

$idgp = $_GET['id_us'];



	$peticion = $conectar->consulta(" DELETE FROM `socio` WHERE CODIGO_S='$idgp'");

         echo '<script>alert("Se elimino  correctamente");</script>';
         echo '<script>window.location="../../Vista/lista_grupoEmpresa.php";</script>';

 
?>