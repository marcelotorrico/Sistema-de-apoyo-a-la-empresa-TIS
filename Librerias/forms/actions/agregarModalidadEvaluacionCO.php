<?php
include '../../../Modelo/conexion.php';
//header('Location: ../../CrearModalidadEvaluacion.php');
$textDescripcionD=$_POST["descripcionDocumento"];
$Agregar=$_POST["btnCrearModalidad"];
$co=new conexion();
$idCrit=1;
$idReg=1;
$fechaAhora="";
$horaAhora="";
$existeCampo="vacio";
$usuarioActivo="leticia";
$registros=$co->consulta("select * from criterio_evaluacion",$co) or
  die("Problemas en la consulta:".mysql_error());
if(isset($Agregar))
{
                
  		$SQL="SELECT MAX(ID_C_E) AS id FROM criterio_evaluacion";
		$registros=$co->consulta("$SQL",$co); 
                while ($row = mysql_fetch_row($registros)) 
                {
                    $idCrit = (Int)trim($row[0]);
                    $idCrit=$idCrit+1;
                }
                $SQL="SELECT MAX(ID_R) AS id FROM registro";
		$registros=$co->consulta("$SQL",$co); 
                while ($row = mysql_fetch_row($registros)) 
                {
                    $idReg = (Int)trim($row[0]);
                    $idReg=$idReg+1;
                }
                
                 $SQL="SELECT CURDATE() AS fecha FROM registro GROUP BY fecha";
		$registros=$co->consulta("$SQL",$co); 
                while ($row = mysql_fetch_row($registros)) 
                {
                    $fechaAhora = trim($row[0]);
                    
                }
                
                $SQL="SELECT CURTIME() AS hora FROM registro GROUP BY hora";
		
                $registros=$co->consulta("$SQL",$co); 
               
                while ($row = mysql_fetch_row($registros)) 
                {
                    $horaAhora = ($row[0]);
                    
                }
                
                 $SQL= "SELECT criterio_e".
                          " FROM criterio_evaluacion". 
                          " WHERE criterio_e =  '$textDescripcionD'";
                  $registros=$co->consulta("$SQL",$co);
                    while ($row = mysql_fetch_row($registros)) 
                    {
                        $existeCampo = $row[0];

                    }

                
                if ($existeCampo == "vacio")
                {    
                   
                    $SQL= "insert into registro values".
                    "('$idReg', '$usuarioActivo','criterio evaluacion','habilitado','criterio_evaluacion_$idCrit','$fechaAhora','$horaAhora')"; 
                    $registros=$co->consulta("$SQL",$co);
                    $SQL= "insert into criterio_evaluacion values".
                    "('$idReg','$idCrit','$textDescripcionD')"; 
                    $registros=$co->consulta("$SQL",$co);
                    
                    echo "<SCRIPT LANGUAGE='javascript'>". 
                        " alert('Se ha registrado satisfactoriamente el criterio_evaluacion_$idCrit . ');".
                        " document.location=('../../CrearModalidadEvaluacion.php');</SCRIPT>";
                }
                else 
                {
                    echo "<SCRIPT LANGUAGE='javascript'>". 
                        " alert('EL criterio que ingreso ya se encuentra registrado. ');".
                        " document.location=('../../CrearModalidadEvaluacion.php');</SCRIPT>";
                }
}
?>

