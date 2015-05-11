<?php  
    session_start();
    $uActivo = $_SESSION['usuario'];
    include '../Modelo/conexion.php';
    
    require '../Controlador/ValidadorInicioSesion.php';

    $verificar = new ValidadorInicioSesion();
    $verificar->validarInicioSesion($uActivo,"administrador");

    $conectar = new conexion();
    
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




            <h2><span>Modificar Informacion Personal</span></h2>
            <div id="contenido">
            <?php




            $usuario= $_SESSION['usuario'];
            $contrasena= $_SESSION['contrasena'];





            //Peticion
            $peticion =$conectar->consulta("SELECT u.NOMBRE_U,u.PASSWORD_U,u.TELEFONO_U,u.CORREO_ELECTRONICO_U,a.NOMBRES_AD,a.APELLIDOS_AD FROM  usuario u, administrador a WHERE u.NOMBRE_U=a.NOMBRE_U  and u.NOMBRE_U='$usuario'");
            //cerrar conexion--------------------------

            while($fila = mysql_fetch_array($peticion))
            {

            echo"
            <form action='../Controlador/actualizar_integrante.php' method='post'>
            <table border=0 width=50%>
            <tr>
            <td >

            </td>
            <td>

            <div class='form-group'>
            <div class='input-group'>
            <span class='input-group-addon'>
            <span class='glyphicon glyphicon-user'></span>
            </span>
            <input class='form-control' type='text' name='login' id='UserName'  value='".$fila['NOMBRE_U']."' pattern='\b[a-zA-z]{3}[a-zA-z0-9]{0,11}' title='Minimo 3 caracteres y Maximo 14. Los primeros tres caracteres tienen que ser letras, despues se permite: Letras, numeros y '_' Ejm: Leticia1, Rolando2' required/>
            </div>
            </div>
            </td>
            </tr>
            <tr>
            <td >


            </td>
            <td>
            <div class='form-group'>
            <div class='input-group'>
            <span class='input-group-addon'>
            <span class='glyphicon glyphicon-lock'></span>
            </span>
            <input class='form-control' type='text' name='password' id='UserPassword'    minlength='8' title='Ingrese una contraseña segura, debe tener como minimo 8 caracteres y como maximo 15, al menos una letra mayuscula, una minuscula, un numero y un caracter especial' value='".$fila['PASSWORD_U']."' required/>
            </div>
            </div>  


            </td>
            </tr
            <tr>
            <td >

            </td>
            <td>
            <div class='form-group'>
            <div class='input-group'>
            <span class='input-group-addon'>
            <span class='glyphicon glyphicon-user'></span>
            </span>
            <input class='form-control' type='text' name='nombre' id='RealName' placeholder='Nombre' pattern='\b[A-Z]{1}[a-z]{2,20}' title='El nombre debe empezar con mayuscula y como minimio debe poseer 3 caracteres. Ejm: Daniel, Marcelo, Rolando'  value='".$fila['NOMBRES_AD']."' required />
            </div>
            </div>                                                                                                



            </td>
            </tr>
            <tr>
            <td >

            </td>
            <td>
            <div class='form-group'>
            <div class='input-group'>
            <span class='input-group-addon'>
            <span class='glyphicon glyphicon-user'></span>
            </span>
            <input class='form-control' type='text' name='apellido' id='LastName' placeholder='Apellido' pattern='\b[A-Z]{1}[a-z]{2,20}\b' title='El apellido debe empezar con mayuscula y como minimio debe poseer 3 caracteres. Ejm: Vargas, Morales, Medrano' value='".$fila['APELLIDOS_AD']."' required>
            </div>
            </div>                                                                                                

            </td>
            </tr>
            <tr>
            <td>

            </td>
            <td>
            <div class='form-group'>
            <div class='input-group'>
            <span class='input-group-addon'>
            <span class='glyphicon glyphicon-earphone'></span>
            </span>
            <input class='form-control' type='text' name='telefono' id='UserPhone' title='Ejemplo: 4022371 o 71759599' pattern='\b[467][0-9]{6,7}' value='".$fila['TELEFONO_U']."' required/>
            </div>
            </div>                                                                                               

            </td>
            </tr>
            <tr>
            <td>

            </td>
            <td >

            <div class='form-group'>
            <div class='input-group'>
            <span class='input-group-addon'>
            <span class='glyphicon glyphicon-envelope'></span>
            </span>
            <input class='form-control' type='email' name='email' id='UserEmail' pattern='^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$' value='".$fila['CORREO_ELECTRONICO_U']."' title='Ingrese un correo valido. Ejm: admin@hotmail.com ,admin@yahoo.com, admin@gmail.com' required/>
            </div>
            </div>


            </td>
            </tr>

            <tr>
            <td>
            </td>
            <td>

            <div class='form-group'>
            <button type='submit'  class='btn btn-primary' id='btn-registrarUser'> <span class='glyphicon glyphicon-ok'></span> Actualizar</button>
            </div>


            </td>
            </tr>
            </table>
            </center>
            </form>
            ";
            }

            ?>

            </div>

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
