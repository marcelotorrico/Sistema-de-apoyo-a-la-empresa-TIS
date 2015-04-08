<?php 
//include ( 'conexion_pd.php' );
//require_once ( 'documento_class.php' );
/*
*Modelo del documento ORDEN DE CAMBIO 
*TODO Clase Documento
*/
 class OrdenCambio 
 //extends Documento
{
	

	private $idAsesor	   = '';	
	private $titulo		   = '';
	private $nombreEmpresa = '';
	private $asesorNombre  = '';
	private $puntaje       = array();
	private $observaciones = array();
	private $fecha 		   = '';
	private $hora		   = '';
	private $lugar		   = '';
	private $emailDestino  = '';
	private $nombreLargo   = '';
	private $visualizable ;

	public function __construct($titulo,$nombreEmpresa,$asesorNombre,$puntaje,$observaciones,
								$fecha,$hora,$lugar,$emailDestino,$visualizable,$nombreLargo
								) 
	{
		//parent::__construct();
		//$this ->idAsesor      = $idAsesor;
		$this->titulo   	  = $titulo;
		$this ->nombreEmpresa = $nombreEmpresa;
		$this ->asesorNombre  = $asesorNombre;
		$this ->puntaje       = $puntaje;
		$this ->observaciones = $observaciones;
		$this ->fecha         = $fecha;
		$this ->hora 		  = $hora;
		$this ->lugar         = $lugar;
		$this ->emailDestino  = $emailDestino;
		$this ->visualizable  = $visualizable;
		$this ->nombreLargo   =$nombreLargo;
	}

	public function getTitulo()
	{ return $this->titulo; }

	public function getidAsesor()
	{ return $this->idAsesor;}

	public function getNombreEmpresa()
	{ return $this->nombreEmpresa; }

	public function getAsesorNombre()
	{ return $this->asesorNombre; }

	public function getPuntaje()
	{ return $this->puntaje; }

	public function getObservaciones()
	{ return $this->observaciones; }

	public function getFecha()
	{ return $this->fecha; }
	
	public function getHora()
	{ return $this->hora; }

	public function getLugar()
	{ return $this->lugar; }

	public function getEmailDestino()
	{ return $this->emailDestino; }

	public function getVisualizable()
	{
		return $this->visualizable;
	}
	public function getNombreLargo()
	{
		return $this->nombreLargo;
	}





}



?>
