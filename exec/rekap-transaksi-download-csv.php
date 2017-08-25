<?php
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");
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
 ?>"Laporan Rekapitulasi Stok",
"Diunduh Tanggal","<?=date('Y-m-d h:i:s')?>",
"Ketentuan","<?=$filterText?>",
"Waktu","Keluar/Masuk","Barang","Jumlah","Catatan",
<?php
$stokMasuk=$db->fetch("select * from transaksi inner join barang using(idbarang) $where order by $sort limit ".(($pg-1)*40).",40");
foreach($stokMasuk as $item){
  echo "\"$item[waktu]\",";
       if($item['jenis']=='masuk'){
         echo "\"".$item['jenis']."\",";
       }else{
         echo "\"".$item['jenis']."\",";
       }
       echo "\"$item[namaBarang]\",\"$item[qty]\",\"".substr($item['catatan'],0,50)."\",\n";
}
