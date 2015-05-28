<?php
    include '../conexionPDO.php';
    
    $conectar = new Conexion();
    session_start();
    $usuario = $_SESSION['usuario'];

//Crear variables--------------------------

$contrasena = $_SESSION['contrasena'];

$idgp = $_GET['id_us'];

	$peticion = $conectar->query(" DELETE FROM `socio` WHERE CODIGO_S='$idgp'");

         echo '<script>alert("Se elimino  correctamente");</script>';
         echo '<script>window.location="../../Vista/lista_grupoEmpresa.php";</script>';
?>