<?php 
  include '../Modelo/conexionPDO.php';
  include '../Controlador/crearContrato.php';
  
  session_start();
  $uActivo = $_SESSION['usuario'];
  
  $conexion = new Conexion();

  if (isset($_POST['grupoempresa']))
  {   
    $nLargoGE = $_POST['grupoempresa'];

            if(strnatcasecmp($nLargoGE, "Seleccione una grupo empresa") != 0)
            {

                
               $pdf = new PDF();
               
               
                $seleccion="SELECT NOMBRE_CORTO_GE FROM grupo_empresa WHERE NOMBRE_LARGO_GE = '$nLargoGE'";            
                $consulta = $conexion->query($seleccion);
                $consulta = $consulta->fetch(PDO::FETCH_NUM);
                $nCortoGE =  $consulta[0];
                
                $nombreUA = $_SESSION['usuario'];
                //nombre UA ejemplo LetciaB

                $seleccion="SELECT NOMBRES_A, APELLIDOS_A FROM asesor WHERE NOMBRE_U =  '$nombreUA' ";
                $nomAp = $conexion->query($seleccion);
                $nombreAp = $nomAp->fetch(PDO::FETCH_NUM);
                $asesor = $nombreAp[0]." ".$nombreAp[1] ;
    
                $seleccion = "SELECT REPRESENTANTE_LEGAL_GE FROM grupo_empresa WHERE NOMBRE_LARGO_GE = '$nLargoGE'";            
                $consulta = $conexion->query($seleccion);
                $consulta = $consulta->fetch(PDO::FETCH_NUM);
                $represen = $consulta[0];
                
                $seleccion = "SELECT NOMBRE_U FROM grupo_empresa WHERE NOMBRE_LARGO_GE = '$nLargoGE'";            
                $consulta = $conexion->query($seleccion);
                $consulta = $consulta->fetch(PDO::FETCH_NUM);
                $nombreUGE = $consulta[0];
                
                $seleccion = "SELECT p.`NOMBRE_P` FROM `proyecto` p, `inscripcion_proyecto` ip WHERE ip.`NOMBRE_U` = '$nombreUGE' AND ip.`CODIGO_P` = p.`CODIGO_P`";
                $consulta = $conexion->query($seleccion);
                $consulta = $consulta->fetch(PDO::FETCH_NUM);
                $sistema = $consulta[0];
                
                $seleccion = "SELECT p.`CONVOCATORIA` FROM `proyecto` p, `inscripcion_proyecto` ip WHERE ip.`NOMBRE_U` = '$nombreUGE' AND ip.`CODIGO_P` = p.`CODIGO_P`";
                $consulta = $conexion->query($seleccion);
                $consulta = $consulta->fetch(PDO::FETCH_NUM);
                $convo = $consulta[0];

            //repositorio/usuario asesor/Contratos/CgrupoEmpresa.pdf //realizar esta tarea para guardas los pdfs

              //datos para crear el controo como ser asesor, documento y otros
                $pdf->datosGe($nLargoGE,$nCortoGE,$represen);

                $pdf->cuerpo($pdf);
                /*
                    $comentar = $conexion->query("INSERT INTO registro (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R) VALUES ('$nombreUA','Contrato','Habilitado','$pdf','$fecha','$hora')")or
                    die("Error");
                                                   
                    $consultar= $conexion->query("SELECT MAX(ID_R) AS 'ID_R' FROM registro");
                    
                    if ($regis = $consultar->fetch(PDO::FETCH_NUM)) 
                    {
                        $idRegis = trim($regis[0]);
                    }
                                                   
                    $guardar = $conexion->query("INSERT INTO documento (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D) VALUES('$idRegis','1024','$descrip','$visible','$descargar')");
                    $desD = $conexion->query("INSERT INTO descripcion (ID_R,DESCRIPCION_D) VALUES('$idRegis','Contrato')");
                    $destinat = $conexion->query("INSERT INTO receptor (ID_R,RECEPTOR_R) VALUES('$idRegis','$nLargoGE')");
                     
                     $selGE=$conexion->query("SELECT `NOMBRE_U` FROM `grupo_empresa` WHERE `NOMBRE_LARGO_GE` = '$nLargoGE'");
                     $nomGE=$selGE->fetch(PDO::FETCH_NUM);

                     $estaFir=  $conexion->query("UPDATE `inscripcion_proyecto` SET `ESTADO_CONTRATO`= 'Firmado' WHERE `NOMBRE_U` = '$nomGE[0]'");  

                     //despues de hacer todos los insert necesarios para este documento
                  */

                   // echo"<script type=\"text/javascript\">alert('Se genero el contrato correctamente'); window.location='../Vista/contrato.php';</script>";                    
                     
                }
               
							
            
            else{   
    
               unset ($pdf);
               echo"<script>alert('Por favor, seleccione una grupo empresa'); window.location='../Vista/contrato.php';</script>";  
            }
        }
		
     else
      {
             echo"<script type=\"text/javascript\">alert('Por favor, suba la plantilla del Contrato a su repositorio); window.location='../Vista/contrato.php';</script>";
                                
      }
        
      
  
?>