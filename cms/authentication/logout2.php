<?php session_unset();
	session_start();
	//johnny 9/11/2005 needed for unset the session
	$_SESSION["validation"] = "NO";
	//to ensure member did pass the username and password to this file for filtering.
	$_SESSION["filtered"] = "YES";
	$_SESSION["type"] = "public";

	$_SESSION["comid"] = 10001;
	setcookie("aspen_password",'',time()+604800);
	setcookie("aspen_username",'',time()+604800);
	header("Location:../../index.php");
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
<link href="../css/common.css" rel="stylesheet" type="text/css">
<link href="../css/component.css" rel="stylesheet" type="text/css">
<link href="../css/font.css" rel="stylesheet" type="text/css">
<link href="../css/layout.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript"></SCRIPT>
<title>Logout Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
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
function directme()
{
	top.location="login.php";
}
</script>

<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	color: #FFFFFF;
}
.style22 {font-size: 10px; font-family: Arial; font-weight: bold; }
-->
</style>
</head>
<!--
<body topmargin="3px" leftmargin="2px">

<div align="left">
  <table width="802" height="356" align="center" cellpadding="0"  cellspacing="0">
    <tr>
      <td width="798" height="58" bgcolor="#FFFFFF">
        <div align="center"><img src="../images/cmservice.png" width="800" height="50"></div></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td bgcolor="#FFFFFF"> <table width="847" height="211"  border="0" align="center">
        <tr>
          <td height="118"><div align="center">
              <p class="main_title"><strong>Thank you for using <em>Web And You Web Solutions cm Service</em>. </strong></p>
              <p class="main_title"><strong>You have successfully signed out. </strong></p>
              <p class="pagetitle">&nbsp;</p>
          </div></td>
        </tr>
        <tr>
          <td><div align="center"><span class="style22"><span class="content">You will be automatically redirected to cm Sign-in page. <br>
        / Click <a href="login.php">here</a> to go there now. </span></span></div></td>
        </tr>
      </table>
        <div align="center"></div></td>
    </tr>
  </table>
</div>
		  <div id="Layer1" style="position:absolute; width:200px; height:115px; z-index:1; left: 698px; top: 21px;">
			<table width="200" cellspacing="2" cellpadding="2">
			  <tr>
				<td class="style22">| <a href="../../index.php" class="style17"> Home Page</a> |</td>
			  </tr>
			</table>
</div>-->
</body>
</html>
