<?php

    $nombreUGE = htmlentities($_POST['nombreU'], ENT_QUOTES);
    $nombreLGE = htmlentities($_POST['nombreL'], ENT_QUOTES);
    $nombreCGE = htmlentities($_POST['nombreC'], ENT_QUOTES);
    $nombreRGE = "";
    $correoGE = htmlentities($_POST['correo'], ENT_QUOTES);
    $telefGE = htmlentities($_POST['telefono'], ENT_QUOTES);
    $dirGE = htmlentities($_POST['direccion'], ENT_QUOTES);
    //$contGE = md5($_POST['contrasena1']);
    $passwordAnterior = htmlentities($_POST['contrasena1'], ENT_QUOTES);
    $PasswordRepetido = htmlentities($_POST['contrasena2'], ENT_QUOTES);
    
    include '../conexion.php';
    require '../PHPMailerAutoload.php';
    require '../class.phpmailer.php';
    
    require '../../Controlador/ValidadorFormulario.php';
    
    $conexion = new conexion();
    
    $validar = new ValidadorFormulario();
    
    $seleccion = $conexion->consulta("SELECT NOMBRE_U FROM usuario WHERE NOMBRE_U = '$nombreUGE' ");
    $verGE = mysql_fetch_row($seleccion);
    
     if (!is_array($verGE)) 
     {
        $seleccion = $conexion->consulta("SELECT NOMBRE_CORTO_GE FROM grupo_empresa WHERE NOMBRE_CORTO_GE = '$nombreCGE' ");
        $verNC = mysql_fetch_row($seleccion);
         
        if(!is_array($verNC))
        {
            $seleccion = $conexion->consulta("SELECT NOMBRE_LARGO_GE FROM grupo_empresa WHERE NOMBRE_LARGO_GE = '$nombreLGE' ");
            $verNL = mysql_fetch_row($seleccion);
                 
             if(!is_array($verNL))
             {
                /*$db = 'tis_mbittle';
                $host = '192.168.2.5';
                $user = 'mbittle';
                $pass = '5rtZAGYq';*/
                
                $db = 'saetis';
                $host = 'localhost';
                $user = 'root';
                $pass = '';
                $conn = new PDO("mysql:dbname=".$db.";host=".$host,$user, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // iniciar transacción
                 $conn->beginTransaction();
                 
                 $booleanTelefono = $validar->verificarNumeroValido($telefGE);
                 $booleanUsuario = $validar->verificarNombreUsuario($nombreUGE);
                 $booleanContrasena = $validar->verificarContrasena($passwordAnterior);
                 $booleanVerificarContrasenas = $validar->validarContrasenas($passwordAnterior, $PasswordRepetido);
                 $booleanNombreLargo = $validar->validarNombreLargo($nombreLGE);
                 $booleanNombreCorto = $validar->validarNombreLargo($nombreCGE);
                 $booleanCorreo = $validar->validarCorreo($correoGE);
              
              if($booleanTelefono == true){
                  
                  if($booleanUsuario){
                      
                      if($booleanContrasena){
                          if($booleanVerificarContrasenas){
                              $contGE = md5($passwordAnterior);
                              
                              if($booleanNombreLargo){
                                  if($booleanNombreCorto){
                                      
                                      if($booleanCorreo){
                                    try 
                                      {
                                      $sql = 'INSERT INTO usuario (NOMBRE_U, ESTADO_E, PASSWORD_U, TELEFONO_U, CORREO_ELECTRONICO_U) VALUES (:value, :estado, :contrasena, :telefono, :correo);';
                                      $result = $conn->prepare($sql);
                                      $result->bindValue(':value', $nombreUGE, PDO::PARAM_STR);
                                      $result->bindValue(':estado', 'Habilitado', PDO::PARAM_STR);
                                      $result->bindValue(':contrasena', $contGE, PDO::PARAM_STR);
                                      $result->bindValue(':telefono', $telefGE, PDO::PARAM_STR);
                                      $result->bindValue(':correo', $correoGE, PDO::PARAM_STR);
                                      $result->execute();
                                      //$lastId = $conn->lastInsertId();
                                      $sql = 'INSERT INTO grupo_empresa (NOMBRE_U, NOMBRE_CORTO_GE, NOMBRE_LARGO_GE, DIRECCION_GE, REPRESENTANTE_LEGAL_GE) VALUES (:a_id, :nombreC, :nombreL, :direccion, :representante)';
                                      $result = $conn->prepare($sql);
                                      $result->bindValue(':a_id', $nombreUGE, PDO::PARAM_STR);
                                      $result->bindValue(':nombreC', $nombreCGE, PDO::PARAM_STR);
                                      $result->bindValue(':nombreL', $nombreLGE, PDO::PARAM_STR);
                                      $result->bindValue(':direccion', $dirGE, PDO::PARAM_STR);
                                      $result->bindValue(':representante', $nombreRGE, PDO::PARAM_STR);
                                      $result->execute();
                                       $sql = 'INSERT INTO usuario_rol (NOMBRE_U, ROL_R) VALUES (:nombre, :rol)';
                                      $result = $conn->prepare($sql);
                                      $result->bindValue(':nombre', $nombreUGE, PDO::PARAM_STR);
                                      $result->bindValue(':rol', 'grupoEmpresa', PDO::PARAM_STR);
                                      $result->execute();

                                      $conn->commit();
                                      echo"<script type=\"text/javascript\">alert('El registro ha sido satisfactorio'); window.location='../../Vista/RegistrarGrupoEmpresa.php';</script>";

                                        } catch (PDOException $e) {
                                            // si ocurre un error hacemos rollback para anular todos los insert
                                            $conn->rollback();
                                            echo $e->getMessage();
                                        }
                                      }else{
                                          echo '<script>alert("El correo es incorrecto");</script>';
                                          echo '<script>window.location="../Vista/registro_administrador.php";</script>';
                                      }
                                  }else{
                  
                                    echo '<script>alert("El nombre corto de la Grupo Empresa es muy corto");</script>';
                                    echo '<script>window.location="../../Vista/RegistrarGrupoEmpresa.php";</script>';
                                  } 
                                  
                              }else{
                  
                                echo '<script>alert("El nombre largo de la Grupo Empresa es muy corto");</script>';
                                echo '<script>window.location="../../Vista/RegistrarGrupoEmpresa.php";</script>';
                              }
                          }else{
                  
                            echo '<script>alert("Las contrasenas no coinciden");</script>';
                            echo '<script>window.location="../../Vista/RegistrarGrupoEmpresa.php";</script>';
                          }
                      }else{
                  
                        echo '<script>alert("La contrasena no cumple con lo requerido");</script>';
                        echo '<script>window.location="../../Vista/RegistrarGrupoEmpresa.php";</script>';
                      }
                  }else{
                  
                  echo '<script>alert("El nombre de usuario es incorrecto");</script>';
                  echo '<script>window.location="../../Vista/RegistrarGrupoEmpresa.php";</script>';
                }
              }else{
                  
                  echo '<script>alert("El numero de telefono es incorrecto");</script>';
                  echo '<script>window.location="../../Vista/RegistrarGrupoEmpresa.php";</script>';
              }
                
             }
             else
             {                
                echo"<script type=\"text/javascript\">alert('El nombre largo ya esta registrado'); window.location='../../Vista/RegistrarGrupoEmpresa.php';</script>";
             }
             
         }
         else
         {
                echo"<script type=\"text/javascript\">alert('El nombre corto ya esta registrado'); window.location='../../Vista/RegistrarGrupoEmpresa.php';</script>";
         }
         
     }
     else
     {
        echo"<script type=\"text/javascript\">alert('El nombre de usuario ya esta registrado'); window.location='../../Vista/RegistrarGrupoEmpresa.php';</script>";
     }
    
?>