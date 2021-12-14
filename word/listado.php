<?php
require('fpdf.php');
$conexion=mysql_connect("localhost","root","");
mysql_select_db("almacenm");
$consulta="select clave, nombre, direccion, fecha from personal";
$r=mysql_query($consulta);
$i=mysql_num_rows($r);
if ($i>0){
	$pdf=new FPDF();
	$pdf->AddPage('P','Letter');
	$pdf->SetFont('Times','B',16);
	$pdf->Cell(0,18,'LISTADO DE PERSONAL',0,1,'C');

	$pdf->Ln();
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(15,12,'Clave',1,0,'C');
	$pdf->Cell(60,12,'Nombre',1,0,'C');
	$pdf->Cell(75,12,'Direccion',1,0,'C');
	$pdf->Cell(25,12,'Fecha',1,1,'C');

	$k=1;
	while($registro=mysql_fetch_row($r)){
	
		$pdf->Cell(15,12,$registro[0],1,0,'C');
		$pdf->Cell(60,12,$registro[1],1,0,'C');
		$pdf->Cell(75,12,$registro[2],1,0,'C');
		$pdf->Cell(25,12,$registro[3],1,1,'C');
		if ($k==16){
			$pdf->AddPage('P','Letter');
			$pdf->SetFont('Times','B',16);
			$pdf->Cell(0,18,'LISTADO DE PERSONAL',0,1,'C');

			$pdf->Ln();
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(15,12,'Clave',1,0,'C');
			$pdf->Cell(60,12,'Nombre',1,0,'C');
			$pdf->Cell(75,12,'Direccion',1,0,'C');
			$pdf->Cell(25,12,'Fecha',1,1,'C');
			$k=0;

		}
		$k=$k+1;

	}

	$pdf->Output();

}
mysql_close();

?>