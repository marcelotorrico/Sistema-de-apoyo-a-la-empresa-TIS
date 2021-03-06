<?php 
/* 
 * Author Antonio
 */
 //echo "Hola ".dirname(__DIR__).DIRECTORY_SEPARATOR.'config.php'." adios";

class Conexion extends PDO { 
    /*private $tipo_de_base = 'mysql';
    private $host = 'localhost';
    private $nombre_de_base = 'saetis';
    private $usuario = 'root';
    private $contrasena = ''; */

    public function __construct() {
        //Sobreescribo el método constructor de la clase PDO.
        require dirname(__DIR__).DIRECTORY_SEPARATOR.'config.php';
        try{
            parent::__construct($dbtype.':host='.$host.';dbname='.$db, $user, $password);
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
        }
    }
   
    public function consultarTabla($query) {
        $tabla = array();
        $resConsulta = $this->query($query);
        $i = 0;
        $j = 0;
        $numColumnas = $resConsulta->columnCount();
        while ($fila = $resConsulta->fetch()) {
            for ($j = 0 ; $j < $numColumnas ;$j++){
                $tabla["$i"]["$j"] = $fila["$j"];
            }            
            $i++;
        }
        return $tabla;
    }
    
    public function consultarArreglo($query){        
        $arreglo = array();
        $resConsulta = $this->query($query);
        $i = 0;
        while ($fila = $resConsulta->fetch()){
            $arreglo["$i"] = $fila["0"];
            $i++;
        }
        return $arreglo;
    }
    
    public function consultaUnDato($query) {
        $dato = -1;
        $resConsulta = $this->query($query);
        while ($fila = $resConsulta->fetch()) {
            $dato = $fila["0"];
            break;
        }             
        return $dato;
    }
 } 
?>