<?php
	require_once '../Modelo/Model/Asistencia.php';
	require_once '../Modelo/Model/Reporte.php';
        
        require_once '../Modelo/conexionPDO.php';
        $conectar=new Conexion();

	$funcion = $_POST['funcion'];
	$registro = $_POST['registro'];
	switch ($funcion) {
        case 'registrar asistencia':
        	$codigos = explode(',', $_POST['codigos']);
        	$asistencias = explode(',', $_POST['asistencias']);
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
                                $consulta = "INSERT INTO asistencia_semanal(ID_R, GRUPO_AS, CODIGO_SOCIO_AS, ASISTENCIA_AS, LICENCIA_AS) VALUES('$registro', 0,'$codigo', '$presente', '$licencia');";
                                $conectar->query($consulta);
			}
            break;
        case 'registrar reportes':
        	$roles = explode(',', $_POST['roles']);
        	$actividades = explode(',', $_POST['actividades']);
        	$hechos = explode(',', $_POST['hechos']);
        	$resultados = explode(',', $_POST['resultados']);
        	$conclusiones = explode(',', $_POST['conclusiones']);
        	$observaciones = explode(',', $_POST['observaciones']);
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
				$reporte = new Reporte($registro, $rol, $actividad, $hecho, $resultado, $conclusion, $observacion);
				$reporte->insertarBD();
			}
            break;
    }
?>