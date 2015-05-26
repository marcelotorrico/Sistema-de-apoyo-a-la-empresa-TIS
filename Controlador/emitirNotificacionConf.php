<?php
include( '../Librerias/fpdf.php' );

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {
    $this->SetFont('times','',20);
    // Movernos a la derecha
    
    $this->Cell(80);
        
    $this->Cell(30,10,'Notificacion de Conformidad',5,5,'C');
    $this->Ln(0);
    $this->SetFont('times','',13);
    $this->Cell(190,15,'Ma. Leticia Blanco Coca',5,5,'C');
    $this->Ln(-2);

    $fecha= $_POST['fecha'];
    $this->Cell(190,10,$fecha,5,5,'C');
    // Salto de línea
    $this->Ln(5);

  }
 
  // Pie de página
  function Footer()
  {

    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',10);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    $this->Cell(190);

  }
    function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10, 59);
        $this->SetFont('Arial','B',10);

        $primer=$cabecera[0];
        $this->Cell(100,7, utf8_decode($primer),1, 0 , 'L' );
        $segundo=$cabecera[1];
        $this->Cell(35,7, utf8_decode($segundo),1, 0 , 'L' );
        $tercero=$cabecera[2];
        $this->Cell(35,7, utf8_decode($tercero),1, 0 , 'L' );
      
    }
 
    function datosHorizontal($datos)
    {
        $this->SetXY(10,66);
        $this->SetFont('Arial','',10);
        foreach($datos as $fila)
        {
            $this->Cell(100,7, utf8_decode($fila['Descripcion']),1, 0 , 'L' );
            $this->Cell(35,7, utf8_decode($fila['Puntaje Referencial']),1, 0 , 'L' );
            $this->Cell(35,7, utf8_decode($fila['Puntaje Obtenido']),1, 0 , 'L' );
            $this->Ln();//Salto de línea para generar otra fila
        }
    }
 
    //Integrando cabecera y datos en un solo método
    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
}
class CREAR_DIRECTORIO
{
   function crear($nombreG)
   { 
     $rutaGE = "../Repositorio/$nombreG";
     $rutaNC = "../Repositorio/$nombreG/NC";
      if (!file_exists($rutaGE)) {
             mkdir($rutaGE);  
            if(!file_exists($rutaNC)){
              mkdir($rutaNC);
            }
       }
      else{
            if(!file_exists($rutaNC)){
                  mkdir($rutaNC);
                }
       }
     }
}

///instancia para crear el DIRECTORIO
$grupoE  = $_POST['lista'];
 $dir = new CREAR_DIRECTORIO();
 $dir->crear($grupoE);

//instancia para crear el PDF

  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf-> Ln(5);
  $pdf->SetFont('Times','',12);
  $texto = 'Tis ha revisado la propuesta que su empresa a entregado y se ha apuntado de la siguiente manera:';
  $pdf->MultiCell(900,5,$texto,0,'L');

/////////////variables post
  $grupo_e  = $_POST['lista'];
  //puntaje obtenido
  $cump_e   = $_POST['text1'];
  $clar_o   = $_POST['text2'];
  $cump_et  = $_POST['text3'];
  $clar_proc= $_POST['text4'];
  $pla_e    = $_POST['text5'];
  $pre_tot  = $_POST['text6'];
  $uso_herr = $_POST['text7'];
  //hora, fecha y lugar 
  $fecha    = $_POST['fecha'];
  $hora     = $_POST['hora'];
  $lugar    = $_POST['lugar'];
   
  /////////////////////////////
  $miCabecera = array('Descripcion', 'Puntaje Referencial', 'Puntaje Obtenido');
  $misDatos = array(
              array('Descripcion' => 'Cumplimiento de especificaciones', 'Puntaje Referencial' => '15', 'Puntaje Obtenido' => $cump_e),
              array('Descripcion' => 'Claridad en la organizacion de la empresa proponente ', 'Puntaje Referencial' => '10', 'Puntaje Obtenido' => $clar_o),
              array('Descripcion' => 'Cumplimieto de especificaciones técnicas', 'Puntaje Referencial' => '30', 'Puntaje Obtenido' => $cump_et),
              array('Descripcion' => 'Claridad en el proceso de desarrollo ', 'Puntaje Referencial' => '10', 'Puntaje Obtenido' => $clar_proc),
              array('Descripcion' => 'Plazo de ejecucion', 'Puntaje Referencial' => '10', 'Puntaje Obtenido' => $pla_e),
              array('Descripcion' => 'Precio Total', 'Puntaje Referencial' => '15', 'Puntaje Obtenido' => $pre_tot),
              array('Descripcion' => 'Cumplimiento de especificaciones', 'Puntaje Referencial' => '10', 'Puntaje Obtenido' => $uso_herr)
              );
   
  $pdf->tablaHorizontal($miCabecera, $misDatos); 
  ///texto para escribir en el pdf
  $texto1 = utf8_decode('TIS acepta la propuesta técnica presentada por su empresa: ' .$grupo_e.'. Por lo que solicita hacerse presente el ' .$fecha .' a horas '.$hora. ' a realizar la firma de contrato, en oficinas del programa MEMI.');
  $texto2 = utf8_decode('       Paralelamente se solicita, indicar que el dia de su preferencia para realizar revisiones, puesta en marcha y seguimiento de su propuesta de desarrollo en el tiempo que dure el contrato con TIS.');
  $texto3 = utf8_decode('       Asimismo, recordar que para el dia de la firma de contrato se requiere de una copia fisica de la Boleta de Garantia, emitida a favor de TIS por parte de '.$grupo_e.' .');
 ///comenzar a escribir
 
    $pdf->MultiCell(180,5,$texto1,0,'L'); 
    $pdf->MultiCell(180,5,$texto2,0,'L');
    $pdf->MultiCell(180,5,$texto3,0,'L');

///salida al navegador


$destinoPdf = '../Repositorio/'.$grupoE.'/NC/notificacionDeConformidad.pdf';

$pdf->Output($destinoPdf,'F'); 
if (file_exists($destinoPdf)) {
   $alerta = 'Se creo la orden correctamente';
    echo "<script>alert('$alerta'); window.location='../Vista/notificacion_conformidad.php';</script>"; 
  
} else {
   $alerta = 'Ocurrio un error intentelo nuevamente';
   echo "<script>alert('$alerta'); window.location='../Vista/notificacion_conformidad.php';</script>";
}


?>