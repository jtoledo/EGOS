<?php
include("../includes/funciones.php");
include("../mysql/conexion.php");
$titulo="Agrega Usuario";
include(CABECERA);
?>

<?php
$id_empleado = preparar_consulta(htmlentities($_GET["id_empleado"],ENT_QUOTES,"UTF-8"));


$sql="SELECT * from empleado,perfiles where empleado.id_perfil=perfiles.id_perfil";
$consulta=mysql_query($sql);

	while($fila=mysql_fetch_array($consulta))
	{
	$nom_perfil=$fila["nom_perfil"];
	
	
	}


?>			
<form name="captura" action="" onSubmit="agrega_usua(); return false">
  <div align="center">
  <input type="hidden" name="id_usuario" value="<? echo $id_empleado; ?>" />
  <table >
    <tr>
      <td > Nombre del Usuario</td>
        <td><input type="text" name="user_name" size="20" maxlength="200" value="<? echo $user_name; ?>" id="user_name" onChange="conMayusculas(this)"/></td>
      </tr>
    <tr>
      <td >Password</td>
      <td ><input type="password" name="pass" size="20" maxlength="200" value="<? echo $pass; ?>" id="pass" onChange="conMayusculas(this)"/></td>
      </tr>
    <tr>
      <td >Perfil</td>
      <td ><input type="text" name="id_perfil" size="20" maxlength="200" value="<? echo $nom_perfil; ?>" id="ap_materno"  readonly="readonly"></td>
      </tr>
    
    <tr >
      <td colspan="2"><center>
        <input class="art-button" type="submit" name="enviar" id="enviar" value="AGREGAR" >               
        </center>      </td>
      </tr>
  </table>
  </div>
</form>
<div id="usua"></div>

 <?
$back=6;
include(FOOTER);

?>