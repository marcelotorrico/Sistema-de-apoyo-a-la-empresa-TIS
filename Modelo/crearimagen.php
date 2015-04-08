<?php 
/**
* Esta clase nos permitira mostrar los documentos publicados y sus tipo
*/
require_once('conexion_pd.php');
class Recurso
{

	private $tipo;
	private $nombre;
	private $ruta;
	private $usuario;
	private $gestion;
	private $conexion;
	private $mapeoTipo ;
	private $mapeoIcono;
	private $mapeoDescripcion;
	private $mapeoRuta;
	private $mapeoPropiedades;
	private $matriz;

	public function __construct($usuario)
	{
		$this->conexion = new Conexion();
		$this->usuario = $usuario;
		
		
		

	}
	
	/**
	*Obtener nombre y tipo de recurso
	*/
	public function obtenerTipo()
	{
		$sql = "SELECT d.RUTA_D,r.NOMBRE_R  
			    FROM documento as d, registro as r 
			    WHERE r.NOMBRE_U = '$this->usuario' AND r.TIPO_T = 'publicaciones' AND r.ID_R = d.ID_R ";
		
		$stmt = $this->conexion->query($sql);
		$result = $stmt->fetchAll();
		$indice = 0;
		foreach ($result as $row) {

			$nombre = $row['NOMBRE_R'];
			$ruta   = $row['RUTA_D'];
			$tipo  =substr($ruta, -3);
			$this->mapeoTipo[] =$tipo;
		}
		return $this->mapeoTipo;
	//var_dump($this->mapeoTipo);
		
	}



	/**
	* Obtener nombre e ruta para los icono de un recurso
	*/

	
	
	public function obtenerPropiedades()
	{
		$sql = "SELECT d.RUTA_D,r.NOMBRE_R, ds.DESCRIPCION_D 
			    FROM documento as d, registro as r,descripcion as ds 
			    WHERE r.NOMBRE_U = '$this->usuario' AND r.TIPO_T = 'publicaciones' AND r.ID_R=ds.ID_R AND d.ID_R = r.ID_R";
		 
		$stmt = $this->conexion->query($sql);
		$result = $stmt->fetchAll();
		$this->matriz =$result;
		$indice= 0;
		
		return $this->matriz;
		 
     }

     public function imprimir(){
     	$lista = $this->obtenerPropiedades();
     	foreach($lista as $key) {
		    
		  echo 'Nombre >>'  .$lista['nombre']. ' RUTA >> ' .$lista['ruta'].'descripcion >> '.$lista['descripcion'].'Icono>>'.$lista['icono'].'<br>';
		 }
     }


}	
$recursos = new Recurso('leticia');
$recursos->obtenerPropiedades();

 