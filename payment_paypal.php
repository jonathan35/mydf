<?php 
$paypal_setting = sql_read('select * from payment_gateway where id=3 limit 1');

if($paypal_setting['para2'] == 'live_server'){
    $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
}elseif($paypal_setting['para2'] == 'testing_server'){
    $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
}
$paypal_merchant = $paypal_setting['para3'];    

if(!empty($order['redeemed_total'])){
    $amount = number_format($order['redeemed_total'], 2, '.', '');
}else{
    $amount = number_format($order['total'], 2, '.', '');
}

$payment_id = $defender->encrypt('encrypt', $order['pid']);

if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'wphp.hopto.org'){
    $project_folder = '/grocere3.0';
}else{
    $project_folder = '';
}
$return_page = HTTP.$_SERVER['HTTP_HOST'].$project_folder.'/thank_you?tx=success&p='.$payment_id;
$cancel_return_page = HTTP.$_SERVER['HTTP_HOST'].$project_folder.'/thank_you?tx=fail&p='.$payment_id;
?>
<form id="payment_form" action="<?php echo $paypal_url?>" method="post" target="_top">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?php echo $paypal_merchant?>">
    <input type="hidden" name="item_name" value="<?php echo $payment_id?>">
    <input type="hidden" name="amount" value="<?php echo $amount?>">
    <input type="hidden" name="currency_code" value="MYR">
    <input type="hidden" name="button_subtype" value="services">
    <input type="hidden" name="no_note" value="0">
    <input type="hidden" name="cn" value="-">
    <input type="hidden" name="no_shipping" value="2">
    <input type="hidden" name="rm" value="1">
    <input type="hidden" name="return" value="<?php echo $return_page?>">
    <input type="hidden" name="cancel_return" value="<?php echo $cancel_return_page?>">
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
    <div class="submit">
        <input type="submit" value="Click To Continue" id="pay_eghl" style="opacity:0; width:0; height:0; overflow:hidden;"/> 
    </div>
</form>