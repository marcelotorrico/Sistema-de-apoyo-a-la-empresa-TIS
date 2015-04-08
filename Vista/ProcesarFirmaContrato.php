<?php  

	require_once '../Modelo/conexion.php';
	session_start();        
	$UsuarioActivo = $_SESSION['usuario'];
	$con = new conexion();

	$nombreLargo = $_POST['grupoempresa'];

	$selNombreU = "SELECT `NOMBRE_U` FROM `grupo_empresa` WHERE `NOMBRE_LARGO_GE` = '$nombreLargo'";            
    $conNombU= $con->consulta($selNombreU);
    $nombreUGE = mysql_fetch_array($conNombU);

	$VerificarContrato = $con->consulta("SELECT * FROM registro, receptor WHERE NOMBRE_U='$UsuarioActivo' AND TIPO_T='Contrato' AND RECEPTOR_R = '$nombreLargo' AND registro.ID_R = receptor.ID_R");
	$Contrato = mysql_num_rows($VerificarContrato);

	if($Contrato >= 1)
	{
		$con->consulta("UPDATE inscripcion_proyecto SET ESTADO_CONTRATO = 'Firmado' WHERE NOMBRE_U='$nombreUGE[0]'");

		echo   '<script>alert("Se registro la firma del contrato correctamente")
					window.location="../Vista/RegistrarFirma.php";
			    </script>';
	}
	else
	{
		echo   '<script>
					alert("Todavia no se ha emitido el contrato para la grupo empresa correspondiente");
					window.location="../Vista/RegistrarFirma.php";
				</script>';

	}
?>