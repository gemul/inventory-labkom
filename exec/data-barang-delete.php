<?php
$cekPin=$db->fetch("select * from user where password='".$_POST['pn']."'");
if(count($cekPin)>=1){
  if(
    $_POST['id']==''
  ){
    echo "<script type=text/javascript>alert('Data Tidak Lengkap');</script>";
    echo "<script type=text/javascript>window.history.back();</script>";
  }else{
    $cek=$db->fetch("select * from transaksi where idbarang='".$_POST['id']."' limit 0,1");
    if(count($cek)==0){
      $cekTA=$db->fetch("select * from barang where idbarang='".$_POST['id']."'");
      $sql=$db->submit("delete from barang where idbarang=:f4",
      Array(
        'f4'=>$_POST['id']
        )
      );
      if(count($cekTA)>=1){
        $sql2=$db->submit("delete from typeahead where konten='".$cekTA[0]['namaBarang']."' and kategori='barang'");
      }
      echo "<script type=text/javascript>alert('Data dihapus');</script>";
      echo "<script type=text/javascript>window.location='?a=view-data-barang'</script>";
    }else{
      echo "<script type=text/javascript>alert('Tidak bisa dihapus. Barang sudah ditransaksikan');</script>";
      echo "<script type=text/javascript>window.history.back();</script>";
    }
  }
}else{

  echo "<script type=text/javascript>alert('Pin tidak cocok');</script>";
  echo "<script type=text/javascript>window.history.back();</script>";
}
?>
