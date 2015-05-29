<?php  

	include '../conexionPDO.php';
	$conect = new Conexion();  

	$GrupoEF = $_POST['GrupoE'];
	$NotaFn = $_POST['NotaFn'];

	$Verif_NF = $conect->query("SELECT * FROM nota_final WHERE NOMBRE_U='$GrupoEF'");

	$NotaFinal = $Verif_NF->fetch(PDO::FETCH_NUM);

	if (is_array($NotaFinal)) {

		echo '<script>alert("La grupo empresa seleccionada ya tiene una nota registrada anteriormente");
				window.location="../../Vista/EvaluacionGeneral.php";
				</script>';
	}
	else
	{
	
		$conect->query('INSERT INTO nota_final(NOMBRE_U, NOTA_F) VALUES("'.$GrupoEF.'","'.$NotaFn.'")');

		echo '<script>alert("Se registro la nota correctamente");
				window.location="../../Vista/EvaluacionGeneral.php";
				</script>';
	}
?>