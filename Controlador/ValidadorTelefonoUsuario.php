<?php
    class ValidadorTelefonoUsuario{
        
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
    }
?>