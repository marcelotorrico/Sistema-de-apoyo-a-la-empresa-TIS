<?php
	require_once '../conexionPDO.php';

	class FechaRealizacion {
            var $conexion;
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
                $datosFechaRealizacion = $this->conexion->consultaTabla("SELECT ID_R, FECHA_FR FROM fecha_realizacion WHERE ID_R = $id;");
                $this->idRegistro = $datosFechaRealizacion[0][0];
                $this->fecha = $datosFechaRealizacion[0][1];
	    }

	    function insertarBD() {	        
	        $this->conexion->query("INSERT INTO fecha_realizacion(id_r, fecha_fr)
	        							VALUES($this->idRegistro, '$this->fecha');");	        
	    }

	    public function modificarBD() {	        
	        $this->conexion->query("UPDATE fecha_realizacion 
						SET fecha_fr = '$this->fecha'
						WHERE id_r = '$this->idRegistro';");
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
