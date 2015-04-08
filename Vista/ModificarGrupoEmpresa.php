<?php
 include '../Modelo/conexion.php';
 session_start();
 $uActivo = $_SESSION['usuario'];
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

            
   <!-- --------------------------------------------------------------------------------------------------------- --->          
            
         <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Modificar Informacion Personal</h2>
                </div>
            </div>
             
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default" id="configuracionFechas">
                        <div class="panel-body"> 
                            
                                    <?php

                                        $nLargo;
                                        $nCorto;
                                        $correo;
                                        $telefono;
                                        $direccion;
                                        $contrase;

                                        $peticion = $conexion->consulta("SELECT G.NOMBRE_LARGO_GE, G.NOMBRE_CORTO_GE, U.CORREO_ELECTRONICO_U, U.TELEFONO_U, G.DIRECCION_GE, U.PASSWORD_U
                                                    FROM grupo_empresa G, usuario U WHERE G.NOMBRE_U=U.NOMBRE_U AND U.NOMBRE_U='$uActivo'");         


                                        while($fila = mysql_fetch_array($peticion))
                                        {
                                            $nLargo = $fila["NOMBRE_LARGO_GE"];
                                            $nCorto = $fila["NOMBRE_CORTO_GE"];
                                            $correo = $fila["CORREO_ELECTRONICO_U"];
                                            $telefono = $fila["TELEFONO_U"];
                                            $direccion = $fila["DIRECCION_GE"];
                                            $contrase = $fila["PASSWORD_U"];
                                        }
                                   ?>       
                            
                                    <form method = "post" id="FormularioRegistroUsuarioGE">
                                       
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreU" id="nombreU" value=<?php echo $uActivo?> " readonly="readonly" pattern="\b[a-zA-z]{5}[a-zA-z0-9]{0,9}" title="Minimo 5 y Maximo 14 caracteres...Ejm: Bittle123, Bitle" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-lock"></span>
                                                </span>
                                                <input class="form-control" type="text" name="contrasena1" id="contrasena1" value="<?php echo $contrase ?>" minlength="8" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$" title="Ingrese una contraseña segura, debe tener como minimo 8 caracteres y como maximo 15, al menos una letra mayuscula, una minuscula, un numero y un caracter especial" required>
                                            </div>
                                        </div>
                                        <br> </br>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreL" id="nombreL" value="<?php echo $nLargo ?>"readonly="readonly" minlength="3" pattern=".{3,}" title="Nombre largo muy corto" required  onkeypress="return validarLetras(event)">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreC" id="nombreC" value="<?php echo $nCorto ?>" readonly="readonly" minlength="3" pattern=".{3,}" title="Nombre corto muy corto" required  onkeypress="return validarLetras(event)">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-envelope"></span>
                                                </span>
                                                <input class="form-control" type="email" name="correo" id="correo" value="<?php echo $correo ?>" pattern="^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$" title="Ingrese un correo correcto" required  onkeypress="return validarEmail(event)">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-earphone"></span>
                                                </span>
                                                <input class="form-control" type="text" name="telefono" id="telefono" value="<?php echo $telefono?>" title="Ejm: 4022371" pattern="\b[4][0-9]{6}"  required  onkeypress="return validarNumeros(event)">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-envelope"></span>
                                                </span>
                                                <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo $direccion ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                             <button type="submit" name="submit" class="btn btn-primary" onclick="this.form.action='ModificarGE.php'">  <span class="glyphicon glyphicon-ok"></span> Actualizar</button>
                                        </div>
                                        
                                    </form>   
                                    <div id="panelResultado">
      
                                    </div>  
                        </div><!-- /.panel -->
                    </div>
                <!-- /.col-lg-6 -->      
                </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                </div>
            </div><!-- /.row -->

            
        </div><!-- /#page-wrapper --> 
            
            
            
            
         

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    
    <!--script src="../Librerias/js/bootstrap.min.js"></script-->
    <script src="../Librerias/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../Librerias/js/sb-admin.js"></script>

</body>

</html><!DOCTYPE html>