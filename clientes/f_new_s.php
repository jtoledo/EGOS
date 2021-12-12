<?php
if($modif!=1)
	{
	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes  order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno))";
	   $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
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
		 //$id_agrupacion=$fila["id_agrupacion"];
		 $ife=$fila["ife"];
		 $tel_fijo=$fila["telefono1"];
		 $tel_movil=$fila["telefono2"];
		 $email=$fila["email"];
		// $tipo_cliente=$fila["tipo_cliente"];
		 $lugar_nac=$fila["lugar_nacimiento"];
		 $regimen_conyugal=$fila["regimen_conyugal"];
		 $nombre_conyugue=$fila["nombre_conyuge"];
		 $integrantes_familia=$fila["integrantes_familia"];
		 $f_registro=$fila["f_registro"];
		 $clv_fira=$fila["clv_fira"];
		 $clv_ha=$fila["clv_ha"];
		  $idcuenta=$fila["idcuenta"];
		  $idestrato=$fila["idestrato"];
		  $tipo_cliente= $fila["tipo_cliente"];
		  $idcliente=$fila["idcliente"];
		   $id_tipo=$fila["id_tipo"];
		    $estado_civil=$fila["estado_civil"];
			$num_productor=$fila["num_productor"];
		}
		
	
	}


$dia=dia($fecha_nac);
$mes=mes($fecha_nac);
$ano=ano($fecha_nac);



?>








<form name="captura" action="" onSubmit="clientes_alta_egos(2); return false" class="formu">

  
  <div align="center">
     <table width="700px" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td ></td>
        <td colspan="3">*Nombre</td>
        <td><label for="YourName">*Ap paterno </td>
        <td><label for="YourName">*Ap materno </label></td>
        <td colspan="3"><label for="YourName">*F. Nac</label></td>
        
      </tr>
      <tr>
        <td valign="bottom">
<span class="cliente">
		<select name="cliente_id" class="consultor" onchange="actualiza_cliente(1); return false">
          <option value="">Seleccione Cliente</option>
          <?php
		  
		  
		  $consulta_c="SELECT * FROM cc_clientes order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)) ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
						$ap_paterno=$fila_c["ap_paterno"];
						$ap_materno=$fila_c["ap_materno"];
						$name=$fila_c["nombre"];
						$nombre_cliente=$name." ".$ap_paterno." ".$ap_materno;
						?>
          <option value="<?php echo $fila_c["idcliente"]?>"><?php echo nom(utf8_decode($nombre_cliente)); ?></option>
          <?php
						
						}
		  
		  
	  ?>
        </select> </span>	</td>
        <td valign="bottom" colspan="3">

		  <input type="text" name="nombre" size="50" maxlength="200" value="" class="itext" onChange="conMayusculas(this)"></td>
        <td valign="bottom">

		  <input type="text" name="a_paterno" size="20" maxlength="15" id="a_paterno" value="" class="itext" onChange="conMayusculas(this)">		</td>
        <td valign="bottom">
          <input type="text" name="a_materno" size="20" maxlength="50" value=""  id="a_materno" class="itext" onChange="conMayusculas(this)">       
         
          </td>
        <td valign="bottom" colspan="3" width="400px">
        <select name="dia" id="dia" style="width:43px" >
          <option value="">dia</option>
          <?php
				for($i=1;$i<32;$i++)
				{
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			 ?>
        </select>
     
       <select name="mes" id="mes" style="width:53px">
          <option value="">mes</option>
          <?php
				for($i=1;$i<13;$i++)
				{
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			?>
       </select>
   
        <select name="ano" id="ano" style="width:58px">
          <option value="">a&ntilde;o</option>
          <?php
				for($i=1900;$i<2015;$i++)
				{
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			?>
        </select>
     </td>
     
     
      </tr>
     
       <td colspan="9"><li class="iheader"></li></td>
      <tr>
        <td ><label for="YourName">*G&eacute;nero</label></td>
      <td colspan="3">*Rfc</td>
      <td width="100">*Ife
        <label for="YourName"></label></td>
      <td width="100"><label for="YourName">*Curp</label></td>
      <td width="241" colspan="4"><label for="YourName">*Lugar Nac</label></td>
      </tr>
      <tr>
        <td height="40px" ><select name="genero" id="genero" class="iselect">
          <option value="">Seleccione Genero</option>
          <option value="1">MASCULINO</option>
          <option value="0">FEMENINO</option>
        </select></td>
      <td colspan="3"><input type="text" name="rfc" size="20" maxlength="50" value=""  id="rfc" onchange="conMayusculas(this)" class="itext" /></td>
      <td width="100"><input type="text" name="ife" size="20" maxlength="200" value=""  id="ife" class="itext" onChange="conMayusculas(this)"></td>
      <td width="100"><input type="text" name="curp" size="20" maxlength="300" id="curp" class="itext" onChange="conMayusculas(this)"></td>
      <td width="241"><input type="text" name="lugar_nac" size="60" maxlength="50"  id="lugar_nac" onchange="conMayusculas(this)"  class="itext" /></td>
    </tr>
      <tr>
        <td>*Estado</td>
      <td width="120"><label for="YourName">*Municipio</label></td>
      <td width="0" rowspan="2">&nbsp;</td>
      <td width="0" rowspan="2">&nbsp;</td>
      <td>*Localidad        </td>
      <td>*Colonia        </td>
      <td colspan="3"><label for="YourName">*Codigo Postal</label></td>
      </tr>
      <tr>
        <th><?php generaSelect_new(); ?></th>
      <td width="120"> <div id="municipios">
	  <select  name="municipio" id="cc_municipios" class='iselect' onChange='carga_select(this.id)'>
	  <option value=''>Elige</option>
						
						
					</select>
	  </div></td>
      <td><div id="localidades">
	  <select name="localidad" id="cc_localidades" class='peque' style="width:150px" onChange='carga_select(this.id)'>
	  <option value=''>Elige</option>
						
			</select>
	  
      </div></td>
	  
    <td><div id="colonias">
	<select  name="colonia" id="cc_colonias" style="width:150px" class='peque'>
	<option value=''>Elige</option>
						
			</select>
					
	
    </div></td>
      <th><input type="text" name="cod_postal" size="5" maxlength="10" value=""  id="cod_postal" class="itext" onkeypress="return acceptNum(event)" ></th>
      </tr>
      <tr>
        <td colspan="2"><label for="YourName"></label>          <label for="YourName">*Domicilio</label></td>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td>
        <label for="YourName">*Estado Civil</label></td>
      <td><label for="YourName">*R&eacute;gimen Conyugal </label></td>
      <td colspan="3"><label for="YourName">Nombre del conyugue </label></td>
    </tr>
      <tr>
        <th colspan="2"><div align="left">
          <input type="text" name="domicilio" size="20" maxlength="200" value="" id="domicilio" class="modif" onChange="conMayusculas(this)">
        </div></th>
      <th><select name="estado_civil" id="estado_civil" class="iselect" onChange='verifica_estado()'>
        <option value="">Seleccione Estado civil</option>
        <?php
                    
					 
                     $consulta_es="SELECT * FROM cc_estado_civil  ORDER BY estado_civil";
                     $id_query_es = pg_query($con,$consulta_es);
                     while( $fila_es= pg_fetch_array($id_query_es) )
                        {  
						$stado=$fila_es["idestado"];
						
						print("<option value=\"$stado\" >".$fila_es["estado_civil"]."</option>");
						                                 
                        }
						?>
      </select></th>
      <td>
        <select name="regimen_conyugal" id="regimen_conyugal" class="iselect" disabled="disabled"  >
          <option value="">Seleccione</option>
          <?php
                     
					 
                     $consulta="SELECT * FROM cc_regimen_conyugal  ORDER BY regimen";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idregimen"];
						
						print("<option value=\"$b\" >".$fila["regimen"]."</option>");
                                 
                        }
						?>
        </select></td>
      <td colspan="3"><input type="text" name="nombre_conyugue" size="20" maxlength="15" id="nombre_conyugue" value="" class="itext"  disabled="disabled" onChange="conMayusculas(this)"></td>
      </tr>
      <tr>
        <td><label for="YourName"> Integrantes de Familia </label></td>
      <td><label for="YourName">Correo Electronico</label></td>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td><label for="YourName">Tel&eacute;fono celular</label></td>
      <td><label for="YourName">Tel&eacute;fono Fijo</label></td>
      <td colspan="3"><label for="YourName">*Fecha Ingreso </label></td>
      </tr>
      <tr>
        <th><input type="text" name="integrantes" size="10" maxlength="50"  id="integrantes" onchange="conMayusculas(this)" class="itext" /></th>
      <td><input type="text" name="email" size="20" maxlength="200"  id="email" onchange="if ( !this.value.match(/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/) ) { this.value = '' }" onfocus="if (this.value == '') this.value = '';" title="El Formato correcto es: nombre@dominio.servidor"; class="itext" onblur="conMayusculas(this)"></td>
      <td><input type="text" name="tel_movil" size="20" maxlength="200"  id="tel_movil" onkeypress="return acceptNum(event)" class="itext" /></td>
      <td><input type="text" name="tel_fijo" size="20" maxlength="200"  id="tel_fijo" class="itext" onkeypress="return acceptNum(event)" /></td>
      <td colspan="3"><input name="f_registro" type="text" id="dateArrivals" onclick="popUpCalendar(this, captura.dateArrivals, 'dd-mm-yyyy');" readonly="readonly" /></td>
    </tr>
      <tr>
        <td><label for="YourName">*Tipo de Cliente</label></td>
      <td>*Estrato</td>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td><a href="#" onclick='add_cuenta(1,document.captura); return false'>*Cta Deudor Div.</a></td>
      <td><a href="#" onclick='add_cuenta_ant(1,document.captura); return false'>*Cta Ant. Proveedor</a>
      </td>
      <td colspan="3"><label for="YourName">Clave Fira</label></td>
      </tr>
      <tr>
        <td height="40px"><select name="id_tipo" id="id_tipo" class="iselect">
          <option value="">Seleccione Tipo de cliente</option>
          <?php
                    
					 
                     $consulta="SELECT * FROM tipo_cliente  ORDER BY nom_tipo";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["id_tipo"];
						//$resp=$fila["nom_estrato"];;
						
						print("<option value=\"$b\" >".$fila["nom_tipo"]."</option>");
						                                 
                        }
						?>
        </select></td>
      <td><select name="idestrato" id="idestrato" class="iselect">
        <option value="">Seleccione Estrato</option>
        <?php
                    
					 
                     $consulta="SELECT * FROM estrato  ORDER BY nom_estrato";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idestrato"];
						$resp=$fila["nom_estrato"];;
						
						print("<option value=\"$b\" >".$resp."</option>");
						                                 
                        }
						?>
      </select></td>
      <td>
      	<div id="bcuenta">
      	<select name="id_cuenta" id="id_cuenta" class="iselect">
        <option value="">Seleccione Cuenta</option>
        <?php
                    
					 
                     $consulta="SELECT * FROM cuentas where idpadre=4448   ORDER BY clave_gral";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idcuenta"];
						$clave_gral=$fila["clave_gral"];
						$descripcion=$fila["descripcion"];
						$tipo=$fila["tipo"];
						
						
						$resp="$clave_gral $descripcion $tipo";
						
						print("<option value=\"$b\" >".$resp."</option>");
						                                 
                        }
						?>
      </select>
      </div>
      </td>
      <td>
		<div id="bcuenta_ant">
      <select name="id_cuenta_ant" id="id_cuenta_ant" class="iselect">
        <option value="">Seleccione Cuenta</option>
        <?php
                    
					 
                     $consulta="SELECT * FROM cuentas where idpadre=4679  ORDER BY clave_gral";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
									$b=$fila["idcuenta"];
									$clave_gral=$fila["clave_gral"];
									$descripcion=$fila["descripcion"];
									$tipo=$fila["tipo"];
						
						
						$resp="$clave_gral $descripcion $tipo";
						if($idcuenta_ant==$b)
						print("<option value=\"$b\" selected=\"selected\">".$resp."</option>");
						else
						print("<option value=\"$b\" >".$resp."</option>");
						                                 
                        }
						?>
      </select>
      </div>      
      </td>
      <td colspan="3">
		<input type="text" name="clv_fira" size="20" maxlength="50"  id="clv_fira" onchange="conMayusculas(this)" class="itext" />      
      </td>
    </tr>
      <tr>
        <td><label for="YourName">Clave Hacienda</label></td>
        <td>Numero de productor</td>
      <td rowspan="2"></td>
      <td rowspan="2"></td>
      <td>*Cliente</td>
      <td>*Verificación</td>
      <td colspan="3">Grupo</td>
      </tr>
      <tr>
        <td>
			<input type="text" name="clv_ha" size="20" maxlength="50"  id="clv_ha" onchange="conMayusculas(this)" class="itext" />        
        </td>
      <td>
      
      <input type="text" name="num_productor" size="10" maxlength="50" value=""  id="num_productor" onchange="conMayusculas(this)" class="itext" />
      
			    
     
     </td>
      <td>
        <select name="cliente" id="cliente" class="iselect">
          <option value="">Seleccione Tipo de Cliente</option>
          <option value="1">Egos</option>
          <option value="2">Egos-Parafinanciera</option>
          <option value="3">Parafinanciera</option>
        </select> 
			         
        </td>
      <td>
      	<?php	
				select_verificacion(0);   
			?>
      	 
      </td>
      
			<td>
			<?php	
				select_grupo(0);   
			?>
			
			</td>      
      </tr>
      <tr>
      <td height="40px">
        <div align="left">
          <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" />
        </div>
      </td>
    </tr>
   <!--   <tr>
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
        <td><div align="right"></div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
          
          <div align="center"></div></td>
        <td >
          <div align="right"></div></td><td colspan="3" >
          
          <div align="center"></div></td>
      </tr>-->
   </table>
  </div>
</form>
 