<?php
require_once('_header.php');
 ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Barang</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading" id=ed-heading>
                            Tambah Barang
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <script type=text/javascript>
                            // function preSubmit(){
                            //   var pin=prompt("Masukkan pin");
                            //   if(pin && pin!=''){
                            //     $('#formPn').val(pin);
                            //     return true;
                            //   }else{
                            //     return false;
                            //   }
                            // }
                          </script>
                          <form role="form" action='?a=exec-data-barang-save' method='post' id=ed-form>
                              <div class="form-group">
                                  <label>Kategori</label>
                                  <select name='idkategori' class="form-control">
                                    <?php
                                    $sql=$db->fetch("select * from kategori order by nama asc");
                                    foreach($sql as $data){
                                      echo "<option value=".$data['idkategori'].">".$data['nama']."</option>";
                                    }
                                     ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>Nama</label>
                                  <input name='namaBarang' class="form-control" id='namaBarang' autofocus="autofocus">
                              </div>
                              <div class="form-group">
                                  <label>Deskripsi</label><br>
                                  <input name='deskripsi' id='deskripsi' class="form-control">
                              </div>
                              <div class="form-group">
                                  <label>PIN</label>
                                  <input name='pn' class="form-control" id='pn ' type='password'>
                              </div>
                              <div class="form-group">
                                  <button class='btn btn-primary'>Simpan</button>
                                  <button type=reset onclick='cancelEdit()' class='btn btn-default' style=display:none; id=ed-reset>Batal</button>
                              </div>
                            </form>
                        </div>

                        <script type="text/javascript">
                         $("#datetimepicker").datetimepicker({
                            format: 'yyyy-mm-dd hh:ii:ss',
                            autoclose: true,
                            todayBtn: true,
                            pickerPosition: "top"
                         });
                        </script>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Daftar Data Barang
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="height:400px;overflow-y:scroll;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th style=width:120px>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $belumKembali=$db->fetch("select * from barang inner join kategori using(idkategori) order by nama desc");
                                      foreach($belumKembali as $item){
                                        echo "
                                         <tr>
                                             <td>$item[namaBarang]</td>
                                             <td>$item[nama]</td>
                                             <td>".substr($item['deskripsi'],0,50)."</td>
                                             <td>
                                               <a onclick=\"editBarang(".$item['idbarang'].",'$item[namaBarang]','$item[idkategori]','$item[deskripsi]')\" class='btn btn-primary btn-xs'>Edit</a>
                                               <a onclick='hapusBarang(".$item['idbarang'].")' class='btn btn-danger btn-xs'>Hapus</a>
                                             </td>
                                         </tr>
                                        ";
                                      }

                                       ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>

              <div class="modal fade" id="modalPin" tabindex="-1" role="dialog" aria-labelledby="modalPin">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Masukkan pin</h4>
                    </div>
                    <form id=frmpn method=post action='?a=exec-data-barang-delete'>
                    <div class="modal-body">
                        <input type=password name=pn class='form-control' id='kpn'>
                        <input type=hidden name=id id='kid'>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" onclick="$('#frmpn').submit()">Lanjutkan</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetail">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Detail Peminjaman</h4>
                    </div>
                    <div class="modal-body" id=detailDataPeminjaman>
                        <table>
                            <tr>
                                <td>Nama Barang</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Nama Peminjam</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Penanggung Jawab</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Instansi</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Waktu Pinjam</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Waktu Kembali</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
              <script type=text/javascript>
                function editBarang(id,nama,idkategori,deskripsi){
                  $('#ed-heading').html('Edit ('+nama+')');
                  $('#namaBarang').val(nama);
                  $('#idkategori').val(idkategori);
                  $('#deskripsi').val(deskripsi);
                  $('#ed-form').attr({'action':'?a=exec-data-barang-update&id='+id});
                  $('#ed-reset').show();
                }
                function cancelEdit(){
                  $('#ed-heading').html('Tambah Barang');
                  $('#namaBarang').val('');
                  $('#idkategori').val('');
                  $('#deskripsi').val('');
                  $('#ed-form').attr({'action':'?a=exec-data-barang-save'});
                  $('#ed-reset').hide();
                }
                function hapusBarang(id){
                  $('#modalPin').on('shown.bs.modal',function(evt){
                    $('#kpn').focus();
                  });
                  $('#modalPin').modal({
                    keyboard: false
                  });
                  $('#kid').val(id);
                }
              </script>
<?php
require_once('_footer.php');
 ?>
