<?php
 
session_start();
include_once '../Modelo/conexionPDO.php';
$conect = new Conexion();






//Crear variables--------------------------
$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];

require 'ValidadorInicioSesion.php';

$verificar = new ValidadorInicioSesion();
$verificar->validarInicioSesion($usuario,"asesor");

error_reporting(E_ALL ^ E_NOTICE);
$idgp = $_GET['id_us'];


 $peticion_registro =$conect->query(" SELECT ID_R FROM `documento` WHERE RUTA_D ='$idgp'");
$peticion_regis=$peticion_registro->rowCount();
if($peticion_regis>0){
    	$fila = $peticion_registro->fetch(PDO::FETCH_NUM);
    	
    	 $id=$fila[0];
    	 
    	    $doc_eliminar=$conect->query(" DELETE FROM `descripcion` WHERE ID_R='$id'");
            $doc_eliminar=$conect->query(" DELETE FROM `documento` WHERE ID_R='$id'");
            $receptor_c=$conect->query(" DELETE FROM `receptor` WHERE ID_R='$id'");
             $registro_eliminar = $conect->query("DELETE FROM registro WHERE ID_R = '$id' "); 

//conexion-------------
	
	//Peticion
   

	unlink($idgp);
        
 }
#sthash.8WXaDU1F.dpuf
	//cerrar conexion--------------------------
	 
	 //volver a la pagina---------------
         
         echo '<script>alert("Se elimino el documento correctamente");</script>';
         echo '<script>window.location="../Vista/documentos_generados.php";</script>';
	


 
?>