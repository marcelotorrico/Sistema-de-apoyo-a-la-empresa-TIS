<?php
	require_once '../Modelo/conexionPDO.php';

	class Planificacion {
		var $conexion;
	    private $usuario;
	    private $estado;
	    private $fechaInicio;
	    private $fechaFin;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new Conexion();
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
	        $pdoStatement = $this->conexion->prepare("SELECT NOMBRE_U, ESTADO_E, FECHA_INICIO_P, FECHA_FIN_P
											                       FROM planificacion
											                       WHERE NOMBRE_U = '$usuario';");
	        $pdoStatement->execute();
                $datosPlanificacion = $pdoStatement->fetch(PDO::FETCH_NUM);
                $this->usuario = $datosPlanificacion[0];
	        $this->estado = $datosPlanificacion[1];
	        $this->fechaInicio = $datosPlanificacion[2];
	        $this->fechaFin = $datosPlanificacion[3];
	        $pdoStatement->closeCursor();
	    }

	    function insertarBD() {
	        $pdoStatement = $this->conexion->query("INSERT INTO planificacion(NOMBRE_U, ESTADO_E, FECHA_INICIO_P, FECHA_FIN_P)
	        							VALUES('$this->usuario', '$this->estado', '$this->fechaInicio', '$this->fechaFin');");
	        $pdoStatement->closeCursor();
	    }

	    public function modificarBD() {
	        $pdoStatement = $this->conexion->query("UPDATE planificacion
	        						   SET ESTADO_E = '$this->estado',  FECHA_INICIO_P = '$this->fechaInicio', FECHA_FIN_P = '$this->fechaFin'
	        						   WHERE NOMBRE_U = '$this->usuario';");
	        $pdoStatement->closeCursor();
	    }
            public function cerrarConexion(){
                $this->conexion = NULL;
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
