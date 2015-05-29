 <?php
 
 class ValidadorInicioSesion {
    function validarInicioSesion($sesion,$rol){
        include_once '../Modelo/conexionPDO.php';
         $conectar = new Conexion();
         $user = isset($sesion);
 
         if($user == ''){
             
             echo '<script>alert("Primero debe iniciar sesion para acceder al sitio");</script>';
             echo '<script>window.location="../index.php";</script>';
        }else{
            if($rol == "administrador"){
                $consulta =$conectar->query("select * from administrador where NOMBRE_U = '".$sesion."'");
                if($consulta->rowCount()==0){
                    echo '<script>alert("Usted intento ingresar a una pagina que no le corresponde");</script>';
                    echo '<script>window.location="../index.php";</script>';
                }
            }else{
                if($rol == "asesor"){
                    $consulta =$conectar->query("select * from asesor where NOMBRE_U = '".$sesion."'");
                    if($consulta->rowCount()==0){
                        echo '<script>alert("Usted intento ingresar a una pagina que no le corresponde");</script>';
                        echo '<script>window.location="../index.php";</script>';
                    }
            
                }else{
                    if($rol == "grupoEmpresa"){
                        $consulta =$conectar->query("select * from grupo_empresa where NOMBRE_U = '".$sesion."'");
                        if($consulta->rowCount()==0){
                            echo '<script>alert("Usted intento ingresar a una pagina que no le corresponde");</script>';
                            echo '<script>window.location="../index.php";</script>';
                        }
                    }
                }
            }
         }
     }
 }