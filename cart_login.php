<div class="card login-panel form-rounded">
    <div class="card-body pl-lg-4 pr-lg-4 pl-md-5 pr-md-5">
        <div class="row p-4">
            <div class="col-12 text-center mb-4">
                <p class="login-title">Please login to continue</p>
            </div>
            <div class="col-12 text-center">
                <p class="login-title display-4 text-white">Login</p>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center mb-2 p-0">
                <?php include 'facebook_login.php';?>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center mb-2">
                <!--<button type="button" class="btn google-btn bg-white btn-block p-2"><i class="fab fa-google fa-2x"></i> <span class="center-word">Google</span></button>-->
                <?php include 'google_login.php';?>
            </div>
            <div class="col-12 text-center mt-2 mb-2">
                <p class="text-white text-large">Or</p>
            </div>


            <form action="" method="post" enctype="multipart/form-data" style="width:100%;">
                <input type="hidden" name="action" value="signin">
                <div class="col-12 text-center form-group">
                    <input name="email" type="email" class="login-input form-control p-3" name= "email" id="email" placeholder="Email Address">
                </div>
                <div class="col-12 text-center form-group mb-5">
                    <input type="password" class="login-input form-control p-3" id="password" name= "password" placeholder="Password">
                <small id="forget-password" class="form-text text-muted text-right"><div class="hyperlink" data-toggle="modal" data-target="#forgetPasswordModal" data-dismiss="modal">Forget Password</div></small>
                </div>                

                <div class="col-12 text-center form-group">
                    <button type="submit" value="login-submit" class="btn login-btn btn-block p-3 ajax_submit"><i class="fas fa-user"></i> <span class="center-word">LOGIN</span></button>
                </div>
            </form>

            <div class="col-12 text-center create-account form-group">
            <a class="nav-fade" nav-target="#right_column" nav-link="cart_signup.php" >Create Account</a>   
            </div>
        </div>
    </div>
</div>
<script src="js/functions.jquery.js"></script>

