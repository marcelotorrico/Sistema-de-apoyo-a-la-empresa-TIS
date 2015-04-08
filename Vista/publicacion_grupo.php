<?php


 include '../Modelo/conexion.php';
 session_start();
 $uActivo = $_SESSION['usuario'];
 $conexion = new conexion();
 

?>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Apoyo a la Empresa TIS</title>

    <!-- JQuery -->
    <script type="text/javascript" src="../Librerias/lib/jquery-2.1.0.min.js"></script>
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
    <script type="text/javascript" src="../Librerias/lib/validator/integerN.js"></script>
    <script type="text/javascript" src="../Librerias/lib/validator/porcentajeAc.js"></script>
    <!-- JS -->
    <script type="text/javascript" src="../Librerias/lib/funcion.js"></script>
    



    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="../Librerias/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="../Librerias/css/plugins/timeline/timeline.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="../Librerias/css/sb-admin.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
   <link href="css/estiloTabla.css" rel="stylesheet" type="text/css" />
   
<div id="wrapper">
       <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                   <a class="navbar-brand" href="inicio_grupo_empresa.php">Inicio </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li>
                    <a href="lista-de-noticias-grupo.php"><i class="glyphicon glyphicon-comment"></i> Foro</a>
                </li>

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $uActivo.' '; ?><i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="ModificarGrupoEmpresa.php"><i class="fa fa-user fa-fw"></i> Modificar Datos personales</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="unlog.php"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            
            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-files-o "></i> Documentos <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li>
                                    <a href="#" >Subir Documentos <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                    <?php
                                    
                                        $docsReq = $conexion->consulta("SELECT NOMBRE_R FROM registro, documento_r, inscripcion, inscripcion_proyecto WHERE inscripcion_proyecto.CODIGO_P = documento_r.CODIGO_P AND documento_r.ID_R = registro.ID_R AND inscripcion_proyecto.NOMBRE_U = '$uActivo' AND inscripcion.NOMBRE_UGE = inscripcion_proyecto.NOMBRE_U");
                                     
                                        while ($rowDocs = mysql_fetch_row($docsReq))
                                        {
                                            
                                            echo '<li>
                                                  <a href="SubirDocumento.php?doc='.$rowDocs[0].'">'.$rowDocs[0].'</a>
                                                   </li>';  
                                            
                                        }
                                        
                                    ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="publicacion_grupo.php">Recepci&oacute;n Documentos </a>
                                    
                                </li>
                               
                            </ul>
                            
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                             
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Tareas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li>
                                     <a href="AnadirSocio.php">Añadir socios</a>
                                </li>
                                 <li>
                                    <a href="AnadirRL.php">Seleccionar Representante legal</a>
                                </li>
                                <li>
                                    <a href="seleccionar_asesor.php">Seleccionar Asesor</a>
                                </li>
                                
                                 <li>
                                     <a href="InscripcionGEProyecto.php">Inscribirse a proyecto</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="historia_actividades.php"><i class="glyphicon glyphicon-calendar"></i> Historia de actividades</a>
                        </li>
                        <li>
                            <a id="registrarPlanificacion" href="#">
                                <i class="fa fa-pencil-square-o fa-fw"></i>Registrar Planificaci&oacute;n
                            </a>
                        </li>        
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            
               
            <!-- /.navbar-static-side -->
        </nav>  
        <div id="page-wrapper">

            
                     <h2 class="page-header">Documentos recibidos</h2>
                    <div class="panel panel-default" >

              
                        
                         

                             
                            <table class="table form-group" >
                                 
                                                     <tr bgcolor="#888888">
                                                          <th> Nº</th>
                                                          <th >Nombre<th>
                                                          <th >Descripcion</th>  
                                                          <th></th>
                                                          
                                                     </tr> 

 
                                <?php
                                   //gestion**
                                     $selDoc=$conexion->consulta("SELECT DISTINCT `NOMBRE_R`,`RUTA_D`,`DESCRIPCION_D`,`fecha_p` ,`hora_p`,`RECEPTOR_R`,r.`NOMBRE_U` FROM `registro` AS r,`documento` AS d,`descripcion` AS e,`periodo` AS p,`receptor` AS w, `inscripcion_proyecto` AS i, `proyecto` AS a, `gestion` AS g WHERE r.`ID_R` = d.`ID_R` AND r.`ID_R` = e.`ID_R` AND r.`ID_R` = p.`ID_R` AND r.`ID_R` = w.`ID_R` AND r.`TIPO_T` LIKE 'publicaciones' and i.`CODIGO_P` = a.`CODIGO_P` and a.`ID_G` = g.`ID_G` and (DATE (p.`fecha_p`) >= DATE(FECHA_INICIO_G) and DATE(p.`fecha_p`) <= DATE(FECHA_FIN_G))");
                                     
                                   
                                    if(mysql_num_rows($selDoc) != 0)
                                    {    $i=1;
                                           while($docPubli = mysql_fetch_array($selDoc))
                                          {
                                            $auxDoc=$docPubli['2'];
                                            $docDest=$docPubli[5];
           
                                            $selNom=$conexion->consulta("SELECT `NOMBRE_LARGO_GE` FROM `grupo_empresa` WHERE `NOMBRE_U`='$uActivo'");
                                            $nomLargo = mysql_fetch_array($selNom);
                                           
                                            if($docDest==$nomLargo[0] || $docDest=="PUBLICO")
                                            {
                                                $docUbi= $docPubli[1];
                                                
                                                $fepDoc=$docPubli[3];
                                                $hopDoc=$docPubli[4];
                                                $fechaA       = date('Y-m-d');
                                                $horaA        =  date("G:H:i");
                                           
                                                if($fechaA >= $fepDoc )
                                                {     
                                                    if($horaA >= $hopDoc || $horaA <= $hopDoc){
                                                        

                                                        if(!empty($docUbi))
                                                        {
                                              
                                                        ?>

                                                            <tr> 
                                                          <td><?php echo $i?></td> 
                                                          <td><a class="link-dos" target="_blank" href="<?php echo $docPubli[1] ?>"><?php echo $docPubli[0]?></a><td>

                                                          <td><?php echo $docPubli[2]?></td> 
                                                          <td> </td>
                                                         
                                                         </tr>


                                                        <?php
                                                    }

                                              }
                                              $i++;  
                                             }
                                           else{}
                                                
                                          }

                                        if($docDest=="Todas las Grupo Empresas")
                                        {
                                            $estaIns=$conexion->consulta("SELECT `NOMBRE_UA` FROM `inscripcion` WHERE `NOMBRE_UGE`='$uActivo'");
                                            $nomAseso=mysql_fetch_array($estaIns);
                                            if($nomAseso[0]==$docPubli[6])
                                            {
                                                $docUbi= $docPubli[1];
                                                
                                                $fepDoc=$docPubli[3];
                                                $hopDoc=$docPubli[4];
                                                $fechaA       = date('Y-m-d');
                                                $horaA        =  date("G:H:i");

                                                if($fechaA >= $fepDoc )
                                                {     
                                                    if($horaA >= $hopDoc || $horaA <= $hopDoc)
                                                    {
                                                         if(!empty($docUbi))
                                                        {
                                            
                                                        ?>
                                                         <tr> 
                                                          <td><?php echo $i?></td> 
                                                          <td><a class="link-dos" target="_blank" href="<?php echo $docPubli[1] ?>"><?php echo $docPubli[0]?></a><td>

                                                          <td><?php echo $docPubli[2]?></td> 
                                                          <td> </td>
                                                         
                                                         </tr>


                                                        <?php
                                                     }
                                                      $i++;  
                                                 }
                                               }

                                          }
                                    
                                       }
                                       else{}


                                         if($docDest=="Todos los Proyectos")
                                        {
                                            $estaInsP=$conexion->consulta("SELECT `CODIGO_P` FROM `inscripcion_proyecto` WHERE `NOMBRE_U`='$uActivo'");
                                            $enProyec=mysql_num_rows($estaInsP);
                                            if($enProyec>0)
                                            {
                                                $docUbi= $docPubli[1];
                                                
                                                $fepDoc=$docPubli[3];
                                                $hopDoc=$docPubli[4];
                                                $fechaA       = date('Y-m-d');
                                                $horaA        =  date("G:H:i");

                                                if($fechaA >= $fepDoc )
                                                {     
                                                    if($horaA >= $hopDoc || $horaA <= $hopDoc)
                                                    {
                                                        if(!empty($docUbi))
                                                        {
                                            
                                                        ?>
                                                            <tr> 
                                                            <td><?php echo $i?></td> 
                                                            <td><a class="link-dos" target="_blank" href="<?php echo $docPubli[1] ?>"><?php echo $docPubli[0]?></a><td>

                                                          <td><?php echo $docPubli[2]?></td> 
                                                          <td> </td>
                                                         
                                                     </tr>



                                                        <?php
                                                     }
                                                      $i++;  
                                                   }  
                                               }

                                          }
                                    
                                       }
                                       else{}

                                        $desProy=$conexion->consulta("SELECT DISTINCT `NOMBRE_U`FROM `proyecto` AS p,`inscripcion_proyecto` AS i WHERE p.`CODIGO_P` = i.`CODIGO_P` AND  p.`Nombre_P` LIKE '$docDest' ");
                                        $tamProy=mysql_num_rows($desProy);
                                         $nombreP=mysql_fetch_array($desProy);
                                        if($tamProy>0)
                                        {

                                            if($nombreP[0]==$uActivo)
                                            {
                                                    $docUbi= $docPubli[1];
                                                
                                                $fepDoc=$docPubli[3];
                                                $hopDoc=$docPubli[4];
                                                $fechaA       = date('Y-m-d');
                                                $horaA        =  date("G:H:i");

                                                  if($fechaA >= $fepDoc )
                                                {     
                                                    if($horaA >= $hopDoc || $horaA <= $hopDoc)
                                                    {
                                                        if(!empty($docUbi))
                                                        {

                                                    ?>
                                                     <tr> 
                                                          <td><?php echo $i?></td> 
                                                          <td><a class="link-dos" target="_blank" href="<?php echo $docPubli[1] ?>"><?php echo $docPubli[0]?></a><td>

                                                          <td><?php echo $docPubli[2]?></td> 
                                                          <td> </td>
                                                         
                                                     </tr>


                                                    <?php
                                                     }
                                                   $i++;  
                                                }   



                                            }
                                        }



                                      }
									  else{}
                                       ?>
                                      
                                      
                                       <?php
                                            //echo "</form>";
                                    //$tabla.="</table>";
                                     //echo $tabla;
                                       }
									   ?>
									    </table>
										<?php
									}
                                    else
                                    {
                                        echo  "<b>NO SE ENCONTRO DOCUMENTOS</b><br><br>";
                                    }
                                     
                                   
                                    
                                
                                
                                $conexion->cerrarConexion();
                                
                                

                                ?>
              
                    </div>           
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    
    <!--script src="../Librerias/js/bootstrap.min.js"></script-->
    <script src="../Librerias/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../Librerias/js/sb-admin.js"></script>

</body>

</html><!DOCTYPE html>









