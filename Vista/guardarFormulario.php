<?php  

include '../Modelo/conexion.php';

    session_start();

    $UserAct = $_SESSION['usuario'];
    $nameForm = $_POST['nombreFormulario'];                                      
    $conect = new conexion();

    $Crit_E = $_POST['EvaEscogidos'];
    $Crit_C = $_POST['CritEscogidos'];

    $puntaje = $_POST['PuntajeForm'];

    $buscador=0;

    for ($v=0; $v < count($Crit_E) ; $v++) { 

            for ($b=0; $b < count($Crit_E) ; $b++) { 

                if (($Crit_E[$v] == $Crit_E[$b])) {
                     
                    $buscador++;
                }
        
            }
    }

    if ($buscador > count($Crit_E)) {

        echo '<script>alert("No puede evaluar el mismo criterio mas de una vez");</script>';
    
    }else{

        $Ver_Nom = $conect->consulta("SELECT NOMBRE_FORM FROM formulario WHERE NOMBRE_FORM = '$nameForm' AND NOMBRE_U = '$UserAct' ");
        
        $Verif_Nom = mysql_fetch_row($Ver_Nom);
        
        if(!is_array($Verif_Nom))
        {
            
                $Res=0;
            
                for($z=0;$z<count($puntaje);$z++)
                {
                    $Res = $Res + $puntaje[$z]; 
                }
                
                    if($Res == 100)
                    {

                        $In_Form = $conect->consulta("INSERT INTO formulario(NOMBRE_U, NOMBRE_FORM, ESTADO_FORM) VALUES('$UserAct', '$nameForm', 'Deshabilitado')");

                        $Sel_Id =$conect->consulta("SELECT MAX(ID_FORM) FROM formulario WHERE NOMBRE_U = '$UserAct'");

                        $Id_Form = mysql_fetch_row($Sel_Id);

                        for ($cont1=0; $cont1 < count($Crit_E); $cont1++) { 


                                $Sel_IdE = $conect->consulta("SELECT ID_CRITERIO_E FROM criterio_evaluacion WHERE NOMBRE_CRITERIO_E = '$Crit_E[$cont1]' AND NOMBRE_U = '$UserAct'");
                            
                                $Sel_IdC = $conect->consulta("SELECT ID_CRITERIO_C FROM criteriocalificacion WHERE NOMBRE_CRITERIO_C = '$Crit_C[$cont1]' AND NOMBRE_U = '$UserAct'");

                                $idE = mysql_fetch_row($Sel_IdE);

                                $idC = mysql_fetch_row($Sel_IdC);

                                $In_CritE = $conect->consulta("INSERT INTO form_crit_e(ID_FORM, ID_CRITERIO_E) VALUES('$Id_Form[0]','$idE[0]') ");

                                $In_CritC = $conect->consulta("INSERT INTO from_crit_c(ID_CRITERIO_C, ID_FORM) VALUES('$idC[0]','$Id_Form[0]') ");

                                $In_Ptje = $conect->consulta("INSERT INTO puntaje(ID_FORM, PUNTAJE) VALUES('$Id_Form[0]','$puntaje[$cont1]')");                           
                        }

                    
                        if($In_Form and $In_CritE and $In_CritC and $In_Ptje)
                        {

                            echo '<script>alert("Se guardo el formulario correctamente");</script>';
                      
                        }

                    }
                    else{
                        echo '<script>alert("La sumatoria de puntajes en el formulario no puede ser mayor ni menor a 100");</script>';
                        
                        
                    }
           
                
       }
       else
       {

            echo '<script>alert("Ya existe un formulario con ese nombre registrado");</script>';
        
            
     
       }
    }

    






        
            

?>