<?php

session_start();
$UsuarioActivo = $_SESSION['usuario'];
include '../Modelo/conexion.php';

$Form = $_POST['formulario'];
                                                  
    $conect = new conexion();
    
    $On_Form = $conect->consulta("UPDATE formulario SET ESTADO_FORM = 'Habilitado' WHERE NOMBRE_FORM = '$Form' AND NOMBRE_U = '$UsuarioActivo'");
    $Off_Form = $conect->consulta("UPDATE formulario SET ESTADO_FORM = 'Deshabilitado' WHERE NOMBRE_FORM <> '$Form' AND NOMBRE_U = '$UsuarioActivo'");
    
    if($On_Form and $Off_Form) 
    {

        echo '<script>alert("Se habilito el formulario para su uso");</script>';
        echo '<script>window.location = "../Vista/SeleccionarFormulario.php"</script>';
      
    }
    
    
    
?>
