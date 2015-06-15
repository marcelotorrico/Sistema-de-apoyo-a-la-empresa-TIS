<?php

require_once '../Modelo/conexionPDO.php';

class Registro {

    var $conexion;
    private $id;
    private $usuario;
    private $tipo;
    private $estado;
    private $nombre;
    private $fecha;
    private $hora;

    function __construct() {
        $nargs = func_num_args();
        $args = func_get_args();
        $this->conexion = new Conexion();
        if ($nargs == 1) {
            $this->constructor($args[0]);
        } else {
            $pdoStatement = $this->conexion->prepare("SELECT auto_increment FROM `information_schema`.tables WHERE TABLE_SCHEMA = 'saetis' AND TABLE_NAME = 'registro';");
            $pdoStatement->execute();
            $this->id = $pdoStatement->fetch(PDO::FETCH_NUM)[0];
            $pdoStatement->closeCursor();
            $this->usuario = $args[0];
            $this->tipo = $args[1];
            $this->estado = $args[2];
            $this->nombre = $args[3];
            $this->fecha = $args[4];
            $this->hora = $args[5];
        }
    }

    function constructor($id) {
        $pdoStatement = $this->conexion->prepare("SELECT id_r, nombre_u, tipo_t, estado_e, nombre_r, fecha_r, hora_r FROM registro WHERE id_r = $id;");
        $pdoStatement->execute();
        $datosRegistro = $pdoStatement->fetch(PDO::FETCH_NUM);
        if (count($datosRegistro) == 7) {
            $this->id = $datosRegistro[0];
            $this->usuario = $datosRegistro[1];
            $this->tipo = $datosRegistro[2];
            $this->estado = $datosRegistro[3];
            $this->nombre = $datosRegistro[4];
            $this->fecha = $datosRegistro[5];
            $this->hora = $datosRegistro[6];
        }
        $pdoStatement->closeCursor();
    }

    function existeBD() {
        $nombreActividad = $this->obtenerActividad();
        $res = TRUE;
        if (count($nombreActividad[0]) == 0) {
            $res = FALSE;
        }
        return $res;
    }

    function insertarBD() {
        $pdoStatement = $this->conexion->query("INSERT INTO registro(nombre_u, tipo_t, estado_e, nombre_r, fecha_r, hora_r)
	        						   VALUES('$this->usuario', '$this->tipo', '$this->estado', '$this->nombre', '$this->fecha', '$this->hora');");
        $pdoStatement->closeCursor();
    }

    public function modificarBD() {
        $pdoStatement = $this->conexion->query("UPDATE registro 
					SET nombre_u = '$this->usuario', tipo_t = '$this->tipo', estado_e = '$this->estado', nombre_r = '$this->nombre', fecha_r = '$this->fecha', hora_r = '$this->hora' 
					WHERE id_r = '$this->id';");
        $pdoStatement->closeCursor();
    }

    public function obtenerActividad() {
        $pdoStatement = $this->conexion->query("SELECT id_r, nombre_r FROM registro WHERE nombre_r = '$this->nombre';");
        $res = $pdoStatement->fetch(PDO::FETCH_NUM);
        $pdoStatement->closeCursor();
        return $res;
    }

    public function eliminarBD() {
        $pdoStatement = $this->conexion->query("DELETE FROM registro WHERE nombre_r = '$this->nombre' AND nombre_u='$this->usuario'
                                                AND tipo_t = '$this->tipo';");
        $pdoStatement->closeCursor();
    }

    public static function listaActividadesPlanificacion($usuario) {
        $conexion = new Conexion();
        $pdoStatement = $conexion->prepare("SELECT id_r, nombre_r FROM registro WHERE nombre_u = '$usuario' AND tipo_t = 'actividad planificacion';");
        $pdoStatement->execute();
        $actividadesPlanificacion = $pdoStatement->fetchAll();
        $conexion = NULL;
        return $actividadesPlanificacion;
    }

    public function cerrarConexion() {
        $this->conexion = NULL;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

}

?>
