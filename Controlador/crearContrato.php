<?php 
include( '../Librerias/fpdf.php' );
class PDF extends FPDF
{
  private $nLGE;
  private $nCGE;
  private $repL;


// Cabecera de página
  function Header()
  {
    $this->SetFont('times','',20);
    // Movernos a la derecha
    
    $this->Cell(80);
        
    $this->Cell(20,40,'TIS',5,5,'C');
    $this->Ln(-5);
    $this->SetFont('times','',13);
    $subtitulo =utf8_decode('Contrato de prestación de servicios de consultoria');
    $this->Cell(180,1,$subtitulo,5,5,'C');
    $this->Ln(-2);      
  }
  function datosGe($nomL,$nomC,$reL){
    global $nLGE;
    global $nomC;
    global $repL;
    $nLGE=$nomL;	
    $nCGE=$nomC;				
    $repL=$reL;
  }

  function Cuerpo($pdf){
  	global $nLGE;
  	global $nCGE;
  	global $repL;
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf-> Ln(20);
		$pdf->SetFont('Times','',10);

		 $texto = utf8_decode(' Que suscriben la empresa Taller de Ingeniería de Software - TIS, que en lo sucesivo se denominará TIS, por una parte, y la consultora, registrada debidamente en el Departamento de Procesamiento de Datos y Registro e Inscripciones, domiciliada en la ciudad de Cochabamba, que en lo sucesivo se denominará '.$nLGE.', por otra parte, de conformidad a las cláusulas que se detallan a continuación:');
         $pdf->MultiCell(180,5,$texto,0,'L');
         $pdf-> Ln(7);
         $primera = utf8_decode('PRIMERA.- TIS contratará los servicios del Contratista para la provisión del sistema SAETIS, consultoría que se realizará, conforme a la modalidad y  presupuesto entregado por la Consultora, en su documento de propuesta técnica, y normas estipuladas por TIS.');
         $pdf->MultiCell(180,5,$primera,0,'L');
         $pdf-> Ln(5);
         $segundo= utf8_decode('SEGUNDO.- El objeto de este contrato  es la provisión de un producto software.');
         $pdf->MultiCell(180,5,$segundo,0,'L');
         $pdf-> Ln(5);
         $tercero = utf8_decode('TERCERO.- La consultora '.$nLGE.',  se hace responsable por la buena ejecución de las distintas fases, que involucren su ingeniería del proyecto, especificadas en la propuesta técnica corregida de acuerdo al pliego de especificaciones.');
         $pdf->MultiCell(180,5,$tercero,0,'L');
         $pdf-> Ln(5);
         $cuarto= utf8_decode('CUARTO.- Para cualquier otro punto no estipulado en el presente contrato, debe hacerse referencia a la \convocatoria, al Pliego de Especificaciones y/o al PG-TIS (Plan Global - TIS)');
         $pdf->MultiCell(180,5,$cuarto,0,'L');
         $pdf-> Ln(5);
         $quinto= utf8_decode('QUINTO.- Se pone en evidencia que cualquier incumplimiento de las cláusulas estipuladas en el presente contrato, es pasible a la disolución del mismo.');
         $pdf->MultiCell(180,5,$quinto,0,'L');
         $pdf-> Ln(5);
         $sexto=utf8_decode('SEXTO.- La consultora '.$nLGE.',  declara su absoluta conformidad con los términos del presente contrato. Se deja constancia de que los datos y antecedentes personales jurídicos proporcionados por el adjudicatario son verídicos.');
         $pdf->MultiCell(180,5,$sexto,0,'L');
         $pdf-> Ln(5);
         $septimo=utf8_decode('SEPTIMO.- El presente contrato se disuelve también, por cualquier motivo de incumplimiento a normas establecidas en PG-TIS (Plan Global - TIS).');
         $pdf->MultiCell(180,5,$septimo,0,'L');
         $pdf-> Ln(5);
         $octavo=utf8_decode('OCTAVO.- Por la disolución del contrato, TIS tiene todo el derecho de ejecutar la boleta de garantía, que es entregada por el contratado como documento de seriedad de la empresa.');
         $pdf->MultiCell(180,5,$octavo,0,'L');
         $pdf-> Ln(5);
         $noveno=utf8_decode('NOVENO.- La información que TIS brinde al contratado debe ser de rigurosa confidencialidad, y no utilizarse para otros fines que no sea el desarrollo del proyecto.');
         $pdf->MultiCell(180,5,$noveno,0,'L');
         $pdf-> Ln(5);
         $decimo=utf8_decode('DECIMO.- TIS representada por su directorio Lic. Corina Flores V., Lic. M. Leticia Blanco C., Lic. David Escalera F., Lic. Patricia Rodriguez e Ing. Americo Fiorilo, y por otra la consultora \empresa,  representada por su representante legal '.$repL.', dan su plena conformidad a los términos y condiciones establecidos en el presente Contrato de Prestación de Servicios y Consultoría, firmando en constancia al pie de presente documento.');
         $pdf->MultiCell(180,5,$decimo,0,'L');
         $pdf-> Ln(5);
         $fecha = date("d-m-Y");
         $textFechaLugar = 'Cochabamba '.$fecha;
         $pdf-> Ln(5);
         $pdf->MultiCell(180,5,$textFechaLugar,0,'L');
         $textRepres = 'Representante '.$repL;
         $pdf->MultiCell(180,5,$textRepres,0,'L');

		$pdf->Output();
	
  }
  
}

    
 ?>