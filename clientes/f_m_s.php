<?php
if($modif!=1)
	{
	   $consulta=" SET datestyle TO postgres, dmy; SELECT *,(select idgrupo from rela_grupo where idcliente=c.idcliente) as idgrupo FROM cc_clientes  c order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno))";
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
		  $idcuenta_ant=$fila["idctaanticipoprov"];
		  $idestrato=$fila["idestrato"];
		  $tipo_cliente= $fila["tipo_cliente"];
		  $idcliente=$fila["idcliente"];
		   $id_tipo=$fila["id_tipo"];
		    $estado_civil=$fila["estado_civil"];
			$num_productor=$fila["num_productor"];
			$cli_ver=$fila["idverificacion"];
			$idgrupo=$fila["idgrupo"];
		}

	}




$dia=dia($fecha_nac);
$mes=mes($fecha_nac);
$ano=ano($fecha_nac);




?>



<form name="captura" action="" onSubmit="clientes_alta_egos(1); return false" class="formu">
  <div align="center">
    <input type="hidden" name="idcliente" value="<? echo $idcliente; ?>" />
    <table width="579" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td>
		<!--<form name="captura_cliente" action=""  class="iform">--></td>
        <td colspan="3">*Nombre</td>
        <td><label for="YourName">*Ap paterno </label></td>
        <td>*Ap materno </td>
        <td colspan="3"><label for="YourName">
          <div align="left">*F. Nac </div>
        </label></td>
      </tr>
      <tr>
        <td valign="bottom">
<span class="cliente">
		<select name="cliente_id" class="consultor" onchange="actualiza_cliente(1); return false">
          <option value="">Seleccione Cliente</option>
          <?php
		  
		  
		  				$consulta_c="SELECT *,(select idgrupo from rela_grupo where idcliente=c.idcliente) as idgrupo FROM cc_clientes c order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)) ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
						$ap_paterno=$fila_c["ap_paterno"];
						$ap_materno=$fila_c["ap_materno"];
						$name=$fila_c["nombre"];
						$nombre_cliente=$name." ".$ap_paterno." ".$ap_materno;
						?>
          <option value="<?php echo $fila_c["idcliente"]?>"><?php echo nom($nombre_cliente); ?></option>
          <?php
						
						}
		  
		  
	  ?>
        </select> </span>	</td>
        <td colspan="3" valign="bottom">

		  <input type="text" name="nombre" size="50" maxlength="200" value="<? echo $nom_cliente; ?>" class="itext" onChange="conMayusculas(this)"></td>
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
for($i=1900;$i<2015;$i++)
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
        <td width="300"><label for="YourName">*G&eacute;nero</label></td>
      <td colspan="3">*Rfc</td>
      <td width="133">*Ife
        <label for="YourName"></label></td>
      <td width="120"><label for="YourName">*Curp</label></td>
      <td width="141" colspan="3"><label for="YourName">*Lugar Nac</label></td>
      </tr>
      <tr>
        <th><select name="genero" id="genero" class="iselect">
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
      <td colspan="3"><input type="text" name="rfc" size="20" maxlength="50" value="<? echo $rfc; ?>"  id="rfc" onchange="conMayusculas(this)" class="itext" /></td>
      <th width="133"><input type="text" name="ife" size="20" maxlength="200" value="<? echo $ife; ?>"  id="ife" class="itext" onChange="conMayusculas(this)"></th>
      <td width="120"><input type="text" name="curp" size="20" maxlength="300" value="<? echo $curp; ?>" id="curp" class="itext" onChange="conMayusculas(this)"></td>
      <th width="141" colspan="3"><input type="text" name="lugar_nac" size="20" maxlength="50" value="<? echo $lugar_nac; ?>"  id="lugar_nac" onchange="conMayusculas(this)"  class="itext" /></th>
    </tr>
      <tr>
        <td>*Estado</td>
      <td width="120"><label for="YourName">*Municipio</label></td>
      <td width="4" rowspan="2">&nbsp;</td>
      <td width="4" rowspan="2">&nbsp;</td>
      <td >*Localidad <!--<div id="lo"></div>--></td>
      <td >*Colonia<!--<div id="co"></div>--></td>
      <td colspan="3"><label for="YourName">*Codigo Postal</label></td>
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
     
	 
	 
	 
	  <th colspan="3"><input type="text" name="cod_postal" size="5" maxlength="10" value="<? echo $cod_postal; ?>"  id="cod_postal" class="itext" onkeypress="return acceptNum(event)" ></th>
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
          <input type="text" name="domicilio" size="20" maxlength="200" value="<? echo $domicilio; ?>" id="domicilio" class="modif" onChange="conMayusculas(this)">
        </div></th>
      <th><select name="estado_civil" id="estado_civil" class="iselect" onChange='verifica_estado()'>
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
      <td><?php
		if($regimen_conyugal=="")
		{
			$disable="disabled";
		}
	?>
        <select name="regimen_conyugal" id="regimen_conyugal" class="iselect" <?php echo $disable; ?>>
          <option value="">Seleccione</option>
          <?php
                     
					 
                     $consulta="SELECT * FROM cc_regimen_conyugal  ORDER BY regimen";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idregimen"];
						if($regimen_conyugal==$b)
						print("<option value=\"$b\" selected>".htmlentities($fila["regimen"])."</option>");
						else
						print("<option value=\"$b\" >".$fila["regimen"]."</option>");
                                 
                        }
						?>
        </select></td>
      <td colspan="3"><input type="text" name="nombre_conyugue" size="20" maxlength="15" id="nombre_conyugue" value="<?php echo $nombre_conyugue; ?>" class="itext" <?php echo $disable; ?> / onChange="conMayusculas(this)"></td>
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
        <th><input type="text" name="integrantes" size="10" maxlength="50" value="<? echo $integrantes_familia; ?>"  id="integrantes" onchange="conMayusculas(this)" class="itext" /></th>
      <td><input type="text" name="email" size="20" maxlength="200" value="<? echo $email;  ?>"  id="email" onchange="if ( !this.value.match(/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/) ) { this.value = '' }" onfocus="if (this.value == '') this.value = '';" title="El Formato correcto es: nombre@dominio.servidor"; class="itext"  onblur="conMayusculas(this)" ></td>
      <td><input type="text" name="tel_movil" size="20" maxlength="200" value="<? echo $tel_movil;  ?>"  id="tel_movil" onkeypress="return acceptNum(event)" class="itext" /></td>
      <td><input type="text" name="tel_fijo" size="20" maxlength="200" value="<? echo $tel_fijo; ?>"  id="tel_fijo" class="itext" onkeypress="return acceptNum(event)" /></td>
      <td colspan="3"><input name="f_registro" type="text" id="dateArrivals" onclick="popUpCalendar(this, captura.dateArrivals, 'dd-mm-yyyy');"  value="<?php echo $f_registro; ?>" readonly="readonly" class="iselect"></td>
    </tr>
      <tr>
        <td><label for="YourName">*Tipo de Cliente</label></td>
      <td>*Estrato</td>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td><a href="#" onclick='add_cuenta(1,document.captura); return false'>Cta Deudor Div.</a></td>
		<td><a href="#" onclick='add_cuenta_ant(1,document.captura); return false'>Cta Ant. Proveedor</a></td>   
      <td colspan="3"><label for="YourName">Clave Fira</label></td>
     </tr><tr>
     
        <td><select name="id_tipo" id="id_tipo" class="iselect">
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
      <td><select name="idestrato" id="idestrato" class="iselect">
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
      <td>
      <div id="bcuenta">
      <select name="id_cuenta" id="id_cuenta" class="iselect">
        <option value="">Seleccione Cuenta</option>
        <?php
                    
					 
                     $consulta="SELECT * FROM cuentas where idpadre=4448  ORDER BY clave_gral";
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
      <td colspan="3"><input type="text" name="clv_fira" size="20" maxlength="50" value="<? echo $clv_fira; ?>"  id="clv_fira" onchange="conMayusculas(this)" class="itext" /></td>
     
    </tr>
      <tr>
		  <td><label for="YourName">Clave Hacienda</label></td>        
        <td>Numero de Productor</td>
        
      <td rowspan="2"></td>
      <td rowspan="2">&nbsp;</td>
      <td>Cliente</td>
      <td>Verificaci??n</td>
      <td colspan="4">Grupo</td>
      </tr>
      <tr>
			 <td><input type="text" name="clv_ha" size="20" maxlength="50" value="<? echo $clv_ha; ?>"  id="clv_ha" onchange="conMayusculas(this)" class="itext" /></td>        
        <td><input type="text" name="num_productor" size="10" maxlength="50" value="<? echo $num_productor; ?>"  id="num_productor" onchange="conMayusculas(this)" class="itext" /></td>
			
      
      <td >
         <select name="cliente" id="cliente" class="iselect">
          <option value="">Seleccione tipo de cliente</option>
			        
          <option value="1" <?php if($tipo_cliente==1){ echo "selected";}?> >Egos </option>
          <option value="2" <?php if($tipo_cliente==2){ echo "selected";}?> >Egos-Parafinanciera</option>
          <option value="3" <?php if($tipo_cliente==3){ echo "selected";}?> >Parafinanciera</option>
        </select>
       </td>
      <td>
         <?php	
				select_verificacion($cli_ver);   
			?>
       
      </td>
      <td colspan="4">
			<?php	
				select_grupo($idgrupo);   
			?>      
      </td> </tr>
     <tr>        
		<td colspan="10"> 
		
		<!--inicia la tabla para los botones-->
		     
		<table border="0"><tr>
			<td>      
        		<div align="center">
          		<input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
        		</div>
			</td>
			<td>      
       		<div align="center">
          		<input class="ibutton" type="button" name="nuevo" id="enviare" value="AGREGAR"  onclick="actualiza_cliente(2); return false" />
        		</div>
      	</td>
    
			<td>
				
				<div align="center">
        	          &nbsp;&nbsp;&nbsp;&nbsp; <input class="ibutton" type="button" name="nuevo2" id="nuevo" value="PARCELAS"  onclick="actualiza_parcela(<?php echo $idcliente; ?>); return false" />
         	</div> 
       	</td>
          
    	</tr></table>
    	
    	<!--  termina la tabla de los botones    -->
    	
    </tr>
      <tr>
        <td height="33">
        
          <?php 

$img='<img src="../images/i_pdf.png" alt="Reporte de Solicitud" style="WIDTH: 40px; HEIGHT: 40px" title="Reporte de Clientes">';

echo '<a href="../reportes/reporte_cliente.php" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right">
         
		  
		  <input type="button" class="ibutton" name="exp" value="DIGITALIZAR" onclick = "location='digitalizar.php?idcliente=<?php echo $idcliente; ?>'"/>

		  
		  
        </div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
          
          <div align="center">
            <input class="ibutton" type="button" name="nuevo22" id="nuevo2" value="GTIA HIPOTECARIA"  onclick="actualiza_gtia_hipo(<?php echo $idcliente; ?>); return false" />
          </div></td>
        <td >
          <div align="right">
            <input class="ibutton" type="button" name="nuevo222" id="nuevo22" value="GTIA PRENDARIAS"  onclick="actualiza_gtia_prenda(<?php echo $idcliente; ?>); return false" />
          </div></td><td colspan="3" >
          
          <div align="center"></div></td>
      </tr>
   </table>
  </div>
</form>
 