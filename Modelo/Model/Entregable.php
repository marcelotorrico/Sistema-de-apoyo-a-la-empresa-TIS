<?php
	require_once '../Modelo/conexion.php';
	
	class Entregable {
		var $conexion;
	    private $usuario;
	    private $entregable;
	    private $descripcion;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new conexion();
            if ($nargs == 2) {
                $this->constructor($args[0], $args[1]);
            } else {
                $this->usuario = $args[0];
                $this->entregable = $args[1];
                $this->descripcion = $args[2];
            }
	    }

	    function constructor($usuario, $entregable) {
	    	$this->conexion->conectar();
            $datosEntregable = $this->conexion->consultarTabla("SELECT nombre_u, entregable_e, descripcion_e
											                    FROM entregable
											                    WHERE nombre_u = '$usuario' AND entregable_e = '$entregable';");
            $this->usuario = $datosEntregable[0][0];
            $this->entregable = $datosEntregable[0][1];
            $this->descripcion = $datosEntregable[0][2];
            $this->conexion->cerrarConexion();
	    }

	    function insertarBD() {
	        $this->conexion->conectar();
	        $this->conexion->consulta("INSERT INTO entregable(nombre_u, entregable_e, descripcion_e)
	        						   VALUES('$this->usuario', '$this->entregable', '$this->descripcion');");
	        $this->conexion->cerrarConexion();
	    }

	    public static function listaEntregables($usuario) {
	        $conexion = new Conexion();
	        $conexion->conectar();
	        $entregables = $conexion->consultarArreglo("SELECT entregable_e 
	        										    FROM entregable
	        										    WHERE nombre_u = '$usuario';");
	        $conexion->cerrarConexion();
	        return $entregables;
	    }

	    public function getUsuario() {
	        return $this->usuario;
	    }

	    public function getEntregable() {
	        return $this->entregable;
	    }

	    public function getDescripcion() {
	        return $this->descripcion;
	    }

	    public function setusuario($usuario) {
	        $this->usuario = $usuario;
	    }

	    public function setEntregable($entregable) {
	        $this->entregable = $entregable;
	    }

	    public function setDescripcion($descripcion) {
	        $this->descripcion = $descripcion;
	    }
	}
?>
