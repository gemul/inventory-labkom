<?php
if(isset($_GET['a'])){
  $sect=substr($_GET['a'],0,4);
  $cont=substr($_GET['a'],5,24);
}else{
  $sect='view';
  $cont='dashboard';
}
if(file_exists($sect.'/'.$cont.'.php')){
  require_once('lib/cynetAppAssets/CyPdo.php');
  $db=new CyPdo();
  include($sect.'/'.$cont.'.php');
}else{
  echo "Not Exist";
}
?>
