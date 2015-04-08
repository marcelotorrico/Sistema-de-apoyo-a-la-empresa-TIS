<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Librerias/fpdf.php';
include '../Modelo/conexion.php';

$nombreEmpresa=$_POST['lista'];

$con = new conexion();
$resultadoDos=$con->consulta("SELECT ge.`NOMBRE_U` FROM `grupo_empresa` AS ge WHERE ge.`NOMBRE_LARGO_GE` LIKE '$nombreEmpresa'");
    while ($filasDos = mysql_fetch_array($resultadoDos)) {
        $idGrupoEmpresa=$filasDos['0'];
    }


$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$lugar=$_POST['lugar'];
$cali1=$_POST['cali1'];
$cali2=$_POST['cali2'];
$cali3=$_POST['cali3'];
$cali4=$_POST['cali4'];
$cali5=$_POST['cali5'];
$cali6=$_POST['cali6'];
$cali7=$_POST['cali7'];
$idAsesor=$_POST['idUsuarioAsesor'];
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
    $this->Cell(30,10,  utf8_decode('Notificación de Conformidad'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',14);
    $this->Cell(190,10,'Ma. Leticia Blanco Coca',0,0,'C');
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
$pdf->Cell(0,5,  utf8_decode('TIS ha revisado la propuesta que su empresa a entregado y se ha puntuado'),0,1);
$pdf->Cell(30);
$pdf->Cell(0,5,  utf8_decode('de la siguiente manera :'),0,1);
$pdf->Cell(25);
$pdf->SetFont('Times','B',12);
$pdf->Cell(80,10,  utf8_decode('Descripcíon'),1);
$pdf->Cell(38,10,  utf8_decode('Puntaje Referencial'),1,0);
$pdf->Cell(35,10,  utf8_decode('Puntaje Obtenido'),1,0);
$pdf->Ln();
$pdf->Cell(25);
$pdf->SetFont('Times','',10);
$pdf->Cell(80,7,  utf8_decode('Cumplimiento de especificaciones del proponente'),1);
$pdf->Cell(38,7,  utf8_decode('15 puntos'),1,0,'C');
$pdf->Cell(35,7,  utf8_decode("$cali1"),1,0,'C');
$pdf->Ln();
$pdf->Cell(25);
$pdf->SetFont('Times','',10);
$pdf->Cell(80,7,  utf8_decode('Claridad en la organización de la empresa proponente'),1);
$pdf->Cell(38,7,  utf8_decode('10 puntos'),1,0,'C');
$pdf->Cell(35,7,  utf8_decode("$cali2"),1,0,'C');
$pdf->Ln();
$pdf->Cell(25);
$pdf->SetFont('Times','',10);
$pdf->Cell(80,7,  utf8_decode('Cumplimiento de especificaciones técnicas'),1);
$pdf->Cell(38,7,  utf8_decode('30 puntos'),1,0,'C');
$pdf->Cell(35,7,  utf8_decode("$cali3"),1,0,'C');
$pdf->Ln();
$pdf->Cell(25);
$pdf->SetFont('Times','',10);
$pdf->Cell(80,7,  utf8_decode('Claridad en el proceso de desarrollo'),1);
$pdf->Cell(38,7,  utf8_decode('10 puntos'),1,0,'C');
$pdf->Cell(35,7,  utf8_decode("$cali4"),1,0,'C');
$pdf->Ln();
$pdf->Cell(25);
$pdf->SetFont('Times','',10);
$pdf->Cell(80,7,  utf8_decode('Plazo de ejecución'),1);
$pdf->Cell(38,7,  utf8_decode('10 puntos'),1,0,'C');
$pdf->Cell(35,7,  utf8_decode("$cali5"),1,0,'C');
$pdf->Ln();
$pdf->Cell(25);
$pdf->SetFont('Times','',10);
$pdf->Cell(80,7,  utf8_decode('Precio total'),1);
$pdf->Cell(38,7,  utf8_decode('15 puntos'),1,0,'C');
$pdf->Cell(35,7,  utf8_decode("$cali6"),1,0,'C');
$pdf->Ln();
$pdf->Cell(25);
$pdf->SetFont('Times','',10);
$pdf->Cell(80,7,  utf8_decode('Uso de herramientas en el proceso de desarrollo'),1);
$pdf->Cell(38,7,  utf8_decode('10 puntos'),1,0,'C');
$pdf->Cell(35,7,  utf8_decode("$cali7"),1,0,'C');
$pdf->Ln();
$pdf->SetFont('Times','',12);
$pdf->Cell(30);
$pdf->MultiCell(130,5,  utf8_decode('TIS acepta la propuesta técnica presentada por su empresa: '."$nombreEmpresa.".' Por lo que solicita hacerse presente el '."$fecha".' a realizar la firma de contrato, en '.$lugar.', a horas '."$hora."));
$pdf->Cell(30);
$pdf->MultiCell(130, 5, utf8_decode('Paralelamente se solicita, indicar el dia de su preferencia para realizar revisiones, puesta en marcha y seguimiento de su propuesta de desarrollo en el tiempo que dure el contrato con TIS.'));
$pdf->Cell(30);
$pdf->MultiCell(130,5,  utf8_decode('Asímismo, recordar que para el día de la firma del contrato se requiere de una copia física de la Boleta de Garantía, emitida a favor de TIS por parte de '."$nombreEmpresa."));

$rutaDirectorio="../Repositorio/$idGrupoEmpresa/NC";
if (!file_exists($rutaDirectorio)) {
    mkdir($rutaDirectorio, 0777,TRUE);
}
try {
    
    
    $resultadoUno=$con->consulta("SELECT auto_increment FROM `information_schema`.tables WHERE TABLE_SCHEMA = 'saetis' AND TABLE_NAME = 'registro'");
    while ($filas = mysql_fetch_array($resultadoUno)) {
        $idRegistro=(integer)$filas['0'];
    }
    
    
    
    $visualizable=TRUE;
    $descargable=TRUE;
    $rutaDocumento="/Repositorio/".$idGrupoEmpresa."/NC/".$idGrupoEmpresa."_NC.pdf";
    $con->consulta("INSERT INTO `registro` (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R)  VALUES ('$idGrupoEmpresa','notificacion de conformidad','habilitado','".$idGrupoEmpresa."_NC.pdf','".date("Y-m-d")."','".  date("G:H:i")."')");
    $con->consulta("INSERT INTO `documento` (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D) VALUES ($idRegistro,4444,'$rutaDocumento','$visualizable','$descargable')");
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

$pdf->Output("$rutaDirectorio/".$idGrupoEmpresa."_NC.pdf",'F');
$con->cerrarConexion();
echo "<script type=\"text/javascript\">alert('Notificaci\u00f3n de conformidad enviada....'); window.location='notificacion_conformidad.php';</script>";


?>