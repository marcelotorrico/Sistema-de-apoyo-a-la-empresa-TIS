<?php
session_start();
  
    $nombreU = $_SESSION['usuario']  ;
    $nombreS = $_POST['nombre'];
    $apellidoS = $_POST['apellido'];
    

    include '../Modelo/conexion.php';
   
    $conect = new conexion();

    
         
       /* $db = 'tis_mbittle';
        $host = '192.168.2.5';
        $user = 'mbittle';
        $pass = '5rtZAGYq';*/
        $db = 'saetis';
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $conn = new PDO("mysql:dbname=".$db.";host=".$host,$user, $pass);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // iniciar transacción
        $conn->beginTransaction();
        try {

            $sql = 'INSERT INTO socio (NOMBRE_U, NOMBRES_S, APELLIDOS_S) VALUES (:nombreU, :nombreS, :apellidoS);';

            $result = $conn->prepare($sql);

            $result->bindValue(':nombreU', $nombreU, PDO::PARAM_STR);
            $result->bindValue(':nombreS', $nombreS, PDO::PARAM_STR);
            $result->bindValue(':apellidoS', $apellidoS, PDO::PARAM_STR);

            $result->execute();


            $conn->commit();
            echo"<script type=\"text/javascript\">alert('El registro ha sido satisfactorio'); window.location='AnadirSocio.php';</script>";
        } catch (PDOException $e) {
           // si ocurre un error hacemos rollback para anular todos los insert
            $conn->rollback();
            echo $e->getMessage();
        }  
    ?>