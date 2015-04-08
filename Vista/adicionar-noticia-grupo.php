<?php
    include '../Modelo/conexion.php';
   
    session_start();
    $uActivo = $_SESSION['usuario'];
  

    $con=new conexion();
    $VerificarUsuario = $con->consulta("SELECT NOMBRE_U FROM usuario WHERE NOMBRE_U = '$uActivo' ");
    $VerificarUsuario2 = mysql_fetch_row($VerificarUsuario);
    
    $usuario = $uActivo;
    
    if (!is_array($VerificarUsuario2)) {   
    $consultaGE="SELECT `NOMBRE_U` FROM socio WHERE `NOMBRES_S` = '$uActivo'";
    $conGE_=$con->consulta($consultaGE);
    $NombreUsuario=mysql_fetch_row($conGE_);

    $usuario=$NombreUsuario[0];

  }

?>

<html>

<head>





    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Apoyo a la Empresa TIS</title>
     <!-- JQuery -->
    <script src="../Librerias/js/jquery-1.10.2.js"></script>
    <!-- icheck -->
    <link href="../Librerias/icheck/skins/square/green.css" rel="stylesheet">
    <script src="../Librerias/lib/icheck.min.js"></script>
    <!-- Bootstrap -->
    

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
    <script type="text/javascript" src="../Librerias/lib/validator/integerN.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/porcentajeAc.js"></script>
    <!-- JS -->
    <script type="text/javascript" src="../Librerias/lib/funcion.js"></script>
    
    <link type="text/css" rel="stylesheet" href="../Librerias/css/jquery-te-1.4.0.css">
    <script src="../Librerias/js/jquery-te-1.4.0.min.js"></script>



    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="../Librerias/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="../Librerias/css/plugins/timeline/timeline.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="../Librerias/css/sb-admin.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css" />

    <style>
            .textbox
            {
                resize:none;
                width: 1026px;
                height: 240px;
            }
    </style>

</head>

<body>

      <link href="css/estiloTabla.css" rel="stylesheet" type="text/css" />
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
                                    
                                        $docsReq = $con->consulta("SELECT NOMBRE_R FROM registro, documento_r, inscripcion, inscripcion_proyecto WHERE inscripcion_proyecto.CODIGO_P = documento_r.CODIGO_P AND documento_r.ID_R = registro.ID_R AND inscripcion_proyecto.NOMBRE_U = '$uActivo' AND inscripcion.NOMBRE_UGE = inscripcion_proyecto.NOMBRE_U");
                                     
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
                    <div class="article">
                          <div class="panel-heading">
                            <i ></i><h2 class="page-header"> Nuevo </h2>
                        </div>
                   </div>
                  
                       
                            

                        <?php

                         error_reporting(E_ALL ^ E_NOTICE);
                         // Mensaje con campos vacios
                         if (!empty($_POST) AND (empty($_POST['titulo']) OR empty($_POST['texto']))) 
                         {
                           echo "<font color=\"#ff0000\">Por Favor llene los campos vacios</font>";
                          } 
                          else {
                                     if (isset($_POST['titulo'])) 
                                     {
                                        $titulo = $_POST["titulo"];
                                     }

                                     if (isset($_POST['texto'])) 
                                     {
                                        $texto = $_POST['texto'];
                                     }

                                    if($titulo == "" && $texto == "")
                                    {

                                    } 
                                    else 
                                    {
                                         // Adiciona a Noticia 
                                        $textoNotiN=$_POST['texto'];
                                       
                                        $noticia = "INSERT INTO noticias (NOMBRE_U,TITULO, FECHA_N, VIEWS, TEXTO, POSTEADO) VALUES ('$usuario','".addslashes(mysql_real_escape_string($_POST["titulo"]))."', NOW(), '0', '$textoNotiN','$uActivo')";
                                        $noticia = $con->consulta($noticia)
                                        or die ("Error.");
                                        echo "<script type=\"text/javascript\">alert('Tema Adicionado');</script>";

                                    }

                                }
                        ?>
                            <form name="input" action="adicionar-noticia-grupo.php" method="post">
                       
                                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Titulo:</label>
                                            <div class="col-xs-8">
                                                <input id= "campoTitulo" type="text" name= "titulo"  class="form-control"  data-toggle="tooltip" data-placement="right" title="T&iacute;tulo con el que se mostrar&aacute; el recurso">
                                            </div>
                                    </div>
                                    </br></br>
                      
                                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Texto:</label>
                                            <div class="col-sm-8">
                                                <textarea class="jqte-test"  name="texto" id="campoDescripcion" rows="10" style="overflow: auto;"></textarea>
                                            </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-xs-10">
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="submit" class="btn btn-primary" value="Adicionar Tema"></p>
                                        </div>
                                    </div>
                            </form>
                </div>
                 
         </div>
                <!-- /.col-lg-12 -->
     </div>
            <!-- /.row -->
 </div>
            
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    
    <!--script src="../Librerias/js/bootstrap.min.js"></script-->
    <script>
    $('.jqte-test').jqte();
    var jqteStatus = true;
    $(".status").click(function()
    {
        jqteStatus = jqteStatus ? false : true;
        $('.jqte-test').jqte({"status" : jqteStatus})
    });
</script>
<script type="text/javascript">
function validarCampos(formulario) {
    var permitidos = /^[0-9a-zA-Z\s/]+$/

            //Controlar campos vacios y caracteres invalidos
            if(formulario.campoTitulo.value.length==0) {  
                formulario.campoTitulo.focus();    
                alert('Por favor, ingresa un titulo');  
                return false;  
            }
            if(!formulario.campoTitulo.value.match(permitidos)) {

                alert('Caracteres no validos:_a,¿?()*,"" ');
                return false;
            }
            if(formulario.campoDescripcion.value.length >= 1000) {
                formulario.campoDescripcion.focus();
                alert('Descripcion demasiado larga(max 1000 caracteres)')
                return false;
            }
            if(formulario.campoDescripcion.value.length==0){
                formulario.campoDescripcion.focus();
                alert('Por favor, ingrese una descripcion');
                return false;
            }

            

        }
</script>
    <script src="../Librerias/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../Librerias/js/sb-admin.js"></script>

</body>

</html><!DOCTYPE html>