<?php  
    
    include '../Modelo/conexionPDO.php';
    $conectar = new Conexion();
    session_start();
  
    $nombreU = $_SESSION['usuario'];
    $nombreS = $_POST['nombre'];
    $apellidoS = $_POST['apellido'];
      
    $peticion=$conectar->query("CALL insert_socio('$nombreU','$nombreS','$apellidoS')");
    $peticion=$peticion->fetch(PDO::FETCH_ASSOC);
    
    $alerta= $peticion['errno'];

      echo "<script>alert('$alerta'); window.location='../Vista/AnadirSocio.php';</script>";            
?>    
  
     