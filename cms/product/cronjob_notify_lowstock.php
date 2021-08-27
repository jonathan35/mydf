<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';


$timep = substr(date('Y-m-d H:i:s', strtotime("-30 minutes")),0,16);
$low_stock = sql_read("select * from stock_promo where stock <= stock_low AND stock_low !='0' AND stock_low IS NOT NULL AND stock_low !='' AND (cron = '' OR cron IS NULL OR cron < '".$timep."') limit 1");


if(!empty($low_stock['id'])){

    $uom = sql_read('select * from uom where id=? limit 1', 's', $low_stock['uom']);
    $product = sql_read('select * from product where id=? limit 1', 's', $uom['product']);
    $location = sql_read('select * from location where id=? limit 1', 's', $low_stock['location']);
    
    $store_admins = sql_read("select * from login where status='1' AND location=?",'s', $low_stock['location']);

    if(@count($store_admins)>0){

        $headers[] = 'From: Grocere';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $subject = 'Low Stock Notification '.date('d-m-Y, H:i:s');

        foreach((array)$store_admins as $admin){
            $email_lists[] = $admin['email'];
        }        
    
        $url = A_ROOT;
        $email_type = 1;

        $message = '
        <html>
            <head>
                <title>'.$subject.'</title>
            </head>
            <body>
                <div style="font-family: Arial, Helvetica, sans-serif; background-color: #EEE;">
                 ';

                if(!empty($product['product_name'])){
                    $message .= $product['product_name'].' (SKU:'.$product['sku'].') low stock ';
                }
                if(!empty($location['location'])){
                    $message .=' in '.$location['location'];
                }

        $message .=' 
                </div>
            </body>
        </html>';

        mail('jonathan.wphp@gmail.com', $subject, $message, implode("\r\n", $headers));

        foreach((array)$email_lists as $email){

            if(mail($email, $subject, $message, implode("\r\n", $headers))){
                
                echo 'sent:'.$email;

                mysqli_query($conn, "UPDATE stock_promo SET cron = '".date('Y-m-d H:i:s')."' WHERE id= '".$low_stock['id']."' ");
                  
            }
        }
        
    }
}

?>