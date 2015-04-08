<?php
    $selecDoc=$_POST['sel'];
    $fec1="dgdgdsgf";
    $hor1;
    $fec2;
    $hor2;
include 'bd/conexion.php';

$co=new conexion();
if(isset($selecDoc))
{    
    $registros=$co->consulta("SELECT *".
            " FROM documento_requerido",$co) or
      die("Problemas en el select:".mysql_error());

    $SQL="SELECT fecha_inicio,hora_inicio,fecha_limite,hora_limite".
                    " FROM documento_requerido".
                    " WHERE titulo_documento='$selectDoc' ";
            $registros=$co->consulta("$SQL",$co);
            while ($row = mysql_fetch_row($registros)) 
                    {
                        $fec1 = trim($row[0]);
                        $hor1 = trim($row[1]);
                        $fec2 = trim($row[2]);
                        $hor2 = trim($row[3]);
                    }
            $co->cerrarConexion();
            
            /**echo $hor1;
            echo $fec2;
            echo $hor2;**/
}
echo $fec1;
?>