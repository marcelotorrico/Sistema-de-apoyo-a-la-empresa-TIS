<?php  

include '../conexionPDO.php';
$conect = new Conexion();
$GrupoE = $_GET['id_us'];

$Sel_Reg = $conect->query("SELECT ID_R FROM registro WHERE NOMBRE_U='$GrupoE'");
$Reg_GE = $Sel_Reg->fetch(PDO::FETCH_NUM);

if(isset($_GET['op']))
{
	$accion = $_GET['op'];

	if($accion == 'si')
	{
  
		 $Sel_NomL=$conect->query("SELECT NOMBRE_LARGO_GE FROM grupo_empresa WHERE NOMBRE_U='$GrupoE'");
         $Nom_Largo = $Sel_NomL->fetch(PDO::FETCH_NUM);
		 $SelIdRec =$conect->query("SELECT ID_R FROM `receptor` WHERE RECEPTOR_R ='$Nom_Largo[0]'");
		 $Id_Recep= $SelIdRec->rowCount();

		if($Id_Recep>0){

		    while( $Id_Recep=$SelIdRec->fetch(PDO::FETCH_NUM))
			{
				$id=$Id_Recep[0];

                $Del_Desc=$conect->query(" DELETE FROM `descripcion` WHERE ID_R='$id'");
                $Del_Doc=$conect->query(" DELETE FROM `documento` WHERE ID_R='$id'");
                $Del_Per = $conect->query("DELETE FROM periodo WHERE ID_R = '$id' ");
                $Del_Recep = $conect->query("DELETE FROM receptor WHERE ID_R = '$id' ");
                $Del_Reg = $conect->query("DELETE FROM registro WHERE ID_R = '$id' ");
    
			}
		}

	
		$Sel_Id_F = $conect->query("SELECT ID_N FROM nota WHERE NOMBRE_U='$GrupoE'"); 
		$Id_Form = $Sel_Id_F->fetch(PDO::FETCH_NUM);
		$Del_Punt = $conect->query("DELETE FROM puntaje_ge WHERE ID_N = '$Id_Form[0]'");
		$Del_Nota = $conect->query("DELETE FROM nota WHERE NOMBRE_U = '$GrupoE' ");
		$Del_NotaF = $conect->query("DELETE FROM nota_final WHERE NOMBRE_U = '$GrupoE' ");

        $Sel_RegG = $conect->query("SELECT ID_R FROM registro WHERE NOMBRE_U='$GrupoE'");
        
        while ($Row_Reg = $Sel_RegG->fetch(PDO::FETCH_NUM))
        {
             
            $Del_DocG = $conect->query("DELETE FROM documento WHERE ID_R = '$Row_Reg[0]' ");
            $Del_FR = $conect->query("DELETE FROM fecha_realizacion WHERE ID_R='$Row_Reg[0]'");
            $Del_Entr = $conect->query("DELETE FROM entrega WHERE ID_R='$Row_Reg[0]'");
            $Del_Asis = $conect->query("DELETE FROM asistencia WHERE ID_R='$Row_Reg[0]'");
            $Del_Pago = $conect->query("DELETE FROM pago WHERE ID_R='$Row_Reg[0]'");
            $Del_Rep = $conect->query("DELETE FROM reporte WHERE ID_R='$Row_Reg[0]'");
            $Del_Eval = $conect->query("DELETE FROM evaluacion WHERE ID_R='$Row_Reg[0]'");
        }
      
		$Del_RegG = $conect->query("DELETE FROM registro WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Prec = $conect->query("DELETE FROM precio WHERE NOMBRE_U='$GrupoE'");
		$Del_Eble = $conect->query("DELETE FROM entregable WHERE NOMBRE_U='$GrupoE'");
		$Del_Plan = $conect->query("DELETE FROM planificacion WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Com = $conect->query("DELETE FROM comentarios WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Noti = $conect->query("DELETE FROM noticias WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Insc = $conect->query("DELETE FROM inscripcion WHERE NOMBRE_UGE = '$GrupoE' ");
		$Del_InsP = $conect->query("DELETE FROM inscripcion_proyecto WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Ses = $conect->query("DELETE FROM sesion WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Soc = $conect->query("DELETE FROM socio WHERE NOMBRE_U = '$GrupoE' ");
		$Del_GE =$conect->query("DELETE FROM grupo_empresa WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Rol = $conect->query("DELETE FROM usuario_rol WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Us = $conect->query("DELETE FROM usuario WHERE NOMBRE_U = '$GrupoE' ");

		eliminDir("../Repositorio/".$GrupoE."");

		echo '<script>alert("Se elimino la grupo empresa correctamente!!")</script>';
		echo '<script>window.location="../../Vista/ListaGrupoEmpresas.php";</script>';
	}

	else
	{
		if($accion == 'no')
		{
			header('location:../../Vista/ListaGrupoEmpresas.php');
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
		$Del_Plan = $conect->query("DELETE FROM planificacion WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Com = $conect->query("DELETE FROM comentarios WHERE NOMBRE_U = '$GrupoE' ");
		$Del_Noti = $conect->query("DELETE FROM noticias WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_InsP = $conect->query("DELETE FROM inscripcion_proyecto WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_Ins = $conect->query("DELETE FROM inscripcion WHERE NOMBRE_UGE = '$GrupoE' ");
	    $Del_Ses = $conect->query("DELETE FROM sesion WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_Soc = $conect->query("DELETE FROM socio WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_GE = $conect->query("DELETE FROM grupo_empresa WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_Rol = $conect->query("DELETE FROM usuario_rol WHERE NOMBRE_U = '$GrupoE' ");
	    $Del_Us = $conect->query("DELETE FROM usuario WHERE NOMBRE_U = '$GrupoE' ");

		echo '<script>alert("Se elimino la grupo empresa correctamente!!")</script>';
		echo '<script>window.location="../../Vista/ListaGrupoEmpresas.php";</script>';

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