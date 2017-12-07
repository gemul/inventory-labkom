<?php
$cekPin=$db->fetch("select * from user where password='".$_POST['pn']."'");
if(count($cekPin)>=1){
  if(
    $_POST['namaBarang']=='' ||
    $_POST['idkategori']==''
  ){
    echo "<script type=text/javascript>alert('Data Tidak Lengkap');</script>";
    echo "<script type=text/javascript>window.history.back();</script>";
  }else{
    $sql=$db->submit("insert into barang (namaBarang,idkategori,deskripsi,barcode) values (:f1,:f2,:f3,:f4)",
      Array(
      'f1'=>$_POST['namaBarang'],
      'f2'=>$_POST['idkategori'],
      'f3'=>$_POST['deskripsi']
      'f4'=>$_POST['barcode']
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
