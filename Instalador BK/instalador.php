<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Instalador del Sistema SAETIS</title>
        <meta charset="UTF-8">
        <meta name="Instalador" content="Configuracion de algunos parametros para instalar el Sistema">
        <link rel="stylesheet" type="text/css" href="estiloInstalador.css">
    </head>
    <body>
        <h1>Instalador</h1>
        <p>Escribe la configuracion de la base de datos</p>
        <form method="POST" autocomplete="on" action="">
            <fieldset>
                <legend>Configuracion de la Base de Datos</legend>
                <label for="nombre">Nombre:</label>
                <input id="nombre" name="nombre" type="text">
                <label for="host">Host:</label>
                <input id="host" name="host" type="text">
                <label for="usuario">Usuario:</label>
                <input id="usuario" name="usuario" type="text">
                <label for="contrasena">Contraseña:</label>
                <input id="contrasena" name="contrasena" type="password">
                <input id="instalar" type="submit" name="instalar" value="Instalar">
            </fieldset>
        </form>
<?php
    require 'CreadorDirectorios.php';
    $creador = new CreadorDirectorios();
   
    if(isset($_POST['instalar']) && isset($_POST['host']) && isset($_POST['usuario'])){
        $nombre = $_POST['nombre'];
        ejecutarSqlScript("../saetis.sql",$_POST['host'],$_POST['usuario'],$_POST['contrasena'],"saetis2");  
        $creador->copiar("../../Sistema-de-apoyo-a-la-empresa-TIS", "C:/xampp/htdocs/$nombre");
        $creador->removeDirectory("C:/xampp/htdocs/$nombre/Instalador");
        header("Location: ../../$nombre/");
    }
    function conectar($host, $usuario, $contrasena){
        $enlace = mysqli_connect($host, $usuario, $contrasena);
        return $enlace;
    }
    function desconectar($enlace){
        mysqli_close($enlace);
    }
    function ejecutarSqlScript($dirScript,$host,$usuario,$contrasena,$nombreBD){
        $enlace = conectar($host,$usuario,$contrasena);
        if($enlace){
            $dirScriptSinComentarios = eliminarComentariosScript($dirScript);
            $consulta = "create database ".$nombreBD." default character set=utf8";
            ejecutarConsulta($enlace,$consulta);
            if (!mysqli_select_db($enlace,$nombreBD))
            {
                echo "Error seleccionando la base de datos: ".  mysqli_error($enlace);
            }
            $sql = explode(";",file_get_contents($dirScriptSinComentarios));
            ejecutarScript($enlace, $sql);
            desconectar($enlace);
            eliminarArchivo($dirScriptSinComentarios);
        }else{
            echo 'Error al conectar a la base de Datos';
        }   
    }
    function ejecutarScript($enlace,$sql){
        $procedimiento = "";
        $delimitador = false;
        foreach($sql as $consulta){
            if(strpos($consulta, 'DELIMITER') !== FALSE){
                $delimitador = !$delimitador;
                $consulta = preg_replace("/DELIMITER/","", $consulta);
                if($delimitador == FALSE){
                    $consulta = $procedimiento;
                    $procedimiento = "";
                }
            }
            if($delimitador == TRUE && !empty($consulta) && preg_match("/[a-z]/i", $consulta)){
                $procedimiento=$procedimiento.$consulta."; ";
            }
            if($delimitador == FALSE && ejecutarConsulta($enlace,$consulta) === TRUE){
                //echo 'Ejecutado la consulta: '.$consulta."<br />";
            }else{
                //echo 'Error al ejecutar la consulta : '. $consulta. " ".mysqli_error($enlace);
            }
        }
    }
    function ejecutarConsulta($enlace,$consulta){
        $res = mysqli_query($enlace,$consulta);
        return $res;
    }
    function eliminarComentariosScript($dirScript){
        $dirScriptSinComentario = "scriptSinComentarios.sql";
        $fw = fopen($dirScriptSinComentario, "w");
        $fr = fopen($dirScript, "r");
        while(!feof($fr)) {
            $linea = fgets($fr);
            if(strpos($linea, '--')=== FALSE){
                fputs($fw, $linea);
            }
            //echo $linea . "<br />";
        }
        fclose($fr);
        fclose($fw);
        return $dirScriptSinComentario;
    }
    function eliminarArchivo($dirArchivo){
        if(!unlink($dirArchivo)){
            echo 'Error al eliminar: '.$dirArchivo;
        }
    }
?>
    </body>
</html>