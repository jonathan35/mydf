<?php 
require_once '../../config/ini.php'; 
require_once '../../config/image.php';

session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}
$data[$_POST['field']] = '';
$data['id'] = $_POST['id'];

if(sql_save($table, $_POST['field'], $_POST['id'])){
	echo 'yes';	
}else{
	echo 'no';	
}
?>