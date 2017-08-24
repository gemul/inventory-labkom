  <select name='idbarang' class="form-control">
    <?php
    $sql=$db->fetch("select * from barang where idkategori=:id order by namaBarang asc",array('id'=>$_GET['id']));
    foreach($sql as $data){
      echo "<option value=".$data['idbarang'].">".$data['namaBarang']."</option>";
    }
     ?>
  </select>
