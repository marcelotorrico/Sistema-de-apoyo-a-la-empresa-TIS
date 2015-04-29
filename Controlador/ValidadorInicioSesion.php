<?php

class ValidadorInicioSesion {
    function validarInicioSesion($sesion){
        $user = isset($sesion);

        if($user == ''){
            
            echo '<script>alert("Primero debe iniciar sesion para acceder al sitio");</script>';
            echo '<script>window.location="../index.php";</script>';
        }
    }
}
?>