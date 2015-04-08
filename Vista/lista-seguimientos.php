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
                     <a href="inicio_asesor.php" type="submit" class="close" aria-hidden="true">&times;</a>
                
            <div class="modal-header">
                 
            </div>
                <form method="post" action="evaluacionFinal.php">
            <div class="modal-body">
               
                
              <div class="bs-callout bs-callout-info">
              <h4>Seguimiento</h4>
              
             </div>
              <table class="table table-hover">
                 <thead>
                   <tr>
                      <th>Rol</th>
                      <th>Actividad</th>
                      <th>Hecho</th>
                      <th>Resultado</th>
                      <th>Conclusion</th>
                      <th>Observacion</th>
                   </tr>
<?php                
          
           $idGrupoE  = $_GET['GE'];

             $peticionGE=$conectar->consulta("SELECT `ROL_S`,`ACTIVIDAD_S`,`HECHO_S`,`RESULTADO_S`,`CONCLUSION_S`,`OBSERVACION_S` FROM seguimiento WHERE seguimiento.GRUPO_S='$idGrupoE' ORDER BY ID_S DESC");
           while ($seguimiento = mysql_fetch_array($peticionGE))
           { 

                $rolGE=$seguimiento[0];
                $actividad=$seguimiento[1];
                $hechoGE=$seguimiento[2];
                $resultado=$seguimiento[3];
                $conclusion=$seguimiento[4];
                $obserGE=$seguimiento[5];
                if($hechoGE=="1")
                {
                  $hechoGE1="Si";
                }
                else{
                      $hechoGE1="No";
                }
           
              ?>
               <tr>
                      <th><?php echo $rolGE  ?></th>
                      <th><?php echo $actividad ?></th>    
                      <th><?php echo $hechoGE1 ?></th>
                      <th><?php echo $resultado ?></th>
                      <th><?php echo $conclusion?></th>
                      <th><?php echo $obserGE?></th>

                     
           
                </tr>
                <?php 
                    }
                ?>
                 </thead> 
                </table> 
            </div><br>
               </form>  
  



                
        </div>
    </div>
    </div>
</div>
</body>   

</html>             

                          