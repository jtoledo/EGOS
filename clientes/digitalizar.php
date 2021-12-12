<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

require(CABECERA);


$con=conectarse();

if(isset($_POST["vdel"]))
{
	//si se activo el eliminar borramos resgistro
	$iddel=$_POST["vdel"];
	$sql="delete FROM expediente where id_archivo=$iddel";
	pg_query($con,$sql);
}
?>


<div id="contenido" align="center">

<?php 
$idcliente= $_GET["idcliente"];

if(isset($_POST["boton"]))
{
$idcliente=$_POST["idcliente"];
$idconcepto=$_POST["idconcepto"];
//datos del arhivo 
$nombre_archivo = $_FILES['archivo']['name']; 
$tipo_archivo = $_FILES['archivo']['type']; 
$tamano_archivo = $_FILES['archivo']['size']; 
$remoto = $_FILES['archivo']['tmp_name']; //nombre del archivo en la carpte atem de windows

//compruebo si las características del archivo son las que deseo 
if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 5242880))) { 
   	$mensaje.= "La extensi&oacute;n o el tama&ntilde;o de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 5 MB m&aacute;ximo.</td></tr></table>"; 
}else{ 
   			$directorio=$idcliente;
			$x=@mkdir("expediente/".$directorio,0777);
			
			$ruta="expediente/".$idcliente."/";
			$ruta = $ruta.$nombre_archivo;
				if(move_uploaded_file($remoto, $ruta))
				{
	
		$band=get_tipo_documento($idconcepto,$idcliente); 
					//echo $band;
					if($band!=1)
					{
	 $sql="INSERT INTO expediente (nombre_archivo,tipo_archivo,ubicacion,idcliente,idconcepto) VALUES ('$nombre_archivo','$tipo_archivo','$ruta','$idcliente','$idconcepto')";
					pg_query($con,$sql);
					 $mensaje.= "El archivo ha sido cargado correctamente."; 
					}
		 
  	}else{ 
      	 echo "Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse."; 
   	} 
} 

}
	
	
	
	
	
	
	
	
	
	
	
	
	
?>


<?php 


if(isset($mensaje)) { echo "<p>".$mensaje."</p>"; }


$fila=get_cliente($idcliente);
$nom_cliente=$fila["nombre"];
$a_paterno=$fila["ap_paterno"];
$a_materno=$fila["ap_materno"];
$nom_completo=$nom_cliente." ".$a_paterno." ".$a_materno;
$idcliente=$fila["idcliente"];

?>
<form action="digitalizar.php" method="post" enctype="multipart/form-data" name="form1" class="iform">
  <div align="center">
  <input type="hidden" name="MAX_FILE_SIZE" value="5242880"/>
  <input type="hidden" name="boton" value="1" />
  <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>" />
  <table width="736" border="0">
    <tr>
      <td colspan="3"><div align="left">
        <li class="iheader"><h2  class="art-logo-text">
        
          
          <?php
		  $img="<img src='../images/back.png' name='atras' alt='atras' align='absmiddle'> ";	
  	  
	  
	  echo"<a href=\"modif_productor.php?idcliente=".$idcliente."\" style=\"text-decoration:underline;cursor:pointer;\">"


.$img.


"</a>";
	 
echo "".nom($nom_completo); 		 
?>

</h2></li></div>	</td>
        </tr>
    
    <tr>
      <td width="89" height="44">Documento </td>
        <td width="236"><select name="idconcepto" id="idconcepto" class='iselect'>
          <option value="">Seleccione Documento</option>
          <?php
                     
					
                     $consulta_d="SELECT * FROM cc_conceptos_expediente order by concepto ";
                     $id_query_d = pg_query($con,$consulta_d);
                     while( $fila_d= pg_fetch_array($id_query_d) )
                        {  
						
						$idconcepto=$fila_d["idconcepto"];
						$concepto=$fila_d["concepto"];
						
						
					 $consulta="SELECT * FROM expediente where idcliente='$idcliente' and idconcepto='$idconcepto' ";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						
                         $bande=1;        
                        }
						
						if($bande!=1)
						print("<option value=\"$idconcepto\">".$concepto."</option>");
						$bande=2;
						}
						?>
          </select></td>
        <td width="397" rowspan="4"><?php include("documentos.php"); ?></td>
    </tr>
    <tr>
      <td height="37">Archivo</td>
        <td><input type="file" name="archivo"  class="itext"></td>
        </tr>
    <tr>
      <td>&nbsp;</td>
        <td><div align="center"><br /><br />
          <input type="submit" name="enviar" value="GUARDAR" class="ibutton" onclick="digitalizar_doc(); return false" >
        </div></td>
        </tr>
    <tr>
      <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
  </table>
  </div>
</form>


</div> 




<?php
include (FOOTER);  
?>
