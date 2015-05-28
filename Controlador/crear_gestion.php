<?php
include '../Modelo/conexionPDO.php';
$conectar = new Conexion();
session_start();

$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];
$ini = $_POST['ini'];
$fin = $_POST['fin'];
$rol = $_POST['rol'];

    $sql = $conectar->prepare("call insert_gestion(:rol,:ini,:fin)");
    $sql->execute(array('rol' => $rol,'ini' => $ini,'fin' => $fin));
    $peticion = $sql->fetchAll();
    $result=$peticion[0]['errno'];
    
      echo "<script>alert('$result'); window.location='../Vista/add_gestion.php';</script>";            
    
?>