<?php

	require_once '../Modelo/conexionPDO.php';
	require_once '../Modelo/Model/GrupoEmpresa.php';   
	session_start();
	$usuario = $_SESSION['usuario'];
     
        require '../Controlador/ValidadorInicioSesion.php';

        $verificar = new ValidadorInicioSesion();
        $verificar->validarInicioSesion($usuario,"asesor");

	$conexion = new Conexion();	

    $conGrupos = $conexion->query("SELECT inscripcion.NOMBRE_UGE, proyecto.NOMBRE_P FROM inscripcion,inscripcion_proyecto,proyecto WHERE inscripcion.NOMBRE_UA = '$usuario' AND inscripcion.NOMBRE_UGE = inscripcion_proyecto.NOMBRE_U AND inscripcion_proyecto.CODIGO_P = proyecto.CODIGO_P AND inscripcion.ESTADO_INSCRIPCION = 'Habilitado' AND inscripcion_proyecto.ESTADO_CONTRATO='Firmado'");   
	$filas = '';

	date_default_timezone_set('America/Puerto_Rico');
	$FechaActual = date('Y:m:j');

	while($rowGrupos = $conGrupos->fetch(PDO::FETCH_NUM))
	{

		$ge = new GrupoEmpresa($rowGrupos[0]);
		$btnAsist = '';
		$btnRepor = '';

		$grupo = $ge->getNombreCorto();

	    

	    $btnRepor = '<button id="btnReportes" class="btn btn-xs btn-danger btnRegistroReportesSemanal">
	                     		  Reportes <i class="glyphicon glyphicon-edit"></i>
	                           </button>';  
	    
	    $btnSeg='<button id="btnSeguimientos" class="btn btn-xs btn-danger btnSeguimientoSemanal">
	                    		 Ver Seguimientos 
	                           </button>';

	    $sel_hito = $conexion->query("SELECT * FROM registro WHERE FECHA_R = '$FechaActual' AND NOMBRE_U='$grupo' AND TIPO_T='actividad planificacion'");  

	    if($sel_hito->rowCount() > 0)
	    {
	    	$filas .=  '<tr data-usuario="'.$rowGrupos[0].'">
                		<td>'.$ge->getNombreCorto().'</td>
                		<td>'.$rowGrupos[1].'</td>
                		<td>
                			<a href="../Vista/lista_evaluacion.php" class="btn btn-xs btn-success">Revision de Hito</a>
                		</td>
                		<td>
                			'.$btnRepor.'
                			'.$btnSeg.'
                		</td>
                	</tr>';
    	}
    	else
    	{
    		$filas .=  '<tr data-usuario="'.$rowGrupos[0].'">
                		<td>'.$ge->getNombreCorto().'</td>
                		<td>'.$rowGrupos[1].'</td>
                		<td>
                			<a class="btn btn-xs btn-warning">Ninguna</a>
                		</td>
                		<td>
                			'.$btnRepor.'
                			'.$btnSeg.'
                		</td>
                	</tr>';

    	}

        

	}
   
    echo   '<table class="table table-hover">
			  	<thead>
		    	  	<tr>
	          	      	<th>Grupo-empresa</th>
	          	      	<th>Proyecto</th>
	          		  	<th>Actividad</th>
	          		  	<th>Acciones</th>
	        	  	</tr>
		      	</thead>
			  	<tbody>
			  		'.$filas.'
			  	</tbody>
		    </table>';
    
    ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
               
 



























