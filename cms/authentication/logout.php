<?php 
include_once '../../config/ini.php';

//if(!in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1','::1'))){

	$u = sql_read('select * from login where id=? limit 1', 's', $_SESSION['user_id']);
	$login_logout = 'logout';
	if(!empty($u)){
		$visitor = 'login:'.$u['id'];
	}
	include_once 'ip.php';

//}

	session_unset();
	session_start();
	//johnny 9/11/2005 needed for unset the session
	$_SESSION["validation"] = "NO";
	//to ensure member did pass the username and password to this file for filtering.
	$_SESSION["filtered"] = "YES";
	$_SESSION["type"] = "public";

	$_SESSION["comid"] = 10001;
	setcookie("aspen_password",'',time()+604800);
	setcookie("aspen_username",'',time()+604800);
	header("Location:../index.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style type="text/css" media="all">
@import url(css/layout.css);
@import url(css/font.css);
@import url(css/common.css);
@import url(css/component.css);</style>
<script language="JavaScript" type="text/JavaScript"></SCRIPT>
<title>Logout Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
function bookmark(url, description)
{
netscape="Netscape User's hit CTRL+D to add a bookmark to this site."
	if (navigator.appName=='Microsoft Internet Explorer')
	{
	
		window.external.AddFavorite(url, description);
	}
	else if (navigator.appName=='Netscape')
	{
		alert(netscape);
	}
}

//-->

setInterval('directme()', 3000);
function directme(){
	top.location="login.php";
}
</script>
</head>
</html>
