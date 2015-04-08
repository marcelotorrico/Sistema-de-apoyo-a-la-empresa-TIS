<!DOCTYPE html>
<?php
    
   session_start();
   $uActivo = $_SESSION['usuario'];
  
?>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Apoyo a la Empresa TIS</title>

    <!-- Core CSS - Include with every page -->
    <link href="../Librerias/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Librerias/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="../Librerias/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="../Librerias/css/plugins/timeline/timeline.css" rel="stylesheet">
       <!-- SB Admin CSS - Include with every page -->
    <link href="../Librerias/css/sb-admin.css" rel="stylesheet">

</head>

<body>

   
    <div id="wrapper">
       
        
		<!--<h2>design by <a href="#" title="flash templates">flash-templates-today.com</a></h2>-->
     
        
	
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../Vista/inicio_asesor.php">Inicio </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
            
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $uActivo.' '; ?><i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
  
                        <li><a href="../Vista/modificar_asesor.php"><i class="fa fa-user fa-fw"></i> Modificar Datos personales</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../Vista/unlog.php"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="../Vista/AdministrarGrupoEmpresa.php"><i class="fa fa-book"></i> Administrar Grupo Empresas</a>
                        </li>
                        <li>
                                        <a href="#"><i class="glyphicon glyphicon-th-list"></i> Evaluacion Grupo Empresa<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="../Vista/CrearModalidadEvaluacion.php">Criterio de Evaluaci&oacute;n </a>                             
                                                </li>
                                                
                                                <li>
                                                    <a href="#">Criterio de Calificaci&oacute;n<span class="fa arrow"></span></a>
                                                    <ul class="nav nav-third-level">
                                                        <li>
                                                            <a href="../Vista/CrearModalidadCalificacion.php"> Crear Criterio de Calificaci&oacute;n</a>
                                                        </li>
                                                        <li>
                                                            <a href="../Vista/EliminarCriterioCalificacion.php"> Eliminar Criterio de Calificaci&oacute;n</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                 
                                                <li>
                                                    <a href="#">Formulario de Evaluacion<span class="fa arrow"></span></a>
                                                    <ul class="nav nav-third-level">
                                                        <li>
                                                            <a href="../Vista/CrearFormulario.php">Crear Formulario de Evaluacion</a>
                                                        </li>
                                                        <li>
                                                            <a href="../Vista/SeleccionarFormulario.php"> Habilitar Formulario de Evaluacion </a>   
                                                        </li>
                                                        <li>
                                                            <a href="../Vista/EliminarFormulario.php">Eliminar Formulario de Evaluacion</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="../Vista/EvaluarGrupoEmpresa.php">Evaluar Grupo Empresa </a>   
                                                </li>
                                                <li>
                                                    <a href="../Vista/EvaluacionGeneral.php">Evaluacion Final </a>   
                                                </li>
                                            </ul>
                                </li>
                        
                        
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-files-o "></i> Documentos <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                            <a href="../Vista/subirarchivoasesor.php">Subir Documentos</a>
                                </li>
                                <li>
                                    <a href="../Vista/RegistrarDocumentosRequeridos.php">Registrar Documentos</a>
                                </li>
                                <li>
                                    <a href="../Vista/documentos_generados.php">Contratos Emitidos</a>
                                </li>
                                <li>
                                    <a href="#">Publicaci&oacute;n Documentos <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        
                                        
                                        <li>
                                            <a href="../Vista/publicar_asesor.php">Nueva Publicaci&oacute;n </a>
                                        </li>
                                        <li>
                                            <a href="../Controlador/publicaciones.php">Publicaciones </a>
                                        </li>
                                       
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">Recepci&oacute;n Documentos <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="../Vista/documentos_recibidos.php">Documentos Recibidos</a>
                                        </li>
                                        <li>
                                            <a href="../Vista/ConfiguracionFechasRecepcion.php" ><span class="fa fa-calendar-o"></span> Configuraci&oacute;n de Fechas para la Recepci&oacute;n de Documentos</a>
                                            
                                        </li>
         
                                    </ul>
                                </li>
                               
                            </ul>
                            
                            <!-- /.nav-second-level -->
                        </li>
                        
                         <li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Tareas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li>
                                    <a href="../Vista/contrato.php">Emitir Contrato </a>
                                </li>
                                <li>
                                    <a href="../Vista/RegistrarFirma.php">Firma de Contratos</a>
                                </li>
                                <li>
                                    <a href="../Vista/ordenDeCambio.php">Emitir Orden de Cambio</a>
                                </li>
                                <li>
                                    <a href="../Vista/notificacion_conformidad.php">Emitir Notificaci&oacute;n de Conformidad</a>
                                </li>
                                <li>
                                    <a href="../Vista/InscripcionProyecto.php">Registrar Proyecto</a>
                                </li>
                                <li>
                                    <a href="#">Seguimiento Grupo Empresa <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        
                                        <li>
                                            <a id="Seguimiento" href="#">Seguimiento</a>
                                        </li>
  
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                         <li>
                              <a href="../Vista/lista_doc_subidos.php"><i class="fa fa-tasks fa-fw"></i>Documentos Subidos </a>  
                                              
                          </li>
                       
                        <li>
                            <a href="../Vista/lista-de-noticias.php"><i class="fa fa-comment"></i> Foro</a>
                        </li>
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>


<!----------------------------------------------Respuesta_Actividad-------------------------------------->
        <div id="page-wrapper">
            <div class ="form-horizontal">
                <div class="row">
                    <div class="col-lg-12">
                    <h1> Documentos Publicados</h1>     
                        <form id = "publicar" method = "POST" action="" onsubmit = "return validarCampos(this);">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <fieldset class="campos-border">
                                        <legend class="campos-border">Informacion</legend>
                                        <table class="table form-group">      
                                            <thead>
                                                    <tr>
                                                      <th># ID </th>
                                                      <th>Tipo</th>
                                                      <th>Nombre</th>
                                                      <th>Descripcion</th>
                                                      <th>Accion</th>   
                                                    </tr>
                                            </thead>
                                            <tbody>                                                    
                                            {change}
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                                <div class="panel-footer">
                                    <a href="../Vista/publicar_asesor.php" class="link" ><i class="fa fa-plus "></i> Agregar recurso<span class="fa arrow"></span></a>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.col-lg-12 -->
                </div>
            </div>
        </div>
        <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        
        <a href="manejador_actividades.php?name=documento" class="link" data-toggle="modal" data-target=""><i class="fa fa-file "></i> Agregar Documento <span class="fa arrow"></span></a></br>
        <a href="manejador_actividades.php?name=actividad" class="link" data-toggle="modal" data-target=""><i class="fa fa-calendar "></i> Agregar Actividad <span class="fa arrow"></span></a>
             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
   <script src="../Librerias/js/jquery-1.10.2.js"></script>
    <script src="../Librerias/js/bootstrap.min.js"></script>
    <script src="../Librerias/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="../Librerias/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="../Librerias/js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../Librerias/js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="../js/Librerias/demo/dashboard-demo.js"></script>

</body>

</html>
