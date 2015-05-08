<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Apoyo a la Empresa TIS</title>
   
    <link rel="stylesheet" type="text/css" href="../Librerias/lib/css/docs.css">

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
    <form method = "post" id="FormularioRegistroUsuario" action="../Modelo/BD/ProcesarRegistroUsuario.php" role="form" enctype="multipart/data-form" onsubmit="return validar(FormularioRegistroUsuario)">
                                  
        <div class ="form-horizontal">
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="bs-callout bs-callout-danger">
                   
                     <p>
                         <strong>Nota: </strong> Servicio de Correro valido  <strong>hotmail, gmail, yahoo.</strong>
                      </p>
                    </div> 
                 
                    <h2 class="page-header">Registrar Usuario:</h2>
                    

                    <div class="col-lg-6" >
                                         
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreUsuario" id="UserName" placeholder="Nombre de Usuario" pattern="^[a-zA-Zñ0-9_\\_\ü]{3,16}$" title="Minimo 3 caracteres y Maximo 16.Ejm: _Fernando_, Rolando2" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-lock"></span>
                                                </span>
                                                <input class="form-control" type="password" name="password" id="contrasena1" placeholder="Contraseña" minlength="8" pattern=".{8,}" title="Ingrese una contraseña segura, debe tener como minimo 8 caracteres" required>
                                            </div>
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
                                                <input class="form-control" type="text" name="nombreReal" id="RealName" placeholder="Nombre" pattern="[a-zA-ZÑñáéíóú]{2,30}" title="El nombre debe ser mayor a 2 caracteres y menor a 30 Ejm: Daniel Marcelo, Rolando" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="apellido" id="LastName" placeholder="Apellido" pattern="[a-zA-ZÑñáéíóú]{2,30}" title="El apellido debe ser mayor a 2 caracteres y menor a 30  Ejm: Santivañez, Suarez" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-earphone"></span>
                                                </span>
                                                <input class="form-control" type="text" name="telefono" id="UserPhone" placeholder="Telefono" title="Ejemplo: 4022371 o 71759599" pattern="^[4|7|6][0-9]{6,7}$" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-envelope"></span>
                                                </span>
                                                <input class="form-control" type="email" name="email" id="UserEmail" placeholder="Correo" pattern="^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" title="Ejm: admin@hotmail.com" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-th-list"></span>
                                                </span>
                                                <select class="form-control" id="UserRol" name="UsuarioRol" required> 
                                                   
                                                <?php
                                                    $i=0;
                                                    include '../Modelo/conexion.php';
        
                                                    $conect = new conexion();
                                                    $ResRoles = $conect->consulta("SELECT * FROM `rol` WHERE ROL_R != 'administrador' and  ROL_R != 'grupoEmpresa' ");
                                                  
                                                    while($row = mysql_fetch_row($ResRoles))
                                                    {
                                                        $roles[] = $row;
                                                        echo '<option>'.$roles[$i][0].'</option>';
                                                        $i++;
                                                    }
                                                ?>
                                                 </select> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-primary" id="btn-registrarUser"> <span class="glyphicon glyphicon-ok"></span> Registrarme</button>
                                        </div>
                                               
                            <div id="panelResultado">
                                
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
