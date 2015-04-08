<?php  
 include '../Modelo/conexion.php';
 session_start();
 $uActivo = $_SESSION['usuario'];
 $con = new conexion(); 
 ?> 
 <!DOCTYPE html>
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
    <!-- JS -->
    <script type="text/javascript" src="../Librerias/lib/funcion.js"></script>
    <script type="text/javascript" src="../Librerias/lib/funcionSeguimiento.js"></script>

    <script type="text/javascript">
        function mostrarReferencia()
        {
          if (document.fcontacto.Conocido[1].checked == true) 
          {
            document.getElementById('desdeotro').style.display='block';
          } 
          else 
          {
            document.getElementById('desdeotro').style.display='none';
          }
          if (document.fcontacto.Conocido[2].checked == true) 
          {
            document.getElementById('proyecto').style.display='block';
         } 
         else 
         {
            document.getElementById('proyecto').style.display='none';
         }
        }  
        </script>

    


    

    <link type="text/css" rel="stylesheet" href="../Librerias/css/jquery-te-1.4.0.css">
    <script src="../Librerias/js/jquery-te-1.4.0.min.js"></script>


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
            <a class="navbar-brand" href="inicio_asesor.php">Inicio </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="lista-de-noticias.php"><i class="glyphicon glyphicon-comment"></i> Foro</a>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <?php echo $uActivo.' '; ?><i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">

                    <li>
                        <a href="modificar_asesor.php"><i class="fa fa-user fa-fw"></i> Modificar Datos personales</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="unlog.php"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
                    </li>
                </ul>
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="AdministrarGrupoEmpresa.php"><i class="glyphicon glyphicon-book"></i> Administrar Grupo Empresas</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-files-o "></i> Documentos <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../Vista/documentos_generados.php">Contratos Emitidos</a>
                            </li>
                            <li>
                                <a href="lista_doc_subidos.php">Documentos Subidos </a>  
                            </li>
                            <li>
                                <a href="documentos_recibidos.php">Documentos Recibidos</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Tareas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="InscripcionProyecto.php">Registrar Proyecto</a>
                            </li>
                            <li>
                                <a href="../Vista/subirarchivoasesor.php">Subir Documentos</a>
                            </li>
                            <li>
                                <a href="../Vista/RegistrarDocumentosRequeridos.php">Registrar Documentos Requeridos</a>
                            </li>
                            
                            <li>
                                <a href="ConfiguracionFechasRecepcion.php" >Configurar Fechas para la Recepci&oacute;n de Documentos</a>
                            </li>
                            <li>
                                <a href="../Vista/publicar_asesor.php">Crear Publicaci&oacute;n </a>
                            </li>
                            <li>
                                <a href="ordenDeCambio.php">Emitir Orden de Cambio</a>
                            </li>
                            <li>
                                <a href="notificacion_conformidad.php">Emitir Notificaci&oacute;n de Conformidad</a>
                            </li>
                            <li>
                                <a href="contrato.php">Emitir Contrato </a>
                            </li>
                            
                        </ul>
                    </li>

                    <li>
                        <a id="SeguimientoSemanal" href="#"><i class="glyphicon glyphicon-list-alt"></i> Seguimiento Semanal</a>
                    </li>

                    <li>
                        <a href="#"><i class="glyphicon glyphicon-th-list"></i> Evaluacion<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="lista_evaluacion.php">Evaluacion 2 Fase </a>                             
                            </li>
                            <li>
                                <a href="#">Evaluacion 3 Fase <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="CrearModalidadEvaluacion.php">Criterio de Evaluaci&oacute;n </a>                             
                                    </li>

                                    <li>
                                        <a href="#">Criterio de Calificaci&oacute;n<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="CrearModalidadCalificacion.php"> Crear Criterio de Calificaci&oacute;n</a>
                                            </li>
                                            <li>
                                                <a href="EliminarCriterioCalificacion.php"> Eliminar Criterio de Calificaci&oacute;n</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#">Formulario de Evaluacion<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="CrearFormulario.php">Crear Formulario de Evaluacion</a>
                                            </li>
                                            <li>
                                                <a href="SeleccionarFormulario.php"> Habilitar Formulario de Evaluacion </a>   
                                            </li>
                                            <li>
                                                <a href="EliminarFormulario.php">Eliminar Formulario de Evaluacion</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="EvaluarGrupoEmpresa.php">Evaluar Grupo Empresa </a>   
                                    </li>                                    
                                    
                                </ul>    
                            </li>
                            <li>
                                <a href="../Vista/EvaluacionGeneral.php">Evaluacion Final </a>   
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="../Vista/publicaciones.php"><i class="fa fa-book"></i> Publicaciones </a>
                    </li>
                </ul><!-- /#side-menu -->
            </div><!-- /.sidebar-collapse -->
        </div>
    </nav>
<div class="modal fade modalRegistroAsistencia" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Asistencia</h4>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>

<div class="modal fade modalRegistroReportes" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Reportes</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<div class="modal fade modalSeguimiento" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Ver Seguimientos</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<div id="page-wrapper">
    <form action="tablas.php" method="post" name="fcontacto" onsubmit = "return validarCampos(this);">
        <div class ="form-horizontal">
            <div class="row">
                    <div class="col-lg-12">
                          <h2 class="page-header"> Publicar Recursos</h2>
                  </div>
            </div><!-- /.row -->
               
                <!--Descripcion de la publicacion-->                 
                <fieldset class="campos-border">
                  <legend class="campos-border">Informaci&oacute;n</legend>

                 <div class="form-group">
                      <label class="col-sm-2 control-label">Destinatarios:</label>
                             <div class="col-xs-8">
                                  
                                 </br>
                                 <input type="radio" name="Conocido" value="Publico" id="Conocido_0" onclick="mostrarReferencia();" /> Publico
                                 </br><input type="radio" name="Conocido" value="Grupo Empresa" id="Conocido_0" onclick="mostrarReferencia();" /> Grupo Empresa
                               </br> <input type="radio" name="Conocido" value="Proyectos" id="Conocido_1" onclick="mostrarReferencia();" /> Proyectos
                              </div>
                 </div>




               <div class="form-group" id="desdeotro" style="display:none;">
                      <label class="col-sm-2 control-label">Grupo Empresa</label>
                             <div class="col-xs-8">
                                  <select id ="grupo" name="grupoempresa" class="form-control" >
                                        <option>Seleccione Grupo Empresa</option>
                                        <?php
                                            $c1="SELECT ge.`NOMBRE_LARGO_GE` FROM `grupo_empresa` AS ge,`inscripcion` AS i WHERE i.`NOMBRE_UA` = '$uActivo' AND i.`NOMBRE_UGE` = ge.`NOMBRE_U`";
                                            $a1=$con->consulta($c1);
                                            
                                             echo "<option>TODOS</option>";
                                            while($v1 =  mysql_fetch_array($a1)){
                                                echo "<option>".$v1[0]."</option>";
                                            }
                                            echo "<input type='hidden' name='idAsesor' value='$uActivo'>";
                                        ?>
                                    </select>
                                    
                            </div>

             </div>


             <div class="form-group" id="proyecto" style="display:none;">
                      <label class="col-sm-2 control-label">Proyecto</label>
                             <div class="col-xs-8">
                                 <select name="proyecto" class="form-control">
                                    <option>Seleccione Proyecto</option>
                                    <?php
                                        $idGE= $_SESSION['usuario']  ;
                                        $conGestion="SELECT id_g "
                                                . "FROM gestion "
                                                . "WHERE DATE (NOW()) > DATE(FECHA_INICIO_G) and DATE(NOW()) < DATE(FECHA_FIN_G)";
                                        $conGestion_=$con->consulta($conGestion);
                                        $idGestion=mysql_fetch_row($conGestion_);
                                        $idGestion_=$idGestion[0];
                                                                       
                                        $c1="SELECT p.`NOMBRE_P` FROM `proyecto` AS `p`, `gestion` AS `g` WHERE p.`ID_G` = g.`ID_G` AND p.`ID_G` LIKE '".$idGestion_."'";
                                 
                                        $a1=$con->consulta($c1);
                                         echo "<option>TODOS</option>";
                                        while($v1 =  mysql_fetch_array($a1)){
                                            echo "<option>".$v1[0]."</option>";
                                        }
                                    echo "<input type='hidden' name='idGE' value='$idGE'>";
            
                                    ?>
                                     </select>
                                    
                            </div>

             </div>

              <div class="form-group">
                      <label class="col-sm-2 control-label">Titulo</label>
                             <div class="col-xs-8">
                                  <input id= "campoTitulo" type="text" name= "campoTitulo"  class="form-control"  data-toggle="tooltip" data-placement="right" title="T&iacute;tulo con el que se mostrar&aacute; el recurso">

                            </div>
                   </div>

                 

                   
                  
                      <!--Campo de descripcion-->
                      <div class="form-group">
                            <label class="col-sm-2 control-label">Descripcion</label>
                                <div class="col-sm-8">
                                     <textarea class="jqte-test" name="campoDescripcion" id="campoDescripcion" rows="4" style="overflow: auto;"></textarea>
                                </div>
                      </div>


                      <div class="form-group">
                       <label class="col-sm-2 control-label" >Fecha de publicacion:</label>
                        <div class="col-xs-8">
                              
                                <input class="form-control" type="date" name="fecha1" placeholder="AAAA-MM-DD" pattern="^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$" required/> 
                            </div>
                        </div>
                            
 
 <div class="form-group">
                        <label class="col-sm-2 control-label" >Hora de publicacion:</label>
                        <div class="col-sm-8" >
                        <input class="form-control" name="hora1" type="time" required placeholder="HH:MM" pattern="^([0-1]?[0-9]|[2][0-3]):([0-5][0-9])(:[0-5][0-9])?$" required/>
                    </div>
      
                    </div><!--end/fecha-->
                        
                                 

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Adjuntar Recurso</label>
                        <div class="col-sm-8">
                        
                              <input id= "recurso" type="text" name= "recurso"  class="form-control"   data-toggle="tooltip" data-placement="right" title="Adjuntar un recurso" readonly="readonly">
                                 </textarea>
                        <br>
                        <a data-toggle="modal" class="link-dos" href="javascript:void('')" data-target="#myModal"><span class="glyphicon glyphicon-folder-open"></span>
                        Adjuntar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="btn-primary" type="submit" value= "Publicar" id= "publicar"name="enviar" onClick()="update()"  >      </input> 

                       </div>
                        </div>
</form>

            <div style="display: none;" aria-hidden="true" class="modal fade" id="myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Buscador</h4>
                        </div>
                        <div class="modal-body" style="padding:0px; margin:0px; width: 560px;">
                            <iframe src="../Librerias/filemanager/dialogo.php?type=2&amp;field_id=recurso" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; " frameborder="0" height="500" width="896"></iframe>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            
            <div class="form-group">
                <div class="col-sm-8">
            </div>  
    
</div>
<!-- /#page-wrapper -->

</div>

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
<script src="../Librerias/js/sb-admin.js"></script>
</body>

</html>