<?php
    include '../conexionPDO.php';
    
    $conectar = new Conexion();
    session_start();
    $usuario = $_SESSION['usuario'];

//Crear variables--------------------------

$contrasena = $_SESSION['contrasena'];

$idgp = $_GET['id_us'];
$idUrl = $_GET['url'];
$nombre = $_GET['nombre'];

    $consultaNombreLargoGE = "SELECT NOMBRE_LARGO_GE FROM grupo_empresa WHERE NOMBRE_U = '$usuario'";
    $nombreLargoConsulta = $conectar->query($consultaNombreLargoGE);
    $filaNombreLargo = $nombreLargoConsulta->fetch(PDO::FETCH_NUM);
    $nombreLargo = $filaNombreLargo[0];

    $consultaContrato="SELECT DISTINCT NOMBRE_R FROM `registro` AS r,`receptor` AS w WHERE  r.`ID_R` = w.`ID_R` AND r.`TIPO_T` LIKE 'Contrato' AND w.`RECEPTOR_R` = '$nombreLargo'";
    $contrato= $conectar->query($consultaContrato);
    $cantidadContrato= $contrato->rowCount();
      
    if($cantidadContrato != 0 ){
         echo"<script type=\"text/javascript\">alert('Usted no puede eliminar al socio porque ya se emitio un contrato. Comuniquese con su asesor.'); window.location='$idUrl';</script>";
    }else{
      
        $representanteLegal = $conectar->query("SELECT REPRESENTANTE_LEGAL_GE FROM `grupo_empresa` WHERE NOMBRE_U = '$nombre'");
        $nombreSocio = $conectar->query("SELECT NOMBRES_S FROM `socio`WHERE CODIGO_S = '$idgp'");
        $apellidoSocio = $conectar->query("SELECT APELLIDOS_S FROM `socio`WHERE CODIGO_S = '$idgp'");
        $resultadoRepresentanteLegal = $representanteLegal->fetchColumn();
        $resultadoNombreSocio = $nombreSocio->fetchColumn();
        $resultadoApellidoSocio = $apellidoSocio->fetchColumn();
        $nombreCompleto = $resultadoNombreSocio." ".$resultadoApellidoSocio;
        $peticion = $conectar->query(" DELETE FROM `socio` WHERE CODIGO_S='$idgp'");
        
        if(strcmp($nombreCompleto, $resultadoRepresentanteLegal) == 0){
            $conectar->query("UPDATE grupo_empresa SET REPRESENTANTE_LEGAL_GE = '' WHERE NOMBRE_U='$nombre'");
            echo '<script>alert("Se elimino al Representante Legal, se debera seleccionar a otro.");</script>';
        }else{
            echo '<script>alert("Se elimino  correctamente.");</script>';
        }
         echo "<script>window.location='$idUrl';</script>";
    }
?>