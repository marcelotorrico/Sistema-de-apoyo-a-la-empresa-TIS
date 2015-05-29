<?php

session_start();

//Crear variables--------------------------

$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];
include '../Modelo/conexionPDO.php';

$conectar = new Conexion();

$rolAnt=$_SESSION["Variable1"];
$idgp=$_SESSION["Variable2"];
$permiso = $_REQUEST['estado'];



	$peticion = $conectar->query( "UPDATE usuario SET ESTADO_E = '$permiso' WHERE usuario.NOMBRE_U = '$idgp';");
	 echo'
	<html>
		<head>
			<meta http-equiv="REFRESH" content="0;url=../Vista/asignar_permisos.php">
		</head>
	</html>';


?>