<!DOCTYPE html>
<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test - Consultas SQL</title>
        <style>
            label{
                width: 100px;
                display: block;
                clear: both;
                float: left;
                margin: 2px;
            }
            
            input{
                margin: 2px;
            }
            #enviar{
                padding: 5px 10px;
                font-weight: bold;
                margin: 2px;
            }
        </style>
    </head>
    <body>
        <h1>Test - Consultas SQL</h1>
        <form method="POST" autocomplete="on">
            <fieldset>
                <legend>Introduzca su consulta SQL</legend>
                <label for="select">SELECT: </label>
                <input id="select" name="select" type="text"><br>
                <label for="from">FROM: </label>
                <input id="from" name="from" type="text"><br>
                <label for="where">WHERE: </label>
                <input id="where" name="where" type="text"><br>
                <input id="enviar" type="submit" value="Enviar">
            </fieldset>
        </form>        
        
        <?php
        include '../Modelo/conexion.php';
        $conectar = new conexion();        
        
        if(isset($_POST['select']) && isset($_POST['from']) && isset($_SESSION['administrador'])){
            $consulta = "SELECT ".$_POST['select'].
                    " FROM ".$_POST['from'];
            if(!empty($_POST['where'])){
                $consulta.=" WHERE ".$_POST['where'];
            }
            echo "<br>Se ejecutará la siguiente consulta: $consulta <br><br>";
            $peticion =$conectar->consulta($consulta);
            $esPrimeraFila = TRUE;
            echo "<table>";
            while(($fila = mysql_fetch_assoc($peticion))){                
                if($esPrimeraFila){
                    echo "<tr>";
                    foreach ($fila as $clave => $valor){
                        echo "<th>$clave</th>";
                    }
                    echo "</tr>";
                    $esPrimeraFila = FALSE;
                }
                echo "<tr>";
                foreach ($fila as $valor){
                    echo "<td>$valor</td>";
                }                
                echo "</tr>";
            }
            echo "</table>";
        }
        if(!isset($_SESSION['administrador'])){
            echo '<script>alert("Debe autenticarse como Administrador para realizar consultas");</script>';
            echo '<script>window.location="../index.php";</script>';
        }
        ?>
    </body>
</html>
