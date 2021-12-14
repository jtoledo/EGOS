
<?php

$c=$HTTP_POST_VARS['s'];

$conexion=mysql_connect("localhost","root","");
mysql_select_db("almacenm");
$consulta="select nombre,direccion,fecha from personal where clave=$c";

$r=mysql_query($consulta);
if ($r){

	$registro=mysql_fetch_row($r);
}

?>

<html>
<head>
 <title> Cambios de personal</title> 

<script languaje="javascript">

function enviar(){
	var x=0;
	if (document.ficha.n.value=="") x=1;
	if (document.ficha.d.value=="") x=1;
	if (document.ficha.f.value=="") x=1;
	if (x==1){
		alert("datos incompletos");
		}
	else{
		document.ficha.submit();
	    }
}

function cambio(){
var an=document.ficha.anio.value;
var m=document.ficha.fecha.value;
var d=document.getElementById("dia");
var longitud=d.length
for (var i=0;i<longitud;i++){
	d.removeChild(d.lastChild);
	}

if(m=="02"){
	if ((an % 4 == 0 && an % 100 != 0) || an % 400 == 0){var bis=29;}
	else{	var bis=28;}
	
	for (cd=1;cd<=bis;cd++){
		var o=document.createElement("option");
		var t=document.createTextNode(cd);
		o.appendChild(t);
		o.value=cd;
		d.appendChild(o);
		}
}
else{
	if (m=="04" || m=="06" || m=="09" || m=="11"){
		for (cd=1;cd<=30;cd++){
			var o=document.createElement("option");
			var t=document.createTextNode(cd);
			o.appendChild(t);
			o.value=cd;
			d.appendChild(o);
			}

		}
	else{
		for (cd=1;cd<=31;cd++){
			var o=document.createElement("option");
			var t=document.createTextNode(cd);
			o.appendChild(t);
			o.value=cd;
			d.appendChild(o);
			}


	}
}

} 
  </script> 
</head>
<body> 

<pre>
<form name="ficha" action="actualizar2.php" method="post"> 
	
<input type="Hidden" name="c" value="<?php echo($c); ?>">  

nombre: <input type="text" name="n" value="<?php echo($registro[0]); ?>" size=40 maxlength=40> 

dirección: <input type="text" name="d" value="<?php echo($registro[1]); ?>" size=60 maxlength=60> 


fecha de nacimiento:<select name="anio" id="anio" size=1><script language="javascript">
				var a=document.getElementById('anio');
				for (ca=1960;ca<=2030;ca++){
					var o=document.createElement("option");
					var t=document.createTextNode(ca);
					o.appendChild(t);
					o.value=ca;
					a.appendChild(o);
				}
				</script>
				</select><select name="fecha" size=1 onBlur="cambio();"> 
				<option value="01">Enero</option>  
				<option value="02">Febrero</option>
				<option value="03">Marzo</option>  
				<option value="04">Abril</option>  
				<option value="05">Mayo</option>
				<option value="06">Junio</option>
				<option value="07">Julio</option>
				<option value="08">Agosto</option>
				<option value="09">Septiembre</option>
				<option value="10">Octubre</option>	
				<option value="11">Noviembre</option>	
				<option value="12">Diciembre</option>				
				</select><select name="dia" id="dia" size=1>
				</select>
<?php
$fe=strtotime($registro[2]);
$na=date("Y",$fe);
$nm=date("m",$fe);
$nd=date("d",$fe);
$indice=$na-1960;
$indice2=$nm-1;
$indice3=$nd-1;
echo ("<script languaje=\"javascript\">document.ficha.anio.selectedIndex=$indice</script>");
echo ("<script languaje=\"javascript\">document.ficha.fecha.selectedIndex=$indice2</script>");
echo ("<script languaje=\"javascript\">cambio()</script>");
echo ("<script languaje=\"javascript\">document.ficha.dia.selectedIndex=$indice3</script>");
?>

<input type="submit" value="Guardar" >
</form>	
</pre>
</body></html>