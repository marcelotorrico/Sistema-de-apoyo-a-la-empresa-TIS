 <?php  
    session_start();
    $uActivo = $_SESSION['usuario'];
    include '../Modelo/conexionPDO.php';

    $conectar=new Conexion();
    
    
    
    
    
    
           $_SESSION["ID"];
           $_SESSION["NombreCorto"];
           $_SESSION["Actividad"] ;
           $_SESSION["usuarioGE"] ;
           $_SESSION["IDPago"];
           $_SESSION["Puntaje"];
           $_SESSION["tamano"] ;
           $_SESSION["nota"] ;
        
           $ID=$_SESSION["ID"];
           $NombreCorto= $_SESSION["NombreCorto"];
           $Actividad=$_SESSION["Actividad"] ;
           $usuarioGE=$_SESSION["usuarioGE"]; 
           $IDPago=$_SESSION["IDPago"];
           $Puntaje=$_SESSION["Puntaje"];
           $tamano= $_SESSION["tamano"] ;
           $nota= $_SESSION["nota"] ;
    
    
          $conectar->query("INSERT INTO evaluacion (`ID_R`, `ID_E`, `NOTA_E`,`PORCENTAJE` ) VALUES ('$ID', NULL, '$nota','$Puntaje');");
          
          
          
          
          
            date_default_timezone_set('America/Puerto_Rico');
            $fechaAct = date('Y-m-j');

            $peticion1= $conectar->query("SELECT f.FECHA_FR FROM  fecha_realizacion as f, registro as a WHERE f.ID_R=a.ID_R and f.ID_R='$ID'");  
            while ($correo = $peticion1->fetch(PDO::FETCH_ASSOC))
            {
                $fechaFin=$correo["FECHA_FR"];  
            }
            $peticion2= $conectar->query("SELECT MAX(ENTREGABLE_P) FROM `entrega` WHERE `ID_R`='$IDPago'");  
            while ($correo = $peticion2->fetch(PDO::FETCH_ASSOC))
            {
                $entregable=$correo["MAX(ENTREGABLE_P)"];  
            }            
            
            $stampFechaA = strtotime($fechaAct);
            $stampFechaF = strtotime($fechaFin);


            if($stampFechaA>$stampFechaF)
            {
     
             $conectar->query("UPDATE entrega SET `ENTREGADO_P` = '1' WHERE `entrega`.`ID_R` = '$IDPago' AND `entrega`.`ENTREGABLE_P` = '$entregable'");
            }   
          
          echo"<script type=\"text/javascript\">alert('La evaluacion se guardo exitosamente'); window.location='../Vista/lista_evaluacion.php';</script>";
 ?> 

                      		