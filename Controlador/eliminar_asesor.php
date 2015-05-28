<?php
session_start();
include '../Modelo/conexionPDO.php';
$conect = new Conexion();
//Crear variables--------------------------
$usuario = $_SESSION['usuario'];
$contrasena = $_SESSION['contrasena'];

$idAsesor = $_GET['id_us'];
//conexion-------------
    
    //Verificar registros
    $selAsesor = $conect->query("SELECT ID_R FROM registro WHERE NOMBRE_U='$idAsesor'");
    $regisAse = $selAsesor->fetch(PDO::FETCH_NUM);
    
 
    if(isset($_GET['op']))
    {
        $op = $_GET['op'];
       
        if($op == 'si')
        {
           
            $peticion = $conect->query(" SELECT * FROM `comentarios` WHERE NOMBRE_U ='$idAsesor'")->rowCount();
            if($peticion>0){
                 $delComen = $conect->query(" DELETE FROM `comentarios` WHERE NOMBRE_U='$idAsesor'");
            }
            $tamNoti = $conect->query(" SELECT * FROM `noticias` WHERE NOMBRE_U ='$idAsesor'")->rowCount();
            if($tamNoti>0){
                 $delNoti = $conect->query(" DELETE FROM `noticias` WHERE NOMBRE_U='$idAsesor'");
            }
            
            $selRegis =$conect->query(" SELECT ID_R FROM `registro` WHERE NOMBRE_U ='$idAsesor'");
            $tamRegis=$selRegis->rowCount();
            
           
            if($tamRegis>0){
                while($filaR = $selRegis->fetch(PDO::FETCH_NUM))
                {
                    $idRegis=$filaR[0];
                    $delDesc=$conect->query(" DELETE FROM `descripcion` WHERE ID_R='$idRegis'");
                    $delDoc=$conect->query(" DELETE FROM `documento` WHERE ID_R='$idRegis'");
                    $delPer = $conect->query("DELETE FROM periodo WHERE ID_R = '$idRegis' ");
                    $delPlazo = $conect->query("DELETE FROM plazo WHERE ID_R = '$idRegis' ");
                    $delRecp = $conect->query("DELETE FROM receptor WHERE ID_R = '$idRegis' ");
                    $delRg = $conect->query("DELETE FROM registro WHERE ID_R = '$idRegis' ");
                 }
             }
             
             $selForm = $conect->query("SELECT ID_FORM FROM `formulario` WHERE NOMBRE_U ='$idAsesor'");
             $tamForm=$selForm->rowCount();
             
            if($tamForm>0)
            {
                while($fila1 = $selForm->fetch(PDO::FETCH_NUM))
                {
                    $idForm=$fila1[0];
                    $puntajeG= $conect->query("SELECT ID_N FROM nota WHERE ID_FORM ='$idForm'");
                    //var_dump($puntajeG);
                    $idpuntaj=$puntajeG->fetch(PDO::FETCH_NUM);
                    $delPuntaG = $conect->query("DELETE FROM puntaje_ge WHERE ID_N = '$idpuntaj[0]' ");
                    //var_dump($eliminar_puntaje1);
                  
                    $delPunta = $conect->query("DELETE FROM puntaje WHERE ID_FORM = '$idForm' ");
                    //var_dump($eliminar_puntaje);
                    $delNota = $conect->query("DELETE FROM nota WHERE ID_FORM = '$idForm' ");
                    $delFE= $conect->query("DELETE FROM form_crit_e WHERE ID_FORM = '$idForm' ");
                    $delFC= $conect->query("DELETE FROM from_crit_c WHERE ID_FORM = '$idForm' ");
                    $selCritC = $conect->query("SELECT ID_CRITERIO_C FROM criteriocalificacion WHERE NOMBRE_U = '$idAsesor'");
                    while($rowIDC = $selCritC->fetch(PDO::FETCH_NUM))
                    {
                        $delIndi = $conect->query("DELETE from indicador WHERE ID_CRITERIO_C = '$rowIDC[0]' ");
                    }
                }
                
                    $delForm1= $conect->query("DELETE FROM formulario WHERE NOMBRE_U = '$idAsesor' ");  
                
                    $delCc= $conect->query("DELETE FROM criteriocalificacion WHERE NOMBRE_U = '$idAsesor'  ");
                    $delCe= $conect->query("DELETE FROM criterio_evaluacion WHERE NOMBRE_U = '$idAsesor' ");          
            }
            
           
            $delRol= $conect->query("DELETE FROM usuario_rol WHERE NOMBRE_U = '$idAsesor' ");
            $delIns= $conect->query("DELETE FROM inscripcion WHERE NOMBRE_UA = '$idAsesor' ");
            $selCritC = $conect->query("SELECT ID_CRITERIO_C FROM criteriocalificacion WHERE NOMBRE_U = '$idAsesor'");
            
            while($rowID = $selCritC->fetch(PDO::FETCH_NUM))
            {
                $delIn = $conect->query("DELETE FROM indicador WHERE ID_CRITERIO_C = '$rowID[0]'");
            }
            
            $delCc= $conect->query("DELETE FROM criteriocalificacion WHERE NOMBRE_U = '$idAsesor'  ");
            $delCe= $conect->query("DELETE FROM criterio_evaluacion WHERE NOMBRE_U = '$idAsesor' "); 
            $delTipo = $conect->query("DELETE FROM asesor WHERE NOMBRE_U = '$idAsesor' ");
            
            $delSesion = $conect->query("DELETE FROM sesion WHERE NOMBRE_U = '$idAsesor' ");
            $delUser = $conect->query("DELETE FROM usuario WHERE NOMBRE_U = '$idAsesor' ");
            
            echo '<script>alert("Se elimino al asesor correctamente!!")</script>';
            echo '<script>window.location="../Vista/lista_asesores.php";</script>';
            
            die();
            
        }//end op--si
        
        if($op == 'no')
        {
            header('location:../Vista/lista_asesores.php');
            die();
        }
         
        die();
    }//end if isset
    
  
     
    if(is_array($regisAse))
    {
        echo '<script>
            var pagina =  "eliminar_asesor.php?id_us='.$idAsesor.'&op=si"
            var pagina2 = "eliminar_asesor.php?id_us='.$idAsesor.'&op=no"
            if(confirm("El asesor tiene registros...desea eliminarlo de todas formas??"))
            {
                location.href = pagina
            }
            else{
                location.href = pagina2
            }
          </script>';
        
        die();
    }
    else
    {
        
        
        
        $selFormS = $conect->query("SELECT ID_FORM FROM `formulario` WHERE NOMBRE_U ='$idAsesor'");
        $tamFormS=$selFormS->rowCount();
        if( $tamFormS>0){
            while($fila1 = $selFormS->fetch(PDO::FETCH_NUM))
            {
                $idForm=$fila1[0];
                $puntajeG= $conect->query("SELECT ID_N FROM nota WHERE ID_FORM ='$idForm'");
                //var_dump($puntajeG);
                $idPuntaj=$puntajeG->fetch(PDO::FETCH_NUM);
                $delPuntjG = $conect->query("DELETE FROM puntaje_ge WHERE ID_N = '$idPuntaj[0]' ");
                //var_dump($eliminar_puntaje1);
                echo "</br>";
                $delPuntaj= $conect->query("DELETE FROM puntaje WHERE ID_FORM = '$idForm' ");
                //var_dump($eliminar_puntaje);
                $delNota = $conect->query("DELETE FROM nota WHERE ID_FORM = '$idForm1' ");
                $delFE= $conect->query("DELETE FROM form_crit_e WHERE ID_FORM = '$idForm' ");
                $delFC= $conect->query("DELETE FROM from_crit_c WHERE ID_FORM = '$idForm' ");
                $delCritC = $conect->query("SELECT ID_CRITERIO_C FROM criteriocalificacion WHERE NOMBRE_U = '$idAsesor'");
                while($rowIDC = $delCritC->fetch(PDO::FETCH_NUM))
                {
                    $delIndi = $conect->query("DELETE from indicador WHERE ID_CRITERIO_C = '$rowIDC[0]' ");
                }
            }
            $delFormS= $conect->query("DELETE FROM formulario WHERE NOMBRE_U = '$idAsesor' ");  
            $delCc= $conect->query("DELETE FROM criteriocalificacion WHERE NOMBRE_U = '$$idAsesor'  ");
            $delCe= $conect->query("DELETE FROM criterio_evaluacion WHERE NOMBRE_U = '$idAsesor' ");
            $delRol = $conect->query("DELETE FROM usuario_rol WHERE NOMBRE_U = '$idAsesor' ");
            $delIns= $conect->query("DELETE FROM inscripcion WHERE NOMBRE_UA = '$idAsesor' ");
            $delTipo = $conect->query("DELETE FROM asesor WHERE NOMBRE_U = '$idAsesor' ");
            $delSes = $conect->query("DELETE FROM sesion WHERE NOMBRE_U = '$$idAsesor' ");
            $delUser = $conect->query("DELETE FROM usuario WHERE NOMBRE_U = '$idAsesor' ");
        }
        
        
        
        $delComen = $conect->query(" DELETE FROM `comentarios` WHERE NOMBRE_U='$idAsesor'");
        $delNoti = $conect->query(" DELETE FROM `noticias` WHERE NOMBRE_U='$idAsesor'");
     
        $delRolU = $conect->query("DELETE FROM usuario_rol WHERE NOMBRE_U = '$idAsesor' ");
              
        $delIns = $conect->query("DELETE FROM inscripcion WHERE NOMBRE_UA = '$idAsesor' ");
        
        $delCc= $conect->query("DELETE FROM criteriocalificacion WHERE NOMBRE_U = '$idAsesor'  ");
     
        $delAsesor = $conect->query("DELETE FROM asesor WHERE NOMBRE_U = '$idAsesor' ");
        $delSesion = $conect->query("DELETE FROM sesion WHERE NOMBRE_U = '$idAsesor' ");
        
        $delUser = $conect->query("DELETE FROM usuario WHERE NOMBRE_U = '$idAsesor' ");
        
        // mysql_close($conexion);
        
        
        echo '<script>alert("Se elimino al asesor correctamente!!")</script>';
    echo '<script>window.location="../Vista/lista_asesores.php";</script>';
    }
         
?>