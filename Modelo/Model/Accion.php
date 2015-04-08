<?php
	require_once '../Modelo/BarraNavegacion.php';
	
	abstract class Accion
	{
	    abstract public function ejecutar($datos);
	    abstract public function obtenerDatos();
	    
	    public function barraNavegacion(){
	        $rol = $_SESSION['usuario']->getRol();
	        $barraNav = new BarraNavegacion($rol);
	        return $barraNav->obtenerBarraNavegacion();
	    }  
	        
	    public function ejecucionSegura($datos){
	        $res =  "";
	        $verificar = $_SESSION['usuario']->validarAccesoVista($datos['vista']);
	        if($verificar){
	            $res  = $this->ejecutar($datos);
	        }else{            
	            $aviso = "Acceso denegado";
	            header("Location: ../Controlador/Controlador.php?vista=Aviso&aviso=$aviso");
	        }       
	        return $res;
	    }
	}
?>