<?php
	require_once '../Modelo/conexionPDO.php';

	class FechaRealizacion {
            private $conexion;
		private $idRegistro;
	    private $fecha;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new Conexion();
	        if ($nargs == 1) {
                $this->constructor($args[0]);
            } else {
            	$this->idRegistro = $args[0];
            	$this->fecha = $args[1];
            }
	    }

	    function constructor($id) {
            $pdoStatement = $this->conexion->prepare("SELECT ID_R, FECHA_FR FROM fecha_realizacion WHERE ID_R = $id;");
            $pdoStatement->execute();
            $datosFechaRealizacion = $pdoStatement->fetch(PDO::FETCH_NUM);
            $this->idRegistro = $datosFechaRealizacion[0];
            $this->fecha = $datosFechaRealizacion[1];
	    $pdoStatement->closeCursor();    
	    }

	    function insertarBD() {
	        $pdoStatement = $this->conexion->query("INSERT INTO fecha_realizacion(id_r, fecha_fr) VALUES($this->idRegistro, '$this->fecha');");
	        $pdoStatement->closeCursor();
	    }

	    public function modificarBD() {
	        $pdoStatement = $this->conexion->query("UPDATE fecha_realizacion SET fecha_fr = '$this->fecha' WHERE id_r = '$this->idRegistro';");
	        $pdoStatement->closeCursor();
	    }
            
            public function cerrarConexion(){
                $this->conexion = NULL;
            }

            public function getIdRegistro() {
	        return $this->idRegistro;
	    }

	    public function getFecha() {
	        return $this->fecha;
	    }

	    public function setIdRegistro($idRegistro) {
	        $this->idRegistro = $idRegistro;
	    }

	    public function setFecha($fecha) {
	        $this->fecha = $fecha;
	    }
	}
?>
