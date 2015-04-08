<?php
	require_once '../Modelo/conexion.php';
	
	class Registro {
		var $conexion;
		private $id;
	    private $usuario;
	    private $tipo;
	    private $estado;
	    private $nombre;
	    private $fecha;
	    private $hora;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new conexion();
	        if ($nargs == 1) {
                $this->constructor($args[0]);
            } else {
            	$this->conexion->conectar();
            	$this->id = $this->conexion->consultaUnDato("SELECT auto_increment
															 FROM `information_schema`.tables
															 WHERE TABLE_SCHEMA = 'saetis' AND TABLE_NAME = 'registro';");
            	$this->conexion->cerrarConexion();
            	$this->usuario = $args[0];
            	$this->tipo = $args[1];
            	$this->estado = $args[2];
            	$this->nombre = $args[3];
            	$this->fecha = $args[4];
            	$this->hora = $args[5];
            }
	    }

	    function constructor($id) {
	        $this->conexion->conectar();
			$datosRegistro = $this->conexion->consultarTabla("SELECT id_r, nombre_u, tipo_t, estado_e, nombre_r, fecha_r, hora_r
														      FROM registro
														      WHERE id_r = $id;");
            $this->id = $datosRegistro[0][0];
            $this->usuario = $datosRegistro[0][1];
            $this->tipo = $datosRegistro[0][2];
            $this->estado = $datosRegistro[0][3];
            $this->nombre = $datosRegistro[0][4];
            $this->fecha = $datosRegistro[0][5];
            $this->hora = $datosRegistro[0][6];
	        $this->conexion->cerrarConexion();
	    }

	    function insertarBD() {
	        $this->conexion->conectar();
	        $this->conexion->consulta("INSERT INTO registro(nombre_u, tipo_t, estado_e, nombre_r, fecha_r, hora_r)
	        						   VALUES('$this->usuario', '$this->tipo', '$this->estado', '$this->nombre', '$this->fecha', '$this->hora');");
	        $this->conexion->cerrarConexion();
	    }

	    public function modificarBD() {
	        $this->conexion->conectar();
	        $this->conexion->consulta("UPDATE registro 
										SET nombre_u = '$this->usuario', tipo_t = '$this->tipo', estado_e = '$this->estado', nombre_r = '$this->nombre', fecha_r = '$this->fecha', hora_r = '$this->hora' 
										WHERE id_r = '$this->id';");
	        $this->conexion->cerrarConexion();
	    }

	    public static function listaActividadesPlanificacion($usuario) {
	        $conexion = new Conexion();
	        $conexion->conectar();
	        $actividadesPlanificacion = $conexion->consultarTabla("SELECT id_r, nombre_r 
	        										    		   FROM registro
	        										    		   WHERE nombre_u = '$usuario' AND tipo_t = 'actividad planificacion';");
	        $conexion->cerrarConexion();
	        return $actividadesPlanificacion;
	    }

	    public function getId() {
	        return $this->id;
	    }

	    public function getUsuario() {
	        return $this->usuario;
	    }

	    public function getTipo() {
	        return $this->tipo;
	    }

	    public function getEstado() {
	        return $this->estado;
	    }

	    public function getNombre() {
	        return $this->nombre;
	    }

	    public function getFecha() {
	        return $this->fecha;
	    }

	    public function getHora() {
	        return $this->hora;
	    }

	    public function setId($id) {
	        $this->id = $id;
	    }

	    public function setUsuario($usuario) {
	        $this->usuario = $usuario;
	    }

	    public function setTipo($tipo) {
	        $this->tipo = $tipo;
	    }

	    public function setEstado($estado) {
	        $this->estado = $estado;
	    }

	    public function setNombre($nombre) {
	        $this->nombre = $nombre;
	    }

	    public function setFecha($fecha) {
	        $this->fecha = $fecha;
	    }

	    public function setHora($hora) {
	        $this->hora = $hora;
	    }
	}
?>
