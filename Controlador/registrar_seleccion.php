<?php

include '../Modelo/conexionPDO.php';
$conexion = new Conexion();


if(isset($_POST['registrar']))
{
    $asesor=$_POST['asesor'];
    
    if(isset($_POST['ge']))
    {
        $grupoE = $_POST['ge'];        
    }
    
   
    if($asesor == "Seleccione un Asesor")
    {
        echo"<script type=\"text/javascript\">alert('No seleccion\u00f3 ningun asesor'); window.history.back();</script>"; 
    }
    else
    {
        $seleccion = "SELECT count(*) "
                        . "FROM inscripcion "
                        . "WHERE NOMBRE_UGE='".$grupoE."'";
        $consulta = $conexion->query($seleccion);
        $cont =  $consulta->fetch(PDO::FETCH_NUM);
        $bandera=$cont[0];
        
        if($bandera == 0)
        {
            $seleccion="SELECT id_g "
                    . "FROM gestion "
                    . "WHERE DATE (NOW()) > DATE(FECHA_INICIO_G) and DATE(NOW()) < DATE(FECHA_FIN_G)";
            $consulta=$conexion->query($seleccion);
            $idGestion=$consulta->fetch(PDO::FETCH_NUM);
            $idGestion_= $idGestion[0];

            $separar = explode(' ', $asesor);
            $count = count($separar);
            $apellido = $separar[1];
            if( $count == 3)
            {
                $apellido = $apellido." ".$separar[2];
            }


            $seleccion = "SELECT nombre_u "
                    . "FROM asesor "
                    . "WHERE NOMBRES_A LIKE '". $separar[0]."' and APELLIDOS_A LIKE '".$apellido."'";
            $consulta = $conexion->query($seleccion);
            $nombre =  $consulta->fetch(PDO::FETCH_NUM);
            $nombreU = $nombre[0];

            $insertar="INSERT INTO inscripcion(NOMBRE_UA, NOMBRE_UGE, ESTADO_INSCRIPCION) VALUES ('".$nombreU."','".$grupoE."', 'Deshabilitado')";

            $conexion->query($insertar);
                    
            echo"<script type=\"text/javascript\">alert('Asesor elegido'); window.history.back();</script>";
        }
        else
        {
            echo"<script type=\"text/javascript\">alert('Usted ya eligi\u00f3 un asesor anteriormente'); window.history.back();</script>";
        }
    }
 }
?>
        
    

