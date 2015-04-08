<?php
require_once( 'conexion_pd.php' );

Class GuardarDocumento
{
	const TABLA = 'documento';

	private $idRegistro ;
	private $tamanioDocumento;
	private $rutaDocumento;
	private $visualizable;
	private $descargable;
	private $conexion;

	public function __construct($idRegistro,$tamanioDocumento,$rutaDocumento,$visualizable,$descargable)
	{
		$this->conexion = new Conexion();
		$this->idRegistro = $idRegistro;
		$this->tamanioDocumento = $tamanioDocumento;
		$this->rutaDocumento = $rutaDocumento;
		$this->visualizable = $visualizable;
		$this->descargable = $descargable;

		$this->save();
			
	}
	private function save()
	{
		$consulta = $this->conexion->prepare('INSERT INTO ' . self::TABLA .' (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D)
		VALUES(:idRegistro,:tamanioDocumento,:rutaDocumento,:visualizable,:descargable)');

		$consulta->bindParam(':idRegistro', $this->idRegistro);
		$consulta->bindParam(':tamanioDocumento', $this->tamanioDocumento);
		$consulta->bindParam(':rutaDocumento', $this->rutaDocumento);
		$consulta->bindParam(':visualizable', $this->visualizable);
		$consulta->bindParam(':descargable', $this->descargable);
		
		$consulta->execute();


	}
	public function getIdRegistro() {
		return $this->idRegistro;
	}

}
//$doc = new GuardarDocumento(9,65656,'uploads',FALSE,FALSE);

?>