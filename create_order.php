<?php 
require_once 'head.php';


if(!empty($_SESSION['auth_user']['id'])){

    $auth_user = sql_read('select * from member where id=? limit 1', 's', $_SESSION['auth_user']['id']);
 
    $final_total = 0;
    $item_total = item_total();
    $final_rebatible = get_checkout_rebatible($items, get_total_rebatible());
    $shipping_fee = shipping_fee($item_total);
    $final_total = final_total($item_total, $shipping_fee, $final_rebatible);
    
    $order_exist = sql_read('select * from orders where session=? limit 1', 's', session_id());
    if($order_exist['id']){
        $order_data['id'] = $order_exist['id'];
    }

    $order_data['session'] = session_id();
    $order_data['location'] = $_SESSION['location'];
    $order_data['area'] = $_SESSION['area'];
    $order_data['member'] = $_SESSION['auth_user']['id'];
    $order_data['customer_name'] = $_SESSION['auth_user']['name'];
    if($_SESSION['address'] == 1){
        $order_data['address'] = $_SESSION['auth_user']['address'];
    }else{
        $order_data['address'] = $_SESSION['auth_user']['address2'];
    }
    $order_data['delivery_method'] = $_SESSION['delivery_method'];
    if($order_data['delivery_method'] == 'deliver'){
        $order_data['delivery_date'] = $_SESSION['delivery_date'];
    }else{
        $order_data['pickup_time'] = $_SESSION['delivery_date'];
    }
    if($_SESSION['rebate'] == 'yes'){
        $order_data['rebate_used'] = $final_rebatible;
        $order_data['rebate_earned'] = ($item_total-$final_rebatible)*0.01;
    }else{
        $order_data['rebate_earned'] = $item_total*0.01;
    }
    $order_data['total'] = $final_total;
    
    if(!empty($_SESSION['redeemed_total'])){
        $order_data['redeemed_total'] = $_SESSION['redeemed_total'];
    }


    $order_data['payment_status'] = 'Pending';
    $order_data['delivery_method'] = $_SESSION['delivery_method'];
    $order_data['status'] = 'New';
    $order_data['pid'] = 'PID'.strtoupper(uniqid());
    $order_data['confirmed_date'] = date('Y-m-d H:i:s');
    $order_data['delivery_fee'] = $shipping_fee;
    
    $_SESSION['error'] = implode(',', $order_data);

    if(sql_save('orders', $order_data)){
        
        $ordered = true;
        $order = sql_read('select * from orders where session=? limit 1', 's', session_id());
        unset($_SESSION['rebate']);


        $_SESSION['session_msg'] = '<div class="sm alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
        Order created.</div>';


    }else{
        $_SESSION['session_msg'] = '<div class="sm alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
        Failed to create order.</div>';
    }
       
}
echo "";
?>





