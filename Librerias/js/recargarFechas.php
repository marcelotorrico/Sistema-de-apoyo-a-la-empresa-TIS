<?php
    $selecDoc=$_POST['sel'];
    $fec1="dgdgdsgf";
    $hor1;
    $fec2;
    $hor2;
include '../../Modelo/conexionPDO.php';

$co=new Conexion();
if(isset($selecDoc))
{    
    $registros=$co->query("SELECT *".
            " FROM documento_requerido") or
      die("Problemas en el select:".$co->errorInfo());

    $SQL="SELECT fecha_inicio,hora_inicio,fecha_limite,hora_limite".
                    " FROM documento_requerido".
                    " WHERE titulo_documento='$selectDoc' ";
            $registros=$co->query("$SQL");
            while ($row = $registros->fetch(PDO::FETCH_NUM)) 
                    {
                        $fec1 = trim($row[0]);
                        $hor1 = trim($row[1]);
                        $fec2 = trim($row[2]);
                        $hor2 = trim($row[3]);
                    }
            
            /**echo $hor1;
            echo $fec2;
            echo $hor2;**/
}
echo $fec1;
?>