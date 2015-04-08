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
                <form method="post" action="evaluacionFinalBD.php">
          
               <div class="bs-callout bs-callout-danger">
              <h4>Nota</h4>
               <p>
               El registro de la evaluacion de la planificacion solo se realiza una vez.
              </p>
             </div>   
  
             <div class="bs-callout bs-callout-info">
                 <h4>Nota Final</h4>            
   <?php       
           

           $_SESSION["ID"];
           $_SESSION["NombreCorto"];
           $_SESSION["Actividad"] ;
           $_SESSION["usuarioGE"] ;
           $_SESSION["IDPago"];
           $_SESSION["Puntaje"];
           $_SESSION["tamano"] ;
        
           $ID=$_SESSION["ID"];
           $NombreCorto= $_SESSION["NombreCorto"];
           $Actividad=$_SESSION["Actividad"] ;
           $usuarioGE=$_SESSION["usuarioGE"]; 
           $IDPago=$_SESSION["IDPago"];
           $Puntaje=$_SESSION["Puntaje"];
           $tamano= $_SESSION["tamano"] ;
           
           $nota=0;
           
              if($tamano==1){ $usuario1= $_POST['nota0'];  $nota=($usuario1/100)*($Puntaje);}
              if($tamano==2){ $usuario1= $_POST['nota0'];$usuario2= $_POST['nota1']; $nota=((($usuario1+$usuario2)/2)/100)*($Puntaje);}
              if($tamano==3){ $usuario1= $_POST['nota0'];$usuario2= $_POST['nota1'];$usuario3= $_POST['nota2']; $nota=((($usuario1+$usuario2+$usuario3)/3)/100)*($Puntaje);}
              if($tamano==4){ $usuario1= $_POST['nota0'];$usuario2= $_POST['nota1'];$usuario3= $_POST['nota2'];$usuario4= $_POST['nota3'];$nota=((($usuario1+$usuario2+$usuario3+$usuario4)/4)/100)*($Puntaje);}
              if($tamano==5){ $usuario1= $_POST['nota0'];$usuario2= $_POST['nota1'];$usuario3= $_POST['nota2'];$usuario4= $_POST['nota3'];$usuario5= $_POST['nota4'];$nota=((($usuario1+$usuario2+$usuario3+$usuario4+$usuario5)/5)/100)*($Puntaje);}           
              if($tamano==6){ $usuario1= $_POST['nota0'];$usuario2= $_POST['nota1'];$usuario3= $_POST['nota2'];$usuario4= $_POST['nota3'];$usuario5= $_POST['nota4'];$usuario6= $_POST['nota5'];$nota=((($usuario1+$usuario2+$usuario3+$usuario4+$usuario5+$usuario6)/6)/100)*($Puntaje);}            
              if($tamano==7){ $usuario1= $_POST['nota0'];$usuario2= $_POST['nota1'];$usuario3= $_POST['nota2'];$usuario4= $_POST['nota3'];$usuario5= $_POST['nota4'];$usuario6= $_POST['nota5'];$usuario7= $_POST['nota6'];$nota=((($usuario1+$usuario2+$usuario3+$usuario4+$usuario5+$usuario6+$usuario7)/7)/100)*($Puntaje);} 
              if($tamano==8){ $usuario1= $_POST['nota0'];$usuario2= $_POST['nota1'];$usuario3= $_POST['nota2'];$usuario4= $_POST['nota3'];$usuario5= $_POST['nota4'];$usuario6= $_POST['nota5'];$usuario7= $_POST['nota6'];$usuario8= $_POST['nota7'];$nota=((($usuario1+$usuario2+$usuario3+$usuario4+$usuario5+$usuario6+$usuario7+$usuario8)/8)/100)*($Puntaje);}
              if($tamano==9){ $usuario1= $_POST['nota0'];$usuario2= $_POST['nota1'];$usuario3= $_POST['nota2'];$usuario4= $_POST['nota3'];$usuario5= $_POST['nota4'];$usuario6= $_POST['nota5'];$usuario7= $_POST['nota6'];$usuario8= $_POST['nota7'];$usuario9= $_POST['nota8'];$nota=((($usuario1+$usuario2+$usuario3+$usuario4+$usuario5+$usuario6+$usuario7+$usuario8+$usuario9)/9)/100)*($Puntaje);}        
              if($tamano==10){ $usuario1= $_POST['nota0'];$usuario2= $_POST['nota1'];$usuario3= $_POST['nota2'];$usuario4= $_POST['nota3'];$usuario5= $_POST['nota4'];$usuario6= $_POST['nota5'];$usuario7= $_POST['nota6'];$usuario8= $_POST['nota7'];$usuario9= $_POST['nota8'];$usuario10= $_POST['nota9'];$nota=((($usuario1+$usuario2+$usuario3+$usuario4+$usuario5+$usuario6+$usuario7+$usuario8+$usuario9+$usuario10)/10)/100)*($Puntaje);}    
            $_SESSION["nota"]=$nota;
            echo '<table class="table table-hover">
            <thead>
            <tr>

            <th>Actividad</th>
            <th>Valor en Porcentaje</th>
            <th>Nota final</th>

            </tr>
            </thead>
            <tbody>
            <th>'.$Actividad.'</th>
            <th>'.$Puntaje.'%</th>    
            <th>'.$nota.'</th>


            </tbody>
            </table>'; 
                 
 ?>
             </div>
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

                      		