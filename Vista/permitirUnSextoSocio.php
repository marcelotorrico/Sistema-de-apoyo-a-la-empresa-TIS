<?php 
  include '../Modelo/conexionPDO.php';
  $conexion = new Conexion();
  session_start();
 
  $empresa = $_GET['GE'];
 

  $peticion = $conexion->query("SELECT NUM_SOCIOS as cantidad FROM grupo_empresa WHERE NOMBRE_U = '$empresa'");
  $cant = $peticion->fetch(PDO::FETCH_ASSOC);
  $resultado= $cant['cantidad'];

      
      if ($resultado < 6) {
      	
      	$conexion->query("UPDATE grupo_empresa SET NUM_SOCIOS=6 WHERE  NOMBRE_U='$empresa'");
        echo"<script>alert('Se concedio el permiso para registrar un sexto socio'); window.location='../Vista/AdministrarGrupoEmpresa.php';</script>";
  
      } else {
        
         echo"<script>alert('La grupo empresa ya cuenta con el permiso para registrar un sexto socio'); window.location='../Vista/AdministrarGrupoEmpresa.php';</script>";           	
         
      }
    
 ?>