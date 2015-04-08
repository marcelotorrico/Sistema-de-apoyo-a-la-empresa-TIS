<?php
	require_once '../Modelo/conexion.php';

	class Asistencia {
		var $conexion;
	    private $idRegistro;
	    private $codigoSocio;
	    private $asistencia;
	    private $licencia;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new conexion();
            if ($nargs == 1) {
                $this->constructor($args[0]);
            } else {
                $this->idRegistro = $args[0];
                $this->codigoSocio = $args[1];
                $this->asistencia = $args[2];
                $this->licencia = $args[3];
            }
	    }

	    function constructor($idRegistro) {
	    	$this->conexion->conectar();
	        $datosAsistencia = $this->conexion->consultarTabla("SELECT id_r, codigo_socio_a, asistencia_a, licencia_a
											                    FROM asistencia
											                    WHERE id_r = $idRegistro;");
	        $this->idRegistro = $datosAsistencia[0][0];
	        $this->codigoSocio = $datosAsistencia[0][1];
	        $this->asistencia = $datosAsistencia[0][2];
	        $this->licencia = $datosAsistencia[0][3];
	        $this->conexion->cerrarConexion();
	    }

	    function insertarBD() {
	        $this->conexion->conectar();
	        $this->conexion->consulta("INSERT INTO asistencia(id_r, codigo_socio_a, asistencia_a, licencia_a)
	        						   VALUES($this->idRegistro, $this->codigoSocio, $this->asistencia, $this->licencia);");
	        $this->conexion->cerrarConexion();    
	    }

	    public function getIdRegistro() {
	        return $this->idRegistro;
	    }

	    public function getCodigoSocio() {
	        return $this->codigoSocio;
	    }
	    
	    public function getAsistencia() {
	        return $this->asistencia;
	    }

	    public function getLicencia() {
	        return $this->licencia;
	    }

	    public function setIdRegistro($idRegistro) {
	        $this->idRegistro = $idRegistro;
	    }

	    public function setCodigoSocio($codigoSocio) {
	        $this->codigoSocio = $codigoSocio;
	    }

	    public function setAsistencia($asistencia) {
	        $this->asistencia = $asistencia;
	    }

	    public function setLicencia($licencia) {
	        $this->licencia = $licencia;
	    }
	}
?>
