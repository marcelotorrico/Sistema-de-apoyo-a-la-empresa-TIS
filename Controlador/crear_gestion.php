<?php
include '../Modelo/conexionPDO.php';
$conectar = new conexion();
session_start();

$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];
$ini = $_POST['ini'];
$fin = $_POST['fin'];
$rol = $_POST['rol'];

     

    $peticion = $conectar->consultaP("call insert_gestion(:rol,:ini,:fin)",array('rol' => $rol,'ini' => $ini,'fin' => $fin)) ;
    $result=$peticion[0]['errno'];
    
      echo "<script>alert('$result'); window.location='../Vista/add_gestion.php';</script>";            
    
?>