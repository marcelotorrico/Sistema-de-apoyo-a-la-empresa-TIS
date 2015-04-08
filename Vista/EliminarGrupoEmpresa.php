<?php  

include '../Modelo/conexion.php';
$conect = new conexion();
$GrupoE = $_GET['id_us'];

$Sel_Reg = $conect->consulta("SELECT ID_R FROM registro WHERE NOMBRE_U='$GrupoE'");
$Reg_GE = mysql_fetch_row($Sel_Reg);

if(isset($_GET['op']))
{
	$accion = $_GET['op'];

	if($accion == 'si')
	{
  
		 $Sel_NomL=$conect->consulta("SELECT NOMBRE_LARGO_GE FROM grupo_empresa WHERE NOMBRE_U='$GrupoE'");
         $Nom_Largo = mysql_fetch_array($Sel_NomL);
		 $SelIdRec =$conect->consulta("SELECT ID_R FROM `receptor` WHERE RECEPTOR_R ='$Nom_Largo[0]'");
		 $Id_Recep=mysql_num_rows($SelIdRec);

		if($Id_Recep>0){

		    while( $Id_Recep=mysql_fetch_array($SelIdRec))
			{
				$id=$Id_Recep[0];

                $Del_Desc=$conect->consulta(" DELETE FROM `descripcion` WHERE ID_R='$id'");
                $Del_Doc=$conect->consulta(" DELETE FROM `documento` WHERE ID_R='$id'");
                $Del_Per = $conect->consulta("DELETE FROM periodo WHERE ID_R = '$id' ");
                $Del_Recep = $conect->consulta("DELETE FROM receptor WHERE ID_R = '$id' ");
                $Del_Reg = $conect->consulta("DELETE FROM registro WHERE ID_R = '$id' ");
    
			}
		}

	
		$Sel_Id_F = $conect->consulta("SELECT ID_N FROM nota WHERE NOMBRE_U='$GrupoE'"); 
		$Id_Form = mysql_fetch_row($Sel_Id_F);
		$Del_Punt = $conect->consulta("DELETE FROM puntaje_ge WHERE ID_N = '$Id_Form[0]'");
		$Del_Nota = $conect->consulta("DELETE FROM nota WHERE NOMBRE_U = '$GrupoE' ");
		$Del_NotaF = $conect->consulta("DELETE FROM nota_final WHERE NOMBRE_U = '$GrupoE' ");

        $Sel_RegG = $conect->consulta("SELECT ID_R FROM registro WHERE NOMBRE_U='$GrupoE'");
        
        while ($Row_Reg = mysql_fetch_row($Sel_RegG))
        {
             
            $Del_DocG = $conect->consulta("DELETE FROM documento WHERE ID_R = '$Row_Reg[0]' ");
            $Del_FR = $conect->consulta("DELETE FROM fecha_realizacion WHERE ID_R='$Row_Reg[0]'");
            $Del_Entr = $conect->consulta("DELETE FROM entrega WHERE ID_R='$Row_Reg[0]'");
            $Del_Asis = $conect->consulta("DELETE FROM asistencia WHERE ID_R='$Row_Reg[0]'");
            $Del_Pago = $conect->consulta("DELETE FROM pago WHERE ID_R='$Row_Reg[0]'");
            $Del_Rep = $conect->consulta("DELETE FROM reporte WHERE ID_R='$Row_Reg[0]'");
            $Del_Eval = $conect->consulta("DELETE FROM evaluacion WHERE ID_R='$Row_Reg[0]'");
        }
      
		$Del_RegG = $conect->consulta("DELETE FROM registro WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Prec = $conect->consulta("DELETE FROM precio WHERE NOMBRE_U='$GrupoE'");
		$Del_Eble = $conect->consulta("DELETE FROM entregable WHERE NOMBRE_U='$GrupoE'");
		$Del_Plan = $conect->consulta("DELETE FROM planificacion WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Com = $conect->consulta("DELETE FROM comentarios WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Noti = $conect->consulta("DELETE FROM noticias WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Insc = $conect->consulta("DELETE FROM inscripcion WHERE NOMBRE_UGE = '$GrupoE' ");
		$Del_InsP = $conect->consulta("DELETE FROM inscripcion_proyecto WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Ses = $conect->consulta("DELETE FROM sesion WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Soc = $conect->consulta("DELETE FROM socio WHERE NOMBRE_U = '$GrupoE' ");
		$Del_GE =$conect->consulta("DELETE FROM grupo_empresa WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Rol = $conect->consulta("DELETE FROM usuario_rol WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Us = $conect->consulta("DELETE FROM usuario WHERE NOMBRE_U = '$GrupoE' ");

		eliminDir("../Repositorio/".$GrupoE."");

		echo '<script>alert("Se elimino la grupo empresa correctamente!!")</script>';
		echo '<script>window.location="../Vista/ListaGrupoEmpresas.php";</script>';
	}

	else
	{
		if($accion == 'no')
		{
			header('location:../Vista/ListaGrupoEmpresas.php');
		}
	}

	

}
else
{
	if(is_array($Reg_GE))
	{
		echo '<script>
				var pagina =  "EliminarGrupoEmpresa.php?id_us='.$GrupoE.'&op=si"
				var pagina2 = "EliminarGrupoEmpresa.php?id_us='.$GrupoE.'&op=no"
				if(confirm("La grupo empresa tiene registros...desea eliminarla de todas formas??"))
				{

					location.href = pagina
				}
				else{

					location.href = pagina2
				}
			  </script>';


	}
	else
	{

	
		$Del_Plan = $conect->consulta("DELETE FROM planificacion WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Com = $conect->consulta("DELETE FROM comentarios WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Noti = $conect->consulta("DELETE FROM noticias WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_InsP = $conect->consulta("DELETE FROM inscripcion_proyecto WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_Ins = $conect->consulta("DELETE FROM inscripcion WHERE NOMBRE_UGE = '$GrupoE' ");
	    $Del_Ses = $conect->consulta("DELETE FROM sesion WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_Soc = $conect->consulta("DELETE FROM socio WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_GE = $conect->consulta("DELETE FROM grupo_empresa WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_Rol = $conect->consulta("DELETE FROM usuario_rol WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_Us = $conect->consulta("DELETE FROM usuario WHERE NOMBRE_U = '$GrupoE' ");

		echo '<script>alert("Se elimino la grupo empresa correctamente!!")</script>';
		echo '<script>window.location="../Vista/ListaGrupoEmpresas.php";</script>';

	}

}

?>	

<?php  

	function eliminDir($carpeta)
	{
		foreach(glob($carpeta . "/*") as $archivos_carpeta)
		{
		 
			if (is_dir($archivos_carpeta))
			{
				eliminDir($archivos_carpeta);
			}
			else
			{
				unlink($archivos_carpeta);
			}
		}


		rmdir($carpeta);
	}

?>