<?php
require_once('lib/PHPExcel/Classes/PHPExcel.php');
//create PHPExcel object
$excel = new PHPExcel();

//selecting active sheet
$excel->setActiveSheetIndex(0);

//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(70);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(9);

$hrow=4;
$excel->getActiveSheet()
  ->setCellValue('A'.$hrow , "BCD")
  ->setCellValue('B'.$hrow , "Nama Barang")
  ->setCellValue('C'.$hrow , "Kategori")
  ->setCellValue('D'.$hrow , "Deskripsi")
  ->setCellValue('E'.$hrow , "Jumlah");
$row=5;
$stok=$db->fetch("select * from barang inner join kategori using(idkategori) order by nama desc");
foreach($stok as $item){
  $masuk=$db->fetch("select sum(qty) as jml from transaksi where jenis='masuk' and idbarang='".$item['idbarang']."'");
  $masuk=$masuk[0]['jml'];
  $keluar=$db->fetch("select sum(qty) as jml from transaksi where jenis='keluar' and idbarang='".$item['idbarang']."'");
  $keluar=$keluar[0]['jml'];
  $excel->getActiveSheet()
    ->setCellValue('A'.$row , $item['barcode'])
    ->setCellValue('B'.$row , $item['namaBarang'])
    ->setCellValue('C'.$row , $item['nama'])
    ->setCellValue('D'.$row , $item['deskripsi'])
    ->setCellValue('E'.$row , $masuk-$keluar);
  //increment the row
  $row++;
}


//title
$excel->getActiveSheet()->setCellValue('A1',"Rekapitulasi Transaksi Stok");
$excel->getActiveSheet()->mergeCells('A1:E1');
$excel->getActiveSheet()->setCellValue('A2',"Labkom SMK Yadika Bangil");
$excel->getActiveSheet()->mergeCells('A2:E2');
$excel->getActiveSheet()->setCellValue('A3',"Diterbitkan : ".date('Y-m-d h:i:s'));
$excel->getActiveSheet()->mergeCells('A3:E3');

//aligning
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal('center');

//styling
$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
	array(
		'font'=>array(
			'size' => 24,
		)
	)
);
$excel->getActiveSheet()->getStyle('A4:E4')->applyFromArray(
	array(
		'font' => array(
			'bold'=>true
		),
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);
//give borders to data
$excel->getActiveSheet()->getStyle('A5:E'.($row-1))->applyFromArray(
	array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			),
			'vertical' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);

//redirect to browser (download) instead of saving the result as a file
//this is for MS Office Excel xls format

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="test.xlsx"');
header('Cache-Control: max-age=0');

//write the result to a file
$file = PHPExcel_IOFactory::createWriter($excel,'Excel2007');
//output to php output instead of filename
$file->save('php://output');
