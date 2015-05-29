<?php
include '../Modelo/conexionPDO.php';
$conect = new Conexion();
session_start();



$usuario = $_SESSION['usuario'];

$idAdmin = $_GET['id_us'];

	
	//Eliminar de la base de datos
	$rolAdmin =$conect->query (" DELETE FROM `usuario_rol` WHERE NOMBRE_U ='$idAdmin'");
	$adminis =$conect->query(" DELETE FROM `administrador` WHERE NOMBRE_U ='$idAdmin'");
	$usuarios = $conect->query(" DELETE FROM `usuario` WHERE NOMBRE_U='$idAdmin'");

         
         echo '<script>alert("Se elimino al administrador correctamente");</script>';
         echo '<script>window.location="../Vista/lista_administradores.php";</script>';
	
 
?>