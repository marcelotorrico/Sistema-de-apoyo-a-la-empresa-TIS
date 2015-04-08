<?php
	require_once '../Modelo/conexion.php';

	class Planificacion {
		var $conexion;
	    private $usuario;
	    private $estado;
	    private $fechaInicio;
	    private $fechaFin;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new conexion();
            if ($nargs == 1) {
                $this->constructor($args[0]);
            } else {
                $this->usuario = $args[0];
                $this->estado = $args[1];
                $this->fechaInicio = $args[2];
                $this->fechaFin = $args[3];
            }
	    }

	    function constructor($usuario) {
	    	$this->conexion->conectar();
	        $datosPlanificacion = $this->conexion->consultarTabla("SELECT NOMBRE_U, ESTADO_E, FECHA_INICIO_P, FECHA_FIN_P
											                       FROM planificacion
											                       WHERE NOMBRE_U = '$usuario';");
	        $this->usuario = $datosPlanificacion[0][0];
	        $this->estado = $datosPlanificacion[0][1];
	        $this->fechaInicio = $datosPlanificacion[0][2];
	        $this->fechaFin = $datosPlanificacion[0][3];
	        $this->conexion->cerrarConexion();
	    }

	    function insertarBD() {
	        $this->conexion->conectar();
	        $this->conexion->consulta("INSERT INTO planificacion(NOMBRE_U, ESTADO_E, FECHA_INICIO_P, FECHA_FIN_P)
	        							VALUES('$this->usuario', '$this->estado', '$this->fechaInicio', '$this->fechaFin');");
	        $this->conexion->cerrarConexion();
	    }

	    public function modificarBD() {
	        $this->conexion->conectar();
	        $this->conexion->consulta("UPDATE planificacion
	        						   SET ESTADO_E = '$this->estado',  FECHA_INICIO_P = '$this->fechaInicio', FECHA_FIN_P = '$this->fechaFin'
	        						   WHERE NOMBRE_U = '$this->usuario';");
	        $this->conexion->cerrarConexion();
	    }

	    public function getUsuario() {
	        return $this->usuario;
	    }

	    public function getEstado() {
	        return $this->estado;
	    }

	    public function getFechaInicio() {
	        return $this->fechaInicio;
	    }

	    public function getFechaFin() {
	        return $this->fechaFin;
	    }

	    public function setUsuario($usuario) {
	        $this->usuario = $usuario;
	    }

	    public function setEstado($estado) {
	        $this->estado = $estado;
	    }

	    public function setFechaInicio($fechaInicio) {
	        $this->fechaInicio = $fechaInicio;
	    }

	    public function setFechaFin($fechaFin) {
	        $this->fechaFin = $fechaFin;
	    }
	}
?>
