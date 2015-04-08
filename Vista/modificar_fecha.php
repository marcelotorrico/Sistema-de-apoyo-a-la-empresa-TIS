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
     
            </div>
            <form method="post" action="modificar_fechaBD.php">
          
  
             <div class="bs-callout bs-callout-info">
                 <h4>Modidicar Fecha</h4>        </div>    
   <?php       

            $ID = $_GET['GE'];
            $peticion= $conectar->consulta("SELECT f.FECHA_FR FROM  fecha_realizacion as f, registro as a WHERE f.ID_R=a.ID_R and f.ID_R='$ID'");  
            while ($correo = mysql_fetch_array($peticion))
            {
            $fechaFin=$correo["FECHA_FR"];  
            }    
            
            $peticion1= $conectar->consulta("SELECT `NOMBRE_R` FROM `registro` WHERE `TIPO_T`='actividad planificacion' and ID_R='$ID'"); 
            while ($correo1 = mysql_fetch_array($peticion1))
            {
            $actividad=$correo1["NOMBRE_R"];  
            }
            
            echo '<table class="table table-hover">
            <thead>
            <tr>

            <th>Actividad</th>
            <th>Fecha Evaluaci&oacuten</th>
            <th>Modificar Fecha</th>

            </tr>
            </thead>
            <tbody>
            <th>'.$actividad.'</th>
            <th>'.$fechaFin.'</th>    
            <th>  <input type="date" required name="campo" placeholder="AAAA-MM-DD" pattern="^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$"> </th>
            
          
            </tbody>
            </table>'; 
            
            $_SESSION["ID"]=$ID;
            
 ?>
                 <br>
             
            <div class="modal-footer">
                <a href="lista_evaluacion.php" class="btn btn-default btn-primary "  type="submit" >Cancelar</a>  
                 <button type="submit" class="btn btn-primary">Guardar</button>
 
            </div>
            </form>  

                
        </div>
    </div>
    </div>
</div>
</body>   

</html>             

                      		