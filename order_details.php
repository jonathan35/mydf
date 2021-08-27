<?php
include_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
include 'lpssdk/redeemable.php';

$auth = false;

if($_SESSION['validation'] == 'YES'){//Is admin
    $auth = true;
}elseif(!empty($_SESSION['auth_user']['id'])){//Is member
    $auth = true;
}elseif(!empty($_GET['t'])){//Is valid token
  
    $check_token = sql_read('select * from token where token=? AND expiry > ? limit 1', 'ss', array($_GET['t'], date('Y-m-d H:i:s')));

    if($check_token['id']){
        $auth = true;
    }
}

if($_GET['i']){
    $oid = $defender->encrypt('decrypt',$_GET['i']);
    $order = sql_read('select * from orders where id=? limit 1', 's', $oid);    
}
?>

<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">


    <script src="<?php echo ROOT?>js/jquery-3.4.1.js"></script>
    

    <link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap-4.3.1.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ROOT?>css/pink-shadow.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ROOT?>css/animate.css" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet"> 
    

</head>
<body>

<?php 
if(!$auth){

    if($_GET['s'] == 1){
        echo '
        <h4 class="text-center pt-5 mt-5">Authentication Blocked</h4>
        <div class="text-center pt-3">
            Please <a href="'.A_ROOT.'cms">login</a> to view
        </div>';        
    }else{
        include 'member_login.php';
    }

}else{

    if(!empty($order['id'])){?>
    <div class="container" style="border:1px solid #DDD; padding-bottom:100px; box-shadow:1px 0 2px rgba(0,0,0,.2)">
        <div class="row pb-4" style="color:#333;">
            
            <div class="col-12 pb-3">
                <h1 class="display-3 text-center">Order</h1>
            </div>

            <div class="col-12 col-md-5">
                <table>
                <tr>
                    <td class="text-muted" style="width:100px;">Customer</td>
                    <td>
                        <?php 
                        if(!empty($order['member'])){
                            $member = sql_read('select * from member where id=? limit 1', 's', $order['member']);
                        }
                        if(!empty($member['name'])) echo $member['name'];                    
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">Email</td>
                    <td>
                        <?php if(!empty($member['name'])) echo $member['email'];?>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted" style="vertical-align:top;">Address</td>
                    <td>
                        <?php echo $order['address'];?>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted" style="vertical-align:top;">Area</td>
                    <td>
                        <?php 
                        $area = sql_read('select * from area where id=? limit 1', 's', $order['area']);
                        echo $area['area'];?>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted" style="vertical-align:top;">Driver</td>
                    <td>
                        <?php                                                 
                        if($_SESSION['validation'] == 'YES' && ($order['status'] == 'New' || $order['status'] == 'Receipt' || $order['status'] == 'Accept')){
                            $drivers = sql_read('select * from driver');
                            ?>
                            <select name="driver" id="driver" onchange="change_driver(this);" style="width:70%;">
                                <option value="">Select Driver</option>
                                <?php 
                                foreach((array)$drivers as $driver){
                                    $driver_id = $defender->encrypt('encrypt', $driver['id']);
                                    ?>
                                <option value="<?php echo $driver_id;?>" <?php if($order['driver'] == $driver['id']){?>selected<?php }?>>
                                    <?php echo $driver['name'];?>
                                </option>
                                <?php }?>
                            </select>
                        <?php 
                        }else{
                        
                            $the_driver = sql_read('select * from driver where id=? limit 1', 's', $order['driver']);
                            echo $the_driver['name'];
                        }
                        ?>
                        <span id="driver_update"></span>
                        <script>
                        function change_driver(e){
                            var oid = '<?php echo $defender->encrypt('encrypt', $order['id']);?>';
                            var driver = $(e).children("option:selected"). val();
                            $.post('<?php echo ROOT?>driver_update.php', {driver:driver, oid:oid}).done(function (data) {
                                //$('#driver_update').html(data);
                            });
                        }
                        </script>

                    </td>
                </tr>
                <tr>
                    <td class="text-muted" style="vertical-align:top;">Delivery</td>
                    <td>
                        <?php if($order['delivery_method'] == 'pickup') echo 'Pickup'; else 'Delivery';?>
                    </td>
                </tr>

                </table>
            </div>

            <div class="col-12 col-md-4 offset-md-3 col-lg-3 offset-lg-4 text-right">
                <table style="width:100%;">
                <tr>
                    <td class="text-muted" style="width:100px;">Status</td>
                    <td>
                        <?php echo $order['status'];
                        if($order['status'] == 'Decline'){ echo '<div style="font-size:12px;">('.$order['decline_remark'].')</div>';}                    
                        ?>
                    </td>
                </td>
                <tr>
                    <td class="text-muted">Date</td>
                    <td>
                        <?php echo date('d/m/Y', strtotime($order['confirmed_date']));?>
                    </td>
                </td>
                <tr>
                    <td class="text-muted">Order ID</td>
                    <td>			
                        <?php echo $mo = sprintf("%06d", $order['id']); ?>
                    </td>
                </td>
                <?php if(!empty($order['receipt_id'])){?>
                <tr>
                    <td class="text-muted">Receipt ID</td>
                    <td>
                        <?php echo $order['receipt_id'];?>
                    </td>
                </tr>
                <?php }?>
                <?php if(!empty($order['payment_status'])){?>
                <tr>
                    <td class="text-muted">Payment</td>
                    <td>
                        <?php echo $order['payment_status'];?>
                        <?php /*if(!empty($order['payment_date'])){
                            echo '('.date('d/m/Y', strtotime($order['payment_date'])).')';
                        }*/?>
                    </td>
                </tr>
                <?php }?>
                </table>            
            </div>


        </div>


        <style>
        th {background:#EFEFEF; border-bottom:3px solid #CCC; color:#666;}    
        </style>


        <div class="row">
            <div class="col-12 pt-2">
                <table class="table">
                <tr>               
                    <th width="5%">No.</th>
                    <th width="50%">Product</th>
                    <th width="15%">UOM</th>
                    <th width="10%">Unit Price</th>
                    <th width="10%">Qty.</th>
                    <th width="10%" style="text-align:right;">Total</th>
                </tr>
                <?php 
                
                $items = sql_read('select * from items where session=?', 's', $order['session']);
                
                if(@count($items)>0){

                    $c = 1;
                    $item_total = 0;
                    foreach((array)$items as $i){?>
                    <tr>               
                        <td><?php echo $c++;?></td>
                        <td><?php echo $i['product'];?></td>
                        <td><?php echo $i['uom'];?></td>
                        <td><?php echo $i['unit_price'];?></td>
                        <td><?php echo $i['quantity'];?></td>
                        <td style="text-align:right;">
                            RM<?php 
                            echo $i['total_price'];
                            $item_total += $i['total_price'];;
                            ?>
                        </td>
                        
                    </tr>
                <?php 
                    }
                }?>
                <tr><td colspan="7" style="border-top:1px solid #CCC; height:0;"></td></tr>



                <tr style="border-bottom:none;">
                    <td class="text-right pt-3" colspan="5" style="border-top:none;">
                        <span style="color:#999;">Sub Total</span>
                    </td>
                    <td style="font-size:20px; text-align:right; border-top:none;">
                        <?php echo 'RM'.number_format($item_total,2,'.',',');?>
                    </td>
                </tr>


                <?php if($order['rebate_used']){?>
                <tr>
                    <td class="text-right pt-3" colspan="5" style="border-top:none;">
                        <span style="color:#999;">Rebated</span>
                    </td>
                    <td style="font-size:20px; text-align:right; border-top:none;">
                        <?php echo 'RM'.$order['rebate_used'];?>
                    </td>
                </tr>
                <?php }?>


                <tr style="border-bottom:none;">
                    <td class="text-right pt-3" colspan="5" style="border-top:none;">
                        <span style="color:#999;">Delivery Fee</span>
                    </td>
                    <td style="font-size:20px; text-align:right; border-top:none;">
                        <?php echo 'RM'.$order['delivery_fee'];?>
                    </td>
                </tr>
                <tr>
                    <td class="text-right pt-3" colspan="5" style="border-top:none;">
                        <span style="color:#999;">Final Total</span>
                    </td>
                    <td style="font-size:20px; text-align:right; border-top:none;">
                        <?php echo 'RM'.$order['total'];?>
                    </td>
                </tr>

                <tr>
                    <td class="text-right pt-0" colspan="6">&nbsp;</td>
                </tr>

                <tr>
                    <td class="text-right pt-3" colspan="5" style="border-top:none;">
                        <span style="color:#999;">Payment</span>
                    </td>
                    <td style="font-size:20px; text-align:right; border-top:none;">
                        <?php 
                        if(!empty($order['redeemed_total'])){
                            echo 'RM'.$order['redeemed_total'];
                            $point_spent = $lps_retail->point_spent(HTTP.$_SERVER['HTTP_HOST'].'/grocere3.0/the_order/'.$defender->encrypt('encrypt', $order['id']));
                        }else{
                            echo 'RM'.$order['total'];
                        }
                        ?>
                    </td>
                </tr>

                <?php if(!empty($point_spent)){?>
                <tr>
                    <td class="text-right pt-3" colspan="5" style="border-top:none;">
                        <span style="color:#999;">Redemption</span>
                    </td>
                    <td style="font-size:20px; text-align:right; border-top:none;">
                        <?php echo $point_spent;?>pt
                    </td>
                </tr>
                <?php }?>


                </table>
            </div>
        
        </div>


        
    </div>
<?php }
}?>


<body>
</html>

<?php include_once 'config/session_msg.php';?>