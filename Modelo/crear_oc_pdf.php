<?php
/*
* TODO todo documento deberia ser personalizable 
* Crear una clase formato_para_documento.php
*/
//include ( 'conexion_pd.php' );
include( '../Librerias/fpdf.php' );
include( 'ordencambio_class.php' );
require('registro.php');
require('guardarDocumento.php');
require('descripcion.php');


class ORDENPDF extends FPDF
{
	private $idAsesor	   = '';	

	private $titulo 	   = '';
	private $nombreAsesor  = '';
	private $nombreEmpresa = '';
	private $puntajes      = array();
	private $observaciones = array();
	private $fecha 		   = '';
	private $hora 		   = '';
	private $lugar		   = '';
	private $emailDestino  = '';
	private $nombreLargo   = '';

	private $visualizable;
	
	 

	
	function obtenerOC($ordenCambio)
	{
		$this->titulo        = $ordenCambio->getTitulo();
		$this->nombreAsesor  = $ordenCambio->getAsesorNombre();
		$this->nombreEmpresa = $ordenCambio->getNombreEmpresa();
		$this->puntajes      = $ordenCambio->getPuntaje();
		$this->observaciones = $ordenCambio->getObservaciones();
		$this->fecha         = $ordenCambio->getFecha();
		$this->hora          = $ordenCambio->getHora();
		$this->lugar         = $ordenCambio->getLugar();
		$this->emailDestino  = $ordenCambio->getEmailDestino();
		$this->visualizable  = $ordenCambio->getVisualizable();
		$this->nombreLargo 	 = $ordenCambio->getNombreLargo();

		 
		
	}
	
	 
	/*
	*Encabezado para documento
	*/
	function Header()
	{
	// Logo
	// Arial bold 15
	$this->SetFont('Times','',20);
	// Movernos a la derecha
	$this->Cell(80);
	// Título
	$this->Cell(30,10,  utf8_decode("$this->titulo"),0,0,'C');
	$this->Ln();
	$this->SetFont('Times','',14);
	$this->Cell(190,10,"Lic. "."$this->nombreAsesor",0,0,'C');
	$this->Ln();
	$this->SetFont('Times','',14);
	date_default_timezone_set("America/La_Paz");
	$arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	$fecha_actual= date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');
	$this->Cell(190,10,  utf8_decode("$fecha_actual"),0,0,'C');
	// Salto de línea
	$this->Ln(20);
	}
	// Pie de página
	function Footer()
	{
	// Posición: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Times','',8);
	// Número de página
	$this->Cell(0,10,$this->PageNo().'/{nb}',0,0,'C');
	
	}
	 
	function crearNuevoContenido()
	{
		 
		 
		$this->AliasNbPages();
		$this->AddPage();
		$this->SetFont('Times','',12);
		$this->Cell(30);
		$this->Cell(0,5,  utf8_decode('TIS ha revisado la propuesta que su empresa a entregado y se ha puntuado'),0,1);
		$this->Cell(30);
		$this->Cell(0,5,  utf8_decode('de la siguiente manera :'),0,1);
		$this->Cell(25);
		$this->SetFont('Times','B',12);
		$this->Cell(80,10,  utf8_decode('Descripcíon'),1);
		$this->Cell(38,10,  utf8_decode('Puntaje Referencial'),1,0);
		$this->Cell(35,10,  utf8_decode('Puntaje Obtenido'),1,0);
		$this->Ln(12);
		$this->Cell(25);
		$this->SetFont('Times','',10);
		$this->Cell(80,7,  utf8_decode('Cumplimiento de especificaciones del proponente'),1);
		$this->Cell(38,7,  utf8_decode('15 puntos'),1,0,'C');
		$this->Cell(35,7,  utf8_decode($this->puntajes[0]),1,0,'C');
		$this->Ln();
		$this->Cell(25);
		$this->SetFont('Times','',10);
		$this->Cell(80,7,  utf8_decode('Claridad en la organización de la empresa proponente'),1);
		$this->Cell(38,7,  utf8_decode('10 puntos'),1,0,'C');
		$this->Cell(35,7,  utf8_decode($this->puntajes[1]),1,0,'C');
		$this->Ln();
		$this->Cell(25);
		$this->SetFont('Times','',10);
		$this->Cell(80,7,  utf8_decode('Cumplimiento de especificaciones técnicas'),1);
		$this->Cell(38,7,  utf8_decode('30 puntos'),1,0,'C');
		$this->Cell(35,7,  utf8_decode($this->puntajes[2]),1,0,'C');
		$this->Ln();
		$this->Cell(25);
		$this->SetFont('Times','',10);
		$this->Cell(80,7,  utf8_decode('Claridad en el proceso de desarrollo'),1);
		$this->Cell(38,7,  utf8_decode('10 puntos'),1,0,'C');
		$this->Cell(35,7,  utf8_decode($this->puntajes[3]),1,0,'C');
		$this->Ln();
		$this->Cell(25);
		$this->SetFont('Times','',10);
		$this->Cell(80,7,  utf8_decode('Plazo de Ejecución'),1);
		$this->Cell(38,7,  utf8_decode('10 puntos'),1,0,'C');
		$this->Cell(35,7,  utf8_decode($this->puntajes[4]),1,0,'C');
		$this->Ln();
		$this->Cell(25);
		$this->SetFont('Times','',10);
		$this->Cell(80,7,  utf8_decode('Precio total'),1);
		$this->Cell(38,7,  utf8_decode('15 puntos'),1,0,'C');
		$this->Cell(35,7,  utf8_decode($this->puntajes[5]),1,0,'C');
		$this->Ln();
		$this->Cell(25);
		$this->SetFont('Times','',10);
		$this->Cell(80,7,  utf8_decode('Uso de herramientas en el proceso de desarrollo'),1);
		$this->Cell(38,7,  utf8_decode('10 puntos'),1,0,'C');
		$this->Cell(35,7,  utf8_decode($this->puntajes[6]),1,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(30);
		$this->Cell(0,5,  utf8_decode('TIS después de revisar la propuesta de su empresa '."$this->nombreLargo,"));
		$this->Ln();
		$this->Cell(30);
		$this->Cell(0,5,  utf8_decode('tiene las siguientes observaciones:'));
		$this->Ln();
		$this->Cell(30);
		$indice=1;
		for ($i=0;$i<count($this->observaciones);$i++)
		{
		    $nro =$i+1;
    		$this->MultiCell(130,5,  utf8_decode("$nro. ".$this->observaciones[$i]));
			$this->Ln();
			$this->Cell(30);
			$indice++;
		}
		$this->MultiCell(130,5,  utf8_decode('Esta adenda de corrección debe ser entregada por correo electrónico antes de la firma del contrato, misma que debe hacerse llegar al correo'." $this->emailDestino ".''),0,'J');
		$this->Cell(30);
		$this->MultiCell(130,5,  utf8_decode('Paralelamente se solicita, indicar el día de su preferencia para realizar revisiones, puesta en marcha y seguimiento de su propuesta de desarrollo en el tiempo que dure el contrato con TIS.'),0,'J');
		$this->Ln(2);
		$this->Cell(30);
		$this->MultiCell(130,5,  utf8_decode('Así mismo, recordar que para el día de la firma del contrato que se realizará el día '."$this->fecha".', a horas '."$this->hora".' en el '."$this->lugar".'; se requiere de una copia física de la Boleta de Garantía, emitida a favor de TIS por parte de '."$this->nombreLargo".'.'),0,'J');
		$rutaDirectorio="../Repositorio/".$this->nombreLargo."/OC/";
		$file = $this->titulo.'_'.$this->nombreLargo.'.pdf';
		
		if (!file_exists($rutaDirectorio)) {
		mkdir($rutaDirectorio, 0777,TRUE);
		}

		if(!$this->visualizable) {
			
			$rutaDocumento="/Repositorio/".$this->nombreLargo."/OC/".$file.".pdf";
    
			$this->registro= new Registro($this->nombreEmpresa,'orden de cambio','habilitado',$file,$this->fecha,$this->hora);
			$this->idRegistro = $this->registro->getIdRegistro();
			$this->documento = new GuardarDocumento($this->idRegistro,1024,$rutaDocumento,FALSE,FALSE);
			$this->descripcionOB = new Descripcion($this->idRegistro,'Para su consideracion...');

			$this->Output("$rutaDirectorio/"."$file",'F');
		}
		else {

			$rutaDocumento="../Repositorio/".$this->nombreLargo."/OC/".$file.".pdf";
			if(!file_exists($rutaDocumento)){
			$this->Output($rutaDocumento,'I');
			echo '<embed width="100%" height="100%" name="plugin" src="'.$rutaDocumento.'" type="application/pdf">';
			}
			else{
			
				//$this->Output("$rutaDirectorio/"."$file",'F');
				//echo '<embed width="100%" height="100%" name="plugin" src="'.$rutaDocumento.'" type="application/pdf">';
				//unlink($rutaDocumento);
			}

		}		

	}
	

}
/*
$obs = array( 'A','B','C','D','E' );
$puntajes = array(12,100,55,12,9,9,9 );
$oc  = new OrdenCambio('orden de cambio','BitSoft','Patricia Rodriguez',$puntajes,$obs,'27/05/2014','14:00',',MEMI',' akire@memi.com',1);
$pdf = new ORDENPDF();
$pdf->obtenerOC($oc);
$pdf->crearNuevoContenido();
*/


 
//echo "ORDEN DE CAMBIO ENVIADA EXITOSAMENTE...";
?>