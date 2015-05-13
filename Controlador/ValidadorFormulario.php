<?php
    class ValidadorFormulario{
        
        function verificarNumeroValido($Telefono){
            $res = false;
            if(strlen($Telefono)==7 || strlen($Telefono)==8){
                $primerNumero = $Telefono[0];

                      if($primerNumero==7 && strlen($Telefono)==8 || $primerNumero==6 && strlen($Telefono)==8 ||$primerNumero==4 && strlen($Telefono)==7){
                          $res = true;
                      }
            }
            return $res;
        }
        
        function verificarNombreUsuario($nombreUsuario){
            $res = false;
            if(strlen($nombreUsuario)>2 && strlen($nombreUsuario)<13){
                if(preg_match('^[a-zA-Z]{3}[a-zA-z0-9_\\_\ü]{0,9}$',$nombreUsuario)){
                    if(ctype_alnum($nombreUsuario)){
                        $res = true;
                    }
                }
            }
            return $res; 
        }
        
        function verificarContrasena($contrasena){
            
            if(strlen($contrasena) > 7){
                return true;
            }
            return false;
        }
        function validarContrasenas($contrasena1,$contrasena2){
            if($contrasena1 == $contrasena2){
                return true;
            }
            return false;
        }
        function validarNombre($nombre){
            if(strlen($nombre)<3 || strlen($nombre)>21){
                return false;
            }
            
            if(!preg_match('[A-Z]{1}[a-z]{2,20}\s?([A-Z]{1}[a-z]{2,20})?',$nombre)){
                    return false;
            }
            return true;
        }
        function validarCorreo($correo){
            if(!preg_match('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$',$correo)){
                    return false;
            }
            return true;
        }
                function validarNombreLargo($nombre){
            if(strlen($nombre)>2){
                return true;
            }
            return false;
        }
    }
?>