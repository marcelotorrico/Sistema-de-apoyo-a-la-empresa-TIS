<?php

    include '../conexion.php';
    $conectar = new conexion();
    session_start();

    $nombreUGE = htmlentities($_POST['nombreU'], ENT_QUOTES);
    $nombreLGE = htmlentities($_POST['nombreL'], ENT_QUOTES);
    $nombreCGE = htmlentities($_POST['nombreC'], ENT_QUOTES);
    $correoGE = htmlentities($_POST['correo'], ENT_QUOTES);
    $telefGE = htmlentities($_POST['telefono'], ENT_QUOTES);
    $dirGE = htmlentities($_POST['direccion'], ENT_QUOTES);
    $password = htmlentities($_POST['contrasena1'], ENT_QUOTES);


    $peticion=$conectar->consultaProcedimiento("CALL registro_grupo_empresa('$nombreUGE','$telefGE','$password','$correoGE','$dirGE','$nombreLGE','$nombreCGE')");
    
    $mensaje= $peticion['mensaje'];

      echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarGrupoEmpresa.php';</script>";            
?>