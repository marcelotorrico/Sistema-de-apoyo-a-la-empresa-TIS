 <?php  
    session_start();
    $uActivo = $_SESSION['usuario'];
    include '../Modelo/conexion.php';
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
                                     <a href="add_roles.php">Añadir  Roles</a>
                                </li>
                                <li>
                                     <a href="add_gestion.php">Añadir  Gestion</a>
                                </li>
                                 <li>
                                    <a href="lista_roles.php">Asignar Permisos Roles</a>
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
                                            <div class="article"><br>
                                                       <div class="row">
                                                           <div class="col-lg-12"></div>
                                                
					<h2><span>Asignar Permisos</span></h2>	
							
						</div>
                                            
                                            
                                                         
                                            
							<?php
							
							?>			
								<div id="contenido">
			
								<form action="crear_permisos.php" method="post">
									<center>
										<table border=0 width=80%>
											<tr>
												<td >
													<p style="text-align:right;">Rol :</p>
												</td>
												<td>
												<select required name="id_rol" class="form-control"><option  value="" >Seleccione Rol</option>
													<?php 
														
														$sql=$conectar->consulta("SELECT * FROM rol"); 
														
															while($row=mysql_fetch_array($sql)) 
																echo "<option  value='".$row["ROL_R"]."'>".$row["ROL_R"]."</option>"; 
													?>
												</td>
												<td >
													<p style="text-align:right;">Menu :</p>
												</td>
												<td>
												<select required name="id_menu" class="form-control"><option  value="" >Seleccione Menu</option>
													<?php 
														
														$sql=$conectar->consulta("SELECT * FROM menu"); 
														
															while($row=mysql_fetch_array($sql)) 
																echo "<option  value='".$row["id_menu"]."'>" 
																 .$row["nom_menu"]."</option>"; 
													?>
												</td>
												<td>    
                                                                                                     &nbsp;&nbsp;   <button type="submit" name="submit" class="btn btn-primary" id="btn-registrarUser"> <span class="glyphicon glyphicon-ok"></span>&nbsp; Registrar</button>
													
												</td>
											</tr>
										</table>
									</center>	

								</form>
							</div>
							<h2><span>Listado de Menus</span></h2>
							<div class="contenedor-fila2">
								<div class="contenedor-columna">
									<?php
										echo"Id Permiso";
									?>
								</div>
										
								<div class="contenedor-columna">
									<?php
										echo "Rol";
									?>
								</div>
		
								<div class="contenedor-columna">
									<?php
										echo "Permisos";
									?>
								</div>
							</div>
							<?php
								//crear conexion---------------------------
		
								//Peticion
								$peticion = $conectar->consulta("SELECT p.id_permiso,m.nom_menu, r.ROL_R FROM menu as m,rol as r, permisos as p where p.menu_id_menu=m.id_menu and r.ROL_R=p.ROL_R 
														");

								while($fila = mysql_fetch_array($peticion))
								{
							?>
								<div class="contenedor-fila">
									<div class="contenedor-columna">
										<?php
											echo $fila['id_permiso'];
										?>
									</div>
									
									<div class="contenedor-columna">
										<?php
											echo $fila['ROL_R'];
										?>
									</div>
			
									<div class="contenedor-columna">
										<?php
											echo $fila['nom_menu'];
										?>
									</div>
									
									<div class="contenedor-columna">
										<?php
											echo "<a href ='eliminar_permisos.php?id_us=".$fila['id_permiso']."'><font color='blue'>Eliminar</font></a>";
										?>
									</div>
									
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
