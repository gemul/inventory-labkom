<?php
require_once('lib/PHPExcel/Classes/PHPExcel.php');
//create PHPExcel object
$excel = new PHPExcel();

//selecting active sheet
$excel->setActiveSheetIndex(0);

<<<<<<< HEAD
$filterText="";
if(!empty($_GET['s'])){
  $filterText.="Mengurutkan '".explode('-',$_GET['s'])[0]."' ";
  $sort=substr(explode('-',$_GET['s'])[0],0,20)." ".substr(explode('-',$_GET['s'])[1],0,4);
}else{
  $sort="waktu desc";
}
if(!empty($_GET['j']) || !empty($_GET['f'])){
  $where="where ";
}else{
  $where="";
}
if(!empty($_GET['j'])){
  $where.="jenis='".$_GET['j']."' ";
  $filterText.="Dari transaksi ".$_GET['j']." ";
}else{
  $where.="";
}
if(!empty($_GET['j']) && !empty($_GET['f'])){
  $where.=" and ";
}else{
  $where.="";
}
if(!empty($_GET['f'])){
  $filterText.="Berdasarkan kata kunci '".$_GET['f']."' ";
  $where.=" (namaBarang like '%".$_GET['f']."%' or waktu like '%".$_GET['f']."%' or catatan like '%".$_GET['f']."%') ";
}else{
  $where.=" ";
}
if(!empty($_GET['p'])){
  $pg=$_GET['p'];
  $filterText.="Halaman $pg";
}else{
  $pg=1;
}
if($filterText!=''){
  $filterText="".$filterText."";
}

//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(70);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(7);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(60);

$hrow=5;
$excel->getActiveSheet()
  ->setCellValue('A'.$hrow , "Waktu")
  ->setCellValue('B'.$hrow , "Transaksi")
  ->setCellValue('C'.$hrow , "Barang")
  ->setCellValue('D'.$hrow , "Jumlah")
  ->setCellValue('E'.$hrow , "Catatan");
$stokMasuk=$db->fetch("select * from transaksi inner join barang using(idbarang) $where order by $sort limit ".(($pg-1)*40).",40");
$row=6;
foreach($stokMasuk as $item){
  $excel->getActiveSheet()
    ->setCellValue('A'.$row , $item['waktu'])
    ->setCellValue('B'.$row , $item['jenis'])
    ->setCellValue('C'.$row , $item['namaBarang'])
    ->setCellValue('D'.$row , $item['qty'])
    ->setCellValue('E'.$row , $item['catatan']);
=======
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
>>>>>>> dev-laptop
  //increment the row
  $row++;
}


//title
$excel->getActiveSheet()->setCellValue('A1',"Rekapitulasi Transaksi Stok");
$excel->getActiveSheet()->mergeCells('A1:E1');
$excel->getActiveSheet()->setCellValue('A2',"Labkom SMK Yadika Bangil");
$excel->getActiveSheet()->mergeCells('A2:E2');
<<<<<<< HEAD
$excel->getActiveSheet()->setCellValue('A3',"Ketentuan : ".$filterText);
$excel->getActiveSheet()->mergeCells('A3:E3');
$excel->getActiveSheet()->setCellValue('A4',"Diterbitkan : ".date('Y-m-d h:i:s'));
$excel->getActiveSheet()->mergeCells('A4:E4');
=======
$excel->getActiveSheet()->setCellValue('A3',"Diterbitkan : ".date('Y-m-d h:i:s'));
$excel->getActiveSheet()->mergeCells('A3:E3');
>>>>>>> dev-laptop

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
<<<<<<< HEAD
$excel->getActiveSheet()->getStyle('A5:E5')->applyFromArray(
=======
$excel->getActiveSheet()->getStyle('A4:E4')->applyFromArray(
>>>>>>> dev-laptop
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
<<<<<<< HEAD
$excel->getActiveSheet()->getStyle('A6:E'.($row-1))->applyFromArray(
=======
$excel->getActiveSheet()->getStyle('A5:E'.($row-1))->applyFromArray(
>>>>>>> dev-laptop
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
