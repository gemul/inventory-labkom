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
                            function preSubmit(){
                              var pin=prompt("Masukkan pin");
                              if(pin && pin!=''){
                                $('#formPn').val(pin);
                                return true;
                              }else{
                                return false;
                              }
                            }
                          </script>
                          <form role="form" action='?a=exec-peminjaman-barang-save' onsubmit='return preSubmit()' method='post'>
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
                                  <input name="formPn" class="form-control" type=password>
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
                                             <td>
                                                 <a href='' class='btn btn-success btn-xs'>Kembali</a>
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
                                      $belumKembali=$db->fetch("select * from peminjamanbarang order by waktuPinjam desc limit ".(($pg-1)*40).",40");
                                      foreach($belumKembali as $item){
                                        echo "
                                         <tr>
                                             <td>$item[namaBarang]</td>
                                             <td>$item[namaPeminjam]</td>
                                             <td>$item[penanggungJawab]</td>
                                             <td>$item[instansi]</td>
                                             <td>".$item['waktuPinjam']."</td>
                                             <td>".$item['waktuKembali']."</td>
                                             <td>
                                                 <a href='' class='btn btn-success btn-xs'>Kembali</a>
                                             </td>
                                         </tr>
                                        ";
                                      }

                                       ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <div class='row'>
                              <div class='col-lg-2'>
                                <select class="form-control">
                                  <?php
                                  asdfasdf
                                    $asdfasdf
                                   ?>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                              </div>
                              <div class='col-lg-10'>
                                Menampilkan 40 entry per halaman
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php
require_once('_footer.php');
 ?>
