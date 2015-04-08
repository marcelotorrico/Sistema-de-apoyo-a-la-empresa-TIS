<?php

    include '../Modelo/conexion.php';
    $conectar = new conexion();
    session_start();
    
    $usuario= $_POST['usuario'];
    $contrasena= $_POST['contrasena'];
    $permiso="administrador";
    $permiso2="asesor";
    $permiso3="grupoEmpresa";
    
    
    
    $hora = date("h:i:s");
    $fecha= date ("Y-m-d");
 

    @$ip = getenv(REMOTE_ADDR);
    $navegador = $_SERVER["HTTP_USER_AGENT"];
    
    
    $peticion =$conectar->consulta("SELECT u.NOMBRE_U,u.ESTADO_E, u.PASSWORD_U, r.ROL_R FROM usuario u, usuario_rol r
    WHERE u.NOMBRE_U=r.NOMBRE_U");

    while(($fila = mysql_fetch_array($peticion)))
    {

            $usuariobd=$fila['NOMBRE_U'];
            $estadobd=$fila['ESTADO_E'];
            $contrasenabd=$fila['PASSWORD_U'];
            $permisosenbase = $fila['ROL_R'];   

            if($usuario == $usuariobd && $contrasena == $contrasenabd && $permiso==$permisosenbase && "Habilitado" == $estadobd )
            {   
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['contrasena'] = $contrasena;
                    $_SESSION['administrador'] = $permisosenbase;
                    $peticion1 = $conectar->consulta("INSERT INTO `sesion` (`ID_S`, `NOMBRE_U`, `FECHA_S`, `HORA_S`, `IP_S`)" . " VALUES (NULL, '$usuario', '$fecha', '$hora', '$ip');");
                    echo'<html><head><meta http-equiv="REFRESH" content="0;url=principal.php"></head></html>';
                  
            }
            else
            {
                    if($usuario == $usuariobd && $contrasena == $contrasenabd && $permiso2==$permisosenbase && "Habilitado" == $estadobd )
                    {   
                            $_SESSION['usuario'] = $usuario;
                            $_SESSION['contrasena'] = $contrasena;
                            $_SESSION['asesor'] = $permisosenbase;
                            $peticion1 = $conectar->consulta("INSERT INTO `sesion` (`ID_S`, `NOMBRE_U`, `FECHA_S`, `HORA_S`, `IP_S`)" . " VALUES (NULL, '$usuario', '$fecha', '$hora', '$ip');");
                            echo'<html><head><meta http-equiv="REFRESH" content="0;url=inicio_asesor.php"></head></html>';
                        
                    }  
                    else
                    {
                        if($usuario == $usuariobd && $contrasena == $contrasenabd && $permiso3==$permisosenbase && "Habilitado" == $estadobd )
                        {   
                            $_SESSION['usuario'] = $usuario;
                            $_SESSION['contrasena'] = $contrasena;
                            $_SESSION['grupoEmpresa'] = $permisosenbase;
                            $peticion1 = $conectar->consulta("INSERT INTO `sesion` (`ID_S`, `NOMBRE_U`, `FECHA_S`, `HORA_S`, `IP_S`)" . " VALUES (NULL, '$usuario', '$fecha', '$hora', '$ip');");
                            echo'<html><head><meta http-equiv="REFRESH" content="0;url=inicio_grupo_empresa.php"></head></html>';
                            
                        }
                        else
                        {
                            echo'<html><head><meta http-equiv="REFRESH" content="1;url=../index.php"></head></html>';
                        }


                    }

             }

    }


?>
