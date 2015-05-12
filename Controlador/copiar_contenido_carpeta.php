<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Modelo/conexion.php';
function copiar($idAsesor)
{
    $con = new conexion();
    $consulta=$con->consulta("SELECT DISTINCT r.`NOMBRE_R`,d.`RUTA_D` FROM `registro` AS r,`documento` AS d WHERE d.`ID_R` = r.`ID_R` AND r.`TIPO_T` LIKE 'documento subido' AND r.`NOMBRE_U` IN (SELECT ge.`NOMBRE_U` FROM `inscripcion` AS i,`asesor` AS a,`grupo_empresa` AS `ge`,`gestion` AS g,`proyecto` AS p WHERE i.`NOMBRE_UA` = a.`NOMBRE_U` AND i.`NOMBRE_UGE` = ge.`NOMBRE_U` AND i.`ID_G` = g.`ID_G` AND i.`CODIGO_P` = p.`CODIGO_P` AND a.`NOMBRE_U` LIKE '$idAsesor')");
    $rutaDirectorioTemporal="../Repositorio/temporal";
    if(!file_exists($rutaDirectorioTemporal))
    {
        mkdir($rutaDirectorioTemporal);
    }
    
    while ($filas = mysql_fetch_array($consulta)) {
        
        try {
            
            copy("..".$filas['1'], "$rutaDirectorioTemporal/".$filas['0']);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
    }
}


function eliminarDir($carpeta)
{
foreach(glob($carpeta . "/*") as $archivos_carpeta)
{
//echo $archivos_carpeta;
 
if (is_dir($archivos_carpeta))
{
eliminarDir($archivos_carpeta);
}
else
{
unlink($archivos_carpeta);
}
}
 
rmdir($carpeta);
}
?>