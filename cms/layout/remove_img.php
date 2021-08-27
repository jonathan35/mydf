<?php 
require_once '../../config/ini.php'; 
require_once '../../config/image.php';


session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

if($img->remove_image($_POST['table'], $_POST['field'], $_POST['id'])){
	echo 'yes';	
}else{
	echo 'no';	
}
?>