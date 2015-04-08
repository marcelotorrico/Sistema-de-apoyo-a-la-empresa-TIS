<?php 
 class Conexion extends PDO { 
   private $tipo_de_base = 'mysql';
  /* private $host = '192.168.2.5';
   private $nombre_de_base = 'tis_mbittle';
   private $usuario = 'mbittle';
   private $contrasena = '5rtZAGYq'; */
   private $host = 'localhost';
   private $nombre_de_base = 'saetis';
   private $usuario = 'root';
   private $contrasena = ''; 
   
   public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena);
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   } 
 } 
?>