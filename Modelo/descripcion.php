<?php
//require_once('conexion_pd.php');
class Descripcion 
{
	const TABLA = 'descripcion';

	private $idRegistro;
	private $descripcion;

	private $conexion;

	public function __construct($idR,$descripcion)
	{	
		$this->conexion = new Conexion();
		
		$this->idRegistro = $idR;
		$this->descripcion = $descripcion;

		$this->save();
	}

	private function save()
	{
		$consulta = $this->conexion->prepare('INSERT INTO ' . self::TABLA .' (ID_R,DESCRIPCION_D)
		VALUES(:idRegistro,:descripcion)');

		$consulta->bindParam(':idRegistro', $this->idRegistro);
		$consulta->bindParam(':descripcion', $this->descripcion);
		
		$consulta->execute();
		
	}
}
//$descrip = new Descripcion(4,'Esto es una prueba de descripcion');