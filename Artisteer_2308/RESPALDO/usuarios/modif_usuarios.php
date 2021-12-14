<?php
include("../includes/funciones.php");
include("../mysql/conexion.php");
$titulo="Edicion de Usuarios";
include(CABECERA);
?>
<?
if($_GET["id_usuario"])
{
$id_usuario = preparar_consulta(htmlentities($_GET["id_usuario"],ENT_QUOTES,"UTF-8"));
$sql="SELECT * from usuarios,perfiles where usuarios.id_usuario='$id_usuario' and perfiles.id_perfil=usuarios.id_perfil";
$consulta=mysql_query($sql);

	while($fila=mysql_fetch_array($consulta))
	{
	$user_name=$fila["user_name"];
	$pass=$fila["pass"];
	$id_perfil=$fila["id_perfil"];
	$nom_perfil=$fila["nom_perfil"];
	$id_usuario=$fila["id_usuario"];
	
	}

}
?>			

<form name="captura" action="" onSubmit="modif_usuario(); return false">
  <div align="center">
  <input type="hidden" name="id_usuario" value="<? echo $id_usuario; ?>" />
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
        <input class="art-button" type="submit" name="enviar" id="enviar" value="MODIFICAR" >               
        </center>      </td>
      </tr>
  </table>
  </div>
</form>
<div id="usua"></div>

<?
$back=4;
include(FOOTER);

?>
