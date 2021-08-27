<?php 
session_start();
session_regenerate_id();

include_once 'head.php';
?>

<!DOCTYPE html>
<html lang="en">

<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/item-numbering.css" rel="stylesheet" />
<style>
    body{ color:#333; overflow-x:hidden; font-family: 'MontserratRegular';}
    h1 {font-family: 'MontserratRegular'; color:#F32758;}
    h2{padding-top:30px; font-size:22px !important; font-family: 'MontserratRegular';}
</style>

<body class="container-fluid">
    <?php include 'nav.php';?>
    <div class="row">    
        <div class="col-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2 pb-5 mb-5" style="padding-top:150px;">

            <?php 
            $gateway = sql_read('select * from payment_gateway where id=1 limit 1');
            $payment_return = false;
            $payment_msg = 'Transaction Failed';

            if($gateway['para1'] == 'eghl'){
                if($_POST['TxnMessage'] == 'Transaction Successful'){
                    $payment_return = true;
                    $payment_msg = $_POST['TxnMessage'];
                }
                $pid  = $_POST['PaymentID'];
            }elseif($gateway['para1'] == 'paypal'){
                if($_GET['tx'] == 'success'){
                    $payment_return = true;
                    $payment_msg = 'Transaction Successful';
                }
                $pid  = $defender->encrypt('decrypt', $_GET['p']);
            }else{
                echo 'No payment option available.';
            }

            $data = array();
            $order = sql_read('select * from orders where pid=? limit 1', 's',$pid);

            if($order['id']){
                if($payment_return){
                    $payment_num = sprintf("%06d", $order['id']);
                    $payment_amt = number_format(0+$order['total'],2,'.',',');

                    if(!empty($order['redeemed_total'])){

                        if(!empty($order['redeemed_total'])){
                            $redeem_amount = number_format($order['redeemed_total'], 2, '.', '');
                        }else{
                            $redeem_amount = number_format($order['total'], 2, '.', '');
                        }
                        $lps_merchant->inoutCoins($redeem_amount, HTTP.$_SERVER['HTTP_HOST'].'/grocere3.0/the_order/'.$defender->encrypt('encrypt', $order['id']));
                    }
        
                    /* ---------------------- Stock - Start ---------------------------*/
                    $items = sql_read('
                        select i.uom, i.uom_id, i.quantity, sp.stock, sp.id as stock_id  
                        from items as i          
                        INNER JOIN stock_promo AS sp ON sp.uom = i.uom_id AND sp.location = ? 
                        where session=? AND location_id=? 
                    ', 'sss', array($order['location'], $order['session'], $order['location']));
                
                    foreach((array)$items as $item){
                        $stock_promo['id'] = $item['stock_id'];
                        $stock_promo['stock'] = $item['stock'] - $item['quantity'];
                        sql_save('stock_promo', $stock_promo);
                    }
                    /* ---------------------- Stock - End ---------------------------*/
                    
                    $data['id'] = $order['id'];
                    $data['payment_date '] = date('Y-m-d H:i:s');
                    $data['payment_status'] = 'Paid';
                    
                    sql_save('orders', $data);
            
                    $current_order = $order;
                    include 'email_notify.php';
                }
                
                echo "<div class=\"no_show\"></div><script>$(document).ready(function(){ $('.no_show').load('regen_session_id.php');})</script>";
            }
            ?>
            
            <div class="d-block d-sm-none"><br><br><br></div>


            <div class="d-flex align-items-center mt-xs-5" style=" justify-content: center;">
                <?php if($payment_return){?>
                    <img src="images/tick.png">
                    <h1 style="padding-left:14px;">Thank you for your payment</h1>
                <?php }else{?>
                    <img src="images/error_outline-orange-77dp.svg">
                    <h1 style="padding-left:14px; color:orange;">No payment, please try again.</h1>
                <?php }?>
            </div>
            <div class="d-flex pt-3" style="justify-content: center; font-size:14px;">
                <div>
                    <div>Payment Status: <?php echo $payment_msg;?></div>
                    <div>Order ID: <?php echo $payment_num;?></div>
                    <div>Order Amount: RM<?php echo $payment_amt;?></div>

                    <div class="pt-5">
                        <?php if(!empty($data['id'])){?>
                        <div class="pt-2"><a href="the_order/<?php echo $defender->encrypt('encrypt', $data['id'])?>" target="_blank">VIEW RECEIPT</a></div>
                        <?php }?>
                        <div class="pt-2"><a href="home" target="_blank">CONTINUE SHOPPING</a></div>                        
                    </div>

                </div>
            </div>

        </div>
    </div>
    <?php include 'footer.php';?>
</body>
</html>
