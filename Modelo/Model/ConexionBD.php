<?php
    class Conexion {
        public $conexion;
         
        public function conectar(){
            $this->conectarMYSQL();
            $this->conectarBD();        
        }
        
        public function conectarMYSQL() {
           // mysql_connect('192.168.2.5', 'mbittle','5rtZAGYq') or die("Error en el establecimiento de la conexion");
            mysql_connect('localhost', 'root','') or die("Error en el establecimiento de la conexion"); 
        }

        public function conectarBD() {
            mysql_select_db('tis_mbittle') or die("Error en la conexion a la base de datos");
        }

        public function consultar($query) {
            $result = mysql_query($query) or die("Error en la consulta SQL = $query");
            return $result;
        }

        public function cerrarConexion() {
            mysql_close();
        }

        public function consultarTabla($query) {
            $tabla = array();
            $resConsulta = $this->consultar($query);
            $i = 0;
            $j = 0;
            $numColumnas = mysql_numfields($resConsulta);
            while ($fila = mysql_fetch_array($resConsulta)) {
                for ($j = 0 ; $j < $numColumnas ;$j++){
                    $tabla["$i"]["$j"] = $fila["$j"];
                }            
                $i++;
            }
            return $tabla;
        }    
        
        public function consultarArreglo($query){        
            $arreglo = array();
            $resConsulta = $this->consultar($query);
            $i = 0;                
            while ($fila = mysql_fetch_array($resConsulta)) {            
                $arreglo["$i"] = $fila["0"];
                $i++;
            }
            return $arreglo;
        }
       
        public function consultaUnDato($query) {
            $dato = -1;
            $resConsulta = $this->consultar($query);
            while ($fila = mysql_fetch_array($resConsulta)) {            
                $dato = $fila["0"];
                break;
            }             
            return $dato;
        }
    }
?>
