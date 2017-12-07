<?php
$cekPin=$db->fetch("select * from user where password='".$_POST['pn']."'");
if(count($cekPin)>=1){
  if(
    $_POST['waktuPinjam']=='' ||
    $_POST['namaBarang']=='' ||
    $_POST['jumlah']=='' ||
    $_POST['namaPeminjam']=='' ||
    $_POST['penanggungJawab']=='' ||
    $_POST['instansi']==''
  ){
    echo "<script type=text/javascript>alert('Data Tidak Lengkap');</script>";
    echo "<script type=text/javascript>window.history.back();</script>";
  }else{
    $sql=$db->submit("insert into peminjamanbarang (iduser,namaBarang,jumlah,namaPeminjam,penanggungJawab,instansi,waktuPinjam) values (:f1,:f2,:f3,:f4,:f5,:f6,:f7)",
      Array(
      'f1'=>$cekPin[0]['iduser'],
      'f2'=>$_POST['namaBarang'],
      'f3'=>$_POST['jumlah'],
      'f4'=>$_POST['namaPeminjam'],
      'f5'=>$_POST['penanggungJawab'],
      'f6'=>$_POST['instansi'],
      'f7'=>$_POST['waktuPinjam']
      )
    );
    $cekTA=$db->fetch("select * from typeahead where konten='".$_POST['namaBarang']."' and kategori='barang'");
    if(count($cekTA)==0){
      $sql2=$db->submit("insert into typeahead (kategori,konten) values ('barang','".$_POST['namaBarang']."')");
    }
    echo "<script type=text/javascript>alert('Data peminjaman tersimpan');</script>";
    echo "<script type=text/javascript>window.location='?a=view-peminjaman-barang'</script>";
  }
}else{

  echo "<script type=text/javascript>alert('Pin tidak cocok');</script>";
  echo "<script type=text/javascript>window.history.back();</script>";
}
?>
