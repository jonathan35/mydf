<?php 
require_once '../../config/ini.php';

if(!empty($current_order['member'])){

    $mem = sql_read("select * from member where id='".$current_order['member']."' limit 1");

    if(!empty($mem['id'])){

        $email_lists = array();
        $headers[] = 'From: Grocere';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        $name = $mem['name'];
        $contact = $mem['mobile_number'];
        $date = date('d M Y', strtotime($current_order['confirmed_date']));
        
        
        $order_id = 'E'.sprintf("%06d", $current_order['id']);
        $area = sql_read("select * from area where id='".$current_order['area']."' limit 1");
        $token = uniqid();
        $expiry = date('Y-m-d H:i:s', strtotime("+10 minutes"));

        mysqli_query($conn, "DELETE FROM token WHERE expiry < '".date('Y-m-d')."' ");
        mysqli_query($conn, "INSERT INTO token (token, expiry) VALUES ('".$token."', '".$expiry."')");
        


        
        if($_POST['action'] == 'Decline'){        
            $btn = '<a href="'.A_ROOT.'Terms-of-Use" target="_blank" style="text-decoration:none;"><div style=" margin:0 auto; width: 550px; height:44px; border-radius:15px; background-color: rgba(243,39,88,255); padding-top:18px; color:white; font-size:22px;">VIEW REFUND POLICY</div></a>';
        }elseif($current_order['delivery_method'] == 'pickup'){
            $en_order_id = $defender->encrypt('encrypt',$current_order['id']);
            $btn = '
            <table style="width:100%;">
            <tr>
                <td width="50%" style="padding-right:10px; text-align:right;">
                    <a href="'.A_ROOT.'the_order/'.$en_order_id.'/'.$token.'" target="_blank" style="text-decoration:none;"><div style=" margin:0 auto; width: 272px; height:44px; border-radius:15px; background-color: rgba(243,39,88,255); padding-top:18px; color:white; font-size:22px; text-align:center;">VIEW order</div></a>
                </td>
                <td width="50%" style="padding-right:10px; text-align:left;">
                    <a href="'.A_ROOT.'see_direction" target="_blank" style="text-decoration:none;"><div style=" margin:0 auto; width: 272px; height:44px; border-radius:15px; background-color: rgba(243,39,88,255); padding-top:18px; color:white; font-size:22px; text-align:center;">SEE DIRECTIONS</div></a>
                </td>
            </tr>
            </table>';
        }else{
            $en_order_id = $defender->encrypt('encrypt',$current_order['id']);
            $btn = '<a href="'.A_ROOT.'the_order/'.$en_order_id.'/'.$token.'" target="_blank" style="text-decoration:none;"><div style=" margin:0 auto; width: 272px; height:44px; border-radius:15px; background-color: rgba(243,39,88,255); padding-top:18px; color:white; font-size:22px;">VIEW order</div></a>';
        }


        if($_POST['action'] == 'Accept' && $current_order['delivery_method'] == 'deliver'){
            $subject = 'Your order '.$order_id.' has been processed!';
            $icon = '<img src="https://drive.google.com/uc?id=1DLJ6kw2soWbvQfcf59lUOgSCVUV4sV6C" alt="" style="display:inline-block;" />';
            $method_label = 'SHIPPING DELIVERY<br>'.$current_order['address'].'<br>('.$area['area'].')';
        }elseif($_POST['action'] == 'Accept' && $current_order['delivery_method'] == 'pickup'){
            $subject = 'Your order '.$order_id.' has been processed!';
            $icon = '<img src="https://drive.google.com/uc?id=1DLJ6kw2soWbvQfcf59lUOgSCVUV4sV6C" alt="" style="display:inline-block;" />';
            $method_label = 'SHIPPING<br>IN-STORE PICKUP<br>'.$current_order['pickup_time'];
        }elseif($_POST['action'] == 'Decline'){
            $subject = 'SORRY, Your order '.$order_id.' has been declined!';
            $icon = '';
        }elseif($_POST['action'] == 'Receipt' && $current_order['delivery_method'] == 'deliver'){
            $subject = 'Your order '.$order_id.' is out for delivery!';
            $icon = '<img src="https://drive.google.com/uc?id=1y481GJxuy8MoMB5nmj1C3priPrOB0dga" alt="" style="display:inline-block;" />';
            $method_label = 'SHIPPING DELIVERY<br>'.$current_order['address'].'<br>('.$area['area'].')';
        }elseif($_POST['action'] == 'Receipt' && $current_order['delivery_method'] == 'pickup'){
            $subject = 'Your order '.$order_id.' is ready for pickup!';
            $icon = '<img src="https://drive.google.com/uc?id=1DLJ6kw2soWbvQfcf59lUOgSCVUV4sV6C" alt="" style="display:inline-block;" />';
            $method_label = 'SHIPPING<br>IN-STORE PICKUP<br>'.$current_order['pickup_time'];
        }elseif($_POST['action'] == 'Delivered' && $current_order['delivery_method'] == 'deliver'){
            $subject = 'Your order '.$order_id.' has been delivered, thank you for choosing grocere.com.my!'; 
            $icon = '';
            $method_label = 'SHIPPING DELIVERY<br>'.$current_order['address'].'<br>('.$area['area'].')';
        }elseif($_POST['action'] == 'Delivered' && $current_order['delivery_method'] == 'pickup'){
            $subject = 'Your order '.$order_id.' has been pickup, thank you for choosing grocere.com.my!';
            $icon = '';
            $method_label = 'SHIPPING<br>IN-STORE PICKUP<br>'.$current_order['pickup_time'];
        }else{//New order that is not 'Accept' yet
            if($current_order['delivery_method'] == 'deliver'){
                $mem = sql_read("select * from member where id='".$current_order['member']."' limit 1");        
                $subject = 'You have new incoming order '.$order_id.' !';
                $icon = '';
                $method_label = 'SHIPPING DELIVERY<br>'.$current_order['address'];
            }elseif($current_order['delivery_method'] == 'pickup'){
                $mem = sql_read("select * from member where id='".$current_order['member']."' limit 1");   
                $subject = 'You have new incoming order '.$order_id.' !';
                $icon = '';
                $method_label = 'SHIPPING<br>IN-STORE PICKUP<br>'.$current_order['pickup_time'];
            }
        }

               
        
        if($cron_job){//for staff            
            $admins = sql_read("select * from email_notification where email !='' AND notify_when_confirmed='Yes' ");
            foreach((array)$admins as $admin){
                $email_lists[] = $admin['email'];
            }
        }else{//for customer
            if(!empty($mem['email'])){
                $email_lists[] = $mem['email'];
            }
        }

        $url = 'https://grocere.com.my/';
        $email_type = 1;

        $message = '
        <html>
            <head>
                <title>'.$subject.'</title>
            </head>
            <body>        
                <div style="font-family: Arial, Helvetica, sans-serif; background-color: #EEE;">
                    <div style="width:900px; margin:0 auto; background-color: rgba(241,241,242,255);">
                        <div style="width:100%; border-radius: 15px 15px 0 0; overflow:hidden;">
                            <div style="width:100%; height: 61px; background: linear-gradient(0deg , rgba(226,24,73,255) 0%, rgba(223,76,111,255) 100%);">
                                <span style="float:left; padding-top: 14px; padding-left: 33px; width: 36px; height: 36px;">
                                    <img src="https://drive.google.com/uc?id=14V_u-66cFO3T4RHEpq2voeTK52sqV63U" alt="Grocere" title="Grocere" width="36" height="36" />

                                </span>
                                <span style="padding-top:21px; float:right; opacity: 0.4; width: 152px; height: 26px; font-size:18px; text-align: left; color: #ffffff;">Grocere.com.my</span>
                            </div>

                            <div style="top:61px; width:auto; height: 114px; background-color: rgba(243,39,88,255);">
                                <table style="padding-top:32px; margin:0 auto; height: 31px; ">				
                                    <tr>
                                        <td>
                                            '.$icon.'
                                        </td>
                                        <td style="padding-left:24px; font-size:22px; text-align:left; color:#FFF;">
                                            '.$subject.'
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div style="width:100%; background-color: #FFF; padding:20px 10%; text-align:center;">
                                <table style="width:80%; font-size: 18px; font-weight:lighter; text-align: left; color: #444554;">
                                    <tr>
                                        <td style="width:50%;">
                                            <div style="padding:20px;">
                                                <div>NAME</div>
                                                <div>'.$name.'</div>
                                            </div>';

                                            if($_POST['action'] != 'Decline'){
                                                $message .= '
                                                <div style="padding:20px;">
                                                    <div>CONTACT</div>
                                                    <div>'.$contact.' </div>
                                                </div>
                                                <div style="padding:20px;">
                                                    <div>order DATE</div>
                                                    <div>'.$date.' </div>
                                                </div>';
                                            }
                                        $message .= '
                                        </td>
                                        <td style="width:50%; vertical-align:top;">
                                            <div style="padding:20px;">
                                                <div>order ID</div>
                                                <div>'.$order_id.'</div>
                                            </div>';
                                            if($_POST['action'] != 'Decline'){
                                            $message .= '
                                            <div style="padding:20px;">
                                                <div>'.$method_label.'</div>
                                            </div>';
                                            }
                                        $message .= '
                                        </td>
                                    </tr>
                                </table>
                                <div style="width:80%; padding:80px 0;">';
                                
                                if($_POST['action'] == 'Decline'){
                                    $message .= '
                                    <div style="font-size: 18px; font-weight: lighter; color: #444554; padding-bottom:40px;">
                                    GROCERE.COM.MY has processed REFUND<br>
                                    TO Your ORIGINAL PAYMENT METHOD.<br><br>
                                    For more info, please read our refund policy<br><br>
                                    </div>';
                                }

                                $message .= $btn.'
                                </div>
                            </div>
                            <div style="padding:22px 22px 22px 0; width:100%; height: 41px; font-size: 14px; text-align: left; color: #444554;">
                                Contact Us
                                <br />
                                <div style="display:inline-block; width:33%;">Email: Support@grocere.com.my </div>
                                <div style="display:inline-block; width:33%; text-align:center;">Hotline: +6 010-525 0196 </div>
                                <div style="display:inline-block; width:33%; text-align:right;">Live Chat: www.Grocere.com.my</div>
                                <div style="display:inline-block; width:100%; text-align:center; padding-top:10px;">
                                Direction : https://goo.gl/maps/P8ovD2guQUSiLpuc8</div>
                            </div>	
                        </div>
                    </div>
                </div>
            </body>
        </html>';    


        foreach((array)$email_lists as $email){            
            if(mail($email, $subject, $message, implode("\r\n", $headers))){
                if($cron_job){                    
                    mysqli_query($conn, "UPDATE orders SET cron = '".date('Y-m-d H:i:s')."' WHERE id= '".$current_order['id']."' ");
                }    
            }
        }
        
    }
}
?>