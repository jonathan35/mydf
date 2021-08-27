<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

//******************************************Add Country*************************************************
if($_POST['submit']==' Save '){
	mysqli_query($conn, "UPDATE ad_setup SET para='".$_POST['email']."', para2='".$_POST['email2']."', modified='".date('Y-m-d H:i:s')."' where id='1' ");
}

$email_query = mysqli_query($conn, "SELECT * FROM ad_setup WHERE id='1' ");
$email = mysqli_fetch_assoc($email_query);

?>


<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
</head>

<body>
<!--////////////////////////////////////////// TOP MENU START////////////////////////////////////////////// -->
<?php include("layout/top.php");?>
<!--////////////////////////////////////////// TOP MENU START////////////////////////////////////////////// -->

<div class="container-fluid">
    <div class="row">
    <!--////////////////////////////////////////// SIDE MENU START////////////////////////////////////////////// -->
	<?php include("layout/menu.php");?>
    <!--////////////////////////////////////////// SIDE MENU END////////////////////////////////////////////// -->
    
    <!--////////////////////////////////////////// CONTENT START////////////////////////////////////////////// -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" align="center">
          <div class="table-responsive">
          	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                <tr>
                    <td colspan="2" class="border_background_no_color"><h3>Website Email</h3></td>
                </tr> 
              <tr>
                <td align="left" valign="top" class="border_background_no_color">
                  <table width="100%" align="left" cellpadding="2"  cellspacing="2" border="0">
                    <form name="form1" method="post" action="editSetup.php" enctype="multipart/form-data">
                      <tr>
                        <td colspan="2" class="main_title"><strong><?php echo $success;?></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="red">*Indicate required fields </td>
                      </tr>
                      <tr valign="top">
                          <td width="20%" class="main_title"><span class="red02">*</span>Website email: </td>
                          <td width="80%">
                            <input name="email" type="email" class="content" style="width:250px; text-align:left;" value="<?php echo $email['para']?>" required><br>
                        </td>
                      </tr>
                      <tr valign="top">
                          <td class="main_title"><span class="red02">*</span>Website email (2): </td>
                          <td >
                            <input name="email2" type="email" class="content" style="width:250px; text-align:left;" value="<?php echo $email['para2']?>">
                        </td>
                      </tr>
                      <tr valign="top">
                          <td lass="main_title"></td>
                          <td >
                            <div class="red02">Website email to be use to receive all the email from website public user. Example like enquiry, feedback, contact us, media enquiry, etc.  </div>
                        </td>
                      </tr>
                      <tr>
                        <td align="center" colspan="2"><input type="submit" name="submit" value=" Save " style="width:60px;">&nbsp;</td>
                      </tr>
                    </form>
                </table></td>
              </tr>
            </table>
          </div>
        </div>
    <!--////////////////////////////////////////// CONTENT END////////////////////////////////////////////// -->
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>

</body>
</html>