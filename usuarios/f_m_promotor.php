<?php
if($modif!=1)
	{
$fila=get_promotor();
		 $a_paterno=$fila["ap_paterno"];
		 $a_materno=$fila["ap_materno"];
		 $nom_promo=$fila["nombre"];
		 $rfc=$fila["rfc"];
		 $curp=$fila["curp"];
		 $genero=$fila["masculino"];
		 $idcolonia=$fila["idcolonia"];
		 $idmunicipio=$fila["idmunicipio"];
		 $idestado=$fila["idestado"];
		 $idlocalidad=$fila["idlocalidad"];
		 $domicilio=$fila["domicilio"];
		 $codigo_postal=$fila["codigo_postal"];
	     $email=$fila["email"];
		 $f_nacimiento=$fila["f_nacimiento"];
		 $f_ingreso=$fila["f_ingreso"];
    	 $activo=$fila["activo"];
		 $telefono=$fila["telefono"];
		 $estado_civil=$fila["estado_civil"];
		 $dep_economico=$fila["dep_economico"];
		  $idpromotor=$fila["idpromotor"];
		  $uid=$fila["uid"];
	}
		

$fila_u=get_usuario($uid);

	
		$usuario_id=$fila_u["uid"];
		$nom_usuario=$fila_u["nombre"];
		$iniciales=$fila_u["iniciales"];
		//$perfil_id=$fila_u["id_perfil"];
		$usuario_nick=$fila_u["usuario"];
		$contra = sha1($fila_u["contra"]);
		
		$id_sucursales=$fila_u["id_sucursal"];
	


$dia=dia($f_nacimiento);
$mes=mes($f_nacimiento);
$ano=ano($f_nacimiento);





// echo "$dia-$mes-$ano";
?>



<form name="captura" action="" onSubmit="promotores_alta_egos(1); return false" class="formu">
  <div align="center">
    <input type="hidden" name="idpromotor" value="<? echo $idpromotor; ?>" />
    <input type="hidden" name="usuario_id" value="<? echo $usuario_id; ?>" />
    <table width="579" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td colspan="9"> <li class="iheader">
		 
		<h2 class="art-logo-text">
	ADMON PROMOTORES	</h2>
	</li></td>
      </tr>
      <tr>
        <td>
		<!--<form name="captura_cliente" action=""  class="iform">--></td>
        <td colspan="3">Nombre</td>
        <td><label for="YourName">Ap paterno </label></td>
        <td>Ap materno </td>
        <td colspan="3"><label for="YourName">
          <div align="center">F. Nac </div>
        </label></td>
      </tr>
      <tr>
        <td valign="bottom">
<span class="cliente">
		<select name="promotor_id" class="consultor" onchange="actualiza_promotor(1); return false">
          <option value="">Seleccione Promotor</option>
          <?php
		  
		  
		  $consulta_c="SELECT * FROM cc_promotores order by nombre ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
						$ap_paterno=$fila_c["ap_paterno"];
						$ap_materno=$fila_c["ap_materno"];
						$name=$fila_c["nombre"];
						$nombre_cliente=$name." ".$ap_paterno." ".$ap_materno;
						?>
          <option value="<?php echo $fila_c["idpromotor"]?>"><?php echo nom(utf8_decode($nombre_cliente)); ?></option>
          <?php
						
						}
		  
		  
	  ?>
        </select> </span>	</td>
        <td colspan="3" valign="bottom">

		  <input type="text" name="nombre" size="50" maxlength="200" value="<? echo $nom_promo; ?>" class="itext" onChange="conMayusculas(this)"></td>
        <td>

		  <input type="text" name="a_paterno" size="20" maxlength="15" id="a_paterno" value="<? echo $a_paterno; ?>" class="itext" onChange="conMayusculas(this)">		</td>
        <td valign="bottom" >
          <input type="text" name="a_materno" size="20" maxlength="50" value="<? echo $a_materno; ?>"  id="a_materno" class="itext" onChange="conMayusculas(this)">        </td>
        <td valign="bottom"><select name="dia" id="dia" >
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
        <td valign="bottom"><select name="mes" id="mes">
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
        <td valign="bottom"><select name="ano" id="ano">
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
        <td colspan="9"></td>
      </tr>
      <tr>
        <td width="300"><label for="YourName">G&eacute;nero</label></td>
      <td colspan="3">Rfc</td>
      <td width="133"><label for="YourName">Curp</label></td>
      <td width="120">Tel&eacute;fono</td>
      <td width="141" colspan="3"><div align="center">Estatus</div></td>
      </tr>
      <tr>
        <th><select name="genero" id="genero" class="iselect">
          <option value="">Seleccione Genero</option>
          <?php
                    
					 
                     $consulta="SELECT * FROM cc_promotores where idpromotor='$idpromotor' ";
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
      <td colspan="3"><input type="text" name="rfc" size="20" maxlength="50" value="<? echo $rfc; ?>"  id="rfc" onchange="conMayusculas(this)" class="itext" /></td>
      <th width="133"><input type="text" name="curp" size="20" maxlength="300" value="<? echo $curp; ?>" id="curp" class="itext" onchange="conMayusculas(this)" /></th>
      <td width="120"><input type="text" name="telefono" size="20" maxlength="200" value="<? echo $telefono; ?>"  id="telefono" class="itext" onkeypress="return acceptNum(event)" /></td>
      <th width="141" colspan="3"><select name="activo" id="activo" class="iselect">
        <option value="">Seleccione Estatus</option>
        <?php
                    
					 
                     $consulta="SELECT * FROM cc_promotores where idpromotor='$idpromotor' ";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$a=1;
						$b=0;
						
						$activo=$fila["activo"];
						if($activo=="t")
						{
						$resp="ACTIVO";
						print("<option value=\"$a\" selected=\"selected\">".$resp."</option>");
						print("<option value=\"$b\" >SUSPENDIDO</option>");
						}
						else
						{
						$resp="SUSPENDIDO";
						print("<option value=\"$b\" selected=\"selected\">".$resp."</option>");
						print("<option value=\"$a\" >ACTIVO</option>");
						}
						                                 
                        }
						?>
      </select></th>
    </tr>
      <tr>
        <td>Estado</td>
      <td width="120"><label for="YourName">Municipio</label></td>
      <td width="4" rowspan="2">&nbsp;</td>
      <td width="4" rowspan="2">&nbsp;</td>
      <td >Localidad <!--<div id="lo"></div>--></td>
      <td >Colonia<!--<div id="co"></div>--></td>
      <td colspan="2"><label for="YourName">
        <div align="center">C.P</div>
      </label></td>
      <td><div align="center">Dep economico</div></td>
      </tr>
      <tr>
        <th><?php generaSelect(); ?>		</th>
      
	  
	  <td width="120">
	 <div id="municipios">
	  <select  name="municipio" id="cc_municipios" class='iselect' onChange='carga_select(this.id)'>
						
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
	  <select name="localidad" id="cc_localidades" class='iselect' onChange='carga_select(this.id)'>
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
	<select  name="colonia" id="cc_colonias" class='iselect'>
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
     
	 
	 
	 
	  <th colspan="2"><div align="center">
	    <input type="text" name="codigo_postal" size="5" maxlength="10" value="<? echo $codigo_postal; ?>"  id="codigo_postal" class="peque" onkeypress="return acceptNum(event)" >
	    </div></th>
	  <th><div align="center">
	    <input type="text" name="dep_economico" size="20" maxlength="200" value="<? echo $dep_economico; ?>"  id="dep_economico" class="peque" onkeypress="return acceptNum(event)" />
	    </div></th>
      </tr>
      <tr>
        <td colspan="2"><label for="YourName"></label>          <label for="YourName">Domicilio</label></td>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td>
        <label for="YourName">Estado Civil</label></td>
      <td><label for="YourName9">Correo Electronico</label></td>
      <td colspan="2"><label for="YourName2">Fecha Ingreso </label></td>
      <td>Iniciales</td>
      </tr>
      <tr>
        <th colspan="2"><div align="left">
          <input type="text" name="domicilio" size="20" maxlength="200" value="<? echo $domicilio; ?>" id="domicilio" class="modif" onChange="conMayusculas(this)">
        </div></th>
      <th><select name="estado_civil" id="estado_civil" class="iselect" >
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
      <td><input type="text" name="email" size="20" maxlength="200" value="<? echo $email;  ?>"  id="email" onchange="if ( !this.value.match(/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/) ) { this.value = '' }" onfocus="if (this.value == '') this.value = '';" title="El Formato correcto es: nombre@dominio.servidor"; class="itext"  onblur="conMayusculas(this)" /></td>
      <td colspan="3"><input name="f_ingreso" type="text" id="dateArrivals" onclick="popUpCalendar(this, captura.dateArrivals, 'dd-mm-yyyy');"  value="<?php echo $f_ingreso; ?>" readonly="readonly" />
        <input type="text" name="iniciales" size="5" maxlength="10" value="<? echo $iniciales; ?>"  id="iniciales" class="peque"  onChange="conMayusculas(this)"></td>
    </tr>
      <tr>
        <td colspan="2" rowspan="2"><h2 class="art-logo-text">Datos De Conexion</h2></td>
      <td rowspan="3">&nbsp;</td>
      <td rowspan="3">&nbsp;</td>
      <td colspan="5"></td>
      </tr>
      <tr>
        <td colspan="5">&nbsp;</td>
      </tr>
      <tr>
        <th valign="top">Usuario</th>
      <td><strong>Contrase&ntilde;a</strong></td>
      <td><strong>Confirmar</strong></td>
      <td><strong>Sucursal</strong></td>
      <td colspan="3">&nbsp;</td>
    </tr>
      <tr>
        <td><input type="text" name="usuario" id="usuario" size="30" maxlength="30" value="<?php echo $usuario_nick; ?>" autocomplete="off" class="itext" /></td>
      <td><input type="text" name="contra" id="contra" size="30" maxlength="30" value="<?php echo $contra; ?>" autocomplete="off"  class="itext" /></td>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td><input type="text" name="contra2" id="contra2" size="30" maxlength="30" value="<?php echo $contra; ?>" autocomplete="off" class="itext" /></td>
      <td><?php get_sucursal_selec($id_sucursales); ?></td>
      <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td><div align="center"></div></td>
      <td colspan="3"><div align="center"></div></td>
    </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <div align="center"></div></td>
      <td><div align="right">
        <div align="right">
          <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
        </div>
      </div></td>
      <td colspan="3"><div align="right">
        <div align="right">
          <input class="ibutton" type="button" name="nuevo" id="enviare" value="AGREGAR"  onclick="actualiza_promotor(2); return false" />
        </div>
      </div></td>
    </tr>
      <tr>
        <td height="33">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
          
          <div align="center"></div></td>
        <td >
          <div align="right"></div></td><td colspan="3" >
          
          <div align="center"></div></td>
      </tr>
   </table>
  </div>
</form>
 