<?php 
require_once '../../config/ini.php';

	session_unset();
	session_start();
	//johnny 9/11/2005 needed for unset the session
	$_SESSION['validation'] = "NO";
	//to ensure member did pass the username and password to this file for filtering.
	//$_SESSION["filtered"] = "YES";
	//$_SESSION["type"] = "public";

	//$_SESSION["comid"] = 10001;
	setcookie("aspen_password",'',time()+604800);
	setcookie("aspen_username",'',time()+604800);
	//header("Location:../login.php");


	if(!empty($_POST['forget_password'])){

		$_SESSION['session_msg'] = '<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>Failed to send email, please try later.</div>';

		if(!empty($_POST['email'])){
	
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$account = sql_read('select * from login where username=? limit 1', 's', $email);
			
			if(!empty($account['id'])){
				
				$data = array();
				$data['id'] = $account['id'];
				$tmp_password = uniqid();
				$data['temp_password'] = hash('md5',$tmp_password);

				sql_save('login', $data);


				$name = $account['name'];					
				$to = $email;
				$subject = 'Forget and Reset Password';
				$header = "MIME-Version: 1.0" . "\r\n";
				$header.= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
				$header.= 'From: master@mschosting.com'. "\r\n";
				$content = '
					<!DOCTYPE html>
					<html lang="en">
					<head>
						<meta charset="UTF-8">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<title>Forget and Reset Password</title>
					</head>
					<body>
						Dear administrator,<br><br>

						You have requested a new temporary password. You may use this temporary password for your next login.<br><br>
						
						Email : '.$account['email'].'<br>
						Password : '.$tmp_password.'<br><br>
						
						Please ignore this message if you manage to login.<br><br>
						
						**This is automate email, do not reply to this email.
					</body>
					</html>';

				if(mail($to, $subject, $content, $header)){
					$_SESSION['session_msg'] = '<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>Reset email sent to your mail box successfully, please check your inbox/spam box.</div>';
				}
				
			}
		}
	}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="../css/bootstrap.4.5.0.css" rel="stylesheet">
  <link href="../css/cms.css" rel="stylesheet">
</head>
<body>

<div class="row">
	<div class="col-12 col-md-4 offset-md-4 p-3">
		<div class="row">
			<h1 class="pt-5 pb-2">Login</h1>
		</div>
		<form name="form1" method="post" action="password.php">

			<div class="row">
				<div class="col-4 p-1">Username</div>
				<div class="col-8 p-1">
					<input name="txtname" type="email" required >
				</div>
			</div>		
			<div class="row">
				<div class="col-4 p-1">Password</div>
				<div class="col-8 p-1">
					<input name="txtpassword" type="password" required >
				</div>
			</div>	
			
			<div class="row pt-1 pb-1">
				<div class="col-4 p-1">Type the above code</div>
				<div class="col-8 p-1">
					<div>
						<img src="captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>">
					</div>
					<input name="code" type="text" maxlength="33" />				
					<div class="text-muted">This code can be typed in all lowercase</div>
				</div>
			</div>  
			
			<div class="row">				
				<div class="col-12 pt-3 text-right pr-0">
					<input name="submit2" type="submit" class="content" title="Login" value="Login">

					<div class="row">
						<div class="col-12 pt-3">
							<div class="hyperlink" data-toggle="modal" data-target="#forgetPasswordModal" data-dismiss="modal" style="cursor:pointer; color: orange">Forget Password?</div>
							<?php if(!empty($save)) echo $save;?>
						</div>
					</div>
				</div>
			</div>

			

			<div class="row pt-5">
				<div class="col-12">
					<?php if (!empty($_GET['str'])){ ?>                        
				
						<div style="font-size:18px; color:red;">
						W R O N G - P A S S W O R D - F O U N D !!!
						</div>

						<div>
							You've entered an invalid password. Please ensure: 
						</div>
						<div>
							1. &quot;Caps Lock&quot; is set correctly as Passwords are case sensitive.<br>
							2. You have not included any blank spaces <br>
							after your Member ID or password.<br>
						</div>
				                     
					<?php } ?>
				</div>
			</div>

		
		</form>
						
		
		
	</div>

</div>

<?php include 'forget_password.php'?>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/4.3.1/bootstrap.min.js"></script>
<?php include '../../config/session_msg.php';?>

</body>
</html>