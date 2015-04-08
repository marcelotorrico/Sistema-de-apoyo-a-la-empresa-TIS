<html>
    
    <head>
        <script src="../Librerias/js/bootstrap-dialog.js"></script>
    </head>
    
</html>

<?php

include '../Modelo/conexion_pd.php';
include '../Modelo/crear_oc_pdf.php';
session_start();

$conexion = new conexion();

$nombreUA = $_SESSION['usuario'] ;
$nomAp = $conexion->query("SELECT NOMBRES_A, APELLIDOS_A FROM asesor WHERE NOMBRE_U =  '$nombreUA' ");
$nombreAp = $nomAp->fetchObject();
$nomA = $nombreAp->NOMBRES_A;
$apeA = $nombreAp->APELLIDOS_A;
$nAsesor = $nomA." ".$apeA ;

if (isset($_POST['lista'])) 
{
    if (isset($_POST['fecha']))
    {
        if (isset($_POST['hora']))
        {
            if (isset($_POST['lugar']))
            {		
                $existeF = FALSE;
                $nombreF = '../Repositorio/asesor/OrdenCambio.tex';
                if (file_exists($nombreF))
                {
                    $existeF = TRUE;
                }
                            
                if($existeF)
                {
                    $nEmpresa=$_POST['lista']; 
                           
                    if(strnatcasecmp($nEmpresa, "Seleccione una grupo empresa")!=0)
                    {
        		$fecha = $_POST['fecha'];
                        $hora = $_POST['hora'];
                        $lugar = $_POST['lugar'];
                        $arr = $_POST['text'];
        				
                        $califi = array();
                        $observ =array();
                        $encontrar = false;
                        $indice = 1;
                        
                        while (!$encontrar)
                        {
                            if(isset($_POST['nombre'.$indice]))
                            {
                              $observ[] = $_POST['nombre'.$indice];
                            }
                            else {
                             $encontrar = true;
                            }
                            $indice++;
                        }
                        
                        $vacio =FALSE;
                        for ($i=0;$i<count($observ);$i++)
                        {
                            if($observ[$i]==null || $observ[$i]=="" || $observ[$i]==" ")
                            {
                                $vacio = TRUE;
                            }
                        }
                                    
                        if($observ == NULL || $vacio == TRUE)
                        {
                            echo "<script type=\"text/javascript\">alert('Las observaciones no pueden estar en blanco '); window.location='../Vista/ordenDeCambio.php';</script>";
                        }
                        else
                        {
			 
                            $queryStat = "SELECT ge.`NOMBRE_U` FROM `grupo_empresa` AS ge WHERE ge.`NOMBRE_LARGO_GE` LIKE '$nEmpresa'";
                            $stmt      = $conexion->query($queryStat);
                            $row       = $stmt->fetchObject();
                            $nombreUGE = $row->NOMBRE_U;

                            $queryStat = "SELECT ge.`NOMBRE_CORTO_GE` FROM `grupo_empresa` AS ge WHERE ge.`NOMBRE_LARGO_GE` LIKE '$nEmpresa'";
                            $stmt      = $conexion->query($queryStat);
                            $row       = $stmt->fetchObject();
                            $nombreCGE = $row->NOMBRE_CORTO_GE;  

                            $queryStat = "SELECT u.`CORREO_ELECTRONICO_U` FROM `usuario` AS u WHERE u.`NOMBRE_U` LIKE '$nombreUA'";
                            $stmt      = $conexion->query($queryStat);
                            $row       = $stmt->fetchObject();
                            $correo    = $row->CORREO_ELECTRONICO_U;

                            $queryStat = "SELECT a.`NOMBRES_A`, a.`APELLIDOS_A` FROM `asesor` AS a WHERE a.`NOMBRE_U` LIKE '$nombreUA'";
                            $stmt      = $conexion->query($queryStat);
                            $row       = $stmt ->fetchObject();
                            $nomAs = $row->NOMBRES_A;
                            $apeAs = $row->APELLIDOS_A;
                            $nCompleto = $nomAs."  ".$apeAs;	

                            $indice=0;
                            foreach ($arr as $key => $value)
                            {
                                $califi [$indice] = $value;
                                $indice++;
                            }



                            $queryProy = "SELECT proyecto.CODIGO_P FROM proyecto, inscripcion_proyecto WHERE proyecto.CODIGO_P = inscripcion_proyecto.CODIGO_P AND NOMBRE_U = '$nombreUGE'";
                            $selProy = $conexion->query($queryProy);
                            $rowProy = $selProy->fetchObject();
                            $proy = $rowProy->CODIGO_P;

                            $queryDocR = $conexion->query("SELECT * FROM documento_r WHERE documento_r.CODIGO_P = '$proy'");
                            $docR = $queryDocR->rowCount();

                            $consulta = $conexion->query("SELECT * FROM registro WHERE NOMBRE_U='$nombreUGE' AND TIPO_T='documento subido'");
                            $DocSub = $consulta->rowCount();

                        
                            if(($DocSub == $docR) and $DocSub>=1)
                            { 
                                if(isset($_GET['id']))
                                {
                                    $buscar = array(
                                        'empresa_nombre_largo' => '[[empresa-nombre-largo]]',
                                        'fecha_actual'         => '[[fecha-actual]]',
                                        'hora_actual'          => '[[hora-actual]]',
                                        'lugar'                => '[[lugar]]',
                                        'primer_p'             => '[[primer-puntaje]]',
                                        'segundo_p'            => '[[segundo-puntaje]]',
                                        'tercer_p'             => '[[tercer-puntaje]]',
                                        'cuarto_p'             => '[[cuarto-puntaje]]',
                                        'quinto_p'             => '[[quinto-puntaje]]',
                                        'sexto_p'              => '[[sexto-puntaje]]',
                                        'septimo_p'            => '[[septimo-puntaje]]',
                                        'obs_det'              => '[[obs-detalle]]',
                                        'obs_det_item'         => '[[obs-detalle-item]]',
                                    );

                                    $remplazo['empresa_nombre_largo'] = $nEmpresa;
                                    $remplazo['fecha_actual'] = $fecha;
                                    $remplazo['hora_actual']  = $hora;
                                    $remplazo['lugar'] = $lugar;

                                    $remplazo['primer_p'] = intval($califi [0]);
                                    $remplazo['segundo_p'] = intval($califi [1]);
                                    $remplazo['tercer_p'] = intval($califi [2]);
                                    $remplazo['cuarto_p'] = intval($califi [3]);
                                    $remplazo['quinto_p'] = intval($califi [4]);
                                    $remplazo['sexto_p'] = intval($califi [5]);
                                    $remplazo['septimo_p'] = intval($califi [6]);


                                    $obDetalle = "[".count($observ)."]{";

                                    for ($i=0;$i<count($observ);$i++)
                                    {
                                        if($i!=0)
                                        {
                                            $obDetalle = $obDetalle." \item #".($i+1);
                                        }
                                        else
                                        {
                                            $obDetalle = $obDetalle."\item #".($i+1);
                                        }
                                    }
                                    
                                    $obDetalle = $obDetalle."}";
                                    $remplazo['obs_det'] = $obDetalle;              

                                    $obDetItem = "";

                                    for ($i=0;$i<count($observ);$i++)
                                    {
                                        $obDetItem= $obDetItem."{".$observ[$i]."}";         
                                    }

                                    $remplazo['obs_det_item'] = $obDetItem;

                                    $ruta ="../Repositorio/asesor";
                                    chdir($ruta);
                                    $rutaD="../".$nombreUGE."/OC/";

                                    $file = "OrdenCambio".'_'.$nEmpresa.'.pdf';

                                    if (!file_exists($rutaD)) 
                                    {
                                        $oldmask = umask(0); 
                                        mkdir($rutaD, 0777,TRUE);
                                        umask($oldmask);
                                        if(!file_exists("../".$nombreUGE."/index.html"))
                                        {
                                            fopen("../".$nombreUGE."/index.html", "x");
                                        }

                                    }
                                    $id = "OrdenCambio";
                                    $tex = $id.".tex";
                                    $log = $id.".log"; 
                                    $aux = $id.".aux";
                                    $pdf = $id.".pdf"; 


                                    $plantilla = "OrdenCambio.tex";

                                    $texto = file_get_contents($plantilla);
                                    $textoAux = file_get_contents($plantilla);


                                    $texto = str_replace($buscar['empresa_nombre_largo'], $remplazo['empresa_nombre_largo'], $texto);
                                    $texto = str_replace($buscar['fecha_actual'], $remplazo['fecha_actual'], $texto);
                                    $texto = str_replace($buscar['hora_actual'], $remplazo['hora_actual'], $texto);
                                    $texto = str_replace($buscar['lugar'], $remplazo['lugar'], $texto);
                                    $texto = str_replace($buscar['primer_p'], $remplazo['primer_p'], $texto);
                                    $texto = str_replace($buscar['segundo_p'], $remplazo['segundo_p'], $texto);
                                    $texto = str_replace($buscar['tercer_p'], $remplazo['tercer_p'], $texto);
                                    $texto = str_replace($buscar['cuarto_p'], $remplazo['cuarto_p'], $texto);
                                    $texto = str_replace($buscar['quinto_p'], $remplazo['quinto_p'], $texto);
                                    $texto = str_replace($buscar['sexto_p'], $remplazo['sexto_p'], $texto);
                                    $texto = str_replace($buscar['septimo_p'], $remplazo['septimo_p'], $texto);
                                    $texto = str_replace($buscar['obs_det'], $remplazo['obs_det'], $texto);
                                    $texto = str_replace($buscar['obs_det_item'], $remplazo['obs_det_item'], $texto);


                                    file_put_contents($tex,$texto);

                                    exec("pdflatex -interaction=nonstopmode $tex",$final);

                                    file_put_contents($tex, $textoAux);
                                    unlink($log);
                                    unlink($aux);

                                   // rename("OrdenCambio.pdf", $file);
                                    rename("OrdenCambio.pdf", $rutaD.$pdf );

                                    $nruta = "../Repositorio/".$nombreUGE."/OC/"."OrdenCambio.pdf";
                                    $fecha = date('Y-m-d');
                                    $hora  = date("G:H:i");
                                    $visible = "TRUE";
                                    $descargar = "TRUE";
                                    $nombreDoc = "Orden de Cambio de ".$nombreCGE;

                                    $nombDoc = "";
                                    $consulta = $conexion->query("SELECT `NOMBRE_R` FROM `registro` WHERE `NOMBRE_R` LIKE '$nombreDoc' ");
                                    $numRows = $consulta->rowCount();
                                   
                                    if($numRows>0)
                                    {
                                      $row= $consulta->fetchObject();
                                      $nombDoc = $row->NOMBRE_R;
                                    }
                                   
                                    if (strcasecmp($nombreDoc, $nombDoc)!=0) 
                                    {
                                       $comentar = $conexion->query("INSERT INTO registro (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R) VALUES ('$nombreUA','publicaciones','Habilitado','$nombreDoc','$fecha','$hora')")or
                                       die("Error");

                                       $consulta= $conexion->query("SELECT MAX(ID_R) AS 'ID_R' FROM registro");
                                       $row = $consulta->fetchObject();
                                       $id = $row -> ID_R;

                                       $guardarD = $conexion->query("INSERT INTO documento (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D) VALUES('$id','1024','$nruta','$visible','$descargar')");
                                       $desD=$conexion->query("INSERT INTO descripcion (ID_R,DESCRIPCION_D) VALUES('$id','Orden de Cambio')");
                                       $destinat=$conexion->query("INSERT INTO receptor (ID_R,RECEPTOR_R) VALUES('$id','$nEmpresa')");
                                       $guardar = $conexion->query("INSERT INTO periodo (ID_R,fecha_p,hora_p) VALUES ('$id','$fecha','$hora')") or
                                       die("Error");
                                    }

                                    echo"<script type=\"text/javascript\">alert('Se genero correctamente la orden de cambio'); window.location='../Vista/ordenDeCambio.php';</script>";  
                               }

                            }
                            else
                            {
                                echo"<script type=\"text/javascript\">alert('La grupo empresa seleccionada aun no ha subido todos los documentos requeridos'); window.location='../Vista/ordenDeCambio.php';</script>"; 
                            }
			}
		    }
                    else
                    {        
                        echo"<script type=\"text/javascript\">alert('Por favor, seleccione una grupo empresa'); window.location='../Vista/ordenDeCambio.php';</script>";  
                    }
                }
                else
                {
                    echo"<script type=\"text/javascript\">alert('Por favor, suba la plantilla de Orden de Cambio a su repositorio'); window.location='../Vista/ordenDeCambio.php';</script>";                  
                }           
            }		
        }	
    }
}

?>