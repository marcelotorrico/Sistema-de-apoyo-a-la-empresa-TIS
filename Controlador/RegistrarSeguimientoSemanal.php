<?php
	
	require_once '../Modelo/conexion.php';

	$funcion = $_POST['funcion'];
	$grupoE = $_POST['grupoE'];
	$conexion = new conexion();
	session_start();
	$uActivo = $_SESSION['usuario'];

	date_default_timezone_set('America/Puerto_Rico');
	$horaReg = date("H:i:s");
	$fechaReg = date('Y:m:j');

	switch ($funcion) {
        case 'registrar asistencia':

        	$codigos = explode(',', $_POST['codigos']);
        	$asistencias = explode(',', $_POST['asistencias']);

        	$conexion->consulta("START TRANSACTION");

        	$insReg = $conexion->consulta("INSERT INTO registro(NOMBRE_U, TIPO_T, ESTADO_E, NOMBRE_R, FECHA_R, HORA_R)VALUES('$uActivo', 'asistencia', 'asistencia registrada', 'asistencia', '$fechaReg', '$horaReg');");

        	$selIdReg = $conexion->consulta("SELECT MAX(ID_R) FROM registro WHERE TIPO_T = 'asistencia' AND NOMBRE_U='$uActivo'");

        	$idReg = mysql_fetch_row($selIdReg);

        	for ($i = 0; $i < count($codigos); $i++) { 
        		$codigo = $codigos[$i];
				$presente = 1;
				$licencia = 0;
				if ($asistencias[$i] == 'ausente') {
					$presente = 0;
				} else {
					if ($asistencias[$i] == 'licencia') {
						$presente = 0;
						$licencia = 1;
					}
				}

				$insAsis = $conexion->consulta("INSERT INTO asistencia_semanal(id_r, grupo_as, codigo_socio_as, asistencia_as, licencia_as)VALUES('$idReg[0]','$grupoE','$codigo', '$presente', $licencia);");
			}

			if($insReg and $selIdReg and $insAsis)
			{
				$conexion->consulta("COMMIT");

			}
			else
        	{
        		$conexion->consulta("ROLLBACK");	
        	}

            break;

        case 'registrar reportes':

        	$roles = explode(',', $_POST['roles']);
        	$actividades = explode(',', $_POST['actividades']);
        	$hechos = explode(',', $_POST['hechos']);
        	$resultados = explode(',', $_POST['resultados']);
        	$conclusiones = explode(',', $_POST['conclusiones']);
        	$observaciones = explode(',', $_POST['observaciones']);

        	$conexion->consulta("START TRANSACTION");

        	$insReg = $conexion->consulta("INSERT INTO registro(NOMBRE_U, TIPO_T, ESTADO_E, NOMBRE_R, FECHA_R, HORA_R)VALUES('$uActivo', 'seguimiento', 'seguimiento registrado', 'revision', '$fechaReg', '$horaReg');");

        	$selIdReg = $conexion->consulta("SELECT MAX(ID_R) FROM registro WHERE TIPO_T = 'seguimiento' AND NOMBRE_U='$uActivo'");

        	$idReg = mysql_fetch_row($selIdReg);

        	for ($i = 0; $i < count($roles); $i++) { 
        		$rol = $roles[$i];
        		$actividad = $actividades[$i];
        		$hecho = 1;
        		$resultado = $resultados[$i];
        		$conclusion = $conclusiones[$i];
        		$observacion = $observaciones[$i];
				
				if ($hechos[$i] == 'no') {
					$hecho = 0;
				}

				$insSeg = $conexion->consulta("INSERT INTO seguimiento(id_r, rol_s, grupo_s, actividad_s, hecho_s, resultado_s, conclusion_s, observacion_s,fecha_s)VALUES('$idReg[0]','$rol','$grupoE', '$actividad', $hecho, '$resultado', '$conclusion', '$observacion','$fechaReg');");
			}

			if($insReg and $selIdReg and $insSeg)
			{
				$conexion->consulta("COMMIT");

			}
			else
        	{
        		$conexion->consulta("ROLLBACK");	
        	}
			
            break;
    }
?>