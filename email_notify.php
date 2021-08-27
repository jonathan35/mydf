<?php 
require_once 'config/ini.php';

if(!empty($current_order['member'])){

    $mem = sql_read("select * from member where id='".$current_order['member']."' limit 1");

    if(!empty($mem['id'])){

        $email_lists = array();
        $email_type = 1;
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
        

    
        $en_order_id = $defender->encrypt('encrypt',$current_order['id']);
        $btn = '<a href="'.A_ROOT.'the_order/'.$en_order_id.'/'.$token.'" target="_blank" style="text-decoration:none;"><div style=" margin:0 auto; width: 272px; height:44px; border-radius:15px; background-color: rgba(243,39,88,255); padding-top:18px; color:white; font-size:22px;">VIEW ORDER</div></a>';
    
        $mem = sql_read("select * from member where id='".$current_order['member']."' limit 1");
        $icon = '';
        $subject = array();
    
        if($current_order['delivery_method'] == 'deliver'){
            $method_label = 'SHIPPING DELIVERY<br>'.$current_order['address'];
        }elseif($current_order['delivery_method'] == 'pickup'){
            $method_label = 'SHIPPING<br>IN-STORE PICKUP<br>'.$current_order['pickup_time'];
        }
        
         
        $admins = sql_read("select * from email_notification where email !='' AND notify_when_confirmed='Yes' ");
        foreach((array)$admins as $admin){
            $subject[] = 'You have new incoming order '.$order_id.' !';
            $email_lists[] = $admin['email'];
        }

        if(!empty($mem['email'])){       
            $subject[] = 'Thank you for your order '.$order_id.' !';
            $email_lists[] = $mem['email'];
        }
    


        $c = 0;
        foreach((array)$email_lists as $email){


            $message = '
            <html>
                <head>
                    <title>'.$subject[$c].'</title>
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
                                                '.$subject[$c].'
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
                                                        <div>ORDER DATE</div>
                                                        <div>'.$date.' </div>
                                                    </div>';
                                                }
                                            $message .= '
                                            </td>
                                            <td style="width:50%; vertical-align:top;">
                                                <div style="padding:20px;">
                                                    <div>ORDER ID</div>
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
                                        GROCERE.COM.MY HAS PROCESSED REFUND<br>
                                        TO YOUR ORIGINAL PAYMENT METHOD.<br><br>
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

        
            mail($email, $subject[$c], $message, implode("\r\n", $headers));
            $c++;
        }
        
    }
}
?>