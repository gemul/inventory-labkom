<?php
require_once('_header.php');
 ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Rekapitulasi Stok</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Data Stok
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
                                            <th>Stok</th>
                                            <th style=width:120px>Laporan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $stok=$db->fetch("select * from barang inner join kategori using(idkategori) order by nama desc");
                                      foreach($stok as $item){
                                        $masuk=$db->fetch("select sum(qty) as jml from transaksi where jenis='masuk' and idbarang='".$item['idbarang']."'");
                                        $masuk=$masuk[0]['jml'];
                                        $keluar=$db->fetch("select sum(qty) as jml from transaksi where jenis='keluar' and idbarang='".$item['idbarang']."'");
                                        $keluar=$keluar[0]['jml'];
                                        echo "
                                         <tr>
                                             <td>$item[namaBarang]</td>
                                             <td>$item[nama]</td>
                                             <td>".substr($item['deskripsi'],0,50)."</td>
                                             <td>".($masuk-$keluar)."</td>
                                             <td>
                                             <a onclick=\"laporanStok('".$item['namaBarang']."')\" class='btn btn-success btn-xs'>Transaksi</a>
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
                        <div class='panel-footer'>
                          <div class='row'>
                            <div class='col-lg-2'>
                              <button class='btn btn-primary' onclick='unduhCsv()'>Unduh csv <i class='glyphicon glyphicon-download'></i></button>
                              <script type=text/javascript>
                              function unduhCsv(){
                                window.location="?a=exec-rekap-stok-download-csv";
                              }
                              </script>
                            </div>
                            <div class='col-lg-2'>
                              <button class='btn btn-primary' onclick='unduhXls()'>Unduh xls <i class='glyphicon glyphicon-download'></i></button>
                              <script type=text/javascript>
                              function unduhXls(){
                                window.location="?a=exec-rekap-stok-download-xls";
                              }
                              </script>
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>

              <script type=text/javascript>
                function laporanStok(nama){
                  window.location="?a=view-rekap-transaksi&f="+nama;
                }
              </script>
<?php
require_once('_footer.php');
 ?>
