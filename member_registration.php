<?php
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';



if($_POST['action'] == 'signup' && !empty($_SESSION['auth_user']['id'])){
  
    if($_SESSION['auth_user']['region']){
        $_SESSION['region'] = $_SESSION['auth_user']['region'];
    }

    header("Location: home");
}

?>

<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">


    <script src="js/jquery-3.4.1.js"></script>
    
    <?php include_once 'head.php';?>

    <link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap-4.3.1.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ROOT?>css/pink-shadow.css" type="text/css">
    <!--<link rel="stylesheet" href="<?php echo ROOT?>css/animate.css" type="text/css">-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet"> 
    

</head>
<body style="background-image:url('images/signup-bg.png'); background-size:cover; background-position:center; min-height:100vh;">
<div class="row d-flex align-items-center pl-md-5 pr-md-5">

    <div class="row">
        <div class="col-12 p-5">
            <div class="row back-link pl-lg-5 pr-lg-5 pl-md-5 pr-md-5 ">
                <a href="home">
                    <div class="col-12" style="color:white;">
                        <i class="fas fa-arrow-left"></i> Back
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="d-none d-md-block col-md-4 p-md-5">
            <img src="images/signup_design.png" class="img-responsive" alt="" style="width:95%">
            <div style="color:white; text-align:center; font-size:24px; font-weight:bold;">
            FRESH PRODUCE<br>DELIVER TO YOUR HOME
            </div>
        </div>
        <div class="col-12 col-md-8 p-md-5">
            <div class="block-round bg-white">
                <h1 class="text-center pb-4">Create Account</h1>
                <div class="row">
                    <div class="col-12">
                        <form action="" method="post" enctype="multipart/form-data" class="form-pink-shadow">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            Full name
                                            <input name="name" type="text" class="form-group" required>
                                        </div>
                                        <div class="col-12">
                                            Email
                                            <input name="email" type="email" class="form-group" required>
                                        </div>
                                        <div class="col-12">
                                            Mobile Number (MY)
                                            <div class="row">
                                                <div class="col-2" style="padding-right:0;">
                                                    <div style="padding:7px 0; width:100%; height:36px; border-radius:10px; background:#555; color:white; text-align:center; ">+6</div>
                                                </div>
                                                <div class="col-10" style="padding-left:6px;">
                                                    <input name="mobile" type="number" class="form-group" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            Password
                                            <input name="password" type="password" class="form-group" id="password_register" required autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" >
                                            <div class="password_text_toggle" for="#password_register"></div>
                                            <div class="text-muted" style="font-size:12px; top:-14px; position:relative;">
                                            Must contain number, uppercase, one lowercase & minimum 6 characters.
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            Confirm Password
                                            <input name="confirm_password" type="password" class="form-group" required autocomplete="off" id="confirm_password_register">
                                            <div class="password_text_toggle" for="#confirm_password_register"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <?php $regions = sql_read('SELECT * FROM region WHERE status=? ORDER BY position ASC, region ASC', 's', 1);?>                           
                                    <div>
                                        Region
                                        <select name="region" class="form-group parent-filter-child" required>
                                            <option value="">Select Region</option>
                                            <?php foreach((array)$regions as $reg){?>
                                                <option value="<?php echo $defender->encrypt('encrypt',$reg['id'])?>"><?php echo $reg['region']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <?php $areas = sql_read('SELECT * FROM area WHERE status=? ORDER BY position ASC, area ASC', 's', 1);?>
                                    <div>
                                        Area
                                        <select name="area" class="form-group" required>
                                            <option value="">Select Area</option>
                                            <?php foreach((array)$areas as $area){?>
                                                <option value="<?php echo $defender->encrypt('encrypt',$area['id'])?>" parent-name="region" parent-value="<?php echo $defender->encrypt('encrypt',$area['region'])?>"><?php echo $area['area']?></option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <div>
                                        Delivery Address
                                        <textarea name="address" class="form-group" required></textarea>
                                    </div>

                                    <div style="align-items: start; display:flex; padding:6px;">
                                        <input type="checkbox" id="tc" name="tc" value="tc" required >
                                        <label for="tc" style="font-size:14px; width:calc(100% - 40px); padding: 8px; margin-top:-12px;">I agree to the <a href="page?i=NG1NYnNKckw4QzRhOGhkT0M5NXNMUT09" target="_blank">Privacy Policy</a>, <a><a href="page?i=eEdKY0RXYW8zR3pUZCt4OUVvVi9vUT09" target="_blank">Terms and Conditions</a>. </label>
                                    </div>
                                </div>
                            </div>                        
                            <div style="text-align: center; padding-top:30px;">
                                <input type="hidden" name="action" value="signup">
                                <input type="submit" name="signup" value="CREATE" style="font-size:16px;">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


<script src="js/functions.jquery.js"></script>
<?php include_once 'config/session_msg.php';?>