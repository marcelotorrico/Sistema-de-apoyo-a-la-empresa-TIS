<?php

    $nombreUsuario = $_POST['nombreUsuario'];
   
    $password = $_POST['password'];
    
    echo $nombreUsuario;
    echo $password;

    include '../Modelo/conexion.php';
   
    
    $conect = new conexion();
   
    $VerificarUsuario = $conect->consulta("SELECT NOMBRE_U FROM usuario WHERE NOMBRE_U = '$nombreUsuario' AND PASSWORD_U = '$password'") ;
    
    $VerificarUsuario2 = mysql_fetch_row($VerificarUsuario);

    //var_dump($VerificarUsuario2);
    
    
    if (is_array($VerificarUsuario2)) {
        
        $VerificarEstado = $conect->consulta("SELECT ESTADO_E FROM usuario WHERE NOMBRE_U = '$nombreUsuario' AND ESTADO_E = 'habilitado' ");
        $VerificarEstado2 = mysql_fetch_row($VerificarEstado);

        //var_dump($VerificarEstado2);
        
        if (is_array($VerificarEstado2)) {
            
            $VerificarRol = $conect->consulta("SELECT ROL_R FROM usuario_rol WHERE NOMBRE_U = '$nombreUsuario'");
            $VerificarRol2 = mysql_fetch_row($VerificarRol);

            var_dump($VerificarRol2);
            
            
            if($VerificarRol2 == "GrupoEmpresa")
            {
                session_start();
                session_name($nameUsuario);
                header('location:inicio_grupo_empresa.php');
                
            }
            
            if($VerificarRol2 == "Asesor")
            {
                session_start();
                session_name($nameUsuario);
                 header('location:inicio_asesor.php');
                
            }
            if($VerificarRol2[0] == "administrador")

                echo "asdg";
            {
                // session_start();
                 //session_name($nameUsuario);
                 header('location:principal.php');
                
            }
            
            
            
            
        
        }
        
        
      
    }
   
?>

