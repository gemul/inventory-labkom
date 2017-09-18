<?php
require_once('_header.php');
 ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Peminjaman Barang</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Tambah Data
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
                          <form role="form" action='?a=exec-peminjaman-barang-save' method='post'>
                              <div class="form-group">
                                  <label>Waktu</label>
                                  <input name='waktuPinjam' class="form-control" id='datetimepicker' value='<?=date('Y-m-d h:i:s');?>'>
                              </div>
                              <div class="form-group">
                                  <label>Nama Barang</label><br>
                                  <input name='namaBarang' id='namaBarang' class="typeahead form-control" placeholder="Masukkan nama barang" autofocus="autofocus">
                                  <script type="text/javascript">
                                  /*
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
                                        $('#namaBarang').typeahead({
                                            hint: true,
                                            highlight: true,
                                            minLength: 1
                                        },
                                        {
                                            name: 'cars',
                                            source: cars
                                        });
                                        $("#namaBarang").focus();
                                    });*/
                                    </script>
                              </div>
                              <div class="form-group">
                                  <label>Jumlah</label>
                                  <input name='jumlah' class="form-control" value="1" type=number>
                              </div>
                              <div class="form-group">
                                  <label>Nama Peminjam</label>
                                  <input name='namaPeminjam' class="form-control">
                              </div>
                              <div class="form-group">
                                  <label>Penanggung jawab</label>
                                  <input name='penanggungJawab' class="form-control">
                              </div>
                              <div class="form-group">
                                  <label>Instansi</label>
                                  <select name='instansi' class="form-control">
                                    <option value='' selected=selected>--Pilih Instansi--</option>
                                    <option value='SMA'>SMA</option>
                                    <option value='SMK'>SMK</option>
                                    <option value='STMIK'>STMIK</option>
                                    <option value='UMUM'>UMUM</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>PIN</label>
                                  <input name="pn" class="form-control" type=password>
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
                                            <th>Nama Barang</th>
                                            <th>Peminjam</th>
                                            <th>Wkt Pinjam</th>
                                            <th>Durasi</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $belumKembali=$db->fetch("select * from peminjamanbarang where waktuKembali is NULL order by waktupinjam desc");
                                      foreach($belumKembali as $item){
                                        echo "
                                         <tr>
                                             <td>$item[namaBarang]</td>
                                             <td>$item[namaPeminjam]</td>
                                             <td>".$item['waktuPinjam']."</td>
                                             <td>".floor(abs(time()-strtotime($item['waktuPinjam']))/(60*60))." Jam</td>
                                             <td>
                                                 <a onclick='detailPeminjaman(".$item['idpeminjamanbarang'].")' class='btn btn-primary btn-xs'>Detail</a>
                                                 <a onclick='transaksiKembali(".$item['idpeminjamanbarang'].")' class='btn btn-success btn-xs'>Kembali</a>
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

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Rekam Peminjaman
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Nama Peminjam</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Instansi</th>
                                            <th>Waktu Pinjam</th>
                                            <th>Waktu Kembali</th>
                                            <th>Durasi</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      if(!isset($_GET['p'])){
                                        $pg=1;
                                      }else{
                                        $pg=$_GET['p'];
                                      }
                                      if(isset($_GET['s'])){
                                        $sort=substr(explode('-',$_GET['s'])[0],0,20)." ".substr(explode('-',$_GET['s'])[1],0,4);
                                      }else{
                                        $sort="waktuPinjam desc";
                                      }
                                      if(isset($_GET['f'])){
                                        $find=" where namaPeminjam like '%".$_GET['f']."%' or penanggungJawab like '%".$_GET['f']."%' or waktuPinjam like '%".$_GET['f']."%' or waktuKembali like '%".$_GET['f']."%' ";
                                      }else{
                                        $find=" ";
                                      }
                                      $belumKembali=$db->fetch("select * from peminjamanbarang $find order by $sort limit ".(($pg-1)*40).",40");
                                      foreach($belumKembali as $item){
                                        $durasi=(!empty($item['waktuKembali']))?floor(abs(strtotime($item['waktuKembali'])-strtotime($item['waktuPinjam']))/(60*60)):0;
                                        echo "
                                         <tr>
                                             <td>$item[namaBarang]</td>
                                             <td>$item[namaPeminjam]</td>
                                             <td>$item[penanggungJawab]</td>
                                             <td>$item[instansi]</td>
                                             <td>".$item['waktuPinjam']."</td>
                                             <td>".$item['waktuKembali']."</td>
                                             <td>".$durasi." Jam</td>
                                             <td>
                                                 <a onclick='detailPeminjaman(".$item['idpeminjamanbarang'].")' class='btn btn-primary btn-xs'>Detail</a>
                                             </td>
                                         </tr>
                                        ";
                                      }

                                       ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                              <span class='pull-right'>Menampilkan 40 entry per halaman</span>
                            <div class='row'>
                              <div class='col-lg-2'>Halaman
                                <select class="form-control" onchange="paging(this)">
                                  <?php
                                  $jumlah=$db->fetch("select count(idpeminjamanbarang) as jml from peminjamanbarang");
                                  $jumlah=ceil($jumlah[0]['jml']/40);
                                  for($i=1;$i<=$jumlah;$i++){
                                    echo "<option ";
                                    if(isset($_GET['pg']) && $i==$_GET['pg'])echo " selected=selected ";
                                    echo "value=".$i.">".$i."</option>";
                                  }
                                   ?>
                                </select>
                                <script type=text/javascript>
                                function paging(e){
                                  window.location='?a=view-peminjaman-barang&pg='+e.value+"<?php if(isset($_GET['s']))echo "&s=".$_GET['s'];?><?php if(isset($_GET['f']))echo "&f=".$_GET['f'];?>";
                                }
                                </script>
                              </div>
                              <div class='col-lg-3'>Urutkan
                                <select class="form-control" onchange="sortTable(this)" id=sortTable>
                                  <option value='waktuPinjam-desc'>Waktu Pinjam (Z-A)</option>
                                  <option value='waktuPinjam-asc'>Waktu Pinjam (A-Z)</option>
                                  <option value='waktuKembali-asc'>Waktu Kembali (A-Z)</option>
                                  <option value='waktuKembali-desc'>Waktu Kembali (Z-A)</option>
                                  <option value='namaPeminjam-asc'>Nama Peminjam (A-Z)</option>
                                  <option value='namaPeminjam-desc'>Nama Peminjam (Z-A)</option>
                                </select>
                                <script type=text/javascript>
                                <?php if(isset($_GET['s']))echo "$('#sortTable').val('".$_GET['s']."');";?>
                                function sortTable(e){
                                  window.location='?a=view-peminjaman-barang&s='+e.value+"<?php if(isset($_GET['f']))echo "&f=".$_GET['f'];?>";
                                }
                                </script>
                              </div>
                              <div class='col-lg-2'>Cari
                                <form method=get action=''>
                                  <input type="hidden" name='a' value='view-peminjaman-barang'>
                                  <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari..." name='f' <?php if(isset($_GET['f']))echo "value='".$_GET['f']."'";?>>
                                    <span class="input-group-btn">
                                      <button class="btn btn-secondary" type="submit"><i class='fa fa-search'></i></button>
                                    </span>
                                  </div>
                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
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
