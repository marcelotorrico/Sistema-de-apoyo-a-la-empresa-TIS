<?php

    include '../Modelo/conexion.php';
    session_start();
    $conexion = new conexion();
    $uActivo = $_SESSION['usuario'];

    require '../Controlador/ValidadorInicioSesion.php';

    $verificar = new ValidadorInicioSesion();
    $verificar->validarInicioSesion($uActivo,"grupoEmpresa");

?>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Apoyo a la Empresa TIS</title>

    <!-- JQuery -->
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
    <!-- Validators -->
    
    
    <script type="text/javascript" src="../Librerias/lib/validator/diferenteActividadPlanificacion.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/diferenteEntregable.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/stringLength.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/notEmpty.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/callback.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/date.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/numeric.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/porcentajeMax.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/porcentajeMin.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/integerN.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/porcentajeAc.js"></script>
    <!-- JS -->
    <script type="text/javascript" src="../Librerias/lib/funcion.js"></script>
    



    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="../Librerias/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="../Librerias/css/plugins/timeline/timeline.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="../Librerias/css/sb-admin.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

   
<div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                   <a class="navbar-brand" href="inicio_grupo_empresa.php">Inicio </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li>
                    <a href="lista-de-noticias-grupo.php"><i class="glyphicon glyphicon-comment"></i> Foro</a>
                </li>

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $uActivo.' '; ?><i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="ModificarGrupoEmpresa.php"><i class="fa fa-user fa-fw"></i> Modificar Datos personales</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="unlog.php"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
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
                            <a href="#"><i class="fa fa-bar-chart-o fa-files-o "></i> Documentos <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li>
                                    <a href="#" >Subir Documentos <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                    <?php
                                    
                                        $docsReq = $conexion->consulta("SELECT NOMBRE_R FROM registro, documento_r, inscripcion, inscripcion_proyecto WHERE inscripcion_proyecto.CODIGO_P = documento_r.CODIGO_P AND documento_r.ID_R = registro.ID_R AND inscripcion_proyecto.NOMBRE_U = '$uActivo' AND inscripcion.NOMBRE_UGE = inscripcion_proyecto.NOMBRE_U");
                                     
                                        while ($rowDocs = mysql_fetch_row($docsReq))
                                        {
                                            
                                            echo '<li>
                                                  <a href="SubirDocumento.php?doc='.$rowDocs[0].'">'.$rowDocs[0].'</a>
                                                   </li>';  
                                            
                                        }
                                        
                                    ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="publicacion_grupo.php">Recepci&oacute;n Documentos </a>
                                    
                                </li>
                               
                            </ul>
                            
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                             
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Tareas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li>
                                     <a href="AnadirSocio.php">Añadir socios</a>
                                </li>
                                 <li>
                                    <a href="AnadirRL.php">Seleccionar Representante legal</a>
                                </li>
                                <li>
                                    <a href="seleccionar_asesor.php">Seleccionar Asesor</a>
                                </li>
                                
                                 <li>
                                     <a href="InscripcionGEProyecto.php">Inscribirse a proyecto</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="historia_actividades.php"><i class="glyphicon glyphicon-calendar"></i> Historia de actividades</a>
                        </li>
                        <li>
                            <a id="registrarPlanificacion" href="#">
                                <i class="fa fa-pencil-square-o fa-fw"></i>Registrar Planificaci&oacute;n
                            </a>
                        </li>        
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            
               
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">

            
            
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Subir Documento</h2>
                    <div class="col-lg-6" >
                        
                        <?php
                        $selAsesor = $conexion->consulta("SELECT NOMBRE_UA FROM inscripcion WHERE NOMBRE_UGE='$uActivo'");
                        $Asesor = mysql_fetch_row($selAsesor);

                        date_default_timezone_set('America/Puerto_Rico');
                        $horaAct = date("H:i:s");
                        $fechaAct = date('Y-m-j');

                            $verifIns= $conexion->consulta("SELECT NOMBRE_U FROM inscripcion_proyecto WHERE NOMBRE_U = '$uActivo' ");
                            $inscrip = mysql_fetch_row($verifIns);

                            if (!is_array($inscrip))
                            {
                                echo '<div class="alert alert-warning">
                                            <strong>Para subir su propuesta primero debe inscribirse a un proyecto</strong>
                                          </div>';
            
                            }
                            else{

                
                              
                                    $Doc = $_GET['doc'];
                                    
                                    $consFechas = $conexion->consulta("SELECT FECHA_INICIO_PL, FECHA_FIN_PL, HORA_INICIO_PL, HORA_FIN_PL FROM registro, documento_r, inscripcion_proyecto, plazo WHERE inscripcion_proyecto.NOMBRE_U='$uActivo' AND inscripcion_proyecto.CODIGO_P = documento_r.CODIGO_P AND documento_r.ID_R = plazo.ID_R AND documento_r.ID_R = registro.ID_R AND registro.NOMBRE_R = '$Doc'");

                                    $fechas = mysql_fetch_row($consFechas);

                                    $stampHoraA = strtotime($horaAct);
                                    $stampFechaA = strtotime($fechaAct);
                                    $stampHoraI = strtotime($fechas[2]);
                                    $stampHoraF = strtotime($fechas[3]);
                                    $stampFechaI = strtotime($fechas[0]);
                                    $stampFechaF = strtotime($fechas[1]);
                                    
                                    $consDoc = $conexion->consulta("SELECT * FROM registro WHERE NOMBRE_U = '$uActivo' AND NOMBRE_R = '$Doc'");

                                    $verifDoc = mysql_fetch_row($consDoc);
                                    

                                    if(is_array($verifDoc))
                                    {
                                          
                                          echo '<div class="alert alert-warning">
                                                    <strong>Usted ya subio el documento correspondiente</strong>
                                                </div>';
                                    }
                                    else

                                    {

 
                                        if (($stampFechaA == $stampFechaI and $stampHoraA < $stampHoraI) or ($stampFechaA ==$stampFechaF and $stampHoraA > $stampHoraF) or ($stampFechaA < $stampFechaI) or ($stampFechaA > $stampFechaF)) {

                                    
                                            echo '<div class="alert alert-warning">
                                                        <strong>No esta disponible la subida del documento</strong>
                                                    </div>';
                                        }
                                        else
                                        {
                                           
                                                echo '<div class="alert alert-warning">';

                                                echo '<strong>La entrega esta disponible desde la fecha '.$fechas[0].' a horas '.$fechas[2].' hasta la fecha '.$fechas[1].' a horas '.$fechas[3].'</strong>';
                                                echo '</div>';

                                                echo '
                                                    <form action="../Modelo/BD/GuardarSubirDocumento.php" method="POST" enctype="multipart/form-data">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <input name="archivoA" id="archivoA" type="file" class = "btn btn-primary" required>
                                                            </div>
                                                        <input type="hidden" name="Documento" value="'.$Doc.'">
                                                            <div class="form-group">
                                                                <input type="submit" value="Subir Documento" class= "btn btn-primary">
                                                            </div>
                                                        </fieldset>
                                                        <input type = "hidden" name="Usuario" value="'.$uActivo.'"">
                                                    </form>';

                                                   
                                        }    
                                    }  
                              
                            }
                        
                        ?>
                        
                        
                       
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>            
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    
    <!--script src="../Librerias/js/bootstrap.min.js"></script-->
    <script src="../Librerias/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../Librerias/js/sb-admin.js"></script>

</body>

</html><!DOCTYPE html>