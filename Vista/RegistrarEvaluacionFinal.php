<?php  

	include '../Modelo/conexion.php';
	$conect = new conexion();  

	$GrupoEF = $_POST['GrupoE'];
	$NotaFn = $_POST['NotaFn'];

	$Verif_NF = $conect->consulta("SELECT * FROM nota_final WHERE NOMBRE_U='$GrupoEF'");

	$NotaFinal = mysql_fetch_row($Verif_NF);

	if (is_array($NotaFinal)) {

		echo '<script>alert("La grupo empresa seleccionada ya tiene una nota registrada anteriormente");
				window.location="../Vista/EvaluacionGeneral.php";
				</script>';
	}
	else
	{
	
		$conect->consulta('INSERT INTO nota_final(NOMBRE_U, NOTA_F) VALUES("'.$GrupoEF.'","'.$NotaFn.'")');

		echo '<script>alert("Se registro la nota correctamente");
				window.location="../Vista/EvaluacionGeneral.php";
				</script>';

	}

?>