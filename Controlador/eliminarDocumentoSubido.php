<?php
 
session_start();
include '../Modelo/conexionPDO.php';
$conect = new Conexion();






//Crear variables--------------------------
$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];

error_reporting(E_ALL ^ E_NOTICE);
$idgp = $_GET['id_us'];


//conexion-------------
	
	//Peticion
    $peticion_registro =$conect->query(" SELECT ID_R , NOMBRE_R FROM `registro` WHERE NOMBRE_R ='$idgp'");
    $peticion_regis=$peticion_registro->rowCount();
    if($peticion_regis>0){
    	$fila = $peticion_registro->fetch(PDO::FETCH_NUM);
    	 $id=$fila[0];
    	 $id1=$fila[1];
    	 $ruta="../Repositorio/asesor/"."$idgp";

	unlink($ruta);
            $doc_eliminar=$conect->query(" DELETE FROM `documento` WHERE ID_R='$id'");
             $registro_eliminar = $conect->query("DELETE FROM registro WHERE ID_R = '$id' "); 
}
 
#sthash.8WXaDU1F.dpuf
	//cerrar conexion--------------------------
	 
	 //volver a la pagina---------------
         
         echo '<script>alert("Se elimino el documento correctamente");</script>';
         echo '<script>window.location="../Vista/lista_doc_subidos.php";</script>';
	
	

 
?>