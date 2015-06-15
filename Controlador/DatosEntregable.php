<?php
    require_once '../Modelo/Model/Entregable.php';
    if(isset($_POST["datos"])&&isset($_POST["usuario"])){
        echo getDatosEntregable($_POST["usuario"],$_POST["datos"]);
    }else if (isset($_POST["usuario"])) {
        echo getEntregables($_POST["usuario"]);
    }
    function getEntregables($usuario) {
        $entregables = Entregable::listaEntregables($usuario);
        $tamano = count($entregables);
        $res = "";
        for($i=0; $i < $tamano; $i++){
            $res.= $entregables[$i];
            if($i < ($tamano-1)){
                $res.=",";
            }
        }
        return $res;
    }
    function getDatosEntregable($usuario,$datos) {
        $entregables = Entregable::listaEntregables($usuario,$datos);
        $tamano = count($entregables);
        $res = "";
        for($i=0; $i < $tamano; $i++){
            $res.= $entregables[$i][0];
            $res.= "|". $entregables[$i][1];
            if($i < ($tamano-1)){
                $res.=",";
            }
        }
        return $res;
    }
?>