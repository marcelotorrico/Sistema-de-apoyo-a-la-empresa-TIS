<?php

    session_start();
    include '../Modelo/conexion.php';
    
    require '../Controlador/ValidadorTelefonoUsuario.php';
    
    $conectar = new conexion();
    
    $validar = new ValidadorTelefonoUsuario();

//Crear variables--------------------------


$contador = 0;

$addUsuario = $_POST['usuario'];
$addContra = $_POST['contrasena'];
$addNombre = $_POST['nombre'];
$addApellido = $_POST['apellido'];
$addTelefono = $_POST['telefono'];
$addEmail= $_POST['email'];




//comprobar si el usuario Existe

$peticion1 =$conectar ->consulta("SELECT * FROM usuario");
$peticion2 = $conectar ->consulta("SELECT * FROM usuario_rol");
$peticion3 = $conectar ->consulta("SELECT * FROM asesor");
	
        
    $conect = new conexion();
    
    $verificarUGE = $conect->consulta("SELECT NOMBRE_U FROM usuario WHERE NOMBRE_U = '$addUsuario' ");
    $verificarUGE2 = mysql_fetch_row($verificarUGE);
    
     if (!is_array($verificarUGE2)) 
      {
         
//conexion-------------		
         
         $boolean = $validar->verificarNumeroValido($addTelefono);
              
              if($boolean == true){
                  
                  $peticion1 = $conectar ->consulta("INSERT INTO `usuario` (`NOMBRE_U`, `ESTADO_E`, `PASSWORD_U`, `TELEFONO_U`, `CORREO_ELECTRONICO_U`) VALUES ('$addUsuario', 'Habilitado', '$addContra', '$addTelefono', '$addEmail');");
                  $peticion2 = $conectar ->consulta("INSERT INTO `usuario_rol` (`NOMBRE_U`, `ROL_R`) VALUES ('$addUsuario', 'administrador');");
                  $peticion3 = $conectar ->consulta("INSERT INTO `administrador` (`NOMBRE_U`, `NOMBRES_AD`, `APELLIDOS_AD`) VALUES ('$addUsuario', '$addNombre ', '$addApellido');");

                     //cerrar conexion--------------------------

                     //volver a la pagina---------------

                  echo"<script type=\"text/javascript\">alert('El registro se realizo exitosamente'); window.location='registro_administrador.php';</script>";
              }else{
                  
                  echo '<script>alert("El numero de telefono es incorrecto");</script>';
                  echo '<script>window.location="../Vista/registro_administrador.php";</script>';
              }
      }else{
     
        echo"<script type=\"text/javascript\">alert('El nombre de usuario ya fue registrado por favor cambie de nombre'); window.location='registro_administrador.php';</script>";  
     }

