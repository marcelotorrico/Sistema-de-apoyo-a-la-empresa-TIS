<?php
    include '../conexion.php';
    include '../../Controlador/ValidadorFormulario.php';
    session_start();

    $conexion = new conexion();
    $nombreUGE = $_SESSION['usuario'];

    $nombreUsuario = $_POST['nombreU'];
    $nombreLargo = $_POST['nombreL'];
    $nombreCorto = $_POST['nombreC'];
    $correo = $_POST['correo'];
    $telef = $_POST['telefono'];
    $direc = $_POST['direccion'];
    $contrasena = $_POST['contrasena1'];
    

    $nuevoNombre = $conexion->consulta("SELECT * FROM usuario WHERE NOMBRE_U = '$nombreUsuario' ");
    $fila = mysql_fetch_row($nuevoNombre);
    if(!is_array($fila) || $nombreUsuario == $nombreUGE){
        $validador = new ValidadorFormulario();
        $actualizar = FALSE;
        if(strcmp($_SESSION['contrasena'],$contrasena)!==0){
            if(!$validador->verificarContrasena($contrasena)){
                echo "<script type=\"text/javascript\">alert('Ingrese una contrase\u00f1a segura, debe tener al menos una letra mayuscula, una minuscula, un numero y un caracter especial. El numero de caracteres como minimo debe ser 7 y como maximo 16.'); window.location='../../Vista/ModificarGrupoEmpresa.php';</script>";
            }else{
                $contrasena=  md5($contrasena);
                $actualizar = TRUE;
            }
        }
        if($actualizar || strcmp($contrasena, $_SESSION['contrasena'])==0){
            $conexion->consulta(" UPDATE usuario SET PASSWORD_U='$contrasena', TELEFONO_U='$telef', CORREO_ELECTRONICO_U='$correo', NOMBRE_U='$nombreUsuario' WHERE NOMBRE_U = '$nombreUGE'");
            $conexion->consulta(" UPDATE grupo_empresa SET NOMBRE_CORTO_GE='$nombreCorto', NOMBRE_LARGO_GE='$nombreLargo', DIRECCION_GE='$direc', NOMBRE_U='$nombreUsuario' WHERE NOMBRE_U = '$nombreUsuario'");

            $conexion->consulta("UPDATE noticias SET POSTEADO='$nombreUsuario' WHERE POSTEADO = '$nombreUGE'");
            $_SESSION['usuario'] = $nombreUsuario;

            echo"<script type=\"text/javascript\">alert('Se modificaron los datos satisfactoriamente'); window.location='../../Vista/ModificarGrupoEmpresa.php';</script>";
        }       
    }else{
        echo"<script type=\"text/javascript\">alert('El nombre de usuario ya fue registrado, por favor cambie de nombre'); window.location='../../Vista/ModificarGrupoEmpresa.php';</script>";  
    }
         
?>