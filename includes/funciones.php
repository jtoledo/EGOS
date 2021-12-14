<?php
function get_mayor($a_mayor)
{
for($j=0;$j<count($a_mayor);$j++)
{
  //Si mayor es menor que el elemento elejido
  if($mayor<$a_mayor[$j])
  {
    //cambiamos el mayor
    //y obtenemos su posicion
    $mayor=$a_mayor[$j];
    $pos=$j;
  }
  
}
return $mayor;	
}

function cambioFecha($fecha){ //$fecha es de este formato --> ej: 20081229 

$tieneCeroDiaMes = substr($fecha,6,1); 

if ($tieneCeroDiaMes == 0) { 
    $diaMes = substr($fecha,7,1); 
} else { 
    $diaMes = substr($fecha,6,2); 

} 


$Mes = substr($fecha,4,2); 
$Mes = str_replace("01","Enero",$Mes); 
$Mes = str_replace("02","Febrero",$Mes); 
$Mes = str_replace("03","Marzo",$Mes); 
$Mes = str_replace("04","Abril",$Mes); 
$Mes = str_replace("05","Mayo",$Mes); 
$Mes = str_replace("06","Junio",$Mes); 
$Mes = str_replace("07","Julio",$Mes); 
$Mes = str_replace("08","Agosto",$Mes); 
$Mes = str_replace("09","Septiembre",$Mes); 
$Mes = str_replace("10","Octubre",$Mes); 
$Mes = str_replace("11","Noviembre",$Mes); 
$Mes = str_replace("12","Diciembre",$Mes); 

$Anio = substr($fecha,0,4); 

return $diaMes." de ".$Mes." de ".$Anio.""; 
} 


function minuscula($var)
{
//$nom=ucwords(strtolower($var));  //para caracterres iso989

$nom=mb_strtolower($var, 'UTF-8'); //convierte a minusculas
//$nom=mb_convert_case($nom, MB_CASE_TITLE, "UTF-8"); //convierte la primer letra en mayusculas
//$nom=mb_convert_case($nom,MB_CASE_UPPER, "UTF-8"); //convierte A MAYUSCULAS


return $nom;



}

function unidad($numuero){
switch ($numuero)
{
case 9:
{
$numu = "NUEVE";
break;
}
case 8:
{
$numu = "OCHO";
break;
}
case 7:
{
$numu = "SIETE";
break;
} 
case 6:
{
$numu = "SEIS";
break;
} 
case 5:
{
$numu = "CINCO";
break;
} 
case 4:
{
$numu = "CUATRO";
break;
} 
case 3:
{
$numu = "TRES";
break;
} 
case 2:
{
$numu = "DOS";
break;
} 
case 1:
{
$numu = "UN";
break;
} 
case 0:
{
$numu = "";
break;
} 
}
return $numu; 
}

function decena($numdero){

if ($numdero >= 90 && $numdero <= 99)
{
$numd = "NOVENTA ";
if ($numdero > 90)
$numd = $numd."Y ".(unidad($numdero - 90));
}
else if ($numdero >= 80 && $numdero <= 89)
{
$numd = "OCHENTA ";
if ($numdero > 80)
$numd = $numd."Y ".(unidad($numdero - 80));
}
else if ($numdero >= 70 && $numdero <= 79)
{
$numd = "SETENTA ";
if ($numdero > 70)
$numd = $numd."Y ".(unidad($numdero - 70));
}
else if ($numdero >= 60 && $numdero <= 69)
{
$numd = "SESENTA ";
if ($numdero > 60)
$numd = $numd."Y ".(unidad($numdero - 60));
}
else if ($numdero >= 50 && $numdero <= 59)
{
$numd = "CINCUENTA ";
if ($numdero > 50)
$numd = $numd."Y ".(unidad($numdero - 50));
}
else if ($numdero >= 40 && $numdero <= 49)
{
$numd = "CUARENTA ";
if ($numdero > 40)
$numd = $numd."Y ".(unidad($numdero - 40));
}
else if ($numdero >= 30 && $numdero <= 39)
{
$numd = "TREINTA ";
if ($numdero > 30)
$numd = $numd."Y ".(unidad($numdero - 30));
}
else if ($numdero >= 20 && $numdero <= 29)
{
if ($numdero == 20)
$numd = "VEINTE ";
else
$numd = "VEINTI".(unidad($numdero - 20));
}
else if ($numdero >= 10 && $numdero <= 19)
{
switch ($numdero){
case 10:
{
$numd = "DIEZ ";
break;
}
case 11:
{ 
$numd = "ONCE ";
break;
}
case 12:
{
$numd = "DOCE ";
break;
}
case 13:
{
$numd = "TRECE ";
break;
}
case 14:
{
$numd = "CATORCE ";
break;
}
case 15:
{
$numd = "QUINCE ";
break;
}
case 16:
{
$numd = "DIECISEIS ";
break;
}
case 17:
{
$numd = "DIECISIETE ";
break;
}
case 18:
{
$numd = "DIECIOCHO ";
break;
}
case 19:
{
$numd = "DIECINUEVE ";
break;
}
} 
}
else
$numd = unidad($numdero);
return $numd;
}

function centena($numc){
if ($numc >= 100)
{
if ($numc >= 900 && $numc <= 999)
{
$numce = "NOVECIENTOS ";
if ($numc > 900)
$numce = $numce.(decena($numc - 900));
}
else if ($numc >= 800 && $numc <= 899)
{
$numce = "OCHOCIENTOS ";
if ($numc > 800)
$numce = $numce.(decena($numc - 800));
}
else if ($numc >= 700 && $numc <= 799)
{
$numce = "SETECIENTOS ";
if ($numc > 700)
$numce = $numce.(decena($numc - 700));
}
else if ($numc >= 600 && $numc <= 699)
{
$numce = "SEISCIENTOS ";
if ($numc > 600)
$numce = $numce.(decena($numc - 600));
}
else if ($numc >= 500 && $numc <= 599)
{
$numce = "QUINIENTOS ";
if ($numc > 500)
$numce = $numce.(decena($numc - 500));
}
else if ($numc >= 400 && $numc <= 499)
{
$numce = "CUATROCIENTOS ";
if ($numc > 400)
$numce = $numce.(decena($numc - 400));
}
else if ($numc >= 300 && $numc <= 399)
{
$numce = "TRESCIENTOS ";
if ($numc > 300)
$numce = $numce.(decena($numc - 300));
}
else if ($numc >= 200 && $numc <= 299)
{
$numce = "DOSCIENTOS ";
if ($numc > 200)
$numce = $numce.(decena($numc - 200));
}
else if ($numc >= 100 && $numc <= 199)
{
if ($numc == 100)
$numce = "CIEN ";
else
$numce = "CIENTO ".(decena($numc - 100));
}
}
else
$numce = decena($numc);

return $numce; 
}

function miles($nummero){
if ($nummero >= 1000 && $nummero < 2000){
$numm = "MIL ".(centena($nummero%1000));
}
if ($nummero >= 2000 && $nummero <10000){
$numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
}
if ($nummero < 1000)
$numm = centena($nummero);

return $numm;
}

function decmiles($numdmero){
if ($numdmero == 10000)
$numde = "DIEZ MIL";
if ($numdmero > 10000 && $numdmero <20000){
$numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000)); 
}
if ($numdmero >= 20000 && $numdmero <100000){
$numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000)); 
} 
if ($numdmero < 10000)
$numde = miles($numdmero);

return $numde;
} 

function cienmiles($numcmero){
if ($numcmero == 100000)
$num_letracm = "CIEN MIL";
if ($numcmero >= 100000 && $numcmero <1000000){
$num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000)); 
}
if ($numcmero < 100000)
$num_letracm = decmiles($numcmero);
return $num_letracm;
} 

function millon($nummiero){
if ($nummiero >= 1000000 && $nummiero <2000000){
$num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
}
if ($nummiero >= 2000000 && $nummiero <10000000){
$num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
}
if ($nummiero < 1000000)
$num_letramm = cienmiles($nummiero);

return $num_letramm;
} 

function decmillon($numerodm){
if ($numerodm == 10000000)
$num_letradmm = "DIEZ MILLONES";
if ($numerodm > 10000000 && $numerodm <20000000){
$num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000)); 
}
if ($numerodm >= 20000000 && $numerodm <100000000){
$num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000)); 
}
if ($numerodm < 10000000)
$num_letradmm = millon($numerodm);

return $num_letradmm;
}

function cienmillon($numcmeros){
if ($numcmeros == 100000000)
$num_letracms = "CIEN MILLONES";
if ($numcmeros >= 100000000 && $numcmeros <1000000000){
$num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000)); 
}
if ($numcmeros < 100000000)
$num_letracms = decmillon($numcmeros);
return $num_letracms;
} 

function milmillon($nummierod){
if ($nummierod >= 1000000000 && $nummierod <2000000000){
$num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
}
if ($nummierod >= 2000000000 && $nummierod <10000000000){
$num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
}
if ($nummierod < 1000000000)
$num_letrammd = cienmillon($nummierod);

return $num_letrammd;
} 


function convertir_letra($numero){
$numf = milmillon($numero);
return $numf;
}
function consul_productos_i()
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_productos   order by producto ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
		}

}
function consul_productos_m($idproducto)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_productos where idproducto='$idproducto'   order by producto ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
		}

}

 function limitarPalabras($cadena, $longitud, $elipsis = "...")
   {
  $palabras = explode(' ', $cadena);
  if (count($palabras) > $longitud)
  return implode(' ', array_slice($palabras, 0, $longitud)) . $elipsis;
  else
  return $cadena;
  }



function dia($fecha)
{
    list($d,$m,$a)=explode("-",$fecha);
    return $d;
}

function mes($fecha)
{
    list($d,$m,$a)=explode("-",$fecha);
    return $m;
}

function ano($fecha)
{
    list($d,$m,$a)=explode("-",$fecha);
    return $a;
}




function generaSelect()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_estados order by estado");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='estado' id='cc_estados' onChange='carga_select(this.id)' class='iselect'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	global $idestado;
	
	
						$b=$fila["idestado"];
						if($idestado==$b)
						 print("<option value=\"$idestado\" selected>".$fila["estado"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["estado"]."</option>");
                                 
	
	
	}
	echo "</select>";
}
function generaSelect_disabled()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_estados order by estado");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='estado' id='cc_estados' onChange='carga_select(this.id)' class='iselect' disabled='disabled'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	global $idestado;
	
	
						$b=$fila["idestado"];
						if($idestado==$b)
						 print("<option value=\"$idestado\" selected>".$fila["estado"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["estado"]."</option>");
                                 
	
	
	}
	echo "</select>";
}
function generaSelect_estado_aux()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_estados order by estado");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='estado' id='cc_estados' onChange='carga_select(this.id)' class='iselect' disabled='disabled'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	global $idestado;
	
	
						$b=$fila["idestado"];
						if($idestado==$b)
						 print("<option value=\"$idestado\" selected>".$fila["estado"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["estado"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function generaSelect_localidad()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_estados order by estado");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='estado' id='cc_estados' onChange='carga_select_localidad(this.id)' class='iselect'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
		global $idestado;
	
						$b=$fila["idestado"];
						if($idestado==$b)
						 print("<option value=\"$idestado\" selected>".$fila["estado"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["estado"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function generaSelect_municipio()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_municipios order by municipio");
	//desconectar();
//global $idmunicipio;
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='municipio' id='cc_municipios' onChange='carga_select_localidad(this.id)' class='iselect'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	global $idmunicipio;
							$b=$fila["idmunicipio"];
	
						if($idmunicipio==$b)
						 print("<option value=\"$b\" selected>".$fila["municipio"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["municipio"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function generaSelect_municipio2()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_municipios order by municipio");
	//desconectar();
//global $idmunicipio;
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='municipio' id='cc_municipios' onChange='carga_select(this.id)' class='iselect'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	global $idmunicipio;
							$b=$fila["idmunicipio"];
	
						if($idmunicipio==$b)
						 print("<option value=\"$b\" selected>".$fila["municipio"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["municipio"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function generaSelect_lo()
{
//	include 'conexion.php';
    global $con;
	global $idmunicipio;
	$consulta=pg_query($con,"SELECT * FROM cc_localidades where idmunicipio='$idmunicipio' order by localidad");
	//desconectar();
//global $idmunicipio;
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='localidad_aux' id='cc_municipios_aux'  class='consultor'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	
					     
						  $c=$fila["idlocalidad"];
	
						
						 print("<option value=\"$c\">".$fila["localidad"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function generaSelect_lo2()
{
//	include 'conexion.php';
    global $con;
	global $idlocalidad;
	$consulta=pg_query($con,"SELECT * FROM cc_localidades  order by localidad");
	//desconectar();
//global $idmunicipio;
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='localidad' id='cc_municipios'  class='consultor'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	
					     
						 $c=$fila["idlocalidad"];
						if($idlocalidad==$c)
						 print("<option value=\"$c\" selected>".$fila["localidad"]."</option>");
						 else
						
						 print("<option value=\"$c\">".$fila["localidad"]."</option>");
                                 
	
	
	}
	echo "</select>";
}


function select_verificacion($idsel)
{
	global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_cliente_verificacion order by idverificacion");

	// combo de verificacion
	echo "<select name='cli_verificacion' id='cli_verificacion' class='iselect'>";
	
	while($fila=pg_fetch_array($consulta))
	{
		
	
						$b=$fila["idverificacion"];
						if($idsel==$b) {
							print("<option value='$b' selected>".$fila["descripcion"]."</option>");
						}
						else{
						 	print("<option value='$b'>".$fila["descripcion"]."</option>");
                  }               
	
	
	}
	echo "</select>";
}

function select_grupo($idsel)
{
	global $con;
	$consulta=pg_query($con,"select idgrupo,grupo from cc_grupos order by grupo");

	// combo de grupo
	echo "<select name='idgrupo' id='idgrupo' class='iselect'>";
	print("<option value='' selected>Sin grupo</option>");
	while($fila=pg_fetch_array($consulta))
	{
		
	
						$b=$fila["idgrupo"];
						if($idsel==$b) {
							print("<option value='$b' selected>".$fila["grupo"]."</option>");
						}
						else{
						 	print("<option value='$b'>".$fila["grupo"]."</option>");
                  }               
	
	
	}
	echo "</select>";
}


function generaSelect_new()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_estados order by estado");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='estado' id='cc_estados' onChange='carga_select(this.id)' class='iselect'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	global $idestado;
	
	
						$b=$fila["idestado"];
						
						 print("<option value=\"$b\">".$fila["estado"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function generaSelect_new_modal()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_estados order by estado");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='estado' id='cc_estados' onChange='carga_select_modal(this.id)' class='iselect'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	global $idestado;
	
	
						$b=$fila["idestado"];
						
						 print("<option value=\"$b\">".$fila["estado"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

	function cambiarFormatoFecha($fecha)
{ 
list($dia,$mes,$anio)=explode("/",$fecha); 
return $anio."-".$mes."-".$dia; 
} 

function validar_campos_obligatorios($campos_obligatorios)
	{
		$errores = array();
		foreach($campos_obligatorios as $campo)
		{			
			if(!isset($_POST[$campo]) || (empty($_POST[$campo])))
			{
				$errores[] = $campo;
			}	
		}
		return $errores;
	}
	
	
	
	
	
	function unidad_existente()
{

    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_unidades order by unidad");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='unidad_aux' id='cc_unidades'  class='iselect'>";
	echo "<option value=''>Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idestado;
							$b=$fila["iduni"];
	
					/*	
						if($idestado==$b)
						 print("<option value=\"$idestado\" selected>".$fila["estado"]."</option>");
						 else*/
						 print("<option value=\"$b\">".$fila["unidad"]."</option>");
                                 
	
	
	}
	echo "</select>";
}
function proceso_existente()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_ptprocesos order by proceso");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='proceso_aux' id='cc_procesos'  class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idestado;
							$b=$fila["idproceso"];
	
					/*	
						if($idestado==$b)
						 print("<option value=\"$idestado\" selected>".$fila["estado"]."</option>");
						 else*/
						 print("<option value=\"$b\">".$fila["proceso"]."</option>");
                                 
	
	
	}
	echo "</select>";
}	
	
function proceso_actualiza()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_ptprocesos order by proceso");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idproceso' id='cc_ptrequerimientos' onChange='carga_select(this.id)'  class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idestado;
							$b=$fila["idproceso"];
	
					/*	
						if($idestado==$b)
						 print("<option value=\"$idestado\" selected>".$fila["estado"]."</option>");
						 else*/
						 print("<option value=\"$b\">".$fila["proceso"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function consulta_requerimiento()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_ptrequerimientos order by requerimiento");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idrequerimiento' id='cc_ptrequerimientos' onChange='carga_select_reque(this.id)'  class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	global $idrequerimiento;
							$b=$fila["idrequerimiento"];
	
						
						if($idrequerimiento==$b)
						 print("<option value=\"$b\" selected>".$fila["requerimiento"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["requerimiento"]."</option>");
                                 
	
	
	}
	echo "</select>";
}
function consulta_requerimiento_m($idproceso,$idrequerimiento)
{
//	include 'conexion.php';
    global $con;
	//global $idproceso;
	$form=1;
	$consulta=pg_query($con,"SELECT * FROM cc_ptrequerimientos where idproceso='$idproceso' order by requerimiento");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idrequerimiento' id='cc_ptrequerimientos' onChange='actualiza_requerimiento(".$form.",this.value)'  class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idrequerimiento;
							$b=$fila["idrequerimiento"];
	
	
						$requerimiento=nom($fila["requerimiento"]);	
						
						if($idrequerimiento==$b)
						 print("<option value=\"$b\" selected>".$requerimiento."</option>");
						 else
						 print("<option value=\"$b\">".$requerimiento."</option>");
                                 
	
	
	}
	echo "</select>";
}
function consulta_requerimiento_n($idproceso)
{
//	include 'conexion.php';
    global $con;
	//global $idproceso;
	
	$consulta=pg_query($con,"SELECT * FROM cc_ptrequerimientos where idproceso='$idproceso' order by requerimiento");
	//desconectar();
$form=1;
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idrequerimiento' id='cc_ptrequerimientos' onChange='actualiza_requerimiento(".$form.",this.value)'  class='iselect'>";
	//echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idrequerimiento;
							$b=$fila["idrequerimiento"];
						$requerimiento=nom($fila["requerimiento"]);
						
						
						 print("<option value=\"$b\">".$requerimiento."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_unidad()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_unidades order by unidad");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='iduni' id='iduni'   class='peque'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idestado;
							$b=$fila["iduni"];
	
					/*	
						if($idestado==$b)
						 print("<option value=\"$idestado\" selected>".$fila["estado"]."</option>");
						 else*/
						 print("<option value=\"$b\">".$fila["unidad"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_unidad_m($iduni)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_unidades order by unidad");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='iduni' id='iduni'   class='peque'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["iduni"];
	
						
						if($iduni==$b)
						 print("<option value=\"$b\" selected>".$fila["unidad"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["unidad"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_unidad_p($iduni)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_unidades where iduni='$iduni' ");
	
	
	while($fila=pg_fetch_array($consulta))
	{
		
                                 
	$iduni=$fila["unidad"];
	
	}
return $iduni;
}

function get_tipo_credito($id_tipo)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_tipos_creditos where idtipocredito='$id_tipo' ");
	
	
	while($fila=pg_fetch_array($consulta))
	{
		
                                 
	$tipo_credito=$fila["tipo_credito"];
	
	}
return $tipo_credito;
}


function get_tipo_m($id_tipo)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_tipos_creditos order by tipo_credito");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_tipo' id='id_tipo'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idtipocredito"];
	
						
						if($id_tipo==$b)
						 print("<option value=\"$b\" selected>".$fila["tipo_credito"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["tipo_credito"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_tipo()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_tipos_creditos order by tipo_credito");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_tipo' id='id_tipo'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idtipocredito"];
	
						
						
						 print("<option value=\"$b\">".$fila["tipo_credito"]."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_periodo_m($idper)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_periodos_pagos order by periodo");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idper' id='idper'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idper"];
	
						
						if($idper==$b)
						 print("<option value=\"$b\" selected>".$fila["periodo"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["periodo"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_periodo_m_disabled($idper)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_periodos_pagos where idper='$idper' ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idper' id='idper'   class='iselect'>";

	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idper"];
	
						
						 print("<option value=\"$b\">".$fila["periodo"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_disposiciones($iddispo)
{
//	include 'conexion.php';
    global $con;
    $sql="select coddisp,('('||fechadis::char(16)||'/'||fechaven::char(16)||')'||monto::char(16))::varchar(40) as dispo from cc_disposicion_parafin";
	$consulta=pg_query($con,$sql);
	

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='iddispo' id='iddispo'   class='iselect' style='width: 200px'>";
      echo "<option value='0'>[Seleccione una Disposicion]</option>";
      
	while($fil=pg_fetch_array($consulta))
	{

							$b=$fil["coddisp"];
	
						if($b==$iddispo) {
						 	print("<option value=\"$b\" selected>".$fil["dispo"]."</option>");
                  }else {
							print("<option value=\"$b\">".$fil["dispo"]."</option>");
                  }
                             
	
	
	}
	echo "</select>";
}

function get_periodo_a()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_periodos_pagos order by periodo");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idper' id='idper'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idper"];
	
						
						
						 print("<option value=\"$b\">".$fila["periodo"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_modalidad_m($id_pago)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM modo_pago order by tipo_pago");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_pago' id='id_pago'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_pago"];
	
						
						if($id_pago==$b)
						 print("<option value=\"$b\" selected>".$fila["tipo_pago"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["tipo_pago"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_modalidad()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM modo_pago order by tipo_pago");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_pago' id='id_pago'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_pago"];
	
						
						
						 print("<option value=\"$b\">".$fila["tipo_pago"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_periodo($idper)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_periodos_pagos where idper='$idper' ");
	
	
	while($fila=pg_fetch_array($consulta))
	{
		
                                 
	$periodo=$fila["periodo"];
	
	}
return $periodo;
}

function consul_requerimientos($idrequerimiento)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_ptrequerimientos where idrequerimiento='$idrequerimiento'   order by requerimiento desc";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}

}
function consul_requerimientos_paq($id_conf_paq)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM conf_paquete where id_conf_paq='$id_conf_paq'   order by requerimiento desc";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}

}


function get_requerimiento()
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_ptrequerimientos  order by idproceso desc";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}

function get_requerimiento_paq($id_paquete)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM conf_paquete where id_paquete='$id_paquete'  order by requerimiento";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}


function get_proceso()
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_ptprocesos  order by idproceso desc";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}

function get_requerimiento_proceso($idproceso)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_ptrequerimientos where idproceso='$idproceso'  order by idproceso desc";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			}

}	
function proceso_actualiza_m($idproceso)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_ptprocesos order by proceso");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idproceso' id='cc_ptrequerimientos' onChange='carga_select(this.id)'  class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//							global $idproceso;
							$b=$fila["idproceso"];
	
						$proceso=nom($fila["proceso"]);
						
						
						if($idproceso==$b)
						 print("<option value=\"$b\" selected>".$proceso."</option>");
						 else
						 print("<option value=\"$b\">".$proceso."</option>");
                                 
	
	
	}
	echo "</select>";
}	





function get_cliente($idcliente)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT *,(select upper(cv.descripcion) as produccion from cc_clientes cl,cc_cliente_verificacion cv where cl.idverificacion=cv.idverificacion and cl.idcliente=c.idcliente) as produccion FROM cc_clientes  c where idcliente='$idcliente'  ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			}

}	
function get_exit_cliente()
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)) ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return 1;
			}
			else
			{
			return 0;
			}

}	

function get_documento($idconcepto)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_conceptos_expediente where idconcepto='$idconcepto'  ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return trim($fila["concepto"]);
			}
			else
			{
			return 0;
			}

}


function get_tipo_documento($idconcepto,$idcliente)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM expediente where idcliente='$idcliente' and idconcepto='$idconcepto'  ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return 1;
			}
			else
			{
			return 0;
			}

}





function get_paquete_tec()
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM paquete_tec  order by nom_paquete";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}

function get_paquete_tec_m($id_paquete)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM paquete_tec where id_paquete='$id_paquete'  order by nom_paquete";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}




function consulta_requerimiento_paq($id_paquete)
{

    global $con;


$sql_reque="SELECT * FROM cc_ptrequerimientos WHERE cc_ptrequerimientos.idrequerimiento  not in (SELECT conf_paquete.idrequerimiento FROM conf_paquete WHERE conf_paquete.id_paquete='$id_paquete')";


	
	$consulta=pg_query($con,$sql_reque);
	//desconectar();
	$form=3;
	// Voy imprimiendo el primer select compuesto por los paises  onChange='actualiza_requerimiento(".$form.",this.value)' 
	echo "<select name='idrequerimiento' id='cc_ptrequerimientos' onChange='actualiza_requerimiento(".$form.",this.value)'  class='iselect'>";
	echo "<option value='' >Elige Requerimiento</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idrequerimiento;
							$b=$fila["idrequerimiento"];
	
						
						
						 print("<option value=\"$b\">".$fila["requerimiento"]."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_paquete_reque($id_paquete)
{

    global $con;

	
	$consulta=pg_query($con,"SELECT * FROM conf_paquete where id_paquete='$id_paquete'  order by requerimiento");
	//desconectar();
$form=3;
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='z' id='z' onChange='add_select_reque_paq(this.value,1); return false'  class='consultor3'>";
	echo "<option value='' >Ver requerimientos del paquete actual</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idrequerimiento;
							$b=$fila["id_conf_paq"];
							
							$iduni=$fila["iduni"];
							
							
							$cantidad=$fila["cantidad"];
							$ciclos=$fila["ciclos"];
							$requerimiento=$fila["requerimiento"];
							$unidad=get_unidad_p($iduni);
							
	
						$desc="{$requerimiento} {$unidad}  {$cantidad}  {$ciclos}";
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_reque_status($id_paquete)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM conf_paquete  where id_paquete='$id_paquete'";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return 1;
			}
			else
			{
			return 0;
			
			
			}

}


function get_grupo()
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_grupos  order by grupo";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}


function get_paquete_exist()
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM paquete_tec  order by nom_paquete";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return 1;
			}
			else
			{
			return 0;
			
			
			}

}


function get_exits_grupo()
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_grupos  order by grupo";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return 1;
			}
			else
			{
			return 0;
			
			
			}

}

function get_exits_sol($idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes  where id_sucursal='$idsucursal' and id_periodo='$idcosecha' order by fecha_registro";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return 1;
			}
			else
			{
			return 0;
			
			
			}

}
function get_exits_sol_cliente($idcliente,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes where idcliente='$idcliente' and id_sucursal='$idsucursal' and id_periodo='$idcosecha'  order by fecha_registro";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}

function get_representante_m($idrepresentante)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes where  id_tipo between '2' and '3'");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nombres="".$fila['nombre']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
	
						if($b==$idrepresentante)
						print("<option value=\"$b\" selected='selected'>".$nombres."</option>");
						else
						print("<option value=\"$b\">".$nombres."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_representante_m_lect($idrepresentante)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes where  id_tipo between '2' and '3'");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idrepresentante' id='idrepresentante'   class='modif' disabled='disabled'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nombres="".$fila['nombre']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
	
						if($b==$idrepresentante)
						print("<option value=\"$b\" selected='selected'>".$nombres."</option>");
						else
						print("<option value=\"$b\">".$nombres."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_representante()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes where  id_tipo between '2' and '3'");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nombres="".$fila['nombre']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
	
					
						print("<option value=\"$b\">".$nombres."</option>");
                                 
	
	
	}
	echo "</select>";
}



function get_clientes_grupo($idgrupo)
{

    global $con;

	
	$consulta=pg_query($con,"SELECT * FROM rela_grupo,cc_clientes where rela_grupo.idcliente=cc_clientes.idcliente and rela_grupo.idgrupo='$idgrupo'  order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno))");
	//desconectar();
$form=3;
	
	echo "<select name='id_rela' id='z' onChange='menos_add_grup(this.value,2)'  class='consultor3'>";
	echo "<option value='' >Ver Integrantes del grupo</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idrequerimiento;
							$b=$fila["id_rela"];
							$nombres="".$fila['nombre']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($nombres)."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_grupo_m($idgrupo)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   if($idgrupo>0)
	   {
	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_grupos where idgrupo='$idgrupo'  order by grupo";
	   }
	   else
	   {	$idgrupo=0;
		   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_grupos where idgrupo='$idgrupo'  order by grupo";
	   }
	   
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}


function get_productor_m()
{

    global $con;

	
	$consulta=pg_query($con,"SELECT * FROM cc_clientes where cc_clientes.idcliente not in"."("."select idcliente from rela_grupo where rela_grupo.idcliente=cc_clientes.idcliente".")"."and cc_clientes.id_tipo!=2 order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno))");
	//desconectar();
$form=3;
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='z' id='z' onChange='mas_add_grup(this.value,1)'   class='modif'>";
	echo "<option value='' >Productores Disponibles</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idrequerimiento;
							$b=$fila["idcliente"];
							$nombres="".$fila['nombre']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($nombres)."</option>");
                                 
	
	
	}
	echo "</select>";
}





function get_tipo_cliente($idcliente)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes where idcliente='$idcliente'  order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno))";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila["id_tipo"];
			
			
			}
			else
			{
			return 0;
			
			
			}

}


function get_grupo_sol($idcliente)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM rela_grupo where idcliente='$idcliente'  ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			$idgrupo= $fila["idgrupo"];
			return $fila_grupo=get_grupo_m($idgrupo);
			
			
			}
			else
			{
			return 0;
			
			
			}

}








function get_cliente_tipo($id_tipo)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM tipo_cliente where id_tipo='$id_tipo'  ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila["nom_tipo"];
			
			
			}
			else
			{
			return 0;
			
			
			}

}

function get_promotor_bd()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_promotores order by nombre ");
	
	
	if($fila=pg_fetch_array($consulta))
	return 1;
	else
	return 0;
	

}




function get_promotor()
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_promotores  order by nombre ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}
function get_promotor_m($idpromotor)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_promotores where idpromotor='$idpromotor'  order by nombre ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}

function get_usuario($uid)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM u_usuarios where uid='$uid' ");
	
	
 if($fila= pg_fetch_array($consulta))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}
}

function get_sel_cosecha($id_periodo)
{
    global $con;
	$consulta=pg_query($con,"SELECT * FROM co_pcosecha where activo  order by periodo");
	echo "<select name='id_periodo' id='id_periodo'  style='width: 210px;'>";
	echo "<option value='' >Seleccione Cosecha</option>";
	while($fila=pg_fetch_array($consulta))
	{
		
					    $b=$fila["id_periodo"];
							
						if($fila["activo"]=="t")
							print("<option value=\"$b\" selected='selected'>".$fila["periodo"]."</option>");
						else
							print("<option value=\"$b\">".$fila["periodo"]."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_sucursal_selec($id_sucursal)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_sucursales order by sucursal");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_sucursal' id='id_sucursal'  style='width:210px;'>";
	echo "<option value='' >Seleccione sucursal</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id"];
	
						
						if($id_sucursal==$b)
						 print("<option value=\"$b\" selected>".$fila["sucursal"]."</option>");
						 else
						 print("<option value=\"$b\">".$fila["sucursal"]."</option>");
                                 
	
	
	}
	echo "</select>";
}





function get_clientes_sol()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)) ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='actualiza_sol_cliente(this.value,1)'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_clientes_sol_m($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)) ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='actualiza_sol_cliente(this.value,1)'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
							
						 if($idcliente==$b)
						 print("<option value=\"$b\" selected>".nom($nom_clientes)."</option>");
						 else
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_clientes_sol_m_disabled($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)) ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='actualiza_sol_cliente(this.value,1)'   class='modif' disabled='disabled'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
							
						 if($idcliente==$b)
						 print("<option value=\"$b\" selected>".nom($nom_clientes)."</option>");
						 else
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_giro_sol()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_giros order by giro");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idgiro' id='idgiro'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idgiro"];
							
						print("<option value=\"$b\">".$fila["giro"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_giro_sol_m($idgiro)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_giros order by giro");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idgiro' id='idgiro'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idgiro"];
						if($b==$idgiro)	
						print("<option value=\"$b\" selected='selected'>".$fila["giro"]."</option>");
						else
						print("<option value=\"$b\" >".$fila["giro"]."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_giro_sol_m_disabled($idgiro)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_giros order by giro");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idgiro' id='idgiro'   class='iselect' disabled='disabled'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idgiro"];
						if($b==$idgiro)	
						print("<option value=\"$b\" selected='selected'>".$fila["giro"]."</option>");
						else
						print("<option value=\"$b\" >".$fila["giro"]."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_productos_sol()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_productos order by producto");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idproducto' id='idproducto'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idproducto"];
							
						print("<option value=\"$b\">".$fila["producto"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_productos_sol_m($idproducto)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_productos order by producto");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idproducto' id='idproducto'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idproducto"];
						if($b==$idproducto)	
						print("<option value=\"$b\" selected='selected'>".$fila["producto"]."</option>");
						else
						print("<option value=\"$b\">".$fila["producto"]."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_productos_sol_m_disabled($idproducto)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_productos order by producto");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idproducto' id='idproducto'   class='modif' disabled='disabled'>";

	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idproducto"];
						if($b==$idproducto)	
						print("<option value=\"$b\" selected='selected'>".$fila["producto"]."</option>");
						else
						print("<option value=\"$b\">".$fila["producto"]."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_concepinv_sol()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_conceptos_inversion order by concepto_inversion");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcon_inv' id='idcon_inv'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcon_inv"];
							
						print("<option value=\"$b\">".$fila["concepto_inversion"]."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_concepinv_sol_m($idcon_inv)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_conceptos_inversion order by concepto_inversion");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcon_inv' id='idcon_inv'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcon_inv"];
						if($b==$idcon_inv)	
						print("<option value=\"$b\" selected='selected'>".$fila["concepto_inversion"]."</option>");
						else
						print("<option value=\"$b\">".$fila["concepto_inversion"]."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_concepinv_sol_m_disabled($idcon_inv)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_conceptos_inversion where idcon_inv='$idcon_inv' order by concepto_inversion");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcon_inv' id='idcon_inv'   class='iselect' disabled='disabled'>";

	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcon_inv"];
						
						print("<option value=\"$b\" selected='selected'>".$fila["concepto_inversion"]."</option>");
						         
	
	
	}
	echo "</select>";
}
function get_paquete_sol($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM paquete_tec order by nom_paquete");
	
	echo "<select name='id_paquete' id='id_paquete' class='iselect' onChange='procesa_paquete_tec(this.value,1,".$idcliente.")'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_paquete"];
							
						print("<option value=\"$b\">".nom($fila["nom_paquete"])."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_paquete_sol_m($id_paquete,$idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM paquete_tec order by nom_paquete");
	
	echo "<select name='id_paquete' id='id_paquete' class='iselect' onChange='procesa_paquete_tec(this.value,1,".$idcliente.")'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;			
							$b=$fila["id_paquete"];
							if($b==$id_paquete)
							print("<option value=\"$b\" selected='selected'>".nom($fila["nom_paquete"])."</option>");
							else
							print("<option value=\"$b\">".nom($fila["nom_paquete"])."</option>");
							
						
                                 
	
	
	}
	echo "</select>";
}
function get_paquete_sol_m_disabled($id_paquete,$idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM paquete_tec where id_paquete='$id_paquete' order by nom_paquete");
	
	echo "<select name='id_paquete' id='id_paquete' class='iselect' disabled='disabled'>";

	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;			
							$b=$fila["id_paquete"];
							print("<option value=\"$b\" selected='selected'>".nom($fila["nom_paquete"])."</option>");
							
						
                                 
	
	
	}
	echo "</select>";
}
function get_paquete_sol_i()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM paquete_tec order by nom_paquete");
	
	echo "<select name='id_paquete' id='id_paquete' class='iselect' >";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_paquete"];
							
						print("<option value=\"$b\">".nom($fila["nom_paquete"])."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_rela_parcela($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_parcelas where idcliente='$idcliente' ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_parcela' id='id_parcela'   class='iselect'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_parcela"];
							
						print("<option value=\"$b\">".$fila["desc_predio"]."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_asesor($id_usuario)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_promotores where uid='$id_usuario' ");
	
	
 if($fila= pg_fetch_array($consulta))
		   {
	 
			return "".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."";
			}
			else
			{
			return 0;
			
			
			}
}
function get_asesor_sol($idpromotor)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_promotores where idpromotor='$idpromotor' ");
	
	
 if($fila= pg_fetch_array($consulta))
		   {
	 
			return "".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."";
			}
			else
			{
			return 0;
			
			
			}
}

function get_parcela_m($idcliente)
{

    global $con;

	
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where idcliente='$idcliente'  order by num_predio ");
	//desconectar();
$form=3;
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_parcela' id='id_parcela' onChange='add_parcela_sol(this.value,1,".$idcliente.")'   class='modif'>";
	echo "<option value='' >Parcelas Disponibles</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idrequerimiento;
							$b=$fila["id_parcela"];
							//$descripcion="".$fila['desc_predio']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($fila["desc_predio"])."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_parcela_m_disabled($idcliente)
{

    global $con;

	
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where idcliente='$idcliente'  order by num_predio ");
	//desconectar();
$form=3;
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_parcela' id='id_parcela'   class='modif' disabled='disabled'>";

	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idrequerimiento;
							$b=$fila["id_parcela"];
							//$descripcion="".$fila['desc_predio']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($fila["desc_predio"])."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_parcelas_add($array,$idcliente)
{
  global $con;
  
  
  echo "<select name='id_parcelas' size='1'  id='id_parcelas'     class='iselect'    onChange='add_parcela_sol(this.value,2,".$idcliente.")'>";
echo "<option value='' selected='selected'>Ver Parcelas</option>";

foreach ($array as $parcelas)

 {

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where id_parcela='$parcelas' order by desc_predio  ");
		
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
				
									$b=$fila["id_parcela"];
									//$descripcion="".$fila['desc_predio']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
									
									
									
			
								
								
								 print("<option value=\"$b\"  >".nom($fila["desc_predio"])."</option>");
			
			
	$sc_hec=$fila["sc_hec"];
	$sc_area=$fila["sc_area"];
	$sc_centi=$fila["sc_centi"];
	$sc_deci=$fila["sc_deci"];
					
					$super_cultivada="";
					$super_cultivada= str_pad($sc_hec, 2, "0", STR_PAD_LEFT);
					$super_cultivada.=":";					
					$super_cultivada.=str_pad($sc_area, 2, "0", STR_PAD_LEFT); 
					$super_cultivada.=":";
					$super_cultivada.=str_pad($sc_centi, 2, "0", STR_PAD_LEFT);
					$super_cultivada.=".";
					$super_cultivada.=str_pad($sc_deci, 2, "0", STR_PAD_LEFT);	
					
					
			
			
			}
	

}
$super_cultivada_t=$super_cultivada;



	echo "</select>";
	echo "-";
	echo '<input name="superficie_productiva" type="text" class="itext" id="superficie_productiva" onchange="conMayusculas(this)" size="20" maxlength="255"  value="'.$super_cultivada_t.'" readonly="readonly">';
		
	
}


function get_parcelas_add_unic($id_parcela,$idcliente)
{
	  global $con;
	  
	  $consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where id_parcela='$id_parcela' order by desc_predio  ");
$super_cultivada_t=0;

echo "<select name='id_parcelas' id='id_parcelas'    class='iselect' onChange='add_parcela_sol(this.value,2,".$idcliente.")'>";
	echo "<option value='' selected='selected'>Ver Parcelas</option>";
	while($fila=pg_fetch_array($consulta))
	{
		
							$b=$fila["id_parcela"];
							//$descripcion="".$fila['desc_predio']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
							
							
							
	
						
						
						 print("<option value=\"$b\"  >".nom($fila["desc_predio"])."</option>");
                                 
	$sc_hec=$fila["sc_hec"];
	$sc_area=$fila["sc_area"];
	$sc_centi=$fila["sc_centi"];
	$sc_deci=$fila["sc_deci"];
	
				$super_cultivada="";
					$super_cultivada= str_pad($sc_hec, 2, "0", STR_PAD_LEFT);
					$super_cultivada.=":";					
					$super_cultivada.=str_pad($sc_area, 2, "0", STR_PAD_LEFT); 
					$super_cultivada.=":";
					$super_cultivada.=str_pad($sc_centi, 2, "0", STR_PAD_LEFT);
					$super_cultivada.=".";
					$super_cultivada.=str_pad($sc_deci, 2, "0", STR_PAD_LEFT);	
					
					

	}
	$super_cultivada_t=$super_cultivada;
	echo "</select>";
	echo "-";
	
echo '	<input name="superficie_productiva" type="text" class="itext" id="superficie_productiva" onchange="conMayusculas(this)" size="20" maxlength="255"   value="'.$super_cultivada_t.'" readonly="readonly"> ';
	
	
	
}
function get_parcelas_add_m($array,$idcliente)
{
  global $con;
  
  
  echo "<select name='id_parcelas' size='1'  id='id_parcelas'     class='iselect'    onChange='add_parcela_sol(this.value,2,".$idcliente.")'>";
echo "<option value='' selected='selected'>Ver Parcelas</option>";

foreach ($array as $parcelas)

 {

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where id_parcela='$parcelas' order by desc_predio  ");
		
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
				
									$b=$fila["id_parcela"];
									//$descripcion="".$fila['desc_predio']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
									
									
									
			
								
								
								 print("<option value=\"$b\"  >".nom($fila["desc_predio"])."</option>");
			
			
	$sc_hec=$fila["sc_hec"];
	$sc_area=$fila["sc_area"];
	$sc_centi=$fila["sc_centi"];
	$sc_deci=$fila["sc_deci"];
	
					$super_cultivada="";
					$super_cultivada= str_pad($sc_hec, 2, "0", STR_PAD_LEFT);
					$super_cultivada.=":";					
					$super_cultivada.=str_pad($sc_area, 2, "0", STR_PAD_LEFT); 
					$super_cultivada.=":";
					$super_cultivada.=str_pad($sc_centi, 2, "0", STR_PAD_LEFT);
					$super_cultivada.=".";
					$super_cultivada.=str_pad($sc_deci, 2, "0", STR_PAD_LEFT);	
					
					
			
			
			}
	

}

$super_cultivada_t=$super_cultivada;


	echo "</select>";
	
	
}
function get_parcelas_add_m_disabled($array,$idcliente)
{
  global $con;
  
  
  echo "<select name='id_parcelas' size='1'  id='id_parcelas'     class='iselect' >";


foreach ($array as $parcelas)

 {

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where id_parcela='$parcelas' order by desc_predio  ");
		
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
				
									$b=$fila["id_parcela"];
									//$descripcion="".$fila['desc_predio']." ".$fila['ap_paterno']."  ".$fila['ap_materno']." ";
									
									
									
			
								
								
								 print("<option value=\"$b\"  >".nom($fila["desc_predio"])."</option>");
			
			
	$sc_hec=$fila["sc_hec"];
	$sc_area=$fila["sc_area"];
	$sc_centi=$fila["sc_centi"];
	$sc_deci=$fila["sc_deci"];
	
				$super_cultivada="";
					$super_cultivada= str_pad($sc_hec, 2, "0", STR_PAD_LEFT);
					$super_cultivada.=":";					
					$super_cultivada.=str_pad($sc_area, 2, "0", STR_PAD_LEFT); 
					$super_cultivada.=":";
					$super_cultivada.=str_pad($sc_centi, 2, "0", STR_PAD_LEFT);
					$super_cultivada.=".";
					$super_cultivada.=str_pad($sc_deci, 2, "0", STR_PAD_LEFT);	
					
					
			
			
			}
			

}

$super_cultivada_t=$super_cultivada;


	echo "</select>";
	
	
}
function get_g_p_propia($idcliente)
{

    global $con;
//onChange='add_select_reque_paq(this.value,1); return false' 
	
	$consulta=pg_query($con,"SELECT * FROM cc_gtias_prendarias where idcliente='$idcliente' order by descripcion");
	echo "<div align='center'><select name='idgtiap' id='idgtiap'  class='modif' onChange='add_garantia_prenda(this.value,1); return false' >";
	echo "<option value='' >Seleccione Garantia Prendaria</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select></div>";
}
function get_g_p_propia_disabled($idcliente)
{

    global $con;
//onChange='add_select_reque_paq(this.value,1); return false' 
	
	$consulta=pg_query($con,"SELECT * FROM cc_gtias_prendarias where idcliente='$idcliente' order by descripcion");
	echo "<div align='center'><select name='idgtiap' id='idgtiap'  class='modif' >";
	while($fila=pg_fetch_array($consulta))
	{
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select></div>";
}

function get_g_h_propia($idcliente)
{

    global $con;
//onChange='add_select_reque_paq(this.value,1); return false' 
	
	$consulta=pg_query($con,"SELECT * FROM cc_gtias_hipotecarias where idcliente='$idcliente' order by descripcion");
	echo "<div align='center'><select name='idgtiah' id='idgtiah'  class='modif' onChange='add_garantia_hipo(this.value,1); return false'>";
	echo "<option value='' >Seleccione Garantia Hipotecaria</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select></div>";
}

function get_g_h_propia_disabled($idcliente)
{

    global $con;
//onChange='add_select_reque_paq(this.value,1); return false' 
	
	$consulta=pg_query($con,"SELECT * FROM cc_gtias_hipotecarias where idcliente='$idcliente' order by descripcion");
	echo "<div align='center'><select name='idgtiah' id='idgtiah'  class='modif' >";

	while($fila=pg_fetch_array($consulta))
	{
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select></div>";
}
function get_g_p_a()
{

    global $con;
//onChange='add_select_reque_paq(this.value,1); return false' 
	
	$consulta=pg_query($con,"SELECT * FROM cc_gtias_prendarias  order by descripcion");
	echo "<div align='center'><select name='idgtiap' id='idgtiap'  class='modif' >";
	echo "<option value='' >Seleccione</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select></div>";
}

		
function get_g_p_aval($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes where cc_clientes.idcliente not in "."("."select idcliente from cc_clientes where idcliente='$idcliente'".")"." order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno))");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<div align='center'><select name='idaval' id='idaval'    class='modif' onchange='update_g_avales(this.value,".$idcliente.",3); return false'>";
	echo "<option value='' >Selecciona aval Prendario</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select></div>";
}


function get_g_h_aval($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes where cc_clientes.idcliente not in "."("."select idcliente from cc_clientes where idcliente='$idcliente'".")"." order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno))");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<div align='center'><select name='idavalh' id='idavalh'    class='modif' onchange='update_g_avales(this.value,".$idcliente.",6); return false'>";
	echo "<option value='' >Selecciona aval Hipotecario</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select></div>";
}


function add_select_gara_p($idgtia_p)
{
	  global $con;
	  //onChange='add_garantia_prenda(this.value,1); return false'
	 $consulta=pg_query($con,"SELECT * FROM cc_gtias_prendarias where idgtia='$idgtia_p' order by descripcion");
	echo "<div align='center'><select name='idgtiap_sele' id='idgtiap_sele' class='modif' onChange='del_gara_selec(this.value,1); return false' >";
	echo "<option value='' >Ver garantias Seleccionadas</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select></div>";
	
}
function add_select_hipo_h($idgtia_h) //selecciona la primer garantia hipotecaria que se agrego
{
	  global $con;
	  //onChange='add_garantia_prenda(this.value,1); return false'
	 $consulta=pg_query($con,"SELECT * FROM cc_gtias_hipotecarias where idgtia='$idgtia_h' order by descripcion");
	echo "<div align='center'><select name='idgtiah_sele' id='idgtiah_sele' class='modif' onChange='del_gara_selec_hipo(this.value,1); return false' >";
	echo "<option value='' >Ver garantias Seleccionadas</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select></div>";
	
}

function get_gara_p_selecc($array)
{
  global $con;
  
  
 echo "<div align='center'><select name='idgtiap_sele' id='idgtiap_sele'  class='modif'  onChange='del_gara_selec(this.value,1); return false'>";
	echo "<option value='' >Ver garantias Seleccionadas</option>";

foreach ($array as $idgtia_p)

 {

		$consulta=pg_query($con,"SELECT * FROM cc_gtias_prendarias where idgtia='$idgtia_p' order by descripcion");
		
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
				
									
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
			}


}




	echo "</select>";	
	
}
function get_gara_p_selecc_disabled($array)
{
  global $con;
  
  
 echo "<div align='center'><select name='idgtiap_sele' id='idgtiap_sele'  class='modif' >";


foreach ($array as $idgtia_p)

 {

		$consulta=pg_query($con,"SELECT * FROM cc_gtias_prendarias where idgtia='$idgtia_p' order by descripcion");
		
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
				
									
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
			}


}




	echo "</select>";	
	
}
function get_gara_h_selecc($array)
{
  global $con;
  
  
 echo "<div align='center'><select name='idgtiah_sele' id='idgtiah_sele'  class='modif'  onChange='del_gara_selec_hipo(this.value,1); return false'>";
	echo "<option value='' >Ver garantias Seleccionadas</option>";

foreach ($array as $idgtia_h)

 {

		$consulta=pg_query($con,"SELECT * FROM cc_gtias_hipotecarias where idgtia='$idgtia_h' order by descripcion");
		
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
				
									
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
			}


}




	echo "</select>";	
	
}
function get_gara_h_selecc_disabled($array)
{
  global $con;
  
  
 echo "<div align='center'><select name='idgtiah_sele' id='idgtiah_sele'  class='modif' >";


foreach ($array as $idgtia_h)

 {

		$consulta=pg_query($con,"SELECT * FROM cc_gtias_hipotecarias where idgtia='$idgtia_h' order by descripcion");
		
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
				
									
							$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgtia"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($desc)."</option>");
                                 
			}


}




	echo "</select>";	
	
}

function limpia_vacio($arr)
{
       foreach($arr as $key=> $value)
      {
          if(empty($value)) unset($arr[$key]);
      }
      return $arr;
}  


function get_costo_cultivo($id_paquete)
{
//	include 'conexion.php';
    global $con;
	$total=0;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM conf_paquete where id_paquete='$id_paquete'   order by id_conf_paq ";
	   $id_query = pg_query($con,$consulta);
			
		while($fila= pg_fetch_array($id_query))
		   {
			   $total=$total+$fila["total"];
			   			
		   }
		   if($total>0)
		   {
		   $total_reque=$total/10000; 
		   return $total_reque;
		   }
		   else
		   return 0;

}

function get_parcelas_m2($idparcelas)
{
//	include 'conexion.php';
    global $con;
	$super_cultivada_t=0;

	 foreach ($idparcelas as $parcelas)

 	{

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where id_parcela='$parcelas' order by desc_predio  ");
		
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
				
					$b=$fila["id_parcela"];
							
			
			
					$sc_hec=$fila["sc_hec"];
					$sc_area=$fila["sc_area"];
					$sc_centi=$fila["sc_centi"];
					$sc_deci=$fila["sc_deci"];
					
					$super_cultivada=$sc_hec.$sc_area.$sc_centi.".".$sc_deci;
					$super_cultivada=floatval($super_cultivada);	
					
					$super_cultivada_t=$super_cultivada_t+$super_cultivada;
			
			}


	}
	return $super_cultivada_t;

}

function get_ingreso_xhec($id_paquete)
{
//	include 'conexion.php';
    global $con;


	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM paquete_tec where id_paquete='$id_paquete' ";
	   $id_query = pg_query($con,$consulta);
			
		while($fila= pg_fetch_array($id_query))
		   {
			   $ingreso=$fila["ingre_hec"]*$fila["precio_hec"];
			   			
		   }
		   return $ingreso;

}

function get_liquidez($idcliente)
{
global $con;


	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes where idcliente='$idcliente' ";
	   $id_query = pg_query($con,$consulta);
			
		while($fila= pg_fetch_array($id_query))
		   {
			  return $fila["indice_liq_exigida"];
			   			
		   }
		   
}

function get_tipo_credito_producto($idproducto)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_productos where idproducto='$idproducto' ");
	
	
 if($fila= pg_fetch_array($consulta))
		   {
	 
			return $fila["id_tipo"];
			}
			else
			{
			return "null";
			
			
			}
}

function get_promotor_usua($id_usuario)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_promotores where uid='$id_usuario' ");
	
	
 if($fila= pg_fetch_array($consulta))
		   {
	 
			return $fila["idpromotor"];
			}
			else
			{
			return "null";
			
			
			}
}

function get_solicitud()
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes   order by folio ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
		}

}

function get_solicitud_m($idsolicitud)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes where idsolicitud='$idsolicitud'   order by folio ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
		}

}

function get_superficie_cultivada_total($array_parcelas)
{
  global $con;
 
foreach ($array_parcelas as $parcelas)

 {
		
		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where id_parcela='$parcelas' order by desc_predio  ");
		
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
				
	
	$sc_hec=$fila["sc_hec"];
	$sc_area=$fila["sc_area"];
	$sc_centi=$fila["sc_centi"];
	$sc_deci=$fila["sc_deci"];
	
					$super_cultivada="";
					$super_cultivada= str_pad($sc_hec, 2, "0", STR_PAD_LEFT);
					$super_cultivada.="-";					
					$super_cultivada.=str_pad($sc_area, 2, "0", STR_PAD_LEFT); 
					$super_cultivada.="-";
					$super_cultivada.=str_pad($sc_centi, 2, "0", STR_PAD_LEFT);
					$super_cultivada.=".";
					$super_cultivada.=str_pad($sc_deci, 2, "0", STR_PAD_LEFT);	
					
					
			
			
			}


}
$super_cultivada_t=$super_cultivada;
return $super_cultivada_t;


	
}


function update_sol_modif($idcliente,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	$sql="SELECT * FROM cc_solicitudes where idcliente='$idcliente' and id_sucursal='$idsucursal' and id_periodo='$idcosecha'  order by folio";	
	$consulta=pg_query($con,$sql);
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idsolicitudes' id='idsolicitudes' onchange='actualiza_sol_cliente_modif(this.value,".$idcliente.",1); return false' class='modif'>";
	echo "<option value=''>Seleccione Solicitud</option>";
	while($fila_c=pg_fetch_array($consulta))
	{
		
	
						$folio_s=$fila_c["folio"];
						$fecha_s=$fila_c["fecha_registro"];
						$monto_s=number_format($fila_c["monto"],2);
						
						$b=$fila_c["idsolicitud"];
						
						$desc="$folio_s $fecha_s $monto_s";
						
						 print("<option value=\"$b\">".$desc."</option>");
                                 
	
	
	}
	echo "</select>";
}


function update_referencias_historial($idcliente)
{
//	include 'conexion.php';
    global $con;
	
	$consulta_sol=pg_query($con,"SELECT * FROM cc_solicitudes where idcliente='$idcliente'  order by folio");
	while($fila=pg_fetch_array($consulta_sol))
	{
		$solicitudes[]=$fila["idsolicitud"];
	}
//	onchange='actualiza_sol_cliente_modif(this.value,".$idcliente.",1); return false'
	
			echo "<select name='idsolicitudes' id='idsolicitudes'  class='modif'  onchange='rellena_campo(this.value,".$idcliente.",1); return false'>";
			echo "<option value=''>Historial de referencias	</option>";
			
			foreach	($solicitudes as $idsolicitud)
			{
			
					$consulta=pg_query($con,"SELECT * FROM cc_sol_ref_bancarias where idsolicitud='$idsolicitud'  order by banco");
					//desconectar();
				
					// Voy imprimiendo el primer select compuesto por los paises
					
					while($fila_c=pg_fetch_array($consulta))
					{
						
					
										$banco=$fila_c["banco"];
										$no_cuenta=$fila_c["no_cuenta"];
										
										
										$b=$fila_c["cns"];
										
										$num_cuenta="$banco $no_cuenta";
										
										 print("<option value=\"$b\">".$num_cuenta."</option>");
												 
					
					
					}
			
			
			}
			
			echo "</select>";
}


function get_ref_bancarias($idref)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_sol_ref_bancarias where cns='$idref' ");
	if($fila_c=pg_fetch_array($consulta))
	{
	return $fila_c;
	}
	else
	return 0;
	
}
function get_ref_personales($idref)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_sol_ref_personales where cns='$idref' ");
	if($fila_c=pg_fetch_array($consulta))
	{
	return $fila_c;
	}
	else
	return 0;
	
}
function get_estado($idestado)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_estados where idestado='$idestado' order by estado");
	if($fila_c=pg_fetch_array($consulta))
	{
	return $fila_c;
	}
	else
	return "";
	
}
function get_municipio($idmunicipio)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_municipios where idmunicipio='$idmunicipio' order by municipio");
	if($fila_c=pg_fetch_array($consulta))
	{
	return $fila_c;
	}
	else
	return "";
	
}

function get_localidad($idlocalidad)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_localidades where idlocalidad='$idlocalidad' order by localidad");
	if($fila_c=pg_fetch_array($consulta))
	{
	return $fila_c;
	}
	else
	return "";
	
}

function get_colonia($idcolonia)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_colonias where idcolonia='$idcolonia' order by colonia");
	if($fila_c=pg_fetch_array($consulta))
	{
	return $fila_c;
	}
	else
	return "";
	
}


function get_regimen($regimen_conyugal)
{
//	include 'conexion.php';
    global $con;
	
	if($regimen_conyugal>0)
	{
		$consulta=pg_query($con,"SELECT * FROM cc_regimen_conyugal where idregimen='$regimen_conyugal' order by regimen");
		
		if($fila_c=pg_fetch_array($consulta))
		{
		return $fila_c;
		}
	}
	else
	{
	return $fila=array("regimen_conyugal"=>"");
	}
	
}


function get_nom_giro($idgiro)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_giros where idgiro='$idgiro' order by giro");
	if($fila=pg_fetch_array($consulta))
		return $fila["giro"];
	else
	return "null";

}


function get_domicilio_unidad($ids_parcelas)
{
	 global $con;
$array = explode("-",$ids_parcelas); 
	foreach($array as $id_parcela)
	{
		$consulta=pg_query($con,"SELECT * FROM cc_parcelas where id_parcela='$id_parcela'");
		if($fila=pg_fetch_array($consulta))
		{
		return $fila;
		//
		}
		else
		{
			return "";
		}
		
		break;
	}
		




}

function get_tipo_credito_pdf($idproducto)
{


	$id_tipo=get_tipo_credito_producto($idproducto);
	
	return get_tipo_credito($id_tipo);
	
	
}

function get_concepinv_pdf($idcon_inv)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_conceptos_inversion where idcon_inv='$idcon_inv'");
	if($fila=pg_fetch_array($consulta))
	{
		return $fila;
	}
	else
	{
		return "";
	}
	
}


function get_paquete_tec_pdf($id_paquete)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM paquete_tec where id_paquete='$id_paquete'  order by nom_paquete";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return "";
			
			
			}

}

function get_gtia_hipo_p($ids_gara_hipotecarias,$idcliente) //funcion que devuelve suma de gtias hipo propias
{

    global $con;
	$array_hipo_p = explode("-",$ids_gara_hipotecarias); 
			$sum=0;
		    $band=0;
			
			
	$array_hipo_p=array_values($array_hipo_p);
	$array_hipo_p=array_filter($array_hipo_p);//quita cedenas vacias

	foreach($array_hipo_p as $idgtia)
	{	
	
	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_gtias_hipotecarias where idgtia='$idgtia' and idcliente='$idcliente' ";
	   $id_query = pg_query($con,$consulta);
	   
	
		if($fila= pg_fetch_array($id_query))
		   {
			   $sum=$sum+$fila["valor"];
			   $band=1;
		
			}
		
	 }
	 return $sum;
	
	
}

function get_gtia_hipo_a($ids_gara_hipotecarias,$idcliente) //funcion que devuelve suma de gtias hipo propias
{

    global $con;
	$array_hipo_a = explode("-",$ids_gara_hipotecarias); 
			$sum=0;
		    $band=0;
	
	$array_hipo_a=array_values($array_hipo_a);
	$array_hipo_a=array_filter($array_hipo_a);//quita cedenas vacias

	
	foreach($array_hipo_a as $idgtia)
	{	
	
	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_gtias_hipotecarias where idgtia='$idgtia' and idcliente<>'$idcliente' ";
	   $id_query = pg_query($con,$consulta);
	   
	
		if($fila= pg_fetch_array($id_query))
		   {
			   $sum=$sum+$fila["valor"];
			   $band=1;
		
			}
		
	 }
	 return $sum;
	
	
}

function get_gtia_pren_p($ids_gara_prendarias,$idcliente) //funcion que devuelve suma de gtias hipo propias
{

    global $con;
	$array_pren_p = explode("-",$ids_gara_prendarias); 
			$sum=0;
		    $band=0;
			
			
	$array_pren_p=array_values($array_pren_p);
	$array_pren_p=array_filter($array_pren_p);//quita cedenas vacias

	foreach($array_pren_p as $idgtia)
	{	
	
	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_gtias_prendarias where idgtia='$idgtia' and idcliente='$idcliente' ";
	   $id_query = pg_query($con,$consulta);
	   
	
		if($fila= pg_fetch_array($id_query))
		   {
			   $sum=$sum+$fila["valor"];
			   $band=1;
		
			}
		
	 }
	 return $sum;
	
	
}
function get_gtia_pren_a($ids_gara_prendarias,$idcliente) //funcion que devuelve suma de gtias hipo propias
{

    global $con;
	$array_pren_a = explode("-",$ids_gara_prendarias); 
			$sum=0;
		    $band=0;
			
			
	$array_pren_a=array_values($array_pren_a);
	$array_pren_a=array_filter($array_pren_a);//quita cedenas vacias

	foreach($array_pren_a as $idgtia)
	{	
	
	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_gtias_prendarias where idgtia='$idgtia' and idcliente<>'$idcliente' ";
	   $id_query = pg_query($con,$consulta);
	   
	
		if($fila= pg_fetch_array($id_query))
		   {
			   $sum=$sum+$fila["valor"];
			   $band=1;
		
			}
		
	 }
	 return $sum;
	
	
}

function consul_refe($referencias)
{

//   onChange='carga_select(this.id)' 
	echo "<select name='refe' id='refe' class='modif' onChange='del_select_ref_banco(this.value,1)'>";
	echo "<option value=''>Referencias Bancarias</option>";
//$i=0;
	foreach($referencias as $indice=>$valor)
	{
	
	
				
								$b=$valor["banco"];
								$cta=$valor["no_cuenta"];
								
								$desc=$b." ".$cta;
								
								 print("<option value=\"$indice\">".$desc."</option>");
							//	print("<option value=\"$i\">".$indice."</option>");
										 
			
		$i++;	
			
	}
	echo "</select>";
}


function consul_refe_sol($referencias)
{

//   onChange='carga_select(this.id)' 
	echo "<select name='refe' id='refe' class='modif' onChange='del_select_ref_banco(this.value,3)'>";
	echo "<option value=''>Referencias Bancarias</option>";

	foreach($referencias as $indice=>$valor)
	{
	
				
								$b=$valor["banco"];
								$cta=$valor["no_cuenta"];
								
								$desc=$b." ".$cta;
								
								 print("<option value=\"$indice\">".$desc."</option>");
								// print("<option value=\"$indice\">".$indice."</option>");
										 
			
			
			
	}
	echo "</select>";
}

function consul_refe_sol_disabled($referencias)
{

//   onChange='carga_select(this.id)' 
	echo "<select name='refe' id='refe' class='modif' >";
	echo "<option value=''>Referencias Bancarias</option>";

	foreach($referencias as $indice=>$valor)
	{
	
				
								$b=$valor["banco"];
								$cta=$valor["no_cuenta"];
								
								$desc=$b." ".$cta;
								
								 print("<option value=\"$indice\">".$desc."</option>");
								// print("<option value=\"$indice\">".$indice."</option>");
										 
			
			
			
	}
	echo "</select>";
}

function update_ref_personales_historial($idcliente)
{
//	include 'conexion.php';
    global $con;
	
	$consulta_sol=pg_query($con,"SELECT * FROM cc_solicitudes where idcliente='$idcliente'  order by folio");
	while($fila=pg_fetch_array($consulta_sol))
	{
		$solicitudes[]=$fila["idsolicitud"];
	}
//	onchange='actualiza_sol_cliente_modif(this.value,".$idcliente.",1); return false'
	
			echo "<select name='idsolicitudes' id='idsolicitudes'  class='modif'  onchange='rellena_campo(this.value,".$idcliente.",2); return false'>";
			echo "<option value=''>Historial de referencias	</option>";
			
			foreach	($solicitudes as $idsolicitud)
			{
			
					$consulta=pg_query($con,"SELECT * FROM cc_sol_ref_personales where idsolicitud='$idsolicitud'  order by nombre");
					//desconectar();
				
					// Voy imprimiendo el primer select compuesto por los paises
					
					while($fila_c=pg_fetch_array($consulta))
					{
						
					
										$nombre=$fila_c["nombre"];
										$telefono=$fila_c["telefono"];
										
										
										$b=$fila_c["cns"];
										
										$nombres="$nombre $telefono";
										
										 print("<option value=\"$b\">".$nombres."</option>");
												 
					
					
					}
			
			
			}
			
			echo "</select>";
}

function consul_refe_per($referencias)
{

//   onChange='carga_select(this.id)' 
	echo "<select name='refe_per' id='refe_per' class='modif' onChange='del_select_ref_personal(this.value,1)'>";
	echo "<option value=''>Referencias Personales</option>";
//$i=0;
	foreach($referencias as $indice=>$valor)
	{
	
	
				
								$nombre=$valor["nombre"];
								$direccion=$valor["direccion"];
								
								$desc=$nombre." ".$direccion;
								
								 print("<option value=\"$indice\">".$desc."</option>");
							//	print("<option value=\"$i\">".$indice."</option>");
										 
			
		$i++;	
			
	}
	echo "</select>";
}

function consul_refe_per_sol($referencias)
{

//   onChange='carga_select(this.id)' 
	echo "<select name='refe_per' id='refe_per' class='modif' onChange='del_select_ref_personal(this.value,3)'>";
	echo "<option value=''>Referencias Personales</option>";
//$i=0;
	foreach($referencias as $indice=>$valor)
	{
	
	
				
								$nombre=$valor["nombre"];
								$direccion=$valor["direccion"];
								
								$desc=$nombre." ".$direccion;
								
								 print("<option value=\"$indice\">".$desc."</option>");
							//	print("<option value=\"$i\">".$indice."</option>");
										 
			
		$i++;	
			
	}
	echo "</select>";
}


function consul_refe_per_sol_disabled($referencias)
{

//   onChange='carga_select(this.id)' 
	echo "<select name='refe_per' id='refe_per' class='modif' >";
	echo "<option value=''>Referencias Personales</option>";
//$i=0;
	foreach($referencias as $indice=>$valor)
	{
	
	
				
								$nombre=$valor["nombre"];
								$direccion=$valor["direccion"];
								
								$desc=$nombre." ".$direccion;
								
								 print("<option value=\"$indice\">".$desc."</option>");
							//	print("<option value=\"$i\">".$indice."</option>");
										 
			
		$i++;	
			
	}
	echo "</select>";
}
function inserta_refe_banco($referencias,$idsolicitud)
{
 global $con;
	foreach($referencias as $indice=>$valor)
	{
	
	
	$banco=$valor["banco"];	
	$sucursal=$valor["sucursal"];	
	$direccion=$valor["direccion"];	
	$telefono=$valor["telefono"];	
	$tipo_cuenta=$valor["tipo_cuenta"];	
	$no_cuenta=$valor["no_cuenta"];	
	$contacto=$valor["contacto"];	
		
	
	
	
		$sql="insert into cc_sol_ref_bancarias (idsolicitud,banco,sucursal,direccion,telefono,tipo_cuenta,no_cuenta,contacto) values ('$idsolicitud','$banco','$sucursal','$direccion','$telefono','$tipo_cuenta','$no_cuenta','$contacto')";
    	$consulta=pg_query($con,$sql);

			
	}

}
function inserta_refe_personal($referencias,$idsolicitud)
{
 global $con;
	foreach($referencias as $indice=>$valor)
	{
	
	
	$nombre=$valor["nombre"];	
	$direccion=$valor["direccion"];	
	$telefono=$valor["telefono"];	
		
	
	
	
		$sql="insert into cc_sol_ref_personales (idsolicitud,nombre,direccion,telefono) values ('$idsolicitud','$nombre','$direccion','$telefono')";
    	$consulta=pg_query($con,$sql);

			
	}

}

function elimina_referencias_banco($idsolicitud)
{
	 global $con;
	 
	 $sql="delete from cc_sol_ref_bancarias where idsolicitud='$idsolicitud' ";
	 
	 $query=pg_query($con,$sql);
	
}

function elimina_referencias_personales($idsolicitud)
{
	 global $con;
	 
	 $sql="delete from cc_sol_ref_personales where idsolicitud='$idsolicitud' ";
	 
	 $query=pg_query($con,$sql);
	
}

function comprueba_si_hay_refe($idsolicitud)
{
	 global $con;
	$band=0;
	$sql="select * from cc_sol_ref_bancarias where idsolicitud='$idsolicitud'";
	$query=pg_query($con,$sql);
	if($fila=pg_fetch_array($query))
	{
	$band=1;	
	}
	return $band;
	
}

function comprueba_si_hay_refeper($idsolicitud)
{
	 global $con;
	$band=0;
	$sql="select * from cc_sol_ref_personales where idsolicitud='$idsolicitud'";
	$query=pg_query($con,$sql);
	if($fila=pg_fetch_array($query))
	{
	$band=1;	
	}
	return $band;
	
}


function asigna_referencia_personal($idsolicitud)
{
	 global $con;
	$band=0;
	$sql="select * from cc_sol_ref_personales where idsolicitud='$idsolicitud'";
	$query=pg_query($con,$sql);
	while($fila=pg_fetch_array($query))
	{

$referencia=array("nombre"=>$fila["nombre"],"direccion"=>$fila["direccion"],"telefono"=>$fila["telefono"]);

$referencias[]=$referencia;	
	
	}



	return $referencias;
	
	


	
}


function asigna_referencia_bancaria($idsolicitud)
{
	 global $con;
	$band=0;
	$sql="select * from cc_sol_ref_bancarias where idsolicitud='$idsolicitud'";
	$query=pg_query($con,$sql);
	while($fila=pg_fetch_array($query))
	{

$referencia=array("banco"=>$fila["banco"],"sucursal"=>$fila["sucursal"],"direccion"=>$fila["direccion"],"telefono"=>$fila["telefono"],"tipo_cuenta"=>$fila["tipo_cuenta"],"no_cuenta"=>$fila["no_cuenta"],"contacto"=>$fila["contacto"]);

$referencias[]=$referencia;	
	
	}



	return $referencias;
	
	


	
}

function get_referencias_bancarias_pdf($idsolicitud)
{

$referencias=asigna_referencia_bancaria($idsolicitud);


//   onChange='carga_select(this.id)' 

			foreach($referencias as $indice=>$valor)
			{
				echo "<tr>";
					
					
					
			
				?>		
						
						<td bgcolor="#DFDFDF" align="center">   <?php echo nom($valor["banco"]); ?>     </td>
						<td bgcolor="#DFDFDF" align="center">   <?php echo nom($valor["sucursal"]); ?>     </td>
						<td bgcolor="#DFDFDF" align="center"> <font size="7">  <?php echo nom($valor["direccion"]); ?>  </font>   </td>
						<td bgcolor="#DFDFDF" align="center">   <?php echo $valor["telefono"]; ?>    </td>
						<td bgcolor="#DFDFDF" align="center">   <?php echo nom($valor["tipo_cuenta"]); ?>     </td>
						<td bgcolor="#DFDFDF" align="center">   <?php echo $valor["no_cuenta"]; ?>    </td>
						<td bgcolor="#DFDFDF" align="center"><font size="5">   <?php echo nom($valor["contacto"]); ?>  </font>   </td>
						
												 
				<?php	
				echo "</tr>";				
							
			}

	?>

    <?php
}


function get_referencias_personales_pdf($idsolicitud)
{

$referencias=asigna_referencia_personal($idsolicitud);


//   onChange='carga_select(this.id)' 

	foreach($referencias as $indice=>$valor)
	{
		echo "<tr>";
			
			
			
	
		?>		
				
				<td bgcolor="#DFDFDF" align="center">   <?php echo nom($valor["nombre"]); ?>     </td>
				<td bgcolor="#DFDFDF" align="center">   <?php echo nom($valor["direccion"]); ?>     </td>
				<td bgcolor="#DFDFDF" align="center">  <?php echo nom($valor["telefono"]); ?>    </td>
				
										 
		<?php	
		echo "</tr>";				
					
	}

	?>

    <?php
}


function get_exits_sol_grupo()
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_sol_grupos ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return 1;
			}
			else
			{
			return 0;
			
			
			}

}

function get_grupo_solicitudes()
{

    global $con;
//onChange='add_select_reque_paq(this.value,1); return false' 
	
	$consulta=pg_query($con,"SELECT * FROM cc_grupos  order by grupo");
	echo "<select name='idgrupo' id='idgrupo'  class='modif' onChange='update_solicitud_grupal(this.value,1); return false' >";
	echo "<option value='' >Seleccione Grupo</option>";
	while($fila=pg_fetch_array($consulta))
	{
							//$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgrupo"];
							
							
							
	
						
						
						 print("<option value=\"$b\">".nom($fila["grupo"])."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_grupo_solicitudes_div_update($idgrupo)
{

    global $con;
//onChange='add_select_reque_paq(this.value,1); return false' 
	
	$consulta=pg_query($con,"SELECT * FROM cc_grupos  order by grupo");
	echo "<select name='idgrupo' id='idgrupo'  class='modif' onChange='update_solicitud_grupal_update_div(this.value,3); return false' >";
	echo "<option value='' >Seleccione Grupo</option>";
	while($fila=pg_fetch_array($consulta))
	{
							//$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgrupo"];
							
							if($b==$idgrupo)
							print("<option value=\"$b\" selected='selected'>".nom($fila["grupo"])."</option>");
							else
							print("<option value=\"$b\">".nom($fila["grupo"])."</option>");
							
	
						
						
						 
                                 
	
	
	}
	echo "</select>";
}

function get_grupo_solicitudes_m($idgrupo)
{

    global $con;
//onChange='add_select_reque_paq(this.value,1); return false' 
	
	$consulta=pg_query($con,"SELECT * FROM cc_grupos  order by grupo");
	echo "<select name='idgrupo' id='idgrupo'  class='modif' onChange='update_solicitud_grupal(this.value,1); return false' >";
	echo "<option value='' >Seleccione Grupo</option>";
	while($fila=pg_fetch_array($consulta))
	{
							//$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgrupo"];
							
							
							
	
						if($b==$idgrupo)
						print("<option value=\"$b\" selected='selected'>".nom($fila["grupo"])."</option>");
						else
						print("<option value=\"$b\">".nom($fila["grupo"])."</option>");
						
						 
                                 
	
	
	}
	echo "</select>";
}

function get_grupo_solicitudes_m_update($idgrupo)
{

    global $con;
//onChange='add_select_reque_paq(this.value,1); return false' 
	
	$consulta=pg_query($con,"SELECT * FROM cc_grupos  order by grupo");
	echo "<select name='idgrupo' id='idgrupo'  class='modif' onChange='update_solicitud_grupal_update(this.value,3); return false' >";
	echo "<option value='' >Seleccione Grupo</option>";
	while($fila=pg_fetch_array($consulta))
	{
							//$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idgrupo"];
							
							
							
	
						if($b==$idgrupo)
						print("<option value=\"$b\" selected='selected'>".nom($fila["grupo"])."</option>");
						else
						print("<option value=\"$b\">".nom($fila["grupo"])."</option>");
						
						 
                                 
	
	
	}
	echo "</select>";
}

function get_grupo_solicitudes_folios($idgrupo,$idsolgrupo,$idsucursal,$idcosecha)
{

    global $con;
//onChange='add_select_reque_paq(this.value,1); return false' 
	
	$consulta=pg_query($con,"SELECT * FROM cc_sol_grupos where idgrupo='$idgrupo' and id_sucursal='$idsucursal' and id_periodo='$idcosecha'  order by folio");
	echo "<select name='idsolgrupos' id='idsolgrupos'  class='modif' onChange='update_solicitud_grupal_update(this.value,4); return false' >";
	echo "<option value='' >Solicitudes de Grupo</option>";
	while($fila=pg_fetch_array($consulta))
	{
							//$desc= limitarPalabras($fila["descripcion"],15);
							
							$b=$fila["idsolgrupo"];
							
							$folio=$fila["folio"];
							$fecha=$fila["fecha_solicitud"];
							
							$fila_cliente=get_cliente($fila["idcliente"]);
							
							$nombre_cliente=$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"];
							
							if($fila["vigente"]=='t')
							{
							$status="Activo";
							}
							else
							{
							$status="Inactivo";
							}
							
							
							$descripcion=$folio." ".$fecha." ".$nombre_cliente." ".$status;
							
	
						
						if($b==$idsolgrupo)
						 print("<option value=\"$b\" selected='selected'>".nom($descripcion)."</option>");
						 else
						 print("<option value=\"$b\">".nom($descripcion)."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_grupo_sol_alta()
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_sol_grupos  order by folio desc";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}

function get_grupo_sol_consulta_sol($idgrupo,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_sol_grupos where idgrupo='$idgrupo' and id_sucursal='$idsucursal' and id_periodo='$idcosecha' order by folio desc";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}

function get_grupo_sol_modif($idsolgrupo,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_sol_grupos where idsolgrupo='$idsolgrupo' and id_sucursal='$idsucursal' and id_periodo='$idcosecha' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}


function get_sol_individuales($idgrupo)
{

    global $con;
	$idestatus=1; //quiere decir q ue la solicitud se encuentre en tramite

//onChange='add_select_reque_paq(this.value,1); return false' 

//ver quienes son los productores de ese grupo
//ver que solicitudes an hecho los productoress de ese grupo
//ver que solicitudes estan disponibles para la solicitud grupal

$sql="SELECT * FROM cc_solicitudes WHERE cc_solicitudes.idcliente in "."("."SELECT idcliente FROM rela_grupo WHERE rela_grupo.idgrupo='$idgrupo' and rela_grupo.idcliente=cc_solicitudes.idcliente".")"." and cc_solicitudes.idestatus='$idestatus'"." and cc_solicitudes.idsolicitud not in "." ("." SELECT idsolicitud FROM rela_sol_grupo WHERE rela_sol_grupo.idsolicitud=cc_solicitudes.idsolicitud".")"." order by cc_solicitudes.folio";

	$consulta=pg_query($con,$sql);
	echo "<select name='idsolicitud' id='idsolicitud'  class='modif' onChange='add_sol_grupal(this.value,1); return false'>";
	echo "<option value='' >Solicitudes Individuales</option>";
	while($fila=pg_fetch_array($consulta))
	{
						
							
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						
						
						
						
						
						$folio_s=$fila["folio"];
						$fecha_s=$fila["fecha_registro"];
						$monto_s=number_format($fila["monto"],2);
						
						$b=$fila["idsolicitud"];
						
						
						$desc="$folio_s $fecha_s $monto_s ".nom($nom_cliente);
						
						 print("<option value=\"$b\">".$desc."</option>");
                                 
							
	
						
						
					
                                 
	
	
	}
	echo "</select>";
}

function tab($no)
{
for($x=0; $x<$no; $x++)
$tab.="-";
return $tab;
}
function get_sol_grupales($idsolgrupo)
{

    global $con;
	$idestatus=1; //quiere decir q ue la solicitud se encuentre en tramite

//onChange='add_select_reque_paq(this.value,1); return false' and cc_solicitudes.idestatus='$idestatus'

//ver quienes son los productores de ese grupo
//ver que solicitudes an hecho los productoress de ese grupo
//ver que solicitudes estan disponibles para la solicitud grupal
$consulta=pg_query($con,"SELECT * FROM rela_sol_grupo,cc_solicitudes where rela_sol_grupo.idsolicitud=cc_solicitudes.idsolicitud and rela_sol_grupo.idsolgrupo='$idsolgrupo'   order by cc_solicitudes.folio");

	echo "<select name='id_rela_sol' id='id_rela_sol'  class='modif' onChange='add_sol_grupal_del(this.value,2); return false'>";
	echo "<option value='' >Solicitudes Del Grupo</option>";
	while($fila=pg_fetch_array($consulta))
	{
							//$desc= limitarPalabras($fila["descripcion"],15);
							
$idcliente=$fila["idcliente"];
$fila_cliente=get_cliente($idcliente);
$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
$nom_cliente= limitarPalabras($nom_cliente,35); 
						
						
						$folio_s=$fila["folio"];
						$fecha_s=$fila["fecha_registro"];
						$monto_s=number_format($fila["monto"],2);
						
						$b=$fila["id_rela_sol"];
						
						$desc="$folio_s $fecha_s $monto_s ".nom($nom_cliente);
			
						print("<option value=\"$b\">".$desc."</option>");
                                 
							
	
						
						
					
                                 
	
	
	}
	echo "</select>";
}

function get_exists_grupo_solicitud($idrelasol)
{
 global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM rela_sol_grupo where id_rela_sol='$idrelasol' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			$idsolicitud=$fila["idsolicitud"];
			$fila=get_solicitud_m($idsolicitud);
			
			if($fila["idestatus"]==1)
			return 1;
			else
			return 0;
			}
			else
			{return 0;}
				
}

function verifica_ref_banco($idsolicitud)
{
	global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_sol_ref_bancarias where idsolicitud='$idsolicitud' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		  return 1;
		  else
		  return 0;
		
}

function verifica_ref_personal($idsolicitud)
{
	global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_sol_ref_personales where idsolicitud='$idsolicitud' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		  return 1;
		  else
		  return 0;
		
}

function get_estatus($idestatus)
{
	global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_estatus_solicitud where idestatus='$idestatus' ";
	   $id_query = pg_query($con,$consulta);
		 if($fila= pg_fetch_array($id_query))
		  return $fila;
		  else
		  return "";
		
}

function get_sol_indv_pdf()
{

    global $con;
	

$sql="SELECT * FROM cc_solicitudes  order by folio";

	$consulta=pg_query($con,$sql);
	while($fila=pg_fetch_array($consulta))
	{
		?>
        <tr>
        <?php
						
							
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						$estatus=get_estatus($fila["idestatus"]);
						
				?>
<td align="left" ><?php echo nom($nom_cliente); ?></td>                
<td align="center" ><?php echo $fila["folio"];?></td>
<td align="center" ><?php echo $fila["fecha_registro"];?></td>
<td align="right" ><?php echo number_format($fila["monto"],2);?></td>
<td align="center" ><?php echo nom($estatus["estatus"]); ?></td>
				
                <?php
				if($fila["idestatus"]!=5)	
                $subtotal+=$fila["monto"];             		
                                 
							
	
						
						
		echo "</tr>";			
                                 
	
	
	}
return $subtotal;
}



function get_sol_clientes_pdf()
{

    global $con;
	

	$sql="SELECT * FROM cc_clientes  order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno))";

	$consulta=pg_query($con,$sql);
	while($fila=pg_fetch_array($consulta))
	{
		$fila=get_cliente($fila["idcliente"]);
		$estado=get_estado($fila["idestado"]);
		$municipio=get_municipio($fila["idmunicipio"]);
		$localidad=get_localidad($fila["idlocalidad"]);
		$colonia=get_colonia($fila["idcolonia"]);
		
		$masculino=$fila["masculino"];
		if($masculino=='t')
		{
		$genero="Masculino";
		}
		else
		{
		$genero="Femenino";
		}
		$regimen_conyugal=get_regimen($fila["regimen_conyugal"]);
		$grupo=get_grupo_sol($fila["idcliente"]);

		
		?>
       
       <table width="100%" border="1">
  <tr>
    <td bgcolor="#DFDFDF">Nombre</td>
    <td colspan="4"><?php echo nom($fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]); ?></td>
    <td bgcolor="#DFDFDF">Rfc</td>
    <td><?php echo nom($fila["rfc"]); ?></td>
  </tr>
  <tr>
    <td bgcolor="#DFDFDF">Domicilio</td>
    <td colspan="4"><?php echo nom($fila["domicilio"]); ?></td>
    <td bgcolor="#DFDFDF">Sexo</td>
    <td><?php echo nom($genero); ?></td>
  </tr>
  <tr>
    <td bgcolor="#DFDFDF">Colonia</td>
    <td colspan="2"><?php echo nom($estado["estado"]); ?></td>
    <td bgcolor="#DFDFDF">Localidad</td>
    <td><?php echo nom($localidad["localidad"]); ?></td>
    <td bgcolor="#DFDFDF">Municipio</td>
    <td><?php echo nom($municipio["municipio"]); ?></td>
  </tr>
  <tr>
    <td bgcolor="#DFDFDF">Curp</td>
    <td colspan="2"><?php echo nom($fila["curp"]); ?></td>
    <td bgcolor="#DFDFDF">Estado</td>
    <td><?php echo nom($estado["estado"]) ?></td>
    <td bgcolor="#DFDFDF">Tel&eacute;fono</td>
    <td><?php echo nom($fila["telefono1"]); ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#DFDFDF">Nombre del conyugue</td>
    <td colspan="2"><?php echo nom($fila["nombre_conyuge"]); ?></td>
    <td align="center" bgcolor="#DFDFDF">R&eacute;gimen Conyugal</td>
    <td colspan="2" align="center"><?php echo nom($regimen_conyugal["regimen"]); ?></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#DFDFDF">No de integrantes de la Familia</td>
    <td><?php echo nom($fila["integrantes_familia"]); ?></td>
    <td bgcolor="#DFDFDF">Grupo</td>
    <td colspan="2"><?php echo nom($grupo["grupo"]); ?></td>
  </tr>
  <tr>
    <td colspan="3"></td>
    <td colspan="2" bgcolor="#DFDFDF">Beneficiario</td>
    <td colspan="2"><?php echo nom($fila["nombre_conyuge"]); ?></td>
  </tr>
</table>
       
       <?php		
                                 
	
	
	}

}


function get_sol_cliente_pdf()
{
	global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes order by folio ";
	   $id_query = pg_query($con,$consulta);
		 if($fila= pg_fetch_array($id_query))
		  return 1;
		  else
		  return 0;
		
}
function get_sol_grupos_pdf()
{
	global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_sol_grupos order by folio ";
	   $id_query = pg_query($con,$consulta);
		 if($fila= pg_fetch_array($id_query))
		  return 1;
		  else
		  return 0;
		
}

function get_sol_grupos_clientes_pdf()
{

    global $con;
	

$sql="SELECT * FROM cc_sol_grupos  order by folio";




	$consulta=pg_query($con,$sql);
	while($fila=pg_fetch_array($consulta))
	{
		 $idsolgrupo=$fila["idsolgrupo"];
		 $idgrupo=$fila["idgrupo"];
		 $fecha_solicitud=$fila["fecha_solicitud"];
		 $idproducto=$fila["idproducto"];
		  $fila_g=get_grupo_m($idgrupo);
		  $grupo=$fila_g["grupo"];
		  $folio=$fila["folio"];
		
		?>
        
<table width="100%" border="1" cellpadding="2">
  <tr>
    <td align="center"><div align="center">Fecha</div></td>
    <td align="center"><?php echo $fecha_solicitud; ?></td>
    <td align="center"><div align="center">Grupo</div></td>
    <td align="center"><?php echo nom($grupo); ?></td>
    <td align="center"><div align="center">Folio</div></td>
    <td align="center"><?php echo $folio; ?></td>
  </tr>
  <tr>
    <td colspan="3" ><div align="center">Productores</div></td>
    <td colspan="3"><div align="center">Solicitudes</div></td>
  </tr>

        <?php
									
get_sol_grupales_pdf($idsolgrupo);				
?>
</table>
<?php
	}

}


function get_sol_grupales_pdf($idsolgrupo)
{

    global $con;
	$idestatus=1; //quiere decir q ue la solicitud se encuentre en tramite

$consulta=pg_query($con,"SELECT * FROM rela_sol_grupo,cc_solicitudes where rela_sol_grupo.idsolicitud=cc_solicitudes.idsolicitud and rela_sol_grupo.idsolgrupo='$idsolgrupo'   order by cc_solicitudes.folio");
while($fila=pg_fetch_array($consulta))
	{

?>
<tr>
<?php				//$desc= limitarPalabras($fila["descripcion"],15);
							
$idcliente=$fila["idcliente"];
$fila_cliente=get_cliente($idcliente);
$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
$nom_cliente= limitarPalabras($nom_cliente,35); 
						
						
						$folio_s=$fila["folio"];
						$fecha_s=$fila["fecha_registro"];
						$monto_s=number_format($fila["monto"],2);
						
						$b=$fila["id_rela_sol"];
						
						$desc="$folio_s $fecha_s $ $monto_s ";
			
					
					
					
					?>
                    <td colspan="3" align="center" ><?php echo nom($nom_cliente); ?></td>
                    <td colspan="3" align="center" ><?php echo $desc; ?></td>
                    <?php
                                 
							
	
						
						
	?>
</tr>
<?php					
                                 
	
	
	}
	
	?>
    <tr><td colspan="6"></td></tr>
    <?php
	
}


function get_clientes_expediente()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)) ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='actualiza_sol_expediente(this.value,1)'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_clientes_creditos_auto()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes order by nombre ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='cc_actualiza_sol_expediente(this.value,4)'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}


function update_expediente_clientes($idcliente,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes where idcliente='$idcliente'  and id_sucursal='$idsucursal' and id_periodo='$idcosecha'  order by folio");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idsolicitudes' id='idsolicitudes' onchange='actualiza_detalle_cliente_solicitud(this.value,2); return false' class='modif'>";
	echo "<option value=''>Seleccione Solicitud</option>";
	while($fila_c=pg_fetch_array($consulta))
	{
		
	
						$folio_s=$fila_c["folio"];
						$fecha_s=$fila_c["fecha_registro"];
						$monto_s=number_format($fila_c["monto"],2);
						
						$b=$fila_c["idsolicitud"];
						
						$desc="$folio_s $fecha_s $monto_s";
						
						 print("<option value=\"$b\">".$desc."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_datos_cliente($idsolicitud)
{
	
	$solicitud=get_solicitud_m($idsolicitud);
	
	$cliente=get_cliente($solicitud["idcliente"]);
	
	?>

    <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">Nombre</td>
    <td align="center"><strong><?php echo $cliente["nombre"]." ".$cliente["ap_paterno"]." ".$cliente["ap_materno"]; ?></strong></td>
    <td align="center">Curp</td>
    <td align="center"><strong><?php echo $cliente["curp"]; ?></strong></td>
    
  </tr>
  <tr>
    <td align="center">Folio de solicitud</td>
   <td align="center"><strong><?php echo $solicitud["folio"]; ?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>

    <?php
	
	
}


function get_datos_cliente_credito($idsolicitud,$idcredito)
{
	
	$solicitud=get_solicitud_m($idsolicitud);
	
	$cliente=get_cliente($solicitud["idcliente"]);
	
	$fila_credito=get_credito_m($idcredito);
	$fila_producto=get_producto_m($fila_credito["idproducto"]);
	
	?>

    <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">Nombre</td>
    <td align="center"><strong><?php echo $cliente["nombre"]." ".$cliente["ap_paterno"]." ".$cliente["ap_materno"]; ?></strong></td>
    <td align="center">Folio de Cr&eacute;dito</td>
    <td align="center"><strong><?php echo $fila_credito["folio"]; ?></strong></td>
    
  </tr>
  <tr>
    <td align="center">Monto Autorizado</td>
   <td align="center"><strong><?php echo number_format($fila_credito["monto"],2); ?></strong></td>
    <td align="center">Fecha de autorizaci&oacute;n</td>
    <td align="center"><strong><?php echo $fila_credito["f_ministracion"]; ?></strong></td>
  </tr>
  
  <tr>
    <td align="center">Producto Financiero</td>
   <td align="center"><strong><?php echo $fila_producto["producto"]; ?></strong></td>
    <td align="center">Plazo</td>
    <td align="center"><strong><?php echo $fila_credito["meses"]; ?> meses</strong></td>
  </tr>

</table>

    <?php
	
	
}

function recupera_expediente($idsolicitud)
{
	 global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_expedientes where idsolicitud='$idsolicitud'");
	if($fila=pg_fetch_array($consulta))
	{
	return $fila;
	}
	else
	{
	return 0;
	}

}


function inserta_expediente($expedientes)
{
	
	 global $con;
	$detalles=serialize($expedientes);
	
	$inserta="update cc_expedientes set detalle_expediente='$detalles'";

	$consulta=pg_query($con,$inserta);
	
	if($consulta>0)
	return $expedientes;
	
	
}

function get_tabla_detalles($idexpediente,$idsolicitud)
{
	
	 global $con;
	 ?>
      
<table width="70%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>Id</td>
    <td>Nombre</td>
    <td align="center">Original</td>
    <td>Copia</td>
    <td>Digital</td>
  </tr>

<?php

$cliente=get_solicitud_m($idsolicitud);


	$consulta=pg_query($con,"SELECT * FROM cc_detalles_expediente where idexpediente='$idexpediente' order by idconcepto");
	while($fila=pg_fetch_array($consulta))
	{
		?>
		<tr>
		<td onmouseover="cambiacolor_over(this)" onmouseout="cambiacolor_out(this)"><?php echo $fila["idconcepto"]; ?></td>
		
		<td onmouseover="cambiacolor_over(this)" onmouseout="cambiacolor_out(this)"><?php echo get_tipo_documento_ex($fila["idconcepto"]); ?></td>
		
		<td align="center" onmouseover="cambiacolor_over(this)" onmouseout="cambiacolor_out(this)">
		<?php 
		if($fila["original"]=="t") 
		{
		?>
		<input type="checkbox" name="original" value="<?php echo $fila["cns"]; ?>" id="<?php echo $fila["cns"]; ?>"   checked="checked"  onclick='entrega_doc(this.id,this.value,3,<?php echo $idsolicitud; ?>); return false'>
		<?php
		}
		else
		{
		?>
		<input type="checkbox" name="original" value="<?php echo $fila["cns"]; ?>" id="<?php echo $fila["cns"]; ?>"  onclick='entrega_doc(this.id,this.value,3,<?php echo $idsolicitud; ?>); return false'>
		<?php
		}
		?>
		</td>
        	<td align="center" onmouseover="cambiacolor_over(this)" onmouseout="cambiacolor_out(this)">
		<?php 
		if($fila["entregado"]=="t") 
		{
		?>
		<input type="checkbox" name="copia" value="<?php echo $fila["cns"]; ?>" id="co<?php echo $fila["cns"]; ?>"   checked="checked"  onclick='entrega_doc(this.id,this.value,4,<?php echo $idsolicitud; ?>); return false'>
		<?php
		}
		else
		{
		?>
		<input type="checkbox" name="copia" value="<?php echo $fila["cns"]; ?>" id="co<?php echo $fila["cns"]; ?>"  onclick='entrega_doc(this.id,this.value,4,<?php echo $idsolicitud; ?>); return false'>
		<?php
		}
		?>
		</td>
		
        
        <td onmouseover="cambiacolor_over(this)" onmouseout="cambiacolor_out(this)" align="center" >
        
               
   <?php
   $idconcepto=$fila["idconcepto"];
   $idcliente=$cliente["idcliente"];
   
   
$sql="SELECT * FROM expediente where idcliente='$idcliente' and idconcepto='$idconcepto'";
$res=pg_query($con,$sql); 
while($registro=pg_fetch_array($res)) 
{ 

// $idconcepto=$registro["idconcepto"];
 $ubicacion=$registro["ubicacion"];
 $nom_doc=get_documento($idconcepto);

	  $img='VER';	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"ver_imagen('".$idcliente."','".$idconcepto."')\" >".$img."</a>";
  
}
?>

  </td>
        
		</tr>
		
		<?php
	
}


?>  
<tr>
    <td colspan="5" align="center"> <input class="ibutton" type="button" name="comite" id="comite" value="ENVIAR A COMIT&Eacute;"  onclick="envia_comite(<?php echo $idsolicitud; ?>); return false" /></td>
    </tr>	
  
</table>

<?php
	
}


function get_tipo_documento_ex($idconcepto)
{
 global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_conceptos_expediente where idconcepto='$idconcepto'");
	if($fila=pg_fetch_array($consulta))
	{
		$concepto=$fila["concepto"];
		return $concepto;
	}
	
}

function cambia_estado($valor,$estatus)
{
 global $con;
	$consulta=pg_query($con,"UPDATE cc_detalles_expediente set original='$estatus' where cns='$valor'");
	if($consulta>0)
	{
		return 1;
	}
	
}
function cambia_estado_copia($valor,$estatus)
{
 global $con;
	$consulta=pg_query($con,"UPDATE cc_detalles_expediente set entregado='$estatus' where cns='$valor'");
	if($consulta>0)
	{
		return 1;
	}
	
}

function get_tabla_detalles_consulta_comite($idexpediente,$idsolicitud)
{
	
	 global $con;
	 ?>
      
<table width="80%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>Id</td>
    <td>Nombre</td>
    <td align="center">Original</td>
    <td>Copia</td>
    <td>Digital</td>
  </tr>

<?php

$cliente=get_solicitud_m($idsolicitud);


	$consulta=pg_query($con,"SELECT * FROM cc_detalles_expediente where idexpediente='$idexpediente' order by idconcepto");
	while($fila=pg_fetch_array($consulta))
	{
		?>
		<tr>
		<td onmouseover="cambiacolor_over(this)" onmouseout="cambiacolor_out(this)"><?php echo $fila["idconcepto"]; ?></td>
		
		<td onmouseover="cambiacolor_over(this)" onmouseout="cambiacolor_out(this)"><?php echo get_tipo_documento_ex($fila["idconcepto"]); ?></td>
		
		<td align="center" onmouseover="cambiacolor_over(this)" onmouseout="cambiacolor_out(this)">
		<?php 
		if($fila["original"]=="t") 
		{
		?>
		<input type="checkbox" name="original" value="<?php echo $fila["cns"]; ?>" id="<?php echo $fila["cns"]; ?>"   checked="checked" disabled="disabled">
		<?php
		}
		else
		{
		?>
		<input type="checkbox" name="original" value="<?php echo $fila["cns"]; ?>" id="<?php echo $fila["cns"]; ?>"  disabled="disabled">
		<?php
		}
		?>
		</td>
        	<td align="center" onmouseover="cambiacolor_over(this)" onmouseout="cambiacolor_out(this)">
		<?php 
		if($fila["entregado"]=="t") 
		{
		?>
		<input type="checkbox" name="copia" value="<?php echo $fila["cns"]; ?>" id="co<?php echo $fila["cns"]; ?>"   checked="checked"  disabled="disabled">
		<?php
		}
		else
		{
		?>
		<input type="checkbox" name="copia" value="<?php echo $fila["cns"]; ?>" id="co<?php echo $fila["cns"]; ?>"  disabled="disabled">
		<?php
		}
		?>
		</td>
		
        
        <td onmouseover="cambiacolor_over(this)" onmouseout="cambiacolor_out(this)" align="center" >
        
               
   <?php
   $idconcepto=$fila["idconcepto"];
   $idcliente=$cliente["idcliente"];
   
   
$sql="SELECT * FROM expediente where idcliente='$idcliente' and idconcepto='$idconcepto'";
$res=pg_query($con,$sql); 
while($registro=pg_fetch_array($res)) 
{ 

// $idconcepto=$registro["idconcepto"];
 $ubicacion=$registro["ubicacion"];
 $nom_doc=get_documento($idconcepto);

	  $img='VER';	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"ver_imagen('".$idcliente."','".$idconcepto."')\" >".$img."</a>";
  
}
?>

  </td>
        
		</tr>
		
		<?php
	
}


?>  
<tr>
    <td colspan="5" align="center"> <input class="ibutton" type="button" name="comite" id="comite" value="ENVIAR A COMIT&Eacute;"  onclick="envia_comite(<?php echo $idsolicitud; ?>); return false" disabled="disabled"></td>
    </tr>	
  
</table>

<?php
	
}


function consulta_expediente_autorizacion($idexpediente,$idsolicitud)
{
	
	 global $con;
	 ?>
      
<table width="80%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td align="center">Id</td>
    <td align="center">Nombre</td>
    <td align="center">Original</td>
    <td align="center">Copia</td>
    <td align="center">Digital</td>
  </tr>

<?php

$cliente=get_solicitud_m($idsolicitud);


	$consulta=pg_query($con,"SELECT * FROM cc_detalles_expediente where idexpediente='$idexpediente' order by idconcepto");
	while($fila=pg_fetch_array($consulta))
	{
		?>
		<tr>
		<td align="center" ><?php echo $fila["idconcepto"]; ?></td>
		
		<td align="left" ><?php echo get_tipo_documento_ex($fila["idconcepto"]); ?></td>
		
		<td align="center" >
		<?php 
		if($fila["original"]=="t") 
		{
		?>
		<input type="checkbox" name="original" value="<?php echo $fila["cns"]; ?>" id="<?php echo $fila["cns"]; ?>"   checked="checked" disabled="disabled">
		<?php
		}
		else
		{
		?>
		<input type="checkbox" name="original" value="<?php echo $fila["cns"]; ?>" id="<?php echo $fila["cns"]; ?>"  disabled="disabled">
		<?php
		}
		?>
		</td>
        	<td align="center" >
		<?php 
		if($fila["entregado"]=="t") 
		{
		?>
		<input type="checkbox" name="copia" value="<?php echo $fila["cns"]; ?>" id="co<?php echo $fila["cns"]; ?>"   checked="checked"  disabled="disabled">
		<?php
		}
		else
		{
		?>
		<input type="checkbox" name="copia" value="<?php echo $fila["cns"]; ?>" id="co<?php echo $fila["cns"]; ?>"  disabled="disabled">
		<?php
		}
		?>
		</td>
		
        
        <td align="center" >
        
               
   <?php
   $idconcepto=$fila["idconcepto"];
   $idcliente=$cliente["idcliente"];
   
   
$sql="SELECT * FROM expediente where idcliente='$idcliente' and idconcepto='$idconcepto'";
$res=pg_query($con,$sql); 
while($registro=pg_fetch_array($res)) 
{ 

// $idconcepto=$registro["idconcepto"];
 $ubicacion=$registro["ubicacion"];
 $nom_doc=get_documento($idconcepto);

	//  $img='VER';	
  	 // echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"ver_imagen('".$idcliente."','".$idconcepto."')\" >".$img."</a>";
 
 
  $idconcepto=$registro["idconcepto"];
 $nom_doc=get_documento($idconcepto);
?>  
<ul class="gallery clearfix">
<div align="center">
<a href="../clientes/<?php echo $ubicacion; ?>"  rel="prettyPhoto[]" title="<?php echo nom($nom_doc); ?>" >
  <img src="../clientes/<?php echo $ubicacion; ?>"  width="30" height="30">
  </a>
  </div>
  </ul>
 <?php
  
}
?>

  </td>
        
		</tr>
		
		<?php
	
}


?>  

  
</table>

<?php
	
}

function cambia_estado_sol($idsolicitud)
{
	$idestatus=2;//dato recuperado de la tabla de cc_estatus_solicitud cambiamos agendadda
	
 global $con;
	$consulta=pg_query($con,"UPDATE cc_solicitudes set idestatus='$idestatus' where idsolicitud='$idsolicitud'");
	if($consulta>0)
	{
		return 1;
	}
	
}


function get_status_comite($idsolicitud)
{
	global $con;
	$consulta=pg_query($con,"select idestatus from cc_solicitudes where idsolicitud='$idsolicitud'");
	if($fila=pg_fetch_array($consulta))
	{
		if($fila["idestatus"]==1)
		return 1;
		if($fila["idestatus"]!=1)
		return 0;
	}
}

function get_solicitudes_agendadas($idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	$idestatus=2; //solicitudes agendadas
	
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes where idestatus='$idestatus' and id_sucursal='$idsucursal' and id_periodo='$idcosecha'  order by folio");
	
	
	
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idsolicitude' id='idsolicitud' onchange='autoriza_solicitud(this.value,1); return false' class='consultor3'>";
	echo "<option value=''>Seleccione Solicitud</option>";
	while($fila_c=pg_fetch_array($consulta))
	{
		
	
						$folio_s=$fila_c["folio"];
						$fecha_s=$fila_c["fecha_registro"];
						$monto_s=number_format($fila_c["monto"],2);
						
						$b=$fila_c["idsolicitud"];
						
						
						$fila_cliente=get_cliente($fila_c["idcliente"]);				
						$nombre_cliente=$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"];
						
						
						$desc="$nombre_cliente $monto_s $folio_s $fecha_s ";
						
						 print("<option value=\"$b\">".$desc."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_menu_comite($idsolicitud)
{
	echo "<div id='bloque'>";
	
	
//	  $img='VER';	
  //	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"ver_imagen('".$idcliente."','".$idconcepto."')\" >".$img."</a>";
	
	?>
<br />

<table width="60%" border="0">
  <tr>
   
    <td align="center"><input type="button" class="pestana" value="CLIENTES" onclick='ver_cliente(<?php echo $idsolicitud; ?>,2); return false'></td>
    <td align="center"><input type="button" class="pestana" value="SOLICITUD" onclick='ver_solicitud(<?php echo $idsolicitud; ?>,3); return false'></td>
    <td align="center"><input type="button" class="pestana" value="EXPEDIENTE" onclick='ver_expediente(<?php echo $idsolicitud; ?>,3); return false'></td>
    
    <td align="center"><input type="button" class="pestana" value="HISTORIAL"></td>
  </tr>
  </table>
    
    <?php 
	
	echo "</div>";
	
}


function get_credito_m($idcredito)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT cr.*,(select fechaven from cc_disposicion_parafin where coddisp=cr.iddisposicion) as fechaven FROM cc_creditos cr where idcredito='$idcredito'   order by folio ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
		}

}
function get_credito_mm($idcredito)
{
//	include 'conexion.php';
    global $con;

	   $consulta="SELECT * FROM cc_creditos where idcredito='$idcredito'   order by folio ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
		}

}
function get_credito_sol($idsolicitud)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_creditos where idsolicitud='$idsolicitud'   order by folio ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
		}

}
function get_solicitudes_autorizadas($idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	$idestatus=3; //Autorizadas
	//
	$sql="SELECT cr.folio,s.fecha_registro,s.monto,s.idsolicitud,idcredito,cl.nombre,cl.ap_paterno,cl.ap_materno "; 
	$sql.="FROM cc_solicitudes s,cc_clientes cl,cc_creditos cr "; 
	$sql.="where s.idsolicitud=cr.idsolicitud and s.idcliente=cl.idcliente and s.id_sucursal='$idsucursal' and s.id_periodo='$idcosecha' and s.idestatus='$idestatus' ";   
	$sql.="order by cl.nombre,cl.ap_paterno,cl.ap_materno;";
	
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; $sql");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idsolicitude' id='idsolicitud' onchange='autoriza_solicitud(this.value,4); return false' class='consultor3'>";
	echo "<option value=''>Seleccione Solicitud</option>";
	while($fila_c=pg_fetch_array($consulta))
	{
		
	
						$folio_s=$fila_c["folio"];
						$fecha_s=$fila_c["fecha_registro"];
						$monto_s=number_format($fila_c["monto"],2);
						
						$b=$fila_c["idsolicitud"];
						
						
						//$fila_cliente=get_cliente($fila_c["idcliente"]);				
						$nombre_cliente=$fila_c["nombre"]." ".$fila_c["ap_paterno"]." ".$fila_c["ap_materno"];
						
						
						$desc="$nombre_cliente $monto_s $folio_s $fecha_s";
						
						 print("<option value=\"$b\">".$desc."</option>");
                                 
	
	
	}
	echo "</select>";
}


function suma_fechas($fecha,$ndias)
            
{
            
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
            
              list($dia,$mes,$año)=split("/", $fecha);
            
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
            
              list($dia,$mes,$año)=split("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
        $nuevafecha=date("d-m-Y",$nueva);
            
      return ($nuevafecha);  
            
}

function convertir($cheq_fecha){
    list($d,$m,$a)=explode("-",$cheq_fecha);
    return $a."-".$m."-".$d;
}


function get_creditos_entregados()
{
	  global $con;
$idestatus=3;//significa que la solicitud ya ha sido autorizada
	
	$consulta=pg_query($con,"SELECT * FROM cc_solicitudes,cc_creditos where cc_solicitudes.idsolicitud=cc_creditos.idsolicitud and cc_solicitudes.idestatus='$idestatus' and cc_creditos.entregado='1' and cc_creditos.cancelado='0' order by cc_creditos.folio");
	//desconectar();
$form=3;
	
	echo "<select name='idcredito' id='idcredito' onChange='menos_add_grup(this.value,2)'  class='modif'>";
	echo "<option value='' >Seleccione credito</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
	//global $idrequerimiento;
	
							
	
							$b=$fila["idcredito"];
						
						 print("<option value=\"$b\">".nom($nombres)."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_creditos_filtro()
{

$form=3;
	
	echo "<select name='consulta_credito' id='consulta_credito' onChange='cc_update_credito_select(this.value,1)'  class='modif'>";
	echo "<option value='' >Seleccione</option>";
	echo "<option value='1' >Creditos Entregados</option>";
	echo "<option value='0' >Creditos Pendientes</option>";
	echo "</select>";
}

function get_creditos_pendientes()
{
	  global $con;
	$idestatus=3;//significa que la solicitud ya ha sido autorizada
	
?>
<div style="width:100%; height:340; overflow:auto;">
<table width="100%" border="0">
<tr>
<th align="center">Folio</th>
<th align="center">Grupo</th>
<th align="center">Nombre del acreditado</th>
<th align="center">Cr&eacute;dito</th>
<th align="center">F. Aprobaci&oacute;n</th>
<th align="center">F. Minis.</th>
<th align="center">Entregado</th>
</tr>

<?php
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes,cc_creditos where cc_solicitudes.idsolicitud=cc_creditos.idsolicitud and cc_solicitudes.idestatus='$idestatus' and cc_creditos.entregado='0' and cc_creditos.cancelado='0' order by cc_creditos.folio");
	//desconectar();
$form=3;
	
	while($fila=pg_fetch_array($consulta))
	{
	
	$fila_get_grupo=get_grupo_sol($fila["idcliente"]);
	if($fila_get_grupo!=0)
	$grupo=$fila_get_grupo["grupo"];
	else
	$grupo="SIN GRUPO";


	$fila_cliente=get_cliente($fila["idcliente"]);
							
	$nombre_cliente=$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"];
?>
<tr>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><font color="#000033"><strong><?php echo $fila["folio"]; ?></strong></font></td>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><?php echo $grupo; ?></td>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><?php echo $nombre_cliente; ?></td>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><?php echo number_format($fila["monto"],2); ?></td>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><?php echo $fila["f_aprobacion"]; ?></td>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><?php echo $fila["f_ministracion"]; ?></td>

<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center">

<input type="checkbox" name="entregar" value="1" id="1" >
</td>
</tr>
<?php							
 	
	}
	
	?>
    </table>
    </div>
    <?php
}

function get_creditos_update($valor)
{
	  global $con;
	$idestatus=3;//significa que la solicitud ya ha sido autorizada
	if($valor==1)
	$tipo="ENTREGADOS";
	if($valor==0)
	$tipo="PENDIENTES";
	
	
	
?>
<div style="width:100%; height:250; overflow:auto;">
<table width="100%" border="0">
<tr>
<td colspan="7"><li class="iheader">
		 
		<h5 class="art-logo-text">
	CR&Eacute;DITOS AUTORIZADOS <?php echo $tipo; ?></h2>
	</li></td>
</tr>
<tr>
<th align="center">Folio</th>
<th align="center">Grupo</th>
<th align="center">Nombre del acreditado</th>
<th align="center">Cr&eacute;dito</th>
<th align="center">F. Aprobaci&oacute;n</th>
<th align="center">F. Minis.</th>
<th align="center">Entregado</th>
</tr>

<?php
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes,cc_creditos where cc_solicitudes.idsolicitud=cc_creditos.idsolicitud and cc_solicitudes.idestatus='$idestatus' and cc_creditos.entregado='$valor' and cc_creditos.cancelado='0' order by cc_creditos.folio");
	//desconectar();
$form=3;
	
	while($fila=pg_fetch_array($consulta))
	{
	$idcredito=$fila["idcredito"];
	$fila_get_grupo=get_grupo_sol($fila["idcliente"]);
	if($fila_get_grupo!=0)
	$grupo=$fila_get_grupo["grupo"];
	else
	$grupo="SIN GRUPO";

	$fila_cliente=get_cliente($fila["idcliente"]);
							
	$nombre_cliente=$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"];
?>
<tr>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><font color="#000033"><strong>


<?php 
if($fila["entregado"]=="t")
{
	echo "<a href='#' onclick='cc_update_documentos_credito($idcredito,3)'>".$fila["folio"]."</a>";
}
if($fila["entregado"]=="f")
{
echo $fila["folio"]; 
}

?></strong></font>




</td>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><?php echo $grupo; ?></td>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><?php echo $nombre_cliente; ?></td>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><?php echo number_format($fila["monto"],2); ?></td>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><?php echo $fila["f_aprobacion"]; ?></td>
<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center"><?php echo $fila["f_ministracion"]; ?></td>

<td onmouseover="cambiacolor_over_credito(this)" onmouseout="cambiacolor_out_credito(this)" align="center">


<?php
if($fila["entregado"]=="t")
{

?>
<input type="checkbox" name="entregar" value="0"  checked="checked"     onclick='cambia_status_credito(this.value,2,<?php echo $fila["idcredito"]; ?>); return false'>
<?php
}
?>
<?php
if($fila["entregado"]=="f")
{

?>
<input type="checkbox" name="entregar" value="1"      onclick='cambia_status_credito(this.value,2,<?php echo $fila["idcredito"]; ?>); return false'>
<?php
}
?>


</td>
</tr>
<?php							
 	
	}
	
	?>
    </table>
    </div>
    <?php
}


function cc_cambia_estatus_credito($valor,$idcredito,$f_entrega,$observaciones,$monto)
{
	
 global $con;
 
// if($valor==1)
$consulta=pg_query($con,"SET datestyle TO postgres, dmy; UPDATE cc_creditos set entregado='$valor',f_entrega='$f_entrega',observaciones='$observaciones', monto='$monto' where idcredito='$idcredito'");
 //if($valor==0)
//$consulta=pg_query($con,"UPDATE cc_creditos set entregado='$valor' where idcredito='$idcredito'");

	
	
	if($consulta>0)
	{
		return 1;
	}
	
}


function cc_get_documentos($idcredito)
{
	?>
    <div id="bloque">
<table width="80%" border="0" >
  <tr>
    <td colspan="5" align="center"><strong>Impresi&oacute;n de documentos</strong></td>
    </tr>
  <tr>
    <td align="center" onmouseover="cambiacolor_over_doc(this)" onmouseout="cambiacolor_out_doc(this)"> <?php 

$img='<img src="../dummies/contrato.jpg" alt="contrato" title="Contrato" width="70px" height="50px">';

echo '<a href="../reportes/reporte_contrato.php?idcredito='.$idcredito.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?></td>
    <td align="center" onmouseover="cambiacolor_over_doc(this)" onmouseout="cambiacolor_out_doc(this)"><?php 

$img='<img src="../dummies/amortizacion.jpg" alt="amortizacion" title="Tabla de Amortizacion" width="70px" height="50px">';

echo '<a href="../reportes/reporte_amortizacion.php?idcredito='.$idcredito.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?>
    <td align="center" onmouseover="cambiacolor_over_doc(this)" onmouseout="cambiacolor_out_doc(this)"><?php 

$img='<img src="../dummies/recibo.jpg" alt="recibo" title="Recibo de dinero" width="70px" height="50px">';

echo '<a href="../reportes/reporte_recibo.php?idcredito='.$idcredito.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?></td>
   
  </tr>
</table>
</div>
<?php
	
}
function get_producto_m($idproducto)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_productos where idproducto='$idproducto' ");
	
	
 if($fila= pg_fetch_array($consulta))
		   {
	 
			return $fila;
			}
			else
			{
			return "null";
			
			
			}
}


function Suma_fecha_dias($fecha,$dias,$operacion){
  Switch($operacion){
    case "sumar":
    $varFecha = date("Y-m-d", strtotime("$fecha + $dias day"));
    return $varFecha;
    break;
    case "restar":
    $varFecha = date("Y-m-d", strtotime("$fecha - $dias day"));
    return $varFecha;
    break;
    default:
    $varFecha = date("Y-m-D", strtotime("$fecha + $dias day"));
    break;
  }
}
function Suma_fecha_dias_dmy($fecha,$dias,$operacion){
  Switch($operacion){
    case "sumar":
    $varFecha = date("d-m-Y", strtotime("$fecha + $dias day"));
    return $varFecha;
    break;
    case "restar":
    $varFecha = date("d-m-Y", strtotime("$fecha - $dias day"));
    return $varFecha;
    break;
    default:
    $varFecha = date("d-m-Y", strtotime("$fecha + $dias day"));
    break;
  }
}


function ultimoDia($mes,$ano){ 
    $ultimo_dia=28; 
    while (checkdate($mes,$ultimo_dia + 1,$ano)){ 
       $ultimo_dia++; 
    } 
    return $ultimo_dia; 
} 

/*
$start_date = '2009-06-17'; 
$end_date = '2009-09-05'; 
$date_from_user = '2009-06-28'; 
echo check_in_range($start_date, $end_date, $date_from_user); 
*/
function check_in_range($start_date, $end_date, $date_from_user) 
//
{ 
// Convert to timestamp 
$start_ts = strtotime($start_date); 
$end_ts = strtotime($end_date); 
$user_ts = strtotime($date_from_user); 
// Check that user date is between start & end 
return (($user_ts >= $start_ts) && ($user_ts <= $end_ts)); 

}
function dias_trancurre_dos_fecha($ano1,$mes1,$dia1,$ano2,$mes2,$dia2)
{

$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2);
 
//resto a una fecha la otra
$segundos_diferencia = $timestamp1 - $timestamp2;
//echo $segundos_diferencia;

//convierto segundos en días
$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

//obtengo el valor absoulto de los días (quito el posible signo negativo)
$dias_diferencia = abs($dias_diferencia);

//quito los decimales a los días de diferencia
 $dias_diferencia = floor($dias_diferencia);
 
 return $dias_diferencia;


}

function DiasFecha($fecha,$dias,$operacion){
  Switch($operacion){
    case "sumar":
    $varFecha = date("Y-m-d", strtotime("$fecha + $dias day"));
    return $varFecha;
    break;
    case "restar":
    $varFecha = date("Y-m-d", strtotime("$fecha - $dias day"));
    return $varFecha;
    break;
    default:
    $varFecha = date("Y-m-d", strtotime("$fecha + $dias day"));
    break;
  }
}



function DiasFecha_dmy($fecha,$dias,$operacion){
  Switch($operacion){
    case "sumar":
    $varFecha = date("d-m-Y", strtotime("$fecha + $dias day"));
    return $varFecha;
    break;
    case "restar":
    $varFecha = date("d-m-Y", strtotime("$fecha - $dias day"));
    return $varFecha;
    break;
    default:
    $varFecha = date("d-m-Y", strtotime("$fecha + $dias day"));
    break;
  }
}

function get_dia_ultimo($fecha_ministracion)
{
$fecha = explode("-",$fecha_ministracion);
$dia=$fecha[0];
$mes=$fecha[1];
$ano=$fecha[2];
return ultimoDia($mes,$ano);
	
}
function get_fecha_fin($fecha_inicio,$ultimo_dia)
{
$fecha = explode("-",$fecha_inicio);
$ano=$fecha[0];
$mes=$fecha[1];
$dia=$fecha[2];

return $fecha_fin=$ano."-".$mes."-".$ultimo_dia;
}

function n_dias($fecha_desde,$fecha_hasta)
{
$dias= (strtotime($fecha_desde)-strtotime($fecha_hasta))/86400;
$dias = abs($dias); 
$dias = floor($dias);
return  $dias;
}

function meses($fech_ini,$fech_fin) {
   /*
   FELIPE DE JESUS SANTOS SALAZAR, LIFER35@HOTMAIL.COM
   SEP-2010

   ESTA FUNCION NOS REGRESA LA CANTIDAD DE MESES ENTRE 2 FECHAS

   EL FORMATO DE LAS VARIABLES DE ENTRADA $fech_ini Y $fech_fin ES YYYY-MM-DD

   $fech_ini TIENE QUE SER MENOR QUE $fech_fin

   ESTA FUNCION TAMBIEN SE PUEDE HACER CON LA FUNCION date

   SI ENCUENTRAS ALGUN ERROR FAVOR DE HACERMELO SABER

   ESPERO TE SEA DE UTILIDAD, POR FAVOR NO QUIERES ESTE COMENTARIO, GRACIAS

   */



   //SEPARO LOS VALORES DEL ANIO, MES Y DIA PARA LA FECHA INICIAL EN DIFERENTES
   //VARIABLES PARASU MEJOR MANEJO

   $fIni_yr=substr($fech_ini,0,4);
    $fIni_mon=substr($fech_ini,5,2);
    $fIni_day=substr($fech_ini,8,2);

   //SEPARO LOS VALORES DEL ANIO, MES Y DIA PARA LA FECHA FINAL EN DIFERENTES
   //VARIABLES PARASU MEJOR MANEJO
   $fFin_yr=substr($fech_fin,0,4);
    $fFin_mon=substr($fech_fin,5,2);
    $fFin_day=substr($fech_fin,8,2);

   $yr_dif=$fFin_yr - $fIni_yr;
  // echo "la diferencia de años es -> ".$yr_dif."<br>";
   //LA FUNCION strtotime NOS PERMITE COMPARAR CORRECTAMENTE LAS FECHAS
   //TAMBIEN ES UTIL CON LA FUNCION date
   if(strtotime($fech_ini) > strtotime($fech_fin)){
      echo 'ERROR -> la fecha inicial es mayor a la fecha final <br>';
      exit();
   }
   else{
       if($yr_dif == 1){
         $fIni_mon = 12 - $fIni_mon;
         $meses = $fFin_mon + $fIni_mon;
         return $meses;
         //LA FUNCION utf8_encode NOS SIRVE PARA PODER MOSTRAR ACENTOS Y
         //CARACTERES RAROS
         //echo utf8_encode("la diferencia de meses con un año de diferencia es -> ".$meses."<br>");
      }
      else{
          if($yr_dif == 0){
             $meses=$fFin_mon - $fIni_mon;
            return $meses;
            //echo utf8_encode("la diferencia de meses con cero años de diferencia es -> ".$meses.", donde el mes inicial es ".$fIni_mon.", el mes final es ".$fFin_mon."<br>");
         }
         else{
             if($yr_dif > 1){
               $fIni_mon = 12 - $fIni_mon;
               $meses = $fFin_mon + $fIni_mon + (($yr_dif - 1) * 12);
               return $meses;
               //echo utf8_encode("la diferencia de meses con mas de un año de diferencia es -> ".$meses."<br>");
            }
            else
               echo "ERROR -> la fecha inicial es mayor a la fecha final <br>";
               exit();
         }
      }
   }

}


function cambia_formato_fecha($fecha)
{
	
$f = explode("-",$fecha);
$ano=$f[0];
$mes=$f[1];
$dia=$f[2];
return $fecha_result="$dia-$mes-$ano";
	
}
function date_dmy_ymd($fecha)
{
	
$f = explode("-",$fecha);
$dia=$f[0];
$mes=$f[1];
$ano=$f[2];


return $fecha_result="$ano-$mes-$dia";
	
}


function update_creditos_autorizados($idcliente,$idsucursal,$idcosecha)
{

    global $con;
	$idestatus=3;//significa que la solicitud ya ha sido autorizada and cc_creditos.entregado='$valor'
	
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes,cc_creditos where cc_solicitudes.id_sucursal='$idsucursal' and cc_solicitudes.id_periodo='$idcosecha' and cc_solicitudes.idsolicitud=cc_creditos.idsolicitud and cc_solicitudes.idestatus='$idestatus' and cc_creditos.cancelado='0' and cc_solicitudes.idcliente='$idcliente' order by cc_creditos.folio");
	echo "<select name='idcredito' id='idcredito' onchange='cc_actualiza_detalle_cliente_credito(this.value,5); return false' class='modif'>";
	echo "<option value=''>Seleccione Credito</option>";
	while($fila_c=pg_fetch_array($consulta))
	{
		
	
						$folio_s=$fila_c["folio"];
						$fecha_s=$fila_c["f_ministracion"];
						$monto_s=number_format($fila_c["monto"],2);
						
						$b=$fila_c["idcredito"];
						
						$desc="$folio_s $fecha_s $monto_s";
						
						 print("<option value=\"$b\">".$desc."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_detalle_credito_entregar($idcredito,$id_usuario)
{
	$fila_credito=get_credito_m($idcredito);
?>
<form name="captura_credito" action="" onSubmit="cc_validad_creditos_entre(6); return false" class="formu">  
<input type="hidden" name="folio" value="<?php echo $fila_credito["folio"]; ?>" />
<input type="hidden" name="idcredito" value="<?php echo $idcredito; ?>" />
<table width="40%" border="0">
  <tr>
    <td>Fecha de entrega del cr&eacute;dito</td>
    <td><input name="f_entrega" type="text" id="f_entrega" onclick="popUpCalendar(this, captura_credito.f_entrega, 'dd-mm-yyyy');"  value="" readonly="readonly" class="itext">	</td>
    <td>&nbsp;</td>
  </tr>
  
  <?php 
  if($id_usuario==187)
  $disabled="";
  else
  $disabled="readonly='readonly'";
   ?>
  
  <tr>
    <th>Monto Autorizado</th>
    <td>
    <input name="monto_auto" type="text" id="monto_auto"   value="<?php echo number_format($fila_credito["monto"],2); ?>" class="itext" onkeypress="return acceptNum(event)" <?php echo $disabled; ?>>
    
    </td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>Observaciones</td>
    <td><textarea name="observacioness" class="itext" id="observaciones"></textarea>
    
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input class="ibutton" type="submit" name="enviar" id="enviar" value="ENTREGAR" ></td>
    <td align="right"><?php $img='<img src="../dummies/cancelar.png" alt="cancelar" title="Cancela Credito" >';

echo '<a href="#" onclick="cc_cancela_credito('.$idcredito.'); return false">  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>'; ?></td>
  </tr>
</table>
</form>

<?php
	
	
	
}

function get_detalle_credito_entregado($idcredito,$id_usuario)
{
	$fila_credito=get_credito_m($idcredito);
?>
<form name="captura_credito" action="" onSubmit="cc_validad_creditos_entre(6); return false" class="formu">  
<input type="hidden" name="folio" value="<?php echo $fila_credito["folio"]; ?>" />
<input type="hidden" name="idcredito" value="<?php echo $idcredito; ?>" />
<table width="40%" border="0">
  <tr>
    <td>Fecha de entrega del cr&eacute;dito</td>
    <td><input name="f_entrega" type="text" id="f_entrega" onclick="popUpCalendar(this, captura_credito.f_entrega, 'dd-mm-yyyy');"  value="<?php echo $fila_credito["f_entrega"] ?>" readonly="readonly" class="itext">	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
   <?php 
  if($id_usuario==187)
  $disabled="";
  else
  $disabled="readonly='readonly'";
   ?>
  
  <tr>
    <th>Monto Autorizado</th>
    <td>
    <input name="monto_auto" type="text" id="monto_auto"   value="<?php echo number_format($fila_credito["monto"],2); ?>" class="itext" onkeypress="return acceptNum(event)" <?php echo $disabled; ?>>
    
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  
  <tr>
    <td>Observaciones</td>
    <td><textarea name="observacioness" class="itext" id="observaciones"><?php echo $fila_credito["observaciones"] ?></textarea>
    
    
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input class="ibutton" type="submit" name="enviar" id="enviar" value="ENTREGADO" ></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?php $img='<img src="../dummies/cancelar.png" alt="cancelar" title="Cancela Credito" >';

echo '<a href="#" onclick="cc_cancela_credito('.$idcredito.'); return false">  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>'; ?></td>
  </tr>
</table>
</form>

<?php
	
	
	
}

function get_estado_credito($idcredito)
{
	 global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_creditos where idcredito='$idcredito' ");
	
	
 if($fila= pg_fetch_array($consulta))
		   {
	 		
			if($fila["entregado"]=="t")
			return 1;
			if($fila["entregado"]=="f")
			return 0;
			
			}
			else
			{
			return "null";
			
			
			}
}

function get_estado_sol($idsolicitud)
{
	 global $con;
	 
	 $consul_credito=pg_query($con,"SELECT idcredito FROM cc_creditos WHERE idsolicitud='$idsolicitud'");
	 if($fila_consulta= pg_fetch_array($consul_credito))
	{
	 		
	 $idcredito=$fila_consulta["idcredito"];
	 
			$consulta=pg_query($con,"SELECT * FROM cc_creditos where idcredito='$idcredito' ");
			
			
				 if($fila= pg_fetch_array($consulta))
				   {
					
					if($fila["entregado"]=="t")
					$bandera=1;
					if($fila["entregado"]=="f")
					$bandera=0;
					
					}
					
					
	}
	
	return $bandera;
}


function get_parcela_cafe($idcliente)
{

    global $con;

	
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where idcliente='$idcliente'  order by num_predio ");
	if($fila=pg_fetch_array($consulta))
	{
		$id_catalogo=$fila["id_catalogo"];
	}
	if($id_catalogo!="")
	return $cafe=get_cafe_tipo($id_catalogo);
	else
	return "ROBUSTA";
	

}

function get_parcela_cultivo($idcliente)
{

    global $con;

	$sql="SELECT sum(sc_hec) as hectareacultivo,";
	$sql.="(select cat.descripcion from al_cat_articulos cat,cc_parcelas p where cat.id_catalogo=p.id_catalogo and p.idcliente=par.idcliente "; 
	$sql.="group by cat.descripcion limit 1) as cafe,";
	$sql.="(select cat.prodkgxhect from al_cat_articulos cat,cc_parcelas p where cat.id_catalogo=p.id_catalogo and p.idcliente=par.idcliente "; 
	$sql.="group by cat.prodkgxhect limit 1) as kgxhectarea, ";
	$sql.="(select cat.precioxhect from al_cat_articulos cat,cc_parcelas p where cat.id_catalogo=p.id_catalogo and p.idcliente=par.idcliente "; 
	$sql.="group by cat.precioxhect limit 1) as precioxhectarea,";
	$sql.="(select cuotacredito from cc_config_productor limit 1) as cuotacredito, ";
	$sql.="(select cuotaaportaproductor from cc_config_productor limit 1) as cuotaproductor ";
 	$sql.="FROM cc_parcelas par where idcliente='".$idcliente."' group by idcliente";

	$consulta=pg_query($con, $sql);
	if($fila=pg_fetch_array($consulta))
	{
		return $fila;
	}
	
	

}

function get_cafe_tipo($id_catalogo)
{

    global $con;

	
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM al_cat_articulos where id_catalogo='$id_catalogo'");
	if($fila=pg_fetch_array($consulta))
	{
		$descripcion=$fila["descripcion"];
	}
	if($descripcion!="")
	return $descripcion;
	else
	return "ROBUSTA";

	

}


function get_clasifica_cafe($id_catalogo)
{

    global $con;

	
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM al_cat_articulos where id_catalogo='$id_catalogo'");
	if($fila=pg_fetch_array($consulta))
	{
		$descripcion=$fila["idclasificacion"];
	}else {
		$descripcion=3;
	}
	
	return $descripcion;

}


function get_gprendarias($idcliente)
{

    global $con;
	$descripcion='';

	$consulta=pg_query($con,"SELECT * FROM cc_gtias_prendarias where idcliente='$idcliente' order by descripcion");
	while($fila=pg_fetch_array($consulta))
	{
							
							$desc= limitarPalabras($fila["descripcion"],15);
							$valor=number_format($fila["valor"],2);
							
$descripcion=$descripcion." "."Garantia prendaria con la siguiente descripcion : ".$desc." con un valor comercial de $ ".$valor.", una fecha de valuacion de ".$fila["fregistro"]." con una marca de ".$fila["marca"].", modelo ".$fila["modelo"]." y el estado actual es ".$fila["estado_actual"]." con un numero de serie ".$fila["no_serie"]." y una fecha de factura de ".$fila["f_factura"]." y el numero de factura ".$fila["no_factura"]." , ";

							
							
	
	}
	
	return $descripcion;

}
function get_ghipotecarias($idcliente)
{

    global $con;
	$descripcion='';

	$consulta=pg_query($con,"SELECT * FROM cc_gtias_hipotecarias where idcliente='$idcliente' order by descripcion");
	while($fila=pg_fetch_array($consulta))
	{
							$desc= limitarPalabras($fila["descripcion"],15);
							$valor=number_format($fila["valor"],2);
$descripcion=$descripcion." "."Garantia hipotecaria con la siguiente descripcion : ".$desc." con un valor comercial de $ ".$valor.", una fecha de valuacion de ".$fila["fvaluacion"]." con una numero de registro ".$fila["registro"].", libro ".$fila["libro"]." y el tomo : ".$fila["tomo"]." seccion ".$fila["seccion"]." y volumen  ".$fila["volumen"]." con una superficie ".$fila["superficie"]." y la fecha de registro ".$fila["fregistro"]."  con la leyenda en el registro publico de la propiedad y de comercio de ".$fila["antecedentes"].", ";

							
							
							
	
	}
		return $descripcion;

}


function get_ubicacion_parcela($array_parcelas)
{
  global $con;
 
foreach ($array_parcelas as $parcelas)

 {

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where id_parcela='$parcelas' order by desc_predio  ");
		
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
				
	
		$estado=get_estado($fila["idestado"]);
		$municipio=get_municipio($fila["idmunicipio"]);
		$localidad=get_localidad($fila["idlocalidad"]);
		$colonia=get_colonia($fila["idcolonia"]);
		
		
			
			
			}


}

//$ubicacion="$localidad del municipio de $municipio del estado de $estado";

return $estado;


	
}

function get_bloqueo_rfc($rfc)
{
	  global $con;
		 $bandera=0;

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes where rfc='$rfc'");
		
			while($fila=pg_fetch_array($consulta))
			{
				$bandera=1;
			}
				return $bandera;
}
function get_bloqueo_ife($ife)
{
	  global $con;
		 $bandera=0;

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes where ife='$ife'");
		
			while($fila=pg_fetch_array($consulta))
			{
				$bandera=1;
			}
				return $bandera;
}
function get_bloqueo_curp($curp)
{
	  global $con;
		 $bandera=0;

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes where curp='$curp'");
		
			while($fila=pg_fetch_array($consulta))
			{
				$bandera=1;
			}
				return $bandera;
}
function get_bloqueo_nombre($nombre)
{
	  global $con;
		 $bandera=0;

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes where trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)='$nombre'");
		
			while($fila=pg_fetch_array($consulta))
			{
				$bandera=1;
			}
				return $bandera;
}
function get_bloqueo_nombre_m($nombre,$idcliente)
{
	  global $con;
		 $bandera=0;

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes where trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)='$nombre' and idcliente not in (SELECT idcliente FROM cc_clientes WHERE idcliente='$idcliente')");
		
			while($fila=pg_fetch_array($consulta))
			{
				$bandera=1;
			}
				return $bandera;
}

function get_bloqueo_rfc_m($rfc,$idcliente)
{
	  global $con;
		 $bandera=0;

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes where idcliente not in (SELECT idcliente FROM cc_clientes WHERE idcliente='$idcliente') and rfc='$rfc'");
		
			while($fila=pg_fetch_array($consulta))
			{
				$bandera=1;
			}
				return $bandera;
}

function get_bloqueo_ife_m($ife,$idcliente)
{
	  global $con;
		 $bandera=0;

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes where idcliente not in (SELECT idcliente FROM cc_clientes WHERE idcliente='$idcliente') and ife='$ife'");
		
			while($fila=pg_fetch_array($consulta))
			{
				$bandera=1;
			}
				return $bandera;
}
function get_bloqueo_curp_m($curp,$idcliente)
{
	  global $con;
		 $bandera=0;

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes where idcliente not in (SELECT idcliente FROM cc_clientes WHERE idcliente='$idcliente') and curp='$curp'");
		
			while($fila=pg_fetch_array($consulta))
			{
				$bandera=1;
			}
				return $bandera;
}


function get_cafe_cliente($array_parcelas)
{
  global $con;
 
foreach ($array_parcelas as $parcelas)

 {

		$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where id_parcela='$parcelas' order by id_parcela  ");
		$conta=0;
		
		
			
			while($fila=pg_fetch_array($consulta))
			{
			$id_catalogo=$fila["id_catalogo"];
			$cafe=get_cafe_tipo($id_catalogo);
				
	
			}

//break;
}

return $cafe;


	
}

function get_parcela_exist($idcliente)
{
	 global $con;
	 $stock=0;
	 $consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where idcliente='$idcliente'");
			
			if($fila=pg_fetch_array($consulta))
			{
			$stock=1;
			}
			return $stock;
}


function get_exits_nota_entrada($idsucursal,$idcosecha)
{
//	include 'conexion.php';
//$idsucursal,$idcosecha
    global $con;
	//global $idrequerimiento;
//id_almacen='$idsucursal' and id_periodo='$idcosecha' and
	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM co_compras where id_almacen='$idsucursal' and id_periodo='$idcosecha' and estatus=true order by id_compra";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
			return 1;
			}
			else
			{
			return 0;
			
			
			}

}



function get_almacen_nota()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_almacenes order by domicilio");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_almacen' id='id_almacen'   class='modif'   onChange='actualiza_cliente_form()' >";
	echo "<option value='' >Elige almacen</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_almacen"];
							
						print("<option value=\"$b\">".nom($fila["domicilio"])."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_almacen_nota_new($id_almacen)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_almacenes  order by domicilio");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_almacen' id='id_almacen'   class='modif'   >";
	echo "<option value='' >Selecciona almacen</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_almacen"];
							if($b==$id_almacen)
							print("<option value=\"$b\" selected='selected'>".nom($fila["domicilio"])."</option>");
							else
							print("<option value=\"$b\">".nom($fila["domicilio"])."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_producto_nota()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_cat_articulos where tipo='C' order by descripcion");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_catalogo' id='id_catalogo'   class='iselect'  onChange='cc_get_precio_producto(this.value)'>";
	echo "<option value='' >Elige Producto</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_catalogo"];
							
						print("<option value=\"$b\">".$fila["descripcion"]."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_clientes_nota()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by nombre ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='actualiza_nota_cliente(this.value,1)'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}



function get_clientes_nota_tmp()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by nombre ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='actualiza_nota_cliente_tmp(this.value,1)'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_ultimos_folios($sucursal,$periodo)
{
   //	include 'conexion.php';
   global $con;
   $sql="select trim(serie)||folio as folio from co_compras where 
	folio=(select max(folio::integer)::integer from co_compras where estatus=true and id_periodo=$periodo and id_almacen=$sucursal 
	and serie='')::varchar(20)";
	 
	$consulta=pg_query($con,$sql);
	$fila=pg_fetch_array($consulta);
	
	$sql2="select trim(serie)||folio as folio from co_compras where 
	folio=(select max(folio::integer)::integer from co_compras where estatus=true and id_periodo=$periodo and id_almacen=$sucursal 
	and serie='A')::varchar(20) and serie='A'";
	 
	$consulta2=pg_query($con,$sql2);
	$fila2=pg_fetch_array($consulta2);	
	
	//desconectar();
   $valor="";
   if($sucursal==1) {
		$suc="Tapachula"; 
   }else {
  		$suc="Jaltenango";
   }
   
	$valor.="NE. ".$suc." ult. Fol: <b>".$fila["folio"]."</b> <br/>";
	$valor.="NE. SnVicente ult. Fol: <b>".$fila2["folio"]."</b>";

	return $valor;
}

function get_kgsa_entregar($idcliente,$idcatalogo)
{
  global $con;
  $sql="select coalesce(sum(cosecha_esp_kg),0.00) as tot_a_entregar,
	(select coalesce(sum(total_kgs_netos),0.00) as total_compra 
	from co_compras where id_periodo={$_SESSION['cosecha_sel']} and id_catalogo={$idcatalogo} and id_proveedor={$idcliente} and estatus=true)  
	as tot_comprado,
	coalesce(sum(cosecha_esp_kg),0.00)-
	(select coalesce(sum(total_kgs_netos),0.00) as total_compra 
	from co_compras where id_periodo={$_SESSION['cosecha_sel']} and id_catalogo={$idcatalogo} and id_proveedor={$idcliente} and estatus=true) 
	as tot_pen_entregar
 	from cc_parcela_cosecha pc,cc_parcelas p 
	where pc.id_parcela=p.id_parcela and p.idcliente={$idcliente} 
	and p.id_catalogo={$idcatalogo} and pc.id_periodo={$_SESSION['cosecha_sel']}";

	$consulta=pg_query($con,$sql);
	$fila=pg_fetch_array($consulta);
   if(is_null($fila["tot_pen_entregar"])) {	
		$valor.="<p id='pentrega'>Cosecha esperada: <b>0.00</b> Kgs. </p>";
	}else {
		$valor.="<p id='pentrega'>Cosecha esperada: <b>".$fila["tot_a_entregar"]."</b> Kgs.</p>";
	}
	return $valor;
  
}

function get_detalle_entregar($idcliente,$idcatalogo)
{
  global $con;
  $sql="select coalesce(sum(cosecha_esp_kg),0.00) as tot_a_entregar,
	(select coalesce(sum(total_kgs_netos),0.00) as total_compra 
	from co_compras where id_periodo={$_SESSION['cosecha_sel']} and id_catalogo={$idcatalogo} and id_proveedor={$idcliente} and estatus=true)  
	as tot_comprado,
	coalesce(sum(cosecha_esp_kg),0.00)-
	(select coalesce(sum(total_kgs_netos),0.00) as total_compra 
	from co_compras where id_periodo={$_SESSION['cosecha_sel']} and id_catalogo={$idcatalogo} and id_proveedor={$idcliente} and estatus=true) 
	as tot_pen_entregar
 	from cc_parcela_cosecha pc,cc_parcelas p 
	where pc.id_parcela=p.id_parcela and p.idcliente={$idcliente} 
	and p.id_catalogo={$idcatalogo} and pc.id_periodo={$_SESSION['cosecha_sel']}";

	$consulta=pg_query($con,$sql);
	$fila=pg_fetch_array($consulta);
   if(is_null($fila["tot_pen_entregar"])) {	
		$valor="<p id='entregado'>Entregado: <b>0.00</b> Kgs.  Pendiente: <b>0.00</b> Kgs.</p>";
	}else {
		$valor="<p id='entregado'>Entregado: <b>".$fila["tot_comprado"]."</b> Kgs.  Pendiente: <b>".$fila["tot_pen_entregar"]."</b> Kgs.</p>";
	}
	return $valor;
  
}


function get_kg_ent($idcliente,$idcatalogo)
{
  global $con;
  $sql="select coalesce(sum(cosecha_esp_kg),0.00) as tot_a_entregar,
	(select coalesce(sum(total_kgs_netos),0.00) as total_compra 
	from co_compras where id_periodo={$_SESSION['cosecha_sel']} and id_catalogo={$idcatalogo} and id_proveedor={$idcliente} and estatus=true)  
	as tot_comprado,
	coalesce(sum(cosecha_esp_kg),0.00)-
	(select coalesce(sum(total_kgs_netos),0.00) as total_compra 
	from co_compras where id_periodo={$_SESSION['cosecha_sel']} and id_catalogo={$idcatalogo} and id_proveedor={$idcliente} and estatus=true) 
	as tot_pen_entregar
 	from cc_parcela_cosecha pc,cc_parcelas p 
	where pc.id_parcela=p.id_parcela and p.idcliente={$idcliente} 
	and p.id_catalogo={$idcatalogo} and pc.id_periodo={$_SESSION['cosecha_sel']}";

	$consulta=pg_query($con,$sql);
	$fila=pg_fetch_array($consulta);
   if(is_null($fila["tot_pen_entregar"])) {	
		$valor=0.00;
	}else {
		$valor=$fila["tot_pen_entregar"];
	}
	return $valor;
  
}
function get_clientes_nota_m($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)) ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='actualiza_nota_cliente(this.value,1)'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
							
						 if($idcliente==$b)
						 print("<option value=\"$b\" selected>".nom($nom_clientes)."</option>");
						 else
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_clientes_nota_m_tmp($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)) ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='actualiza_nota_cliente_tmp(this.value,1)'  class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
							
						 if($idcliente==$b)
						 print("<option value=\"$b\" selected>".nom($nom_clientes)."</option>");
						 else
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_productor_nota($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by (trim(nombre)||' '||trim(ap_paterno)||' '||trim(ap_materno)) ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	//onChange='actualiza_nota_cliente(this.value,1)'
	echo "<select name='idproductor' id='idproductor' onChange='cc_get_productor(this.value)'  class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
							
						 if($idcliente==$b)
						 print("<option value=\"$b\" selected>".nom($nom_clientes)."</option>");
						 else
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_exits_nota_cliente($idcliente,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM co_compras where id_almacen='$idsucursal' and id_periodo='$idcosecha' and estatus=true and id_proveedor='$idcliente'  order by fecha_nota";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}

}

function get_nota_m($id_nota)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM co_nota_entrada where id_nota='$id_nota'   order by folio ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
		}

}

function get_tonga_nota()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_tonga order by id_tonga");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_tonga[]' id='id_tonga'   class='iselect'>";
	echo "<option value='' >Selecciona Tonga</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_tonga"];
							
						print("<option value=\"$b\">".$fila["nom_tonga"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_tonga_nota_m($id_tonga)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_tonga order by id_tonga");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_tonga[]' id='id_tonga'   class='iselect'>";
	echo "<option value='' >Selecciona Tonga</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_tonga"];
						
						if($b==$id_tonga)	
						print("<option value=\"$b\" selected='selected'>".$fila["nom_tonga"]."</option>");
						else
						print("<option value=\"$b\">".$fila["nom_tonga"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_peso_tara($id_tara)
{
	  global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM al_tara where id_tara='$id_tara'";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila["peso"];
		}
		else
		{
			return 0;
		}
}

function valida_campo($campo)
{
			if(!isset($campo) || (empty($campo) ))
			{
				return 0;
			}
			else
			{
				return $campo;
			}
				
			
			
	
}
function valida_campo_var($campo)
{
			if(!isset($campo) || (empty($campo) ))
			{
				return "null";
			}
			else
			{
				return "'$campo'";
			}
				
			
			
	
}

function get_precio_kilo($id_catalogo)
{
	  global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM al_cat_articulos where id_catalogo='$id_catalogo'";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila["precio1"];
		}
		else
		{
			return 0;
		}
}

function get_clientes_selec($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by nombre ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						
						 if($idcliente==$b)
						 print("<option value=\"$b\" selected>".nom($nom_clientes)."</option>");
						 else
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_producto_nota_m($id_catalogo)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_cat_articulos where tipo='C' order by descripcion");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_catalogo' id='id_catalogo'   class='iselect'  onChange='cc_get_precio_producto(this.value)'>";
	echo "<option value='' >Elige Producto</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_catalogo"];
						if($b==$id_catalogo)	
						print("<option value=\"$b\" selected='selected'>".$fila["descripcion"]."</option>");
						else
						print("<option value=\"$b\">".$fila["descripcion"]."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_nota_arreglo($id_compra,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
        
	   $consulta=" SET datestyle TO postgres, dmy; SELECT *,(select retencion_porc from al_cat_articulos where id_catalogo=cm.id_catalogo) as retencion_p FROM co_compras cm where estatus=true and id_almacen='$idsucursal' and id_periodo='$idcosecha' and id_compra='$id_compra' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
			}
			else
			{
				return 0;
			}
			

}

function get_nota_arreglo_merma($id_compra,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
		$consulta1=" SET datestyle TO postgres, dmy; SELECT count(*)::integer as nregistro FROM co_compras_merma cm 
		where estatus=true and id_compra='$id_compra' ";
		$Rs= pg_fetch_array(pg_query($con,$consulta1));
		if($Rs['nregistro']<=0) {   
      	$consulta=" SET datestyle TO postgres, dmy; SELECT *,(select retencion_porc from al_cat_articulos 
      	where id_catalogo=cm.id_catalogo) as retencion_p 
      	FROM co_compras cm where estatus=true and id_compra='$id_compra' ";
		}else {
			$consulta=" SET datestyle TO postgres, dmy; SELECT *,(select retencion_porc from al_cat_articulos 
			where id_catalogo=cm.id_catalogo) as retencion_p 
			FROM co_compras_merma cm where estatus=true and id_compra='$id_compra' ";		
		}	   
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
			}
			else
			{
				return 0;
			}
			

}
function get_nota_arreglo_gral($idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT *,(select retencion_porc from al_cat_articulos where id_catalogo=cm.id_catalogo) as retencion_p FROM co_compras cm where estatus=true and id_almacen=$idsucursal and id_periodo=$idcosecha order by folio desc ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
			}
			else
			{
				return 0;
			}
			

}

function get_nota_arreglo_gral_merma($idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT *,(select retencion_porc from al_cat_articulos where 
	   id_catalogo=cm.id_catalogo) as retencion_p FROM co_compras cm where estatus=true and id_almacen=$idsucursal 
	   and id_periodo=$idcosecha order by folio desc ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
				$consulta=" SET datestyle TO postgres, dmy; SELECT *,(select retencion_porc from al_cat_articulos 
				where id_catalogo=cm.id_catalogo) as retencion_p FROM co_compras_merma cm where estatus=true and 
				id_compra=".$fila['id_compra'];	 
				$id_query1 = pg_query($con,$consulta);
				if($fila1= pg_fetch_array($id_query1))
				{
					return $fila1;
				}else {
					return $fila;
				}
				
			}
			else
			{
				return 0;
			}
			

}

function get_taras($id_sucursal)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy;select nom_tara,dt.peso,dt.id_tara from al_tara_detalle dt,al_tara t where dt.id_tara=t.id_tara and dt.id_sucursal=".$id_sucursal;
	   $id_query = pg_query($con,$consulta);
	
		return $id_query;			

}

function get_nota_arreglo_individual($idcliente,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT *,(select retencion_porc from al_cat_articulos where id_catalogo=cm.id_catalogo) as retencion_p FROM co_compras cm where estatus=true and id_proveedor='$idcliente' and id_almacen='$idsucursal' and id_periodo='$idcosecha' order by folio ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
			}
			else
			{
				return 0;
			}
			

}

function get_nota_arreglo_individual_merma($idcliente,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
		$consulta=" SET datestyle TO postgres, dmy; SELECT *,(select retencion_porc from al_cat_articulos 
		where id_catalogo=cm.id_catalogo) as retencion_p 
		FROM co_compras cm where estatus=true and id_proveedor='$idcliente' and id_almacen='$idsucursal' 
		and id_periodo='$idcosecha' order by folio ";
	   
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 			//validar si existe merma si no muestra la nota
	 			$consulta1="SELECT count(*)::integer as nregistro 
				FROM co_compras_merma where id_compra=".$fila['id_compra'];
				
				$Rs=pg_fetch_array(pg_query($con,$consulta1));
				if($Rs['nregistro']<=0) {
					return $fila;
				}else {
					$consulta="SELECT *,(select retencion_porc from al_cat_articulos 
					where id_catalogo=cm.id_catalogo) as retencion_p 
					FROM co_compras_merma cm where id_compra=".$fila['id_compra'];
	   
	  			   $fila1 = pg_fetch_array(pg_query($con,$consulta));
	  			   return $fila1;
				}				
				
			}
			else
			{
				return 0;
			}
	   
}





function get_pesadas_compra($id_compra)
{
global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM co_pesadas where id_compra='$id_compra' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 while($fila= pg_fetch_array($id_query))
		   {
	 
	 ?>
	 
      <tr>
    <td><div align="center">
      <input type="text" name="hene[]" size="15" maxlength="50"  id="hene" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($fila["henequen"],2); ?>" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
    </div></td>
          <td><div align="center">
            <input type="text" name="yute[]" size="15" maxlength="50"  id="yute" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($fila["yute"],2); ?>" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
          </div></td>
          <td><div align="center">
            <input type="text" name="bolsa[]" size="15" maxlength="50"  id="bolsa" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($fila["bolsa"],2); ?>" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
          </div></td>
          <td><div align="center">
            <input type="text" name="kgs_brutos[]" size="15" maxlength="50"  id="kgs_brutos" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($fila["kgs_brutos"],2); ?>" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
          </div></td>
          <td><div align="center">
            <?php
    get_tonga_nota_m($fila["id_tonga"]);
    ?>
          </div></td>
          <td align="center">
            <input type="button" onclick="deltonga(this)" value="Eliminar" onchange="calcula_kgs_netos()" >
</td>
  
  </tr>
     
     
		<?php		
			}	
}



function get_pesadas_compra_merma($id_compra)
{
global $con;
      $consulta1=" SET datestyle TO postgres, dmy; SELECT count(*)::integer as nregistro FROM co_pesadas_merma 
      where id_compra='$id_compra'";
      $Rs=pg_fetch_array(pg_query($con,$consulta1));
      if($Rs['nregistro']<=0) {
	   	$consulta="SET datestyle TO postgres, dmy; SELECT * FROM co_pesadas where id_compra='$id_compra' ";
		}else {
			$consulta="SET datestyle TO postgres, dmy; SELECT * FROM co_pesadas_merma where id_compra='$id_compra' ";
		}	   
	   $id_query = pg_query($con,$consulta);
	
	
		 while($fila= pg_fetch_array($id_query))
		   {
	 
	 ?>
	 
      <tr>
    <td><div align="center">
      <input type="text" name="hene[]" size="15" maxlength="50"  id="hene" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($fila["henequen"],2); ?>" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
    </div></td>
          <td><div align="center">
            <input type="text" name="yute[]" size="15" maxlength="50"  id="yute" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($fila["yute"],2); ?>" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
          </div></td>
          <td><div align="center">
            <input type="text" name="bolsa[]" size="15" maxlength="50"  id="bolsa" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($fila["bolsa"],2); ?>" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
          </div></td>
          <td><div align="center">
            <input type="text" name="kgs_brutos[]" size="15" maxlength="50"  id="kgs_brutos" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($fila["kgs_brutos"],2); ?>" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
          </div></td>
          <td><div align="center">
            <?php
    get_tonga_nota_m($fila["id_tonga"]);
    ?>
          </div></td>
          <td align="center">
            <input type="button" onclick="deltonga(this)" value="Eliminar" onchange="calcula_kgs_netos()" >
</td>
  
  </tr>
     
     
		<?php		
			}	
}


function get_notas_entrada($idcliente,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT c.*,case when trim(serie)!='' then trim(serie)||'-' else '' end||trim(folio) as folio FROM co_compras c where estatus=true and id_proveedor='$idcliente' and id_almacen='$idsucursal' and id_periodo='$idcosecha' order by c.folio ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_compras' id='id_compras' onChange='actualiza_nota_cliente_directo(this.value,3)'   class='iselect'>";
	echo "<option value='' >Seleccione</option>";
	while($fila=pg_fetch_array($consulta))
	{
		
		
						$folio_s=$fila["folio"];
						$fecha_s=$fila["fecha_nota"];
						
						
						$b=$fila["id_compra"];
						$subtotal=round(($fila["total_kgs_neto2"]*$fila["precio_kilo"])-$fila["retencion_peso"],2);
						$monto_s=number_format($subtotal,2);
												
						$desc="Folio-- $folio_s -- Fecha--$fecha_s Total:-- $monto_s";
						
						 print("<option value=\"$b\">".$desc."</option>");
		
		     
	
	
	}
	echo "</select>";
}



function get_notas_entrada_tmp($idcliente,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT c.*,case when trim(serie)!='' then trim(serie)||'-' else '' end||trim(folio) as folio FROM co_compras c where estatus=true and id_proveedor='$idcliente' and id_almacen='$idsucursal' and id_periodo='$idcosecha' order by c.folio ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_compras' id='id_compras'  class='iselect'>";
	echo "<option value='' >Seleccione</option>";
	while($fila=pg_fetch_array($consulta))
	{
		
		
						$folio_s=$fila["folio"];
						$fecha_s=$fila["fecha_nota"];
						
						
						$b=$fila["id_compra"];
						$subtotal=round(($fila["total_kgs_neto2"]*$fila["precio_kilo"])-$fila["retencion_peso"],2);
						$monto_s=number_format($subtotal,2);
												
						$desc="Folio-- $folio_s -- Fecha--$fecha_s Total:-- $monto_s";
						
						 print("<option value=\"$b\">".$desc."</option>");
		
		     
	
	
	}
	echo "</select>";
}


function get_notas_entradade_servicio($idcliente,$nota_sel,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
    $sql="SELECT case when trim(serie)!='' then trim(serie)||'-' else '' end||trim(folio) as folio,fecha_nota,total_kgs_netos*precio_kilo as total FROM co_compras where estatus=true and id_proveedor='$idcliente'";
    $sql.=" except all (select case when trim(serie)!='' then trim(serie)||'-' else '' end||trim(folio) as folio,cm.fecha_nota,cm.total_kgs_netos*cm.precio_kilo as total from se_oservicios os,";
    $sql.="co_compras cm where trim(cm.folio)=trim(os.nota_asociada) and os.idcliente='$idcliente' and os.nota_asociada is not null) order by folio";

	$consulta=pg_query($con, $sql);
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
			
	echo "<select name='nt_asociada' id='nt_asociada' class='iselect'>";
	echo "<option value='' selected>Seleccione una nota</option>";
	if(!empty($nota_sel)) 
	{
		$consulta_sel=pg_query($con, "select case when trim(serie)!='' then trim(serie)||'-' else '' end||trim(folio) as folio,fecha_nota,total_kgs_netos*precio_kilo as total from co_compras where case when trim(serie)!='' then trim(serie)||'-' else '' end||trim(folio)='$nota_sel'");	
		$fila_sel=pg_fetch_array($consulta_sel);
		$folio_s=trim($fila_sel["folio"]);
		$fecha_s=$fila_sel["fecha_nota"];
		
		$subtotal=round($fila_sel["total"],2);
		$monto_s=number_format($subtotal,2);
												
		$desc="$folio_s -- Fecha--$fecha_s Total:-- $monto_s";		
		print("<option value=\"$folio_s\" selected>".$desc."</option>");	
		
	}	
	while($fila=pg_fetch_array($consulta))
	{
		
		
						$folio_s=trim($fila["folio"]);
						$fecha_s=$fila["fecha_nota"];
						
						

						$subtotal=round($fila["total"],2);
						$monto_s=number_format($subtotal,2);
												
						$desc="$folio_s -- Fecha--$fecha_s Total:-- $monto_s";
						if(trim($nota_sel)==trim($folio_s)) {
						 	print("<option value=\"$folio_s\" selected>".$desc."</option>");
						}else {
							print("<option value=\"$folio_s\">".$desc."</option>");
						}
		     
	
	
	}
	echo "</select>";
}



function serie_notas($series,$activo)
{

	if($activo==1) {	
		echo "<select name='id_series' id='id_series' disabled class='iselect'>";
	}else {	
		echo "<select name='id_series' id='id_series' class='iselect'>";
	}
	echo "<option value='0' >Seleccione</option>";
						
	if($series==' ') {					
		print("<option value=' ' selected='selected'>ORDINARIA</option>");
		print("<option value='A'>SERIE A</option>");
		print("<option value='B'>SERIE B</option>");
		print("<option value='C'>SERIE C</option>");
		print("<option value='D'>SERIE D</option>");
		print("<option value='Z'>CONSIGNACI&OacuteN</option>");
	}
	if($series=='A') {					
		print("<option value=' '>ORDINARIA</option>");
		print("<option value='A' selected='selected'>SERIE A</option>");
		print("<option value='B'>SERIE B</option>");
		print("<option value='C'>SERIE C</option>");
		print("<option value='D'>SERIE D</option>");
		print("<option value='Z'>CONSIGNACI&OacuteN</option>");
	}
	if($series=='B') {	
		print("<option value=' '>ORDINARIA</option>");		
		print("<option value='A'>SERIE A</option>");		
		print("<option value='B' selected='selected'>SERIE B</option>");
		print("<option value='C'>SERIE C</option>");
		print("<option value='D'>SERIE D</option>");
		print("<option value='Z'>CONSIGNACI&OacuteN</option>");
	}
	if($series=='C') {					

		print("<option value=' '>ORDINARIA</option>");		
		print("<option value='A'>SERIE A</option>");		
		print("<option value='B'>SERIE B</option>");
		print("<option value='C' selected='selected'>SERIE C</option>");
		print("<option value='D'>SERIE D</option>");
		print("<option value='Z'>CONSIGNACI&OacuteN</option>");	
	}	
	if($series=='D') {					

		print("<option value=' '>ORDINARIA</option>");		
		print("<option value='A'>SERIE A</option>");		
		print("<option value='B'>SERIE B</option>");
		print("<option value='C'>SERIE C</option>");
		print("<option value='D' selected='selected'>SERIE D</option>");
		print("<option value='Z'>CONSIGNACI&OacuteN</option>");
	}	     
	if($series=='Z') {					

		print("<option value=' '>ORDINARIA</option>");		
		print("<option value='A'>SERIE A</option>");		
		print("<option value='B'>SERIE B</option>");
		print("<option value='C'>SERIE C</option>");
		print("<option value='D'>SERIE D</option>");
		print("<option value='Z' selected='selected'>CONSIGNACI&OacuteN</option>");
	}
	
	echo "</select>";
}

function get_tonga_nota_reporte($id_tonga)
{
    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_tonga where id_tonga='$id_tonga'");
	if($fila=pg_fetch_array($consulta))
	{
	$nom_tonga=$fila["nom_tonga"];
	return $nom_tonga;
	}
	else
	{
		return "";
	}
	

}


function get_exits_servicios($idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_servicios where id_sucursal='$idsucursal' and id_periodo='$idcosecha'  order by id_servicio";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return 1;
			}
			else
			{
			return 0;
			
			
			}

}
function get_exits_oservicios($idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_oservicios  where id_sucursal='$idsucursal' and id_periodo='$idcosecha' order by id_servicio";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return 1;
			}
			else
			{
			return 0;
			
			
			}

}
function get_clientes_servicios_m($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by nombre ");
	//desconectar();
	//echo "<script languaje='javascript'>alert('hola')</script>";
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='se_actualiza_servicios_cliente(this.value,1)'  dojoType='dijit.form.FilteringSelect'  class='modif'>";
	
	echo "<option value='' >Seleccione cliente</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
							
						 if($idcliente==$b)
						 print("<option value=\"$b\" selected>".nom($nom_clientes)."</option>");
						 else
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}



function get_clientes_historico($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by nombre ");
	//desconectar();
	//echo "<script languaje='javascript'>alert('hola')</script>";
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' dojoType='dijit.form.FilteringSelect'  class='modif'>";
	echo "<option value='' >Seleccione cliente</option>";
	//onChange='actualiza_historico_cliente(this.value,1)'
	while($fila=pg_fetch_array($consulta))
	{
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
							
						 if($idcliente==$b)
						 print("<option value=\"$b\" selected>".nom($nom_clientes)."</option>");
						 else
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}



function get_clientes_oservicios_m($idcliente)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by nombre ");
	//desconectar();
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente' onChange='se_actualiza_oservicios_cliente(this.value,1)'   class='modif'>";
	echo "<option value='' >Seleccione cliente</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
							
						 if($idcliente==$b)
						 print("<option value=\"$b\" selected>".nom($nom_clientes)."</option>");
						 else
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}
function get_servicios_cliente_select($idcliente,$idsucursal,$idcosecha)
{

    global $con;
	if($idcliente>0)
	$consulta=pg_query($con,"SELECT * FROM se_servicios where idcliente='$idcliente' and id_sucursal='$idsucursal' and id_periodo='$idcosecha' order by folio_servicio ");
	else
	$consulta=pg_query($con,"SELECT * FROM se_servicios where idcliente='0' order by folio_servicio "); //no hay nada
	echo "<select name='id_servicios' id='id_servicios' onChange='se_update_servicios(this.value,2)'   class='modif'>";
	echo "<option value='' >Seleccione Servicio</option>";
	while($fila=pg_fetch_array($consulta))
	{
						$b=$fila["id_servicio"];
						//$tipo_servicio=get_tipo_servicio($fila["id_tipo_servicio"]);
						$desc="Folio---".$fila["folio_servicio"]."Fecha---".$fila["fecha_servicio"];
						print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_oservicios_cliente_select($idcliente,$idsucursal,$idcosecha)
{

    global $con;
	if($idcliente>0)
	$consulta=pg_query($con,"SELECT * FROM se_oservicios where idcliente='$idcliente' and id_sucursal='$idsucursal' and id_periodo='$idcosecha' order by folio_servicio ");
	else
	$consulta=pg_query($con,"SELECT * FROM se_oservicios where idcliente='0' and id_sucursal='$idsucursal' and id_periodo='$idcosecha' order by folio_servicio "); //no hay nada
	echo "<select name='id_oservicios' id='id_oservicios' onChange='se_update_oservicios(this.value,2)'   class='modif'>";
	echo "<option value='' >Seleccione Servicio</option>";
	while($fila=pg_fetch_array($consulta))
	{
						$b=$fila["id_servicio"];
						$tipo_servicio=get_tipo_servicio($fila["id_tipo_servicio"]);
						$desc="Folio---".$fila["folio_servicio"]."Fecha---".$fila["fecha_servicio"]."Tipo servicio---".$tipo_servicio;
						print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_tipo_servicio($id_tipo_servicio)
{
//	include 'conexion.php';
    global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_nombre_servicios where id_tipo_servicio='$id_tipo_servicio'";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
			return $fila["nom_servicio"];
			}
			else
			{
			return 0;
			
			
			}

}

function get_tipo_oservicios($id_tipo_servicio)
{

    global $con;
	$consulta=pg_query($con,"SELECT * FROM se_nombre_servicios order by nom_servicio ");
	echo "<select name='id_tipo_servicio' id='id_tipo_servicio' onchange='rellenar_notas(this.form.idcliente.value,this.form.nt_asociada.value,this.value);'   class='iselect'>";
	echo "<option value='' >Seleccione Servicio</option>";
	while($fila=pg_fetch_array($consulta))
	{
						$b=$fila["id_tipo_servicio"];
						if($b==$id_tipo_servicio)
						print("<option value=\"$b\" selected='selected'>".nom($fila["nom_servicio"])."</option>");
						else
						print("<option value=\"$b\">".nom($fila["nom_servicio"])."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_tipo_servicios($id_catalogo)
{

    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_cat_articulos where tipo='G' order by descripcion ");
	echo "<select name='id_catalogo' id='id_catalogo'    class='iselect'>";
	echo "<option value='' >Seleccione Tipo de cafe</option>";
	while($fila=pg_fetch_array($consulta))
	{
						$b=$fila["id_catalogo"];
						if($b==$id_catalogo)
						print("<option value=\"$b\" selected='selected'>".nom($fila["descripcion"])."</option>");
						else
						print("<option value=\"$b\">".nom($fila["descripcion"])."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_tipo_servicios_m($id_tipo_servicio)
{

    global $con;
	$consulta=pg_query($con,"SELECT * FROM se_nombre_servicios order by nom_servicio ");
	echo "<select name='id_tipo_servicio' id='id_tipo_servicio'    class='iselect'>";
	echo "<option value='' >Seleccione Servicio</option>";
	while($fila=pg_fetch_array($consulta))
	{
						$b=$fila["id_tipo_servicio"];
						if($b==$id_tipo_servicio)
						print("<option value=\"$b\" selected='selected'>".nom($fila["nom_servicio"])."</option>");
						else
						print("<option value=\"$b\">".nom($fila["nom_servicio"])."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_se_servicios($id_servicio,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_servicios where id_servicio='$id_servicio' and id_sucursal='$idsucursal' and id_periodo='$idcosecha' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
			}
			else
			{
				return 0;
			}
			

}

function get_se_oservicios($id_servicio,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_oservicios where id_servicio='$id_servicio' and id_sucursal='$idsucursal' and id_periodo='$idcosecha'";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
			}
			else
			{
				return 0;
			}
			

}
function get_se_servicios_gral($idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_servicios where id_sucursal='$idsucursal' and id_periodo='$idcosecha' order by folio_servicio asc ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
			}
			else
			{
				return 0;
			}
			

}
function get_se_oservicios_gral($idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_oservicios where id_sucursal='$idsucursal' and id_periodo='$idcosecha' order by folio_servicio asc ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
			}
			else
			{
				return 0;
			}
			

}

function get_sol_agenda_pdf()
{

    global $con;
	
//consultamos las solicitudes agendadas
$sql="SELECT * FROM cc_solicitudes where idestatus='2' order by folio";

	$consulta=pg_query($con,$sql);
	while($fila=pg_fetch_array($consulta))
	{
		?>
        <tr>
        <?php
						
							
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						//$estatus=get_estatus($fila["idestatus"]);
						
						$fila_get_grupo=get_grupo_sol($idcliente);
						if($fila_get_grupo!=0)
						$grupo="G";
						else
						$grupo="I";					
	
	
				
				?>
<td align="left" ><?php echo nom($nom_cliente); ?></td>
<td align="center"><?php echo nom($grupo);?></td>
<td align="center"><?php echo $fila["folio"];?></td>
<td align="center" ><?php echo $fila["fecha_registro"];?></td>
<td align="right" ><?php echo number_format($fila["monto"],2);?></td>

				
                <?php
						
               if($fila["idestatus"]!=5)	
               $subtotal+=$fila["monto"];                               
							
	
						
						
		echo "</tr>";			
                                 
	
	
	}
return $subtotal;
}
function get_creditos_auto_pdf()
{

    global $con;
	
//consultamos las solicitudes agendadas  and c.entregado='false'
$sql="SELECT s.idsolicitud,s.idcliente,c.folio,c.f_ministracion,c.monto,s.idestatus FROM cc_solicitudes s,cc_creditos c where s.idsolicitud=c.idsolicitud and s.idestatus='3' order by c.folio";

	$consulta=pg_query($con,$sql);
	while($fila=pg_fetch_array($consulta))
	{
		?>
        <tr>
        <?php
						
							
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						//$estatus=get_estatus($fila["idestatus"]);
						$fila_get_grupo=get_grupo_sol($idcliente);
						if($fila_get_grupo!=0)
						$grupo="G";
						else
						$grupo="I";					

				
				?>
<td align="left" ><?php echo nom($nom_cliente); ?></td>
<td align="center" ><?php echo $grupo; ?></td>
<td align="center" ><?php echo $fila["folio"];?></td>
<td align="center" ><?php echo $fila["f_ministracion"];?></td>
<td align="right" ><?php echo number_format($fila["monto"],2);?></td>

				
                <?php
						
                                 
				if($fila["idestatus"]!=5)	
               $subtotal+=$fila["monto"]; 			
	
						
						
		echo "</tr>";			
                                 
	
	
	}
return $subtotal;
}
function get_creditos_entregados_pdf()
{

    global $con;
	
//consultamos las solicitudes agendadas
$sql="SELECT s.idsolicitud,s.idcliente,c.folio,c.f_ministracion,c.monto,s.idestatus FROM cc_solicitudes s,cc_creditos c where s.idsolicitud=c.idsolicitud and s.idestatus='3' and c.entregado='true' order by c.folio";

	$consulta=pg_query($con,$sql);
	while($fila=pg_fetch_array($consulta))
	{
		?>
        <tr>
        <?php
						
							
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						//$estatus=get_estatus($fila["idestatus"]);
						
						$fila_get_grupo=get_grupo_sol($idcliente);
						if($fila_get_grupo!=0)
						$grupo="G";
						else
						$grupo="I";	
				
				?>
<td align="left" ><?php echo nom($nom_cliente); ?></td>
<td align="center" ><?php echo nom($grupo); ?></td>
<td align="center" ><?php echo $fila["folio"];?></td>
<td align="center" ><?php echo $fila["f_ministracion"];?></td>
<td align="right" ><?php echo number_format($fila["monto"],2);?></td>

				
                <?php
						
                                 
				if($fila["idestatus"]!=5)	
                    $subtotal+=$fila["monto"];             			
	
						
						
		echo "</tr>";			
                                 
	
	
	}
return $subtotal;
}

function get_compras_cliente_pdf()
{
	global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM co_compras where estatus=true order by folio ";
	   $id_query = pg_query($con,$consulta);
		 if($fila= pg_fetch_array($id_query))
		  return 1;
		  else
		  return 0;
		
}

function get_ntcompra_used($id_comp)
{
	global $con;
	//global $idrequerimiento;
   $consulta=" SET datestyle TO postgres, dmy;";
	$consulta.="select"; 
	$consulta.="(select count(*)::integer as nregistro from co_compras cm,se_servicios se where se.id_servicio=cm.id_servicio and cm.id_compra=com.id_compra)";
	$consulta.="+";
	$consulta.="(select count(*)::integer as nregistro from re_aplicaciones where id_compra=com.id_compra and estatus=true)";
	$consulta.="+";
	$consulta.="(select count(*)::integer as nregistro from re_cobros_realizados where id_retencion=com.id_compra and estatus=true)";
	$consulta.="+";
	$consulta.="(select count(*)::integer as nregistro from  re_pagos_realizados pr,co_ctasxpagar cxp where pr.idcta_xpagar=cxp.idcta_xpagar and pr.estatus=true and cxp.id_compra=com.id_compra)"; 
	$consulta.="+";
	$consulta.="(select count(*)::integer as nregistro from cc_cheques_anticipos where id_compra=com.id_compra) as nregistro";
   $consulta.="	from co_compras com where id_compra=".$id_comp;   
   $id_query = pg_query($con,$consulta);
	$fila= pg_fetch_array($id_query);
	return $fila['nregistro'];
		
}


function get_catalogo_m($id_catalogo)
{
	global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM al_cat_articulos where id_catalogo='$id_catalogo' ";
	   $id_query = pg_query($con,$consulta);
		 if($fila= pg_fetch_array($id_query))
		 {
		  return $fila;
		 }
		  else
		  {
		  return "";
		  }
		
}

function get_total_pesadas($id_compra,$tipo) //obtenemos el numero total de pesadas
{
	global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM co_pesadas where id_compra='$id_compra' ";
	   $id_query = pg_query($con,$consulta);
	   $henequen=0;
	   $yute=0;
	   $bolsa=0;
		 while($fila= pg_fetch_array($id_query))
		 {
		  $henequen=$henequen+$fila["henequen"];
		  $yute=$yute+$fila["yute"];
		  $bolsa=$bolsa+$fila["bolsa"];
		 }
		  if($tipo=="hene")
		  return $henequen;
		  if($tipo=="yute")
		  return $yute;
		  if($tipo=="bolsa")
		  return $bolsa;
		
}
function get_total_pesadas_tonga($id_compra,$tipo,$id_tonga) //obtenemos el numero total de pesadas
{
	global $con;
	//global $idrequerimiento;
		//verificar si hay merma
		$sql_merma="select count(*)::integer as nreg from co_compras_merma where id_compra='$id_compra'";
	  $consulta_m=pg_query($con,$sql_merma);	
	  $fila_m=pg_fetch_array($consulta_m);
	  if($fila_m["nreg"]>0) {
	  		 $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM co_pesadas_merma where id_compra='$id_compra' and id_tonga='$id_tonga' ";
	  }else {
	 		  $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM co_pesadas where id_compra='$id_compra' and id_tonga='$id_tonga' ";
		}
	  
	   $id_query = pg_query($con,$consulta);
	   $henequen=0;
	   $yute=0;
	   $bolsa=0;
		 while($fila= pg_fetch_array($id_query))
		 {
		  $henequen=$henequen+$fila["henequen"];
		  $yute=$yute+$fila["yute"];
		  $bolsa=$bolsa+$fila["bolsa"];
		 }
		  if($tipo=="hene")
		  return $henequen;
		  if($tipo=="yute")
		  return $yute;
		  if($tipo=="bolsa")
		  return $bolsa;
		
}


function get_notas_compras_pdf()
{

    global $con;
	
//consultamos las solicitudes agendadas
$sql="SELECT * FROM co_compras where estatus=true order by folio";

	$consulta=pg_query($con,$sql);
	while($fila=pg_fetch_array($consulta))
	{
		?>
        <tr>
        <?php
						
							
						$idcliente=$fila["id_proveedor"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						$producto=get_catalogo_m($fila["id_catalogo"]);	//arreglo de al-cat-articulos
					
					$total_henequen=get_total_pesadas($fila["id_compra"],"hene");
					$total_yute=get_total_pesadas($fila["id_compra"],"yute");
					$total_bolsa=get_total_pesadas($fila["id_compra"],"bolsa");
					
					
					
						
						//$estatus=get_estatus($fila["idestatus"]);
						
						
				
				?>
<td align="center" ><?php echo $fila["folio"];?></td>
<td align="center"><?php echo nom($nom_cliente); ?></td>
<td align="center" ><?php echo $producto["descripcion"];?></td>
<td align="center" ><?php echo $fila["fecha_nota"];?></td>
<td align="center"><?php echo number_format($total_henequen,2);?></td>
<td align="center" ><?php echo number_format($total_yute,2);?></td>
<td align="center" ><?php echo number_format($total_bolsa,2);?></td>
<td align="center"><?php echo number_format($fila["total_kgs_brutos"],2);?></td>
<td align="center" ><?php echo number_format($fila["total_tara"],2);?></td>
<td align="center" ><?php echo number_format($fila["total_kgs_netos"],2);?></td>
<td align="center" ><?php echo number_format($fila["precio_kilo"],2);?></td>
<td align="center" ><?php echo number_format($fila["subtotal"],2);?></td>



				
                <?php
						
                                 
							
	
						
						
		echo "</tr>";			
                                 
	
	
	}

}

function get_servicios_cliente_pdf()
{
	global $con;
	//global $idrequerimiento;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_servicios order by folio_servicio ";
	   $id_query = pg_query($con,$consulta);
		 if($fila= pg_fetch_array($id_query))
		  return 1;
		  else
		  return 0;
		
}

function get_servicios_compras_pdf()
{
    global $con;

?>
<table border="1" cellpadding="2">
<tr>
<td align="center" width="9%" bgcolor="#DFDFDF">Folio</td>
<td align="center" width="20%" bgcolor="#DFDFDF">Productor</td>
<td align="center" width="8%" bgcolor="#DFDFDF">Fecha</td>
<td align="center" width="7%" bgcolor="#DFDFDF">Cantidad</td>
<td align="center" width="9%" bgcolor="#DFDFDF">Servicio</td>
<td align="center" width="10%" bgcolor="#DFDFDF">Precio Unitario</td>
<td align="center" width="10%" bgcolor="#DFDFDF">Subtotal</td>
<td align="center" width="10%" bgcolor="#DFDFDF">Total</td>
<td align="center" width="17%" bgcolor="#DFDFDF">Observaciones</td>
</tr>
	
<?php
	
	
//consultamos las solicitudes agendadas
$sql="SELECT * FROM se_servicios order by folio_servicio";

	$consulta=pg_query($con,$sql);
	while($fila=pg_fetch_array($consulta))
	{
		?>
        <tr>
        <?php
						
							
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						$servicio=get_tipo_servicio($fila["id_tipo_servicio"]);
						
				
				?>
<td align="center" ><?php echo $fila["folio_servicio"];?></td>
<td align="center" ><?php echo nom($nom_cliente); ?></td>
<td align="center" ><?php echo $fila["fecha_servicio"];?></td>
<td align="center" ><?php echo $fila["cantidad"];?></td>
<td align="center" ><?php echo $servicio;?></td>
<td align="center"><?php echo number_format($fila["precio_u"],2);?></td>
<td align="center"><?php echo number_format($fila["subtotal"],2);?></td>
<td align="center" ><?php echo number_format($fila["total"],2);?></td>
<td align="center" ><?php echo nom($fila["observaciones"]);?></td>
				
                <?php
						
                                 
							
	
						
						
		echo "</tr>";			
                                 
	
	
	}

?>
</table>
<?php
}

function get_se_servicios_cliente($idcliente,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_servicios where idcliente='$idcliente' and id_sucursal='$idsucursal' and id_periodo='$idcosecha' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
			}
			else
			{
				return 0;
			}
			

}



function get_se_oservicios_cliente($idcliente,$idsucursal,$idcosecha)
{
//	include 'conexion.php';
    global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_oservicios where idcliente='$idcliente' and id_sucursal='$idsucursal' and id_periodo='$idcosecha' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 if($fila= pg_fetch_array($id_query))
		   {
	 
				return $fila;
			}
			else
			{
				return 0;
			}
			

}

function get_clientes_cuenta()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by nombre ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises onChange='actualiza_nota_cliente(this.value,1)' 
	echo "<select name='idcliente' id='idcliente'   class='modif'>";
	echo "<option value='' >Elige</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_sucursal_m($id_sucursal)
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_sucursales where id='$id_sucursal' ");
	
	
 if($fila= pg_fetch_array($consulta))
		   {
	 
			return $fila;
			}
			else
			{
			return 0;
			
			
			}
}

function get_cobros($id_servicio)
{
	 global $con;
	$consulta=pg_query($con,"SELECT * FROM se_cobros where id_servicio='$id_servicio' and cancelado='f' ");
	
	$total=0;
 			while($fila= pg_fetch_array($consulta))
		    {
	 		$total=$total+$fila["importe"];
			}
			return $total;
			
}

function get_cobros_m($id_servicio)
{
	 global $con;
	$consulta=pg_query($con,"SELECT * FROM se_cobros where id_servicio='$id_servicio'");
	if($fila= pg_fetch_array($consulta))
	return $fila;
	else
	return 0;
		    
			
}

function get_cobros_consulta($id_servicio)
{
?>
<blockquote>
<div align="center">

<?php 
global $con;  //conexion
?><br />
<table border="0" width="80%">
<tr>
    <td  align="center"><strong>Saldo inicial</strong></td>
  
    <td  bgcolor="#DFDFDF" align="right"><strong>$ <?php echo number_format(get_monto_servicio($id_servicio,$con),2); ?></strong></td>
    <td  align="center"><strong>Total Cobros</strong></td>
    <td bgcolor="#DFDFDF" align="center"><strong>$ <?php echo number_format(get_saldo_servicio($id_servicio,$con),2); ?></strong></td>
    <td  align="center"><strong>Saldo Final</strong></td>
    <td bgcolor="#DFDFDF" align="center"><strong>$ <?php echo number_format(get_monto_servicio($id_servicio,$con)-get_saldo_servicio($id_servicio,$con),2); ?></strong></td>
  </tr>
</table>
<hr />
<table width="50%" border="1" style="border-collapse:collapse">

  <tr>
    <td bgcolor="#7777FF" align="center"><strong>Id</strong></td>
    <td  bgcolor="#DFDFDF" align="right"><strong>Importe</strong></td>
    <td bgcolor="#DFDFDF" align="center"><strong>Fecha de cobro</strong></td>
    <td bgcolor="#DFDFDF" align="center"><strong>Condonado</strong></td>
    <td bgcolor="#DFDFDF" align="center"><strong>Cancelado</strong></td>
  </tr>
<?php

	
	$consulta=pg_query($con,"  SET datestyle TO postgres, dmy; SELECT * FROM se_cobros where id_servicio='$id_servicio' order by fecha_cobro asc ");
	$con=1;
	$total=0;
 			while($fila= pg_fetch_array($consulta))
		    {
				$importe=$fila["importe"];
				$fecha_cobro=$fila['fecha_cobro'];
				$id_cobro=$fila["id_cobro"];
				
				if($fila["cancelado"]=="t")
				$color_cancelado="#FF7777";
				else
				unset($color_cancelado);
			
			?>
            <tr>
            <td align="center" bgcolor="<?php echo $color_cancelado; ?>"><?php echo number_format($con,1); ?></td>
            <td align="right" bgcolor="<?php echo $color_cancelado; ?>"> $ <?php echo number_format($fila["importe"],2); ?></td>
            <td align="center" bgcolor="<?php echo $color_cancelado; ?>"><?php echo $fila["fecha_cobro"]; ?></td>
            <td align="center" bgcolor="<?php echo $color_cancelado; ?>"><?php if($fila["condonado"]=="true"){ echo "Condonado"; } else { echo "No"; } ?></td>
            
            <td align="center" bgcolor="<?php echo $color_cancelado; ?>">
			<?php 
			if($fila["cancelado"]=="t")
			{ 
			?><font color="#CC0000">X</font><?php
			} 
			else 
			{ 
			?><a onclick='cancela_cobro_ser(<?php echo $id_servicio; ?>,<?php echo $id_cobro; ?>,"<?php echo number_format($importe,2); ?>","<?php echo $fecha_cobro; ?>"); return false'><font color="#006600">NO</font></a><?php
			} 
			?>
            
            </td>
            
            
            
            </tr>
            <?php	
				if($fila["cancelado"]=="f")
				{ 	
				$total=$total+$fila["importe"];
				}
			$con++;
			}	
			?>
			 <tr>
             <td colspan="3"></td>
            <td align="right"><strong>Total</strong></td>
             <td align="center"><strong> $ <?php echo number_format($total,2); ?></strong></td>
            
            </tr>
            <?php
			
?>
</table>
</div>
</blockquote>
<?php
	
}

function cancela_servicio($id_cobro)
{
	 global $con;

	$inserta="update se_cobros set cancelado='t' where id_cobro='$id_cobro'";

	$consulta=pg_query($con,$inserta);
	
	if($consulta>0)
	return 1;
	else
	return 0;
}

function get_saldo_servicio($id_servicio,$con)
{
//	global $con;
	$consulta=pg_query($con,"  SET datestyle TO postgres, dmy; SELECT * FROM se_cobros where id_servicio='$id_servicio' and cancelado='f'");
	$con=1;
	$total=0;
 			while($fila= pg_fetch_array($consulta))
		    {
				$total=$total+$fila["importe"];

			}
			return $total;
			
}
function get_monto_servicio($id_servicio,$con)
{
//	global $con;
	$consulta=pg_query($con,"  SET datestyle TO postgres, dmy; SELECT * FROM se_servicios where id_servicio='$id_servicio' ");
	$total=0;
 			while($fila= pg_fetch_array($consulta))
		    {
				$total=$fila["total"];

			}
			return $total;
			
}



function get_cobro_actual($id_servicio,$con)
{
//	global $con;
	$consulta=pg_query($con,"  SET datestyle TO postgres, dmy; SELECT * FROM se_cobros where id_servicio='$id_servicio' and cancelado='f' order by id_cobro asc");
	$con=1;
	$importe=0;
 			while($fila= pg_fetch_array($consulta))
		    {
				$importe=$fila["importe"];

			}
			return $importe;
			
}


function get_permisos($id_perfil)
{

    global $con;
	$consulta=pg_query($con,"SELECT mnu_egos.id, mnu_egos.opciones\n" .
                 "FROM mnu_egos \n" .
            "where mnu_egos.id not in ( \n" .
            "select perfiles_usr.id_menu from perfiles_usr where perfiles_usr.id_perfil=" . $id_perfil . " )\n" .
            "and mnu_egos.tipo='M'\n" .
			"and mnu_egos.estatus='1'" .
			"order by mnu_egos.id".
            "");
	echo "<select name='id_menu' id='id_menu'   class='iselect'>";
	echo "<option value='' >------ Procesos------</option>";
	while($fila=pg_fetch_array($consulta))
	{
							$b=$fila["id"];
						
						 print("<option value=\"$b\">".nom($fila["opciones"])."</option>");
                                 
	
	
	}
	echo "</select>";	
	
	
}

function get_permisos_perfil($id_perfil)
{
	    global $con;
	$consulta=pg_query($con,"SELECT mnu_egos.opciones,perfiles_usr.id_perfil,perfiles_usr.id FROM perfiles_usr,mnu_egos,perfiles where perfiles_usr.id_perfil='$id_perfil' and mnu_egos.id=perfiles_usr.id_menu and perfiles.id_perfil=perfiles_usr.id_perfil order by perfiles.nombre_perfil");
	?>

    <table class="Record art-article" >
	<tr>
    <th> <li class="iheader"><h2 class="art-logo-text">Permisos Asignados</h2></li> </th>
	  </tr>
    <?php
	
while($fila=pg_fetch_array($consulta))
	{
	  ?>                          
<tr> 
<td>
            <?php
		  $opcion=$fila["opciones"];
	  echo "*".nom($opcion);
	  $perfil_id=$fila["id_perfil"];
	  $id_permiso=$fila["id"];
	  ?>          
</td>

<td>
            <?php
		  
	  echo "<a onclick=elimina_perfil_usr(".$perfil_id.",".$id_permiso.")>"."<font color='#FF0000'>"."X"."<font>"."</a>";
	  ?>          
</td>


</tr>
      
 
      <?php 
	
	}
echo "</table>";	
	
}

function get_perfil($id_perfil)
{
	 global $con;
	$consulta=pg_query($con,"SELECT * FROM perfiles where id_perfil='$id_perfil'");
	if($fila= pg_fetch_array($consulta))
	return $fila;
	else
	return 0;
		    
	
}

function get_orden_menu()
{
   global $con;
	$consulta=pg_query($con,"SELECT * FROM mnu_egos WHERE tipo='M' and estatus='1' order by orden asc");
	?>
    <form name="captura" action="" onSubmit="ordena_menu(); return false" class="formu">
    <table class="Record art-article" width="50%" >
	<tr>
    <th><h2 class="art-logo-text">Ordenamiento de Menu</h2></th>
    <th><h2 class="art-logo-text">Orden</h2></th>
	  </tr>
    <?php
	$orden=array();
while($fila=pg_fetch_array($consulta))
	{
		$menu[]=$fila["id"];
		
	  ?>                          
<tr> 
<td align="center">
            <?php
	  $opcion=$fila["opciones"];		  
	  echo "*".nom($opcion);
	  ?>          
</td>


<td align="center">
<input type="text" name="orden[]" value="<?php echo $fila["orden"]; ?>" class="peque" />
</td>
</tr>
      <?php 
	
	}
	
?>	
<tr>
<td colspan="2" align="center"></td>
</tr>
<tr>
<td colspan="2" align="center"><input class="ibutton" type="submit" name="enviar" id="enviar" value="ORDENAR" ></td>
</tr>

<?php 
//convertimos a cadema arreglo menu
foreach($menu as $valor)
{
	$menu_id=$menu_id.$valor.",";
}
?>

<tr>
<td colspan="2" align="right"><input class="ibutton" type="button" name="enviar2" id="enviar2" value="ACTUALIZAR CAMBIOS" onclick="location.reload(false);" /></td>
</tr>




<input type="hidden" name="menu" value="<?php echo $menu_id; ?>" />
</table>
</form>
<?php	
}



/*******FUNCIONE PARA GENERAR ESTADO DE CUENTA******/

function get_servicios_cuenta($idcliente,$fecha_corte)
{

    global $con;
?>
<table border="1" style="border-collapse:collapse" width="100%">
 
<?php
	
	
//consultamos las solicitudes agendadas
$sql="SET datestyle TO postgres, dmy; SELECT * FROM se_servicios where idcliente='$idcliente' and fecha_servicio<='$fecha_corte' order by folio_servicio";

	$consulta=pg_query($con,$sql);
	$cont=0;
	while($fila=pg_fetch_array($consulta))
	{
		
		if($cont==0)
	{ echo '<div align="left"><strong>SERVICIO(S) OTORGADO(S):</strong><div>';		 	
	?>
     <tr>
<th align="center">Folio</td>
<th align="center">Concepto</td>
<th align="center">Fecha</td>
<th align="center">Cantidad</td>
<td align="right"><strong>Precio Unitario</strong></td>
<td align="right"><strong>Importe</strong></td>
<td align="right"><strong>Pagos</strong></td>
<td align="right"><strong>Total</strong></td>

</tr> 
    <?php
	}
	?>
		
        <tr>
        <?php
						
							
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						$servicio=get_tipo_servicio($fila["id_tipo_servicio"]);
						
						$total_pagos=get_pagos_servicios($fila["id_servicio"]);
						
						if($fila["total"]>$total_pagos)//ADEUDOS
						$color="#FFFF99";
						if($fila["total"]==$total_pagos)//ADEUDOS
						$color="#B3FFC6";

						
						
				
				?>

<td align="center" bgcolor="<?php echo $color; ?>"><?php echo $fila["folio_servicio"];?></td>
<td align="center" bgcolor="<?php echo $color; ?>"><?php echo $servicio;?></td>
<td align="center" bgcolor="<?php echo $color; ?>"><?php echo $fila["fecha_servicio"];?></td>
<td align="center" bgcolor="<?php echo $color; ?>"><?php echo $fila["cantidad"];?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["precio_u"],2);?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["subtotal"],2);?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($total_pagos,2);?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["total"],2);?></td>


				
                <?php
						
                                 
							
	
						
						
		echo "</tr>";			
                                 
	$cont++;
	
	}

?>
</table>
<?php
}

function get_pagos_servicios($id_servicio)
{
    global $con;
	$consulta=pg_query($con,"select sum(importe) as sum_importe from se_cobros  where id_servicio='$id_servicio' and cancelado=false");
	$total=0;
 			if($fila= pg_fetch_array($consulta))
		    {
				$total=$fila["sum_importe"];
				return $total;

			}
			else
			{
				return 0;
			}

	
	
}



function get_compras_cuenta($idcliente,$fecha_corte)
{
    global $con;

?>

<table border="1" style="border-collapse:collapse" width="100%" >

<?php
	
//consultamos las solicitudes agendadas
$sql="SET datestyle TO postgres, dmy; SELECT * FROM co_compras where estatus=true and id_proveedor='$idcliente' and fecha_nota<='$fecha_corte' order by folio";
	$consulta=pg_query($con,$sql);
	$cont=0;
	while($fila=pg_fetch_array($consulta))
	{
		
		if($cont==0)
	{
		echo '<br><div align="left"><strong>COMPRA(S) REALIZADA(S):</strong><div>';
	?>
   <tr>
<th align="center">Fecha</td>
<th align="center">Folio N.E</td>
<th align="center">Producto</td>
<th align="center">Kgs</td>
<td align="right"><strong>Precio Unitario</strong></td>
<td align="right"><strong>Importe</strong></td>
<td align="right"><strong>Adeudo Actual</strong></td>

</tr>
    <?php
	}
	?>
		
        <tr>
        <?php
						
							
				
						
						/*$total_pagos=get_pagos_servicios($fila["id_servicio"]);
						
						if($fila["total"]>$total_pagos)//ADEUDOS
						$color="#FFFF99";
						if($fila["total"]==$total_pagos)//ADEUDOS
						$color="#B3FFC6";
						*/
						$color="#B3FFC6";
					$fila_catalogo=get_catalogo_m($fila["id_catalogo"]);
						
						
				
				?>

<td align="center" bgcolor="<?php echo $color; ?>"><?php echo $fila["fecha_nota"];?></td>
<td align="center" bgcolor="<?php echo $color; ?>"><?php echo $fila["folio"];?></td>
<td align="center" bgcolor="<?php echo $color; ?>"><?php echo nom($fila_catalogo["descripcion"]);?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["total_kgs_netos"],2);?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["precio_kilo"],2);?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["subtotal"],2);?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format(0,2);?></td>


				
                <?php
						
                                 
							
	
						
						
		echo "</tr>";			
                                 
	$cont++;
	
	}


echo "</table>";

}



/****FIN DE LAS FUNCIONES QUE GENERAN ESTADO DE CUENTA****/





function get_auto_grupo()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_grupos  order by grupo ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idgrupo' id='idgrupo' onChange='auto_filtra_grupo(this.value,7)'   class='modif'>";
	echo "<option value='' >Seleccione Grupo</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idgrupo"];
							
						
						print("<option value=\"$b\">".nom($fila["grupo"])."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_solicitudes_agendadas_m($idgrupo)
{
//	include 'conexion.php';
    global $con;
	$idestatus=2; //solicitudes agendadas
	
	if($idgrupo>0)
	{
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes as s, rela_grupo as g where s.idestatus='$idestatus' and s.idcliente=g.idcliente and g.idgrupo='$idgrupo'  order by s.folio");
	}
	else
	{
		$idgrupo=0;//PARA NO ENCONTRAR NINGUNA SOLICITUD PERTENECIENTE A NINGUN GRUPO
$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes as s, rela_grupo as g where s.idestatus='$idestatus' and s.idcliente=g.idcliente and g.idgrupo='$idgrupo'  order by s.folio");
	}
	
	
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idsolicitude' id='idsolicitud' onchange='autoriza_solicitud_grupo(this.value,1); return false' class='consultor3'>";
	echo "<option value=''>Seleccione Solicitud</option>";
	while($fila_c=pg_fetch_array($consulta))
	{
		
	
						$folio_s=$fila_c["folio"];
						$fecha_s=$fila_c["fecha_registro"];
						$monto_s=number_format($fila_c["monto"],2);
						
						$b=$fila_c["idsolicitud"];
						
						
						$fila_cliente=get_cliente($fila_c["idcliente"]);				
						$nombre_cliente=$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"];
						
						
						$desc="$folio_s $fecha_s $monto_s $nombre_cliente";
						
						 print("<option value=\"$b\">".$desc."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_solicitudes_autorizadas_m($idgrupo)
{
//	include 'conexion.php';
    global $con;
	$idestatus=3; //Autorizadas
	//
	
	if($idgrupo>0)
	{
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes as s, rela_grupo as g where s.idestatus='$idestatus' and s.idcliente=g.idcliente and g.idgrupo='$idgrupo'  order by s.folio");
	}
	else
	{
		$idgrupo=0;//PARA NO ENCONTRAR NINGUNA SOLICITUD PERTENECIENTE A NINGUN GRUPO
$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes as s, rela_grupo as g where s.idestatus='$idestatus' and s.idcliente=g.idcliente and g.idgrupo='$idgrupo'  order by s.folio");
	}
	
	
	
	//$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes where idestatus='$idestatus'   order by folio");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idsolicitude' id='idsolicitud' onchange='autoriza_solicitud_grupo(this.value,4); return false' class='consultor3'>";
	echo "<option value=''>Seleccione Solicitud</option>";
	while($fila_c=pg_fetch_array($consulta))
	{
		
	
						$folio_s=$fila_c["folio"];
						$fecha_s=$fila_c["fecha_registro"];
						$monto_s=number_format($fila_c["monto"],2);
						
						$b=$fila_c["idsolicitud"];
						
						
						$fila_cliente=get_cliente($fila_c["idcliente"]);				
						$nombre_cliente=$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"];
						
						
						$desc="$folio_s $fecha_s $monto_s $nombre_cliente";
						
						 print("<option value=\"$b\">".$desc."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_grupo_select()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_grupos  order by grupo ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idgrupo' id='idgrupo'    class='modif'>";
	echo "<option value='' >Seleccione Grupo</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idgrupo"];
							
						
						print("<option value=\"$b\">".nom($fila["grupo"])."</option>");
                                 
	
	
	}
	$individual='INDIVIDUALES';
	$indv="null";//para reporte de clientes individuales
	print("<option value=\"$indv\">$individual</option>");
	
	echo "</select>";
}



function get_sol_grupo_pdf($idgrupo,$fecha_i,$fecha_f)
{
	global $con;
	//global $idrequerimiento;

	   if($idgrupo=="null")//FILTRO PARA LAS SOLICITUDES INDIVIDUALES
	   {
		   return 1;
	   }
	   
	   $consulta="SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes as s, rela_grupo as g where s.idcliente=g.idcliente and g.idgrupo='$idgrupo' and s.fecha_registro between '$fecha_i' and '$fecha_f'  order by s.folio";
	 
	   $id_query = pg_query($con,$consulta);
		 if($fila= pg_fetch_array($id_query))
		  return 1;
		  else
		  return 0;
		
}

function get_solicitud_grupo_pdf($idgrupo,$fecha_i,$fecha_f)
{

    global $con;
	
if($idgrupo!="null")
{
$sql="SET datestyle TO postgres, dmy; SELECT s.idcliente,s.idestatus,s.t_sol,s.folio,s.fecha_registro,s.monto FROM cc_solicitudes as s, rela_grupo as g where s.idcliente=g.idcliente and g.idgrupo='$idgrupo' and s.fecha_registro between '$fecha_i' and '$fecha_f'  order by s.folio";
$consulta_grupo=1;
}
else
{
	$sql="SET datestyle TO postgres, dmy; SELECT s.idcliente,s.idestatus,s.t_sol,s.folio,s.fecha_registro,s.monto FROM cc_solicitudes as s where s.idcliente NOT IN (select idcliente from rela_grupo where idcliente=s.idcliente ) and s.fecha_registro between '$fecha_i' and '$fecha_f'  order by s.folio";
$consulta_grupo=2;
}

	$consulta=pg_query($con,$sql);
	$subtotal=0;
	while($fila=pg_fetch_array($consulta))
	{
		?>
        <tr>
        <?php
						
							
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						$estatus=get_estatus($fila["idestatus"]);
						
						if($fila["t_sol"]==2 and $consulta_grupo==1){$personal="*";}
						
				
				
						$fila_get_grupo=get_grupo_sol($idcliente);
						if($fila_get_grupo!=0)
						$grupo="G";
						else
						$grupo="I";	
				
				
				?>
<td align="left"><?php echo $personal; echo nom($nom_cliente); ?></td>
<td align="center"><?php  echo nom($grupo); ?></td>
<td align="center"><?php echo $fila["folio"];?></td>
<td align="center"><?php echo $fila["fecha_registro"];?></td>
<td align="right"><?php echo number_format($fila["monto"],2);?></td>
<td align="center"><?php echo nom($estatus["estatus"]); ?></td>
				
                <?php
					if($fila["idestatus"]!=5)	
                    $subtotal+=$fila["monto"];             
                                 
					unset($personal);		
	
						
						
		echo "</tr>";			
                                 
	
	
	}
return $subtotal;
}


function get_creditos_ministrados($idcliente,$fecha_f)//fecha_f es la fecha de corte
{
    global $con;

?>
<table border="1" style="border-collapse:collapse" width="100%">
<?php
	
	
//consultamos las solicitudes agendadas
$sql="SET datestyle TO postgres, dmy; 
SELECT
ca.fecha,
ca.ref_recibo as referencia,
ca.monto,
 '$fecha_f'::date-ca.fecha as dias_trans,
(ca.monto*( ( (c.interes_normal/12)/30 ))/100 )*( '$fecha_f'::date-ca.fecha )as interes_normal,
0 as i_moratorio,
0 as pagos ,
(ca.monto)+((ca.monto*( ( (c.interes_normal/12)/30 ))/100 )*( '$fecha_f'::date-ca.fecha )) as adeudo_actual,
'CAJA'::varchar as forma_pago
FROM cc_solicitudes as s, cc_creditos as c, cajas as ca, cc_cajas_ministracion as cam  where  s.idcliente='$idcliente' and  s.idsolicitud=c.idsolicitud  and c.idcredito=cam.idcredito  and cam.idmov=ca.idmov and ca.fecha<='$fecha_f'
UNION ALL
SELECT 
ch.fecha,
ch.ref_cheque as referencia,
ch.monto,
 '$fecha_f'::date-ch.fecha as dias_trans, 
(ch.monto*( ( (c.interes_normal/12)/30 ))/100 )*( '$fecha_f'::date-ch.fecha )as interes_normal,
0 as i_moratorio,
0 as pagos,
(ch.monto)+((ch.monto*( ( (c.interes_normal/12)/30 ))/100 )*( '$fecha_f'::date-ch.fecha )) as adeudo_actual,
'CHEQUE'::varchar as forma_pago
FROM cc_solicitudes as s, cc_creditos as c, cheques as ch, cc_cheques_ministracion as chm where  s.idcliente='$idcliente' and  s.idsolicitud=c.idsolicitud  and c.idcredito=chm.idcredito  and chm.idmov=ch.idmov and ch.fecha<='$fecha_f'
ORDER BY fecha";

	$consulta=pg_query($con,$sql);
	$cont=0;
	while($fila=pg_fetch_array($consulta))
	{
		
	if($cont==0)
	{echo '<div align="left"><strong>CREDITOS(S) OTORGADO(S):</strong><div>';		
	?>
    <tr>
    <th>FECHA</th>
    <th>REF</th>
    <th>CAPITAL</th>
    <th>DIAS TRANSCURRIDOS</th>
    <th>I NORMALES</th>
    <th>I MORATORIOS</th>
    <th>PAGOS</th>
    <th>ADEUDO ACTUAL</th>
    <th>FORMA PAGO</th>
  </tr>
    <?php
	}
	?>
	    
        
        <tr>
        <?php

						
						if($fila["pagos"]<$fila["monto"])//ADEUDOS
						$color="#FFFF99";
						if($fila["pagos"]==$fila["monto"])//ADEUDOS
						$color="#B3FFC6";
				
							
						
						
				
				?>

<td align="center" bgcolor="<?php echo $color; ?>" width="100"><?php echo $fila["fecha"];?></td>
<td align="center" bgcolor="<?php echo $color; ?>"><?php echo $fila["referencia"];?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["monto"],2);?></td>
<td align="center" bgcolor="<?php echo $color; ?>"><?php echo $fila["dias_trans"];?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["interes_normal"],2);?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["i_moratorio"],2);?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["pagos"],2);?></td>
<td align="right"  bgcolor="<?php echo $color; ?>">$ <?php echo number_format($fila["adeudo_actual"],2);?></td>
<td align="center" bgcolor="<?php echo $color; ?>"><?php echo $fila["forma_pago"];?></td>


				
                <?php
						
                                 
							
	
						
						
		echo "</tr>";			
                                 
	$cont++;
	
	}

?>
</table>
<?php
}


function get_detalle_credito_cancelado($idcredito,$id_usuario)
{
	$fila_credito=get_credito_m($idcredito);
?>
<form name="captura_credito" action="" onSubmit="cc_validad_creditos_entre(6); return false" class="formu">  
<input type="hidden" name="folio" value="<?php echo $fila_credito["folio"]; ?>" />
<input type="hidden" name="idcredito" value="<?php echo $idcredito; ?>" />
<table width="40%" border="0">
  <tr>
    <td>Fecha de entrega del cr&eacute;dito</td>
    <td><input name="f_entrega" type="text" id="f_entrega" onclick="popUpCalendar(this, captura_credito.f_entrega, 'dd-mm-yyyy');"  value="<?php echo $fila_credito["f_entrega"] ?>" readonly="readonly" class="itext" disabled="disabled">	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
   <?php 
  if($id_usuario==187)
  $disabled="";
  else
  $disabled="readonly='readonly'";
   ?>
  
  <tr>
    <th>Monto Autorizado</th>
    <td>
    <input name="monto_auto" type="text" id="monto_auto"   value="<?php echo number_format($fila_credito["monto"],2); ?>" class="itext" onkeypress="return acceptNum(event)" <?php echo $disabled; ?> disabled="disabled">
    
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  
  <tr>
    <td>Observaciones</td>
    <td><textarea name="observacioness" class="itext" id="observaciones" disabled="disabled"><?php echo $fila_credito["observaciones"] ?></textarea>
    
    
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>

    <td align="center" colspan="2"><?php $img='<img src="../dummies/cancela_credito.png" alt="cancelar" title="Cancelado" >';

echo '<a href="#" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>'; ?></td>
    <td align="right">&nbsp;</td>
    <td align="right"></td>
  </tr>
</table>
</form>

<?php
	
	
	
}

function get_detalles_cancelacion($idcredito)
{
	global $con;
?>
<div id="bloque">
<?php	
 $consulta="SET datestyle TO postgres, dmy; SELECT monto,folio,f_cancela FROM cc_creditos where idcredito='$idcredito'";
	 
	   $id_query = pg_query($con,$consulta);
		 while($fila= pg_fetch_array($id_query))
		 {
			 echo "<p><strong>El credito ".$fila["folio"]." con un monto de $".number_format($fila["monto"],2)." a sido cancelado</strong></p>";
			 echo "<p><strong>Fecha de cancelacion ".$fila["f_cancela"]."</strong></p>";
		 }




?>
</div>
<?php
}

function comprueba_estatus_credito($idcredito)
{
	global $con;
	
	$consulta="SET datestyle TO postgres, dmy; SELECT cancelado FROM cc_creditos where idcredito='$idcredito' and cancelado='true'";
	 
	   $id_query = pg_query($con,$consulta);
		if($fila= pg_fetch_array($id_query))
		 {
	echo "<div id='bloque'>";
	$fila_credito=get_credito_m($idcredito);
    get_datos_cliente_credito($fila_credito["idsolicitud"],$idcredito);
	echo "</div>";

echo "<div align='center'><strong><font color='#003300'>El credito esta cancelado</font></strong></div>";

	 get_detalle_credito_cancelado($idcredito,$id_usuario);//CONSULTA DE LA CANCELACION DEL CREDITO
	 
	 get_detalles_cancelacion($idcredito);
	 exit;

		 }

	
	
	
}

function get_credito_grupo($idgrupo,$fecha_i,$fecha_f)
{
	global $con;
	//global $idrequerimiento;

	   if($idgrupo=="null")//FILTRO PARA LAS SOLICITUDES INDIVIDUALES
	   {
		   return 1;
	   }
	   
	   $consulta="SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes as s, rela_grupo as g, cc_creditos as c where s.idcliente=g.idcliente and g.idgrupo='$idgrupo' and s.idsolicitud=c.idsolicitud and s.fecha_registro between '$fecha_i' and '$fecha_f'  order by c.folio";
	 
	   $id_query = pg_query($con,$consulta);
		 if($fila= pg_fetch_array($id_query))
		  return 1;
		  else
		  return 0;
		
}

function get_credito_grupo_pdf($idgrupo,$fecha_i,$fecha_f)
{

    global $con;
	
if($idgrupo!="null")
{
$sql="SET datestyle TO postgres, dmy; SELECT s.idcliente,s.idestatus,s.t_sol,c.folio,c.f_aprobacion,c.monto FROM cc_solicitudes as s, rela_grupo as g, cc_creditos as c where s.idcliente=g.idcliente and g.idgrupo='$idgrupo' and s.idsolicitud=c.idsolicitud and c.f_ministracion between '$fecha_i' and '$fecha_f'  order by c.folio";
$consulta_grupo=1;
}
else
{
	$sql="SET datestyle TO postgres, dmy; SELECT s.idcliente,s.idestatus,s.t_sol,c.folio,c.f_aprobacion,c.monto FROM cc_solicitudes as s, cc_creditos as c where s.idcliente NOT IN (select idcliente from rela_grupo where idcliente=s.idcliente ) and s.idsolicitud=c.idsolicitud and c.f_ministracion between '$fecha_i' and '$fecha_f'  order by c.folio";
$consulta_grupo=2;
}

	$consulta=pg_query($con,$sql);
	$subtotal=0;
	while($fila=pg_fetch_array($consulta))
	{
		?>
        <tr>
        <?php
						
							
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						$estatus=get_estatus($fila["idestatus"]);
						
						if($fila["t_sol"]==2 and $consulta_grupo==1){$personal="*";}
			
			
			$fila_get_grupo=get_grupo_sol($idcliente);
						if($fila_get_grupo!=0)
						$grupo="G";
						else
						$grupo="I";	
						
				
				?>
<td align="left"><?php echo $personal; echo nom($nom_cliente); ?></td>
<td align="center"><?php  echo nom($grupo); ?></td>
<td align="center"><?php echo $fila["folio"];?></td>
<td align="center"><?php echo $fila["f_aprobacion"];?></td>
<td align="right"><?php echo number_format($fila["monto"],2);?></td>

				
                <?php
					if($fila["idestatus"]!=5)	
                    $subtotal+=$fila["monto"];             
					
					
					unset($personal);		
	
						
						
		echo "</tr>";			
                                 
	
	
	}

return $subtotal;

}

function get_credito_cuenta($fecha_i,$fecha_f)
{
	global $con;
	//global $idrequerimiento;
	   
	   $consulta="SET datestyle TO postgres, dmy; SELECT * FROM cc_solicitudes as s, cc_creditos as c where s.idsolicitud=c.idsolicitud and s.fecha_registro between '$fecha_i' and '$fecha_f'  order by c.folio";
	 
	   $id_query = pg_query($con,$consulta);
		 if($fila= pg_fetch_array($id_query))
		  return 1;
		  else
		  return 0;
		
}
function get_credito_cuenta_excel($fecha_i,$fecha_f)
{
    global $con;
	
$sql="SET datestyle TO postgres, dmy; SELECT s.idcliente,s.idestatus,s.t_sol,c.folio,c.f_aprobacion,c.monto,c.idcredito FROM cc_solicitudes as s, cc_creditos as c    where s.idsolicitud=c.idsolicitud and c.cancelado='false' and c.f_ministracion between '$fecha_i' and '$fecha_f'  order by c.folio";
	$consulta=pg_query($con,$sql);
	$subtotal=0;
	$cont=0;
	$a="A9";
	$d="D9";
	$e="E9";
	$f="F9";
	while($fila=pg_fetch_array($consulta))
	{
	
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						$estatus=get_estatus($fila["idestatus"]);
						
			
			$fila_get_grupo=get_grupo_sol($idcliente);
						if($fila_get_grupo!=0)
						$grupo="Grupo";
						else
						$grupo="Individual";	
						
				
		
		
$objPHPExcel->getActiveSheet()->SetCellValue($a,nom($nom_cliente));
$objPHPExcel->getActiveSheet()->SetCellValue($d,$fila["f_aprobacion"]);
$objPHPExcel->getActiveSheet()->SetCellValue($e,$fila["folio"]);
$objPHPExcel->getActiveSheet()->SetCellValue($f,$fila["monto"]);
		
		
				
					if($fila["idestatus"]!=5)	
                    $subtotal+=$fila["monto"];             
					
         $cont++;
		 $a++;
		 $d++;
		 $e++;
		 $f++;	                        


//get_creditos_ministrados_cuenta($fila["idcredito"],$fecha_f);
	}

return $subtotal;

}

function get_creditos_ministrados_cuenta($idcredito,$fecha_corte)
{
    global $con;

?>

<?php

//consultamos las solicitudes agendadas
$sql="SET datestyle TO postgres, dmy; SELECT 
ca.fecha as fecha,
ca.monto as monto,
'CAJA'::varchar as forma_pago,
ca.ref_recibo as referencia,
 (( ca.monto *  ( POWER(  (1+(( ((select interes_normal from cc_creditos where idcredito=cam.idcredito )/360 ) * 30 ) / 100) ) ,(select meses from cc_creditos where idcredito=cam.idcredito))-1  )) / ((select meses from cc_creditos where idcredito=cam.idcredito)*30 )) * ('$fecha_corte'::date-ca.fecha )   as interes_normal 
FROM cc_cajas_ministracion as cam,cajas as ca
 where  cam.idcredito='$idcredito'  and cam.idmov=ca.idmov and ca.fecha<= '$fecha_corte'
UNION ALL
SELECT 
ch.fecha as fecha,
ch.monto as monto,
'CHEQUE'::varchar as forma_pago,
ch.ref_cheque as referencia,
 (( ch.monto *  ( POWER(  (1+(( ((select interes_normal from cc_creditos where idcredito=chm.idcredito )/360 ) * 30 ) / 100) ) ,(select meses from cc_creditos where idcredito=chm.idcredito))-1  )) / ((select meses from cc_creditos where idcredito=chm.idcredito)*30 )) * ('2012-10-05'::date-ch.fecha )   as interes_normal 
FROM cc_cheques_ministracion as chm,cheques as ch
 where  chm.idcredito='16993'  and chm.idmov=ch.idmov and ch.fecha<= '2012-10-26'
order by fecha
";

	$consulta=pg_query($con,$sql);
	$cont=0;
	while($fila=pg_fetch_array($consulta))
	{
		
	if($cont==0)
	{
		//echo '<div align="left"><strong>MINISTRACION(S):</strong><div>';		
	?>

    <tr>
    <td  width="10%" align="center">FECHA</td>
    <td  width="10%" align="right">MONTO</td>
    <td  width="10%" align="center">CHEQUE/CAJA</td>
    <td width="10%" align="center">REFERENCIA</td>
    <td  width="10%" align="right">INTERES NORMAL</td>
    <td width="50%"></td>

  </tr>
    <?php
	}
	?>
	    
        
        <tr>
        <?php

				
				?>

<td align="center"><?php echo $fila["fecha"];?></td>
<td align="right"><?php echo number_format($fila["monto"],2);?></td>
<td align="center"><?php echo $fila["forma_pago"];?></td>
<td align="center"><?php echo $fila["referencia"];?></td>
<td align="right"><?php echo number_format($fila["interes_normal"],2);?></td>


				
                <?php
						
                                 
							
	
						
						
		echo "</tr>";			
                                 
	$cont++;
	
	}

?>

<?php
}

function get_clientes_reporte()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM cc_clientes order by nombre ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idcliente' id='idcliente'    class='modif'>";
	echo "<option value='' >Seleccione Productor</option>";
	while($fila=pg_fetch_array($consulta))
	{
		
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						
						print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_grupo_reporte()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SET datestyle TO postgres, dmy; SELECT * FROM cc_grupos  order by grupo ");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='idgrupo' id='idgrupo'    class='modif'>";
	echo "<option value='' >Seleccione Grupo</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["idgrupo"];
							
						
						print("<option value=\"$b\">".nom($fila["grupo"])."</option>");
                                 
	
	
	}
	
	
	echo "</select>";
}

function get_session_sucursal()
{
	global $con;
	$mov_sucursal=$_SESSION["mov_sucursal"];
	$consulta=pg_query($con,"SELECT * FROM cc_sucursales where id='$mov_sucursal'");
	if($fila=pg_fetch_array($consulta))
	{
		return $fila;
	}
	else
	{
		return 0;
	}
}

function get_secadora($id_secadora)
{

    global $con;
	$consulta=pg_query($con,"SELECT * FROM se_secadora order by id_secadora ");
	echo "<select name='id_secadora' id='id_secadora'    class='iselect'>";
	echo "<option value='' >Seleccione secadora</option>";
	while($fila=pg_fetch_array($consulta))
	{
						$b=$fila["id_secadora"];
						if($b==$id_secadora)
						print("<option value=\"$b\" selected='selected'>".nom($fila["nom_secadora"])."</option>");
						else
						print("<option value=\"$b\">".nom($fila["nom_secadora"])."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_pesadas_servicios($id_servicio)
{
global $con;

	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_pesadas where id_servicio='$id_servicio' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 while($fila= pg_fetch_array($id_query))
		   {
	 
	 ?>
	 
      <tr>
  <td>
<div align="center">
<input type="text" name="bolsa[]" size="15" maxlength="50"  id="bolsa" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" onchange="calcula_kgs_netos_se()" onkeyup="calcula_kgs_netos_se()" value="<?php echo number_format($fila["bolsa"],2) ?>">
 </div>
 </td>
<td>
<div align="center">
<input type="text" name="kgs_brutos[]" size="15" maxlength="50"  id="kgs_brutos" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque"  onchange="calcula_kgs_netos_se()" onkeyup="calcula_kgs_netos_se()" value="<?php echo number_format($fila["kgs_brutos"],2) ?>">
</div>
</td>
<td><div align="center">
      <input name="tara[]" type="text"   id="tara" onkeypress="return acceptNum(event)" size="15" maxlength="50"  class="peque"  autocomplete="off"  onchange="calcula_kgs_netos_se_tara()" onkeyup="calcula_kgs_netos_se_tara()" value="<?php echo number_format($fila["tara"],2) ?>">
    </div></td>
 <td>
<div align="center">
<input type="text" name="kgs_netos[]" size="15" maxlength="50"   id="kgs_netos" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque"  readonly="readonly" value="<?php echo number_format($fila["kgs_netos"],2) ?>">
</div>
</td>
<td><div align="center">
      <input name="cajas[]" type="text"   id="cajas" onkeypress="return acceptNum(event)" size="15" maxlength="50" readonly="readonly" autocomplete="off"  class="peque" value="<?php echo number_format($fila["cajas"],2) ?>">
    </div></td>          

<td align="center">
      <input type="button" onclick="remove_tse(this)" value='Eliminar'>
</td>  
    
  </tr>
     
     
		<?php		
			}	
}


function retorna_valornum($valor)
{
	 if(empty($valor) or $valor=="" or trim($valor)=="")
	 return "NULL";
	 else
	 return $valor;

}

function get_rela_nota($id_servicio)
{
	global $con;
	$consulta=pg_query($con,"SELECT * FROM co_compras where estatus=true and id_servicio='$id_servicio'");
	if($fila=pg_fetch_array($consulta))
	{
		return $fila;
	}
	else
	{
		return 0;
	}
}

function get_secado($id_servicio,$idcliente,$idsucursal,$idcosecha)
{
	 global $con;
	$sql="select case when count(*)>0 then 'disabled' else '' end::varchar(10) as permiso from  re_cobros_realizados where id_secado='$id_servicio' and estatus=true";
   $ser_activo=pg_query($con,$sql);
   $fila_ser=pg_fetch_array($ser_activo);	
	$consulta=pg_query($con,"SELECT * FROM se_servicios where idcliente='$idcliente' and id_sucursal='$idsucursal' and id_periodo='$idcosecha' order by folio_servicio ");
	echo "<select name='id_servicio' id='id_servicio' ".$fila_ser['permiso']." class='modif'>";
	echo "<option value='' >Seleccione Servicio</option>";
	while($fila=pg_fetch_array($consulta))
	{
						$b=$fila["id_servicio"];
						$desc="Folio---".$fila["folio_servicio"]."Fecha---".$fila["fecha_servicio"];
						if($b==$id_servicio)
						print("<option value=\"$b\" selected='selected'>".nom($desc)."</option>");
						else
						print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select>";
}


function get_secado_tmp($id_servicio,$idcliente,$idsucursal,$idcosecha)
{
	 global $con;
	$consulta=pg_query($con,"SELECT * FROM se_servicios where idcliente='$idcliente' and id_sucursal='$idsucursal' and id_periodo='$idcosecha' order by folio_servicio ");
	echo "<select name='id_servicio' id='id_servicio' disabled class='modif'>";
	echo "<option value='' >Seleccione Servicio</option>";
	while($fila=pg_fetch_array($consulta))
	{
						$b=$fila["id_servicio"];
						$desc="Folio---".$fila["folio_servicio"]."Fecha---".$fila["fecha_servicio"];
						if($b==$id_servicio)
						print("<option value=\"$b\" selected='selected'>".nom($desc)."</option>");
						else
						print("<option value=\"$b\">".nom($desc)."</option>");
                                 
	
	
	}
	echo "</select>";
}



function get_interes_normal($dias_trans,$fecha_ministracion,$monto,$interes_normal)
{
	$monto_i=$monto;
	$fecha_vencimiento=DiasFecha($fecha_ministracion,$dias_trans,"sumar");//fecha de inicio de operacion
	$imes=($interes_normal/12)/30;
	$interes=$imes/100;
	$corrida=0;
	$periodos=meses($fecha_ministracion,$fecha_vencimiento);

	do
	{

		if($corrida==0)//Condicionamos la primera corrida del credito
		{
		$ultimo_dia=get_dia_ultimo($fecha_ministracion); //ultimo dia del primer mes
		$fecha_inicio=$fecha_ministracion;               //fecha de inicio de operacion
		$fecha_fin=get_fecha_fin($fecha_inicio,$ultimo_dia); //fecha fun del primer periodo
		$dias_periodo=n_dias($fecha_inicio,$fecha_fin)+1;
		$sum_interes_normal=redondeado(($monto*$interes),2)*$dias_periodo;
		
		}

			if($corrida==1)//Proceso de tabla de amortizacion
			{
				$monto=$monto+$sum_interes_normal;
				$fecha_inicio=DiasFecha($fecha_fin,1,"sumar");//fecha de inicio de operacion
				$ultimo_dia=get_dia_ultimo($fecha_inicio); //ultimo dia del primer mes
				$fecha_fin=get_fecha_fin($fecha_inicio,$ultimo_dia); //fecha fun del primer periodo
			
				$corte=check_in_range($fecha_inicio,$fecha_fin,$fecha_vencimiento);
				if($corte==1)//averigua donde se va detener
				{
				$bandera=1;
				$fecha_fin=$fecha_vencimiento;
				}
			
			
			
				$dias_periodo=n_dias($fecha_inicio,$fecha_fin)+1;
				$sum_interes_normal=redondeado(($monto*$interes),2)*$dias_periodo;
				
			}

			$sum_total_interes=redondeado($sum_total_interes+$sum_interes_normal,2);
			
			$corrida=1;
			$suma_dias=$suma_dias+$dias_periodo;
		
		}while($suma_dias<=$dias_trans);
		
		$capital_interes=$monto_i+$sum_total_interes;
		return $sum_total_interes;
}





function redondeado($numero, $decimales) 
{ 
   $factor = pow(10, $decimales); 
   return (round($numero*$factor)/$factor); 
} 


function get_cosecha($id_periodo)
{
    global $con;
	$consulta=pg_query($con,"SELECT * FROM co_pcosecha  order by periodo ");
	echo "<select name='id_periodo' id='id_periodo'    class='modif'>";
	echo "<option value='' >Seleccione Cosecha</option>";
	while($fila=pg_fetch_array($consulta))
	{
		
							$b=$fila["id_periodo"];
							
						if($b==$id_periodo)
						print("<option value=\"$b\" selected='selected'>".nom($fila["periodo"])."</option>");
						else
						print("<option value=\"$b\">".nom($fila["periodo"])."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_producto_r()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_cat_articulos where tipo='C' order by descripcion");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises  onChange='cc_get_precio_producto(this.value)'
	echo "<select name='id_catalogo' id='id_catalogo'   class='iselect'  >";
	echo "<option value='' >Seleccione Producto</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_catalogo"];
							
						print("<option value=\"$b\">".$fila["descripcion"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_tonga_nt()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_tonga order by id_tonga");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_tonga' id='id_tonga'   class='iselect' onchange='clear_report()'>";
	echo "<option value='0' >Todas las tongas</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_tonga"];
							
						print("<option value=\"$b\">".$fila["nom_tonga"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function get_tonga_r()
{
//	include 'conexion.php';
    global $con;
	$consulta=pg_query($con,"SELECT * FROM al_tonga order by id_tonga");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='id_tonga' id='id_tonga'   class='iselect'>";
	echo "<option value='' >Selecciona Tonga</option>";
	while($fila=pg_fetch_array($consulta))
	{
		//echo "<option value='".$registro["idestado"]."'>".$registro["estado"]."</option>";
	
//	global $iduni;
							$b=$fila["id_tonga"];
							
						print("<option value=\"$b\">".$fila["nom_tonga"]."</option>");
                                 
	
	
	}
	echo "</select>";
}

function filtra_tonga($id_compra,$id_tonga)
{
	 global $con;
	 //verificar si hay merma
		$sql_merma="select count(*)::integer as nreg from co_compras_merma where id_compra='$id_compra'";
	  $consulta_m=pg_query($con,$sql_merma);	
	  $fila_m=pg_fetch_array($consulta_m);
	  if($fila_m["nreg"]>0) {
	  		 $sql_pes="SELECT * FROM co_pesadas_merma where id_compra='$id_compra' and id_tonga='$id_tonga'";
	  }else {
	 		 $sql_pes="SELECT * FROM co_pesadas where id_compra='$id_compra' and id_tonga='$id_tonga'";
		}			
				$consulta=pg_query($con,$sql_pes);
				if($fila=pg_fetch_array($consulta))
				{
				return 1;	
				}
				else
				{
					return 0;
				}
}

function get_cosecha_r($id_periodo)
{
	 global $con;
	 $sql_pes="SELECT * FROM co_pcosecha where id_periodo='$id_periodo' ";
				$consulta=pg_query($con,$sql_pes);
				while($fila=pg_fetch_array($consulta))
				{
				return $fila["periodo"];	
				}
				
}

function get_total_brutos($id_compra,$id_tonga)
{
	 global $con;
	 //verificar si hay merma
		$sql_merma="select count(*)::integer as nreg from co_compras_merma where id_compra='$id_compra'";
	  $consulta_m=pg_query($con,$sql_merma);	
	  $fila_m=pg_fetch_array($consulta_m);
	  if($fila_m["nreg"]>0) {
	  		 $sql_pes="SELECT * FROM co_pesadas_merma where id_compra='$id_compra' and id_tonga='$id_tonga'";
	  }else {
	 		 $sql_pes="SELECT * FROM co_pesadas where id_compra='$id_compra' and id_tonga='$id_tonga'";
		}				
	
	
				$consulta=pg_query($con,$sql_pes);
				$total_brutos=0;
				while($fila=pg_fetch_array($consulta))
				{
				$total_brutos=$total_brutos+$fila["kgs_brutos"];
				}
				return $total_brutos;
			
}

function get_total_kg_brutos($id_compra)
{
	 global $con;
		//verificar si hay merma
		$sql_merma="select count(*)::integer as nreg from co_compras_merma where id_compra='$id_compra'";
	  $consulta_m=pg_query($con,$sql_merma);	
	  $fila_m=pg_fetch_array($consulta_m);
	  if($fila_m["nreg"]>0) {
	  		$sql_pes="SELECT * FROM co_pesadas_merma where id_compra='$id_compra'";
	  }else {
	 		$sql_pes="SELECT * FROM co_pesadas where id_compra='$id_compra'";
		}				
				$consulta=pg_query($con,$sql_pes);
				$total_brutos=0;
				while($fila=pg_fetch_array($consulta))
				{
				$total_brutos=$total_brutos+$fila["kgs_brutos"];
				}
				return $total_brutos;
			
}

function comprobar_credito_cheque($idcredito)  /*COMPROBAMOS EL STATUS PARA PODER HACER UNA CACELACION DE CREDITO*/
{
		 global $con;
	 $sql_pes="SELECT ch.idmov FROM cc_cheques_ministracion as cm , cheques as ch where cm.idcredito='$idcredito' and cm.idmov=ch.idmov and ch.ch_cancelado=false and ch.en_transito=true ";
				$consulta=pg_query($con,$sql_pes);
				if($fila=pg_fetch_array($consulta))
				{
				$estado=1; //QUIERE DECIR QUE EL CHEQUE ESTA EN TRANSITO
				}
				else
				{
				$estado=2; //QUIERE DECIR QUE EL CHEQUE ESTA CANCELADO
				}
				return $estado;
				
}

?>
