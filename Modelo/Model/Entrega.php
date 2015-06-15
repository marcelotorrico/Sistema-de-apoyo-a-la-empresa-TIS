<?php
	require_once '../Modelo/conexionPDO.php';

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
            $pdoStatement = $this->conexion->prepare("SELECT id_r, entregable_p, entregado_p FROM entrega WHERE id_r = $id;");
            $pdoStatement->execute();
            $datosEntrega = $pdoStatement->fetch(PDO::FETCH_NUM);
            if(count($datosEntrega)==3){
                $this->idRegistro = $datosEntrega[0];
                $this->entregable = $datosEntrega[1];
                $this->entregado = $datosEntrega[2];
            }
            $pdoStatement->closeCursor(); 
	    }
            function carrarConexion() {
                $this->conexion = NULL;  
            }
	    function insertarBD() {
	        $pdoStatement = $this->conexion->query("INSERT INTO entrega(id_r, entregable_p, entregado_p)
	        						   VALUES($this->idRegistro, '$this->entregable', $this->entregado);");
	        $pdoStatement->closeCursor();
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
