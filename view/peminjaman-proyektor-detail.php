<?php
$data=$db->fetch("select * from peminjamanproyektor where idpeminjamanproyektor=:idp",Array(':idp'=>$_GET['id']));
$item=$data[0];
 ?>
    <table>
        <tr>
            <td>Nama Peminjam</td>
            <td>: <b><?=$item['namaPeminjam']?></b></td>
        </tr>
        <tr>
            <td>Penanggung Jawab</td>
            <td>: <b><?=$item['penanggungJawab']?></b></td>
        </tr>
        <tr>
            <td>Instansi</td>
            <td>: <b><?=$item['instansi']?></b></td>
        </tr>
        <tr>
            <td>Waktu Pinjam</td>
            <td>: <b><?=$item['waktuPinjam']?></b></td>
        </tr>
        <tr>
            <td>Waktu Kembali</td>
            <td>: <b><?php if($item['waktuKembali']!=""){echo $item['waktuKembali'];}else{echo "Belum kembali";}?></b></td>
        </tr>
    </table>
