<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../Librerias/fpdf.php';
include '../Modelo/conexion.php';

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    // Arial bold 15
    $this->SetFont('Times','',20);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,  utf8_decode('NOMBRES DE EMPRESAS'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',14);
    $this->Cell(190,10,'FUNDA-EMPRESA TIS',0,0,'C');
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
    $this->Cell(0,10,  utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(30);
$indice=1;
//$nombreAsesor=$_POST['nombreAsesor'];
//$nombreGrupo=$_POST['nombreGrupo'];
date_default_timezone_set('America/La_Paz');
$fecha=  date('Y-m-d');
$hora=  date("G:H:i");
try {
        $cla=new conexion();
        $consulta=$cla->consulta("SELECT NOMBRE_LARGO,NOMBRE_CORTO FROM lista_ge");
        while ($fila=  mysql_fetch_array($consulta))
        {
            $pdf->MultiCell(130,5,  utf8_decode(utf8_decode("$indice.- NOMBRE LARGO: $fila[0]    NOMBRE CORTO: $fila[1]")));
            $pdf->Ln();
            $pdf->Cell(30);
            $indice++;
        }
        
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
$pdf->Output('','I');



?>