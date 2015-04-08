<?php
error_reporting (5); 	
include '../../../Modelo/conexion.php';

$co=new conexion();
$usuarioAse="leticia";


$aceptar=$_POST["aceptarFecha"];
$fechaIni = $_POST["fechaInicioE"];
$fechaFin = $_POST["fechaFinalE"];

$horaIni = $_POST["horaInicioE"];
$horaFin = $_POST["horaFinalE"];
$documentoR=$_POST["documentoRequerido"];
$idDocumento=0;

$fechaIniRegistrado="fechIni";
$horaIniRegistrado="horIni";
$fechaFinRegistrado="fechFin";
$horaFinRegistrado="HorFin";
//echo $documentoR.'fsdfdsf';


$registros=$co->consulta("SELECT *".
        " FROM Registro".
        " WHERE tipo_t= 'documento requerido'",$co) or
  die("Problemas en el select:".mysql_error());
if(isset($documentoR))
    {
    /**
        $SQL="SELECT fecha_inicio,hora_inicio,fecha_limite,hora_limite".
                " FROM documento_requerido".
                " WHERE titulo_documento='$documentoR' ";
     **/
        $SQL="SELECT p.fecha_inicio_pl, p.hora_inicio_pl, p.fecha_fin_pl, p.hora_fin_pl".
                " FROM plazo p, registro r, tipo t".
                " WHERE t.TIPO_T = r.TIPO_T".
                " AND p.ID_R = r.ID_R".
                " AND r.TIPO_T =  'documento requerido'".
                " AND r.nombre_r ='$documentoR'".
                " AND nombre_U='$usuarioAse'".
                " LIMIT 0 , 30";
	$registros=$co->consulta("$SQL",$co);
        while ($row = mysql_fetch_row($registros)) 
                {
                    $fechaIniRegistrado = trim($row[0]);
                    $horaIniRegistrado = trim($row[1]);
                    $fechaFinRegistrado = trim($row[2]);
                    $horaFinRegistrado = trim($row[3]);
                }
        /**
        $SQL="SELECT idDocumentoRequerido".
                " FROM documento_requerido".
                " WHERE titulo_documento='$documentoR' ";
         **/
        $SQL="SELECT id_R".
        " FROM registro".
        " WHERE nombre_r='$documentoR' ".
        " AND TIPO_T =  'documento requerido'".
        " AND nombre_U='$usuarioAse'";
                
        
	$registros=$co->consulta("$SQL",$co);
        while ($row = mysql_fetch_row($registros)) 
                {
                    $idDocumento = (Int)trim($row[0]);
                }
           
    }
if(isset($aceptar))
{
    if($idDocumento!=0)
    {    
        if(isset($fechaIni))
        {
            if(isset($horaIni))
            {
                if(isset($fechaFin))
                {
                    if(isset($horaFin))
                    {
                        /**
                        $SQL="Update documento_requerido".
                                " Set fecha_inicio='$fechaIni'".
                                "Where idDocumentoRequerido='$idDocumento'";
                        $registros=$co->consulta("$SQL",$co);
                        **/
                        echo "<SCRIPT LANGUAGE='javascript'>". 
                        " alert('Exito,la configuracion de $documentoR fue registrada exitosamente.');".
                        " document.location=('../../ConfiguracionFechasRecepcion.php');</SCRIPT>";
                        $SQL="Update plazo".
                                " Set fecha_inicio_pl='$fechaIni'".
                                "Where id_R='$idDocumento'";
                        $registros=$co->consulta("$SQL",$co);
                        
                        $SQL="Update plazo".
                                " Set hora_inicio_pl='$horaIni'".
                                "Where id_R='$idDocumento'";
                        $registros=$co->consulta("$SQL",$co);
                        
                        $SQL="Update plazo".
                                " Set fecha_fin_pl='$fechaFin'".
                                "Where id_R='$idDocumento'";
                        $registros=$co->consulta("$SQL",$co);
                        
                        $SQL="Update plazo".
                                " Set hora_fin_pl='$horaFin'".
                                "Where id_R='$idDocumento'";
                        $registros=$co->consulta("$SQL",$co);
                        
                    }    
                }    
            }    
        }    
            
        
    } 
    else 
    {
        echo "<SCRIPT LANGUAGE='javascript'>". 
                        " alert('Usted no selecciono ningun documento valido a configurar');".
                        " document.location=('../../ConfiguracionFechasRecepcion.php');</SCRIPT>";
    }
  
}
//header('Location: ../../ConfiguracionFechasRecepcion.php');  
?>