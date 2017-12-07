<?php
$cekPin=$db->fetch("select * from user where password='".$_POST['pn']."'");
if(count($cekPin)>=1){
  if(
    $_POST['waktu']=='' ||
    $_POST['idbarang']=='' ||
    $_POST['qty']=='' ||
    $_POST['catatan']==''
  ){
    echo "<script type=text/javascript>alert('Data Tidak Lengkap');</script>";
    echo "<script type=text/javascript>window.history.back();</script>";
  }else{
    $sql=$db->submit("insert into transaksi (idbarang,iduser,jenis,qty,waktu,catatan) values (:f1,:f2,:f3,:f4,:f5,:f6)",
      Array(
      'f1'=>$_POST['idbarang'],
      'f2'=>$cekPin[0]['iduser'],
      'f3'=>'masuk',
      'f4'=>$_POST['qty'],
      'f5'=>$_POST['waktu'],
      'f6'=>$_POST['catatan']
      )
    );
    echo "<script type=text/javascript>alert('Data tersimpan');</script>";
    echo "<script type=text/javascript>window.location='?a=view-stok-masuk'</script>";
  }
}else{

  echo "<script type=text/javascript>alert('Pin tidak cocok');</script>";
  echo "<script type=text/javascript>window.history.back();</script>";
}
?>
