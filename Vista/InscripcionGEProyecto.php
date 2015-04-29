<?php

    include '../Modelo/conexion.php';
    session_start();
    $uActivo = $_SESSION['usuario'];
    
    require '../Controlador/ValidadorInicioSesion.php';

    $verificar = new ValidadorInicioSesion();
    $verificar->validarInicioSesion($uActivo,"grupoEmpresa");

    $conexion = new conexion();

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
    <script type="text/javascript" src="../Librerias/lib/validator/callback.js"></script
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
                    <h2 class="page-header">Inscribirse a un proyecto </h2>
                    <div class="col-lg-4" >
                         <?php
                         
                          $seleccion = "SELECT NOMBRE_UA FROM inscripcion WHERE NOMBRE_UGE = '$uActivo'";
                          $conexionsultar = $conexion->consulta($seleccion);
                          $nombreUA = mysql_fetch_array($conexionsultar);

                          $VerificarHabilitacion = $conexion->consulta("SELECT * FROM inscripcion WHERE NOMBRE_UGE='$uActivo' AND ESTADO_INSCRIPCION='Habilitado'");
                          $Habilitacion = mysql_fetch_row($VerificarHabilitacion);

                        if(strnatcasecmp($nombreUA[0], "") != 0){

                            if(is_array($Habilitacion))
                            {        
                        ?>


                            <div class="form-group">
                                <form method="POST" <b>Proyectos disponibles :</b>
                                    <select name="proyecto" class="form-control">
                                    <option>Seleccione un proyecto</option>
                                    <?php
                                        $idGE = $_SESSION['usuario'];
                                        $seleccion = "SELECT id_g "
                                                . "FROM gestion "
                                                . "WHERE DATE (NOW()) > DATE(FECHA_INICIO_G) and DATE(NOW()) < DATE(FECHA_FIN_G)";
                                        $conexionsulta_= $conexion->consulta($seleccion);
                                        $idGestion = mysql_fetch_row($conexionsulta_);
                                        $idGestion_ = $idGestion[0];
                                                                       
                                        $seleccion = "SELECT p.`NOMBRE_P` FROM `proyecto` AS `p`, `gestion` AS `g` WHERE p.`ID_G` = g.`ID_G` AND p.`ID_G` LIKE '".$idGestion_."'";
                                 
                                        $conexionsulta = $conexion->consulta($seleccion);
                
                                        while($proyecto =  mysql_fetch_array($conexionsulta)){
                                            echo "<option>".$proyecto[0]."</option>";
                                        }
                                    echo "<input type='hidden' name='idGE' value='$idGE'>";
            
                                    ?>
                                     </select><br>
                                    <br>
                                    <input type='hidden' name='ge' value=<?php echo $uActivo; ?>>
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-primary" onclick="this.form.action='../Modelo/BD/RegistrarProyectoGE.php'">  <span class="glyphicon glyphicon-ok"></span> Aceptar</button>
                                   </div>       
                                </form>
                            </div>
                        <?php
                            }
                            else
                            {
                                echo '<div class="alert alert-warning">
                                     <strong>Su inscripcion no ha sido habilitada</strong>
                                    </div>';

                            }
                        }
                          else
                          {
                               echo '<div class="alert alert-warning">
                                     <strong>Primero debe inscribirse con un asesor, en la opcion de "Seleccionar asesor"</strong>
                             </div>';
                          }
                        ?>
                        
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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