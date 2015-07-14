<?php
session_start();
$uActivo = $_SESSION['usuario'];
include '../Modelo/conexionPDO.php';

require '../Controlador/ValidadorInicioSesion.php';

$verificar = new ValidadorInicioSesion();
$verificar->validarInicioSesion($uActivo, "asesor");

$conectar = new Conexion();
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Apoyo a la Empresa TIS</title>



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

        <script type="text/javascript" src="../Librerias/lib/funcion.js"></script>
        <style>
            .modal {
                display: inherit;
            }
            .fade{
                opacity: 1;
            }
            .modal.fade .modal-dialog{
                transform: translate(0,0%);
            }
            .modal-lg{
                width: 1160px;
            }
            .sub-tareas{
                width: 75%;
            }
            .sub-tareas tr{
                width: 100%;
            }
        </style>


    </head>


    <body>
        <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="lista_evaluacion.php" type="submit" class="close" aria-hidden="true">&times;</a>
                        <h5 class="modal-title">Evaluacion</h5>
                        <h4 class="modal-title">Evaluacion Grupo Empresa</h4>
                    </div>
                    <div class="modal-body">

                        <div class="bs-callout bs-callout-info">
                            <h4>Nota</h4>
                            <p>
                                El valor de la calificacion es evaluada por 100 pts...
                            </p>
                        </div>
                        <?php
                        $Nota = 0;
                        $ID = $_GET['GE'];

                        $peticion = $conectar->query("SELECT g_e.nombre_corto_ge , nombre_r , g_e.nombre_u FROM grupo_empresa g_e, registro r WHERE r.id_r='$ID' and g_e.nombre_u=r.nombre_u");
                        $datos = $peticion->fetch(PDO::FETCH_NUM);
                        $NombreCorto = $datos[0];
                        $Actividad = $datos[1];
                        $usuarioGE = $datos[2];

                        $peticion2 = $conectar->query("select MAX(ID_R)  from registro where `NOMBRE_R`= '$Actividad' and `NOMBRE_U`='$usuarioGE'");
                        $IDPago = $peticion2->fetchColumn();

                        $peticion4 = $conectar->consultarTabla("SELECT `ENTREGABLE_P`,DESCRIPCION_E FROM `entrega`, entregable WHERE `ID_R`='$IDPago' and entregable.ENTREGABLE_E= entrega.ENTREGABLE_P and `NOMBRE_U`='$usuarioGE'");
                        $tamano = count($peticion4);
                        for ($i = 0; $i < $tamano; $i++) {
                            $Entregable[$i] = $peticion4[$i][0];
                            $Descripcion[$i] = $peticion4[$i][1];
                        }
                        $peticion6 = $conectar->query("SELECT `PORCENTAJE_DEL_TOTAL_P` FROM `pago` WHERE `ID_R`='$IDPago'");
                        $Puntaje = $peticion6->fetchColumn();


                         $_SESSION["ID"] = $ID;
                          $_SESSION["NombreCorto"] = $NombreCorto;
                          $_SESSION["Actividad"] = $Actividad;
                          $_SESSION["usuarioGE"] = $usuarioGE;
                          $_SESSION["IDPago"] = $IDPago;
                          $_SESSION["Puntaje"] = $Puntaje;
                          $_SESSION["tamano"] = $tamano;
                        ?>
                        <table class="table table-hover" id="tablaEntregables">
                            <thead>
                                <tr>
                                    <th>Grupo Empresa</th>
                                    <th>Actividad</th>
                                    <th>Entregable</th>
                                    <th>Descripcion</th>
                                    <th>Nota</th>
                                    <th>Tareas</th>
                                </tr>

                                <?php for ($i = 0; $i < $tamano; $i++) {
                                    ?>
                                    <tr>
                                        <th><?php echo $NombreCorto ?></th>
                                        <th><?php echo $Actividad ?></th>    
                                        <th><?php echo $Entregable[$i] ?></th>
                                        <th><?php echo $Descripcion[$i] ?></th>
                                        <th><input type="number" min="0" max="100" name="nota<?php echo $i ?>" id="nota<?php echo $i ?>" readonly></th>
                                        <th>
                                            <button class="btn btn-primary agregarTareas" value="<?php echo $i ?>" onclick="agregarFila(<?php echo $i ?>);"><span class="glyphicon glyphicon-plus"></span> Agregar</button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <table class="table table-bordered table-responsive table-highlight sub-tareas" id="tabla_<?php echo $i ?>" style="display: none;">
                                                <thead>
                                                    <tr>
                                                        <th>Tarea</th>
                                                        <th>Nota</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </thead> 
                        </table> 
                    </div><br>
                    <div class="modal-footer">
                        <button type="submit" id="boton01" class="btn btn-primary" onclick="mostrarResultado(<?php echo $tamano ?>);">Aceptar</button>
                    </div>     
                </div>
            </div>
        </div>
    </body>   

</html>             

