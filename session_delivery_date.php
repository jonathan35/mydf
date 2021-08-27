<?php 
session_start();

if($_POST['delivery_date'] == 'today'){
    $_SESSION['delivery_date'] = date('Y-m-d');
}elseif($_POST['delivery_date'] == 'tomorrow'){
    $_SESSION['delivery_date'] = date('Y-m-d', strtotime(date('Y-m-d').' +1 day'));
}

?>