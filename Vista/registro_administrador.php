<?php  
 session_start();
 if (isset($_SESSION['usuario'])) {
 $uActivo = $_SESSION['usuario'];

 require '../Controlador/ValidadorInicioSesion.php';

$verificar = new ValidadorInicioSesion();
$verificar->validarInicioSesion($uActivo,"administrador");

 ?> 
<!DOCTYPE html>
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
    <link href="css/style.css" rel="stylesheet" type="text/css" />      
    
    <script type="text/javascript" src="../Librerias/js/validar_registro.js"></script>

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


            <div class="row">
            <div class="col-lg-12">
            <h2 class="page-header">Registrar Usuario:</h2>
            <div class="col-lg-6" >
                <form id = "registroU" method = "post" action="../Controlador/crear_administrador.php" role="form" enctype="multipart/data-form" onsubmit="return validar(registroU)">

            <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-user"></span>
            </span>
            <input class="form-control" type="text" name="usuario" id="UserName" placeholder="Nombre de Usuario" pattern="^[a-zA-Z]{3}[a-zA-z0-9_\\_\ü]{0,9}$" title="Minimo 3 caracteres y Maximo 12. Los primeros tres caracteres tienen que ser letras. Ejm: Leticia1, Rolando2" required>
            </div>
            </div>
            <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-lock"></span>
            </span>
            <input class="form-control" type="password" name="contrasena" id="contrasena1" placeholder="Contraseña" minlength="8" pattern=".{8,}" title="Ingrese una contraseña segura, debe tener como minimo 8 caracteres" required>
            </div>
                <input type="checkbox" onchange="document.getElementById('contrasena1').type = this.checked ? 'text' : 'password',document.getElementById('contrasena2').type = this.checked ? 'text' : 'password'" > Ver contraseña
            </div>
                
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-lock"></span>
                    </span>
                    <input class="form-control" type="password" name="contrasena2" id="contrasena2" placeholder="Introduzca nuevamente la contraseña" minlength="8" pattern=".{8,}" title="Ingrese una contraseña segura, debe tener como minimo 8 caracteres" required>
                </div>
            </div>                
                
            <br> </br>    
                
            <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-user"></span>
            </span>
            <input class="form-control" type="text" name="nombre" id="RealName" placeholder="Nombre" pattern="[A-Z]{1}[a-z]{2,20}$" title="El nombre debe empezar con mayuscula y como minimio debe poseer 3 caracteres. Ejm: Daniel, Marcelo, Rolando" required>
            </div>
            </div>
            <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-user"></span>
            </span>
            <input class="form-control" type="text" name="apellido" id="LastName" placeholder="Apellido" pattern="[A-Z]{1}[a-z]{2,20}\s?([A-Z]{1}[a-z]{2,20})?" title="El apellido debe empezar con mayuscula y como minimio debe poseer 3 caracteres. Ejm: Vargas, Morales, Medrano" required>
            </div>
            </div>


            <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-earphone"></span>
            </span>
            <input class="form-control" type="text" name="telefono" id="UserPhone" placeholder="Telefono" title="Ejemplo: 4022371, 71759599, 67241212" pattern="^(([4][0-9]{6})|([7|6][0-9]{7}))$" required>
            </div>
            </div>
            <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-envelope"></span>
            </span>
            <input class="form-control" type="text" name="email" id="UserEmail" placeholder="Correo" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$" title="Ingrese un correo valido. Ejm: admin@hotmail.com ,admin@yahoo.com, admin@gmail.com" required>
            </div>
            </div>

            <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary" id="btn-registrarUser"> <span class="glyphicon glyphicon-ok"></span> Registrarme</button>
            </div>
            </form>              
            <div id="panelResultado">

            </div>        
            </div>
            </div>
            </div><!-- /.row -->                          





            </div>

            </div>




            </div>
            <!-- /.col-lg-12 -->
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
<?php  
}else{
   echo '<script>alert("Inicie sesion para ingresar");</script>';
   echo '<script>window.location="../index.php";</script>';
}

?>

</body>

</html>
