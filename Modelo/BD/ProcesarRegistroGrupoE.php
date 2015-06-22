<?php

    include '../conexionPDO.php';
    $conectar = new Conexion();
    session_start();

    $nombreUGE = htmlentities($_POST['nombreU'], ENT_QUOTES);
    $nombreLGE = htmlentities($_POST['nombreL'], ENT_QUOTES);
    $nombreCGE = htmlentities($_POST['nombreC'], ENT_QUOTES);
    $correoGE = htmlentities($_POST['correo'], ENT_QUOTES);
    $telefGE = htmlentities($_POST['telefono'], ENT_QUOTES);
    $dirGE = htmlentities($_POST['direccion'], ENT_QUOTES);
    $password = htmlentities($_POST['contrasena1'], ENT_QUOTES);
  


   $cantidadU = $conectar->query("select count(*) as cant from usuario where NOMBRE_U='$nombreUGE'");
   $cantidadU = $cantidadU->fetch(PDO::FETCH_ASSOC);
   $cantidadU = $cantidadU['cant'];
  
   $cantidadG = $conectar->query("select count(*) as cant from grupo_empresa where NOMBRE_LARGO_GE='$nombreLGE'");
   $cantidadG = $cantidadG->fetch(PDO::FETCH_ASSOC);
   $cantidadG = $cantidadG['cant'];

   $cantidadCG = $conectar->query("select count(*) as cant from grupo_empresa where NOMBRE_CORTO_GE='$nombreCGE'");
   $cantidadCG = $cantidadCG->fetch(PDO::FETCH_ASSOC);
   $cantidadCG = $cantidadCG['cant'];


    if ($cantidadU > 0) {
        $mensaje = "El nombre de usuario ya fue registrado. Por favor cambie de nombre";
        echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarGrupoEmpresa.php';</script>";
      } else {
          if ($cantidadG > 0) {
            $mensaje = "El nombre largo de grupo empresa ya fue registrado. Por favor cambie de nombre";
            echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarGrupoEmpresa.php';</script>";
          } else {
               if ($cantidadCG > 0) {
                   $mensaje = "El nombre corto de grupo empresa ya fue registrado. Por favor cambie de nombre";
                   echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarGrupoEmpresa.php';</script>";
               } else {
                        $peticion=$conectar->query("CALL registro_grupo_empresa('$nombreUGE','$telefGE','$password','$correoGE','$dirGE','$nombreLGE','$nombreCGE')");
                        //verificar que la peticion se logro exitosamente!
                        if ($peticion) {
                           $peticion=$peticion->fetch(PDO::FETCH_ASSOC);
                           $mensaje= $peticion['mensaje'];
                          echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarGrupoEmpresa.php';</script>";      
                        }
                         else{
                          $mensaje = 'El correo ya esta siendo usado en otra cuenta, por favor cambie';
                          echo "<script>alert('$mensaje'); window.location='../../Vista/RegistrarGrupoEmpresa.php';</script>";      
                         }                 
               }
          }
    }
?>