<?php
    $selecDoc=$_POST['sel'];
    $fec1="No registrado";
    $hor1="No registrado";
    $fec2="No registrado";
    $hor2="No registrado";
include '../../../Modelo/conexionPDO.php';

$co=new Conexion();
if(isset($selecDoc))
{    
    $registros=$co->query("SELECT *".
        " FROM Registro".
        " WHERE tipo_t= 'documento requerido'") or
         die("Problemas en el select:".$co->errorInfo());

    
    
    $SQL="SELECT p.fecha_inicio_pl, p.hora_inicio_pl, p.fecha_fin_pl, p.hora_fin_pl".
                " FROM plazo p, registro r, tipo t".
                " WHERE t.TIPO_T = r.TIPO_T".
                " AND p.ID_R = r.ID_R".
                " AND r.TIPO_T =  'documento requerido'".
                " AND r.nombre_r ='$selecDoc'".
                " LIMIT 0 , 30";
            $registros=$co->query("$SQL");
            while ($row = $registros->fetch(PDO::FETCH_NUM)) 
                    {
                        $fec1 = ($row[0]);
                        $hor1 = ($row[1]);
                        $fec2 = ($row[2]);
                        $hor2 = ($row[3]);
                    }
            
            /**echo $hor1;
            echo $fec2;
            echo $hor2;**/
}
echo $fec1;
echo $hor1;
echo $fec2;
echo $hor2;
?>