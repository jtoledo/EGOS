<?php
require('fpdf.php');

$c=$HTTP_POST_VARS['clave'];

$conexion=mysql_connect("localhost","root","");
mysql_select_db("almacenm");
$consulta="select nombre,direccion,fecha from personal where clave=$c";

$r=mysql_query($consulta);
$d=mysql_num_rows($r);
if ($d>=1){
	$registro=mysql_fetch_row($r);
	
	$pdf=new FPDF();
	$pdf->AddPage('L','Letter');
	$pdf->Image('artesanias4.jpg',1,1,60,50,'jpg');
	$pdf->SetFont('Times','B',16);
	$pdf->Cell(0,18,'                          HOJA DE IDENTIFICACION DE PERSONAL',0,1,'C');
	$pdf->Ln();
	$pdf->SetFont('Times','I',12);
	$pdf->SetTextColor(250,100,100);
	$linea="nombre: $registro[0]";
	$pdf->Cell(0,14,$linea,0,1);
	
	$pdf->Line(0,70,270,70);
	$pdf->Ln();	
	$linea="Dirección: $registro[1]";
	$pdf->Cell(0,14,$linea,0,1);
	

	$linea="Fecha de nacimiento: $registro[2]";
	$pdf->Cell(0,14,$linea,0,1);

	$linea="Clave de empleado: $c";
	$pdf->Cell(0,14,$linea,0,1);
	$pdf->Output();

}
else{
echo ("No existe el resgistro");


}

mysql_close();
?>