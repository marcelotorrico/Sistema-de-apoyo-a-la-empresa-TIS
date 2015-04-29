<?php  
    
    include '../Modelo/conexion.php';
    $conectar = new conexion();
    session_start();
  
    $nombreU = $_SESSION['usuario'];
    $nombreS = $_POST['nombre'];
    $apellidoS = $_POST['apellido'];
      
    $conect = new conexion();

    $peticion=$conectar->consultaProcedimiento("CALL insert_socio('$nombreU','$nombreS','$apellidoS')");
    
    $alerta= $peticion['errno'];

      echo "<script>alert('$alerta'); window.location='../Vista/AnadirSocio.php';</script>";            
?>    
  
     