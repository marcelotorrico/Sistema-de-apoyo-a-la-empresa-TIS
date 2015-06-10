<?php
include '../../../Modelo/conexionPDO.php';
//header('Location: ../../CrearModalidadEvaluacion.php');
$textDescripcionD=$_POST["descripcionDocumento"];
$Agregar=$_POST["btnCrearModalidad"];
$co=new Conexion();
$idCrit=1;
$idReg=1;
$fechaAhora="";
$horaAhora="";
$existeCampo="vacio";
$usuarioActivo="leticia";
$registros=$co->query("select * from criterio_evaluacion") or
  die("Problemas en la consulta:".mysql_error());
if(isset($Agregar))
{
                
  		$SQL="SELECT MAX(ID_C_E) AS id FROM criterio_evaluacion";
		$registros=$co->query("$SQL"); 
                while ($row = $registros->fetch(PDO::FETCH_NUM)) 
                {
                    $idCrit = (Int)trim($row[0]);
                    $idCrit=$idCrit+1;
                }
                $SQL="SELECT MAX(ID_R) AS id FROM registro";
		$registros=$co->query("$SQL"); 
                while ($row = $registros->fetch(PDO::FETCH_NUM)) 
                {
                    $idReg = (Int)trim($row[0]);
                    $idReg=$idReg+1;
                }
                
                 $SQL="SELECT CURDATE() AS fecha FROM registro GROUP BY fecha";
		$registros=$co->query("$SQL"); 
                while ($row = $registros->fetch(PDO::FETCH_NUM)) 
                {
                    $fechaAhora = trim($row[0]);                    
                }
                
                $SQL="SELECT CURTIME() AS hora FROM registro GROUP BY hora";
		
                $registros=$co->query("$SQL"); 
               
                while ($row = $registros->fetch(PDO::FETCH_NUM)) 
                {
                    $horaAhora = ($row[0]);                    
                }
                
                 $SQL= "SELECT criterio_e".
                          " FROM criterio_evaluacion". 
                          " WHERE criterio_e =  '$textDescripcionD'";
                  $registros=$co->query("$SQL");
                    while ($row = $registros->fetch(PDO::FETCH_NUM)) 
                    {
                        $existeCampo = $row[0];
                    }

                
                if ($existeCampo == "vacio")
                {                   
                    $SQL= "insert into registro values".
                    "('$idReg', '$usuarioActivo','criterio evaluacion','habilitado','criterio_evaluacion_$idCrit','$fechaAhora','$horaAhora')"; 
                    $registros=$co->query("$SQL");
                    $SQL= "insert into criterio_evaluacion values".
                    "('$idReg','$idCrit','$textDescripcionD')"; 
                    $registros=$co->query("$SQL");
                    
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

