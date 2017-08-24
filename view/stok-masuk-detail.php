<?php
$data=$db->fetch("select * from transaksi inner join barang using(idbarang) inner join user using(iduser) where idtransaksi=:idp",Array(':idp'=>$_GET['id']));
$item=$data[0];
 ?>
    <table>
        <tr>
          <td>Transaksi</td>
          <td>: <b><?=$item['jenis']?></b></td>
        </tr>
        <tr>
          <td>Waktu</td>
          <td>: <b><?=$item['waktu']?></b></td>
        </tr>
        <tr>
            <td>Nama Barang</td>
            <td>: <b><?=$item['namaBarang']?></b></td>
        </tr>
        <tr>
            <td>Qty</td>
            <td>: <b><?=$item['qty']?></b></td>
        </tr>
        <tr>
            <td>Catatan</td>
            <td>: <b><?=$item['catatan']?></b></td>
        </tr>
        <tr>
            <td>Pencatat</td>
            <td>: <b><?=$item['nama']?></b></td>
        </tr>
    </table>
