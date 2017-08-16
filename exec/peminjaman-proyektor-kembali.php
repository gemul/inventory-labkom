<?php
$cekPin=$db->fetch("select * from user where password='".$_POST['pn']."'");
if(count($cekPin)>=1){
  if(
    $_POST['id']==''
  ){
    echo "<script type=text/javascript>alert('Data Tidak Lengkap');</script>";
    echo "<script type=text/javascript>window.history.back();</script>";
  }else{
    $sql=$db->submit("update peminjamanproyektor set waktuKembali=NOW() , iduserkembali=:f1 where idpeminjamanproyektor=:f2",
      Array(
      'f1'=>$cekPin[0]['iduser'],
      'f2'=>$_POST['id']
      )
    );
    echo "<script type=text/javascript>alert('Pengembalian telah dicatat');</script>";
    echo "<script type=text/javascript>window.location='?a=view-peminjaman-proyektor'</script>";
  }
}else{

  echo "<script type=text/javascript>alert('Pin tidak cocok');</script>";
  echo "<script type=text/javascript>window.history.back();</script>";
}
?>
