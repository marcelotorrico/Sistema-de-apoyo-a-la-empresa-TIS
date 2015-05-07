<?php

    $Name = htmlentities($_POST['nombreUsuario'], ENT_QUOTES);
    $RealName = htmlentities($_POST['nombreReal'], ENT_QUOTES);
    //$Pass = md5($_POST['password']);
    $PasswordAnterior = htmlentities($_POST['password'], ENT_QUOTES);
    $PasswordRepetido = htmlentities($_POST['contrasena2'], ENT_QUOTES);
    $Email = htmlentities($_POST['email'], ENT_QUOTES);
    $rol = htmlentities($_POST['UsuarioRol'], ENT_QUOTES);
    $Apellido = htmlentities($_POST['apellido'], ENT_QUOTES);
    $Telefono = htmlentities($_POST['telefono'], ENT_QUOTES);

    include '../conexion.php';
    require '../PHPMailerAutoload.php';
    require '../class.phpmailer.php';
    
    require '../../Controlador/ValidadorFormulario.php';
    
    $conect = new conexion();
    $mail = new PHPMailer();
    
    $validar = new ValidadorFormulario();

    $Sel_U = $conect->consulta("SELECT NOMBRE_U FROM usuario WHERE NOMBRE_U = '$Name' ");
    $Sel_U2 = mysql_fetch_row($Sel_U);
    /////////////////////////////////////////////////////////////////////////////////////////////////
  

    $mystring = $Email;
    $findme1   = 'hotmail';
    $findme2   = 'gmail';
    $findme3   = 'yahoo';
    $pos1 = strpos($mystring, $findme1);
    $pos2 = strpos($mystring, $findme2);
    $pos3 = strpos($mystring, $findme3);
    if ($pos1 === false) 
    {
        if($pos2 === false)
        {
            if($pos3 === false)
                {
                 $numeroCorreo=0;
                }
            else
               {
                 $numeroCorreo=1;
               }
        }
        else
        {
           $numeroCorreo=1;
        }
         
    
    } 
    else 
    {
    $numeroCorreo=1;
    }

    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    if($numeroCorreo=="1")
    {
     if (!is_array($Sel_U2)) 
     {
              
              $booleanTelefono = $validar->verificarNumeroValido($Telefono);
              $booleanUsuario = $validar->verificarNombreUsuario($Name);
              $booleanContrasena = $validar->verificarContrasena($PasswordAnterior);
              $booleanVerificarContrasenas = $validar->validarContrasenas($PasswordAnterior, $PasswordRepetido);
              $booleanNombreReal = $validar ->validarNombre($RealName);
              $booleanApellido = $validar->validarNombre($Apellido);
              $booleanCorreo = $validar->validarCorreo($Email);
              
              if($booleanTelefono){
                  
                  if($booleanUsuario){
                      
                      if($booleanContrasena){
                          if($booleanVerificarContrasenas){
                          
                                $Pass = md5($PasswordAnterior);
                                
                                if($booleanNombreReal){
                                    
                                    if($booleanApellido){
                                        
                                        if($booleanCorreo){

                                        $conect->consulta("INSERT INTO usuario(NOMBRE_U, ESTADO_E, PASSWORD_U, TELEFONO_U, CORREO_ELECTRONICO_U) VALUES('$Name','Deshabilitado','$Pass','$Telefono','$Email')"); 

                                        $conect->consulta("INSERT INTO asesor(NOMBRE_U, NOMBRES_A, APELLIDOS_A) VALUES('$Name','$RealName','$Apellido')");  
                                        $conect->consulta("INSERT INTO usuario_rol(NOMBRE_U, ROL_R) VALUES('$Name','$rol')");  
                                        $conect->consulta("INSERT INTO criteriocalificacion(NOMBRE_U,NOMBRE_CRITERIO_C,TIPO_CRITERIO) VALUES('$Name','PUNTAJE','4')");

                                        echo '<script>alert("Su solicitud se envio correctamente");</script>';
                                        echo '<script>window.location="../../index.php";</script>';
                                        }else{
                                          echo '<script>alert("El correo es incorrecto");</script>';
                                          echo '<script>window.location="../Vista/registro_administrador.php";</script>';
                                      }
                                    }else{
                          
                                        echo '<script>alert("Su apellido es incorrecto");</script>';
                                        echo '<script>window.location="../../Vista/RegistrarUsuario.php";</script>';
                                    }
                                }else{
                          
                                    echo '<script>alert("Su nombre es incorrecto");</script>';
                                    echo '<script>window.location="../../Vista/RegistrarUsuario.php";</script>';
                                }
                          }else{
                          
                            echo '<script>alert("La contrasena no coinciden");</script>';
                            echo '<script>window.location="../../Vista/RegistrarUsuario.php";</script>';
                      }
                      }else{
                          
                          echo '<script>alert("La contrasena no cumple con lo requerido");</script>';
                          echo '<script>window.location="../../Vista/RegistrarUsuario.php";</script>';
                      }
                  }else{
                      
                      echo '<script>alert("El nombre de usuario es incorrecto");</script>';
                      echo '<script>window.location="../../Vista/RegistrarUsuario.php";</script>';
                  }
              }else{
                  
                  echo '<script>alert("El numero de telefono es incorrecto");</script>';
                  echo '<script>window.location="../../Vista/RegistrarUsuario.php";</script>';
              }
         // }
    }else{


        echo '<script>alert("El nombre de usuario ya esta registrado");</script>';
        echo '<script>window.location="../../Vista/RegistrarUsuario.php";</script>';
        

    }
    }
    else
    {
        echo '<script>alert("Correo Ingresado no Valido");</script>';
        echo '<script>window.location="../../Vista/RegistrarUsuario.php";</script>';
    }
    
?>
