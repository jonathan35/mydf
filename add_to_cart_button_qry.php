<?php
require_once 'config/ini.php';
require_once 'config/security.php';


if(empty($_SESSION['region']) || empty($_SESSION['location'])){
    echo 'no region or location';

}elseif($_POST['u']){
    
    $uom_id = $defender->encrypt('decrypt', $_POST['u']);
    $session_id = session_id();
    $region = $_SESSION['region'];
    $location = $_SESSION['location'];
    $qty = $_POST['q'];
    

    $uom = sql_read('select * from uom where id=? AND region=? limit 1', 'ss', array($uom_id, $region));
    
    if($uom['id']){
        

        $product = sql_read('select * from product where id=? AND region=? limit 1', 'ss', array($uom['product'], $region));

        if($product['id']){
            
            $stock = sql_read('select * from stock_promo where uom=? AND location=? limit 1', 'ss', array($uom['id'], $location));
            
            if($qty > $stock['stock']){
                echo 'no stock';
            }elseif($qty == 0){
                mysqli_query($conn, "DELETE FROM items where session='".$session_id."' AND uom_id='".$uom_id."'");
            }else{
                /* --------------- Shopping Cart - Items -----------------------*/
                $item = array();
                
                $exist = sql_read('select * from items where session=? AND uom_id=? limit 1', 'ss', array($session_id, $uom_id));

                if(!empty($exist['id'])){
                    $item['id'] = $exist['id'];
                }

                $item['session'] = $session_id;
                $item['uom_id'] = $uom_id;
                $item['region_id'] = $region;
                $item['location_id'] = $location;
                $item['uom'] = $uom['uom'];
                $item['product_id'] = $product['id'];
                $item['product'] = $product['product_name'];
                $item['quantity'] = $qty;
                $item['unit_price'] = $uom['price'];
                $item['total_price'] = $uom['price']*$qty;
                if(sql_save('items', $item)){
                    echo 'saved';
                }


            }
        }
    }

}

?>