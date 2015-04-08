<?php
 
session_start();
include '../Modelo/conexion.php';
$conect = new conexion();






//Crear variables--------------------------
$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];
error_reporting(E_ALL ^ E_NOTICE);
$idgp = $_GET['id_us'];


 $peticion_registro =$conect->consulta(" SELECT ID_R FROM `documento` WHERE RUTA_D ='$idgp'");
$peticion_regis=mysql_num_rows($peticion_registro);
if($peticion_regis>0){
    	$fila = mysql_fetch_row($peticion_registro);
    	
    	 $id=$fila[0];
    	 
    	    $doc_eliminar=$conect->consulta(" DELETE FROM `descripcion` WHERE ID_R='$id'");
            $doc_eliminar=$conect->consulta(" DELETE FROM `documento` WHERE ID_R='$id'");
            $receptor_c=$conect->consulta(" DELETE FROM `receptor` WHERE ID_R='$id'");
             $registro_eliminar = $conect->consulta("DELETE FROM registro WHERE ID_R = '$id' "); 

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