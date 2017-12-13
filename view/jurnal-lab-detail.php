<?php
$data=$db->fetch("select * from jurnal_entri inner join jurnal_dosen using(idDosen) where jurnal_entri.idEntri=:idp",Array(':idp'=>$_GET['id']));
$item=$data[0];
 ?>
    <table>
        <tr>
            <td>Waktu</td>
            <td>: <b><?=$item['waktu']?></b></td>
        </tr>
        <tr>
            <td>Dosen</td>
            <td>: <b><?=$item['namaDosen']?></b></td>
        </tr>
        <tr>
            <td>LAB</td>
            <td>: <b><?=$item['lab']?></b></td>
        </tr>
        <tr>
            <td>Keperluan</td>
            <td>: <b><?=$item['keperluan']?></b></td>
        </tr>
    </table>
