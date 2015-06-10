<?php 
  session_start();
  /*verifica si la sesion esta abierta*/

  if (isset($_SESSION['usuario'])){
             $sesion = $_SESSION['sesion'];
             
             $administrador = 'administrador';
             $asesor='asesor';
             $grupoEmpresa='grupoEmpresa';
  /*en caso de que la sesion este abierta lo direccionará 
  a la vista principal que le correponde*/            
             if (strcmp ($sesion, $administrador ) == 0) {
                
                 echo "<script>window.location='./Vista/principal.php';</script>";          
             }
             if (strcmp ($sesion, $asesor ) == 0) {

                echo "<script>window.location='./Vista/inicio_asesor.php';</script>";          
             }
             if (strcmp ($sesion, $grupoEmpresa ) == 0) {
                 
                echo "<script>window.location='./Vista/inicio_grupo_empresa.php';</script>";          
             }
        }
        else{

        }


 ?>