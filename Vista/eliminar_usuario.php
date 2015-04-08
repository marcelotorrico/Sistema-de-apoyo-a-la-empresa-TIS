<?php
    include '../Modelo/conexion.php';
    $conectar = new conexion();
    session_start();



$usuario= $_SESSION['usuario'];
$contrasena= $_SESSION['contrasena'];

$delActiv = $_GET['id_us'];
$rol = $conectar->consulta("SELECT ROL_R
FROM usuario_rol 
WHERE  NOMBRE_U = '$usuario' ");
//Peticion
$peticion = $conectar->consulta("DELETE FROM sesion WHERE grupo_empresa.NOMBRE_U = '$delActiv'");
$peticion = $conectar->consulta ("DELETE FROM asesor WHERE asesor.NOMBRE_U ='$delActiv'");
$peticion = $conectar->consulta ("DELETE FROM usuario_rol WHERE usuario_rol.NOMBRE_U ='$delActiv' AND usuario_rol.ROL_R ='$rol'");
$peticion = $conectar->consulta ("DELETE FROM usuario WHERE usuario.NOMBRE_U = '$delActiv'");
$peticion = $conectar->consulta ("DELETE FROM grupo_empresa WHERE grupo_empresa.NOMBRE_U = '$delActiv'");
//cerrar conexion--------------------------

 //volver a la pagina---------------
 echo'
<html>
	<head>
		<meta http-equiv="REFRESH" content="0;url=lista_usuarios.php">
	</head>
</html>';
?>

