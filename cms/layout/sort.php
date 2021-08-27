<?php 
require_once '../../config/ini.php'; 


print_r($_POST);
foreach((array)$_POST as $id => $value){
	$data['id'] = $id;
	$data['position'] = $value;
		
	sql_save($_GET['table'], $data);
}



?>