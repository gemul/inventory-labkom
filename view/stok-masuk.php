<?php
require_once('_header.php');
 ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaksi Stok Masuk</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading" id=ed-heading>
                            Entri Stok Masuk
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
                          <form role="form" action='?a=exec-stok-masuk-save' method='post' id=ed-form>
                              <div class="form-group">
                                  <label>Waktu</label>
                                  <input name='waktu' class="form-control" id='datetimepicker' value='<?=date('Y-m-d h:i:s');?>'>
                              </div>
                              <script type="text/javascript">
                               $("#datetimepicker").datetimepicker({
                                  format: 'yyyy-mm-dd hh:ii:ss',
                                  autoclose: true,
                                  todayBtn: true,
                                  pickerPosition: "top"
                               });
                              </script>
                              <div class="form-group">
                                  <label>Kategori</label>
                                  <select name='idkategori' class="form-control" autofocus='autofocus' onchange="loadBarang(this);">
                                    <?php
                                    echo "<option value='' selected=selected>-Pilih kategori-</option>";
                                    $sql=$db->fetch("select * from kategori order by nama asc");
                                    foreach($sql as $data){
                                      echo "<option value=".$data['idkategori'].">".$data['nama']."</option>";
                                    }
                                     ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>Barang</label>
                                  <span id=listBarang>
                                    <br>Pilih kategori
                                  </span>
                              </div>
                              <div class="form-group">
                                  <label>Jumlah</label>
                                  <input name='qty' class="form-control" id='qty'>
                              </div>
                              <div class="form-group">
                                  <label>Catatan</label><br>
                                  <input name='catatan' id='catatan' class="form-control">
                              </div>
                              <div class="form-group">
                                  <label>PIN</label>
                                  <input name='pn' class="form-control" id='pn' type='password'>
                              </div>
                              <div class="form-group">
                                  <button class='btn btn-primary'>Simpan</button>
                                  <button type=reset onclick='cancelEdit()' class='btn btn-default' style=display:none; id=ed-reset>Batal</button>
                              </div>
                            </form>
                        </div>

                        <script type="text/javascript">
                        function loadBarang(frm){
                          if(frm.value==''){
                            $('#listBarang').html("<br>Pilih kategori");
                          }else{
                            $.ajax({
                              url:"?a=view-ajax-list-barang&id="+frm.value,
                              type:'post',
                              dataType:'html',
                              beforeSend:function(e){
                                $('#listBarang').html("<br>Memuat daftar barang...");
                              },
                              success:function(r){
                                $('#listBarang').html(r);
                              }
                            });
                          }
                        }
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
                          <div class='row'>
                            <div class='col-lg-8'>
                              Daftar Stok Masuk
                            </div>
                            <div class='col-lg-4'>
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="height:400px;overflow-y:scroll;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Catatan</th>
                                            <th style=width:120px>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      if(!empty($_GET['p'])){
                                        $pg=$_GET['p'];
                                      }else{
                                        $pg=1;
                                      }
                                      if(!empty($_GET['s'])){
                                        $sort=substr(explode('-',$_GET['s'])[0],0,20)." ".substr(explode('-',$_GET['s'])[1],0,4);
                                      }else{
                                        $sort="waktu desc";
                                      }
                                      if(!empty($_GET['f'])){
                                        $find=" and (namaBarang like '%".$_GET['f']."%' or waktu like '%".$_GET['f']."%' or catatan like '%".$_GET['f']."%') ";
                                      }else{
                                        $find=" ";
                                      }
                                      $stokMasuk=$db->fetch("select * from transaksi inner join barang using(idbarang) where jenis='masuk' $find order by $sort limit ".(($pg-1)*40).",40");
                                      foreach($stokMasuk as $item){
                                        echo "
                                         <tr>
                                             <td>$item[waktu]</td>
                                             <td>$item[namaBarang]</td>
                                             <td>$item[qty]</td>
                                             <td>".substr($item['catatan'],0,50)."</td>
                                             <td>
                                               <a onclick='detailTransaksi(".$item['idtransaksi'].")' class='btn btn-primary btn-xs'>detail</a>
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
                            <div class='col-lg-3'>
                              <select class="form-control" onchange="paging(this)">
                                <?php
                                $jumlah=$db->fetch("select count(idtransaksi) as jml from transaksi where jenis='masuk'");
                                $jumlah=ceil($jumlah[0]['jml']/40);
                                for($i=1;$i<=$jumlah;$i++){
                                  echo "<option ";
                                  if(!empty($_GET['pg']) && $i==$_GET['pg'])echo " selected=selected ";
                                  echo "value=".$i.">Page ".$i."</option>";
                                }
                                 ?>
                              </select>
                              <script type=text/javascript>
                              function paging(e){
                                window.location='?a=view-stok-masuk&pg='+e.value+"<?php if(!empty($_GET['s']))echo "&s=".$_GET['s'];?><?php if(!empty($_GET['f']))echo "&f=".$_GET['f'];?>";
                              }
                              </script>
                            </div>
                            <div class='col-lg-4'>
                              <select class="form-control" onchange="sortTable(this)" id=sortTable>
                                <option value='waktu-desc'>Waktu (Z-A)</option>
                                <option value='waktu-asc'>Waktu (A-Z)</option>
                                <option value='namaBarang-asc'>Nama Barang (A-Z)</option>
                                <option value='namaBarang-desc'>Nama Barang (Z-A)</option>
                              </select>
                              <script type=text/javascript>
                              <?php if(!empty($_GET['s']))echo "$('#sortTable').val('".$_GET['s']."');";?>
                              function sortTable(e){
                                window.location='?a=view-stok-masuk&s='+e.value+"<?php if(!empty($_GET['f']))echo "&f=".$_GET['f'];?>";
                              }
                              </script>
                            </div>
                            <div class='col-lg-4'>
                              <form method=get action=''>
                                <input type="hidden" name='a' value='view-stok-masuk'>
                                <?php if(!empty($_GET['s']))echo "<input type='hidden' name='s' value='".$_GET['s']."'>";?>
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Cari..." name='f' <?php if(!empty($_GET['f']))echo "value='".$_GET['f']."'";?>>
                                  <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit"><i class='fa fa-search'></i></button>
                                  </span>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
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
                      <h4 class="modal-title" id="myModalLabel">Detail Transaksi</h4>
                    </div>
                    <div class="modal-body" id=detailTransaksi>
                    </div>
                  </div>
                </div>
              </div>
              <script type=text/javascript>
              function detailTransaksi(id){
                $('#detailTransaksi').load('?a=view-stok-masuk-detail&id='+id);
                $('#modalDetail').modal({
                  keyboard: false
                });

              }
              </script>
<?php
require_once('_footer.php');
 ?>
