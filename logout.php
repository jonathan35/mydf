<?php 
include_once("config/ini.php");
$login_logout = 'logout';

if(!empty($_SESSION['auth_user']['id'])){
	$visitor = 'accounts:'.$_SESSION['auth_user']['id'];
}
include_once 'ip.php';

$_SESSION['logged_in']='';
$_SESSION['user_id'] = '';
$_SESSION['passkey'] = '';
$_SESSION['auth_user'] = '';

$_SESSION['session_msg'] = '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
		Sign out successfully.</div>';

header('Location: home');
die();
?>