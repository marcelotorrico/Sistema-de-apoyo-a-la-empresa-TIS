<!DOCTYPE html>
<?php 
 
    include 'Modelo/conexion.php';
    $conectar = new conexion();
?>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Apoyo a la Empresa TIS</title>

    <!-- Core CSS - Include with every page -->
    <link href="Librerias/css/bootstrap.min.css" rel="stylesheet">
    <link href="Librerias/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="Librerias/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="Librerias/css/plugins/timeline/timeline.css" rel="stylesheet">
   

    <!-- SB Admin CSS - Include with every page -->
    <link href="Librerias/css/sb-admin.css" rel="stylesheet">
    
    
    
        	<link href="Librerias/css/style11.css" rel="stylesheet" type="text/css" />
		<link href="Librerias/css/tabla-div.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="Librerias/css/coin-slider.css" />
                <link href="archivos/estilos.css" rel="stylesheet" type="text/css">
                <script language="JavaScript" src="archivos/script.js" type="text/javascript"></script>

</head>

<body>

   
    <div id="wrapper">
       
        
		<!--<h2>design by <a href="#" title="flash templates">flash-templates-today.com</a></h2>-->
        
	
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                               <h2 ><IMG SRC="images/umss.png"><font color='white'> <strong>UNIVERSIDAD MAYOR DE SAN SIMON &nbsp;&nbsp;&nbsp;</strong></h2>
            </div>
            <!-- /.navbar-header -->

        </nav>
                <br><br><br><br>
           <div class="sidebar-collapse" >      
           <div class="col-lg-12" >
      
    
		
	    <div class="content">
	    <div class="content_resize">
	    <div class="mainbar">
            <nav class="star" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
            <a class="navbar-brand">Avisos Empresa TIS</a>
                
            </div></nav><h2 class="star"><span>&nbsp; </span></h2>
                                           
              
            <?php                                  

                   $valor='0';
                   $peticion11 = $conectar->consulta("select count(*) from receptor where RECEPTOR_R='PUBLICO'"); 
                   while($fila = mysql_fetch_array($peticion11))
                   $valor= $fila["count(*)"] ;                         
                   $row_Recordset1='Descargar';
                   if($valor<'4'){ $valor='4'; }
              
            ?>                                        
                                            
                                         
   <table width="70%" border="0" cellpadding="4" cellspacing="0" class="fondo_central " align="center">

    <tr><td height="10"></td></tr>
    
    <script language="JavaScript" type="text/javascript">
            <!--

            var nume= <?php echo $valor; ?>   
            setTamAviso( 130 );
            setNumAvisos( nume );
            timerID = setTimeout("moverAvisos()", 1000);         
            -->
    </script>
    <tr><td>
        <table width="100%" cellpadding="0" cellspacing="0"><tr>
        <td style="width: 97%" onmouseover="normal()">
        <div style="position:relative; overflow:hidden; width:100%; height:390px;">


        <?php
        $numero='0';
        $peticion = $conectar->consulta("SELECT registro.NOMBRE_U,registro.NOMBRE_R,registro.FECHA_R,registro.HORA_R, asesor.NOMBRES_A, asesor.APELLIDOS_A , documento.RUTA_D, descripcion.DESCRIPCION_D FROM registro , asesor , documento , receptor , descripcion WHERE registro.NOMBRE_U=asesor.NOMBRE_U and  `TIPO_T`='publicaciones' and documento.ID_R=registro.ID_R and descripcion.ID_R=registro.ID_R and receptor.ID_R=registro.ID_R and RECEPTOR_R='PUBLICO'");                                                            
        while($fila = mysql_fetch_array($peticion))
        {  
            ?>       

            <div class="caja_aviso" id="aviso<?php echo $numero ?>" style="position:absolute; height:130px; top:0px; width:95%; left:2.5%;">
            <div class="subtitulo_aviso" ><strong>Docente: </strong> <?php echo $fila['NOMBRES_A']; ?>&nbsp;&nbsp;<?php echo $fila['APELLIDOS_A']; ?>
            &nbsp;&nbsp;&nbsp;<strong> </strong> </div>                           
            <div  class="titulo_aviso">
            <?php echo $fila['NOMBRE_R']; ?>
            </div>    
            <div class="letra_aviso" >
            <?php echo $fila['DESCRIPCION_D']; ?>&nbsp;&nbsp;&nbsp;


            <?php  
            $tamano=$fila['RUTA_D'];
            if(empty($tamano)==false)
            {
            echo "<a href='".$fila['RUTA_D']."' target='_blank'><font color='blue'>".$row_Recordset1."</a>";
            }
            ?>

            </div>
            <div class="pie_aviso">Publicado el   <?php       echo $fila['FECHA_R']; ?>  &nbsp;&nbsp; Hora:<?php       echo $fila['HORA_R']; ?> </div>
            </div>         
            <?php  $numero++;	

        }

        ?>       

        </div>
        </td>

        <td style="width: 3%">
        <table style="height: 390px" border="0" cellpadding="0" cellspacing="0">
        <tr style="height: 20%"><td><img id="masarriba" alt="Arriba Rapido" src="imagenes/masarriba.jpg" style="opacity:0.3; filter:alpha(opacity=29);" onmouseover="control_aviso('masarriba')" onmousedown="control_aviso('masarriba')" onmouseout="control_salir_aviso('masarriba')" /></td></tr>
        <tr style="height: 20%"><td><img id="arriba" alt="Arriba" src="imagenes/arriba.jpg" style="opacity:0.3; filter:alpha(opacity=29)" onmouseover="control_aviso('arriba')" onmousedown="control_aviso('arriba')" onmouseout="control_salir_aviso('arriba')" /></td></tr>
        <tr style="height: 20%"><td><img id="alto" alt="Detener" src="imagenes/alto.jpg" style="opacity:0.3; filter:alpha(opacity=29)" onmouseover="control_aviso('alto')" onmousedown="control_aviso('alto')" onmouseout="control_salir_aviso('alto')" /></td></tr>
        <tr style="height: 20%"><td><img id="abajo" alt="Abajo" src="imagenes/abajo.jpg" style="opacity:0.3; filter:alpha(opacity=29)" onmouseover="control_aviso('abajo')" onmousedown="control_aviso('abajo')" onmouseout="control_salir_aviso('abajo')" /></td></tr>
        <tr style="height: 20%"><td><img id="masabajo" alt="Abajo Rapido" src="imagenes/masabajo.jpg" style="opacity:0.3; filter:alpha(opacity=29)" onmouseover="control_aviso('masabajo')" onmousedown="control_aviso('masabajo')" onmouseout="control_salir_aviso('masabajo')" /></td></tr>
        </table></table></table>

        <div class="article">

        <nav class="star" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
        <a class="navbar-brand">Registrate como Grupo Empresa</a>

        </div></nav><h2 class="star"><span>&nbsp; </span></h2>                                                   

        <p class="infopost"></p>


        <div class="form-group">
        <div align="center">
        <button type="submit" name="ingresar"  class="btn btn-primary"  onclick=" location.href='Vista/RegistrarGrupoEmpresa.php' " id="btn-registrarUser"> <span class="glyphicon glyphicon-ok" ></span> REGISTRATE</button>
        </div></div>
        </div>     
        </div>


        <form method="post" action="Vista/login.php">
        <div class="sidebar">



        <nav class="star" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
        <a class="navbar-brand">Ingresar al Sistema</a>

        </div></nav><h2 class="star"><span>&nbsp; </span></h2>                                                   




        <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon">
        <span class="glyphicon glyphicon-user"></span>
        </span>
        <input class="form-control" type="text" name="usuario" id="UserName" placeholder="Nombre de Usuario"   required>
        </div>
        </div>
        <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon">
        <span class="glyphicon glyphicon-lock"></span>
        </span>
        <input class="form-control" type="password" name="contrasena" id="UserPassword" placeholder="Contraseña" minlength="5"   required>
        </div>
        </div>                                                  

        <div class="form-group">
        <a href="Vista/RegistrarUsuario.php"><font color='green' size="1.5%">no eres usuario todavia? REGISTRATE</font></a>
        <div align="right"> <hr>
        <button type="submit" name="ingresar" class="btn btn-primary" id="btn-registrarUser"> <span class="glyphicon glyphicon-ok"></span> Ingresar</button>
        </div></div>



        <br>


        <div class="gadget">
        <nav class="star" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
        <a class="navbar-brand">Paginas Universitarias</a>

        </div></nav><h2 class="star"><span>&nbsp; </span></h2>                                    



        <div class="clr"></div>
        <ul class="ex_menu">

        <div class="contenedor-tabla">
        <div class="contenedor-fila">
        <div class="contenedor-columna2"><img src="images/logo-websiss.jpg" width="29" height="29" alt="" longdesc=\/></div>
        <div class="contenedor-columna3"><li><a href="http://websis.umss.edu.bo/">webSISS Sistema de Información San Simón</a><br/> 
        webSISS UMSS</li></div>
        </div>
        </div>

        <div class="contenedor-tabla">
        <div class="contenedor-fila">
        <div class="contenedor-columna2"><img src="images/logo-cs.bmp" width="29" height="29" alt="" longdesc=\/></div>
        <div class="contenedor-columna3"><li><a href="http://www.cs.umss.edu.bo/">Carreras de Informática y Sistemas UMSS</a><br/>
        Pagina principal de la CS</li>
        </div>
        </div>
        </div>

        <div class="contenedor-tabla">
        <div class="contenedor-fila">
        <div class="contenedor-columna2"><img src="images/logo-fcyt.gif" width="29" height="29" alt="" longdesc=\/></div>
        <div class="contenedor-columna3"><li><a href="http://www.fcyt.umss.edu.bo/">Facultad de Ciencias y Tecnologia</a><br/>
        Pagina principal de la FCYT</li>
        </div>
        </div>
        </div>

        <div class="contenedor-tabla">
        <div class="contenedor-fila">
        <div class="contenedor-columna2"><img src="images/userpic.gif" width="29" height="29" alt="" longdesc=\/></div>
        <div class="contenedor-columna3"><li><a href="http://enlinea.umss.edu.bo/moodle2/">MOODLE 2 - UMSS</a><br/>
        Pagina de moodle2</li>
        </div>
        </div>
        </div>
        </div>	
        <div class="gadget">
        <nav class="star" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
        <a class="navbar-brand">Verificar Nombre G.E.</a>

        </div></nav><h2 class="star"><span>&nbsp; </span></h2>                                       

        <div class="clr"></div>
        <ul class="ex_menu">

        <div class="contenedor-tabla">
        <div class="contenedor-fila">

        <div class="contenedor-columna3"><li><a href="Vista/verificar_nombre.php">Verificar Nombre Grupo Empresa</a><br/> 
        Verificar Nombre de Grupo Empresa Disponible</li></div>
        </div>
        </div>

        </div>	

        </div>
        </form>               

        </div>
        <div class="clr"></div>
        <div class="fbg">

        </div>	
        <br><br>
        <div class="footer">
        <div class="footer_resize">
        <p class="lf"></p>
        <div style="clear:both;"></div>
        </div>
        </div>
        <div align=center>
        <font color='black'>Esta pagina desarrollada por  <a class="registrar" href=''>Bittle.S.R.L.</a>
        </div>


        </div>


        </div>
        </div>


    </div>

    <script src="Librerias/js/jquery-1.10.2.js"></script>
    <script src="Librerias/js/bootstrap.min.js"></script>
    <script src="Librerias/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="Librerias/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="Librerias/js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="Librerias/js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="Librerias/js/demo/dashboard-demo.js"></script>

</body>

</html>
