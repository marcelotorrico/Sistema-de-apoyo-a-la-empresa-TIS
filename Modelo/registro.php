<?php

require_once('conexion_pd.php');

class Registro
{
	const TABLA = 'registro';

	private $idRegistro;
	private $nombreU;
	private $tipo;
	private $estado;
	private $nombreRegistro;
	private $fecha;
	private $hora;
	private $conexion;

	public function __construct($nombreU,$tipo,$estado,$nombreRegistro,$fecha,$hora)
	{
		$this->conexion = new Conexion();

		//$this->idRegistro = $idRegistro;
		$this->nombreU = $nombreU;
		$this->tipo = $tipo;
		$this->estado = $estado;
		$this->nombreRegistro = $nombreRegistro;
		$this->fecha = $fecha;
		$this->hora = $hora;

		$this->save();

		
	}
	private function save()
	{
		$queryID = "SELECT auto_increment FROM `information_schema`.tables WHERE TABLE_SCHEMA = 'saetis' AND TABLE_NAME = 'registro'";
		$stmt      = $this->conexion->query($queryID);
		$row       = $stmt->fetchObject();
		$this->idRegistro = $row->auto_increment;
		//echo ($st);

		$consulta = $this->conexion->prepare('INSERT INTO ' . self::TABLA .' (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R)
		VALUES(:nombreU,:tipo,:estado,:nombreRegistro,:fecha,:hora)');

		$consulta->bindParam(':nombreU', $this->nombreU);
		$consulta->bindParam(':tipo', $this->tipo);
		$consulta->bindParam(':estado', $this->estado);
		$consulta->bindParam(':nombreRegistro', $this->nombreRegistro);
		$consulta->bindParam(':fecha', $this->fecha);
		$consulta->bindParam(':hora', $this->hora);
		
		$consulta->execute();

	}
	public function getIdRegistro()
	{
		return $this->idRegistro;
	}

	public function getNombreUsuario()
	{
		return $this->nombreU;
	}
	
	public function getTipo()
	{
		return $this->tipo;
	}
	
	public function getEstado()
	{
		return $this->estado;
	}
	public function getnombreRegistro()
	{
		return $this->nombreRegistro;
	}
	public function getFecha()
	{
		return $this->fecha;
	}
	public function getHora()
	{
		return $this->hora;
	}
	
}

?>