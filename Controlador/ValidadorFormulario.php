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
            if(strlen($nombreUsuario)>4 && strlen($nombreUsuario)<15){
                if(preg_match('/^[aA-zZ]{5}/',$nombreUsuario)){
                    if(ctype_alnum($nombreUsuario)){
                        $res = true;
                    }
                }
            }
            return $res; 
        }
        
        function verificarContrasena($contrasena){
            
            if(strlen($contrasena) < 7 && strlen($contrasena) > 16){
                return false;
            }else{
                if (!preg_match('/[a-z]/',$contrasena) || !preg_match('/[A-Z]/',$contrasena) || !preg_match('/[0-9]/',$contrasena) || ctype_alnum($contrasena)){
                    return false;
                }
            }
            return true;
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
            
            if(!preg_match('/^[A-Z]{1}[a-z]{2,20}$/',$nombre)){
                    return false;
            }
            return true;
        }
        function validarCorreo($correo){
            if(!preg_match('/^([a-zA-Z0-9_\.\-])+\@(([hotmail]{7}|[yahoo]{5}|[gmail]{5})+\.)+([a-zA-Z0-9]{2,4})+$/',$correo)){
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