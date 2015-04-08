<?php

session_start();
include '../Modelo/conexion.php';
$conectar = new conexion();
//Crear variables--------------------------

$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];
$addNomMenu = $_POST['id_menu'];
$addasesor = $_POST['id_rol'];


//conexion-------------

	$peticion = $conectar->consulta("INSERT INTO `permisos` (`ROL_R`, `id_permiso`, `menu_id_menu`) VALUES ('$addasesor',NULL, '$addNomMenu');");
	//cerrar conexion--------------------------
	 //volver a la pagina---------------
	 echo'
	<html>
		<head>
			<meta http-equiv="REFRESH" content="0;url=lista_roles.php">
		</head>
	</html>';

 
?>