<?php
	require_once '../Modelo/conexionPDO.php';

	class Pago {
		var $conexion;
		private $idRegistro;
	    private $monto;
	    private $porcentajeDelTotal;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new Conexion();
	        if ($nargs == 1) {
                $this->constructor($args[0]);
            } else {
            	$this->idRegistro = $args[0];
            	$this->monto = $args[1];
            	$this->porcentajeDelTotal = $args[2];
            }
	    }

	    function constructor($id) {
            $pdoStatement = $this->conexion->prepare("SELECT id_r, monto_p, porcentaje_del_total_p FROM pago WHERE id_r = $id;");
            $pdoStatement->execute();
            $datosPago = $pdoStatement->fetch(PDO::FETCH_NUM);
            if(count($datosPago)==3){
                $this->idRegistro = $datosPago[0];
                $this->monto = $datosPago[1];
                $this->porcentajeDelTotal = $datosPago[2];
            }
            $pdoStatement->closeCursor();
	    }
            function cerrarConexion(){
                $this->conexion=NULL;
            }
            function insertarBD() {
	        $pdoStatement = $this->conexion->query("INSERT INTO pago(id_r, monto_p, porcentaje_del_total_p) VALUES($this->idRegistro, $this->monto, $this->porcentajeDelTotal);");
	        $pdoStatement->closeCursor();
	    }

	    public function getIdRegistro() {
	        return $this->idRegistro;
	    }

	    public function getMonto() {
	        return $this->monto;
	    }

	    public function getPorcentajeDelTotal() {
	        return $this->porcentajeDelTotal;
	    }

	    public function setIdRegistro($idRegistro) {
	        $this->idRegistro = $idRegistro;
	    }

	    public function setMonto($monto) {
	        $this->monto = $monto;
	    }

	    public function setPorcentajeDelTotal($porcentajeDelTotal) {
	        $this->porcentajeDelTotal = $porcentajeDelTotal;
	    }
	}
?>
