<?php
    include '../Modelo/conexion.php';
    $conectar = new conexion();
    session_start();


$usuario= $_SESSION['usuario'];
$contrasena= $_SESSION['contrasena'];

$delRol = $_GET['id_us'];

//Peticion
$peticion = $conectar->consulta("DELETE FROM rol WHERE ROL_R='".$delRol."'");
//cerrar conexion--------------------------

 //volver a la pagina---------------
         echo '<script>alert("Se elimino  correctamente");</script>';
         echo '<script>window.location="../Vista/add_roles.php";</script>';
?>