<?php
    require_once '../Modelo/Model/Registro.php';
    require_once '../Modelo/Model/FechaRealizacion.php';
    $usuario = $_POST["usuario"];
    if(isset($usuario)){
        echo getActividadesTabla($usuario);
    }
    function getActividadesTabla($usuario) {
        $ap = Registro::listaActividadesPlanificacion($usuario);
        $res="";
        $tamano = count($ap);
        for($i=0; $i < $tamano; $i++){
            $fecha = new FechaRealizacion($ap[$i][0]);
            $res.= $ap[$i][1];
            $res.= "|". $fecha->getFecha();
            if($i < ($tamano-1)){
                $res.=",";
            }
            $fecha->cerrarConexion();
        }
            return $res;
    }
?>

