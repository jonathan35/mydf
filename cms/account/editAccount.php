<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

$id = mysqli_real_escape_string($conn, base64_decode($_GET['id']));

if($_POST['submit']=='UPDATE'){ 

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$address2 = $_POST['address2'];
	$town = $_POST['town'];
	$country = $_POST['country'];
	$datetime=date("Y-m-d H:i:s");
	
	
	if(mysqli_query($conn, "UPDATE accounts SET 
			first_name ='".$first_name."', last_name ='".$last_name."', email ='".$email."', 
			address='".$address."', address2='".$address2."', town='".$town."', country='".$country."', 
			modified='".$datetime."' where id='".$id."' "))		
		$success='<font color="#336600">Account updated</font>';
	else
		$success='<font color="#CC3300">Failed to update Account</font>';
}

$account_query=mysqli_query($conn, "select * from accounts where id='".$id."' ");
$account=mysqli_fetch_assoc($account_query);

?>


<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">

<style>
input[type="text"], select, textarea, input[type="email"]{
	width:50%;
}
</style>

<script>
function check()
{
	if(form1.first_name.value=="")
	{
		alert("Please enter your first name.");
		form1.first_name.focus();
		return false;
	}
	if(form1.last_name.value=="")
	{
		alert("Please enter your last name.");
		form1.last_name.focus();
		return false;
	}
	if(form1.email.value=="")
	{
		alert("Please enter your email.");
		form1.email.focus();
		return false;
	}
	return true;
}

</script>


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
          	<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped">
                <tr>
                    <td colspan="2" class="border_background_no_color"><h3>Edit Account</h3></td>
                </tr>              
              <tr>
                <td height="288" align="left" valign="top" class="border_background_no_color">
                <form name="form1" method="post" action="editAccount.php?id=<?php echo $_GET['id']?>" enctype="multipart/form-data">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="4" class="main_title"></td>
                    </tr>
            
                    <tr>
                      <td colspan="4" class="red">*Indicate required fields </td>
                    </tr>
            
                    <tr>
                      <td colspan="4" align="center" ><strong><?php echo $success;?></strong></td>
                    </tr>
                  
                    <tr>
                      <td>
						<div class="col-12">
                                
                    <table width="100%" align="left" cellpadding="2"  cellspacing="2" border="0">
                        
                        <tr valign="top">
                          <td width="210" valign="top" class="main_title">&nbsp;</td>
                          <td colspan="3">&nbsp;</td>
                        </tr>
                        
                        <tr valign="top">
                          <td width="210" class="main_title"><span class="red">*</span>First Name&nbsp;</td>
                          <td width="70%"><input type="text" name="first_name" id="first_name" value="<?php echo $account['first_name']?>" maxlength="20"></td>
                        </tr>
                        
                        <tr valign="top">
                          <td width="210" class="main_title"><span class="red">*</span>Last Name&nbsp;&nbsp;</td>
                          <td><input type="text" name="last_name" id="last_name" value="<?php echo $account['last_name']?>"></td>
                        </tr> 
                                   
                        <tr valign="top">
                            <td width="210" class="main_title"> <span class="red">*</span>Email<span class="red"></span>&nbsp;</td>
                            <td><input type="email" name="email" id="email" value="<?php echo $account['email']?>"></td>
            
                        </tr>
                        
                        <tr valign="top">
                          <td class="main_title">Address<span class="red"> </span>&nbsp;</td>
                          <td><textarea name="address"><?php echo $account['address']?></textarea></td>
                        </tr>            
                        <tr valign="top">
                          <td class="main_title">Address (2)<span class="red"> </span>&nbsp;</td>
                          <td><textarea name="address2"><?php echo $account['address2']?></textarea></td>
                        </tr>            
                        <tr valign="top">
                          <td class="main_title">Town<span class="red"> </span>&nbsp;</td>
                          <td><textarea name="town"><?php echo $account['town']?></textarea></td>
                        </tr>            
                        <tr valign="top">
                          <td class="main_title">Country<span class="red"> </span>&nbsp;</td>
                          <td><textarea name="country"><?php echo $account['country']?></textarea></td>
                        </tr>            
               
             			</table>
						</div>
                      </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><br><input type="submit" name="submit" value="UPDATE" onClick="return check();" ></td>
                    </tr>
                            
                    </table>
                  </form>
                </td>
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

<script language="javascript">
function findItem(n, d){
	
	var p,x,i;
	if(!d) d=document;
	if((p=n.indexOf("?"))>0&&parent.frames.length){
		
		d=parent.frames[n.substring(p+1)].document;
		n=n.substring(0,p);
	}

	if(!(x=d[n])&&d.all)
		x=d.all[n];
	for (i=0;!x&&i<d.forms.length;i++)
		x=d.forms[i][n];
	for(i=0;!x&&d.layers&&i<d.layers.length;i++)
		x=findItem(n,d.layers[i].document);
	return x;
}

function jumpmenu2(form,txtHint){
	
   var main_id=form.options[form.selectedIndex].value;
       if (window.XMLHttpRequest){
             http=new XMLHttpRequest();
       }else{
           http=new ActiveXObject("Microsoft.XMLHTTP");
       }
	   
	   var url = "getsubcat2.php";
	   var params = "main="+main_id;

       	http.open("POST", url, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.setRequestHeader("Content-length", params.length);
        http.setRequestHeader("Connection", "close");
        http.onreadystatechange = 
		
		function(){

	            if(http.readyState == 4 ){

					 document.getElementById(txtHint).innerHTML=http.responseText;
	            }
           }
        http.send(params);
}

function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit) // if too long...trim it!
			field.value = field.value.substring(0, maxlimit);
	else 
			countfield.value = maxlimit - field.value.length;
}
</script>
</body>
</html>