 <?php 
  class ValidadorInicioSesion {
     function validarInicioSesion($ses,$rol){
        
            $sesion = $_SESSION['sesion'];

            if (strcmp ($sesion, $rol ) != 0) {
                echo '<script>alert("Usted intento ingresar a una pagina que no le corresponde");</script>';
                echo '<script>window.location="../index.php";</script>';
            }

	//Expire the session if user is inactive for 2
	//minutes or more.
	$expireAfter = 30;



	//Check to see if our "last action" session
	//variable has been set.
	if(isset($_SESSION['last_action'])){
	    
	    //Figure out how many seconds have passed
	    //since the user was last active.
	    $secondsInactive = time() - $_SESSION['last_action'];
	    
	    //Convert our minutes into seconds.
	    $expireAfterSeconds = $expireAfter * 60;
	    
	    //Check to see if they have been inactive for too long.
	    if($secondsInactive >= $expireAfterSeconds){
	        //User has been inactive for too long.
	        //Kill their session.
	        session_unset();
	        session_destroy();
	        echo "<script> alert('La sesion caduco por inactividad, por favor inicie sesion nuevamente');window.location='../index.php';</script>";
           
	    }
	    
	}
	//Assign the current timestamp as the user's
	//latest activity
	$_SESSION['last_action'] = time();

	

	      
   }
}
?>
