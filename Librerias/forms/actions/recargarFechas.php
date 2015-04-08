<?php
    $selecDoc=$_POST['sel'];
    $fec1="No registrado";
    $hor1="No registrado";
    $fec2="No registrado";
    $hor2="No registrado";
include '../../../Modelo/conexion.php';

$co=new conexion();
if(isset($selecDoc))
{    
    $registros=$co->consulta("SELECT *".
        " FROM Registro".
        " WHERE tipo_t= 'documento requerido'",$co) or
         die("Problemas en el select:".mysql_error());

    
    
    $SQL="SELECT p.fecha_inicio_pl, p.hora_inicio_pl, p.fecha_fin_pl, p.hora_fin_pl".
                " FROM plazo p, registro r, tipo t".
                " WHERE t.TIPO_T = r.TIPO_T".
                " AND p.ID_R = r.ID_R".
                " AND r.TIPO_T =  'documento requerido'".
                " AND r.nombre_r ='$selecDoc'".
                " LIMIT 0 , 30";
            $registros=$co->consulta("$SQL",$co);
            while ($row = mysql_fetch_row($registros)) 
                    {
                        $fec1 = ($row[0]);
                        $hor1 = ($row[1]);
                        $fec2 = ($row[2]);
                        $hor2 = ($row[3]);
                    }
            $co->cerrarConexion();
            
            /**echo $hor1;
            echo $fec2;
            echo $hor2;**/
}
echo $fec1;
echo $hor1;
echo $fec2;
echo $hor2;
?>