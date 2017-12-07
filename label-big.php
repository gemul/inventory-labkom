<?php

$codes=Array(rand(1,10),'100030000001','123456123456','123456123456','123456123456','123456123456','123456123456');

require_once("lib/phpbarcode/samplephp/fpdf.php");
$pdf=new FPDF('P','mm',Array(215,330));
$pdf->AddPage();
$pdf->SetFont('Courier','',8);
$row=0;
$col=0;
$boxw=50;
$boxh=25;
foreach($codes as $code){
	$x=7+($col*$boxw);
	$y=7+($row*$boxh);
	$pdf->Image('http://localhost/order/inventory/gen/barcode.php?c='.str_pad($code,12,'0',STR_PAD_LEFT),$x,$y,50,0,'PNG');
	$pdf->Rect($x,$y,$boxw,$boxh);
	$pdf->SetXY($x,$y+12);
	$pdf->Cell($boxw,4,'Jenis :'.'RAM DDR3 2GB',0,0);
	$pdf->SetXY($x,$y+16);
	$pdf->Cell($boxw,4,'UName :'.'',0,0);
	$pdf->SetXY($x,$y+20);
	$pdf->Cell($boxw,4,'Sumber:'.'BOS 2017',0,0);
	if($col<3){
		$col++;
	}else{
		$col=0;
		$row++;
	}
}
$pdf->Output();
?>
