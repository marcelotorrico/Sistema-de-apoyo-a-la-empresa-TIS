<?php
include_once '../Modelo/conexionPDO.php';
class ReporteAsistencias {
    private $conexion;
    function __construct() {
	        
	        $this->conexion = new Conexion();
	        
            }
    function mostrar($GrupoE){
?>
<form id = "ordenc" method = "post" action="" role="form" enctype="multipart/data-form" onsubmit="return validarCampos(ordenc)">
                        <div class ="form-horizontal">
                            <div class="historia">
                                <h2><span>ASISTENCIA DE LOS SOCIOS</span></h2>
                            </div>
                            <hr>
                            <h2><span>Reporte</span></h2>
                            <div class="historia1">
                                <div class="contenedor-fila2">

                                    <div class="contenedor-columna">
                                        <?php
                                        echo "Socio";
                                        ?>
                                    </div>  
                                    <div class="contenedor-columna">
                                        <?php
                                        echo "Presente";
                                        ?>
                                    </div>

                                    <div class="contenedor-columna">
                                        <?php
                                        echo "Licencia";
                                        ?>
                                    </div>
                                    <div class="contenedor-columna">
                                        <?php
                                        echo "Ausente";
                                        ?>
                                    </div>
                                </div>
                                
                                <table class="table table-bordered table-responsive table-highlight">
                                    <?php
                                    $consultaSocios = $this->conexion->query("SELECT CODIGO_S, NOMBRES_S, APELLIDOS_S FROM socio WHERE NOMBRE_U = '$GrupoE'");
                                    while ($filaSocios = $consultaSocios->fetch(PDO::FETCH_ASSOC)){
                                        $codigoSocio = $filaSocios['CODIGO_S'];
                                        $consultaSocioPresente = $this->conexion->query("SELECT ASISTENCIA_A FROM asistencia WHERE CODIGO_SOCIO_A = '$codigoSocio' AND ASISTENCIA_A = '1'");
                                        $cantidadPresente = $consultaSocioPresente->rowCount();
                                        $consultaSemanalSocioPresente = $this->conexion->query("SELECT ASISTENCIA_AS FROM asistencia_semanal WHERE CODIGO_SOCIO_AS = '$codigoSocio' AND ASISTENCIA_AS = '1'");
                                        $cantidadSemanalPresente = $consultaSemanalSocioPresente->rowCount();
                                        $consultaSocioLicencia = $this->conexion->query("SELECT ASISTENCIA_A FROM asistencia WHERE CODIGO_SOCIO_A = '$codigoSocio' AND ASISTENCIA_A = '0' AND LICENCIA_A ='1'");
                                        $cantidadLicencia = $consultaSocioLicencia->rowCount();
                                        $consultaSemanalSocioLicencia = $this->conexion->query("SELECT ASISTENCIA_AS FROM asistencia_semanal WHERE CODIGO_SOCIO_AS = '$codigoSocio' AND ASISTENCIA_AS = '0' AND LICENCIA_AS ='1'");
                                        $cantidadSemanalLicencia = $consultaSemanalSocioLicencia->rowCount();
                                        $consultaSocioAusente = $this->conexion->query("SELECT ASISTENCIA_A FROM asistencia WHERE CODIGO_SOCIO_A = '$codigoSocio' AND ASISTENCIA_A = '0' AND LICENCIA_A ='0'");
                                        $cantidadAusente = $consultaSocioAusente->rowCount();
                                        $consultaSemanalSocioAusente = $this->conexion->query("SELECT ASISTENCIA_AS FROM asistencia_semanal WHERE CODIGO_SOCIO_AS = '$codigoSocio' AND ASISTENCIA_AS = '0' AND LICENCIA_AS ='0'");
                                        $cantidadSemanalAusente = $consultaSemanalSocioAusente->rowCount();
                                        $totalAusencia = $cantidadAusente+$cantidadSemanalAusente;
                                        if($totalAusencia < 3){
                                    ?>
                                    <tr class="contenedor-fila" >
                                        <td class="contenedor-columna" VALIGN="MIDDLE" ALIGN="CENTER">
                                            <?php
                                            echo $filaSocios['NOMBRES_S']." ".$filaSocios['APELLIDOS_S'];
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" VALIGN="MIDDLE" ALIGN="CENTER">
                                            <?php
                                            echo $cantidadPresente+$cantidadSemanalPresente; 
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" VALIGN="MIDDLE" ALIGN="CENTER">
                                            <?php
                                            echo $cantidadLicencia+$cantidadSemanalLicencia;
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" VALIGN="MIDDLE" ALIGN="CENTER">
                                            <?php
                                            echo $totalAusencia;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }else{
                                    ?>
                                    <tr bgcolor="red" >
                                        <td class="contenedor-columna" VALIGN="MIDDLE" ALIGN="CENTER">
                                            <?php
                                            echo $filaSocios['NOMBRES_S']." ".$filaSocios['APELLIDOS_S'];
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" VALIGN="MIDDLE" ALIGN="CENTER">
                                            <?php
                                            echo $cantidadPresente+$cantidadSemanalPresente; 
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" VALIGN="MIDDLE" ALIGN="CENTER">
                                            <?php
                                            echo $cantidadLicencia+$cantidadSemanalLicencia;
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" VALIGN="MIDDLE" ALIGN="CENTER">
                                            <?php
                                            echo $totalAusencia;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    }   
                                    ?>
                                </table>
                                </div>
                            <br><br>
                            <h2><span>ASISTENCIA</span></h2>
                            
                            <div class="historia1">
                                <div class="contenedor-fila2">

                                    <div class="contenedor-columna">
                                        <?php
                                        echo "Actividad";
                                        ?>
                                    </div>  
                                    <div class="contenedor-columna">
                                        <?php
                                        echo "Socio";
                                        ?>
                                    </div>

                                    <div class="contenedor-columna">
                                        <?php
                                        echo "Asistencia";
                                        ?>
                                    </div>
                                </div>
                                
                                <?php
                                $peticionActividad = $this->conexion->query("SELECT r.id_r, nombre_r, f_r.fecha_fr FROM registro r, fecha_realizacion f_r  WHERE r.NOMBRE_U='$GrupoE' and r.TIPO_T='actividad planificacion' and f_r.ID_R = r.ID_R");
                                while ($filaActividad = $peticionActividad->fetch(PDO::FETCH_ASSOC)){
                                    $peticion =$this->conexion->query("SELECT CODIGO_S, NOMBRES_S, APELLIDOS_S FROM socio WHERE NOMBRE_U = '$GrupoE'");
                                    $result = $peticion->fetchAll();
                                    $cantidad = count($result);
                                    $j = 0;
                                    $actividad = $filaActividad['nombre_r'];
                                    $codigoActividad = $filaActividad['id_r'];
                                    $actividadAsistenciaSemanal = $this->conexion->query("SELECT * FROM asistencia_semanal WHERE ID_R = '$codigoActividad'");
                                    $resultadoSemanal = $actividadAsistenciaSemanal->fetchAll();
                                    $cantidadSemanal = count($resultadoSemanal);
                                    $total = $cantidad + $cantidadSemanal;
                                ?>        
                                <table class="table table-bordered table-responsive table-highlight">
                                    <tr class="contenedor-fila" >
                                        <td class="contenedor-columna" VALIGN="MIDDLE" ALIGN="CENTER" rowspan="<?=$total?>">
                                            <?php
                                            echo $actividad;
                                            ?>
                                        </td>
                                            
                                            <?php 
                                                foreach($result as $fila => $value){
                                                    $socio = $value['CODIGO_S'];
                                                    $consulta = "SELECT ASISTENCIA_A, LICENCIA_A FROM asistencia WHERE ID_R = '$codigoActividad' AND CODIGO_SOCIO_A ='$socio'";
                                                    $peticionAsistencia = $this->conexion->query($consulta);
                                                    $tamano=$peticionAsistencia->rowCount();
                                                    $resultado = '';
                                                    if($tamano>0){
                                                        while ($fila = $peticionAsistencia->fetch(PDO::FETCH_ASSOC)){
                                                            $asistencia= $fila["ASISTENCIA_A"];
                                                            $licencia = $fila["LICENCIA_A"];
                                                            if($asistencia == 1){
                                                                $resultado = "Presente";
                                                            }else{
                                                                if($licencia == 1){
                                                                    $resultado = "Licencia";
                                                                }else{
                                                                    $resultado = "Ausente";
                                                                }
                                                            }
                                                        }
                                                    }else{
                                                        $resultado = "-----";
                                                    }
                                                    
                                                    if($j>0){
                                                        if($resultado == "Ausente"){
                                            ?>
                                    <tr bgcolor="red">
                                        <td class="contenedor-columna" ALIGN="CENTER">
                                            <?php
                                                 echo $value['NOMBRES_S']." ".$value['APELLIDOS_S'];
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" ALIGN="CENTER">
                                            <?php
                                                echo $resultado;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php   
                                    }else{
                                    ?>
                                    <tr class="contenedor-fila">
                                    <td class="contenedor-columna" ALIGN="CENTER">
                                            <?php
                                                 echo $value['NOMBRES_S']." ".$value['APELLIDOS_S'];
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" ALIGN="CENTER">
                                            <?php
                                                echo $resultado;
                                            ?>
                                        </td>
                                        </tr>
                                    <?php
                                    }
                                    }else{
                                        if($resultado == "Ausente"){
                                    ?>
                                        <td bgcolor="red" ALIGN="CENTER">
                                            <?php
                                                 echo $value['NOMBRES_S']." ".$value['APELLIDOS_S'];
                                            ?>
                                        </td>
                                        <td bgcolor="red" ALIGN="CENTER">
                                            <?php
                                                echo $resultado;
                                            ?>
                                        </td>
                                        <?php   
                                        }else{
                                        ?>
                                    <td class="contenedor-columna" ALIGN="CENTER">
                                            <?php
                                                 echo $value['NOMBRES_S']." ".$value['APELLIDOS_S'];
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" ALIGN="CENTER">
                                            <?php
                                                echo $resultado;
                                            ?>
                                        </td>
                                            <?php
                                                    }
                                                }
                                                $j++;
                                            }                 
                                            if($cantidadSemanal>0){
                                                $actividadAsisSemanal = $this->conexion->query("SELECT * FROM asistencia_semanal WHERE ID_R = '$codigoActividad'");
                                                while ($filaActividadSemanal = $actividadAsisSemanal->fetch(PDO::FETCH_ASSOC)){
                                                  $socio = $filaActividadSemanal['CODIGO_SOCIO_AS'];
                                                  $asistencia= $filaActividadSemanal["ASISTENCIA_AS"];
                                                  $licencia = $filaActividadSemanal["LICENCIA_AS"];
                                                  $consultaNombre = $this->conexion->query("SELECT NOMBRES_S, APELLIDOS_S FROM socio WHERE CODIGO_S = $socio");
                                                  while ($fila = $consultaNombre->fetch(PDO::FETCH_ASSOC)){
                                                      $nombre = $fila['NOMBRES_S'];
                                                      $apellido = $fila['APELLIDOS_S'];
                                                  }
                                                  $nombreCompleto = $nombre." ".$apellido;
                                                  if($asistencia == 1){
                                                      $resultado = "Presente";
                                                  }else{
                                                      if($licencia == 1){
                                                          $resultado = "Licencia";
                                                      }else{
                                                          $resultado = "Ausente";
                                                      }
                                                   }
                                                   if($resultado == "Ausente"){
                                                    ?>
                                        
                                    <tr bgcolor="red">
                                        <td class="contenedor-columna" ALIGN="CENTER">
                                            <?php
                                                 echo $nombreCompleto;
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" ALIGN="CENTER">
                                            <?php
                                                echo $resultado." (Seguimiento Semanal)";
                                            ?>
                                        </td>
                                    </tr>
                                    <?php   
                                    }else{
                                    ?>
                                    <tr class="contenedor-fila">
                                    <td class="contenedor-columna" ALIGN="CENTER">
                                            <?php
                                                 echo $nombreCompleto;
                                            ?>
                                        </td>
                                        <td class="contenedor-columna" ALIGN="CENTER">
                                            <?php
                                                echo $resultado." (Seguimiento Semanal)";
                                            ?>
                                        </td>
                                        </tr>
                                    <?php
                                                
                                            }
                                        }
                                    }
                                    ?>
                                    </tr>
                                </table>   
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </form>
<?php
    }   
}
?>