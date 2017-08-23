<?php
require_once('_header.php');
 ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Kategori Barang</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading" id=ed-heading>
                            Tambah Kategori
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
                          <form role="form" action='?a=exec-kategori-barang-save' method='post' id=ed-form>
                              <div class="form-group">
                                  <label>Nama</label>
                                  <input name='nama' class="form-control" id='nama' autofocus="autofocus" type=text>
                              </div>
                              <div class="form-group">
                                  <label>ID Master Kategori</label><br>
                                  <input name='idMasterKategori' id='idMasterKategori' class="form-control" placeholder="ID Master (jika ada)" type='number'>
                              </div>
                              <div class="form-group">
                                  <label>Prioritas</label>
                                  <select name='prioritas' id=prioritas class="form-control">
                                    <?php
                                    for($i=12;$i>=1;$i--){
                                      echo "<option value='$i'>$i</option>";

                                    }
                                     ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>PIN</label>
                                  <input name='pn' class="form-control" id='pn ' type='password'>
                              </div>
                              <div class="form-group">
                                  <button type=submit class='btn btn-primary'>Simpan</button>
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
                            Daftar Kategori Barang
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="height:400px;overflow-y:scroll;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Kategori</th>
                                            <th>Master Kategori</th>
                                            <th>Prioritas</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $belumKembali=$db->fetch("select * from kategori order by nama desc");
                                      foreach($belumKembali as $item){
                                        echo "
                                         <tr>
                                             <td>$item[idkategori]</td>
                                             <td>$item[nama]</td>
                                             <td>$item[idMasterKategori]</td>
                                             <td>$item[prioritas]</td>
                                             <td>
                                                 <a onclick=\"editKategori(".$item['idkategori'].",'$item[nama]','$item[idMasterKategori]','$item[prioritas]')\" class='btn btn-primary btn-xs'>Edit</a>
                                                 <a onclick='hapusKategori(".$item['idkategori'].")' class='btn btn-danger btn-xs'>Hapus</a>
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
                    <form id=frmpn method=post action='?a=exec-kategori-barang-delete'>
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
                function editKategori(id,nama,master,prioritas){
                  $('#ed-heading').html('Edit Kategori ('+id+')');
                  $('#nama').val(nama);
                  $('#idMasterKategori').val(master);
                  $('#prioritas').val(prioritas);
                  $('#ed-form').attr({'action':'?a=exec-kategori-barang-update&id='+id});
                  $('#ed-reset').show();
                }
                function cancelEdit(){
                  $('#ed-heading').html('Tambah Kategori');
                  $('#nama').val('');
                  $('#idMasterKategori').val('');
                  $('#prioritas').val('');
                  $('#ed-form').attr({'action':'?a=exec-kategori-barang-save'});
                  $('#ed-reset').hide();
                }
                function hapusKategori(id){
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
