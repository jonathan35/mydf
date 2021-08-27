<?php 
include_once 'head.php';

$total = item_total();


$_SESSION['delivery_method'] = 'deliver';

?>
<div class="card form-rounded" id="summary_panel" data-exist="yes">
    <div class="card-body pl-md-3 pr-md-3 pl-lg-3 pr-lg-3">
        <div class="row p-md-4 p-lg-4">
            <div class="col-12 text-left">
                <p class="card-header-title">Summary</p>
            </div>
            <div class="col-6 text-left summary-total">
                <p>Subtotal</p>
            </div>
            <div class="col-6 text-right summary-total">
                <p>RM 
                    <?php echo $total;?>
                </p>
            </div>
        </div>
        <div class="row p-md-4 p-lg-4">
            <div class="col-12 text-left">
                <p class="card-header-title">Shipping</p>
            </div>
            <div class="col-12 text-left summary-total">
                <p>We deliver our items to these areas.</p>
            </div>
            <span id="set-shipping"></span>

            <script>
                $('.shipping-btn').click(function(){
                    $('.shipping-btn').removeClass('shipping-set');
                    $(this).addClass('shipping-set');
                    $('#btn-checkout').attr('href', 'checkout');
                    $('#btn-checkout').removeAttr('onclick');
                    $('#btn-checkout').css('opacity', '1');
                })                
            </script>

            <div class="col-12 text-left delivery-term">
                <p>*Delivery Fee subjected to area and the total amount in cart.</p>
            </div>
        </div>
    </div>
</div>
<div class="col-12 text-center mt-3">
    <?php     
    $checkout_page = '#';
    
    $onclick_style = "onclick=\"javascript:alert('No items in your cart.')\" style=\"opacity:0.5;\" ";
    
    if(@count($items)>0){
        $checkout_page = 'checkout';
        $onclick_style = '';
    }
    ?>
    <a href="<?php echo $checkout_page;?>" class="btn confirm-btn btn-block p-4" id="btn-checkout" <?php echo $onclick_style;?>>CHECKOUT</a>
</div>

<script src="js/functions.jquery.js"></script>