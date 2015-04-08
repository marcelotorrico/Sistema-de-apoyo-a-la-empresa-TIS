<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
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
    <link href="../Librerias/css/bootstrap-dialog.css" rel="stylesheet">


    <!-- SB Admin CSS - Include with every page -->
    <link href="../Librerias/css/sb-admin.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../Librerias/css/jquery-te-1.4.0.css">
    
    <script src="../Librerias/js/jquery-1.10.2.js"></script>
   
    <script src="../Librerias/js/jquery-2.1.0.min.js"></script>
    <!--script src="../Librerias/js/jquery-ui.js"></script-->
    <script src="../Librerias/js/bootstrap-dialog.js"></script>
    
    <script>
        $(document).ready(function(){
            
            $('#btn-LoginUser').click(function(){
                               
                if($("form")[0].checkValidity()) 
                {
                    var url = "ProcesarLoginUsuario.php"

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: $('#FormularioRegistroUsuario').serialize(),

                        success: function(data){

                            $('#panelResultado').html(data)

                        }
                    });

                        return false;
                }
       
            });      
        });
    </script>
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
           
<!--form id = "ordenc" method = "post" action="" role="form" enctype="multipart/data-form" onsubmit="return validarCampos(ordenc)"-->
        <div class ="form-horizontal">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Registrar Usuario:</h2>
                    <div class="col-lg-6" >
                                    <form method = "post" id="FormularioRegistroUsuario">
                                        
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </span>
                                                <input class="form-control" type="text" name="nombreUsuario" id="UserName" placeholder="Nombre de Usuario" required>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-lock"></span>
                                                </span>
                                                <input class="form-control" type="password" name="password" id="UserPassword" placeholder="Contraseña" required>
                                            </div>
                                        </div>
                                        
                                     
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-primary" id="btn-LoginUser"> <span class="glyphicon glyphicon-ok"></span> Ingresar</button>
                                        </div>
                                    </form>              
                            <div id="panelResultado">
                                
                            </div>        
                        </div>
                </div>
            </div><!-- /.row -->                   
    <script src="../Librerias/js/bootstrap.min.js"></script>
    <script src="../Librerias/js/plugins/metisMenu/jquery.metisMenu.js"></script>


    <!-- SB Admin Scripts - Include with every page -->
    <script src="../Librerias/js/sb-admin.js"></script>
  
    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="../Librerias/js/demo/dashboard-demo.js"></script>
    <!-- Combo Box scripts -->

    
 
</body>

</html>
