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
    
    
    <script src="../Librerias/js/jquery-2.1.0.min.js"></script>
    <script src="../Librerias/js/jquery.validate.min.js"></script>

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
                                    <form method = "post" id="FormularioRegistroUsuarioGE" action="#">
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreU" id="nombreU" placeholder="Nombre de Usuario" pattern="^[a-zA-Z]{3}[a-zA-z0-9_\\_\ü]{0,9}$" title="Minimo 3 caracteres y Maximo 12. Los primeros tres caracteres tienen que ser letras. Ejm: Bittle123, Bitle" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-lock"></span>
                                                </span>
                                                <input class="form-control" type="password" name="contrasena1" id="contrasena1" placeholder="Contraseña" pattern=".{8,}" title="Debe tener minimamente 8 caracteres" required>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-lock"></span>
                                                </span>
                                                <input class="form-control" type="password" name="contrasena2" id="contrasena2" placeholder="Introduzca nuevamente la contraseña" pattern=".{8,}" title="Debe tener minimamente 8 caracteres" required>
                                            </div>
                                            <input type="checkbox" onchange="document.getElementById('contrasena1').type = this.checked ? 'text' : 'password',document.getElementById('contrasena2').type = this.checked ? 'text' : 'password'" > Ver contraseña
                                        </div>
                                        <br>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreL" id="nombreL" placeholder="Nombre largo" pattern=".{3,}" title="Minimo 3 caracteres" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreC" id="nombreC" placeholder="Nombre corto" pattern=".{3,}" title="Minimo 3 caracteres" required>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                              <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-envelope"></span>
                                                </span>
                                                <input class="form-control" type="email" name="correo" id="correo" placeholder="Correo" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"  title="Ingrese un correo correcto Ejm: admin@hotmail.com ,admin@yahoo.com, admin@gmail.com" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-earphone"></span>
                                                </span>
                                                <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Telefono" title="Ejemplo: 4022371, 71759599, 6789000" pattern="^(([4][0-9]{6})|([7|6][0-9]{7}))$" required>
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
                                

                                        
                                        <button type="submit" class="btn btn-primary" onclick="this.form.action='../Modelo/BD/ProcesarRegistroGrupoE.php'" > <span class="glyphicon glyphicon-ok"></span> Registrarme</button>

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
