<?php
$cekPin=$db->fetch("select * from user where password='".$_POST['pn']."'");
if(count($cekPin)>=1){
  if(
    $_POST['idDosen']=='' ||
    $_POST['waktu']=='' ||
    $_POST['lab']=='' ||
    $_POST['keperluan']==''
  ){
    echo "<script type=text/javascript>alert('Data Tidak Lengkap');</script>";
    echo "<script type=text/javascript>window.history.back();</script>";
  }else{
    $sql=$db->submit("insert into jurnal_entri (iduser,waktu,lab,idDosen,keperluan) values (:f1,:f2,:f4,:f5,:f6)",
      Array(
      'f1'=>$cekPin[0]['iduser'],
      'f2'=>$_POST['waktu'],
      'f4'=>$_POST['lab'],
      'f5'=>$_POST['idDosen'],
      'f6'=>$_POST['keperluan']
      )
    );
    echo "<script type=text/javascript>alert('Data jurnal tersimpan');</script>";
    echo "<script type=text/javascript>window.location='?a=view-jurnal-lab'</script>";
  }
}else{

  echo "<script type=text/javascript>alert('Pin tidak cocok');</script>";
  echo "<script type=text/javascript>window.history.back();</script>";
}
?>
