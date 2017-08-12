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
                          <form role="form">
                              <div class="form-group">
                                  <label>Waktu</label>
                                  <input name='waktuPinjam' class="form-control" id='datetimepicker' value='<?=date('Y-m-d h:i:s');?>'>
                              </div>
                              <div class="form-group">
                                  <label>Nama Barang</label>
                                  <input name='namaBarang' class="form-control" placeholder="Masukkan nama siswa">
                              </div>
                              <div class="form-group">
                                  <label>Jumlah</label>
                                  <input name='jumlah' class="form-control" value="1">
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
                                        <tr>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-xs">Kembali</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-xs">Kembali</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-xs">Kembali</a>
                                            </td>
                                        </tr>
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
                                        <tr>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>Otto</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>@mdo</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            <td>@fat</td>
                                            <td>@fat</td>
                                            <td>@fat</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            <td>@twitter</td>
                                            <td>@twitter</td>
                                            <td>@twitter</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
<?php
require_once('_footer.php');
 ?>
