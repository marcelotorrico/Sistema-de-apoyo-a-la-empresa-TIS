<?php 
  include '../Modelo/conexion.php';
  $conexion = new conexion();
  session_start();
 
  $empresa = $_GET['GE'];
 

  $peticion = $conexion->consulta("SELECT NUM_SOCIOS as cantidad FROM grupo_empresa WHERE NOMBRE_U = '$empresa' ");
  $cant = mysql_fetch_array($peticion);
  $resultado= $cant['cantidad'];
      
      if ($resultado < 6) {
      	
      	$conexion->consulta("UPDATE grupo_empresa SET NUM_SOCIOS=6 WHERE  NOMBRE_U='$empresa'");
        $mensaje ="Se concedio el permiso para registrar un sexto socio a $empresa";
        echo"<script>alert($mensaje); window.location='../Vista/AdministrarGrupoEmpresa.php';</script>";
      } else {
        $mensaje = "$empresa ya tiene permiso para registrar un sexto socio";
         echo"<script>alert($mensaje); window.location='../Vista/AdministrarGrupoEmpresa.php';</script>";           	
      }
      
 ?>