<?php
require_once '../Modelo/Model/Planificacion.php';
require_once '../Modelo/Model/Entregable.php';
require_once '../Modelo/Model/Registro.php';
require_once '../Modelo/Model/Precio.php';
require_once '../Modelo/Model/FechaRealizacion.php';
require_once '../Modelo/conexionPDO.php';
session_start();

$uActivo = $_SESSION['usuario'];

require '../Controlador/ValidadorInicioSesion.php';

$verificar = new ValidadorInicioSesion();
$verificar->validarInicioSesion($uActivo, "grupoEmpresa");

$con = new Conexion();
$Ver_Usr = $con->query("SELECT NOMBRE_U FROM usuario WHERE NOMBRE_U = '$uActivo' ");
$Ver_Usr2 = $Ver_Usr->fetch(PDO::FETCH_NUM);

$usuario = $uActivo;

if (!is_array($Ver_Usr2)) {
    $Cons_GE = "SELECT `NOMBRE_U` FROM socio WHERE `NOMBRES_S` = '$uActivo'";
    $Cons_GE2 = $con->query($Cons_GE);
    $Nom_User = $Cons_GE2->fetch(PDO::FETCH_NUM);
    $usuario = $Nom_User[0];
}

$Verif_In = $con->query("SELECT NOMBRE_UA FROM inscripcion, inscripcion_proyecto WHERE NOMBRE_UGE = '$uActivo' and NOMBRE_U = '$uActivo'");
$Inscrip = $Verif_In->fetch(PDO::FETCH_NUM);
$Sel_NL = $con->query("SELECT NOMBRE_LARGO_GE FROM grupo_empresa WHERE NOMBRE_U='$uActivo'");
$NombreL = $Sel_NL->fetch(PDO::FETCH_NUM);
$Sel_NC = $con->query("SELECT NOMBRE_CORTO_GE FROM grupo_empresa WHERE NOMBRE_U='$uActivo'");
$NombreC = $Sel_NC->fetch(PDO::FETCH_NUM);
$Grupo_NC = 'Notificacion de Conformidad de ' . $NombreC[0] . '';
$Sel_NC = $con->query("SELECT * FROM registro,receptor WHERE NOMBRE_U='$Inscrip[0]' AND NOMBRE_R='$Grupo_NC' AND registro.ID_R = receptor.ID_R");
$NC = $Sel_NC->rowCount();
$Grupo_OC = 'Orden de Cambio de ' . $NombreC[0] . '';
$Sel_OC = $con->query("SELECT * FROM registro,receptor WHERE NOMBRE_U='$Inscrip[0]' AND NOMBRE_R='$Grupo_OC' AND registro.ID_R = receptor.ID_R");
$OC = $Sel_OC->rowCount();
if (is_array($Inscrip)) {
    if ($NC >= 1 or $OC >= 1) {
        $Planif = new Planificacion($usuario);
        $estado = $Planif->getEstado();
        $posiblesEstados = ['registrar planificacion', 'registrar entregables', 'registrar costo total proyecto', 'registrar plan pagos', 'planificacion registrada'];
        $pos = array_search($estado, $posiblesEstados);
        if ($pos >= 0 or $pos != FALSE) {
            $entregables = getEntregables($usuario);
            $actividades = getActividadesPlanificacion($usuario);
            $costo = getCosto($usuario);
            if($costo==NULL){
                $dataCosto = "";
            }else{
                $dataCosto = $costo;
            }
            echo '<fieldset id="registroActividadPlanificacion" class="planificacion" style="display: none;">
                <legend>Registro de actividad para la planificacion</legend>
                <div class="bs-callout bs-callout-info">
                    <h4>Nota</h4>
                    <p>
                        Registre una actividad de su planificacion... 
                    </p>
                </div>
                <form class="form-horizontal"> 
                    <div class="form-group">
                        <label class="col-md-2 control-label">Actividad</label>        
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="actividad"> 
                        </div>
                    </div>                              
                    <div class="form-group">
                        <label class="col-md-2 control-label">Fecha</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="fecha">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-3">
                            <div class="col-md-6">
                                <button id="btnCancelarActividadPlanificacion" class="btn btn-primary btn-block" style="display: none;">Cancelar</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Agregar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
            <fieldset id="registroPlanificacion" style="display: none;" data-actividades="" class="planificacion">
                <legend>Registro de planificacion</legend>
                <div class="bs-callout bs-callout-warning">
                    <h4>Nota</h4>
                    <p>
                        Revise las actividades agregadas antes de registrar su planificacion. El registro de las actividades de su planificacion solo se realiza una vez.
                    </p>
                </div>
                <table class="table table-bordered table-responsive table-highlight">
                    <thead>
                        <tr>
                            <th>Actividad</th>
                            <th>Fecha</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="col-md-12">
                    <div class="col-md-3 pull-left">
                        <button id="btnAgregarActividadPlanificacion" class="btn btn-primary btn-block">Agregar actividad</button>
                    </div>
                    <div class="col-md-3 pull-left">
                        <button id="btnRegistrarPlanificacion" class="btn btn-primary btn-block">Registrar actividades</button>
                    </div>
                </div>
            <script>registrarPlanificacion()</script>
            </fieldset>
            <fieldset id="registroEntregable" class="planificacion" style="display: none;">
                <legend>Registro de entregable para el plan de pagos</legend>
                <div class="bs-callout bs-callout-info">
                    <h4>Nota</h4>
                    <p>
                        Registre un entregable de su plan de pagos...
                    </p>
                </div>
                <form class="form-horizontal"> 
                    <div class="form-group">
                        <label class="col-md-2 control-label">Entregable</label>        
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="entregable"> 
                        </div>
                    </div>            
                    <div class="form-group">
                        <label class="col-md-2 control-label">Descripcion</label>
                        <div class="col-md-3">
                            <textarea class="form-control" rows="3" name="descripcion"></textarea>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-3">
                            <div class="col-md-6">
                                <button id="btnCancelarEntregable" class="btn btn-primary btn-block" style="display: none;">Cancelar</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Agregar</button>
                            </div>
                        </div>            
                    </div>
                </form>
            </fieldset>
            <fieldset id="registroEntregables" style="display: none;" data-entregables="" class="planificacion">
                <legend>Registro de entregables</legend>
                <div class="bs-callout bs-callout-warning">
                    <h4>Nota</h4>
                    <p>
                        Revise los entregables agregados antes de registrarlos. El registro de los entregables para el plan de pagos solo se realiza una vez...
                    </p>
                </div>
                <table class="table table-bordered table-responsive table-highlight">
                    <thead>
                        <tr>
                            <th>Entregable</th>
                            <th>Descripcion</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="col-md-12">
                    <div class="col-md-3 pull-left">
                        <button class="btn btn-primary btn-block" id="atrasRegistro" value="'.$usuario.'">Atras</button>
                    </div>
                    <div class="col-md-3 pull-left">
                        <button id="btnAgregarEntregable" class="btn btn-primary btn-block">Agregar entregable</button>
                    </div>
                    <div class="col-md-3 pull-left">
                        <button id="btnRegistrarEntregables" type="button" class="btn btn-primary btn-block">Registrar entregables</button>
                    </div>
                </div>
            <script>registrarEntregables()</script>
            </fieldset>
            <fieldset id="registroCostoProyecto" class="planificacion" style="display: none;">
                <legend>Registro del costo total del proyecto</legend>
                <div class="bs-callout bs-callout-warning">
                    <h4>Nota</h4>
                    <p>
                        Revise el costo ingresado y el porcentaje de aceptacion antes de registrarlo. El registro del costo total del proyecto solo se realiza una vez.
                    </p>
                </div>
                <form class="form-horizontal"> 
                    <div class="form-group">
                        <label class="col-md-2 control-label">Costo total proyecto</label>        
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="costo" id="costo"> 
                        </div>
                    </div>    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Porcentaje de aceptacion del proyecto</label>        
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="porcentajeA" id="porcentajeA"> 
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="col-md-3 pull-left">
                            <button class="btn btn-primary btn-block" id="atrasEntregable" value="'.$usuario.'">Atras</button>
                        </div>
                        <div class="col-md-3 pull-left">
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        </div>
                    </div>
                </form>
            <script>registrarCostoProyecto()</script>
            </fieldset>
            <fieldset id="registroPago" class="planificacion" style="display: none;">
                <legend>Registro de pago para el plan de pagos</legend>
                <div class="bs-callout bs-callout-info">
                    <h4>Nota</h4>
                    <p>
                        Registre un pago para su plan de pagos...
                    </p>
                </div>
                <form class="form-horizontal"> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Actividad</label>
                        <div id="actividadesPlanificacion" class="col-md-6">'.$actividades.'</div>
                    </div>            
                    <div class="form-group">
                        <label class="col-md-3 control-label">Entregables</label>
                        <div id="entregables" class="col-md-6">'.$entregables.'</div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Porcentaje del costo total</label>        
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="porcentaje">
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-3 pull-left">
                                <button id="atrasCosto" class="btn btn-primary btn-block" value="'.$usuario.'">Atras</button>
                            </div>
                            <div class="col-md-3 pull-left">
                                <button id="btnCancelarPago" class="btn btn-primary btn-block" style="display: none;">Cancelar</button>
                            </div>
                            <div class="col-md-3 pull-left">
                                <button type="submit" class="btn btn-primary btn-block">Agregar</button>
                            </div>
                        </div>            
                    </div>
                </form>
            </fieldset>
            <fieldset id="registroPlanPagos" class="planificacion" style="display: none;" data-costo="'.$dataCosto.'" data-max="100" data-min="0">
                <legend>Registro de plan de pagos</legend>
                <div class="bs-callout bs-callout-warning">
                    <h4>Nota</h4>
                    <p>
                        Para registrar el plan de pagos debe registrar pagos cuyos porcentajes del total sumen 100%...
                    </p>
                </div>
                <table class="table table-bordered table-responsive table-highlight">
                    <thead>
                        <tr>
                            <th>Actividad</th>
                            <th>Fecha</th>
                            <th>Porcentaje del total</th>
                            <th>Monto</th>
                            <th>Entregables</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="col-md-12">
                    <div class="col-md-3 pull-left">
                        <button id="btnAgregarPago" class="btn btn-primary btn-block">Agregar pago</button>
                    </div>
                    <div class="col-md-3 pull-left">
                        <button id="btnRegistrarPlanPagos" type="button" class="btn btn-primary btn-block" style="display: none;">Registrar plan de pagos</button>
                    </div>
                </div>  
            <script>registrarPlanPagos()</script>
            </fieldset>
            <div class="alert alert-success" class="planificacion" style="display: none;">
                <strong>Su planificacion ya se encuentra registrada...</strong>
            </div>
            <script>mostrarContenido(' . $pos . ')</script>';
        }
    } else {
        echo '<div class="alert alert-warning">
                <strong>Podra registrar su planificacion una vez se haya emitido una orden de cambio o notificacion de conformidad para su grupo empresa</strong>
              </div>';
    }
} else {
    echo '<div class="alert alert-warning">
                <strong>Primero debe inscribirse a un proyecto en la opcion "Inscribirse a proyecto"</strong>
              </div>';
}

function getEntregables($usuario) {
    $e = Entregable::listaEntregables($usuario);
    $tam = count($e);
    $entregables="";
    if($tam >0){
        $entregables = '<select class="btn-primary" name="entregables" multiple="multiple">';
        for ($i = 0; $i < count($e); $i++) {
            $entregables .= '<option value="' . $e[$i] . '">' . $e[$i] . '</option>';
        }
        $entregables .= '</select>';
    }
    return $entregables;
}

function getActividadesPlanificacion($usuario) {
    $ap = Registro::listaActividadesPlanificacion($usuario);
    $tam = count($ap);
    $actividadesPlanificacion="";
    if($tam>0){
        $actividadesPlanificacion = '<select class="btn-primary" name="actividades" multiple="multiple">';
        for ($i = 0; $i < count($ap); $i++) {
            $f = new FechaRealizacion($ap[$i][0]);
            $actividadesPlanificacion .= '<option data-fecha="' . $f->getFecha() . '" value="' . $ap[$i][1] . '">' . $ap[$i][1] . '</option>';
        }
        $actividadesPlanificacion .= '</select>';
    }
    return $actividadesPlanificacion;
}

function getActividadesTabla($usuario) {
    $ap = Registro::listaActividadesPlanificacion($usuario);
    $filaActividadesPlanificacion="";
    for($i=0; $i < count($ap); $i++){
        $fecha = new FechaRealizacion($ap[$i][0]);
        $filaActividadesPlanificacion.= '<tr>
                                        <td>'.$ap[$i][1].'</td>
                                        <td>'.$fecha->getFecha().'</td>
                                        <td align="center">
                                           <button class="btn btn-xs btn-danger btnBorrarActividadPlanificacion">
                                               <i class="fa fa-times"></i>
                                           </button>
                                        </td>
                                    </tr>';
        $fecha->cerrarConexion();
    }
    return $filaActividadesPlanificacion;
}

function getCosto($usuario) {
    $p = new Precio($usuario);
    $costo = $p->getPrecio();
    return $costo;
}
?>