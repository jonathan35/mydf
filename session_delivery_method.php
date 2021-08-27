<?php 


session_start();

if($_POST['m'] == 'deli'){
    $_SESSION['delivery_method'] = 'deliver';
}elseif($_POST['m'] == 'pick'){
    $_SESSION['delivery_method'] = 'pickup';
}
?>