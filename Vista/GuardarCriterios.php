<?php  

	require_once '../Modelo/conexion.php';

    session_start();

    $UserAct = $_SESSION['usuario'];

	$con = new conexion();

	$con->conectar();

        
        $Tipo = $_POST['tipoSelect'];
        
        if(isset($_POST['Indicador']) and isset($_POST['ValorNumerico']))
        {
            
            $Ind = $_POST['Indicador'];
            $valores = $_POST['ValorNumerico'];
            $buscador=0;
            $nombre="";
            $cont5=0;

            for ($v=0; $v < count($Ind) ; $v++) { 

                for ($b=0; $b < count($Ind) ; $b++) { 

                    if ((strtoupper(trim($Ind[$v])) == strtoupper(trim($Ind[$b])) or ($valores[$v] == $valores[$b]))) {

                        $buscador++;
                    }

                }
            }

                if ($buscador > count($Ind)) {

                    echo '<script>alert("No puede registrar 2 indicadores o puntajes iguales");</script>';

                }
                else
                {

                    for ($t=0; $t < count($valores) ; $t++) { 

                        if($valores[$t] <= 100)
                        {
                            $cont5++;

                        }
                    }

                    if($cont5 == count($valores))
                    {

                        for ($j=0; $j <count($Ind) ; $j++) { 

                            $nombre = $nombre.$Ind[$j].'('.$valores[$j].')';    
                        }

                        $Sel_NomC = $con->consulta("SELECT NOMBRE_CRITERIO_C FROM criteriocalificacion WHERE NOMBRE_CRITERIO_C = '$nombre' AND NOMBRE_U='$UserAct'");

                        $Nom_C = mysql_fetch_row($Sel_NomC);

                        if (!is_array($Nom_C)) {

                                $con2 = new conexion();
                                $con2->consulta("INSERT INTO criteriocalificacion(NOMBRE_CRITERIO_C, NOMBRE_U, TIPO_CRITERIO) VALUES('$nombre', '$UserAct', '$Tipo')");

                                $maxIdRes = $con2->consulta("SELECT MAX(ID_CRITERIO_C) FROM criteriocalificacion WHERE NOMBRE_U = '$UserAct'");

                                 $maxID = mysql_fetch_row($maxIdRes);

                            for ($i=0; $i<count($Ind); $i++) {

                                if (isset($Ind[$i]) and isset($valores[$i])) {

                                    $con2->consulta("INSERT INTO indicador( ID_CRITERIO_C, NOMBRE_INDICADOR,PUNTAJE_INDICADOR) VALUES('$maxID[0]','$Ind[$i]', '$valores[$i]')");

                                }
                            }


                                if(isset($con2)){

                                    echo '<script>alert("Se registraron los datos correctamente");</script>';

                                }      
                        }          

                        else
                        {

                            echo '<script>alert("Ya existe un criterio de ese tipo");</script>';

                        }
                    }
                    else
                    {

                        echo '<script>alert("El puntaje no puede ser mayor a 100");</script>';

                    }
                }            
        }
        else
        {
            echo '<script>alert("Debe agregar al menos un criterio");</script>';
        }
        
?>