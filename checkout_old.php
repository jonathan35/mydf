<?php 
include_once 'head.php';

include 'post_address.php';

$must_be_tomorrow = false;
$session_date = $_SESSION['delivery_date'];
$today_date = date('Y-m-d');
$tomorrow_date = date('Y-m-d', strtotime($today_date.' +1 day'));
if(empty($_SESSION['address'])) $_SESSION['address'] = 1;
if(empty($_SESSION['area'])){
    if($_SESSION['address'] == 1){
        $_SESSION['area'] = $_SESSION['auth_user']['area'];
    }elseif($_SESSION['address'] == 2){
        $_SESSION['area'] = $_SESSION['auth_user']['area'];
    }
}


$auth_user = sql_read('select * from member where id=? limit 1', 's', $_SESSION['auth_user']['id']);
$user_area = sql_read('select area from area where id=? limit 1', 's', $auth_user['area']);
$user_area2 = sql_read('select area from area where id=? limit 1', 's', $auth_user['area2']);

?>

<html lang="en">
<body class="container-fluid">
    <!-- Navigation row start-->
    <?php include("nav.php");?>
    <!-- Navigation row end-->
    <div class="row mt-5">
        <div class="col mt-5 mt-sm-5 mt-md-1 mt-lg-1 mb-2 mb-sm-2 mb-md-1 mb-lg-1">

        </div>
    </div>

    <!-- Back link-->
    <div class="pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
        <div class="row mt-5 back-link pl-lg-5 pr-lg-5 pl-md-5 pr-md-5 ">
            <a href="shopping">
                <div class="col-12 mt-5 mt-sm-5 mt-md-1 mt-lg-1">
                    <i class="fas fa-arrow-left"></i> Back
                </div>
            </a>
        </div>

        <div class="row mt-4 pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 ">
                <div class="card form-rounded">
                    <div class="card-body pl-md-3 pr-md-3 pl-lg-3 pr-lg-3">

                        <!-- Delivery or In store Pick Up availability status -->
                        <div class="row p-md-4 p-lg-4">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-left">
                                <p class="card-header-title">
                                    <?php if($_SESSION['delivery_method'] == 'pickup') echo 'In-Store PickUp'; else echo 'Delivery';?>
                                </p>
                            </div>
                            <div class="col-1 text-left pr-0" >

                                <?php 
                                $hour_now = date('H');
                                
                                if($_SESSION['delivery_method'] == 'deliver'){
                                    if($hour_now<14){//before 2pm?>
                                        <img class="img-fluid" src="images/green-truck.png" alt="truck" />
                                    <?php }else{?>
                                        <img class="img-fluid" src="images/red-truck.png" alt="truck" />
                                    <?php }?>
                                <?php }?>

                                <?php if($_SESSION['delivery_method'] == 'pickup'){
                                    if($hour_now<18){//before 6pm?>
                                        <img class="img-fluid" src="images/green-clock.png" alt="clock" />
                                    <?php }else{?>
                                        <img class="img-fluid" src="images/red-clock.png" alt="clock" />
                                    <?php }?>
                                <?php }?>
                            </div>
                            <div class="col-7 text-left pl-4">
                                <?php 
                                $hour_now = date('H');
                                
                                if($_SESSION['delivery_method'] == 'deliver'){
                                    if($hour_now<14){//before 2pm?>
                                        <p class="pt-lg-4 pt-md-4">Your order are eligible for Delivery Today</p>
                                    <?php }else{?>
                                        <p>Your order are not eligible for delivery today.<br /><br />We will deliver your order by tomorrow.<br />
                                            Our delivery time: 8:00 AM - 4:00 PM</p>
                                    <?php }?>
                                <?php }?>


                                <?php if($_SESSION['delivery_method'] == 'pickup'){
                                    if($hour_now<18){//before 6pm?>
                                        <p class="pt-lg-4 pt-md-4">Your order are eligible for Pick Up Today</p>
                                    <?php }else{?>                                        
                                        <p>Your order are not eligible for Pick Up today.<br/><br/>Our Same-Day Pickup only available for order before 8:00PM.
                                        <br/>Outlet opening hours : 7:00 AM - 9:30 PM (Mon - Sat)</p> 
                                    <?php }?>
                                <?php }?>


                            </div>
                        </div>
                        <!-- Select Delivery Day options today or tomorrow system detects-->
                        <div class="row p-md-4 p-lg-4">


                        <?php 
                        if(
                                ($_SESSION['delivery_method'] == 'deliver' && $hour_now>=14) || 
                                ($_SESSION['delivery_method'] == 'pickup' && $hour_now>=18)
                        ){
                            $must_be_tomorrow = true;
                            $_SESSION['delivery_date'] = date('Y-m-d', strtotime(date('Y-m-d').' +1 day'));
                        }?>

                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 checkout-label">Select Delivery Day</div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-center mb-2">
                                <button type="button" class="btn shipping-btn btn-block p-3 navigator <?php if($must_be_tomorrow ){?>shipping-btn-disabled<?php }?> <?php if($session_date == $today_date ){?>shipping-set<?php }?>" 
                                <?php if(!$must_be_tomorrow){?>nav-target="#set-delivery-date" nav-link="session_delivery_date.php" nav-post='{"delivery_date":"today"}'<?php }?>>Today</button>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-center mb-2">
                                <button type="button" class="btn shipping-btn btn-block p-3 navigator <?php if($must_be_tomorrow || $session_date == $tomorrow_date){?>shipping-set<?php }?>" 
                                <?php if(!$must_be_tomorrow){?>nav-target="#set-delivery-date" nav-link="session_delivery_date.php" nav-post='{"delivery_date":"tomorrow"}'<?php }?>>Tomorrow</button>
                            </div>

                            <span id="set-delivery-date"></span>

                            <?php if(!$must_be_tomorrow){?>
                            <script>
                            $('.shipping-btn').click(function(){
                                $('.shipping-btn').removeClass('shipping-set');
                                $(this).addClass('shipping-set');
                            })
                            </script>
                            <?php }?>

                        </div>

                        <div class="row p-md-4 p-lg-4 p-2 p-sm-2">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 checkout-label">Select Delivery Address</div>
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4 p-3 p-sm-3">
                                <div class="row checkout-address-in-use address-block-1 pt-3 pb-3" id="display_address">
                                
                                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                                        <p><?php echo $auth_user['address']?></p>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                        <button type="button"
                                            class="btn checkout-address-in-use-btn btn-block p-2 text-center change_address1 navigator" nav-target="#checkout_summary" 
                                            <?php if(!empty($auth_user['area']) && !empty($auth_user['address'])){?>nav-link="checkout_summary.php" nav-post='{"address":"1"}' <?php }else{ echo 'disabled';}?>>IN USE</button>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                                        <p>Area: <?php echo $user_area['area'];?></p>
                                    </div>
                                    <div
                                        class="col-12 col-sm-12 col-md-3 col-lg-3 checkout-delivery-in-use-edit text-center edit-use">
                                        <a data-toggle="modal" data-target="#editAddressModal" href=#>Edit</a>
                                    </div>
                                </div>

                            </div>
                            <div class="offset-lg-4 offset-md-4 col-12 col-sm-12 col-md-8 col-lg-8 p-3 p-sm-3">
                                <div class="row checkout-address-not-in-use address-block-2 pt-3 pb-3" id="display_address2">
                                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                                        <p><?php echo $auth_user['address2']?></p>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                        <button type="button"
                        class="btn checkout-address-not-in-use-btn btn-block p-2 text-center change_address2 navigator" <?php if(!empty($auth_user['area2']) && !empty($auth_user['address2'])){?>nav-target="#checkout_summary" nav-link="checkout_summary.php" nav-post='{"address":"2"}' <?php }else{ echo 'disabled';}?>>USE THIS</button>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                                        <p>Area: <?php echo $user_area2['area'];?></p>
                                    </div>
                                    <div
                                        class="col-12 col-sm-12 col-md-3 col-lg-3 checkout-delivery-not-in-use-edit text-center edit-use ">
                                        <a data-toggle="modal" data-target="#editAddressModal2" href=# >Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 col-lg-4" id="checkout_summary">
                <?php include 'checkout_summary.php';?>
            </div>
            
        </div>

    </div>

    <?php /*if($_SESSION['address']==1){?>
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
    <?php }*/?>


    <script>
    $('.change_address1').click(function(){

        $('#checkout_summary').load('checkout_summary.php');

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

        $('#checkout_summary').load('checkout_summary.php');

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



    <!--////////////////////////////////////////// Footer ////////////////////////////////////////////// -->
    <?php include("footer.php");?>
    <!--////////////////////////////////////////// Footer ////////////////////////////////////////////// -->

</body>

</html>