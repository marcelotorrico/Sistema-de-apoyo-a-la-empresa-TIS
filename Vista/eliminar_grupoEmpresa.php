<?php
    include '../Modelo/conexion.php';
    $conectar = new conexion();
    session_start();

//Crear variables--------------------------

$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];

$idgp = $_GET['id_us'];



	$peticion = $conectar->consulta(" DELETE FROM `socio` WHERE CODIGO_S='$idgp'");

         echo '<script>alert("Se elimino  correctamente");</script>';
         echo '<script>window.location="../Vista/lista_grupoEmpresa.php";</script>';

 
?>