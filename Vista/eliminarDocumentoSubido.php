<?php
 
session_start();
include '../Modelo/conexion.php';
$conect = new conexion();






//Crear variables--------------------------
$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];
error_reporting(E_ALL ^ E_NOTICE);
$idgp = $_GET['id_us'];


//conexion-------------
	
	//Peticion
    $peticion_registro =$conect->consulta(" SELECT ID_R , NOMBRE_R FROM `registro` WHERE NOMBRE_R ='$idgp'");
    $peticion_regis=mysql_num_rows($peticion_registro);
    if($peticion_regis>0){
    	$fila = mysql_fetch_array($peticion_registro);
    	 $id=$fila[0];
    	 $id1=$fila[1];
    	 $ruta="../Repositorio/asesor/"."$idgp";

	unlink($ruta);
            $doc_eliminar=$conect->consulta(" DELETE FROM `documento` WHERE ID_R='$id'");
             $registro_eliminar = $conect->consulta("DELETE FROM registro WHERE ID_R = '$id' "); 
}
 
#sthash.8WXaDU1F.dpuf
	//cerrar conexion--------------------------
	 
	 //volver a la pagina---------------
         
         echo '<script>alert("Se elimino el documento correctamente");</script>';
         echo '<script>window.location="../Vista/lista_doc_subidos.php";</script>';
	
	

 
?>