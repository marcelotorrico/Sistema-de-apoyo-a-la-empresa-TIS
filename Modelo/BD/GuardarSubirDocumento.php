<?php

include '../conexionPDO.php';
$UsuarioActivo = $_POST['Usuario'];

$rutaDirectorio = "../../Repositorio/$UsuarioActivo";
$clas = new Conexion();

if (!file_exists($rutaDirectorio)) {
    mkdir($rutaDirectorio, 0777);

    if (!file_exists("../../Repositorio/" . $UsuarioActivo . "/index.html")) {
        $directorioIndex = "../../Repositorio/" . $UsuarioActivo . "/index.html";
        fopen($directorioIndex, "x");
    }
}

$ruta = "$rutaDirectorio/" . $_FILES['archivoA']['name'];
$rutaDocumento = "/Repositorio/$UsuarioActivo/" . $_FILES['archivoA']['name'];
/* Revisar */

try {
    $resultado = move_uploaded_file($_FILES['archivoA']['tmp_name'], $ruta);
    if ($resultado) {
        $nombre = $_FILES['archivoA']['name'];
        $tamanio = (integer) $_FILES['archivoA']['size'];
        $visualizable = TRUE;
        $descargable = TRUE;
        date_default_timezone_set('America/La_Paz');
        $fecha = date('Y-m-d');
        $hora = date("G:i:s");
        if (isset($_POST['ActualizarDocumento'])) {
            $DocumentoR = $_POST['ActualizarDocumento'];
            $consulta = $clas->query("SELECT id_r FROM `registro` WHERE NOMBRE_U='$UsuarioActivo' AND TIPO_T='documento subido' AND NOMBRE_R='$DocumentoR'");
            $id = $consulta->fetch(PDO::FETCH_COLUMN);
            if ($id) {
                $consulta = $clas->query("SELECT ruta_d FROM `documento` WHERE ID_R='$id'");
                $url = "../../".$consulta->fetch(PDO::FETCH_COLUMN);
                $clas->query("UPDATE registro SET NOMBRE_R='$DocumentoR',FECHA_R='$fecha' ,HORA_R='$hora' WHERE ID_R='$id'");
                $clas->query("UPDATE documento SET TAMANIO_D='$tamanio', RUTA_D='$rutaDocumento' WHERE ID_R='$id'");
                if (unlink($url)) {
                    redireccionarPagina('El archivo se modifico correctamente');
                }
            }
        } else {
            $DocumentoR = $_POST['Documento'];
            //recuperamos la idRegistro siguiente que se insertara en la BD de registro para enviarlo a documento
            //$resultadoUno=$clas->query("SELECT auto_increment FROM `information_schema`.tables WHERE TABLE_SCHEMA = 'tis_mbittle' AND TABLE_NAME = 'registro'");
            $resultadoUno = $clas->query("SELECT auto_increment FROM `information_schema`.tables WHERE TABLE_SCHEMA = 'saetis' AND TABLE_NAME = 'registro'");
            while ($filas = $resultadoUno->fetch()) {
                $idRegistro = (integer) $filas['0'];
            }
            $clas->query("INSERT INTO `registro` (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R)  VALUES ('$UsuarioActivo','documento subido','habilitado','$DocumentoR','$fecha','$hora')");
            $clas->query("INSERT INTO `documento` (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D) VALUES ($idRegistro,$tamanio,'$rutaDocumento','$visualizable','$descargable')");
            redireccionarPagina("Documento subido exitosamente");
        }
    }
} catch (Exception $e) {
    echo 'Ha ocurrido un error: ', $e->getMessage(), "\n";
}
$clas = NULL;

function redireccionarPagina($mensaje) {
    echo '<script>alert("' . $mensaje . '");
                              location.href = "../../Vista/inicio_grupo_empresa.php";
                      </script>';
}

?>
