<?php
    require_once '../Modelo/Model/Registro';
    require_once '../Modelo/Model/Pago.php';
    require_once '../Modelo/Model/FechaRealizacion.php';
    require_once '../Modelo/Model/Entrega.php';
    $usuario = $_POST["usuario"];
    if(isset($usuario)){
        echo getDatosPlanPago($usuario);
    }
    function getDatosPlanPago($usuario) {
        $actividades = Registro::listaActividadesPlanificacion($usuario);
        $res = "";
        $tamano = count($actividades);
        for($i=0; $i < $tamano; $i++){
            $pago = new Pago($actividades[$i][0]);
            $fecha = new FechaRealizacion($actividades[$i][0]);
            $entrega = new Entrega($actividades[$i][0]);
            $res.= $actividades[$i][1];
            $res.= "|". $fecha->getFecha();
            $res.="|".$pago->getPorcentajeDelTotal();
            $res.="|".$pago->getMonto();
            $res.="|".$entrega->getEntregable();
            if($i < ($tamano-1)){
                $res.=",";
            }
            $fecha->cerrarConexion();
            $pago->cerrarConexion();
            $entrega->carrarConexion();
        }
        return $res;
    }
?>