<?php
include '../Modelo/conexionPDO.php';
$conect = new Conexion();
$noticia = $_GET['id'];


$delComen = $conect->query("DELETE FROM comentarios WHERE   ID_N= '$noticia'");
$delNoti = $conect->query("DELETE FROM noticias WHERE   ID_N= '$noticia'");


?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

alert ("Tema eliminado con exito.")

</SCRIPT>
<script>
  location.href="../Vista/lista-de-noticias.php";
</script>