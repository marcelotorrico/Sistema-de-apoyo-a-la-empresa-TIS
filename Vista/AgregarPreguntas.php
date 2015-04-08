<?php 


	include '../Modelo/conexion.php';
	session_start();
	$conect = new conexion(); 
    $UsuarioActivo = $_SESSION['usuario'];



    $CriteriosEvaluacion = $conect->consulta("SELECT NOMBRE_CRITERIO_E FROM criterio_evaluacion WHERE NOMBRE_U = '$UsuarioActivo'");

    $CriteriosCalificacion = $conect->consulta("SELECT NOMBRE_CRITERIO_C FROM criteriocalificacion WHERE NOMBRE_U ='$UsuarioActivo'");

    echo '<div id="escogidos">';
    	echo '<div class="form-group">';
    	echo 'Seleccione el criterios a evaluar:';
    		echo '<select class="form-control" name="EvaEscogidos[]" required>';
        		echo '<option value="">Seleccione un Criterio a Evaluar</option>';

	while ($v2 = mysql_fetch_row($CriteriosEvaluacion)) {

            	echo '<option>'.$v2[0].'</option>';
    }
        	echo '</select>';
        echo '</div>';
   

    	echo '<div class="form-group">';
        	echo '<select class="form-control" name="CritEscogidos[]" required>';
            	echo '<option value="">Seleccione un Tipo de Calificacion</option>';
                                                                    
    while ($v3 = mysql_fetch_row($CriteriosCalificacion)) {

            	echo '<option value="'.$v3[0].'">'.$v3[0].'</option>';

    }

        	echo '<select>';
    	echo '</div>';

    	echo '<div class="form-group">';
    	echo 'Puntaje en el formulario: ';
        	echo '<input type="text" name="PuntajeForm[]" pattern="\b[1-9][0-9]" title="el puntaje no puede ser mayor ni igual a 100"  required>';
    	echo '</div>';

        echo '<div class="form-group">';
            echo '<button class="btn btn-danger btn-xs" type="button" id="pruebaEliminar"> <span class="glyphicon glyphicon-minus"></span> Eliminar</button>';
        echo '</div>';
    	echo '<hr>';
    echo '</div>';

    

 ?>