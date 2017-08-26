<?php
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=RekapStok(Per-".date('Y-m-d').").csv");
header("Pragma: no-cache");
header("Expires: 0");
 ?>"Laporan Rekapitulasi Stok",
"Diunduh Tanggal","<?=date('Y-m-d h:i:s')?>",
"BCD","Nama Barang","Kategori","Deskripsi","Stok",
<?php
$stok=$db->fetch("select * from barang inner join kategori using(idkategori) order by nama desc");
foreach($stok as $item){
  $masuk=$db->fetch("select sum(qty) as jml from transaksi where jenis='masuk' and idbarang='".$item['idbarang']."'");
  $masuk=$masuk[0]['jml'];
  $keluar=$db->fetch("select sum(qty) as jml from transaksi where jenis='keluar' and idbarang='".$item['idbarang']."'");
  $keluar=$keluar[0]['jml'];
  echo "\"$item[barcode]\",\"$item[namaBarang]\",\"$item[nama]\",\"".substr($item['deskripsi'],0,50)."\",\"".($masuk-$keluar)."\",";
}
