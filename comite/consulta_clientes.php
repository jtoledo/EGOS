<?php
session_start();
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
require(CABECERA_MODAL);
$con=conectarse();

$idsolicitud=$_GET["idsolicitud"];
$solicitud=get_solicitud_m($idsolicitud);
$fila=get_cliente($solicitud["idcliente"]);
	



		 $nom_cliente=$fila["nombre"];
		 $a_paterno=$fila["ap_paterno"];
		 $a_materno=$fila["ap_materno"];
		 $rfc=$fila["rfc"];
		 $curp=$fila["curp"];
		 $fecha_nac=$fila["f_nac_const"]; 
		 $domicilio=$fila["domicilio"];
		 $cod_postal=$fila["codigo_postal"];
		 $genero=$fila["masculino"];
		 $idcolonia=$fila["idcolonia"];
		 $idmunicipio=$fila["idmunicipio"];
		 $idestado=$fila["idestado"];
		 $idlocalidad=$fila["idlocalidad"];
		 $ife=$fila["ife"];
		 $tel_fijo=$fila["telefono1"];
		 $tel_movil=$fila["telefono2"];
		 $email=$fila["email"];
		 $lugar_nac=$fila["lugar_nacimiento"];
		 $regimen_conyugal=$fila["regimen_conyugal"];
		 $nombre_conyugue=$fila["nombre_conyuge"];
		 $integrantes_familia=$fila["integrantes_familia"];
		 $f_registro=$fila["f_registro"];
		 $clv_fira=$fila["clv_fira"];
		 $clv_ha=$fila["clv_ha"];
		 $idcuenta=$fila["idcuenta"];
		 $idestrato=$fila["idestrato"];
		 $idcliente=$fila["idcliente"];
		 $id_tipo=$fila["id_tipo"];
		 $estado_civil=$fila["estado_civil"];
$dia=dia($fecha_nac);
$mes=mes($fecha_nac);
$ano=ano($fecha_nac);
?>
<form name="captura" action="" onSubmit="clientes_alta_egos(1); return false" class="formu">
  <div align="center">
    <input type="hidden" name="idcliente" value="<? echo $idcliente; ?>" />
    <table width="80%" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td>
		<!--<form name="captura_cliente" action=""  class="iform">--></td>
        <td colspan="3">Nombre</td>
        <td><label for="YourName">Ap paterno </label></td>
        <td>Ap materno </td>
        <td colspan="3"><label for="YourName">
          <div align="left">F. Nac </div>
        </label></td>
      </tr>
      <tr>
        <td colspan="4" valign="bottom">
          
        <input name="nombre" type="text" disabled="disabled" class="modif" onChange="conMayusculas(this)" value="<? echo $nom_cliente; ?>" size="50" maxlength="200"></td>
        <td>

		  <input name="a_paterno" type="text" disabled="disabled" class="itext" id="a_paterno" onChange="conMayusculas(this)" value="<? echo $a_paterno; ?>" size="20" maxlength="15">		</td>
        <td valign="bottom" >
          <input name="a_materno" type="text" disabled="disabled" class="itext"  id="a_materno" onChange="conMayusculas(this)" value="<? echo $a_materno; ?>" size="20" maxlength="50">        </td>
        <td valign="bottom"><select name="dia" id="dia" disabled="disabled" >
<option value="">dia</option>
<?php
for($i=01;$i<32;$i++)
{
if($dia==$i)
echo '<option value="'.$i.'" selected=selected>'.$i.'</option>';
else
echo '<option value="'.$i.'">'.$i.'</option>';

}
?>
</select></td>
        <td valign="bottom"><select name="mes" id="mes" disabled="disabled">
<option value="">mes</option>
<?php
for($i=01;$i<13;$i++)
{
if($mes==$i)
echo '<option value="'.$i.'" selected=selected>'.$i.'</option>';
echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
</select></td>
        <td valign="bottom"><select name="ano" id="ano" disabled="disabled">
<option value="">a&ntilde;o</option>
<?php
for($i=1930;$i<2013;$i++)
{
if($ano==$i)
echo '<option value="'.$i.'" selected=selected>'.$i.'</option>';
echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
</select></td>
      </tr>
      <tr>
        <td colspan="9"><li class="iheader"></li></td>
      </tr>
      <tr>
        <td width="300"><label for="YourName">G&eacute;nero</label></td>
      <td colspan="3">Rfc</td>
      <td width="133">Ife
        <label for="YourName"></label></td>
      <td width="120"><label for="YourName">Curp</label></td>
      <td width="141" colspan="3"><label for="YourName">Lugar Nac</label></td>
      </tr>
      <tr>
        <th><select name="genero" id="genero" class="iselect" disabled="disabled">
          <option value="">Seleccione Genero</option>
          <?php
                    
					 
                     $consulta="SELECT * FROM cc_clientes where idcliente='$idcliente' ";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$a=1;
						$b=0;
						
						$masculino=$fila["masculino"];
						if($masculino=="t")
						{
						$resp="MASCULINO";
						print("<option value=\"$a\" selected=\"selected\">".$resp."</option>");
						print("<option value=\"$b\" >FEMENINO</option>");
						}
						else
						{
						$resp="FEMENINO";
						print("<option value=\"$b\" selected=\"selected\">".$resp."</option>");
						print("<option value=\"$a\" >MASCULINO</option>");
						}
						                                 
                        }
						?>
        </select></th>
      <td colspan="3"><input name="rfc" type="text" disabled="disabled" class="itext"  id="rfc" onchange="conMayusculas(this)" value="<? echo $rfc; ?>" size="20" maxlength="50" /></td>
      <th width="133"><input name="ife" type="text" disabled="disabled" class="itext"  id="ife" onChange="conMayusculas(this)" value="<? echo $ife; ?>" size="20" maxlength="200"></th>
      <td width="120"><input name="curp" type="text" disabled="disabled" class="itext" id="curp" onChange="conMayusculas(this)" value="<? echo $curp; ?>" size="20" maxlength="300"></td>
      <th width="141" colspan="3"><input name="lugar_nac" type="text" disabled="disabled"  class="itext"  id="lugar_nac" onchange="conMayusculas(this)" value="<? echo $lugar_nac; ?>" size="20" maxlength="50" /></th>
    </tr>
      <tr>
        <td>Estado</td>
      <td width="120"><label for="YourName">Municipio</label></td>
      <td width="4" rowspan="2">&nbsp;</td>
      <td width="4" rowspan="2">&nbsp;</td>
      <td >Localidad <!--<div id="lo"></div>--></td>
      <td >Colonia<!--<div id="co"></div>--></td>
      <td colspan="3"><label for="YourName">Codigo Postal</label></td>
      </tr>
      <tr>
        <th><?php generaSelect_disabled(); ?>		</th>
      
	  
	  <td width="120">
	 <div id="municipios">
	  <select  name="municipio" id="cc_municipios" class='iselect' onChange='carga_select(this.id)' disabled="disabled">
						
						 <?php
                     
					 
                     $consulta="SELECT * FROM cc_municipios where idestado='$idestado'  ORDER BY municipio";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idmunicipio"];
						if($idmunicipio==$b)
						print("<option value=\"$b\" selected>".$fila["municipio"]."</option>");
						else
						print("<option value=\"$b\" >".$fila["municipio"]."</option>");
                                 
                        }
						?>
					</select>
	  </div>	  </td>
      <td>
	  <div id="localidades">
	  <select name="localidad" id="cc_localidades" class='iselect' onChange='carga_select(this.id)' disabled="disabled">
						<?php
                    
					 
$consulta="SELECT * FROM cc_localidades where idestado='$idestado' and idmunicipio='$idmunicipio' ORDER BY localidad";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idlocalidad"];
						if($idlocalidad==$b)
						print("<option value=\"$b\" selected>".$fila["localidad"]."</option>");
						else
						print("<option value=\"$b\" >".$fila["localidad"]."</option>");
                                 
                        }
						?>
					</select>
	 </div>	  </td>
	  
    <td>
	<div id="colonias">
	<select  name="colonia" id="cc_colonias" class='iselect' disabled="disabled">
						<?php
                    
					 
                     $consulta="SELECT * FROM cc_colonias where idestado='$idestado' and idmunicipio='$idmunicipio' and idlocalidad='$idlocalidad' ORDER BY colonia";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idcolonia"];
						if($idcolonia==$b)
						print("<option value=\"$b\" selected>".$fila["colonia"]."</option>");
						else
						print("<option value=\"$b\" >".$fila["colonia"]."</option>");
                                 
                        }
						?>
					</select>
	</div>	  </td>
     
	 
	 
	 
	  <th colspan="3"><input name="cod_postal" type="text" disabled="disabled" class="itext"  id="cod_postal" onkeypress="return acceptNum(event)" value="<? echo $cod_postal; ?>" size="5" maxlength="10" ></th>
    </tr>
      <tr>
        <td colspan="2"><label for="YourName"></label>          <label for="YourName">Domicilio</label></td>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td>
        <label for="YourName">Estado Civil</label></td>
      <td><label for="YourName">R&eacute;gimen Conyugal </label></td>
      <td colspan="3"><label for="YourName">Nombre del conyugue </label></td>
    </tr>
      <tr>
        <th colspan="2"><div align="left">
          <input name="domicilio" type="text" disabled="disabled" class="modif" id="domicilio" onChange="conMayusculas(this)" value="<? echo $domicilio; ?>" size="20" maxlength="200">
        </div></th>
      <th><select name="estado_civil" id="estado_civil" class="iselect" onChange='verifica_estado()' disabled="disabled">
        <option value="">Seleccione Estado civil</option>
        <?php
                    
					 
                     $consulta_es="SELECT * FROM cc_estado_civil  ORDER BY estado_civil";
                     $id_query_es = pg_query($con,$consulta_es);
                     while( $fila_es= pg_fetch_array($id_query_es) )
                        {  
						$stado=$fila_es["idestado"];
						if($estado_civil==$stado)
						print("<option value=\"$stado\" selected=\"selected\">".$fila_es["estado_civil"]."</option>");
						else
						print("<option value=\"$stado\" >".$fila_es["estado_civil"]."</option>");
						                                 
                        }
						?>
      </select></th>
      <td>
	
        <select name="regimen_conyugal" id="regimen_conyugal" class="iselect" disabled="disabled" >
          <option value="">Seleccione</option>
          <?php
                     
					 
                     $consulta="SELECT * FROM cc_regimen_conyugal  ORDER BY regimen";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idregimen"];
						if($regimen_conyugal==$b)
						print("<option value=\"$b\" selected='selected'>".$fila["regimen"]."</option>");
						else
						print("<option value=\"$b\" >".$fila["regimen"]."</option>");
                                 
                        }
						?>
        </select></td>
      <td colspan="3"><input name="nombre_conyugue" type="text" disabled="disabled" class="itext" id="nombre_conyugue" / onChange="conMayusculas(this)" value="<?php echo $nombre_conyugue; ?>" size="20" maxlength="15" <?php echo $disable; ?>></td>
    </tr>
      <tr>
        <td><label for="YourName"> Integrantes de Familia </label></td>
      <td><label for="YourName">Correo Electronico</label></td>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td><label for="YourName">Tel&eacute;fono celular</label></td>
      <td><label for="YourName">Tel&eacute;fono Fijo</label></td>
      <td colspan="3"><label for="YourName">Fecha Ingreso </label></td>
      </tr>
      <tr>
        <th><input name="integrantes" type="text" disabled="disabled" class="itext"  id="integrantes" onchange="conMayusculas(this)" value="<? echo $integrantes_familia; ?>" size="10" maxlength="50" /></th>
      <td><input name="email" type="text" disabled="disabled" class="itext"  id="email" title="El Formato correcto es: nombre@dominio.servidor" onfocus="if (this.value == '') this.value = '';"  onblur="conMayusculas(this)" onchange="if ( !this.value.match(/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/) ) { this.value = '' }" value="<? echo $email;  ?>" size="20" maxlength="200"; ></td>
      <td><input name="tel_movil" type="text" disabled="disabled" class="itext"  id="tel_movil" onkeypress="return acceptNum(event)" value="<? echo $tel_movil;  ?>" size="20" maxlength="200" /></td>
      <td><input name="tel_fijo" type="text" disabled="disabled" class="itext"  id="tel_fijo" onkeypress="return acceptNum(event)" value="<? echo $tel_fijo; ?>" size="20" maxlength="200" /></td>
      <td colspan="3"><input name="f_registro" type="text" disabled="disabled" id="dateArrivals" onclick="popUpCalendar(this, captura.dateArrivals, 'dd-mm-yyyy');"  value="<?php echo $f_registro; ?>" readonly="readonly" /></td>
    </tr>
      <tr>
        <td><label for="YourName">Tipo de Cliente</label></td>
      <td>Estrato</td>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td><label for="YourName">Cuenta Contable</label></td>
      <td><label for="YourName">Clave Fira</label></td>
      <td colspan="3"><label for="YourName">Clave Hacienda</label></td>
      </tr>
      <tr>
        <td><select name="id_tipo" id="id_tipo" class="iselect" disabled="disabled">
          <option value="">Seleccione Tipo de cliente</option>
          <?php
                    
					 
                     $consulta="SELECT * FROM tipo_cliente  ORDER BY nom_tipo";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["id_tipo"];
						//$resp=$fila["nom_estrato"];;
						if($id_tipo==$b)
						print("<option value=\"$b\" selected=\"selected\">".$fila["nom_tipo"]."</option>");
						else
						print("<option value=\"$b\" >".$fila["nom_tipo"]."</option>");
						                                 
                        }
						?>
        </select></td>
      <td><select name="idestrato" id="idestrato" class="iselect" disabled="disabled">
        <option value="">Seleccione Estrato</option>
        <?php
                    
					 
                     $consulta="SELECT * FROM estrato  ORDER BY nom_estrato";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idestrato"];
						$resp=$fila["nom_estrato"];;
						if($idestrato==$b)
						print("<option value=\"$b\" selected=\"selected\">".$resp."</option>");
						else
						print("<option value=\"$b\" >".$resp."</option>");
						                                 
                        }
						?>
      </select></td>
      <td><select name="id_cuenta" id="id_cuenta" class="iselect" disabled="disabled">
        <option value="">Seleccione Cuenta</option>
        <?php
                    
					 
                     $consulta="SELECT * FROM cuentas  ORDER BY clave_gral";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idcuenta"];
						$clave_gral=$fila["clave_gral"];
						$descripcion=$fila["descripcion"];
						$tipo=$fila["tipo"];
						
						
						$resp="$clave_gral $descripcion $tipo";
						if($idcuenta==$b)
						print("<option value=\"$b\" selected=\"selected\">".$resp."</option>");
						else
						print("<option value=\"$b\" >".$resp."</option>");
						                                 
                        }
						?>
      </select></td>
      <td><input name="clv_fira" type="text" disabled="disabled" class="itext"  id="clv_fira" onchange="conMayusculas(this)" value="<? echo $clv_fira; ?>" size="20" maxlength="50" /></td>
      <td colspan="3"><input name="clv_ha" type="text" disabled="disabled" class="itext"  id="clv_ha" onchange="conMayusculas(this)" value="<? echo $clv_ha; ?>" size="20" maxlength="50" /></td>
    </tr>
    </table>
  </div>
</form>
 <?php
include (FOOTER_MODAL);  
?>