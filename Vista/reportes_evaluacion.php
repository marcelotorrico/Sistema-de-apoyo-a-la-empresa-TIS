 <?php  
    session_start();
    $uActivo = $_SESSION['usuario'];
    include '../Modelo/conexionPDO.php';  
    
    require '../Controlador/ValidadorInicioSesion.php';

    $verificar = new ValidadorInicioSesion();
    $verificar->validarInicioSesion($uActivo,"asesor");

    $conectar=new Conexion();

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
                <form method="post" action="../Controlador/modificar_fechaBD.php">
          
  
             <div class="bs-callout bs-callout-info">
                 <h4>Detalles de Evaluacion</h4>   </div>           
   <?php       

            $ID = $_GET['GE'];
            $notaFin=0;
            $estado="";
            $peticion= $conectar->query("SELECT f.FECHA_FR FROM  fecha_realizacion as f, registro as a WHERE f.ID_R=a.ID_R and f.ID_R='$ID'");  
            while ($correo = $peticion->fetch(PDO::FETCH_ASSOC))
            {
            $fechaFin=$correo["FECHA_FR"];  
            }    
            $peticion=$conectar->query("SELECT grupo_empresa.NOMBRE_CORTO_GE FROM grupo_empresa, registro WHERE registro.ID_R='$ID' and grupo_empresa.NOMBRE_U=registro.NOMBRE_U");
             while ($correo1 = $peticion->fetch(PDO::FETCH_ASSOC))
            { $nombreCorto=$correo1["NOMBRE_CORTO_GE"];
            
            }              
            $peticion1= $conectar->query("SELECT `NOMBRE_R` FROM `registro` WHERE `TIPO_T`='actividad planificacion' and ID_R='$ID'"); 
            while ($correo1 = $peticion1->fetch(PDO::FETCH_ASSOC))
            {
            $actividad=$correo1["NOMBRE_R"];  
            }
            $peticion=$conectar->query("SELECT `NOTA_E`,`PORCENTAJE` FROM `evaluacion` WHERE `ID_R`='$ID'");
             while ($correo1 = $peticion->fetch(PDO::FETCH_ASSOC))
            { $notaAct=$correo1["NOTA_E"];
              $porcentaje=$correo1["PORCENTAJE"];
            }
            $peticion=$conectar->query("SELECT p.PORCENTAJE_A FROM precio AS p, registro AS u WHERE u.ID_R='$ID' and p.NOMBRE_U= u.NOMBRE_U");
             while ($correo1 = $peticion->fetch(PDO::FETCH_ASSOC))
            { $porsentajeS=$correo1["PORCENTAJE_A"];

            }            
            $notaFin=($notaAct*100)/$porcentaje;
            
            if($notaFin>=$porsentajeS)
            {
                $clase="list-group-item list-group-item-success"; 
            }
            else
            {
                $clase="list-group-item list-group-item-danger";
            }
            
            
            $peticion1=$conectar->query("SELECT `NOMBRE_R` FROM `registro` WHERE `ID_R`='$ID'");
           while ($correo2 = $peticion1->fetch(PDO::FETCH_ASSOC))
           { $Actividad=$correo2["NOMBRE_R"];}        
           
           $peticion3=$conectar->query("SELECT `NOMBRE_U` FROM `grupo_empresa` WHERE `NOMBRE_CORTO_GE`='$nombreCorto'");
           while ($correo4 = $peticion3->fetch(PDO::FETCH_ASSOC))
           { $usuarioGE=$correo4["NOMBRE_U"];}  
           
            $peticion2=$conectar->query("select MAX(ID_R)  from registro where `NOMBRE_R`= '$Actividad' and `NOMBRE_U`='$usuarioGE'");
           while ($correo3 = $peticion2->fetch(PDO::FETCH_ASSOC))
           { $IDPago=$correo3["MAX(ID_R)"];} 

            $peticion3=$conectar->query("SELECT ENTREGABLE_P FROM `entrega` WHERE `ID_R`='$IDPago' and `ENTREGADO_P`='1'");
            $tamanio=$peticion3->rowCount();
            if($tamanio>0)
            {  
                 $estado="Retrasado";
                 $modal="list-group-item list-group-item-danger";
                 echo '<span class="'.$modal.'">Estado: '.$estado.'</span>';
            }             
         
            
   
            
            echo '<table class="table table-hover">
            <thead>
            <tr>
            
            <th>Grupo Empresa</th>               
            <th>Actividad</th>
            <th>Fecha de Evaluaci&oacuten</th>
            <th>% Evaluaci&oacuten</th>
            <th>% Satisfacci&oacuten</th>
            <th>Nota 100%</th>            
            <th>Nota '.$porcentaje.' %</th>

            </tr>
            </thead>
            <tbody>
            <th>'.$nombreCorto.'</th>            
            <th>'.$actividad.'</th>
            <th>'.$fechaFin.'</th>    
            <th>'.$porcentaje.' %</th>
            <th>'.$porsentajeS.' %</th>  
            <th><span class="'.$clase.'">'.$notaFin.'</th>    
            <th><span class="'.$clase.'">'.$notaAct.'</th>   

                
            </tbody>
            </table>'; 
                     
            
            
         
 
 ?>
               
           
            <div class="modal-footer">
                <a href="lista_evaluacion.php" class="btn btn-default btn-primary "  type="submit" >Aceptar</a>  

 
            </div>
            </form>  

                
        </div>
    </div>
    </div>
</div>
</body>   

</html>             

                      		