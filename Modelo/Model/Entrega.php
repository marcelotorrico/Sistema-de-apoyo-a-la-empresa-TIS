<?php
	require_once '../conexionPDO.php';

	class Entrega {
            var $conexion;
            private $idRegistro;
	    private $entregable;
	    private $entregado;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new Conexion();
	        if ($nargs == 1) {
                $this->constructor($args[0]);
            } else {
            	$this->idRegistro = $args[0];
            	$this->entregable = $args[1];
            	$this->entregado = $args[2];
            }
	    }

	    function constructor($id) {
		$datosEntrega = $this->conexion->consultarTabla("SELECT id_r, entregable_p, entregado_p
														     WHERE id_r = $id;");
                $this->idRegistro = $datosEntrega[0][0];
                $this->entregable = $datosEntrega[0][1];
                $this->entregado = $datosEntrega[0][2];
	    }

	    function insertarBD() {	        
	        $this->conexion->query("INSERT INTO entrega(id_r, entregable_p, entregado_p)
	        						   VALUES($this->idRegistro, '$this->entregable', $this->entregado);");	        
	    }

	    public function getIdRegistro() {
	        return $this->idRegistro;
	    }

	    public function getEntregable() {
	        return $this->entregable;
	    }

	    public function getEntregado() {
	        return $this->entregado;
	    }

	    public function setIdRegistro($idRegistro) {
	        $this->idRegistro = $idRegistro;
	    }

	    public function setEntregable($entregable) {
	        $this->entregable = $entregable;
	    }

	    public function setEntregado($entregado) {
	        $this->entregado = $entregado;
	    }
	}
?>
