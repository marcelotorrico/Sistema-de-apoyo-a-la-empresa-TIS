 <?php
 
 class ValidadorInicioSesion {
    function validarInicioSesion($sesion,$rol){
        include_once '../Modelo/conexion.php';
         $conectar = new conexion();
         $user = isset($sesion);
         $mensaje="Usted intento ingresar a una pagina que no le corresponde";
 
         if($user == ''){
             
             echo '<script>alert("Primero debe iniciar sesion para acceder al sitio");</script>';
             echo '<script>window.location="../index.php";</script>';
        }else{
            if($rol == "administrador"){
                $consulta =$conectar->consulta("select * from administrador where NOMBRE_U = '".$sesion."'");
                if(mysql_num_rows($consulta)==0){
                    echo '<script>alert('.$mensaje.');</script>';
                    echo '<script>window.location="../index.php";</script>';
                }
            }else{
                if($rol == "asesor"){
                    $consulta =$conectar->consulta("select * from asesor where NOMBRE_U = '".$sesion."'");
                    if(mysql_num_rows($consulta)==0){
                        echo '<script>alert('.$mensaje.');</script>';
                        echo '<script>window.location="../index.php";</script>';
                    }
            
                }else{
                    if($rol == "grupoEmpresa"){
                        $consulta =$conectar->consulta("select * from grupo_empresa where NOMBRE_U = '".$sesion."'");
                        if(mysql_num_rows($consulta)==0){
                            echo '<script>alert('.$mensaje.');</script>';
                            echo '<script>window.location="../index.php";</script>';
                        }
                    }
                }
            }
         }
     }
 }