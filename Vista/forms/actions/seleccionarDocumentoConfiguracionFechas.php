<?php
    
    $conex = new Conexion();
    $cons="SELECT nombre_r FROM registro WHERE tipo_t ='documento requerido' AND nombre_u='$uActivo'";
    
    $a=$conex->query($cons);
    
    if(isset($_POST['documentoRequerido'])){
      
        $_a=$_POST['documentoRequerido'];
    }
    else
    {
        $_a="";
    }
       
        $cont=0;
    

?>
