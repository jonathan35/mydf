<?php 
require_once '../../config/ini.php'; 

session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

$save = false;	

if(!empty($_POST['id'])){
	
	$data['id'] = $_POST['id'];
	$data['verification'] = $_POST['verification'];
	$data['modified'] = date("Y-m-d h:i:s");
	
	if(sql_save('cases', $data)){
		$save = true;	
	}
}

if($save == true){
	if($_POST['verification'] == 'verified'){
		$color = '#068A7A';
		$verification_label = 'VERIFIED';
		$verification_brief = 'VERIFIED means that CADPIS case workers have contacted and verified that the cases are valid.';
	}else{
		$color = '#F00';
		$verification_label = 'PENDING';
		$verification_brief = 'PENDING means that CADPIS case workers are still in the process of verifying the cases.';
	}
}
?>
<span style="font-size:16px; margin:5px 0 5px 0; cursor:default; font-weight:bold; color:<?php echo $color?>;" title="Note: CADPIS ensures that there is donor accountability. <?php echo $verification_brief?> "><?php echo $verification_label?></span>

