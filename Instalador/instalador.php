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
                <input id="nombre" name="nombre" value="saetis2" readonly>
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
    
    
    echo 'Antes de realizar la condicion ';
    if(isset($_POST['instalar']) && isset($_POST['host']) && isset($_POST['usuario'])){
        //ejecutarSqlScript("saetis.sql",$_POST['host'],$_POST['usuario'],$_POST['contrasena'],$_POST['nombre']);
        $creador->copiar("../../ApoyoEmpresaTIS","../../ApoyoEmpresaTIS1");
        $creador->removeDirectory("../../ApoyoEmpresaTIS1/Instalador");
        //$conexion = new mysqli($_POST['host'],$_POST['usuario'],$_POST['contrasena']);
        //if($conexion->connect_error){
        /*if(!$conexion){
           die("La conexion fallo: " .$conexion->connect_error); 
        }
        else{
            $sql = "create database ".$_POST['nombre'];
            importarTablas("script.sql");
        }*/
        //echo 'Conexion realizada '.$sql;
        //Crear la Base de Datos
        /*if($conexion->query($sql) === TRUE){
            echo 'Base de Datos creada satisfactoriamente';
            $dirScript = "saetis.sql";
        }else{
            echo 'Error creando la Base de Datos: '.$conexion->error;
        }
        $conexion->close();*/
    }
    function conectar($host, $user, $password){
        $link = mysqli_connect($host, $user, $password);
        return $link;
    }
    function desconectar($link){
        mysqli_close($link);
    }
    function ejecutarSqlScript($dirScript,$host,$user,$password){
        /*$fr = fopen("saetis.sql", "r");
        $fw = fopen("saetis1.sql", "w");
        while(!feof($fr)) {
            $linea = fgets($fr);
            if(strpos($linea, '--')=== FALSE){
                fputs($fw, $linea);
            }
            echo $linea . "<br />";
        }
        fclose($fr);
        fclose($fw);*/
        $p = explode(";", "Hola;;como;estas;;");
        echo count($p);
        $cont = 0;
        foreach($p as $value){
            echo $p[$cont].'-';
            $cont++;
        }
        /*
        $sql = explode(";",file_get_contents($dirScript));
        $cont = 0;
        foreach($sql as $value){
            echo $sql[$cont].'/n';
            $cont++;
        }*/
        /*$link = conectar($host,$user,$password);
        if($link){
            mysqli_query($link,"create database ".$_POST['nombre']."default character set=utf8");
            foreach($sql as $query)
                mysqli_query($link,$query);
            desconectar($link);
        }else{
            echo 'Error al conectar a la base de Datos';
        }*/
    }
?>
    </body>
</html>