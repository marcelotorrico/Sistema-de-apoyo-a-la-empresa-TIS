<?php  
    
    include '../Modelo/conexionPDO.php';
    $conectar = new Conexion();
    session_start();
  
    $nombreU = $_SESSION['usuario'];
    $nombreS = $_POST['nombre'];
    $apellidoS = $_POST['apellido'];
      
    $consultaNombreLargoGE = "SELECT NOMBRE_LARGO_GE FROM grupo_empresa WHERE NOMBRE_U = '$nombreU'";
    $nombreLargoConsulta = $conectar->query($consultaNombreLargoGE);
    $filaNombreLargo = $nombreLargoConsulta->fetch(PDO::FETCH_NUM);
    $nombreLargo = $filaNombreLargo[0];

    $consultaContrato="SELECT DISTINCT NOMBRE_R FROM `registro` AS r,`receptor` AS w WHERE  r.`ID_R` = w.`ID_R` AND r.`TIPO_T` LIKE 'Contrato' AND w.`RECEPTOR_R` = '$nombreLargo'";
    $contrato= $conectar->query($consultaContrato);
    $cantidadContrato= $contrato->rowCount();
      
    if($cantidadContrato != 0 ){
         echo"<script type=\"text/javascript\">alert('Usted no puede agregar a mas socios porque ya se emitio un contrato.'); window.location='../Vista/AnadirSocio.php';</script>";
    }else{
        
        $peticion=$conectar->query("CALL insert_socio('$nombreU','$nombreS','$apellidoS')");
        $peticion=$peticion->fetch(PDO::FETCH_ASSOC);

        $alerta= $peticion['errno'];

        echo "<script>alert('$alerta'); window.location='../Vista/AnadirSocio.php';</script>";
    }
?>    
  
     