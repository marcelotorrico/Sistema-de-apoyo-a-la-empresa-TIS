<?php

session_start();
include '../Modelo/conexionPDO.php';
$conectar = new conexion();
//Crear variables--------------------------

$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];

$nomMenu = $_POST['id_menu'];
$asesor = $_POST['id_rol'];


//conexion-------------

	$peticion = $conectar->consultaP("INSERT INTO permisos VALUES (nomMenu,nul,asesor)",array('Nombre' => $nomMenu,'nul' => NULL,'asesor' => $asesor));
  
   
	//cerrar conexion--------------------------
	 //volver a la pagina---------------
	 echo'
	<html>
		<head>
			<meta http-equiv="REFRESH" content="0;url=../Vista/lista_roles.php">
		</head>
	</html>';

 
?>