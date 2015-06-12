 <?php
session_start();
$uActivo = $_SESSION['usuario'];
include '../Modelo/conexionPDO.php';  

require '../Controlador/ValidadorInicioSesion.php';

$verificar = new ValidadorInicioSesion();
$verificar->validarInicioSesion($uActivo,"asesor");

$conexion=new conexion();
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
                <a href="../Vista/AdministrarGrupoEmpresa.php" type="submit" class="close" aria-hidden="true">&times;</a>
            <div class="modal-header">
                  <h4 class="modal-title">Socios de la Grupo-Empresa</h4>
            </div>
                <form method="post" action="../Vista/AdministrarGrupoEmpresa.php">
                <div class="modal-body">
                
                   <table class="table table-hover">
			  <thead>
		    	  <tr>
		        	  <th>Nº</th>
                                  <th>Nombre</th>
	          	          <th>Apellido</th>
	          		  <th>Acción</th>
	        	  </tr>
                          
                          <?php
                                $grupoEmpresa = $_GET['GE'];
                                $peticion =$conexion->prepare("SELECT CODIGO_S, NOMBRES_S, APELLIDOS_S FROM socio WHERE NOMBRE_U = '$grupoEmpresa'");
                                $peticion->execute();
                                $result = $peticion->fetchAll();
                                $j = 1;
                                
                                foreach($result as $fila => $value){  ?>
                   
			 
		    	  <tr>
			 
			  	<th>
                                    <?php
                                    echo $j;
                                    $j++;
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    echo $value['NOMBRES_S'];
                                    ?>
                                </th>    
                                <th>
                                    <?php
                                    echo $value['APELLIDOS_S'];
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    $url = "../../Controlador/ListaSocios.php?GE=$grupoEmpresa";
                                    $rol = 'asesor';
                                    echo "<a href ='../Modelo/BD/eliminar_socio.php?id_us=".$value['CODIGO_S']."&url=".$url."&nombre=".$grupoEmpresa."'><font color='blue'>Eliminar</font></a>";
                                    ?>
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
