<?php
    
    $con=new Conexion();
    $usuarioActivo="leticia";
    

    $cons="SELECT nombre_r ".
       " FROM registro ".
       " WHERE tipo_t ='documento requerido'".
       " AND nombre_u='$usuarioActivo'";
    
    $a=$con->query($cons);
    
    if(isset($_POST['documentoRequerido'])){
        $_a=$_POST['documentoRequerido'];
    }else{
        $_a="";
    }
       
        $cont=0;
    

?>
