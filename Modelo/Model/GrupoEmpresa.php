<?php
	require_once '../Modelo/conexion.php';

	class GrupoEmpresa {
		var $conexion;
	    private $usuario;
	    private $nombreCorto;
	    private $nombreLargo;
	    private $direccion;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new conexion();
            if ($nargs == 1) {
                $this->constructor($args[0]);
            } else {
                $this->usuario = $args[0];
                $this->nombreCorto = $args[1];
                $this->nombreLargo = $args[2];
                $this->direccion = $args[3];
            }
	    }

	    function constructor($usuario) {
	    	$this->conexion->conectar();
	        $datosGrupoEmpresa = $this->conexion->consultarTabla("SELECT nombre_u, nombre_corto_ge, nombre_largo_ge, direccion_ge
											                      FROM grupo_empresa
											                      WHERE nombre_u = '$usuario';");
	        $this->usuario = $datosGrupoEmpresa[0][0];
	        $this->nombreCorto = $datosGrupoEmpresa[0][1];
	        $this->nombreLargo = $datosGrupoEmpresa[0][2];
	        $this->direccion = $datosGrupoEmpresa[0][3];
	        $this->conexion->cerrarConexion();
	    }

	    function insertarBD() {
	        $this->conexion->conectar();
	        $this->conexion->consulta("INSERT INTO grupo_empresa(nombre_u, nombre_corto_ge, nombre_largo_ge, direccion_ge)
	        						   VALUES('$this->usuario', '$this->nombreCorto', '$this->nombreLargo', '$this->direccion');");
	        $this->conexion->cerrarConexion();
	    }

	    public function modificarBD() {
	        $this->conexion->conectar();
	        $this->conexion->consulta("UPDATE grupo_empresa
	        						   SET nombre_corto_ge = '$this->nombreCorto', nombre_largo_ge = '$this->nombreLargo', direccion_ge = '$this->direccion'
	        						   WHERE nombre_u = '$this->usuario';");
	        $this->conexion->cerrarConexion();
	    }

	    public function getUsuario() {
	        return $this->usuario;
	    }

	    public function getNombreCorto() {
	        return $this->nombreCorto;
	    }

	    public function getNombreLargo() {
	        return $this->nombreLargo;
	    }

	    public function getDireccion() {
	        return $this->direccion;
	    }

	    public function setUsuario($usuario) {
	        $this->usuario = $usuario;
	    }

	    public function setNombreCorto($nombreCorto) {
	        $this->nombreCorto = $nombreCorto;
	    }

	    public function setNombreLargo($nombreLargo) {
	        $this->nombreLargo = $nombreLargo;
	    }

	    public function setDireccion($direccion) {
	        $this->direccion = $direccion;
	    }
	}
?>
