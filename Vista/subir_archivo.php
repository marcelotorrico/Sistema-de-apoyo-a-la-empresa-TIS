<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ERROR);
include '../Modelo/conexion.php';



    $clas = new conexion();
    
        //ahora verificamos que el tamanio y formato de archivo son correcto
        //$formatos = array("application/pdf");
        //$tamanioArchivo = 5120;
        //$varr=$_FILES['archivoA']['size'];
        //if (in_array($_FILES['archivoA']['type'], $formatos) && $_FILES['archivoA']['size'] <= $tamanioArchivo * 1024) {
            //esta es la ruta donde guardaresmo los archivos  
    
    
            $idUsuarioG=$_POST['nombreUsuarioG'];
            $nombreRegistro=  str_replace("/", " ", $_POST['nombreRegistro']);
            $rutaDirectorio="../Repositorio/$idUsuarioG";
            if(!file_exists($rutaDirectorio))
            {
                mkdir($rutaDirectorio, 0777);
            }
            $ruta = "$rutaDirectorio/" . $_FILES['archivoA']['name'];
            $rutaDocumento="/Repositorio/$idUsuarioG/" . $_FILES['archivoA']['name'];
            //ahora movemos el archivo
            try{
            $resultado = move_uploaded_file($_FILES['archivoA']['tmp_name'], $ruta);
            if ($resultado) {
                
                //recuperamos la idRegistro siguiente que se insertara en la BD de registro para enviarlo a documento
                $resultadoUno=$clas->consulta("SELECT auto_increment FROM `information_schema`.tables WHERE TABLE_SCHEMA = 'tis_mbittle' AND TABLE_NAME = 'registro'");
                while ($filas = mysql_fetch_array($resultadoUno)) {
                    $idRegistro=(integer)$filas['0'];
                }
                
                $nombre = $_FILES['archivoA']['name'];
                $tamanio =(integer) $_FILES['archivoA']['size'];
                $visualizable=TRUE;
                $descargable=TRUE;
                date_default_timezone_set('America/La_Paz');
                $fecha=  date('Y-m-d');
                $hora=  date("G:H:i");
                $clas->consulta("INSERT INTO `registro` (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R)  VALUES ('$idUsuarioG','documento subido','habilitado','$nombre','$fecha','$hora')");
                $clas->consulta("INSERT INTO `documento` (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D) VALUES ($idRegistro,$tamanio,'$rutaDocumento','$visualizable','$descargable')");
                echo 'Documento cargado exitosamente';
                
            }
            }
             catch (Exception $e) {
                    echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
                }
            
            
        //}
        //else
        //{
            //echo 'el formato de archivo o el tamanio de archivo no son permitidos';
        //}

$clas->cerrarConexion();
?>
