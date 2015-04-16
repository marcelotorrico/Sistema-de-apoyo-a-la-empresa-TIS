<?php

include '../Modelo/conexion.php';
$UsuarioActivo = $_POST['Usuario'];
$DocumentoR = $_POST['Documento'];

$rutaDirectorio="../Repositorio/$UsuarioActivo";  
$clas = new conexion();

    if(!file_exists($rutaDirectorio))
    {
        mkdir($rutaDirectorio, 0777);

        if(!file_exists("../Repositorio/".$UsuarioActivo."/index.html"))
        {
            $directorioIndex = "../Repositorio/".$UsuarioActivo."/index.html";
            fopen($directorioIndex, "x");
        }
    }
    
    $ruta = "$rutaDirectorio/" . $_FILES['archivoA']['name'];
            $rutaDocumento="/Repositorio/$UsuarioActivo/" . $_FILES['archivoA']['name'];
        
            try{
            $resultado = move_uploaded_file($_FILES['archivoA']['tmp_name'], $ruta);
            if ($resultado) {
                
                //recuperamos la idRegistro siguiente que se insertara en la BD de registro para enviarlo a documento
                //$resultadoUno=$clas->consulta("SELECT auto_increment FROM `information_schema`.tables WHERE TABLE_SCHEMA = 'tis_mbittle' AND TABLE_NAME = 'registro'");
                $resultadoUno=$clas->consulta("SELECT auto_increment FROM `information_schema`.tables WHERE TABLE_SCHEMA = 'saetis' AND TABLE_NAME = 'registro'");
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
                $clas->consulta("INSERT INTO `registro` (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R)  VALUES ('$UsuarioActivo','documento subido','habilitado','$DocumentoR','$fecha','$hora')");
                $clas->consulta("INSERT INTO `documento` (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D) VALUES ($idRegistro,$tamanio,'$rutaDocumento','$visualizable','$descargable')");
                echo '<script>alert("Documento subido exitosamente");
                              location.href = "../Vista/inicio_grupo_empresa.php";
                      </script>';
                
            }
            }
             catch (Exception $e) {
                    echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
                }

$clas->cerrarConexion();
    
   


?>
