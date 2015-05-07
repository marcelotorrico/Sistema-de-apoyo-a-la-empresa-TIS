<?php
session_start();
$updLogin=$_SESSION['usuario'];

$user = isset($updLogin);

if($user == ''){
    
    echo '<script>alert("Primero debe iniciar sesión para acceder al sitio");</script>';
    echo '<script>window.location="../../index.php";</script>';
}

    include '../conexion.php';
    $conectar = new conexion();
    $name = $_POST['nombreUsuario'];
    $RealName = $_POST['nombreReal'];
    $password = md5($_POST['password']);
    $emailUsuario = $_POST['email'];
    $apellidoUsuario = $_POST['apellido'];
    $telefonoUsuario = $_POST['telefono'];







//Peticion------------------------------------------
    
    $nuevoNombre = $conectar->consulta("SELECT * FROM usuario WHERE NOMBRE_U = '$name' ");
    $fila = mysql_fetch_row($nuevoNombre);
    if(!is_array($fila) || $name == $updLogin){
        
        $conectar->consulta("UPDATE usuario SET NOMBRE_U='$name',PASSWORD_U='$password',TELEFONO_U='$telefonoUsuario',CORREO_ELECTRONICO_U='$emailUsuario'
        WHERE  NOMBRE_U='$updLogin'");
        $conectar->consulta("UPDATE asesor SET NOMBRE_U='$name',NOMBRES_A='$RealName',APELLIDOS_A='$apellidoUsuario'
        WHERE  NOMBRE_U='$name'");
        $conectar->consulta("UPDATE usuario_rol SET NOMBRE_U='$name'
        WHERE  NOMBRE_U='$name'");
        
        $conectar->consulta("UPDATE noticias SET POSTEADO='$name' WHERE POSTEADO = '$updLogin'");
        $_SESSION['usuario'] = $name;

        echo"<script type=\"text/javascript\">alert('Se modificaron los datos satisfactoriamente'); window.location='../Vista/modificar_asesor.php';</script>";
    }else{
        echo"<script type=\"text/javascript\">alert('El nombre de usuario ya fue registrado, por favor cambie de nombre'); window.location='../Vista/modificar_asesor.php';</script>";  
     }



   
 
   
?>
