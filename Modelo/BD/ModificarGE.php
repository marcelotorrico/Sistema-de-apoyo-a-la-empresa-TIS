<?php
    include '../conexion.php';
    session_start();

    $conexion = new conexion();
    $nombreUGE = $_SESSION['usuario'];

    $nombreUsuario = $_POST['nombreU'];
    $nombreLargo = $_POST['nombreL'];
    $nombreCorto = $_POST['nombreC'];
    $correo = $_POST['correo'];
    $telef = $_POST['telefono'];
    $direc = $_POST['direccion'];
    $contrasena = md5($_POST['contrasena1']);

    $nuevoNombre = $conexion->consulta("SELECT * FROM usuario WHERE NOMBRE_U = '$nombreUsuario' ");
    $fila = mysql_fetch_row($nuevoNombre);
    if(!is_array($fila) || $nombreUsuario == $nombreUGE){
        
        $conexion->consulta(" UPDATE usuario SET PASSWORD_U='$contrasena', TELEFONO_U='$telef', CORREO_ELECTRONICO_U='$correo', NOMBRE_U='$nombreUsuario' WHERE NOMBRE_U = '$nombreUGE'");
        $conexion->consulta(" UPDATE grupo_empresa SET NOMBRE_CORTO_GE='$nombreCorto', NOMBRE_LARGO_GE='$nombreLargo', DIRECCION_GE='$direc', NOMBRE_U='$nombreUsuario' WHERE NOMBRE_U = '$nombreUsuario'");

        $conexion->consulta("UPDATE noticias SET POSTEADO='$nombreUsuario' WHERE POSTEADO = '$nombreUGE'");
        $_SESSION['usuario'] = $nombreUsuario;
        
        echo"<script type=\"text/javascript\">alert('Se modificaron los datos satisfactoriamente'); window.location='../../Vista/ModificarGrupoEmpresa.php';</script>";
    }else{
        echo"<script type=\"text/javascript\">alert('El nombre de usuario ya fue registrado, por favor cambie de nombre'); window.location='../../Vista/ModificarGrupoEmpresa.php';</script>";  
     }
         
?>