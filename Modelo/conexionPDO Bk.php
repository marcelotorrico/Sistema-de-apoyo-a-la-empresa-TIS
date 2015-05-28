<?php  
class conexion{
	public $conn;

	function __construct(){
	    
	    $this->conectar();
	    
	}	
 
 public function conectar()
 {
 	global $conn;
 	try{

	 $conn = new PDO('mysql:host=localhost;dbname=saetis','root','');

	 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	

	}catch(PDOException $e){

	    echo "ERROR: " . $e->getMessage();
    
	}
	
   }
   public function consulta($consulta)
   {
   	global $conn;
   	  $sql = $conn->prepare($consulta);
	  $sql->execute();
	  $resultado = $sql->fetchAll();
	  return $resultado;
   }
   public function consultaP($consulta,$arrayy)
   {
   	global $conn;
   	  $sql = $conn->prepare($consulta);
	  $sql->execute($arrayy);
	  $resultado = $sql->fetchAll();
	  return $resultado;
   }
   
 }
  
?>