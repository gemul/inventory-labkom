<?php
if(isset($_GET['view'])){
  $view=substr($_GET['view'],0,20);
}else{
  $view='dashboard';
}
include('view/'.$view.'.php');
?>
