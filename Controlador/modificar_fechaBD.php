 <?php  
    session_start();
    $uActivo = $_SESSION['usuario'];
    include '../Modelo/conexionPDO.php';  

    $conectar=new Conexion();
    

     $_SESSION["ID"];
     $ID=$_SESSION["ID"];
     $fecha = $_POST['campo'];
    
          
        $conectar->query("  UPDATE `fecha_realizacion` SET `FECHA_FR` = '$fecha' WHERE `ID_R` ='$ID'");
          
          echo"<script type=\"text/javascript\">alert('La fecha se modifico exitosamente'); window.location='../Vista/lista_evaluacion.php';</script>";
 ?> 

                      		