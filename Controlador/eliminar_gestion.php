<?php
    include '../Modelo/conexionPDO.php';
    $conectar = new Conexion();
    session_start();
    $codigo='';

//Crear variables--------------------------

$usuario= $_SESSION['usuario'];
$contrasena= $_SESSION['contrasena'];

$delRol = $_GET['id_us'];
$peticion1 = $conectar->query("SELECT CODIGO_P FROM proyecto WHERE ID_G='".$delRol."'");
        while ($codp = $peticion1->fetch(PDO::FETCH_ASSOC))
        {        
        $codigo=$codp["CODIGO_P"];      
        }
        $peticion2 = $conectar->query("DELETE FROM proyecto WHERE CODIGO_P ='".$codigo."' AND ID_G ='".$delRol."'");
        $peticion3 = $conectar->query("DELETE FROM gestion WHERE ID_G='".$delRol."'");

         echo '<script>alert("Se elimino  correctamente");</script>';
         echo '<script>window.location="../Vista/add_gestion.php";</script>';
?>