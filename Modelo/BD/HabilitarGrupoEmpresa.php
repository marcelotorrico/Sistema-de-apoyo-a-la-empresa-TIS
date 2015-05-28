<?php  

	include '../conexionPDO.php';
    $conectar = new Conexion();
    $GrupoE = $_GET['GE'];
    $Op = $_GET['Operacion'];


    if($Op == 'Habilitar')
    {
        $On_GE = $conectar->query("UPDATE inscripcion SET ESTADO_INSCRIPCION = 'Habilitado' WHERE NOMBRE_UGE='$GrupoE'");
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
	$peticion1 = $conectar->query("SELECT NOMBRE_LARGO_GE FROM grupo_empresa WHERE NOMBRE_U = '$GrupoE'"); 
        while ($correo1 = $peticion1->fetch(PDO::FETCH_ASSOC))
        {        
        $NombreLargo=$correo1["NOMBRE_LARGO_GE"];}   
        
 	$peticion2 = $conectar->query("SELECT NOMBRE_CORTO_GE FROM grupo_empresa WHERE NOMBRE_U = '$GrupoE'"); 
        while ($correo2 = $peticion2->fetch(PDO::FETCH_ASSOC))
        {        
        $NombreCorto=$correo2["NOMBRE_CORTO_GE"];}       
 
 	$peticion3 = $conectar->query("SELECT NOMBRE_CORTO FROM lista_ge WHERE NOMBRE_CORTO = '$NombreCorto'"); 
        $tamano=$peticion3->rowCount();
        if($tamano>0)
        {
        while ($correo3 = $peticion3->fetch(PDO::FETCH_ASSOC))
        {        
        $NombreCortoT=$correo3["NOMBRE_CORTO"];}
        
        } 
        else{$NombreCortoT='aaaaa';}
  	$peticion4 = $conectar->query("SELECT DIRECCION_GE FROM grupo_empresa WHERE NOMBRE_U = '$GrupoE'"); 
        while ($correo4 = $peticion4->fetch(PDO::FETCH_ASSOC))
        {        
        $Direccion=$correo4["DIRECCION_GE"];}        
        


        
     if (strcmp ($NombreCorto , $NombreCortoT ) !== 0) 
     {
      
      $conectar->query("INSERT INTO `saetis`.`lista_ge` (`NOMBRE_CORTO`, `NOMBRE_LARGO`, `DIRECCION`, `REPRESENTANTE_LEGAL`) VALUES ('$NombreCorto', '$NombreLargo', '$Direccion', NULL);");
     }
     /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if($On_GE)
        {

            echo '<script>alert("Se habilito la grupo empresa correctamente");</script>';
            echo '<script>window.location="../../Vista/AdministrarGrupoEmpresa.php";</script>';
                   
        }
    }

    if($Op == 'Deshabilitar')
    {
        $Off_GE = $conectar->query("UPDATE inscripcion SET ESTADO_INSCRIPCION = 'Deshabilitado' WHERE NOMBRE_UGE='$GrupoE'");

        if($Off_GE)
        {

            echo '<script>alert("Se Deshabilito la grupo empresa correctamente");</script>';
            echo '<script>window.location="../../Vista/AdministrarGrupoEmpresa.php";</script>';
                   
        }
    }

?>