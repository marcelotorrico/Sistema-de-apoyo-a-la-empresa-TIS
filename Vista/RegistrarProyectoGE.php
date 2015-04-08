<?php

include '../Modelo/conexion.php';
session_start();
$conect = new conexion();
$nombreU = $_SESSION['usuario'];

if (isset($_POST['proyecto'])) {
    
    $VerificarIns= $conect->consulta("SELECT NOMBRE_U FROM inscripcion_proyecto WHERE NOMBRE_U = '$nombreU' ");
    $VerificarIns2 = mysql_fetch_row($VerificarIns);
    if (!is_array($VerificarIns2))
    {
        $proyecto = $_REQUEST['proyecto'];
        if(strnatcasecmp($proyecto, "Seleccione un proyecto")!=0)
        {
            $consulta="SELECT `CODIGO_P` FROM `proyecto` WHERE `NOMBRE_P` = '$proyecto'";            
            $con= $conect->consulta($consulta);
            $res =  mysql_fetch_array($con);
            $codProy = $res[0]; 

            $conect->consulta("INSERT INTO inscripcion_proyecto(CODIGO_P, NOMBRE_U, ESTADO_CONTRATO) VALUES('$codProy','$nombreU','Sin Firmar')"); 
            $conect->consulta("INSERT INTO planificacion(NOMBRE_U, ESTADO_E, FECHA_INICIO_P, FECHA_FIN_P) VALUES ('$nombreU', 'registrar planificacion', '2014-12-12', '2020-12-12')");


            echo"<script type=\"text/javascript\">alert('Su inscripcion a sido satisfactoria'); window.location='../Vista/inicio_grupo_empresa.php';</script>";  

        }
        else{        
           echo"<script type=\"text/javascript\">alert('Por favor, seleccione un proyecto'); window.location='../Vista/InscripcionGEProyecto.php';</script>";  
        }
    }
    else{
          echo"<script type=\"text/javascript\">alert('Usted ya se registro a un proyecto'); window.location='../Vista/InscripcionGEProyecto.php';</script>";  
        
    }
    
}

?>

