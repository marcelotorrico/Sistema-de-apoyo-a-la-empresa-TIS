
<!DOCTYPE html>
<?php
    include '../Modelo/conexion.php';
    session_start();
    $con=new conexion();
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
    <script type="text/javascript" src="../Librerias/js/subir_documento.js"></script>

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
                <a class="navbar-brand" href="inicio_grupo_empresa.php">Inicio </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                                <?php
                                                 $idUsuarioAsesor='leticia';
                                                 $idUsuarioG='freevalue';
                                echo   ""
                                     . "<form name='formularioNombre' action='verificar_nombre.php' enctype='multipart/form-data' method='POST'>"
                                     . "<input type='hidden' name='nombreGrupo' value='$idUsuarioG'>"
                                     . "<input type='hidden' name='nombreAsesor' value='$idUsuarioAsesor'>"
                                     . "</form>"
                                     . "<li>"
                                     . "<a href='javascript:document.formularioNombre.submit();'>Verificar Nombre de Empresa</a>"
                                     . "</li>";
                                ?>
                                <li>
                                    <a href="seleccionar_asesor.php">Seleccionar Asesor</a>
                                </li>
                                
                                 <li>
                                     <a href="AnadirSocio.php">Añadir socios</a>
                                </li>
                                
                                <li>
                                    <a href="AnadirRL.php">Seleccionar Representante legal</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-warning fa-fw"></i> Notificaciones<span class="fa arrow"></span></a>
                                                    
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="historia_actividades.php">Historia de actividades</a>
                                </li>
                                
                            </ul>  
                            </li>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building-o fa-fw"></i> Actividades<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a id="registrarPlanificacion" href="#">
                                        <i class="fa fa-pencil-square-o fa-fw"></i>Registrar Planificaci&oacute;n
                                    </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-question-circle fa-fw"></i> Ayuda <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="lista-de-noticias-grupo.php"><i class="fa fa-comment"></i> Foro</a>
                                
                            </ul>
                            <!-- /.nav-second-level -->
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
                        <!-- introducimos el titulo y la descripcion del documento a subir -->
                        <form name="formulario1" >
                            <div class="form-group">
                                <?php
                                //recuperamos las variables enviadas por subir_documentos.php
                        $idAsesor=$_POST["nombreUsuarioAsesor"];
                       
                        $titulo=$_POST["nombreRegistro"];
                        $idGrupo=$_POST['nombreUsuarioG'];
                        try{
                            //creamos la conexion y recuperamos los datos de titulo y descripcion del documento
                         $conexion = new conexion();
                         date_default_timezone_set('America/Argentina/Tucuman');
                         $fecha=  date('Y-m-d');
                         $hora= date('G:H:i');
                         $consulta=$conexion->consulta("SELECT r.NOMBRE_R,d.`DESCRIPCION_D`,p.`FECHA_INICIO_PL`,p.`FECHA_FIN_PL`,p.`HORA_INICIO_PL`,p.`HORA_FIN_PL` FROM registro AS r,plazo AS p,descripcion AS d,`estado` AS e,`tipo` AS t WHERE r.ID_R = d.ID_R AND r.`TIPO_T` = t.`TIPO_T` AND r.ID_R = p.ID_R AND e.`ESTADO_E` = r.`ESTADO_E` AND r.`ESTADO_E` LIKE 'habilitado' AND r.NOMBRE_U LIKE '$idAsesor' AND p.`FECHA_INICIO_PL` <= '$fecha' AND p.`FECHA_FIN_PL` >= '$fecha' AND t.`TIPO_T` LIKE 'documento requerido' AND r.`NOMBRE_R` LIKE '$titulo'");
                         if (mysql_num_rows($consulta) == 0)
                         {
                             echo "<h4>La opci&oacuten $titulo ya no est&aacute; disponible</h4>";
                         }
                         else
                         {
                            
                            $VerificarIns= $con->consulta("SELECT NOMBRE_U FROM inscripcion_proyecto WHERE NOMBRE_U = '$uActivo' ");
                            $VerificarIns2 = mysql_fetch_row($VerificarIns);
                            if (!is_array($VerificarIns2))
                            {
                                echo "<h4>Para subir su propuesta primero debe inscribirse a un proyecto</h4>";
                            }
                            else{       
                             
                             $fila = mysql_fetch_array($consulta);
                             
                             if (($fila['2'] == $fecha && $hora <= $fila['4']) || ($fila['3'] == $fecha && $hora >= $fila['5'] )) {
                                 echo "<h4>La opci&oacuten $titulo no esta disponible</h4>";
                                 
                             }
                             else
                             {
                            //insertamos los datos recuperados y hacemos llamada al script subir_documento.js donde se encuentra todo lo que maneja la subida del documento 
                             $temp=  str_replace(" ", "/", $fila['0']);
                             echo   "<h4>".$fila['0']."</h4>"
                                    . "<h5>".$fila['1']."</h5>"
                                    . "<form id='subir_archivoA' method='POST' enctype='multipart/form-data'>"
                                        . "<fieldset>"
                                            . "<input name='archivoA' id='archivoA' type='file' class = 'btn btn-primary' /><br>"
                                            ."<input type='hidden' name='autor' value='".$idAsesor."'>"
                                             ."<input type='hidden' name='titulo' value='".$titulo."'>"
                                            . "<input type='button' value='Subir Documento' class= 'btn btn-primary' onclick= uploadFileA('".$idGrupo."','".$temp."')><br>"
                                            . "<br><progress id='progressBar' class='progress progress-striped active' value='0' max='100' style='width:300px;'></progress>"
                                            . "<h3 id='status'></h3>"
                                            . "<p id='loaded_n_total'></p>";
                    
                                            echo "<h5>La entrega esta disponible desde la fecha: ".$fila['2']."/".$fila['4']." hasta la fecha: ".$fila['3']."/".$fila['5']." </h5>"
                                        . "</fieldset>"
                                     . "</form>";
                             
                            }
                                        
                            }
                        }
                         
                            $conexion->cerrarConexion();
                        }
                        catch (ErrorException $e)
                        {
                            echo $e;
                        }
                        
                        
                        ?>
                                
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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
    <script src="../Librerias/js/demo/dashboard-demo.js"></script>

</body>

</html>
