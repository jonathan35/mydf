<?php 
require_once '../../config/ini.php'; 

if($_SESSION['validation']=='YES'){
	if(!empty($_GET['table']) && !empty($_GET['id'])){
		
		if(mysqli_query($conn, "DELETE FROM ".$_GET['table']." WHERE id = '".$_GET['id']."'")){
			echo '<span style="color:green;">Data deleted</span>';
		}else{
			echo '<span style="color:red;">Failed to delete data</span>';
		}
	}
}

?>