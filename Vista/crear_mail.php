<?php
   
include '../Modelo/conexion.php';
$conectar = new conexion();
    
$addDestino = $_POST['dest'];
$addAsunto = $_POST['asunto'];
$addContenido = $_POST['area_info'];
$addFecha= $_POST['fec'];

//Inserttamos la foto en una carpeta

   session_start();
   $UsuarioActivo = $_SESSION['usuario'];
 

//conexion-------------		
    
	
	//Peticion
	$peticion1 = $conectar->consulta("SELECT `CORREO_ELECTRONICO_U` FROM `usuario` WHERE `NOMBRE_U`='$addDestino'"); 
        while ($correo = mysql_fetch_array($peticion1))
        {        
        $correo1=$correo["CORREO_ELECTRONICO_U"];}
	  
        
        
	


//cerrar conexion--------------------------

	 //volver a la pagina---------------
         
          $correo;
          $addFecha;
          $addContenido;
          $addAsunto;
          $addDestino;
          $correo1;
         
 
   
    require '../Vista/PHPMailerAutoload.php';
    require '../Vista/class.phpmailer.php';
    

        //Crear una instancia de PHPMailer
    $mail = new PHPMailer();
    //Definir que vamos a usar SMTP
    $mail->IsSMTP();
    //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
    // 0 = off (producción)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug  = 0;
    //Ahora definimos gmail como servidor que aloja nuestro SMTP
    $mail->Host       = 'smtp.gmail.com';
    //El puerto será el 587 ya que usamos encriptación TLS
    $mail->Port       = 587;
    //Definmos la seguridad como TLS
    $mail->SMTPSecure = 'tls';
    //Tenemos que usar gmail autenticados, así que esto a TRUE
    $mail->SMTPAuth   = true;
    //Definimos la cuenta que vamos a usar. Dirección completa de la misma
    $mail->Username   = "saetis.oficial@gmail.com";
    //Introducimos nuestra contraseña de gmail
    $mail->Password   = "saetis.oficial1";
    //Definimos el remitente (dirección y, opcionalmente, nombre)
    $mail->SetFrom('saetis.oficial@gmail.com', $UsuarioActivo);
    //Esta línea es por si queréis enviar copia a alguien (dirección y, opcionalmente, nombre)
    //$mail->AddReplyTo('replyto@correoquesea.com','El de la réplica');
    //Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
    $mail->AddAddress($correo1, $addDestino);
    //Definimos el tema del email
    $mail->Subject = 'Aceptacion de Registro';
    //Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
    //$mail->MsgHTML(file_get_contents('correomaquetado.html'), dirname(ruta_al_archivo));
    //
    //
    //
//    $mail->MsgHTML('El usuario '.$addDestino.''.$addDestino.' con direccion '.$correo1.' desea registrarse como '.$addDestino.' contraseña: '.$addDestino.'');
    $mail->MsgHTML(' Asunto   :  '.$addAsunto.'.Enviado el     :.'.$addFecha.'............. '.$addContenido.'');

//    
//    
//    
    //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
    $mail->AltBody = 'This is a plain-text message body';
    //Enviamos el correo
    if(!$mail->Send()) {
      echo"<script type=\"text/javascript\">alert('ERROR: mensaje no enviado intente nuevamente'); window.location='enviar_mail.php';</script>";
      
    } else {
        $peticion2 = $conectar->consulta("UPDATE `usuario` SET `ESTADO_E`='Habilitado' WHERE `NOMBRE_U`='$addDestino'");
        echo"<script type=\"text/javascript\">alert('el mensaje se envio exitosamente'); window.location='principal.php';</script>";
    }


?>
