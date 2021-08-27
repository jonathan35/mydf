<?php 
require_once 'config/ini.php';

$Password = 'sit12345';
$ServiceID = 'sit';
$TransactionType = 'SALE';//AUTH
$PymtMethod = 'ANY';
$CurrencyCode = 'MYR';
$Amount = number_format(1, 2, '.', '');
$PaymentDesc = 'Order Purchase';
$CustIP = $_SERVER['REMOTE_ADDR'];

$PaymentID = 'PID'.date('YmdHis');
$OrderNumber = 'E'.sprintf("%06d", 1);
$CustName = 'Jonathan';
$CustEmail = 'jonathan.wphp@gmail.com';
$CustPhone = '1234557678';//undefined

$project_folder = '';


$MerchantReturnURL = HTTP.$_SERVER['HTTP_HOST'].$project_folder.'/thank_you2';
$MerchantCallbackURL = HTTP.$_SERVER['HTTP_HOST'].$project_folder.'/thank_you2';
$HashStr = $Password.$ServiceID.$PaymentID.$MerchantReturnURL.$MerchantCallbackURL.$Amount.$CurrencyCode.$CustIP;
$HashValue = hash("sha256", $HashStr);

$url = "https://test2pay.ghl.com/IPGSG/Payment.aspx";//
?>

<form id="payment_form" action="<?=$url?>" method="post" enctype="multipart/form-data" style="text-align:center;">
    <br>TransactionType<INPUT type="text" name="TransactionType" value="<?=$TransactionType?>">
    <br>PymtMethod<INPUT type="text" name="PymtMethod" value="<?=$PymtMethod?>">
    <br>ServiceID<INPUT type="text" name="ServiceID" value="<?=$ServiceID?>">
    <br>PaymentID<INPUT type="text" name="PaymentID" value="<?=$PaymentID; ?>">
    <br>OrderNumber<INPUT type="text" name="OrderNumber" value="<?=$OrderNumber?>">
    <br>PaymentDesc<INPUT type="text" name="PaymentDesc" value="<?=$PaymentDesc?>">
    <br>MerchantReturnURL<INPUT type="text" name="MerchantReturnURL" value="<?=$MerchantReturnURL?>">
    <br>MerchantCallbackURL<INPUT type="text" name="MerchantCallbackURL" value="<?=$MerchantCallbackURL?>">
    <br>Amount<INPUT type="text" name="Amount" value="<?=$Amount?>">
    <br>CurrencyCode<INPUT type="text" name="CurrencyCode" value="<?=$CurrencyCode?>">   
    <br>HashValue<INPUT type="text" name="HashValue" value="<?=$HashValue?>" style="width:450px;">
    <br>CustIP<INPUT type="text" name="CustIP" value="<?=$CustIP?>">
    <br>CustName<INPUT type="text" name="CustName" value="<?=$CustName?>">
    <br>CustEmail<INPUT type="text" name="CustEmail" value="<?=$CustEmail?>">
    <br>CustPhone<INPUT type="text" name="CustPhone" value="<?=$CustPhone?>">                            
    <br><INPUT type="submit" value="Buy Now" name="Submit" class="btn btn-buy text-center mt-2" id="pay_eghl">	
</form>