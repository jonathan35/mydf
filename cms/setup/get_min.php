<?php 
require_once '../../config/ini.php'; 

if(!empty($_POST['region'])) $region_cond = " and region='".$_POST['region']."' ";
if(!empty($_POST['location'])) $location_cond = " and location='".$_POST['location']."' ";
if(!empty($_POST['area'])) $area_cond = " and area='".$_POST['area']."' ";

$next_min = sql_read("select * from delivery_tier where status ='1' $region_cond $location_cond $area_cond order by max_checkout_price desc limit 1");

if($next_min['delivery_fee']>0){
    echo $next_min['max_checkout_price'];
}else{
    echo '0';
}
?>

