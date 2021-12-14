<?
include("../includes/funciones.php");
include("../mysql/conexion.php");

$id_usuario = preparar_consulta(htmlentities($_POST["id_usuario"],ENT_QUOTES,"UTF-8"));
$user_name = preparar_consulta(htmlentities($_POST["user_name"],ENT_QUOTES,"UTF-8"));
$pass = preparar_consulta(htmlentities($_POST["pass"],ENT_QUOTES,"UTF-8"));
$enviar = preparar_consulta(htmlentities($_POST["enviar"],ENT_QUOTES,"UTF-8"));

	$consulta="SELECT id_perfil from empleado where id_empleado='$id_usuario' ";
                     	$id_query = mysql_query($consulta);
                     	while( $fila= mysql_fetch_array($id_query) )
                        {  
							
						$id_perfil=$fila["id_perfil"];
						
						}
	
	
	$fecha = time();
 $dia = date("d", $fecha);
 $mes = date("m", $fecha);
 $ano = date("Y", $fecha);
$fecha=$ano.'-'.$mes.'-'.$dia;
	
	
	if($enviar=="MODIFICAR")
	{
	
	$sql="UPDATE usuarios set user_name='$user_name',pass='$pass' where id_usuario='$id_usuario' ";
	$consulta=mysql_query($sql);
	if($consulta>0)
	echo "Modificacion exitosa";
	else
	echo "Error al modificar".mysql_error();

	}

	if($enviar=="AGREGAR")
	{
	//$id_usuario=1; ///  temporal recuperar usuario de la secion al estableserla 
	$sql="insert into usuarios values('$id_usuario','$user_name','$pass','$id_perfil','$fecha')";
	$consulta=mysql_query($sql);
	if($consulta>0)
	echo "Registro exitoso";
	else
	echo "Error en el registro".mysql_error();
	}





?>