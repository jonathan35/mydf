<?php
require_once 'config/ini.php';
require_once 'config/security.php';

$_GET['r'] = $defender->encrypt('decrypt',$_POST['region']);

require_once 'head.php';

?>
<div class="card login-panel form-rounded">
    <div class="card-body pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
        <div class="row p-4">
            <div class="col-12 text-center mb-4">
                <p class="login-title h1 text-white">Create Account</p>
            </div>
            <form id="signup_form" action="" method="post" enctype="multipart/form-data" style="width:100%;">
                <input type="hidden" name="action" value="signup">
                <div class="col-12 form-group mb-4">
                    <label class="signup-label" for="rc-name">Full Name</label>
                    <input type="text" class="signup-input form-control p-3 rc-required" id="rc-name" name="name" value="<?php echo $_REQUEST['name']?>" placeholder="Name" required>
                </div>
                <div class="col-12 form-group mb-4">
                    <label class="signup-label" for="rc-email">Email Address</label>
                    <input type="email" class="signup-input form-control p-3 rc-required" id="rc-email" name="email" value="<?php echo $_REQUEST['email']?>" placeholder="Email" required>
                </div>
                <div class="col-12 form-group mb-4">
                    <label class="signup-label" for="rc-mobile">Mobile Number (MY)</label>
                    <input type="text" class="signup-input form-control p-3 rc-required" id="rc-mobile" name="mobile" value="<?php echo $_REQUEST['mobile']?>" placeholder="Mobile">
                </div>
                <div class="col-12 form-group mb-4">
                    <label class="signup-label" for="rc-password">Password</label>
                    <input type="password" class="signup-input form-control p-3 rc-required" id="rc-password" name="password"
                        placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
                    <div class="text-muted" style="font-size:12px;">
                    Must contain number, uppercase, lowercase & minimum 6 characters.
                    </div>
                </div>
                <div class="col-12 form-group mb-4">
                    <label class="signup-label" for="rc-confirm-password">Confirm Password</label>
                    <input type="password" class="signup-input form-control p-3 rc-required" id="rc-confirm-password"
                        name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <div class="col-12 form-group mb-4">
                    <label class="signup-label" for="rc-region">Region</label>
                    <select id="rc-region" name="region" class="form-control signup-input parent-filter-child" required>
                        <option selected disabled hidden>Select Region</option>
                        <?php foreach((array)$regions as $region){?>
                            <option value="<?php echo $defender->encrypt('encrypt',$region['id'])?>" <?php if($_SESSION['region'] == $region['id'] || $_REQUEST['region'] == $region['id']){?>selected<?php }?>><?php echo $region['region']?></option>
                        <?php }?> 
                    </select>
                </div>
                <div class="row" id="change_region" style="display:none;">
                    <div class="col-3 col-sm-3 col-md-2 col-lg-2 form-group">                        
                        <i class="alert-icon fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="col-9 col-sm-9 col-md-10 col-lg-10 form-group mb-4">
                        <p class="notification-alert">You have selected a different region,
                            your cart will be emptied.</p>
                    </div>
                </div>
                <div class="col-12 form-group mb-4">
                    <label class="signup-label" for="rc-area">Area</label>
                    <select id="rc-area" name="area" class="form-control signup-input">
                        <option selected disabled hidden>Select Area</option>
                        <?php foreach((array)$areas as $area){?>
                            <option value="<?php echo $defender->encrypt('encrypt',$area['id'])?>" 
                        parent-name="region" parent-value="<?php echo $defender->encrypt('encrypt',$area['region'])?>" <?php if($_REQUEST['area'] == $area['id']){?>selected<?php }?>><?php echo $area['area']?></option>
                        <?php }?>
                    </select>
                </div>



                <div class="col-12 form-group mb-4">
                    <label class="signup-label" for="rc-delivery1">Delivery Address</label>
                    <textarea class="form-control signup-input" id="delivery1" name="address" rows="3" required><?php echo $_REQUEST['address']?></textarea>
                </div>

                <div class="col-12 form-check mb-4">
                    <input type="checkbox" class="signup-label" id="rc-terms-check" name="terms" required>
                    <label class="form-check-label text-white" for="rc-terms-check">I agree to the Terms
                        of Use and Privacy Policy</label>
                </div>

                <div class="col-12 text-center form-group">
                    <button id="btn-signup" type="submit" value="signup-submit" class="btn login-btn btn-block p-3"><span
                        class="center-word">CREATE</span></button>
                </div>

            </form>

            <div class="col-12 text-center create-account form-group">
                <a class="nav-fade" nav-target="#right_column" nav-link="cart_login.php">Login</a>                
                <!--data-toggle="modal" data-target="#loginModal" href=#-->
            </div>
        </div>
    </div>
</div>

<?php include("modal/alert_modal.php"); ?>


<script src="js/functions.jquery.js"></script>


<script>
/* -------------------- Change region trigger clear cart  ---------------------------- */

function prepare_modal(){
    
    var ses_region = '<?php echo $defender->encrypt('encrypt',$_SESSION['region'])?>';
    var changed_region = $("#rc-region").find(":selected").attr('value');
    
    if(changed_region != ses_region){

        //alert(document.getElementById('#rc-password').value);

        $('#change_region').fadeIn();
        
        var name = $('#rc-name').val();
        var email = $('#rc-email').val();
        var password = $('#rc-password').val();
        var passwordc = $('#rc-confirm-password').val();

        var terms = '';
        if($('#rc-terms-check').is(':checked')){
            terms = '1';
        }
        
        if(name !='' && email !='' && terms !='' && password !='' && password == passwordc){
            insert_modal();
        }else{
            remove_modal();
        }
    }else{
        $('#change_region').fadeOut();
        remove_modal();
    }

}

function remove_modal(){
    $("#btn-signup").removeAttr('data-toggle');
    $("#btn-signup").removeAttr('data-target');
    $("#btn-signup").removeAttr('onclick');
}

function insert_modal(){
    //$("#btn-signup").attr('data-toggle', 'modal');
    //$("#btn-signup").attr('data-target', '#alertModal');
    $("#btn-signup").attr('onclick', 'event.preventDefault()');
}

$("#rc-region").change(function(){          prepare_modal();})
$(".rc-required").keyup(function(){         prepare_modal();})
$("#rc-terms-check").change(function(){     prepare_modal();}) /*alert();*/  

$("#yes_signup_form").click(function(){
    $("#signup_form").attr('action', 'empty_cart');
    $("#signup_form").submit();
})


 /*
$('#btn-signup').click(function(){
    var modal = $('#btn-signup').attr('data-toggle');
    alert(modal);
   
    if(modal !=''){
        event.preventDefault();
    }

})*/

</script>
