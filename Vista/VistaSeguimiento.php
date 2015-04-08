

<?php

        require_once '../Modelo/conexion.php';
        require_once '../Modelo/Model/GrupoEmpresa.php';   
        session_start();
        $usuario = $_SESSION['usuario'];
     
	$conexion = new conexion();
	$conexion->conectar();
	
    $ap = $conexion->consultarTabla("SELECT id_r, nombre_u, estado_e, nombre_r FROM registro , inscripcion WHERE tipo_t = 'actividad planificacion' AND estado_e = 'en proceso' and NOMBRE_UGE=nombre_u and NOMBRE_UA='$usuario';");
    
    $reportes = $conexion->consultarArreglo("SELECT DISTINCT id_r
									  		 FROM reporte");
    $asistencia = $conexion->consultarArreglo("SELECT DISTINCT id_r
									  		   FROM asistencia");
    $evaluacion = $conexion->consultarArreglo("SELECT DISTINCT id_r
									  		   FROM evaluacion");
    
	$filas = '';

       
	for ($i = 0; $i < count($ap); $i++) { 
		$ge = new GrupoEmpresa($ap[$i][1]);
		$idRegistro = $ap[$i][0];
		$btnAsistencia = '';
		$btnReportes = '';
                 $btnEvaluacion = '';
		if (in_array($idRegistro, $asistencia)) {
			$btnAsistencia = '<button id="btnAsistencia'.$ap[$i][0].'" class="btn btn-xs btn-danger btnRegistroAsistencia" disabled="disabled">
	                     		  Asistencia <i class="glyphicon glyphicon-check"></i>
	                          </button>';
		} else {
			$btnAsistencia = '<button id="btnAsistencia'.$ap[$i][0].'" class="btn btn-xs btn-danger btnRegistroAsistencia">
	                     		  Asistencia <i class="glyphicon glyphicon-check"></i>
	                          </button>';
		}
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
            
    
   
   
   

                $filas .= '<tr data-registro="'.$idRegistro.'">
                <td>'.$ap[$i][3].'</td>
                <td>'.$ge->getNombreCorto().'</td>
                <td><span class="label label-success">'.$ap[$i][2].'</span></td>
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
               
 



























