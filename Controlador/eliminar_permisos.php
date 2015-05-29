<?php
    include '../Modelo/conexionPDO.php';
    $con=new Conexion();
    session_start();


//Crear variables--------------------------

$usuario= $_SESSION['usuario'];
$contrasena= $_SESSION['contrasena'];

$delRol = $_GET['id_us'];

//Peticion
$peticion = $con->query("DELETE FROM `permisos` WHERE id_permiso=$delRol");
//cerrar conexion--------------------------

 //volver a la pagina---------------
 echo'
<html>
	<head>
		<meta http-equiv="REFRESH" content="0;url=../Vista/lista_roles.php">
	</head>
</html>

';
?>