<?php
require_once('_header.php');
$filterText="";
if(!empty($_GET['s'])){
  $filterText.="Mengurutkan \"".explode('-',$_GET['s'])[0]."\" ";
  $sort=substr(explode('-',$_GET['s'])[0],0,20)." ".substr(explode('-',$_GET['s'])[1],0,4);
}else{
  $sort="waktu desc";
}
if(!empty($_GET['j']) || !empty($_GET['f'])){
  $where="where ";
}else{
  $where="";
}
if(!empty($_GET['j'])){
  $where.="jenis='".$_GET['j']."' ";
  $filterText.=" Dari transaksi ".$_GET['j'];
}else{
  $where.="";
}
if(!empty($_GET['j']) && !empty($_GET['f'])){
  $where.=" and ";
}else{
  $where.="";
}
if(!empty($_GET['f'])){
  $filterText.=" Berdasarkan kata kunci \"".$_GET['f']."\"";
  $where.=" (namaBarang like '%".$_GET['f']."%' or waktu like '%".$_GET['f']."%' or catatan like '%".$_GET['f']."%') ";
}else{
  $where.=" ";
}
if(!empty($_GET['p'])){
  $pg=$_GET['p'];
  $filterText.="Halaman $pg";
}else{
  $pg=1;
}
if($filterText!=''){
  $filterText="(".$filterText." )";
}
 ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Rekapitulasi Transaksi Stok</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                          <div class='row'>
                            <div class='col-lg-8'>
                              Transaksi Stok <?=$filterText?>
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
                                            <th>Keluar/Masuk</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Catatan</th>
                                            <th style=width:120px>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $stokMasuk=$db->fetch("select * from transaksi inner join barang using(idbarang) $where order by $sort limit ".(($pg-1)*40).",40");
                                      foreach($stokMasuk as $item){
                                        echo "
                                         <tr>
                                             <td>$item[waktu]</td>
                                             <td>";
                                             if($item['jenis']=='masuk'){
                                               echo "<i class='glyphicon text-success glyphicon-log-in'></i> ".$item['jenis'];
                                             }else{
                                               echo "<i class='glyphicon text-danger glyphicon-log-out'></i> ".$item['jenis'];
                                             }
                                             echo "</td>
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
                            <div class='col-lg-2'>
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
                                window.location='?a=view-rekap-transaksi&pg='+e.value+"<?php if(!empty($_GET['s']))echo "&s=".$_GET['s'];?><?php if(!empty($_GET['f']))echo "&f=".$_GET['f'];?><?php if(!empty($_GET['j']))echo "&j=".$_GET['j'];?>";
                              }
                              </script>
                            </div>
                            <div class='col-lg-2'>
                              <select class="form-control" onchange="sortTable(this)" id=sortTable>
                                <option value='waktu-desc'>Waktu (Z-A)</option>
                                <option value='waktu-asc'>Waktu (A-Z)</option>
                                <option value='namaBarang-asc'>Nama Barang (A-Z)</option>
                                <option value='namaBarang-desc'>Nama Barang (Z-A)</option>
                              </select>
                              <script type=text/javascript>
                              <?php if(!empty($_GET['s']))echo "$('#sortTable').val('".$_GET['s']."');";?>
                              function sortTable(e){
                                window.location='?a=view-rekap-transaksi&s='+e.value+"<?php if(!empty($_GET['f']))echo "&f=".$_GET['f'];?><?php if(!empty($_GET['j']))echo "&j=".$_GET['j'];?>";
                              }
                              </script>
                            </div>
                            <div class='col-lg-2'>
                              <select class="form-control" onchange="filterJenis(this)" id=filterJenis>
                                <option value=''>-Semua-</option>
                                <option value='masuk'><i class='glyphicon text-success glyphicon-log-in'></i> Masuk</option>
                                <option value='keluar'><i class='glyphicon text-success glyphicon-log-out'></i> Keluar</option>
                              </select>
                              <script type=text/javascript>
                              <?php if(!empty($_GET['j']))echo "$('#filterJenis').val('".$_GET['j']."');";?>
                              function filterJenis(e){
                                window.location='?a=view-rekap-transaksi&j='+e.value+"<?php if(!empty($_GET['f']))echo "&f=".$_GET['f'];?><?php if(!empty($_GET['s']))echo "&s=".$_GET['s'];?>";
                              }
                              </script>
                            </div>
                            <div class='col-lg-2'>
                              <form method=get action=''>
                                <input type="hidden" name='a' value='view-rekap-transaksi'>
                                <?php if(!empty($_GET['j']))echo "<input type='hidden' name='j' value='".$_GET['j']."'>";?>
                                <?php if(!empty($_GET['s']))echo "<input type='hidden' name='s' value='".$_GET['s']."'>";?>
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Cari..." name='f' <?php if(!empty($_GET['f']))echo "value='".$_GET['f']."'";?>>
                                  <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit"><i class='fa fa-search'></i></button>
                                  </span>
                                </div>
                              </form>
                            </div>
                            <div class='col-lg-2'>
                              <button class='btn btn-primary' onclick='unduhCsv()'>Unduh csv <i class='glyphicon glyphicon-download'></i></button>
                              <script type=text/javascript>
                              function unduhCsv(){
                                window.location="?a=exec-rekap-transaksi-download-csv<?php if(!empty($_GET['f']))echo "&f=".$_GET['f'];?><?php if(!empty($_GET['j']))echo "&j=".$_GET['j'];?><?php if(!empty($_GET['s']))echo "&s=".$_GET['s'];?>";
                              }
                              </script>
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
                $('#detailTransaksi').load('?a=view-rekap-transaksi-detail&id='+id);
                $('#modalDetail').modal({
                  keyboard: false
                });

              }
              </script>
<?php
require_once('_footer.php');
 ?>
