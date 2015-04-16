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
            if (ereg("^[a-zA-Z0-9]{5,14}$", $nombreUsuario)){
                return true; 
            } else {
                return false; 
            } 
        }
        
        function verificarContrasena($contrasena){
            
            if(strlen($contrasena) < 7 && strlen($contrasena) > 16){
                return false;
            }else{
                if (!preg_match('`[a-z]`',$contrasena) || !preg_match('`[A-Z]`',$contrasena) || !preg_match('`[0-9]`',$contrasena) || ctype_alnum($contrasena)){
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
            if(preg_match('/[^a-zA-Z]/',$nombre)){
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