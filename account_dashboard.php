<?php 

include_once 'head.php';

if(empty($_SESSION['address'])){
    if(!empty($_SESSION['auth_user']['area']) && !empty($_SESSION['auth_user']['address'])){
        $_SESSION['address'] = 1;
        $_SESSION['area'] = $_SESSION['auth_user']['area'];
    }elseif(!empty($_SESSION['auth_user']['area2']) && !empty($_SESSION['auth_user']['address2'])){
        $_SESSION['address'] = 2;
        $_SESSION['area'] = $_SESSION['auth_user']['area2'];
    }
}




if($_POST['new_email'] && $_POST['old_email']){

    $_SESSION['session_msg'] = '<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
    style="position:relative; top:-2px;">×</a>
    Failed to change email, please try again.</div>';

    if($_POST['old_email'] != $_SESSION['auth_user']['email']){
        
        $_SESSION['session_msg'] = '<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
        style="position:relative; top:-2px;">×</a>
        Old email not match, please try again.</div>';

    }else{
 
        $email_available = sql_read('SELECT * FROM member WHERE id !=? AND email=? limit 1', 'ss', array($_SESSION['auth_user']['id'], $_POST['new_email']));

        if($email_available['id']){
            $_SESSION['session_msg'] = '<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
			style="position:relative; top:-2px;">×</a>
			Email is not available, please use other email.</div>';
        }else{
            $data = array();
            $data['id'] = $_SESSION['auth_user']['id'];
            $data['email'] = $_POST['new_email'];
            sql_save('member', $data);

			$_SESSION['session_msg'] = '<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
            Email changed successfully.</div>';
            $_SESSION['auth_user']['email'] = $_POST['new_email'];

        }
    }    
}



if($_POST['new_mobile'] && $_POST['old_mobile']){

    $_SESSION['session_msg'] = '<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
    style="position:relative; top:-2px;">×</a>
    Failed to change mobile, please try again.</div>';

    if($_POST['old_mobile'] != $_SESSION['auth_user']['mobile_number']){
        
        $_SESSION['session_msg'] = '<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
        style="position:relative; top:-2px;">×</a>
        Old mobile not match, please try again.</div>';

    }else{
 
        $data = array();
        $data['id'] = $_SESSION['auth_user']['id'];
        $data['mobile_number'] = $_POST['new_mobile'];
        sql_save('member', $data);

        $_SESSION['session_msg'] = '<div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
        Mobile changed successfully.</div>';
        $_SESSION['auth_user']['mobile_number'] = $_POST['new_mobile'];

        
    }    
}



if($_POST['new_password'] && $_POST['old_password']){

    $new_password = hash('md5',$_POST['new_password']);
    $old_password = hash('md5',$_POST['old_password']);

    $_SESSION['session_msg'] = '<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
    style="position:relative; top:-2px;">×</a>
    Failed to change password, please try again.</div>';
    
    if($old_password != $_SESSION['auth_user']['password']){
        
        $_SESSION['session_msg'] = '<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
        style="position:relative; top:-2px;">×</a>
        Old password not match, please try again.</div>';

    }else{
 
        $data = array();
        $data['id'] = $_SESSION['auth_user']['id'];
        $data['password'] = $new_password;
        sql_save('member', $data);

        $_SESSION['session_msg'] = '<div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
        Password changed successfully.</div>';
        $_SESSION['auth_user']['password'] = $new_password;
        
    }    
}



if($_POST['area'] && $_POST['address']){

    $_SESSION['session_msg'] = '<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
    style="position:relative; top:-2px;">×</a>
    Failed to change area & address, please try again.</div>';
 
    $data = array();
    $data['id'] = $_SESSION['auth_user']['id'];
    $data['area'] = $defender->encrypt('decrypt', $_POST['area']);
    $data['address'] = $_POST['address'];
    sql_save('member', $data);

    $_SESSION['session_msg'] = '<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
    Area & address changed successfully.</div>';
    $_SESSION['auth_user']['area'] = $data['area'];
    $_SESSION['auth_user']['address'] = $_POST['address'];
}

if($_POST['area2'] && $_POST['address2']){

    $_SESSION['session_msg'] = '<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
    style="position:relative; top:-2px;">×</a>
    Failed to change area & address, please try again.</div>';
 
    $data = array();
    $data['id'] = $_SESSION['auth_user']['id'];
    $data['area2'] = $defender->encrypt('decrypt', $_POST['area2']);
    $data['address2'] = $_POST['address2'];
    sql_save('member', $data);

    $_SESSION['session_msg'] = '<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
    Area & address changed successfully.</div>';
    $_SESSION['auth_user']['area2'] = $data['area2'];
    $_SESSION['auth_user']['address2'] = $_POST['address2'];
}

if($_SESSION['auth_user']){
    $user_area = sql_read('select area from area where id=? limit 1', 's', $_SESSION['auth_user']['area']);
    $user_area2 = sql_read('select area from area where id=? limit 1', 's', $_SESSION['auth_user']['area2']);
}

$banner = sql_read('select banner_dashboard from banner_dashboard where id=2 limit 1');



?>
<style>

.card-body .fa-envelope, .card-body .fa-phone, .card-body .fa-lock { font-size:180%; padding:8px 0;}


</style>

<html lang="en">


<body class="container-fluid">
    <!-- Navigation row start-->
    <?php include("nav.php");?>
    <!-- Navigation row end-->
    <div class="row mt-5">
        <div class="col mt-5 mt-sm-5 mt-md-1 mt-lg-1 mb-2 mb-sm-2 mb-md-1 mb-lg-1">

        </div>
    </div>


    <?php 
    if(!empty($_SESSION['auth_user']['id'])){
        
        $user = $_SESSION['auth_user'];
        ?>



    <!-- Back link-->
    <div class=" pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
        <div class="row mt-5 back-link pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">

            <div class="col-12 text-center mt-5 mt-sm-5 mt-md-1 mt-lg-1">
                Account Dashboard
            </div>

        </div>

        <!-- member dashboard icons -->
        <div class="row mt-4 pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card form-rounded pb-2">
                    <div class="card-body pl-md-3 pr-md-3 pl-lg-3 pr-lg-3 pt-md-5 pt-lg-5">
                        <div class="row pl-md-4 p-lg-4">
                            <div class="col-12 text-center pt-4">
                                <img class="logo" src="images/logo.png" alt="logo">
                                <p>Member ID : <?php echo sprintf("%04d", $user['id'])?></p>
                            </div>
                            <div class="col-12 text-center pt-md-5 pt-lg-5">
                                <p class="back-link">Welcome, <?php echo $user['name']?>
                                </p>
                                <p>Last login: <?php echo date('d M Y', strtotime($user['last_login']))?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="top-right">
                    <div class="hover_question" id="msg_trigger1">?</div>
                    <div class="hover_question_message" id="msg1">
                        You are able to use these amounts of rebate for your next purchase.
                    </div>
                </div>
                <div class="card  form-rounded">
                    <div class="card-body pl-3 pr-3">
                        <div class="row p-md-4 p-lg-4">
                            <div class="col-4 text-left">
                                <img class="img-fluid" src="images/Grocere_Points.png" alt="logo">
                            </div>
                            <div class="col-8 text-left">
                                <p class="text-muted">Rebate Balance</p>
                                <p class="back-link">RM <?php echo get_total_rebatible();?></p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="top-right">
                    <div class="hover_question" id="msg_trigger2">?</div>
                    <div class="hover_question_message" id="msg2">
                        You will earn rebates based on the current rate for every Ringgit spent.
                    </div>
                </div>
                <div class="card  form-rounded">
                    <div class="card-body pl-3 pr-3">
                        <div class="row p-md-4 p-lg-4">
                            <div class="col-4 text-left">
                                <img class="img-fluid" src="images/Grocere_Points_Rates.png" alt="logo">

                            </div>
                            <div class="col-8 text-left">
                                <p class="text-muted">Rebate Earning Rate</p>
                                <p class="back-link">1%</p>
                            </div>
                        </div>
                    </div>
                </div>


<script>
$('#msg_trigger1').mouseenter(function(){
    $('#msg1').fadeIn();
})
$('#msg_trigger1').mouseleave(function(){
    $('#msg1').fadeOut();
})
$('#msg_trigger2').mouseenter(function(){
    $('#msg2').fadeIn();
})
$('#msg_trigger2').mouseleave(function(){
    $('#msg2').fadeOut();
})
</script>

            </div>
        </div>

        <div class="row mt-4 pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card  form-rounded">
                    <div class="card-body pl-3 pr-3">
                        <div class="row pl-4 pr-4 pl-sm-4 pr-sm-4 pl-md-4 pr-md-4 pl-lg-4 pr-lg-4">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 checkout-label">
                                <p>Settings</p>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <p>Email Address: <?php echo $user['email']?></p>
                                <p>Mobile Number: <?php echo mobile_format($user['mobile_number'])?></p>
                                <br>
                            </div>

                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-2">
                                <a class="location-select" data-toggle="modal" data-target="#emailModal" href=#>
                                    <div class="card modal-edit-panel form-rounded">
                                        <div class="card-body pl-3 pr-3">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <i class="text-white fas fa-envelope fa-3x"></i>
                                                    <p class="text-white edit-panel">Change Email Address</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>

                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <a class="location-select" data-toggle="modal" data-target="#mobileModal" href=#>
                                    <div class="card modal-edit-panel form-rounded">
                                        <div class="card-body pl-3 pr-3">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <i class="text-white fas fa-phone fa-3x"></i>
                                                    <p class="text-white edit-panel">Change Mobile Number</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <a class="location-select" data-toggle="modal" data-target="#passwordModal" href=#>
                                    <div class="card modal-edit-panel form-rounded">
                                        <div class="card-body pl-3 pr-3">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <i class="text-white fas fa-lock fa-3x"></i>
                                                    <p class="text-white edit-panel">Change Password</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card  form-rounded">
                    <div class="card-body pl-3 pr-3">
                        <div class="row pl-4">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 checkout-label mb-1">Delivery Address</div>
                        </div>
                        <div class="row  pl-4 pr-4">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                                <div class="row checkout-address-in-use p-3 address-block-1">
                                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                                        <p><?php echo $user['address']?></p>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                        <button type="button"
                                            class="btn checkout-address-in-use-btn btn-block p-2 text-center change_address1">IN USE</button>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                                        <p>Area: <?php echo $user_area['area']?></p>
                                    </div>
                                    <div
                                        class="col-12 col-sm-12 col-md-3 col-lg-3 checkout-delivery-in-use-edit text-center edit-use">
                                        <a data-toggle="modal" data-target="#editProfileAddressModal" href=#>Edit</a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row checkout-address-not-in-use p-3 address-block-2">
                                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                                        <p><?php echo $user['address2']?></p>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                        <button type="button"
                                            class="btn checkout-address-not-in-use-btn btn-block p-2 text-center change_address2">USE THIS</button>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                                        <p>Area: <?php echo $user_area2['area']?></p>
                                    </div>
                                    <div
                                        class="col-12 col-sm-12 col-md-3 col-lg-3 checkout-delivery-not-in-use-edit text-center edit-use">
                                        <a data-toggle="modal" data-target="#editProfileAddressModal2" href=#>Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span id="session_delivery_method"></span>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card form-rounded">
                    <div class="card-body pl-3 pr-3">
                        <div class="row pl-1 pr-1 pl-sm-1 pr-sm-1 pl-md-3 pr-md-3 pl-lg-3 pr-lg-3">
                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 mb-4 text-center text-sm-center text-md-left text-lg-left pt-2">
                                <label class="summary-label" for="summary-dropdown">Summary For</label>
                            </div>
                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 mb-4 text-center text-sm-center text-md-left text-lg-left">

                                <select id="summary" name="summary" class="form-control summary-dropdown" onchange="myFunction(this.value)">
                                    <?php 
                                    $first_order = sql_read("select confirmed_date from orders where member=? and confirmed_date !='' order by id asc limit 1", 's', $_SESSION['auth_user']['id']);

                                    $start_date = date('Y-m-d', strtotime($first_order['confirmed_date']));
                                    $end_date = date('Y-m-d');
                                    while (strtotime($start_date) <= strtotime($end_date)){
                                        $v = substr($start_date,0,8);
                                        ?>
                                        <option value="<?php echo $v?>" <?php if($_GET['d']==$v) echo 'selected';?>>
                                            <?php echo substr($start_date,0,4).' '.date("F", mktime(0, 0, 0, substr($start_date,5,2), 10));?>
                                        </option>
                                        <?php $start_date = date ("Y-m-d", strtotime("+1 month", strtotime($start_date)));
                                    }?>
                                </select>

                                <script>
                                function myFunction(v){
                                    window.location.href = 'dashboard?d='+v;
                                }
                                </script>

                            </div>
                            <div class="col-12 mb-4">
                                <img class = "img-fluid" src="<?php echo $banner['banner_dashboard'];?>" alt="member"/>
                            </div>

                            <div class="col-12 table-height scrollable-table">
                                <table class="table table-collapse-phone">

                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <!--<th>Pts Used</th>-->
                                            <th>Total</th>
                                            <!--<th>Pts Earned</th>-->
                                            <th class="text-center">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $date_cond = date('Y-m-').'%';

                                        if($_GET['d']){
                                            $date_cond = $_GET['d'].'%';
                                        }

                                        $my_orders = sql_read('select * from orders where member=? and confirmed_date like ?', 'ss', array($_SESSION['auth_user']['id'], $date_cond));


                                        if(@count($my_orders)>0){
                                            foreach((array)$my_orders as $order){?>
                                            <tr>
                                                <td scope="row"
                                                    class="text-center text-sm-center text-md-left text-lg-left"><?php echo 'E'.sprintf("%06d", $order['id']); ?>
                                                </td>
                                                <td><span class="d-block d-md-none">Date: </span>
                                                    <?php echo date('d M Y', strtotime($order['confirmed_date']));?>
                                                </td>
                                                <!--
                                                <td><span class="d-block d-md-none">Rebate Used: </span><?php if($order['rebate_used']) echo 'RM '.$order['rebate_used'];?></td>-->
                                                <td><span class="d-block d-md-none">Total</span> 
                                                    <?php echo 'RM '.$order['total']?>
                                                </td>
                                                <!--
                                                <td><span class="d-block d-md-none">Rebate Earned</span><?php if($order['rebate_earned'] && $order['payment_status']=='Paid') echo 'RM '.$order['rebate_earned'];?></td>-->
                                                <td class="text-center">
                                                    <a href="the_order/<?php echo $defender->encrypt('encrypt', $order['id'])?>" target="_blank">View Order</a>
                                                </td>
                                            </tr>
                                            <?php 
                                            }
                                        }?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php }else{?>

        <div class="row">
            <div class="col-12 p-5 mt-5" style="height:400px;">
            
            Please login to view your account dashboard
            </div>
        </div>


    <?php }?>

    <?php include("modal/change_email_address.php");?>
    <?php include("modal/change_mobile.php");?>
    <?php include("modal/change_password.php");?>
    <?php include("modal/edit_address.php");?>
    <?php include("modal/edit_address2.php");?>

    <!--////////////////////////////////////////// Footer ////////////////////////////////////////////// -->
    <?php include("footer.php");?>
    <!--////////////////////////////////////////// Footer ////////////////////////////////////////////// -->

</body>

</html>

<?php if($_SESSION['address']==1){?>
    <script>
    $(document).ready(function(){
        $('.change_address1').click();
    })        
    </script>
<?php }else{?>
    <script>
    $(document).ready(function(){            
        $('.change_address2').click();
    })
    </script>
<?php }?>

<script>
$('.change_address1').click(function(){

    $.post('session_delivery_address.php', {address:"1"});

    $('.change_address1').text('IN USE');
    $('.change_address1').removeClass('checkout-address-not-in-use-btn');
    $('.change_address1').addClass('checkout-address-in-use-btn');
    $('.address-block-1').addClass('checkout-address-in-use');
    $('.address-block-1').removeClass('checkout-address-not-in-use');
    $('.address-block-1 .edit-use').addClass('checkout-delivery-in-use-edit');
    $('.address-block-1 .edit-use').removeClass('checkout-delivery-not-in-use-edit');

    $('.change_address2').text('USE THIS');
    $('.change_address2').removeClass('checkout-address-in-use-btn');
    $('.change_address2').addClass('checkout-address-not-in-use-btn');
    $('.address-block-2').addClass('checkout-address-not-in-use');
    $('.address-block-2').removeClass('checkout-address-in-use');
    $('.address-block-2 .edit-use').addClass('checkout-delivery-not-in-use-edit');
    $('.address-block-2 .edit-use').removeClass('checkout-delivery-in-use-edit');
})
$('.change_address2').click(function(){

    $.post('session_delivery_address.php', {address:"2"});
   
    $('.change_address2').text('IN USE');
    $('.change_address2').removeClass('checkout-address-not-in-use-btn');
    $('.change_address2').addClass('checkout-address-in-use-btn');
    $('.address-block-2').addClass('checkout-address-in-use');
    $('.address-block-2').removeClass('checkout-address-not-in-use');
    $('.address-block-2 .edit-use').addClass('checkout-delivery-in-use-edit');
    $('.address-block-2 .edit-use').removeClass('checkout-delivery-not-in-use-edit');

    $('.change_address1').text('USE THIS');
    $('.change_address1').removeClass('checkout-address-in-use-btn');
    $('.change_address1').addClass('checkout-address-not-in-use-btn');
    $('.address-block-1').addClass('checkout-address-not-in-use');
    $('.address-block-1').removeClass('checkout-address-in-use');  
    $('.address-block-1 .edit-use').addClass('checkout-delivery-not-in-use-edit');
    $('.address-block-1 .edit-use').removeClass('checkout-delivery-in-use-edit');
})
</script>
