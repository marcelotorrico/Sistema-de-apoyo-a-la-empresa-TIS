<?php

$Form = $_POST['EscogidoEliminar'];


include '../Modelo/conexion.php';

    $conect = new conexion();

    $Sel_Nota = $conect->consulta("SELECT * FROM nota WHERE ID_FORM = '$Form'");

    $Nota = mysql_fetch_row($Sel_Nota);

    if(is_array($Nota))
    {

        echo '<script>alert("El formulario esta siendo usado y no puede ser eliminado");</script>';
        echo '<script>window.location="EliminarFormulario.php";</script>';
    
    }
    else{

        $Del_FCE = $conect->consulta("DELETE FROM form_crit_e WHERE ID_FORM = '$Form'");

        $Del_FCC = $conect->consulta("DELETE FROM from_crit_c WHERE ID_FORM = '$Form'");

        $Del_Pje = $conect->consulta("DELETE FROM puntaje WHERE ID_FORM = '$Form'");

        $Del_Form = $conect->consulta("DELETE FROM formulario WHERE ID_FORM = '$Form'");

        if($Del_FCE and $Del_FCC and $Del_Pje and $Del_Form) 
        {

            echo '<script>alert("Se elimino el formulario correctamente");</script>';
            echo '<script>window.location="EliminarFormulario.php";</script>';
 
        }

    }
  
?>
