<?php
session_start();
$updLogin=$_SESSION['usuario'];

$user = isset($updLogin);

if($user == ''){
    
    echo '<script>alert("Primero debe iniciar sesión para acceder al sitio");</script>';
    echo '<script>window.location="../../index.php";</script>';
}

    include '../conexion.php';
    include '../../Controlador/ValidadorFormulario.php';
    $conectar = new conexion();
    $name = $_POST['nombreUsuario'];
    $RealName = $_POST['nombreReal'];
    $password = $_POST['password'];
    $emailUsuario = $_POST['email'];
    $apellidoUsuario = $_POST['apellido'];
    $telefonoUsuario = $_POST['telefono'];







//Peticion------------------------------------------
    
    $nuevoNombre = $conectar->consulta("SELECT * FROM usuario WHERE NOMBRE_U = '$name' ");
    $fila = mysql_fetch_row($nuevoNombre);
    if(!is_array($fila) || $name == $updLogin){
        $validador = new ValidadorFormulario();
        $actualizar = FALSE;
        if(strcmp($_SESSION['contrasena'],$password)!==0){
            if(!$validador->verificarContrasena($password)){
                echo "<script type=\"text/javascript\">alert('Ingrese una contrase\u00f1a segura, debe tener al menos una letra mayuscula, una minuscula, un numero y un caracter especial. El numero de caracteres como minimo debe ser 7 y como maximo 16.'); window.location='../Vista/modificar_asesor.php';</script>";
            }else{
                $password=  md5($password);
                $actualizar = TRUE;
            }
        }
        if($actualizar || strcmp($password, $_SESSION['contrasena'])==0){
            $conectar->consulta("UPDATE usuario SET NOMBRE_U='$name',PASSWORD_U='$password',TELEFONO_U='$telefonoUsuario',CORREO_ELECTRONICO_U='$emailUsuario'
            WHERE  NOMBRE_U='$updLogin'");
            $conectar->consulta("UPDATE asesor SET NOMBRE_U='$name',NOMBRES_A='$RealName',APELLIDOS_A='$apellidoUsuario'
            WHERE  NOMBRE_U='$name'");
            $conectar->consulta("UPDATE usuario_rol SET NOMBRE_U='$name'
            WHERE  NOMBRE_U='$name'");

            $conectar->consulta("UPDATE noticias SET POSTEADO='$name' WHERE POSTEADO = '$updLogin'");
            $_SESSION['usuario'] = $name;

            echo"<script type=\"text/javascript\">alert('Se modificaron los datos satisfactoriamente'); window.location='../Vista/modificar_asesor.php';</script>";
        }
        }else{
        echo"<script type=\"text/javascript\">alert('El nombre de usuario ya fue registrado, por favor cambie de nombre'); window.location='../Vista/modificar_asesor.php';</script>";  
     }



   
 
   
?>
