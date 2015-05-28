<?php
    include '../Modelo/conexionPDO.php';
    session_start();
    
    $nombreU = $_SESSION['usuario'];

    $conexion = new Conexion();
    
    $consulta = $conexion->query("SELECT REPRESENTANTE_LEGAL_GE FROM grupo_empresa WHERE NOMBRE_U = '$nombreU' ");
    $repL = $consulta->fetch(PDO::FETCH_NUM);
    
    if(strcmp($repL[0],"")!=0)
    {
        echo"<script type=\"text/javascript\">alert('Usted ya registro un representante legal'); window.location='../Vista/AnadirRL.php';</script>";
    }
    else
    {
        $nomRL = $_REQUEST['repLegal'];
        if(strnatcasecmp($nomRL, "Seleccione un representante legal")!=0)
        {
               $conexion->query(" UPDATE grupo_empresa SET REPRESENTANTE_LEGAL_GE='$nomRL' WHERE NOMBRE_U = '$nombreU'");
               echo"<script type=\"text/javascript\">alert('Se registro satisfactoriamente'); window.location='../Vista/AnadirRL.php';</script>";
     
        }
        else
        {
            echo"<script type=\"text/javascript\">alert('Por favor, seleccione un representante legal'); window.location='../Vista/AnadirRL.php';</script>";
     
        }
     }

    ?>