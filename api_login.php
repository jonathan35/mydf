<?php 
require_once 'config/ini.php';



$exist_account = sql_read('select * from member where email=? limit 1', 's', $_POST['email']);




if($_POST['api'] == 'signup' && !empty($_POST['email'])){

	


	$exist_account = sql_read('select * from member where email=? limit 1', 's', $_POST['email']);
	
	if(!empty($exist_account['id'])){ 
		$_SESSION['logged_in']='YES';
		$_SESSION['user_id'] = $exist_account['id'];
		$_SESSION['auth_user'] = $exist_account;
		echo 'true';
	}else{

		$_SESSION['error'] = 'new account';

		$data = array();
		$data['name'] = $_POST['name'];
		$data['email'] = $_POST['email'];
		$data['status'] = 'Activated';
			
		if(sql_save('member', $data)){
			$auth_user = sql_read('select * from member order by id desc limit 1');
			$_SESSION['logged_in']='YES';
			$_SESSION['user_id'] = $auth_user['id'];
			$_SESSION['auth_user'] = $auth_user;
			echo 'true';
		}else{
			echo 'false';
		}
	}
}

?>