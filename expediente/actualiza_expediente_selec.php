<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU

$idcliente = $_POST["idcliente"];
$form = $_POST["form"];
$idsolicitud = $_POST["idsolicitud"];
$valor = $_POST["valor"];
$estatus = $_POST["estatus"];
session_start();
$id_usuario=$_SESSION["usuario"];


$con=conectarse();

$errores = validar_campos_obligatorios(array($idcliente));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	   update_expediente_clientes($idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
	}
	if($form==2)
	{
	echo "<div id='bloque'>";
    get_datos_cliente($idsolicitud);
	  
		 echo "</div>";
		 $expediente=recupera_expediente($idsolicitud);
		 
		 $comprueba_comite=get_status_comite($idsolicitud);
		 
		  if($expediente!=0 and $comprueba_comite==1)
		  {
			get_tabla_detalles($expediente["idexpediente"],$idsolicitud);
		  }
		  else if($comprueba_comite==0)
		  {
			  get_tabla_detalles_consulta_comite($expediente["idexpediente"],$idsolicitud); //mostramos consulta
		  }
	}
	
	if($form==3)//cambia estado de original
	{
			echo "<div id='bloque'>";
			
			$estado=cambia_estado($valor,$estatus);
			
			if($estado==1)
			{
			
				get_datos_cliente($idsolicitud);
				  
					 echo "</div>";
					 $expediente=recupera_expediente($idsolicitud);
					  if($expediente!=0)
					  {
						get_tabla_detalles($expediente["idexpediente"],$idsolicitud);
					  }
			}
			else
			{return 0;}
			
	}
	
	if($form==4)//cambia estado de la copia
	{
			echo "<div id='bloque'>";
			
			$estado=cambia_estado_copia($valor,$estatus);
			
			if($estado==1)
			{
			
				get_datos_cliente($idsolicitud);
				  
					 echo "</div>";
					 $expediente=recupera_expediente($idsolicitud);
					  if($expediente!=0)
					  {
						get_tabla_detalles($expediente["idexpediente"],$idsolicitud);
					  }
			}
			else
			{return 0;}
			
	}		

	
	if($form==5)//envia a comite
	{
	echo "<div id='bloque'>";
    get_datos_cliente($idsolicitud);
	  
	 echo "</div>";
	 
	 $envia_comite=cambia_estado_sol($idsolicitud);
	 
		//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idsolicitud}','cc_solicitudes','A','{$usuario}',
				'El expediente fue enviado a comite');";
				$querytmp = pg_query($con,$sql);		 
	 
	 
		 $expediente=recupera_expediente($idsolicitud);
		  if($expediente!=0 and $envia_comite==1)
		  {
			get_tabla_detalles_consulta_comite($expediente["idexpediente"],$idsolicitud); //mostramos consulta
		  }
		  else
		  {
			  get_tabla_detalles($expediente["idexpediente"],$idsolicitud); //no c pudo agendar se manda a edicion
		  }
	}
	



?>
