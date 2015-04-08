<?php

include '../Modelo/conexion.php';
session_start();
$conect = new conexion();
         $userAct = $_SESSION['usuario'];
         $grupo=$_POST['grupoempresa'];
       
	
	if(isset($_POST["enviar"])){
            $titulo      = $_POST["campoTitulo"];
            $desDoc  = $_POST["campoDescripcion"];
            $fechap   = $_POST["fecha1"];
            $horap        = $_POST["hora1"];
            $rutap        = $_POST["recurso"];
            
            $eshora=strftime($horap).":00";

            $fecha       = date('Y-m-d');
            $hora        =  date("G:H:i");
            
            $visualizable="TRUE";
            $descargable="TRUE";	
	}
        echo $eshora."</br>";
	echo $fechap;
	//echo $horap;		 
	$comentario_add = $conect->consulta("INSERT INTO registro (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R) VALUES ('$userAct','publicaciones','Habilitado','$titulo','$fecha','$hora')")or
			die("Error al s");
//var_dump($comentario_add);
	$query= $conect->consulta("SELECT MAX(ID_R) AS 'ID_R' FROM registro");
 if ($row = mysql_fetch_row($query)) 
 {
   $idDoc = trim($row[0]);
 }
 
 $guardar_doc = $conect->consulta("INSERT INTO documento (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D)
		VALUES('$idDoc','1024','$rutap','TRUE','TRUE')");
 $des_D=$conect->consulta("INSERT INTO descripcion (ID_R,DESCRIPCION_D)
		VALUES('$idDoc','$desDoc')");
  $destinatario=$conect->consulta("INSERT INTO receptor (ID_R,RECEPTOR_R)
		VALUES('$idDoc','$grupo')");
$guardar = $conect->consulta("INSERT INTO periodo (ID_R,fecha_p,hora_p) VALUES ('$idDoc','$fechap','$horap')") or
			die("Error al s");

        header("location:../Vista/publicar_asesor.php");
	
?>