<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$perfil_id = $_POST["perfil_id"];
$form = $_POST["form"];
$id_menu = $_POST["id_menu"];
$id_permiso = $_POST["id_permiso"];
$menu = $_POST["menu"];//id del menus
$cadena_orden = $_POST["cadena_orden"]; //ordenamiento del menu




$con=conectarse();

$errores = validar_campos_obligatorios(array($perfil_id,$form));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
	$row_perfil=get_perfil($perfil_id);
	$nom_perfil=$row_perfil["nombre_perfil"];
	$desc=$row_perfil["descripcion"];
	$perfil_id=$row_perfil["id_perfil"];
	$modif=1;  //valida que no se vuelva a consultar por defeto la tabla de usuarios
	?>
  <div class="left">
  <?php include("f_m_p.php"); ?>
  </div>
  <div class="right">
  <?php get_permisos_perfil($perfil_id); ?>
  </div>
	<?php
	}
	
	if($form==2)
	{
	$i_permiso="insert into perfiles_usr (id_perfil,id_menu) values ('$perfil_id','$id_menu')";
	$consulta_i=pg_query($con,$i_permiso);
	
		if($consulta_i>0)
		{
	$row_perfil=get_perfil($perfil_id);
	$nom_perfil=$row_perfil["nombre_perfil"];
	$desc=$row_perfil["descripcion"];
	$perfil_id=$row_perfil["id_perfil"];
	$modif=1;  //valida que no se vuelva a consultar por defeto la tabla de usuarios
	?>
  <div class="left">
  <?php include("f_m_p.php"); ?>
  </div>
  <div class="right">
  <?php get_permisos_perfil($perfil_id); ?>
  </div>
	<?php
		}
		else
		{
			echo 0;
		}
	
	}

	if($form==3)//ELIMINAMOS PERMISOS
	{
		
		
	$i_permiso="DELETE FROM perfiles_usr WHERE id='$id_permiso'";
	$consulta_i=pg_query($con,$i_permiso);
	
		if($consulta_i>0)
		{
	$row_perfil=get_perfil($perfil_id);
	$nom_perfil=$row_perfil["nombre_perfil"];
	$desc=$row_perfil["descripcion"];
	$perfil_id=$row_perfil["id_perfil"];
	$modif=1;  //valida que no se vuelva a consultar por defeto la tabla de usuarios
	?>
  <div class="left">
  <?php include("f_m_p.php"); ?>
  </div>
  <div class="right">
  <?php get_permisos_perfil($perfil_id); ?>
  </div>
	<?php
		}
		else
		{
			echo 0;
		}
	
	}


	
	if($form==4)
	{
	
		
	$ids_menu=explode(',',$menu);
	$ids_orden=explode(',',$cadena_orden);
	
	$ids_menu=array_filter($ids_menu);//quita cedenas vacias
	$ids_orden=array_filter($ids_orden);//quita cedenas vacias
	
	
	for($i=0;$i<count($ids_menu);$i++) //recorremos el arreglo del menu
	{
		
		$orden=$ids_orden[$i];
		$id_menu=$ids_menu[$i];
		
		if($orden==0)
		$orden="null";
		if($orden>0)
		$orden="'".$orden."'";


		
	$consulta_o="UPDATE mnu_egos SET orden=$orden WHERE id='$id_menu'";
	$resultado=pg_query($con,$consulta_o);
	
		
	}
	
	get_orden_menu();
	
	
	
	}




?>