<?php
 
session_start();
include '../Modelo/conexionPDO.php';
$conect = new Conexion();


//Crear variables--------------------------
$usuario = $_SESSION['usuario'];

error_reporting(E_ALL ^ E_NOTICE);
$idPubli = $_GET['id_us'];


//conexion-------------
	
	//Peticion
    $selRegis =$conect->query(" SELECT ID_R  FROM `registro` WHERE NOMBRE_R ='$idPubli'");
    $tamRegis=$selRegis->rowCount();
    if($tamRegis>0){
    	$filaRegi = $selRegis->fetch(PDO::FETCH_NUM);
    	 $idRegis=$filaRegi[0];
    	
                    $delDes=$conect->query(" DELETE FROM `descripcion` WHERE ID_R='$idRegis'");
                    $delDoc=$conect->query(" DELETE FROM `documento` WHERE ID_R='$idRegis'");
                    $delPerio = $conect->query("DELETE FROM periodo WHERE ID_R = '$idRegis' ");
                    $delPlazo = $conect->query("DELETE FROM plazo WHERE ID_R = '$idRegis' ");
                    $delRecep = $conect->query("DELETE FROM receptor WHERE ID_R = '$idRegis' ");
                    $delRegis= $conect->query("DELETE FROM registro WHERE ID_R = '$idRegis' ");
           
 

	//cerrar conexion--------------------------
	 
	 //volver a la pagina---------------
         
         echo '<script>alert("Se elimino el documento correctamente");</script>';
         echo '<script>window.location="../Vista/publicaciones.php";</script>';}
	
	

 
?>