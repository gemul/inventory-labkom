<?php
require_once('_header.php');
 ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Jurnal Penggunaan Laboratorium</h1>
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
                          <form role="form" action='?a=exec-jurnal-lab-save' method='post'>
                              <div class="form-group">
                                  <label>Waktu</label>
                                  <input name='waktu' class="form-control" id='datetimepicker' value='<?=date('Y-m-d H:i:s');?>'>
                              </div>
                              <div class="form-group">
                                  <label>Dosen</label>
                                  <select name='idDosen' class="form-control">
                                    <option value='' selected=selected>--Pilih Dosen--</option>
                                    <?php
                                    $qdosen=$db->fetch("select * from jurnal_dosen order by namaDosen asc");
                                    foreach($qdosen as $dosen){
                                      echo "
                                          <option value='".$dosen['idDosen']."'>".$dosen['namaDosen']." - ".$dosen['nidn']."</option>
                                      ";
                                    }
                                     ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>LAB</label>
                                  <select name='lab' class="form-control">
                                    <option value='' selected=selected>--Pilih Lab--</option>
                                    <option value='LAB A'>LAB A</option>
                                    <option value='LAB B'>LAB B</option>
                                    <option value='LAB C'>LAB C</option>
                                    <option value='LAB D'>LAB D</option>
                                    <option value='LAB E'>LAB E</option>
                                    <option value='LAB F'>LAB F</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                <label>Keperluan</label>
                                <input name='keperluan' class="form-control">
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Rekam Penggunaan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Dosen</th>
                                            <th>Lab</th>
                                            <th>Keperluan</th>
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
                                        $sort=explode('-',$_GET['s'])[0]." ".substr(explode('-',$_GET['s'])[1],0,4);
                                      }else{
                                        $sort="jurnal_entri.waktu desc";
                                      }
                                      if(isset($_GET['f'])){
                                        $find=" where jurnal_dosen.namaDosen like '%".$_GET['f']."%' or jurnal_entri.lab like '%".$_GET['f']."%' or jurnal_entri.waktu like '%".$_GET['f']."%'";
                                      }else{
                                        $find=" ";
                                      }
                                      $jurnal=$db->fetch("select * from jurnal_entri inner join jurnal_dosen using(idDosen) $find order by $sort limit ".(($pg-1)*40).",40");
                                      foreach($jurnal as $item){
                                        echo "
                                         <tr>
                                             <td>".date("D,d M",strtotime($item['waktu']))."</td>
                                             <td>$item[namaDosen]</td>
                                             <td>$item[lab]</td>
                                             <td>$item[keperluan]</td>
                                             <td>
                                                 <a onclick='detailJurnal(".$item['idEntri'].")' class='btn btn-primary btn-xs'>Detail</a>
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
                                  $jumlah=$db->fetch("select count(idEntri) as jml from jurnal_entri");
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
                                  window.location='?a=view-jurnal-lab&pg='+e.value+"<?php if(isset($_GET['s']))echo "&s=".$_GET['s'];?><?php if(isset($_GET['f']))echo "&f=".$_GET['f'];?>";
                                }
                                </script>
                              </div>
                              <div class='col-lg-3'>Urutkan
                                <select class="form-control" onchange="sortTable(this)" id=sortTable>
                                  <option value='jurnal_entri.waktu-desc'>Waktu (Z-A)</option>
                                  <option value='jurnal_entri.waktu-asc'>Waktu (A-Z)</option>
                                  <option value='jurnal_dosen.namaDosen-asc'>Nama Dosen (A-Z)</option>
                                  <option value='jurnal_dosen.namaDosen-desc'>Nama Dosen (Z-A)</option>
                                </select>
                                <script type=text/javascript>
                                <?php
                                if(isset($_GET['s']))echo "$('#sortTable').val('".$_GET['s']."');";?>
                                function sortTable(e){
                                  window.location='?a=view-jurnal-lab&s='+e.value+"<?php if(isset($_GET['f']))echo "&f=".$_GET['f'];?>";
                                }
                                </script>
                              </div>
                              <div class='col-lg-2'>Cari
                                <form method=get action=''>
                                  <input type="hidden" name='a' value='view-jurnal-lab'>
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
                    <form id=frmpn method=post action='?a=exec-peminjaman-proyektor-kembali'>
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
                                <td>Nama proyektor</td>
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
                function detailJurnal(id){
                  $('#detailDataPeminjaman').load('?a=view-jurnal-lab-detail&id='+id);
                  $('#modalDetail').modal({
                    keyboard: false
                  });

                }
              </script>
<?php
require_once('_footer.php');
 ?>
