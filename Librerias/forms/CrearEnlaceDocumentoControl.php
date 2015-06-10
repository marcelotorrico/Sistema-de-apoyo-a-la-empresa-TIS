<?php
include("../../Modelo/conexionPDO.php");
 error_reporting (5);
  $clas = new Conexion();


//$a=$_POST["aceptarA"];
$b=$_POST["aceptarB"];
$fechaS= $_POST["daterangepicker_end_input"];

$nombreDocumento = $_POST["nombreDocumento"]; 
$nombreDocumento = $_POST["descripcionDocumento"]; 
$fecha1 = $_POST["fechaIni"];
$fecha2 = $_POST["fechaFin"];

$hora1 = $_POST["horaIni"];
$hora2 = $_POST["horaFin"];

$var=1;
echo ("$fechaS");
$reg="";
$registros=$clas->query("select * from tarea") or
  die("Problemas en el select:".$co->errorInfo());
if(isset($b))
{
	
	
		/**$registros=$co->query("INSERT INTO tarea (id_T, 
		nombre_T,fecha_publicacion_T,hora_Publicacion_T,fecha_limite_T,
		USUARIO_id_U) 
		VALUES ('$var++', 'Propuesta A',null,null,'$fecha1','$hora1','1')") and
		$registros=$co->query("INSERT INTO tarea (id_T, 
		nombre_T,fecha_publicacion_T,hora_Publicacion_T,fecha_limite_T,
		USUARIO_id_U) 
		VALUES ('$var++', 'Propuesta B',null,null,'$fecha2','$hora2','1')") or
  		die("Problemas en el select:".$co->errorInfo());**/
  		$SQL="Update tarea Set fecha_Limite_T='$fecha1' Where id_T='1'";
		$registros=$clas->query("$SQL"); 
		
		$SQL="Update tarea Set hora_Limite_T='$hora1' Where id_T='1'";
		$registros=$clas->query("$SQL");
		
		$SQL="Update tarea Set fecha_Limite_T='$fecha2' Where id_T='2'";
		$registros=$clas->query("$SQL"); 
		
		$SQL="Update tarea Set hora_Limite_T='$hora2' Where id_T='2'";
		$registros=$clas->query("$SQL");
		
  

	

}
?>

