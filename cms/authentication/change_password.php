<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}
?>
<style>
.table th, .table td { border-top:none;}

</style>

</head>

<body>

<div class="row">
  <div class="col-12">

    <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table "><!--table-striped-->
      <tr>
          <td colspan="2" class=""><h3>Change Username & Password</h3></td>
      </tr>
          <tr>
            <td class="border_background_no_color">
  <table width="50%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td align="left"><Form METHOD="post" ACTION="change_password">
                <span class="red">*Indicate Required Fields</span>
                
                <table border="0" cellpadding="0" cellspacing="0" width="100%" id="form">
                  <tr>
                    <td class="main_title" width="40%"><div align="left"><span class="red">*</span> <span class="content">Current Username:</span></div></td>
                    <td align="left"><INPUT TYPE="email" NAME="user_name1" VALUE="" SIZE=50 MAXLENGTH=50 autocomplete="off"></td>
                  </tr>              
                  <tr>
                    <td class="main_title"><div align="left"><span class="red">*</span> <span class="content">Current Password:</span></div></td>
                    <td align="left"><INPUT TYPE="password" NAME="OldPassword" VALUE="" SIZE=20 MAXLENGTH=20 autocomplete="off">
                        <input type=hidden name=s value=a></td>
                  </tr>
                  <tr><td><br></td></tr>
                  <tr>
                    <td class="main_title"><div align="left"><span class="red">*</span> <span class="content">New Username:</span></div></td>
                    <td align="left"><INPUT TYPE="email" NAME="user_name" VALUE="" SIZE=50 MAXLENGTH=50></td>
                  </tr> 
                  
                  <tr>
                    <td class="main_title"><div align="left"><font class="red">*</font> <span class="content">New Password:</span></div></td>
                    <td align="left"><INPUT TYPE="password" NAME="NewPassword" VALUE="" SIZE=20 MAXLENGTH=20  autocomplete="off">
                    </td>
                  </tr>
                  <tr>
                    <td class="main_title"><div align="left"><span class="red">*</span> <span class="content">Re-enter Password:</span></div></td>
                    <td align="left"><INPUT TYPE="password" NAME="ComfirmPassword" VALUE="" SIZE=20 MAXLENGTH=20  autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
                    Must contain number, uppercase, lowercase & minimum 6 characters. </td>
                  </tr>
                </table>
                <br>
                <div class="font12" align="left">
                  <p>
                    <input class="content"type="submit" name="Change" value=" Save ">
                    <input class="content"type="reset" name="Reset" value=" Reset ">
              </p>
                </div>
            </form>
            </td>
          </tr>
          <tr>
            <td>
              <?php


      $oldname=mysqli_real_escape_string($conn, $_POST['user_name1']);
      $oldpass=hash('md5',mysqli_real_escape_string($conn, $_POST['OldPassword']));
      $newpass=$_POST['NewPassword'];
      $newusername= $_POST['user_name'];
      $comfirmpass=$_POST['ComfirmPassword']; 
      $sql="SELECT password FROM login WHERE password='".$oldpass."' and username='".$oldname."' ";
      $Result1 = mysqli_query($conn, $sql) or die(mysqli_error());	  
      $r=mysqli_fetch_assoc($Result1);
      
      $username_query = '';
      if(!empty($_POST['user_name'])){
        $username_query = ", username='$newusername' ";
      }

      
      $stat='no';
      if ($_POST['s']<>'')$stat='yes';
      if($r['password']==$oldpass){
            if($newpass==$comfirmpass && $newpass!="" && $comfirmpass!="" && $stat=='yes' )
                    {?>
              <?php $insertSQL = "UPDATE login SET password='".hash('md5',$newpass)."' $username_query WHERE password='$oldpass'";
                              mysqli_select_db($conn, $database_conn);
                              $Result1 = mysqli_query($conn, $insertSQL) or die(mysqli_error());	  
                          ?>
              <h3 align="center" class="content" style="color:#060;"><strong> Password Update Successfully </strong></h3>
              <?php $stat='yes';}//correct 1
                        else if($newpass==$comfirmpass && ($newpass=="" || $comfirmpass=="")  && $stat=='yes')
                    {?>
              <h3 align="center" class="content" style="color:red;"><strong> No Blank Password is Allowed </strong></h3>
              <?php }//correct 2
                        else if ($newpass <> $confirmpass && $stat=='yes')
                    {?>
              <h3 align="center" class="content" style="color:red;"><strong> New Password Is Not Match The Re-Entered Password </strong></h3>
              <?php }//correct 3
          } elseif (!empty($_POST)){?>
              <h3 align="center" class="content" style="color:red;"><strong> Current Existing Password Is Not Correct </strong></h3>
              <?php } ?>
            </td>
          </tr>
        </table>
        </td>
      </tr>
    </table>


  </div>
</div>

</body>
</html>