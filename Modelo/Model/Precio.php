<?php
	require_once '../Modelo/conexionPDO.php';

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
            $pdoStatement = $this->conexion->prepare("SELECT nombre_u, precio_p, porcentaje_a FROM precio WHERE nombre_u = '$usuario';");
            $pdoStatement->execute();
            $datosPrecio = $pdoStatement->fetch(PDO::FETCH_NUM);
            if(count($datosPrecio)==3){
                $this->usuario = $datosPrecio[0];
                $this->precio = $datosPrecio[1];
                $this->porcentajeA = $datosPrecio[2];
            }else{
                $this->precio = NULL;
            }
	    $pdoStatement->closeCursor();
	    }

	    function insertarBD() {
                if($this->existeBD()){
                    $pdoStatement = $this->conexion->query("UPDATE precio 
					SET precio_p = '$this->precio', porcentaje_a = '$this->porcentajeA' 
					WHERE nombre_u = '$this->usuario';");
                }else{
	        $pdoStatement = $this->conexion->query("INSERT INTO precio(nombre_u, precio_p, porcentaje_a)
	        						   VALUES('$this->usuario', '$this->precio', '$this->porcentajeA');");
                }
                $pdoStatement->closeCursor();
	    }
            
            function cerrarConexion() {
                $this->conexion = NULL;
            }
            
            function existeBD() {
                $precio= $this->getDatosBD();
                $res = TRUE;
                if(count($precio[0]) == 0){
                    $res = FALSE;
                }
                return $res;
            }
            public function getDatosBD(){
                $pdoStatement = $this->conexion->query("SELECT precio_p FROM precio WHERE nombre_u = '$this->usuario';");
                $res = $pdoStatement->fetch(PDO::FETCH_NUM);
	        $pdoStatement->closeCursor();
                return $res;
            }
            public static function getDatosPrecio($usuario) {
                $conexion = new Conexion();
	        $pdoStatement = $conexion->prepare("SELECT precio_p, porcentaje_a FROM precio WHERE nombre_u = '$usuario';");
	        $pdoStatement->execute();
                $datosPrecio = $pdoStatement->fetch(PDO::FETCH_NUM);
                $conexion = NULL;
	        return $datosPrecio;
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
