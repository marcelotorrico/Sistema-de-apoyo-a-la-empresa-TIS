<?php
    require_once '../Modelo/Model/Precio.php';
    $usuario = $_POST["usuario"];
    if(isset($usuario)){
        echo getPrecio($usuario);
    }
    function getPrecio($usuario) {
        $precio=  Precio::getDatosPrecio($usuario);
        $res = "";
        if(count($precio)==2){
            $res.="$precio[0],$precio[1]";
        }
        return $res;
    }
?>