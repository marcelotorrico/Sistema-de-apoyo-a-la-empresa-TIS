<?php
include '../Modelo/conexionPDO.php';
$conectar = new Conexion();
session_start();

$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];
$ini = $_POST['ini'];
$fin = $_POST['fin'];
$rol = $_POST['rol'];

     

    $peticion = $conectar->query("call insert_gestion(:rol,:ini,:fin)",array('rol' => $rol,'ini' => $ini,'fin' => $fin)) ;
    $peticion = $peticion->fetchAll();
    $result=$peticion[0]['errno'];
    
      echo "<script>alert('$result'); window.location='../Vista/add_gestion.php';</script>";            
    
?>