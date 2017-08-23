<?php
$cekPin=$db->fetch("select * from user where password='".$_POST['pn']."'");
if(count($cekPin)>=1){
  if(
    $_POST['id']==''
  ){
    echo "<script type=text/javascript>alert('Data Tidak Lengkap');</script>";
    echo "<script type=text/javascript>window.history.back();</script>";
  }else{
    $cek=$db->fetch("select * from barang where idkategori='".$_POST['id']."' limit 0,1");
    if(count($cek)==0){
      $cekTA=$db->fetch("select * from kategori where idkategori='".$_POST['id']."'");
      $sql=$db->submit("delete from kategori where idkategori=:f4",
      Array(
        'f4'=>$_POST['id']
        )
      );
      if(count($cekTA)>=1){
        $sql2=$db->submit("delete from typeahead where konten='".$cekTA[0]['nama']."' and kategori='kategori'");
      }
      echo "<script type=text/javascript>alert('Data dihapus');</script>";
      echo "<script type=text/javascript>window.location='?a=view-kategori-barang'</script>";
    }
  }
}else{

  echo "<script type=text/javascript>alert('Pin tidak cocok');</script>";
  echo "<script type=text/javascript>window.history.back();</script>";
}
?>
