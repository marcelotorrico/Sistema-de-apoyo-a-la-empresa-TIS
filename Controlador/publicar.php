<?php
header('Location: http://localhost/ProyectoSprint3/Vista/publicar_asesor.php'); 
	require_once('../Modelo/publicacion_class.php');
	
	

	
	if(isset($_POST["enviar"])){
	
	if(isset($_POST["campoTitulo"])){
	$titulo      = $_POST["campoTitulo"];
	$descripcion   = $_POST["campoDescripcion"];
	$ruta        = $_POST["recurso"];
	$fecha       = date('Y-m-d');
	$hora        =  date("G:H:i");
	
		}
	}
	
$publicacion = new Publicacion('leticia','publicaciones','habilitado',$titulo,$fecha,$hora,1024,$ruta,TRUE,TRUE,$descripcion);
	
			 
	
	

?>