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
                        <div class="panel-heading">
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
                          <form role="form" action='?a=exec-kategori-barang-save' method='post'>
                              <div class="form-group">
                                  <label>Nama</label>
                                  <input name='nama' class="form-control" id='nama ' autofocus="autofocus">
                              </div>
                              <div class="form-group">
                                  <label>ID Master Kategori</label><br>
                                  <input name='idMasterKategori' id='idMasterKategori' class="typeahead form-control" placeholder="ID Master (jika ada)">
                                  <script type="text/javascript">

                                    $(document).ready(function(){
                                        // Defining the local dataset
                                        var cars = ['Proyektor', 'Laptop', 'Obeng','Layar','Stop Kontak','Mouse','Keyboard','Router'];

                                        // Constructing the suggestion engine
                                        var cars = new Bloodhound({
                                            datumTokenizer: Bloodhound.tokenizers.whitespace,
                                            queryTokenizer: Bloodhound.tokenizers.whitespace,
                                            local: cars
                                        });

                                        // Initializing the typeahead
                                        $('#idMasterKategori').typeahead({
                                            hint: true,
                                            highlight: true,
                                            minLength: 1
                                        },
                                        {
                                            name: 'cars',
                                            source: cars
                                        });
                                    });
                                    </script>
                              </div>
                              <div class="form-group">
                                  <label>Prioritas</label>
                                  <select name='prioritas' class="form-control">
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
                                  <button class='btn btn-primary'>Simpan</button>
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
                            Peminjaman Belum Kembali
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
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
                                             <td>$item[nama]</td>
                                             <td>$item[idMasterKategori]</td>
                                             <td>$item[prioritas]</td>
                                             <td>
                                                 <a onclick='editKategori(".$item['idkategori'].")' class='btn btn-primary btn-xs'>Edit</a>
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
                    <form id=frmpn method=post action='?a=exec-peminjaman-barang-kembali'>
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
                function transaksiKembali(frm){
                  $('#modalPin').on('shown.bs.modal',function(evt){
                    $('#kpn').focus();
                  });
                  $('#modalPin').modal({
                    keyboard: false
                  });
                  $('#kid').val(frm);
                }
                function detailPeminjaman(id){
                  $('#detailDataPeminjaman').load('?a=view-peminjaman-barang-detail&id='+id);
                  $('#modalDetail').modal({
                    keyboard: false
                  });

                }
              </script>
<?php
require_once('_footer.php');
 ?>
