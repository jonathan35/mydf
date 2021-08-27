<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title></title>
    <meta name="image" content="">
    <meta property="og:image" content="">
    <meta name="description" content="">
    <meta property="og:type" content="website">
    <meta name="keywords" content="">
    <meta name="title" content="">

    <!--<meta name="google-site-verification" content="8x20fx1TVCtFILgWG_OC1o_mT33lRqUYKwri7lj3JFI" />-->
</head>

<body>
<div class="row">
    <div class="col-12 col-md-4 offset-md-4 p-5 mt-5">        
        <h2>Sign in</h2>
        <?php //include 'facebook_login.php';?>
        <?php //include 'google_login.php';?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="signin">
            <?php if($result){echo $result;}?>     
            <input type="email" name="email" class="form-control" placeholder="Email Address" required="">
            <br>
            <input type="password" name="password" class="form-control"  placeholder="Password" required="">
            <br>            
            <input type="submit" name="signin" value="Login" class="btn btn-success" style="min-width:90px; padding:22px 30px;">
        </form>
    </div>    
</div>
</body>
</html>
