<?php
//$ds          = DIRECTORY_SEPARATOR;  //Para no preocuparnos de la plataforma en la que se implemente
//require('registro.php');
//require('guardarDocumento.php');
session_start();

//$conexion = mysql_connect("192.168.2.5","mbittle","5rtZAGYq");
$conexion = mysql_connect("localhost","root","");
    //Control
    if(!$conexion){die('La conexion ha fallado por:'.mysql_error());}
   // mysql_select_db("tis_mbittle",$conexion);
     mysql_select_db("saetis",$conexion);
 
 $UsuarioActivo = $_SESSION['usuario'];

$rutaDirectorio = '../../Repositorio/asesor/';   //ruta de nuestro directorio
$asesor = $UsuarioActivo;    

    if(!file_exists($rutaDirectorio))
    {
    mkdir($rutaDirectorio, 0777);
    }
    if (!empty($_FILES)) {
    
    $tempFile = $_FILES['file']['tmp_name'];          //3             
    
    $targetPath = dirname( __FILE__ ) . $rutaDirectorio ;  //absolute path of the destination folder.
    $targetFile =  $targetPath. $_FILES['file']['name'];  //absolute path of the uploaded file destination.
    
    $subido = move_uploaded_file($tempFile,$targetFile); //6
    
       if ($subido) {
               
                $nombre = $_FILES['file']['name'];
                $new_ruta="/Repositorio/asesor/".$nombre;
                $tamanio =(integer) $_FILES['file']['size'];
                date_default_timezone_set('America/La_Paz');
                $fecha=  date('Y-m-d');
                $hora=  date("G:H:i");

                
                $comentario_add = mysql_query("INSERT INTO registro (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R) VALUES ('$asesor','documento subido','Habilitado','$nombre','$fecha','$hora')")or
            die("Error al s");

            $query= mysql_query("SELECT MAX(ID_R) AS 'ID_R' FROM registro");
 if ($row = mysql_fetch_row($query)) 
 {
   $id = trim($row[0]);
 }
 //var_dump($row);
 echo $id;
 $guardar_doc = mysql_query("INSERT INTO documento (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D)
        VALUES('$id','1024','$new_ruta',TRUE,TRUE)");
               // $registro= new Registro($asesor,'documento subido','habilitado',$nombre,$fecha,$hora);
               // $idRegistro = $registro->getIdRegistro();
               // $documento = new GuardarDocumento($idRegistro,$tamanio,$rutaDocumento,TRUE,TRUE);
                


                
        }
    }

?>    
 