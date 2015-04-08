<?php  

    include '../Modelo/conexion.php';

     session_start();

    $UserAct = $_SESSION['usuario'];
	$grupo = $_POST['GrupoEscogido'];
    $Form = $_POST['IdFormularioUtilizado'];

        $nota = 0;

        $conect = new conexion();

        $Sel_Plan = $conect->consulta("SELECT ID_R FROM registro WHERE NOMBRE_U='$grupo' AND TIPO_T='actividad planificacion'");
    
        while ($Row_Plan = mysql_fetch_row($Sel_Plan)) {

            $Planif[] = $Row_Plan[0];
    
        }

        if(isset($Planif))
        {
            for ($i=0; $i <count($Planif) ; $i++) { 
        
                $Sel_Ev2 = $conect->consulta("SELECT NOTA_E FROM evaluacion WHERE ID_R = '$Planif[$i]'");
                       
                    while ($Row_Ev2 = mysql_fetch_row($Sel_Ev2)) {

                        $Eval2[] = $Row_Ev2[0];
                    
                    }
            }

            if(isset($Planif) and isset($Eval2))
            {

                if(count($Eval2) == count($Planif))
                {
                    $Ver_Form = $conect->consulta("SELECT ID_FORM FROM formulario WHERE ESTADO_FORM = 'Habilitado' AND NOMBRE_U = '$UserAct'");
                                    
                    $IdForm = mysql_fetch_row($Ver_Form);

                    $IdForm2 = $IdForm[0];
                    $cont2=0;
                    
                    $Sel_Ptje = $conect->consulta("SELECT PUNTAJE FROM puntaje WHERE ID_FORM = '$Form'");
                                     
                    while($Row_Ptje = mysql_fetch_row($Sel_Ptje))
                    {
                        $puntajes[] = $Row_Ptje;
                        
                    }
                       
                    $Escogido = $_POST['valorInput'];
                    
                    $cont = 0;
                    
                    for($p=0;$p<count($Escogido);$p++)
                    {
                        if((isset($Escogido[$p])))
                        {
                            $cont++;
                        }
                    } 

                    
                    if(count($puntajes) == count($Escogido))
                    {


                        for ($y=0; $y < count($Escogido) ; $y++) { 

                            if ($Escogido[$y] <= 100) {

                                $cont2++;
                                
                            }
                        }

                        if ($cont2 == count($puntajes)) {

                            for ($i=0; $i <count($puntajes) ; $i++) { 

                                $nota = $nota + ($puntajes[$i][0] * ($Escogido[$i]*0.01));

                            }

                            $Ver_Nota = $conect->consulta("SELECT * FROM nota WHERE NOMBRE_U = '$grupo'");

                            $Verif_N = mysql_fetch_row($Ver_Nota);

                            $op = $_POST['Operacion'];

                            if($op == 'ReEvaluar')
                            {

                                $conect->consulta("UPDATE nota SET CALIF_N = '$nota' WHERE NOMBRE_U='$grupo'");

                                $Sel_IdN = $conect->consulta("SELECT MAX(ID_N) FROM nota WHERE NOMBRE_U='$grupo'");

                                $IdNota = mysql_fetch_row($Sel_IdN);

                                    for ($i=0; $i < count($Escogido) ; $i++) { 
                                        
                                        $conect->consulta("UPDATE puntaje_ge SET CALIFICACION = '$Escogido[$i]' WHERE ID_N ='$IdNota[0]' AND  NUM_CE ='$i'");
                                
                                    }

                                echo '<script>alert("Su nota obtenida es de '.$nota.' puntos");</script>';
                                echo '<script>location.reload();</script>';



                            }
                            
                            if($op == 'Evaluar')
                            {
                                if (is_array($Verif_N)) {

                                    echo '<script>alert("Ya registro una nota anteriormente");</script>';
                                }
                                else
                                {

                                    $conect->consulta('INSERT INTO nota(ID_FORM, NOMBRE_U, CALIF_N) VALUES("'.$Form.'","'.$grupo.'","'.$nota.'")');

                                    $Sel_IdN = $conect->consulta("SELECT MAX(ID_N) FROM nota WHERE NOMBRE_U='$grupo'");

                                    $IdNota = mysql_fetch_row($Sel_IdN);

                                    for ($i=0; $i < count($Escogido) ; $i++) { 
                                        $conect->consulta('INSERT INTO puntaje_ge(ID_N, NUM_CE, CALIFICACION) VALUES("'.$IdNota[0].'","'.$i.'","'.$Escogido[$i].'")');

                                    }

                                    echo '<script>alert("Su nota obtenida es de '.$nota.' puntos");</script>';
                                    echo '<script>location.reload();</script>';

                                }

                            }
                        }
                        else
                        {

                            echo '<script>alert("El valor del puntaje no puede ser mayor a 100");</script>';
                        }
                    }
                    else{


                        echo '<script>alert("Debe escoger una opcion en la seleccion multiple");</script>';
                        
                    }

                }
                else
                {
                    echo '<script>alert("Primero debe realizar la evaluacion correspondiente a la 2da etapa");</script>';

                }

            }
            else
            {
                echo '<script>alert("Primero debe realizar la evaluacion correspondiente a la 2da etapa");</script>';
            }

        }
        else
        {
            echo '<script>alert("Primero debe realizar la evaluacion correspondiente a la 2da etapa");</script>';

        }


?>