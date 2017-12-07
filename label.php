<?php

$codes=Array(rand(1,10),'100030000001','123456123456','123456123456','123456123456','123456123456','123456123456');

require_once("lib/phpbarcode/samplephp/fpdf.php");
$pdf=new FPDF('P','mm',Array(215,330));
$pdf->AddPage();
$row=0;
$col=0;
foreach($codes as $code){
	$x=7+($col*50);
	$y=7+($row*12);
	$pdf->Image('http://localhost/order/inventory/gen/barcode.php?c='.str_pad($code,12,'0',STR_PAD_LEFT),$x,$y,50,0,'PNG');
	$pdf->Rect($x,$y,50,12);
	if($col<3){
		$col++;
	}else{
		$col=0;
		$row++;
	}
}
$pdf->Output();
?>
