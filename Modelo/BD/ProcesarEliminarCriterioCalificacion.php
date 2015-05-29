<?php  
	session_start();
	$UserAct = $_SESSION['usuario'];
	$Crit_C = $_POST['CriterioEliminar'];

	include '../conexionPDO.php';
						                    
	$conect = new Conexion();

	$formularios = "";

	$ResIdC = $conect->query("SELECT ID_CRITERIO_C FROM criteriocalificacion WHERE NOMBRE_CRITERIO_C = '$Crit_C' AND NOMBRE_U = '$UserAct'");

	$IdC = $ResIdC->fetch(PDO::FETCH_NUM);

	$Ver_Form = $conect->query("SELECT ID_FORM FROM from_crit_c WHERE ID_CRITERIO_C = '$IdC[0]'");

	while ($Row_Form = $Ver_Form->fetch(PDO::FETCH_NUM)) {
		
		$Form[] = $Row_Form;
	}


	if (isset($Form) and is_array($Form)) {

		for ($i=0; $i < count($Form) ; $i++) { 

			$Sel_Form = $conect->query('SELECT NOMBRE_FORM FROM formulario WHERE ID_FORM = '.$Form[$i][0].'');

			$NomForm = $Sel_Form->fetch(PDO::FETCH_NUM);
	
		}

		echo '<script>alert("El criterio esta en uso por el siguiente formulario: '.$NomForm[0].'");</script>';
		echo '<script>window.location="../../Vista/EliminarCriterioCalificacion.php";</script>';
	
	}
	else
	{
		$Del_Ind = $conect->query("DELETE FROM indicador WHERE ID_CRITERIO_C = '$IdC[0]'");

		$Del_Crit = $conect->query("DELETE FROM criteriocalificacion WHERE ID_CRITERIO_C = '$IdC[0]'");

		if ($Del_Ind and $Del_Crit) {

			echo '<script>alert("Se elimino el criterio correctamente");</script>';
			echo '<script>window.location="../../Vista/EliminarCriterioCalificacion.php";</script>';
		
		}
	}	

	

?>