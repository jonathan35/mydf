<?php 

$Password = 'iZQfXTE5fCOjVLtZkPu1dAPhpJr5LhI6';//sit12345
$ServiceID = 'ORB';//sit
$TransactionType = 'SALE';//AUTH
$PymtMethod = 'ANY';
$CurrencyCode = 'MYR';
$Amount = number_format($order['total'], 2, '.', '');
$PaymentDesc = 'Order Purchase';
$CustIP = $_SERVER['REMOTE_ADDR'];

$PaymentID = $order['pid'];
$OrderNumber = 'E'.sprintf("%06d", $order['id']);
$CustName = $_SESSION['auth_user']['name'];
$CustEmail = $_SESSION['auth_user']['email'];
$CustPhone = $_SESSION['auth_user']['mobile_number'];;//undefined


if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'wphp.hopto.org'){
    $project_folder = '/grocere.com.my';
}else{
    $project_folder = '';
}


$MerchantReturnURL = HTTP.$_SERVER['HTTP_HOST'].$project_folder.'/thank_you';
$MerchantCallbackURL = HTTP.$_SERVER['HTTP_HOST'].$project_folder.'/thank_you';
$HashStr = $Password.$ServiceID.$PaymentID.$MerchantReturnURL.$MerchantCallbackURL.$Amount.$CurrencyCode.$CustIP;
$HashValue = hash("sha256", $HashStr);

$url = "https://securepay.e-ghl.com/IPG/Payment.aspx";//https://test2pay.ghl.com/IPGSG/Payment.aspx
?>



<form id="payment_form" action="<?=$url?>" method="post" enctype="multipart/form-data" style="text-align:center;">
    <INPUT type="hidden" name="TransactionType" value="<?=$TransactionType?>">
    <INPUT type="hidden" name="PymtMethod" value="<?=$PymtMethod?>">
    <INPUT type="hidden" name="ServiceID" value="<?=$ServiceID?>">
    <INPUT type="hidden" name="PaymentID" value="<?=$PaymentID; ?>">
    <INPUT type="hidden" name="OrderNumber" value="<?=$OrderNumber?>">
    <INPUT type="hidden" name="PaymentDesc" value="<?=$PaymentDesc?>">
    <INPUT type="hidden" name="MerchantReturnURL" value="<?=$MerchantReturnURL?>">
    <INPUT type="hidden" name="MerchantCallbackURL" value="<?=$MerchantCallbackURL?>">
    <INPUT type="hidden" name="Amount" value="<?=$Amount?>">
    <INPUT type="hidden" name="CurrencyCode" value="<?=$CurrencyCode?>">   
    <INPUT type="hidden" name="HashValue" value="<?=$HashValue?>" style="width:450px;">
    <INPUT type="hidden" name="CustIP" value="<?=$CustIP?>">
    <INPUT type="hidden" name="CustName" value="<?=$CustName?>">
    <INPUT type="hidden" name="CustEmail" value="<?=$CustEmail?>">
    <INPUT type="hidden" name="CustPhone" value="<?=$CustPhone?>">                            
    <INPUT type="submit" value="Buy Now" name="Submit" class="btn btn-buy text-center mt-2" id="pay_eghl" style="opacity:0; width:0; height:0; overflow:hidden;">	
</form>