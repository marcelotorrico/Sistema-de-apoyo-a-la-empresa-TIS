<?php

$Form = $_POST['EscogidoEliminar'];


include '../conexionPDO.php';

    $conect = new Conexion();

    $Sel_Nota = $conect->query("SELECT * FROM nota WHERE ID_FORM = '$Form'");

    $Nota = $Sel_Nota->fetch(PDO::FETCH_NUM);

    if(is_array($Nota))
    {

        echo '<script>alert("El formulario esta siendo usado y no puede ser eliminado");</script>';
        echo '<script>window.location="../../Vista/EliminarFormulario.php";</script>';
    
    }
    else{

        $Del_FCE = $conect->query("DELETE FROM form_crit_e WHERE ID_FORM = '$Form'");

        $Del_FCC = $conect->query("DELETE FROM from_crit_c WHERE ID_FORM = '$Form'");

        $Del_Pje = $conect->query("DELETE FROM puntaje WHERE ID_FORM = '$Form'");

        $Del_Form = $conect->query("DELETE FROM formulario WHERE ID_FORM = '$Form'");

        if($Del_FCE and $Del_FCC and $Del_Pje and $Del_Form) 
        {

            echo '<script>alert("Se elimino el formulario correctamente");</script>';
            echo '<script>window.location="../../Vista/EliminarFormulario.php";</script>';
 
        }

    }
  
?>
