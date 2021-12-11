<?php 
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
$con=conectarse();

$tabla=$_POST["tabla"];

if($_POST["campo"]!="")
{
if($tabla=="cc_estados")
getMunicipios();
if($tabla=="cc_municipios")
getLocalidades();
if($tabla=="cc_localidades")
getColonias();
if($tabla=="cc_ptrequerimientos")
getRequerimientos();

}






	function getMunicipios(){
		
		global $con;
		$idestado=$_POST["campo"];
	$consulta=pg_query($con,"SELECT * FROM cc_municipios where idestado='$idestado' order by municipio");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='municipio' id='cc_municipios' onChange='carga_select(this.id)' class='iselect'>";
	echo "<option value=''>Elige</option>";
	while($registro=pg_fetch_array($consulta))
	{
		echo "<option value='".$registro["idmunicipio"]."'>".$registro["municipio"]."</option>";
	}
	echo "</select>";
		
		
	}
	function getLocalidades(){
		global $con;
		$idmunicipio=$_POST["campo"];
	$consulta=pg_query($con,"SELECT * FROM cc_localidades where idmunicipio='$idmunicipio' order by localidad");
	//desconectar();



  


	// Voy imprimiendo el primer select compuesto por los paises
	echo "<span class='cliente'><select name='localidad' id='cc_localidades' onChange='carga_select(this.id)' class='consultor'>";
	echo "<option value=''>Elige</option>";
	while($registro=pg_fetch_array($consulta))
	{
		echo "<option value='".$registro["idlocalidad"]."'>".$registro["localidad"]."</option>";
	}
	echo "</select></span>";
		
	/*$img=' <img src="../images/add.png" align="absmiddle" >';	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"add_localidad_modif('".$idmunicipio."')\" >".$img."</a>"; 
	*/	
	}
	
	
	function getColonias(){
		global $con;
		$idlocalidad=$_POST["campo"];
	$consulta=pg_query($con,"SELECT * FROM cc_colonias where idlocalidad='$idlocalidad' order by colonia");
	//desconectar();





	// Voy imprimiendo el primer select compuesto por los paises
	echo "<span class='cliente'><select name='colonia_aux' id='cc_colonias_aux'  class='consultor'>";
	echo "<option value=''>Elige</option>";
	while($registro=pg_fetch_array($consulta))
	{
		echo "<option value='".$registro["idcolonia"]."'>".$registro["colonia"]."</option>";
	}
	echo "</select></span>";
		
	/*$img=' <img src="../images/add.png" align="absmiddle">';	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"add_colonia_modif('".$idlocalidad."')\" >".$img."</a>";	
		*/
	}
	
	
	
	function getRequerimientos(){
		global $con;
		$idproceso=$_POST["campo"];
	
	$fila=get_requerimiento_proceso($idproceso);
	$idrequerimiento=$fila["idrequerimiento"];
	
	
//	$num=pg_num_rows($consulta); 
		
		
		if($fila==0)
		{
		 //$form=2;
		include("requerimiento_new.php");
		//echo "no hubieron datos";
		
		}
		else
		{
		 $modif=1;
		include("requerimiento_m.php");
		
		}
		
		
		
		
		
	}
	
	
	
?>