<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class conexion{
    public $link;
function __construct(){
    
    $this->conectar();
}

function conectar(){   
/*$servidor = '192.168.2.5';
$userName = 'mbittle';
$password = '5rtZAGYq';
$bdName = 'tis_mbittle';*/
$servidor = 'localhost';
$userName = 'root';
$password = '';
$bdName = 'saetis';
//$bdName = 'freevalue';
global $link;
    $link =  mysql_connect($servidor, $userName, $password) or die('no se pudo conectar al servidor' . mysql_error());
    mysql_select_db($bdName,$link) or die('no se pudo encontrar la base de datos');
}

function consulta($consulta) {
    global $link;
    $resultado = mysql_query($consulta,$link)  or die('error en la consulta' . mysql_error());
    return $resultado;
    
}

function cerrarConexion() {
    global $link;
    mysql_close($link);
}

		public function consultarTabla($query) {
            $tabla = array();
            $resConsulta = $this->consulta($query);
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
            $resConsulta = $this->consulta($query);
            $i = 0;                
            while ($fila = mysql_fetch_array($resConsulta)) {            
                $arreglo["$i"] = $fila["0"];
                $i++;
            }
            return $arreglo;
        }
       
        public function consultaUnDato($query) {
            $dato = -1;
            $resConsulta = $this->consulta($query);
            while ($fila = mysql_fetch_array($resConsulta)) {            
                $dato = $fila["0"];
                break;
            }             
            return $dato;
        }

}

?>