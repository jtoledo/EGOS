<?php
include("class/pDraw.class.php");
include("class/pImage.class.php");
include("class/pPie.class.php");
include("class/pData.class.php");

$conexion=mysql_connect("localhost","root","");
mysql_select_db("almacenm");
$consulta="select avg(sueldo) from personal group by sexo";
$r=mysql_query($consulta);

$registro=mysql_fetch_row($r);
$dato1=$registro[0];

$registro=mysql_fetch_row($r);
$dato2=$registro[0];
echo("<table border=1>");
echo("<tr>");
echo("<td>sexo</td>");
echo("<td>promedio</td>");
echo("</tr>");
echo("<tr>");
echo("<td>Mujeres</td>");
echo("<td>$dato1</td>");
echo("</tr>");
echo("<tr>");
echo("<td>Hombres</td>");
echo("<td>$dato2</td>");
echo("</tr>");

echo("</table>");
$tabla=new pData();

$tabla->addPoints(array($dato1,$dato2),"serie");
$tabla->setSerieDescription("serie","Sexo");

$tabla->addPoints(array("Mujeres","Hombres"),"etiquetas");
$tabla->setAbscissa("etiquetas");

$imagen=new pImage(600,400,$tabla, TRUE);

$pastel=new pPie($imagen,$tabla);

$pastel->draw3DPie(250,140,array("Radius"=>100,"DrawLabels"=>TRUE,"LabelStacked"=>TRUE,"Border"=>TRUE));

$imagen->Render("graficapastel.png");


echo ("<img src=\"graficapastel.png\">");
mysql_close();
?>


