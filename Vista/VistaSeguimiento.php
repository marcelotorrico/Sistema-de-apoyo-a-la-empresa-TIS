<?php
include '../Modelo/conexionPDO.php';
require_once '../Modelo/Model/GrupoEmpresa.php';   
session_start();
$usuario = $_SESSION['usuario'];

$conexion2 = new Conexion();
	
    $ap = $conexion2->consultarTabla("SELECT id_r, nombre_u, estado_e, nombre_r FROM registro , inscripcion WHERE tipo_t = 'actividad planificacion' AND estado_e = 'en proceso' and NOMBRE_UGE=nombre_u and NOMBRE_UA='$usuario';");
    
    $reportes = $conexion2->consultarArreglo("SELECT DISTINCT id_r
									  		 FROM reporte");
    $asistencia = $conexion2->consultarArreglo("SELECT DISTINCT id_r
									  		   FROM asistencia");
    $evaluacion = $conexion2->consultarArreglo("SELECT DISTINCT id_r
									  		   FROM evaluacion");
	$filas = '';

       
	for ($i = 0; $i < count($ap); $i++) { 
		$ge = new GrupoEmpresa($ap[$i][1]);
		$idRegistro = $ap[$i][0];
		$btnAsistencia = '';
		$btnReportes = '';
                 $btnEvaluacion = '';
		
                $btnAsistencia = '<button id="btnAsistencia'.$ap[$i][0].'" class="btn btn-xs btn-danger botonRegistroAsistenciaSemanal">
	                     		  Asistencia <i class="glyphicon glyphicon-check"></i>
	                          </button>';	
		if (in_array($idRegistro, $reportes)) {
			$btnReportes = '<button id="btnReportes'.$ap[$i][0].'" class="btn btn-xs btn-danger btnRegistroReportes" disabled="disabled">
	                     		  Reportes <i class="glyphicon glyphicon-edit"></i>
	                          </button>';
		} else {
			$btnReportes = '<button id="btnReportes'.$ap[$i][0].'" class="btn btn-xs btn-danger btnRegistroReportes">
	                     		  Reportes <i class="glyphicon glyphicon-edit"></i>
	                           </button>';
		}
                if (in_array($idRegistro, $evaluacion   )) {
	
	                         
                          $btnEvaluacion1= '<a href="evaluacion.php?GE='.$idRegistro.'" class="btn btn-default btn-xs" disabled="disabled">Evaluacion</a>';

		} else {
	
                        
                              $btnEvaluacion1= '<a href="evaluacion.php?GE='.$idRegistro.'" class="btn btn-default btn-xs">Evaluacion</a>';
                  
                }
            
                $nota = $conexion2->query("SELECT `NOTA_E` FROM evaluacion where `ID_R`='$idRegistro'");
                $tamano = $nota->rowCount();
                $fechaFinalizacion = $conexion2->query("SELECT f.FECHA_FR FROM  fecha_realizacion as f, registro as a WHERE f.ID_R=a.ID_R and f.ID_R='$idRegistro'");
                $fechaFin = $fechaFinalizacion->fetchColumn();
                date_default_timezone_set('America/La_Paz');
                $fechaAct = date('Y-m-j');
                $stampFechaA = strtotime($fechaAct);
                $stampFechaF = strtotime($fechaFin);
                if ($stampFechaA <= $stampFechaF && $tamano == 0) {
                    $anuncio = "En Proceso";
                    $estado = "En Proceso";
                    $clase = "label label-warning";
                } else if ($tamano == 0) {
                    $anuncio = "&nbsp;Retrasado&nbsp;";
                    $estado = "Retraso";
                    $clase = "label label-danger";
                } else {
                    $anuncio = "&nbsp;Evaluado&nbsp;&nbsp;";
                    $estado = "Registrado";
                    $clase = "label label-success";
                }
   
                $filas .= '<tr data-registro="'.$idRegistro.'">
                <td>'.$ap[$i][3].'</td>
                <td>'.$ge->getNombreCorto().'</td>
                <td><span class="' . $clase . '">' . $anuncio . '</span></td>
                <td>
                '.$btnAsistencia.'
                '.$btnReportes.'
                '.$btnEvaluacion1.'





                </td>
                </tr>';
        
        
                          
     
       
    } 
                             
                          
   
   
    echo '<table class="table table-hover">
			  <thead>
		    	  <tr>
		        	  <th>Actividad</th>
	          	      <th>Grupo-empresa</th>
	          		  <th>Estado</th>
	          		  <th>Acciones</th>
	        	  </tr>
		      </thead>
			  <tbody>
			  	'.$filas.'
			  </tbody>
		  </table>';
    //modalRegistroEvaluacion
    
    ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
               
 



























