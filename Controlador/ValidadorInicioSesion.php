 <?php 
  class ValidadorInicioSesion {
     function validarInicioSesion($ses,$rol){
        
            $sesion = $_SESSION['sesion'];

            if (strcmp ($sesion, $rol ) != 0) {
                echo '<script>alert("Usted intento ingresar a una pagina que no le corresponde");</script>';
                echo '<script>window.location="../index.php";</script>';
            }
          
   }
}
?>