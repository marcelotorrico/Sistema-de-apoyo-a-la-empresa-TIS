<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Modelo/conexion.php';

function LimpiaEspacios($CadenaConMuchosEspacios)
{

$CadenaConMuchosEspacios= trim($CadenaConMuchosEspacios); //Aqui eliminamos todos los espacios que estan antes y despues de la cadena

$CadenaRegulada= ereg_replace( ' +', ' ', $CadenaConMuchosEspacios); //Mediante expresiones regulares sustituimos los bloques de más de un espacio por un espacio sencillo
$CadenaRegulada2=  ereg_replace('([.]+)', '.', $CadenaRegulada);
return $CadenaRegulada2; //El básico return de una función
}


$nombre=  LimpiaEspacios($_POST['nombre']);
$nombreCorto=  LimpiaEspacios($_POST['nombreCorto']);
//$nombreAsesor=$_POST['nombreAsesor'];
//$nombreGrupo=$_POST['nombreGrupo'];
date_default_timezone_set('America/La_Paz');
$fecha=  date('Y-m-d');
$hora=  date("G:H:i");

$conexion= new conexion();
$consulta=$conexion->consulta("SELECT NOMBRE_LARGO,NOMBRE_CORTO FROM lista_ge");
$existe=FALSE;
$existe2=FALSE;
while ($fila=  mysql_fetch_array($consulta))
{
    if($nombre== $fila[0] || $nombre == $fila[1])
    {
        $existe=TRUE;
    }
    if($nombreCorto==$fila[1] || $nombre == $fila[0])
    {
        $existe2=TRUE;
    }
    
    $auxiliarNombreLargo=$fila['0'];
    $auxiliarNombreCorto=$fila['1'];
    
    
    if (strpos(strtolower($nombre), strtolower($auxiliarNombreLargo)) !== FALSE) {
        $existe=TRUE;
    }
    
    if (strpos(strtolower($nombreCorto), strtolower($auxiliarNombreCorto)) !== FALSE) {
        $existe2=TRUE;
    }
}
if ($existe== TRUE && $existe2==TRUE)
{
    echo"<script type=\"text/javascript\">alert('El nombre largo: $nombre no est\u00e1 disponible.... \\n\\n El nombre corto: $nombreCorto no est\u00e1 disponible....'); window.history.back();</script>";
}
if ($existe== TRUE && $existe2==FALSE)
{
    echo"<script type=\"text/javascript\">alert('El nombre largo: $nombre no est\u00e1 disponible.... \\n\\n El nombre corto: $nombreCorto est\u00e1 disponible....'); window.history.back();</script>";
}

if ($existe== FALSE && $existe2==TRUE)
{
    echo"<script type=\"text/javascript\">alert('El nombre largo: $nombre est\u00e1 disponible.... \\n\\n El nombre corto: $nombreCorto no est\u00e1 disponible....'); window.history.back();</script>";
}
if ($existe== FALSE && $existe2==FALSE)
{
    echo"<script type=\"text/javascript\">alert('El nombre largo: $nombre est\u00e1 disponible.... \\n\\n El nombre corto: $nombreCorto est\u00e1 disponible....'); window.history.back();</script>";
}

$conexion->cerrarConexion();
?>
