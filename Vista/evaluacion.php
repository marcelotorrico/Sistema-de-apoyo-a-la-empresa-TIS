 <?php  
 session_start();
$uActivo = $_SESSION['usuario'];
include '../Modelo/conexion.php';  
$conectar=new conexion();
 ?> 

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sistema de Apoyo a la Empresa TIS</title>



    <script type="text/javascript" src="../Librerias/lib/jquery-2.1.0.min.js"></script>
    <!-- icheck -->

    <link href="../Librerias/icheck/skins/square/green.css" rel="stylesheet">
    <script src="../Librerias/lib/icheck.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../Librerias/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="../Librerias/lib/bootstrap.js"></script>
    <!-- Docs -->
    <link rel="stylesheet" type="text/css" href="../Librerias/lib/css/docs.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="../Librerias/font-awesome/css/font-awesome.css">
    <!-- Bootstrap-datetimepicker -->
    <link rel="stylesheet" type="text/css" href="../Librerias/lib/css/bootstrap-datetimepicker.css">
    <script type="text/javascript" src="../Librerias/lib/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="../Librerias/lib/bootstrap-datetimepicker.es.js"></script>
    <!-- Bootstrap-multiselect -->
    <link rel="stylesheet" type="text/css" href="../Librerias/lib/css/bootstrap-multiselect.css">
    <script type="text/javascript" src="../Librerias/lib/bootstrap-multiselect.js"></script>
    <!-- Bootstrap-validator -->
    <link rel="stylesheet" type="text/css" href="../Librerias/lib/css/bootstrapValidator.css">
    <script type="text/javascript" src="../Librerias/lib/bootstrapValidator.js"></script>
    
    <script type="text/javascript">
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>



</head>

    
     <body>
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a href="lista_evaluacion.php" type="submit" class="close" aria-hidden="true">&times;</a>
                <h5 class="modal-title">Evaluacion </h5>
            <div class="modal-header">
                  <h4 class="modal-title">Evaluacion Grupo Empresa</h4>
            </div>
                <form method="post" action="evaluacionFinal.php">
            <div class="modal-body">
               
                
              <div class="bs-callout bs-callout-info">
              <h4>Nota</h4>
               <p>
               El valor de la calificacion es evaluada por 100 pts...
              </p>
             </div>
<?php                
           $Nota=0;
           $ID = $_GET['GE'];
           
           $peticion=$conectar->consulta("SELECT grupo_empresa.NOMBRE_CORTO_GE FROM grupo_empresa, registro WHERE registro.ID_R='$ID' and grupo_empresa.NOMBRE_U=registro.NOMBRE_U");
           while ($correo1 = mysql_fetch_array($peticion))
           { $NombreCorto=$correo1["NOMBRE_CORTO_GE"];}  
           
            $peticion1=$conectar->consulta("SELECT `NOMBRE_R` FROM `registro` WHERE `ID_R`='$ID'");
           while ($correo2 = mysql_fetch_array($peticion1))
           { $Actividad=$correo2["NOMBRE_R"];}        
           
           $peticion3=$conectar->consulta("SELECT `NOMBRE_U` FROM `grupo_empresa` WHERE `NOMBRE_CORTO_GE`='$NombreCorto'");
           while ($correo4 = mysql_fetch_array($peticion3))
           { $usuarioGE=$correo4["NOMBRE_U"];}  
           
            $peticion2=$conectar->consulta("select MAX(ID_R)  from registro where `NOMBRE_R`= '$Actividad' and `NOMBRE_U`='$usuarioGE'");
           while ($correo3 = mysql_fetch_array($peticion2))
           { $IDPago=$correo3["MAX(ID_R)"];} 
           

             $peticion4=$conectar->consulta("SELECT `ENTREGABLE_P` FROM `entrega`, entregable WHERE `ID_R`='$IDPago' and entregable.ENTREGABLE_E= entrega.ENTREGABLE_P and `NOMBRE_U`='$usuarioGE'");
           while ($correo5 = mysql_fetch_array($peticion4))
           { $Entregable[]=$correo5["ENTREGABLE_P"];}         
       
           
             $peticion5=$conectar->consulta("SELECT `DESCRIPCION_E` FROM `entrega`, entregable WHERE `ID_R`='$IDPago' and entregable.ENTREGABLE_E= entrega.ENTREGABLE_P and `NOMBRE_U`='$usuarioGE'");
           while ($correo6 = mysql_fetch_array($peticion5))
           { $Descripcion[]=$correo6["DESCRIPCION_E"];}            
           
           
              $peticion6=$conectar->consulta("SELECT `PORCENTAJE_DEL_TOTAL_P` FROM `pago` WHERE `ID_R`='$IDPago'");
           while ($correo7 = mysql_fetch_array($peticion6))
           { $Puntaje=$correo7["PORCENTAJE_DEL_TOTAL_P"];}   

           
                    $peticion333=$conectar->consulta("SELECT `ENTREGABLE_P` FROM `entrega`, entregable WHERE `ID_R`='$IDPago' and entregable.ENTREGABLE_E= entrega.ENTREGABLE_P and `NOMBRE_U`='$usuarioGE'");
                    $tamano=mysql_num_rows($peticion333);

                    $_SESSION["ID"] = $ID;
                    $_SESSION["NombreCorto"] = $NombreCorto;
                    $_SESSION["Actividad"] = $Actividad;
                    $_SESSION["usuarioGE"] = $usuarioGE;
                    $_SESSION["IDPago"] = $IDPago;
                    $_SESSION["Puntaje"] = $Puntaje;
                    $_SESSION["tamano"] = $tamano;
   

                ?>
                       
                
                
     
                   <table class="table table-hover">
			  <thead>
		    	  <tr>
		        	  <th>Grupo Empresa</th>
                                  <th>Actividad</th>
	          	          <th>Entregable</th>
	          		  <th>Descripcion</th>
                                  <th>Nota</th>
                                  
	        	  </tr>
		         
                        
                 
            
           
             <?php   for ($i = 0; $i < $tamano; $i++)
                            {  ?>
                   
			 
		    	  <tr>
			 
			  	<th><?php echo $NombreCorto  ?></th>
                                <th><?php echo $Actividad ?></th>    
                                <th><?php echo $Entregable[$i] ?></th>
                                <th><?php echo $Descripcion[$i] ?></th>
                                <th>
                                    <input type="number" min="0" max="100" id="campo" name="nota<?php echo $i ?>"  required>
                                           


                                </th>
           
                </tr> <?php  } ?>
		    </thead> 
                </table> 
     
            </div><br>
            <div class="modal-footer">
                
                <button type="submit" id="boton01" class="btn btn-primary">Aceptar</button>
                
  
       

            </div>     </form>  
  



                
        </div>
    </div>
    </div>
</div>
</body>   

</html>             

                      		