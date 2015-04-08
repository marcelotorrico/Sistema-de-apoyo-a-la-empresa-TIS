<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Apoyo a la Empresa TIS</title>

    <!-- Core CSS - Include with every page -->
    <link href="../Librerias/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Librerias/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../Librerias/css/bootstrap-dialog.css" rel="stylesheet">


    <!-- SB Admin CSS - Include with every page -->
    <link href="../Librerias/css/sb-admin.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../Librerias/css/jquery-te-1.4.0.css">
    
    <script src="../Librerias/js/jquery-1.10.2.js"></script>
   
    <script src="../Librerias/js/jquery-2.1.0.min.js"></script>
    <!--script src="../Librerias/js/jquery-ui.js"></script-->
    <script src="../Librerias/js/bootstrap-dialog.js"></script>
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
                <a class="navbar-brand" href="../index.php">Inicio </a>
            </div>
            <!-- /.navbar-header -->

            
            <!-- /.navbar-top-links -->
        </nav>

<!-------------------------------------------NUEVAS PUBLICACIONES------------------------------------------>
<div id="page-wrapper">
           
<form id = "registroU" method = "post" action="" role="form" enctype="multipart/data-form" onsubmit="return validar(registroU)">
        <div class ="form-horizontal">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Registrar Grupo Empresa:</h2>
                    <div class="col-lg-6" >
                                    <form method = "post" id="FormularioRegistroUsuarioGE">
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreU" id="nombreU" placeholder="Nombre de Usuario" pattern="\b[a-zA-z]{5}[a-zA-z0-9]{0,9}" title="Minimo 5 y Maximo 14 caracteres...Ejm: Bittle123, Bitle" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-lock"></span>
                                                </span>
                                                <input class="form-control" type="password" name="contrasena1" id="contrasena1" placeholder="Contraseña" minlength="8" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$" title="Ingrese una contraseña segura, debe tener como minimo 8 caracteres y como maximo 15, al menos una letra mayuscula, una minuscula, un numero y un caracter especial" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-lock"></span>
                                                </span>
                                                <input class="form-control" type="password" name="contrasena2" id="contrasena2" placeholder="Introduzca nuevamente la contraseña" minlength="8" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$" title="Ingrese una contraseña segura, debe tener como minimo 8 caracteres y como maximo 15, al menos una letra mayuscula, una minuscula, un numero y un caracter especial" required>
                                            </div>
                                        </div>
                                        
                                        <br> </br>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreL" id="nombreL" placeholder="Nombre largo" minlength="3" pattern=".{3,}" title="Nombre largo muy corto" required  onkeypress="return validarLetras(event)">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreC" id="nombreC" placeholder="Nombre corto" minlength="3" pattern=".{3,}" title="Nombre corto muy corto" required  onkeypress="return validarLetras(event)">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-envelope"></span>
                                                </span>
                                                <input class="form-control" type="email" name="correo" id="correo" placeholder="Correo" pattern="^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$" title="Ingrese un correo correcto" required  onkeypress="return validarEmail(event)">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-earphone"></span>
                                                </span>
                                                <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Telefono" title="Ejm: 4022371" pattern="\b[4][0-9]{6}"  required  onkeypress="return validarNumeros(event)">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-envelope"></span>
                                                </span>
                                                <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Direccion" required>
                                            </div>
                                        </div>
                                

                                        
                                        <button type="submit" onclick="this.form.action='ProcesarRegistroGrupoE.php'" class="btn btn-primary"> <span class="glyphicon glyphicon-ok"></span> Registrarme</button>
                                    </form>              
                            <div id="panelResultadoGE">
                                
                            </div>        
                        </div>
                </div>
            </div><!-- /.row -->  
            </div>
    </form>  
    </div>
        </div>       
    <script src="../Librerias/js/bootstrap.min.js"></script>
    <script src="../Librerias/js/plugins/metisMenu/jquery.metisMenu.js"></script>


    <!-- SB Admin Scripts - Include with every page -->
    <script src="../Librerias/js/sb-admin.js"></script>
  
    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="../Librerias/js/demo/dashboard-demo.js"></script>
    <!-- Combo Box scripts -->

    
 
</body>

</html>
