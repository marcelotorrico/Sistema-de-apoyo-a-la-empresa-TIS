<?php 
    include '../Modelo/conexion.php';
    session_start();
    $uActivo = $_SESSION['usuario'];
    $conect = new conexion();
?>
    <html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- JQuery -->
    <script type="text/javascript" src="../Librerias/lib/jquery-2.1.0.min.js"></script>
    <!-- icheck -->
    <link href="../Librerias/icheck/skins/square/green.css" rel="stylesheet">
    <script src="../Librerias/lib/icheck.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../Librerias/css/bootstrap.min.css" rel="stylesheet">

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
    <script>
        jQuery(document).ready(function() {
    
            $(".verificar").on("click", function(e) {

                return confirm('Esta seguro que quiere eliminar al asesor?');

            });
        });

    </script>





    <link href="../Librerias/css/plugins/timeline/timeline.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="../Librerias/css/sb-admin.css" rel="stylesheet">
    
    
    
    
    
    
    
    
    
    
    
            <title>Bienvenidos a SATIS</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/tabla-div.css" rel="stylesheet" type="text/css" />
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
              <a class="navbar-brand" href="principal.php">Inicio </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
            
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $uActivo.' '; ?><i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
  
                        <li><a href="modificar_administrador.php"><i class="fa fa-user fa-fw"></i> Modificar Datos personales</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="unlog.php"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            
    
       
             
                  
                
         
           <div class="sidebar-collapse">      
                      
                  
             <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        
                                <li>
                                    <a href="../Vista/registro_administrador.php"><i class="fa fa-bar-chart-o fa-files-o "></i> Nueva Cuenta<span class="fa arrow"></span></a>
                                </li>                        
                        
                         <li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Gestion de usuarios<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="lista_usuarios.php">Usuarios Registrados</a>
                                </li>
                                <li>
                                    <a href="asignar_permisos.php">Modificar Permisos Usuarios</a>
                                </li>

                                <li>
                                    <a href="#">Grupo Empresa <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="lista_grupoEmpresa.php"> Integrantes </a>
                                            
                                        </li>
                                        <li>
                                            <a href="ListaGrupoEmpresas.php"> Lista de Grupo Empresas </a>
                                            
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                 <li>
                                    <a href="#">Administrador <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="lista_administradores.php"> Lista de Administadores </a>
                                            
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                 <li>
                                    <a href="#">Asesor <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="lista_asesores.php"> Lista de Asesores </a>
                                            
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building-o fa-fw"></i>Tareas <span class="fa arrow"></span></a>
                                 <ul class="nav nav-third-level">
                                 <li>
                                     <a href="add_roles.php">Añadir  Roles</a>
                                </li>
                                <li>
                                     <a href="add_gestion.php">Añadir  Gestion</a>
                                </li>
  
                                </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building-o fa-fw"></i>Bitacora de ingresos <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                        <li>
                                            <a href="bitacora_ingreso.php">Registro</a>
                                            
                                        </li>

  
                                    </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-building-o fa-fw"></i>Enviar mensaje <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                        <li>
                                            <a href="enviar_mail.php">Nuevo Mensaje</a>
                                            
                                        </li>

  
                                    </ul>
                            <!-- /.nav-second-level -->
                        </li>                       
                        

                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
                    
                    
         </div>
         
        
    </nav> 
                
                
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                  
                    <div class="mainbar">
                                            <div class="article"><br><br>
                            <h2><span>Lista de Asesores</span></h2> 
                           
                        </div>
                                            
                                            
                                   <div class="historia1">
                            <div class="contenedor-fila2">
                                    
                                <div class="contenedor-columna">
                                    <?php
                                        echo "Nombre";
                                    ?>
                                </div>  
                                <div class="contenedor-columna">
                                    <?php
                                        echo "Estado";
                                    ?>
                                </div>
        
                                <div class="contenedor-columna">
                                    <?php
                                        echo "Password";
                                    ?>
                                </div>
                                <div class="contenedor-columna">
                                    <?php
                                        echo "Telefono";
                                    ?>
                                </div>
                                <div class="contenedor-columna">
                                    <?php
                                        echo "e-mail";
                                    ?>
                                </div>
                                <div class="contenedor-columna">
                                    <?php
                                        echo "rol";
                                    ?>
                                </div>
                                                        </div>  
                            <?php
                                //crear conexion---------------------------
                                
                                //Peticion
                                $peticion = $conect->consulta("SELECT u.NOMBRE_U, u.ESTADO_E, u.PASSWORD_U, u.TELEFONO_U , u.CORREO_ELECTRONICO_U, r.ROL_R
FROM usuario u , usuario_rol r
WHERE  u.NOMBRE_U = r.NOMBRE_U  AND r.ROL_R = 'asesor'");
                            

                                while($asesor = mysql_fetch_array($peticion))
                                {
                                      
                            ?>
                                <div class="contenedor-fila">
                                       <div class="contenedor-columna">
                                        <?php
                                            echo $asesor['NOMBRE_U'];
                                        ?>
                                    </div>
                                    
                                    <div class="contenedor-columna">
                                        <?php
                                            echo $asesor['ESTADO_E'];
                                        ?>
                                    </div>
            
                                    <div class="contenedor-columna">
                                        <?php
                                            echo $asesor['PASSWORD_U'];
                                        ?>
                                    </div>
                                    
                                    <div class="contenedor-columna">
                                        <?php
                                            echo $asesor['TELEFONO_U'];
                                        ?>
                                    </div>
                                    
                                    <div class="contenedor-columna">
                                        <?php
                                            echo $asesor['CORREO_ELECTRONICO_U'];
                                        ?>
                                    </div>
                                    <div class="contenedor-columna">
                                        <?php
                                            echo $asesor['ROL_R'];
                                        ?>
                                    </div>  
                                     
                                    
                                       <div class="contenedor-columna">
                                        <?php
                                            echo "<a href ='eliminar_asesor.php?id_us=".$asesor['NOMBRE_U']."' class='verificar'><font color='blue'>Eliminar</font></a>";
                                        ?>
                                    </div>
                                                                                                  
<!--                                                                        <div class="contenedor-columna">
                                        <?php
                                                                                    
                                        ?>
                                    </div>-->
                                                                      
                                    
                                </div>
                                       
                                <?php
                            
                                }

                                //Cerrar
                                
                        ?>  
                                                           
                                                      </div>                                         
                                            
                                            
                                            
                        
                    </div>
                                
                    
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
     
        </div>
        <!-- /#page-wrapper -->

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
