<?php 
require_once 'head.php';

$ordered = false;

if(!empty($_SESSION['auth_user']['id'])){

    $total_price = $final_total = $total_rebatible = $final_rebatible = 0;

    $auth_user = sql_read('select * from member where id=? limit 1', 's', $_SESSION['auth_user']['id']);    
    $rebates = sql_read('select rebate_earned, rebate_used from orders where session=?', 's', session_id());

    if(@count($rebates)>0){
        foreach((array)$rebates as $rebate){
            $total_rebatible += $rebate['rebate_earned'];
            $total_rebatible -= $rebate['rebate_used'];
        }
    }
    if(@count($items)>0){
        foreach((array)$items as $item){
            $total_price += $item['total_price'];
        }
    }

    if($total_price>0){
        $max_redatible = $total_price*0.3;

        if($total_rebatible >= $max_redatible){
            $final_rebatible = $max_redatible;
        }else{
            $final_rebatible = $total_rebatible;
        }  
    }

    $final_total = $total_price + $shipping_fee['price'];

    if($_SESSION['rebate'] == 'yes'){
        $final_total -= $final_rebatible;
    }


    $order_exist = sql_read('select * from orders where session=? limit 1', 's', session_id());
    if($order_exist['id']){
        $data['id'] = $order_exist['id'];
    }
      


    $data['session'] = session_id();    
    $data['location'] = $_SESSION['location'];
    $data['area'] = $_SESSION['area'];
    $data['member'] = $_SESSION['auth_user']['id'];
    $data['customer_name'] = $_SESSION['auth_user']['name'];
    if($_SESSION['address'] == 1){
        $data['address'] = $_SESSION['auth_user']['address'];
    }else{
        $data['address'] = $_SESSION['auth_user']['address2'];
    }
    $data['delivery_method'] = $_SESSION['delivery_method'];
    if($data['delivery_method'] == 'deliver'){
        $data['delivery_date'] = $_SESSION['delivery_date'];
    }else{
        $data['pickup_time'] = $_SESSION['delivery_date'];
    }
    if($_SESSION['rebate'] == 'yes'){
        $data['rebate_used'] = $final_rebatible;
        $final_total = $final_total - $final_rebatible + $shipping_fee['price'];
    }else{
        $final_total = $final_total + $shipping_fee['price'];
    }
    $data['total'] = $final_total;
    $data['rebate_earned'] = $final_total*0.01;
    $data['payment_status'] = 'Pending';
    $data['delivery_method'] = $_SESSION['delivery_method'];
    $data['status'] = 'New';
    $data['pid'] = 'PID'.strtoupper(uniqid());
    $data['confirmed_date'] = date('Y-m-d H:i:s');
    $data['delivery_fee'] = $shipping_fee['price'];
    

    if(sql_save('orders', $data)){
        $_SESSION['session_msg'] = '<div class="sm alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
        Order created.</div>';
        $ordered = true;
        $order = sql_read('select * from orders where session=? limit 1', 's', session_id());
        unset($_SESSION['rebate']);
    }else{
        $_SESSION['session_msg'] = '<div class="sm alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
        Failed to create order.</div>';
    }
       
}
echo "";
?>





