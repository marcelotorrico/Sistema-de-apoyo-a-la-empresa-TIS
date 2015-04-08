<?php
	require_once '../Modelo/conexion.php';

	class Reporte {
		var $conexion;
	    private $idRegistro;
	    private $rol;
	    private $actividad;
	    private $hecho;
	    private $resultado;
	    private $conclusion;
	    private $observacion;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new conexion();
            if ($nargs == 1) {
                $this->constructor($args[0]);
            } else {
                $this->idRegistro = $args[0];
                $this->rol = $args[1];
                $this->actividad = $args[2];
                $this->hecho = $args[3];
                $this->resultado = $args[4];
                $this->conclusion = $args[5];
                $this->observacion = $args[6];
            }
	    }

	    function constructor($idRegistro) {
	    	$this->conexion->conectar();
	        $datosReporte = $this->conexion->consultarTabla("SELECT id_r, rol_rr, actividad_r, hecho_r, resultado_r, conclusion_r, observacion_r
											                 FROM reporte
											                 WHERE 	id_r = '$idRegistro';");
	        $this->idRegistro = $datosReporte[0][0];
	        $this->rol = $datosReporte[0][1];
	        $this->actividad = $datosReporte[0][2];
	        $this->hecho = $datosReporte[0][3];
	        $this->resultado = $datosReporte[0][4];
	        $this->conclusion = $datosReporte[0][5];
	        $this->observacion = $datosReporte[0][6];
	        $this->conexion->cerrarConexion();
	    }

	    function insertarBD() {
	        $this->conexion->conectar();
	        $this->conexion->consulta("INSERT INTO reporte(id_r, rol_rr, actividad_r, hecho_r, resultado_r, conclusion_r, observacion_r)
	        						   VALUES($this->idRegistro, '$this->rol', '$this->actividad', $this->hecho, '$this->resultado', '$this->conclusion', '$this->observacion');");
	        $this->conexion->cerrarConexion();
	    }

	    public static function listaRolesReporte() {
	        $conexion = new conexion();
	        $conexion->conectar();
	        $roles = $conexion->consultarArreglo("SELECT rol_rr 
	        									  FROM rol_reporte");
	        $conexion->cerrarConexion();
	        return $roles;
	    }

	    public function getIdRegistro() {
	        return $this->idRegistro;
	    }

	    public function getRol() {
	        return $this->rol;
	    }

	    public function getActividad() {
	        return $this->actividad;
	    }

	    public function getHecho() {
	        return $this->hecho;
	    }

	    public function getResultado() {
	        return $this->resultado;
	    }

	    public function getConclusion() {
	        return $this->conclusion;
	    }

	    public function getObservacion() {
	        return $this->observacion;
	    }

	    public function setIdRegistro($idRegistro) {
	        $this->idRegistro = $idRegistro;
	    }

	    public function setRol($rol) {
	        $this->rol = $rol;
	    }

	    public function setActividad($actividad) {
	        $this->actividad = $actividad;
	    }

	    public function setHecho($hecho) {
	        $this->hecho = $hecho;
	    }

	    public function setResultado($resultado) {
	        $this->resultado = $resultado;
	    }

	    public function setConclusion($conclusion) {
	        $this->conclusion = $conclusion;
	    }

	    public function setObservacion($observacion) {
	        $this->observacion = $observacion;
	    }
	}
?>
