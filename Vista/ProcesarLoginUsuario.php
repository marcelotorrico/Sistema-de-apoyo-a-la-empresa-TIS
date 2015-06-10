<?php

    $nombreUsuario = $_POST['nombreUsuario'];
   
    $password = $_POST['password'];
    
    echo $nombreUsuario;
    echo $password;

    include '../Modelo/conexionPDO.php';
   
    
    $conect = new Conexion();
   
    $VerificarUsuario = $conect->query("SELECT NOMBRE_U FROM usuario WHERE NOMBRE_U = '$nombreUsuario' AND PASSWORD_U = '$password'") ;
    
    $VerificarUsuario2 = $VerificarUsuario->fetch(PDO::FETCH_NUM);

    //var_dump($VerificarUsuario2);
    
    
    if (is_array($VerificarUsuario2)) {
        
        $VerificarEstado = $conect->query("SELECT ESTADO_E FROM usuario WHERE NOMBRE_U = '$nombreUsuario' AND ESTADO_E = 'habilitado' ");
        $VerificarEstado2 = $VerificarEstado->fetch(PDO::FETCH_NUM);

        //var_dump($VerificarEstado2);
        
        if (is_array($VerificarEstado2)) {
            
            $VerificarRol = $conect->query("SELECT ROL_R FROM usuario_rol WHERE NOMBRE_U = '$nombreUsuario'");
            $VerificarRol2 = $VerificarRol->fetch(PDO::FETCH_NUM);

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

