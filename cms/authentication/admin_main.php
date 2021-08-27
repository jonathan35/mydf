<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Content Management System</title>
  <link href="<?php echo ROOT?>css/bootstrap.4.5.0.css" rel="stylesheet">
  <link href="<?php echo ROOT?>css/cms.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>
<body>
  <div class="row">
    <div class="col text-center" style="color:gray;">
		<br><br><br><br><br><br><br><br><br><br>
		<h4>Welcome to Content Management System</h4>
    </div>
  </div>
</body>
</html>