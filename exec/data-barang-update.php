<?php
$cekPin=$db->fetch("select * from user where password='".$_POST['pn']."'");
if(count($cekPin)>=1){
  if(
    $_GET['id']=='' ||
    $_POST['namaBarang']==''
  ){
    echo "<script type=text/javascript>alert('Data Tidak Lengkap');</script>";
    echo "<script type=text/javascript>window.history.back();</script>";
  }else{
    $sql=$db->submit("update barang set namaBarang=:f1, idkategori=:f2, deskripsi=:f3, barcode=:f5 where idbarang=:f4",
      Array(
      'f1'=>$_POST['namaBarang'],
      'f2'=>$_POST['idkategori'],
      'f3'=>$_POST['deskripsi'],
      'f4'=>$_GET['id']
      'f5'=>$_POST['barcode'],
      )
    );
    $cekTA=$db->fetch("select * from typeahead where konten='".$_POST['namaBarang']."' and kategori='barang'");
    if(count($cekTA)==0){
      $sql2=$db->submit("insert into typeahead (kategori,konten) values ('barang','".$_POST['namaBarang']."')");
    }
    echo "<script type=text/javascript>alert('Data tersimpan');</script>";
    echo "<script type=text/javascript>window.location='?a=view-data-barang'</script>";
  }
}else{

  echo "<script type=text/javascript>alert('Pin tidak cocok');</script>";
  echo "<script type=text/javascript>window.history.back();</script>";
}
?>
