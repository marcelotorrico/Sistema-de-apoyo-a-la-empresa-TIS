<?php
    require_once '../Modelo/Accion.php';

    class Indice extends Accion {
        public function ejecutar($datos) {
            
        }

        public function obtenerDatos() {
            $barra = $this->barraNavegacion();
            $datos = array(
                "barraDeNavegacion" => "$barra",
            );
            return $datos;
        }
    }
?>