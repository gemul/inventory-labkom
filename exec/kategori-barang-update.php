<?php
$cekPin=$db->fetch("select * from user where password='".$_POST['pn']."'");
if(count($cekPin)>=1){
  if(
    $_GET['id']=='' ||
    $_POST['nama']=='' ||
    $_POST['prioritas']==''
  ){
    echo "<script type=text/javascript>alert('Data Tidak Lengkap');</script>";
    echo "<script type=text/javascript>window.history.back();</script>";
  }else{
    $sql=$db->submit("update kategori set nama=:f1, idMasterKategori=:f2,prioritas=:f3 where idkategori=:f4",
      Array(
      'f1'=>$_POST['nama'],
      'f2'=>(int)$_POST['idMasterKategori'],
      'f3'=>$_POST['prioritas'],
      'f4'=>$_GET['id']
      )
    );
    $cekTA=$db->fetch("select * from typeahead where konten='".$_POST['nama']."' and kategori='kategori'");
    if(count($cekTA)==0){
      $sql2=$db->submit("insert into typeahead (kategori,konten) values ('kategori','".$_POST['nama']."')");
    }
    echo "<script type=text/javascript>alert('Data tersimpan');</script>";
    echo "<script type=text/javascript>window.location='?a=view-kategori-barang'</script>";
  }
}else{

  echo "<script type=text/javascript>alert('Pin tidak cocok');</script>";
  echo "<script type=text/javascript>window.history.back();</script>";
}
?>
