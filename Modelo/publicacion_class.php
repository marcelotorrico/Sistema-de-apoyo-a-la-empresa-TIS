<?php 
include ('conexion_pd.php');
require('registro.php');
require('guardarDocumento.php');
require('descripcion.php');

class Publicacion 
{

		const TABLAT = 'tipo';
		

		
		private $idRegistro;
		private $nombreUsuario;
		private $tipo;
		private $estado;
		private $nombreRegistro;
		private $fechaRegistro ;
		private $horaRegistro;
		
		private $descripcion ;
		private $tamanio;
		private $rutaDocumento;
		private $visualizable;
		private $descargable;

		/*
		*@
		*/
		private $registro ;
		private $documento;
		private $descripcionOB;
		
		public function __construct($nombreUsuario,$tipo,$estado,$nombreRegistro,$fechaRegistro,
									$horaRegistro,$tamanio,$rutaDocumento,$visualizable,$descargable,$descripcion)  
		{
			$this->registro= new Registro($nombreUsuario,$tipo,$estado,$nombreRegistro,$fechaRegistro,$horaRegistro);
			$this->idRegistro = $this->registro->getIdRegistro();
			$this->documento = new GuardarDocumento($this->idRegistro,$tamanio,$rutaDocumento,$visualizable,$descargable);
			$this->descripcionOB = new Descripcion($this->idRegistro,$descripcion);


			
			
		}
		



}
//$publi1 = new Publicacion('camaleon','publicaciones','habilitado','publicacion','06/08/2014','21:04',65656,'upload.pdf',FALSE,FALSE,'Esto es una prueba de descripcion');
// $publi1->save();
?>