<?php
    include '../Modelo/conexion.php';
    $conectar = new conexion();
    session_start();


//Crear variables--------------------------

$usuario= $_SESSION['usuario'];
$contrasena= $_SESSION['contrasena'];

$delActiv = $_GET['id_us'];
    

            //Peticion
            $peticion = $conectar->consulta("DELETE FROM `sesion` WHERE `sesion`.`ID_S` ='".$delActiv."'");
            //cerrar conexion--------------------------

             //volver a la pagina---------------

         echo '<script>alert("Se elimino  correctamente");</script>';
         echo '<script>window.location="../Vista/bitacora_ingreso.php";</script>';
          
             
             
             
?>


