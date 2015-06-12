<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Instalador del Sistema SAETIS</title>
        <link href="Vista//bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <style>
            label{
                width: 100px;
                display: inline-block;
            }
            .bg-info, .bg-primary{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <?php
        defined('INSTALAR') or die;
        if(isset($_POST['db'])){            
            /*Creación de archivo de configuración*/
            $file = fopen('config.php', "w");
            fwrite($file,"<?php\n");
            fwrite($file,"    \$dbtype = 'mysql';\n");
            fwrite($file,"    \$host = '{$_POST['host']}';\n");
            fwrite($file,"    \$user = '{$_POST['user']}';\n");
            fwrite($file,"    \$password = '{$_POST['password']}';\n");
            fwrite($file,"    \$db = '{$_POST['db']}';\n");
            fwrite($file,"?>");
            fclose($file);
            
            /*Ejecución de script*/
            require_once 'Modelo/conexionPDO.php';
            $conexion = new Conexion();
            $query = file_get_contents("saetis.sql");            
            $stmt = $conexion->prepare($query);
            $stmt->execute();                
            
            /*Recarga la página*/
            header('Location: #');
        }
        ?>
        <div class="container">
        <h1>Instalador</h1>  
        <p class="bg-primary"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Para poder continuar debe existir una base de datos MySQL con un usuario con todos los privilegios.</p>
        <p class="bg-info"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Para reinstalar elimine el archivo config.php y recargue la página principal.</p>
        <p class="bg-info"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Tenga paciencia por favor, la instalación puede demorar unos minutos.</p>
        <form class="form-inline" method="POST" autocomplete="on">
            <fieldset>
                <legend>Información de la Base de Datos</legend>
                <label for="db">Nombre:</label>
                <input class="form-control" id="db" name="db" type="text" placeholder="saetis" required=""><br><br>
                <label for="host">Host:</label>
                <input class="form-control" id="host" name="host" type="text" value="localhost" required=""><br><br>
                <label for="user">Usuario:</label>
                <input class="form-control" id="user" name="user" type="text" placeholder="root"><br><br>
                <label for="password">Contraseña:</label>
                <input class="form-control" id="password" name="password" type="password"><br><br>               
                <button type="submit" class="btn btn-success">Instalar</button>
            </fieldset>
        </form>
        </div>
    </body>
</html>
