<?php
    include '../conexionPDO.php';
    include '../../Controlador/ValidadorFormulario.php';
    session_start();

    $conexion = new Conexion();
    $nombreUGE = $_SESSION['usuario'];

    $nombreUsuario = $_POST['nombreU'];
    $nombreLargo = $_POST['nombreL'];
    $nombreCorto = $_POST['nombreC'];
    $correo = $_POST['correo'];
    $telef = $_POST['telefono'];
    $direc = $_POST['direccion'];
    $contrasena = $_POST['contrasena1'];
    

    $nuevoNombre = $conexion->query("SELECT * FROM usuario WHERE NOMBRE_U = '$nombreUsuario' ");
    $fila = $nuevoNombre->fetch(PDO::FETCH_NUM);
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
            $conexion->query(" UPDATE usuario SET PASSWORD_U='$contrasena', TELEFONO_U='$telef', CORREO_ELECTRONICO_U='$correo', NOMBRE_U='$nombreUsuario' WHERE NOMBRE_U = '$nombreUGE'");
            $conexion->query(" UPDATE grupo_empresa SET NOMBRE_CORTO_GE='$nombreCorto', NOMBRE_LARGO_GE='$nombreLargo', DIRECCION_GE='$direc', NOMBRE_U='$nombreUsuario' WHERE NOMBRE_U = '$nombreUsuario'");

            $conexion->query("UPDATE noticias SET POSTEADO='$nombreUsuario' WHERE POSTEADO = '$nombreUGE'");
            $_SESSION['usuario'] = $nombreUsuario;
            $_SESSION['contrasena'] = $contrasena;

            echo"<script type=\"text/javascript\">alert('Se modificaron los datos satisfactoriamente'); window.location='../../Vista/ModificarGrupoEmpresa.php';</script>";
        }       
    }else{
        echo"<script type=\"text/javascript\">alert('El nombre de usuario ya fue registrado, por favor cambie de nombre'); window.location='../../Vista/ModificarGrupoEmpresa.php';</script>";  
    }
?>