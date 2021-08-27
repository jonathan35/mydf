<?php require_once '../../config/ini.php'; ?>
<?php
session_start();

global $subName, $passw, $sessData;

include("captcha/securimage.php");
$img = new Securimage();
$valid = $img->check($_POST['code']);

//retreatpassword($_POST['txtname'],$_POST['txtpassword']);
//johny 9/11/2005 required field change database name to PAMNC-table-admin_login
mysqli_select_db($conn, $database_conn);	
$query_Recordset1 = "SELECT * FROM login WHERE username='". $_POST['txtname'] ."' ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
//johny 9/11/2005-check if recordset is empty or not
if (($_POST['txtpassword'] == $row_Recordset1['password']) && ($totalRows_Recordset1<>0)&& ($valid == true))
{
	//johny 9/11/2005 - admin login status is zero --required
	//if status not u then is admin
	/*if ($row_Recordset1['department']!='dealer')
	{*/
		//session_start();
		$subname=$_POST['txtname'];
		$passw=$_POST['txtpassword'];
		$_SESSION['validation']='YES';
		$_SESSION['user_id'] = $row_Recordset1['id'];
		if ($_POST['autoSignin']=='yes')
		{
			setcookie ("aspen_password", $subname, time()+604800);
			setcookie("aspen_username", $passw, time()+604800);
		}
		?>
<script>
top.location.href = "../index.php";
</script>
<?php 

	/*}else if ($row_Recordset1['department']=='dealer')
	{
		
	}*/
	//johny 9/11/2005 set cookie to the admin - needed [optional]
}
else 
{ 
/*echo 'Warning!!</font></p>
      <p><font size="3" face="Arial, Helvetica, sans-serif"><strong>You are not 
        allow to enter the page without permission.</strong></font></p>
      <p><strong><font size="3" face="Arial, Helvetica, sans-serif">Please <a href="login.php">login</a> 
        with correct username & password.';
		*/
		$subname=$_POST['txtname'];
		$passw=$_POST['txtpassword'];
		$asi=$_POST['autoSignin'];
		if($asi=='')
		{
			setcookie("aspen_username",'',time()+604800);
			setcookie("aspen_password",'',time()+604800);
		}
		else
		{
		
		//form.autoSignin.checked
		//echo $_POST['txtpassword'];
		//if (!isset($_COOKIE['subscribername']))
		//{
			setcookie("aspen_username",$subname,time()+604800);
		//}
		//if (!isset($_COOKIE['password']))
		//{
			setcookie("aspen_password",$passw,time()+604800);
		//}
		}
		$value=1;
		header("Location:login.php?str=wrong");
}
?>
