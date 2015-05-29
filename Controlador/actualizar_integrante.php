<?php
session_start();
     include '../Modelo/conexionPDO.php';
     include 'ValidadorFormulario.php';
     $conectar = new Conexion();
     
 
 //Crear variables--------------------------
 
 
 $usuario=$_SESSION['usuario'];
 
 $updLogin = $_POST['login'];
 $updPassword = ($_POST['password']);
 $updNombre = $_POST['nombre'];
 $updApellido = $_POST['apellido'];
 $updTelefono = $_POST['telefono'];
 $updEmail= $_POST['email'];
 //conexion-------------
 
 //Peticion
 //Peticion------------------------------------------
 
 $nuevoNombre = $conectar->query("SELECT * FROM usuario WHERE NOMBRE_U = '$updLogin' ");
 $fila = $nuevoNombre->fetch(PDO::FETCH_NUM);
 if(!is_array($fila) || $updLogin == $usuario){
     
     $validador = new ValidadorFormulario();
        $actualizar = FALSE;
        if(strcmp($_SESSION['contrasena'],$updPassword)!==0){
            if(!$validador->verificarContrasena($updPassword)){
                echo "<script type=\"text/javascript\">alert('Ingrese una contrase\u00f1a segura, debe tener al menos una letra mayuscula, una minuscula, un numero y un caracter especial. El numero de caracteres como minimo debe ser 7 y como maximo 16.'); window.location='../Vista/modificar_administrador.php';</script>";
            }else{
                $updPassword=  md5($updPassword);
                $actualizar = TRUE;
            }
        }
        if($actualizar || strcmp($updPassword, $_SESSION['contrasena'])==0){
            
            $conectar->query("UPDATE usuario SET NOMBRE_U='$updLogin',PASSWORD_U='$updPassword',TELEFONO_U='$updTelefono',CORREO_ELECTRONICO_U='$updEmail'
            WHERE  NOMBRE_U='$usuario'");
            $conectar->query("UPDATE administrador SET NOMBRE_U='$updLogin',NOMBRES_AD='$updNombre',APELLIDOS_AD='$updApellido'
            WHERE  NOMBRE_U='$updLogin'");
            $conectar->query("UPDATE usuario_rol SET NOMBRE_U='$updLogin'
            WHERE  NOMBRE_U='$updLogin'");

            $_SESSION['usuario'] = $updLogin;
            $_SESSION['contrasena'] = $updPassword;

           echo"<script type=\"text/javascript\">alert('Se modificaron los datos satisfactoriamente'); window.location='../Vista/modificar_administrador.php';</script>";
        }
 }else{
        echo"<script type=\"text/javascript\">alert('El nombre de usuario ya fue registrado, por favor cambie de nombre'); window.location='../Vista/modificar_administrador.php';</script>";  
     }
 
  
 ?>