<?php  

	require_once '../conexionPDO.php';

    session_start();

    $UserAct = $_SESSION['usuario'];

	$con = new Conexion();

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

                        $Sel_NomC = $con->query("SELECT NOMBRE_CRITERIO_C FROM criteriocalificacion WHERE NOMBRE_CRITERIO_C = '$nombre' AND NOMBRE_U='$UserAct'");

                        $Nom_C = $Sel_NomC->fetch(PDO::FETCH_NUM);

                        if (!is_array($Nom_C)) {
                                $flag=TRUE;
                                $con->query("INSERT INTO criteriocalificacion(NOMBRE_CRITERIO_C, NOMBRE_U, TIPO_CRITERIO) VALUES('$nombre', '$UserAct', '$Tipo')");

                                $maxIdRes = $con->query("SELECT MAX(ID_CRITERIO_C) FROM criteriocalificacion WHERE NOMBRE_U = '$UserAct'");

                                 $maxID = $maxIdRes->fetch(PDO::FETCH_NUM);

                            for ($i=0; $i<count($Ind); $i++) {

                                if (isset($Ind[$i]) and isset($valores[$i])) {

                                    $con->query("INSERT INTO indicador( ID_CRITERIO_C, NOMBRE_INDICADOR,PUNTAJE_INDICADOR) VALUES('$maxID[0]','$Ind[$i]', '$valores[$i]')");

                                }
                            }
                            echo '<script>alert("Se registraron los datos correctamente");</script>';
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