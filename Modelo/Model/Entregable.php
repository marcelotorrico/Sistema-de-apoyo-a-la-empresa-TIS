<?php
	require_once '../Modelo/conexionPDO.php';
	
	class Entregable {
		var $conexion;
	    private $usuario;
	    private $entregable;
	    private $descripcion;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new Conexion();
            if ($nargs == 2) {
                $this->constructor($args[0], $args[1]);
            } else {
                $this->usuario = $args[0];
                $this->entregable = $args[1];
                $this->descripcion = $args[2];
            }
	    }

	    function constructor($usuario, $entregable) {
            $pdoStatement = $this->conexion->prepare("SELECT nombre_u, entregable_e, descripcion_e FROM entregable WHERE nombre_u = '$usuario' AND entregable_e = '$entregable';");
            $pdoStatement->execute();
            $datosEntregable = $pdoStatement->fetch(PDO::FETCH_NUM);
            $this->usuario = $datosEntregable[0];
            $this->entregable = $datosEntregable[1];
            $this->descripcion = $datosEntregable[2];
            $pdoStatement->closeCursor();
	    }
            
            function existeBD() {
                $entregable = $this->verificarEntregable();
                $res = TRUE;
                if(count($entregable[0]) == 0){
                    $res = FALSE;
                }
                return $res;
            }
            
            public function verificarEntregable(){
                $pdoStatement = $this->conexion->query("SELECT entregable_e FROM entregable WHERE entregable_e = '$this->entregable' and nombre_u = '$this->usuario';");
                $res = $pdoStatement->fetch(PDO::FETCH_NUM);
	        $pdoStatement->closeCursor();
                return $res;
            }
            
            function insertarBD() {
	        $pdoStatement = $this->conexion->query("INSERT INTO entregable(nombre_u, entregable_e, descripcion_e)
	        						   VALUES('$this->usuario', '$this->entregable', '$this->descripcion');");
	        $pdoStatement->closeCursor();
	    }

	    public static function listaEntregables($usuario) {
	        $conexion = new Conexion();
                $numeroArgumentos = func_num_args();
                if($numeroArgumentos==2){
                    $datos = func_get_arg(1);
                    $pdoStatement = $conexion->prepare("SELECT $datos FROM entregable WHERE nombre_u = '$usuario';");
                    $pdoStatement->execute();
                    $entregables = $pdoStatement->fetchAll();
                }else{
                    $pdoStatement = $conexion->prepare("SELECT entregable_e FROM entregable WHERE nombre_u = '$usuario';");
                    $pdoStatement->execute();
                    $entregables = $pdoStatement->fetchAll(PDO::FETCH_COLUMN,0);
                }
                $conexion = NULL;
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
            
            public function cerrarConexion(){
                $this->conexion = NULL;
            }
	}
?>
