<?php
	require_once '../conexionPDO.php';

	class Precio {
            var $conexion;
            private $usuario;
	    private $precio;
            private $porcentajeA;
                
	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new Conexion();
	        if ($nargs == 1) {
                $this->constructor($args[0]);
            } else {
            	$this->usuario = $args[0];
            	$this->precio = $args[1];
               // $this->porcentajeA =$args[2];
            }
	    }

	    function constructor($usuario) {	        
		$datosPrecio = $this->conexion->consultarTabla("SELECT nombre_u, precio_p, porcentaje_a
								FROM precio
								WHERE nombre_u = '$usuario';");
                $this->usuario = $datosPrecio[0][0];
                $this->precio = $datosPrecio[0][1];
                $this->porcentajeA = $datosPrecio[0][2];
	    }

	    function insertarBD() {	        
	        $this->conexion->query("INSERT INTO precio(nombre_u, precio_p, porcentaje_a)
	        						   VALUES('$this->usuario', '$this->precio', '$this->porcentajeA');");	        
	    }

	    public function getUsuario() {
	        return $this->usuario;
	    }

	    public function getPrecio() {
	        return $this->precio;
	    }

	    public function getPorcentajeA() {
	        return $this->PorcentajeA;
	    }            
            
	    public function setUsuario($usuario) {
	        $this->usuario = $usuario;
	    }

	    public function setPrecio($precio) {
	        $this->precio = $precio;
	    }
            
            public function setPorcentajeA($porcentajeA) {
	        $this->porcentajeA = $porcentajeA;
	    }
	}
?>
