<?php
date_default_timezone_set("America/La_Paz");
require_once '../Modelo/Model/Planificacion.php';
require_once '../Modelo/Model/Registro.php';
require_once '../Modelo/Model/FechaRealizacion.php';
require_once '../Modelo/Model/Entregable.php';
require_once '../Modelo/Model/Precio.php';
require_once '../Modelo/Model/Entrega.php';
require_once '../Modelo/Model/Pago.php';

session_start();
$usuario = $_SESSION['usuario'];

/* $usuario = 'Bittle'; */
$planificacion = new Planificacion($usuario);
$estado = $planificacion->getEstado();

switch ($estado) {
    case 'registrar planificacion':
        registrarPlanificacion($usuario);
        break;
    case 'registrar entregables':
        registrarPlanificacion($usuario);
        registrarEntregables($usuario);
        break;
    case 'registrar costo total proyecto':
        registrarPlanificacion($usuario);
        registrarEntregables($usuario);
        registrarCosto($usuario);
        break;
    case 'registrar plan pagos':
        registrarPlanificacion($usuario);
        registrarEntregables($usuario);
        registrarCosto($usuario);
        registrarPlanPagos($usuario);
        break;
}

function registrarPlanificacion($usuario) {
    if (isset($_POST['actividades']) && isset($_POST['fechas'])) {
        $planificacion = new Planificacion($usuario);
        $actividades = explode(',', $_POST['actividades']);
        $fechas = explode(',', $_POST['fechas']);
        $registrado = FALSE;
        for ($i = 0; $i < count($actividades); $i++) {
            $fechaActual = date("Y") . "-" . date("m") . "-" . date("d");
            $horaActual = date("H") . ":" . date("i") . ":" . date("s");
            $actividad = $actividades[$i];
            $fecha = $fechas[$i];
            $registro = new Registro($usuario, 'actividad planificacion', 'en proceso', $actividad, $fechaActual, $horaActual);
            $existe = $registro->existeBD();
            if(!$existe){
                $registro->insertarBD();
                $registro->cerrarConexion();
                $fechaRealizacion = new FechaRealizacion($registro->getId(), $fecha);
                $fechaRealizacion->insertarBD();
                $fechaRealizacion->cerrarConexion();    
            }else{
                $registro->cerrarConexion();
                $registrado = TRUE;
            }
        }
        if(!$registrado){
            $planificacion->setEstado('registrar entregables');
            $planificacion->modificarBD();
        }
        $planificacion->cerrarConexion();
        echo ('<div class="alert alert-success">
					   <strong>Planificacion registrada...</strong>
				   </div>
				   <script>$("#page-wrapper").load("vistaRegistrarPlanificacion.php");</script>');
    }
}

function registrarEntregables($usuario) {
    if (isset($_POST['entregables'])&&isset($_POST['descripciones'])) {
        $planificacion = new Planificacion($usuario);
        $entregables = explode(',', $_POST['entregables']);
        $descripciones = explode(',', $_POST['descripciones']);
        $registrado = FALSE;
        for ($i = 0; $i < count($entregables); $i++) {
            $entregable = new Entregable($usuario, $entregables[$i], $descripciones[$i]);
            $existe = $entregable->existeBD();
            if(!$existe){
                $entregable->insertarBD();   
            }else{
                $registrado = TRUE;
            }
            $entregable->cerrarConexion();
        }
        if(!$registrado){
            $planificacion->setEstado('registrar costo total proyecto');
            $planificacion->modificarBD();
        }
        $planificacion->cerrarConexion();
        echo ('<div class="alert alert-success">
				       <strong>Entregables registrados...</strong>
				   </div>
				   <script>$("#page-wrapper").load("vistaRegistrarPlanificacion.php");</script>');
    }
}

function registrarCosto($usuario) {
    if (isset($_POST['costo']) && isset($_POST['porcentajeA'])) {
        $planificacion = new Planificacion($usuario);
        $costo = $_POST['costo'];
        $porcentajeA = $_POST['porcentajeA'];
        //$porcentajeA = 70;
        $precio = new Precio($usuario, $costo);
        $precio->setPorcentajeA($porcentajeA);
        $precio->insertarBD();
        $planificacion->setEstado('registrar plan pagos');
        $planificacion->modificarBD();
        $planificacion->cerrarConexion();
        echo ('<div class="alert alert-success">
				       <strong>Costo total proyecto registrado...</strong>
				   </div>
				   <script>$("#page-wrapper").load("vistaRegistrarPlanificacion.php");</script>');
    }
}

function registrarPlanPagos($usuario) {
    if (isset($_POST['actividades']) && isset($_POST['fechas']) && isset($_POST['porcentajes']) && isset($_POST['montos']) && isset($_POST['entregables'])) {
        $planificacion = new Planificacion($usuario);
        $actividades = explode(',', $_POST['actividades']);
        $fechas = explode(',', $_POST['fechas']);
        $porcentajes = explode(',', $_POST['porcentajes']);
        $montos = explode(',', $_POST['montos']);
        $entregables = explode('|', $_POST['entregables']);
        for ($i = 0; $i < count($actividades); $i++) {
            $fechaActual = date("Y") . "-" . date("m") . "-" . date("d");
            $horaActual = date("H") . ":" . date("i") . ":" . date("s");
            $actividad = $actividades[$i];
            $fecha = $fechas[$i];
            $porcentaje = $porcentajes[$i];
            $monto = $montos[$i];
            $entregable = explode(',', $entregables[$i]);

            $registro = new Registro($usuario, 'pago planificacion', 'en proceso', $actividad, $fechaActual, $horaActual);
            $registro->insertarBD();
            $fechaRealizacion = new FechaRealizacion($registro->getId(), $fecha);
            $fechaRealizacion->insertarBD();
            $pago = new Pago($registro->getId(), $monto, $porcentaje);
            $pago->insertarBD();
            for ($j = 0; $j < count($entregable); $j++) {
                //$e = $entregable[$j];
                $entrega = new Entrega($registro->getId(), $entregable[$j], 0);
                $entrega->insertarBD();
            }
        }
        $planificacion->setEstado('planificacion registrada');
        $planificacion->modificarBD();
        $planificacion->cerrarConexion();
        //echo ('<div class="alert alert-success"><strong>Planificacion registrada...</strong></div>');
    }
}

?>