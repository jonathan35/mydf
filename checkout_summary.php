<?php
require_once 'config/ini.php';
include_once 'head.php';


if($_POST['address'] == '1'){
    $_SESSION['address'] = 1;
    $_SESSION['area'] = $_SESSION['auth_user']['area'];
}elseif($_POST['address'] == '2'){
    $_SESSION['address'] = 2;
    $_SESSION['area'] = $_SESSION['auth_user']['area2'];
}elseif(empty($_SESSION['address'])){
    if(!empty($_SESSION['auth_user']['area']) && !empty($_SESSION['auth_user']['address'])){
        $_SESSION['address'] = 1;
        $_SESSION['area'] = $_SESSION['auth_user']['area'];
    }elseif(!empty($_SESSION['auth_user']['area2']) && !empty($_SESSION['auth_user']['address2'])){
        $_SESSION['address'] = 2;
        $_SESSION['area'] = $_SESSION['auth_user']['area2'];
    }
}



if($_POST['r']){
    if($_POST['r'] == '1'){
        $_SESSION['rebate'] = 'yes';
    }else{
        unset($_SESSION['rebate']);
    }
}

$final_total = 0;
$item_total = item_total();
//$final_rebatible = get_checkout_rebatible($items, get_total_rebatible());
$final_rebatible = $lps_merchant->get_redeemable_point($item_total);
$shipping_fee = shipping_fee($item_total);
$final_total = final_total($item_total, $shipping_fee, $final_rebatible);

?>

<script>
$('#cart_summary').load('cart_summary.php');
</script>

<div class="card form-rounded pl-3 pr-3 pl-sm-3 pr-sm-3 pl-md-3 pr-md-3 pl-lg-3 pr-lg-3">
                    
    <div class="row points-balance-row text-center p-4">
        <div class="col-12">
            <?php if($final_rebatible>0){?>
            <p class="points-balance-title">LOYALTY POINTS</p>
            <p class="points-balance-number"><?php echo $final_rebatible?><span style="font-size:50%;">pt</span></p>
            
            <div>
                <p class="signup-label">Use to rebates</p>
                <? /*<label class="switch">
                    <input type="checkbox" id="onoff" <?php if($_SESSION['rebate'] == 'yes'){?>checked<?php }?>>
                    <span class="slider round"></span>
                </label>*/?>

                <?php $lps_merchant->redeemable_switch($item_total);?>
            </div>
            <?php }else{?>
                <p class="points-balance-title">Order to gain rebate for your next purchase</p>
            <?php }?>
        </div>
    </div>
    <div class="card-body pl-md-3 pr-md-3 pl-lg-3 pr-lg-3">

        <div class="row p-md-4 p-lg-4">
            <div class="col-12 text-left">
                <p class="card-header-title">Summary</p>
            </div>
            <div class="col-6 text-left summary-total">
                <p>Subtotal</p>
            </div>
            <div class="col-6 text-right summary-total">
                <p>RM <?php echo $item_total?></p>
            </div>
            <?php if($shipping_fee>0){?>
                <div class="col-6 text-left summary-total">
                    <p>Shipping</p>
                </div>
                <div class="col-6 text-right summary-total">
                    <p>RM <span class="delivery_fee"><?php echo $shipping_fee?></span></p>
                </div>
            <?php }?>
            
            <span id="points-used" style="width:100%; display:<?php if($_SESSION['rebate'] == 'yes') echo 'flex'; else echo 'none';?>;">
                <div class="col-6 text-left points-used">
                    <p>Rebate Amount</p>
                </div>
                <div class="col-6 text-right points-used">
                    <p>- RM <?php echo $final_rebatible?></p>
                </div>
            </span>     
            <script>            
            $('#onoff').change(function(){
                if(document.getElementById('onoff').checked) {         
                    $.post('checkout_summary.php', {r:'1'}).done(function (data) {
                        $('#checkout_summary').html(data);
                    });
                }else{        
                    $.post('checkout_summary.php', {r:'2'}).done(function (data) {
                        $('#checkout_summary').html(data);
                    });
                }
            })        
            </script>
        </div>
        <div class="row p-4">
            <div class="col-6 text-left summary-total">
                <p>Total</p>
            </div>
            <div class="col-6 text-right summary-total">
                <p>RM <span id="final-total" class="lps_redeemed_total">
                <?php echo number_format($final_total,2,'.',',')?>
                </span></p>
            </div>
        </div>
    </div>
                    
</div>
<div class="col-12 text-center mt-3 p-0 pt-1">
    <?php 
    
    $allowed = false;
    
    if($_SESSION['area']){
        if($_SESSION['address'] == 1 && !empty($_SESSION['auth_user']['address'])){
            $allowed = true;
        }elseif($_SESSION['address'] == 2 && !empty($_SESSION['auth_user']['address2'])){
            $allowed = true;
        }
    }

    if(!$_POST['pay_now']){?>
        <form action="" method="post" enctype="multipart/form-data">
            <button type="submit" name="pay_now" value="pay_now" class="btn confirm-btn btn-block p-4" <?php if(!$allowed) echo 'onclick="validate_area_address();"';?>>PAY NOW</button>
        </form>
    
    <?php 
    }else{
        
               
        include 'create_order.php';

        if($ordered == true && !empty($order['id'])){

            $gateway = sql_read('select * from payment_gateway where id=1 limit 1');
            
            if($gateway['para1'] == 'eghl'){
                include 'payment_eghl.php';
            }elseif($gateway['para1'] == 'paypal'){
                include 'payment_paypal.php';
            }else{
                echo 'No payment option available.';
            }
            
            ?>

            <script>
            $(document).ready(function(){
                $('#pay_eghl').click();
            })

            </script>

        <?php 
        }
    }?>
    <!--data-toggle="modal" data-target="#alertPointsModal" -->
</div>


<script>
function validate_area_address(){
    event.preventDefault();
    alert('Please provide address and area');
}
</script>