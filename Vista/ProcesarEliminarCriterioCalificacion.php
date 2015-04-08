<?php  
	session_start();
	$UserAct = $_SESSION['usuario'];
	$Crit_C = $_POST['CriterioEliminar'];

	include '../Modelo/conexion.php';
						                    
	$conect = new conexion();

	$formularios = "";

	$ResIdC = $conect->consulta("SELECT ID_CRITERIO_C FROM criteriocalificacion WHERE NOMBRE_CRITERIO_C = '$Crit_C' AND NOMBRE_U = '$UserAct'");

	$IdC = mysql_fetch_row($ResIdC);

	$Ver_Form = $conect->consulta("SELECT ID_FORM FROM from_crit_c WHERE ID_CRITERIO_C = '$IdC[0]'");

	while ($Row_Form = mysql_fetch_row($Ver_Form)) {
		
		$Form[] = $Row_Form;
	}


	if (isset($Form) and is_array($Form)) {

		for ($i=0; $i < count($Form) ; $i++) { 

			$Sel_Form = $conect->consulta('SELECT NOMBRE_FORM FROM formulario WHERE ID_FORM = '.$Form[$i][0].'');

			$NomForm = mysql_fetch_row($Sel_Form);	
	
		}

		echo '<script>alert("El criterio esta en uso por el siguiente formulario: '.$NomForm[0].'");</script>';
		echo '<script>window.location="../Vista/EliminarCriterioCalificacion.php";</script>';
	
	}
	else
	{
		$Del_Ind = $conect->consulta("DELETE FROM indicador WHERE ID_CRITERIO_C = '$IdC[0]'");

		$Del_Crit = $conect->consulta("DELETE FROM criteriocalificacion WHERE ID_CRITERIO_C = '$IdC[0]'");

		if ($Del_Ind and $Del_Crit) {

			echo '<script>alert("Se elimino el criterio correctamente");</script>';
			echo '<script>window.location="../Vista/EliminarCriterioCalificacion.php";</script>';
		
		}
	}	

	

?>