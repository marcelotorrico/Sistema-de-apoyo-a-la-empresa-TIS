 <?php
     include '../Modelo/conexion.php';
     $conectar = new conexion();
     session_start();
 
 //Crear variables--------------------------
 
 
 $usuario=$_SESSION['usuario'];
 
 $updLogin = $_POST['login'];
 $updPassword = md5($_POST['password']);
 $updNombre = $_POST['nombre'];
 $updApellido = $_POST['apellido'];
 $updTelefono = $_POST['telefono'];
 $updEmail= $_POST['email'];
 //conexion-------------
 
 //Peticion
 //Peticion------------------------------------------
 
 $nuevoNombre = $conectar->consulta("SELECT * FROM usuario WHERE NOMBRE_U = '$updLogin' ");
 $fila = mysql_fetch_row($nuevoNombre);
 if(!is_array($fila)){
 
    $conectar->consulta("UPDATE usuario SET NOMBRE_U='$updLogin',PASSWORD_U='$updPassword',TELEFONO_U='$updTelefono',CORREO_ELECTRONICO_U='$updEmail'
    WHERE  NOMBRE_U='$usuario'");
    $conectar->consulta("UPDATE administrador SET NOMBRE_U='$updLogin',NOMBRES_AD='$updNombre',APELLIDOS_AD='$updApellido'
    WHERE  NOMBRE_U='$updLogin'");
    $conectar->consulta("UPDATE usuario_rol SET NOMBRE_U='$updLogin'
    WHERE  NOMBRE_U='$updLogin'");

    $_SESSION['usuario'] = $updLogin;

   echo"<script type=\"text/javascript\">alert('Se modificaron los datos satisfactoriamente'); window.location='../Vista/principal.php';</script>";
 }else{
        echo"<script type=\"text/javascript\">alert('El nombre de usuario ya fue registrado, por favor cambie de nombre'); window.location='../Vista/modificar_administrador.php';</script>";  
     }
 
  
 ?>