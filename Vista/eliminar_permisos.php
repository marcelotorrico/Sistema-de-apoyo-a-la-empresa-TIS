<?php
    include '../Modelo/conexion.php';
    $con=new conexion();
    session_start();


//Crear variables--------------------------

$usuario= $_SESSION['usuario'];
$contrasena= $_SESSION['contrasena'];

$delRol = $_GET['id_us'];

//Peticion
$peticion = $con->consulta("DELETE FROM `permisos` WHERE id_permiso=$delRol");
//cerrar conexion--------------------------

 //volver a la pagina---------------
 echo'
<html>
	<head>
		<meta http-equiv="REFRESH" content="0;url=lista_roles.php">
	</head>
</html>

';
?>