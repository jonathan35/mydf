<?php 
include_once("../../config/ini.php");
require_once("../../pro/str_convert.php");
require_once("../../pro/security.php");

$session_id = $order_session_id = base64_decode($_GET['id']); 
$client_query = mysqli_query($conn, "SELECT * FROM product_comfirm WHERE session_id='".$order_session_id."' order by reference_id desc limit 1 ");
$client_set = mysqli_fetch_assoc($client_query);

$cart_query=mysqli_query($conn, "SELECT * FROM cart WHERE session_id='".$session_id."'") or die (mysqli_error());
$cart_count=mysqli_num_rows($cart_query);
$cart=mysqli_fetch_assoc($cart_query);
$total=0;


?>
<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <script src="<?php echo ROOT?>js/fbds.js" async=""></script>
	<script src="<?php echo ROOT?>js/analytics.js" async="" type="text/javascript"></script>
	<script src="<?php echo ROOT?>js/conversion_async.js" async="" type="text/javascript"></script>
	<script src="<?php echo ROOT?>js/ec.js" async="" type="text/javascript"></script>
	<script src="<?php echo ROOT?>js/analytics.js" async=""></script>
	<script src="<?php echo ROOT?>js/gtm.js" async=""></script>
	<script src="<?php echo ROOT?>js/modernizr-2.js" type="text/javascript"></script>
    <title></title>
    
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ROOT?>css/layout.css">
    <link rel="stylesheet" href="<?php echo ROOT?>css/css.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ROOT?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo ROOT?>css/cart.css">
    

    <style>
    .row {
		padding:2px 0;
		font-size:13px;
	}
	.tes td {
		border:1px solid #000;	
	}
	.par {
	  par:12px;
	  border-bottom:1px solid #CFCFCF;
	}
	.par > label {
	  margin-bottom:0;
	}
    </style>
    
    
</head>
<body>
    <div class="center">
        <div id="content" class="content-background">
            <div class="container">
            
            <div class="col-12" style="margin:20px 0 40px 0;">
                          
                <div class="row">                  
                    <h3 style="border-bottom:1px solid #F90;">Order</h3>
                </div>
               
                <div class="row">                  
                    Order No.: <span style="color:darkorange;"><?php echo $client_set['reference_id']+1000?></span><br>
                    <?php if($client_set['confirm_date']!='0000-00-00') 
                    echo 'Order date: <span style="color:darkorange;">'.date("dS M Y", strtotime($client_set['confirm_date'])).'</span>';?><br />
                    
                    <?php 
                    if($client_set['status']==1) $print_status = "Order Received";
                    elseif($client_set['status']==2) $print_status = "Payment Received";
                    elseif($client_set['status']==0) $print_status = "Completed & Shipped";
                    else $print_status = "Order In Progress";
                    ?>
                    Order status: <span style="color:darkorange;"><?php echo $print_status?></span>
                </div>      
                     
                <div class="row" style="border-bottom:1px solid gray;"></div>
                <?php 
				$subtotal = 0;
				if ($cart_count > 0){
				do{ 
					$required_editing_id=$cart['id'];
				?>
                <div class="row" style="border-bottom:1px solid #CCC; ">
                    <div class="col-lg-3">
                        <div style="margin-right:5px; overflow:hidden;">
                
                        <?php if(empty($cart['layout_id'])){?>
                        <img class="img-responsive slimmage cart_img" style="max-width:320px;" src="<?php echo ROOT.$cart['photo']?>">
                        <?php }else{?>
                        <img class="img-responsive slimmage cart_img" style="max-width:320px;" src="<?php echo ROOT.'customer_photos/thumbs/'.$cart['photo']?>">
                        <?php }?>
                        
                        </div>
                    </div>
                    <style>
                    .row {
						
						
					}
                    </style>
                    <div class="col-lg-8">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php if(!empty($cart['layout_id'])){?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Layout Name</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"><?php echo $cart['layout_name'];?></div>
                            </div>
                            <?php }?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Unit Price</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    A$<?php 
                                    $price = $cart['price']; 
                                    echo number_format($price, 2, '.', '');	
                                    $product_collection_price = $product_collection_price.$price."|";
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Quantity</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"><?php echo $cart['quantity'];?></div>
                            </div>
                            <?php if(!empty($cart['layout_id'])){?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Color</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<?php 
								if(!empty($cart['color'])){
									$color_query = mysqli_query($conn, "select * from color_db where id='".$cart['color']."' ");
									$color = mysqli_fetch_assoc($color_query);
									if(!empty($color['color_name'])){
										echo $color['color_name'];
									}
								}
								?> 
                                <div style=" display:inline-block; width:30px; background-color:<?php echo $color['html_color'];?>">&nbsp;</div>
                                </div>
                            </div>
                            <?php }?>
                            <?php if(!empty($cart['layout_id'])){?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Font</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<?php 
								if(!empty($cart['font'])){
									$font_query = mysqli_query($conn, "select * from font_db where font LIKE '%".$cart['font']."' ");
									$font = mysqli_fetch_assoc($font_query);
									if(!empty($font['font_name'])){
										echo $font['font_name'];
									}
								}
								?> 
                                </div>
                            </div>
                            <?php }?>
                            <?php if(!empty($cart['layout_id'])){?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Background</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"><a href="<?php echo ROOT.'photo/'.$cart['background'];?>" target="_blank" style="color:orange;">View</a></div>
                                
                            </div>
                            <?php }?>
                            <?php if(!empty($cart['customer_image'])){?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Customer's Image</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"><a href="<?php echo ROOT.'photo/customer/tmp/'.$cart['customer_image'];?>" target="_blank" style="color:orange;">View</a></div>
                            </div>
							<?php }?>
                            <?php if($cart['size']!=''){ ?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Size</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
									<?php echo $cart['size'];?>
                                </div>
                            </div>
                            <?php }?>
                            <?php if($cart['attachment']!=''){ ?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Attachment</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
									<?php echo $cart['attachment'];?>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <?php 
						$texts_query = mysqli_query($conn, "SELECT * FROM cart_texts WHERE session_id='".$session_id."' AND 
										product_id = '".$cart['product_id']."' AND cart_id = '".$cart['id']."' AND layout_id = '".$cart['layout_id']."' ORDER BY id ASC");
						$texts = mysqli_fetch_assoc($texts_query);
						$texts_count = mysqli_num_rows($texts_query);
						$c = 1;
						if($texts_count > 0){
							do{
								if(!empty($texts['text'])){?>
                            <div class="row" style="border-top:1px solid #999;">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b><?php if(!empty($texts['label'])){?><?php echo $texts['label']?><?php }else{?>Text <?php echo $c?><?php }?></b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"><?php echo $texts['text'];?></div>
                            </div>
                            <div class="row" >
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Default Align</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<?php 
									if($texts['align'] == '1'){
										echo 'Center';	
									}elseif($texts['align'] == '2'){
										echo 'Left';	
									}elseif($texts['align'] == '3'){
										echo 'Right';	
									}
								?>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Default X-Coor.</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"><?php if(!empty($texts['x'])) echo $texts['x'].'px';?></div>
                            </div>
                            <div class="row" >
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Default Y-Coor.</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"><?php if(!empty($texts['y'])) echo $texts['y'].'px';?></div>
                            </div>
                            <div class="row" >
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Default Size</b></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"><?php if(!empty($texts['s'])) echo $texts['s'].'px';?></div>
                            </div>
							<?php $c++;}}while($texts = mysqli_fetch_assoc($texts_query));
						}?>
                        
                        
                        </div>
                    </div>
                    <div class="col-lg-2" style="text-align:right; float:right;">
                        A$<?php 
                        $total_price = $cart['price'] * $cart['quantity'] / 1;
                        
                        //////WEIGHT START/////////////////
                        $prod_weight_query = mysqli_query($conn, "select * from sassy_product where id='".$cart['product_id']."' ");
                        $prod_weight_set = mysqli_fetch_assoc($prod_weight_query);
                        $unit_weight = $prod_weight_set['weight']; 
                        $sub_total_weight = $unit_weight * $cart['quantity'] / 1;
                        $weight+=$sub_total_weight;
                        $subtotal += $total_price;
                        echo number_format($total_price, 2, '.', '');
                        ?>
                    </div>
                </div>                    
                    <?php }while($cart=mysqli_fetch_assoc($cart_query));?>  
                    
                    
                    
                <div class="row" style="border-bottom:1px solid #CCC; ">
                    <div class="row" style="font-weight:bold;">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-7" style="text-align:right;"><b>Sub Total</b></div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5" style="text-align:right;">A$<?php echo number_format($subtotal, 2, '.', ''); ?></div>
                    </div>
                    
                    <?php /*
                    $discount_query = mysqli_query($conn, "SELECT * FROM client_discount WHERE session_id='".$session_id."' order by id desc limit 1");
                    $discount = mysqli_fetch_assoc($discount_query);
                    */?>
                    <!--<div class="row" style="font-weight:bold;">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-7" style="text-align:right;">
                        <?php if($discount_code != 'false'){ ?>
                            <?php if($discount['discount_status'] == '1'){?>
                                <b>Discount (<?php echo $discount['discount_rate']?>%)</b><br/><b>After Discount</b>
                            <?php }elseif($discount['discount_status'] == '2'){?>
                                <b>Discount</b><br/><b>After Discount</b>
                            <?php }else{}?>
                        <?php }?>                        
                        </div>-->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5" style="text-align:right;">
                            <?php if($discount_code != 'false'){ ?>
                                <?php if($discount['discount_rate'] !='' && $discount['final_price'] !='' ){ 
                                    if($discount['discount_status'] == '1'){
                                        echo '(A$'.$discount['discount_price'].")<br />";
                                    }elseif($discount['discount_status'] == '2'){
                                        echo '(A$'.$discount['discount_rate'].")<br />";
                                    }
                                        echo 'A$'.$discount['final_price'];
                                 }else{ ?>
                                        <!--A$0-->
                                <?php }?>
                            <?php }else{ echo "-"; }?>        
                        </div>
                    </div>
                    
                    <div class="row" style="font-weight:bold;">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-7" style="text-align:right;"><b>Delivery</b></div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5" style="text-align:right;">
                            <?php if($client_set['ship_cost']!='') echo 'A$'.number_format($client_set['ship_cost'], 2, '.', ''); else echo "-";?>        
                        </div>
                    </div>
                    <div class="row" style="font-weight:bold;">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-7" style="text-align:right;"><b>Grand Total</b></div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5" style="text-align:right;">
                        
                            <?php if($client_set['grand_total']!='') echo 'A$<span style="color:#090; font-size:22px;">'.number_format($client_set['grand_total'], 2, '.', '').'</span>'; else echo "-";?>        
                        
                        
                        </div>
                    </div>
                </div>        
                    
                    
                <div class="col-la-12 col-md-12 col-sm-12 col-xs-12" style=" par:60px;">
                    <h3 style="color:#F63;">Billing  Details</h3>
                    <hr style="border-bottom:1px solid #CCC;">
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">First Name</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['name'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">Paid Delivery Area:</label>
						<?php 
                        $selected_area_q = mysqli_query($conn, "select * from client_delivery where 
											session_id='".$client_set['session_id']."' ORDER BY id DESC LIMIT 1");
                        $selected_area = mysqli_fetch_assoc($selected_area_q);
                        
                        $area = "";
                        if($selected_area['selected_zone']){
                            $limited_area_q = mysqli_query($conn, "select * from zone_area where maincat_id='".$selected_area['selected_zone']."' ");
                            $limited_area = mysqli_fetch_assoc($limited_area_q);
                            $area = $limited_area['maincat_name'];
                        }
                        ?>            
                        
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"> <?php echo $area?></div>
                    </div>      
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">Address</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px; text-align:left;"><?php echo $str_convert->to_eye($client_set['address'])?></div>
                    </div>                    
                                  
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">Address (2)</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['address2'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">City</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['city'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">State</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['state'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">Country</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['country'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">Contact Number</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['mobilephone'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">Mobile Phone</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['telephone'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">Fax</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['fax'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">Email</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['email'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">New Recipient</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['new_recipient'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">New Recipient Address</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['new_recipient_address'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">Customer Note</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['customer_note'])?></div>
                    </div>                    
                    <div class="row par">
                        <label class="col-lg-3 col-md-3 col-sm-6 col-xs-6 control-label" style="text-align: left;">Admin's Note</label>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:4px;"><?php echo $str_convert->to_eye($client_set['note'])?></div>
                    </div>                    
                </div>
                        
                    
				<?php }else{?>
                    <div class="row"><div class="col-lg-12">YOUR BASKET CART ITEM IS EMPTY.</div></div>
                <?php }?>
                 
            </div>

       
                
            </div>
        </div>
    </div>

    <i id="backToTopContainer" class="clickable" style="display: none;"></i>

    <script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
    <script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
    
    <script type="text/javascript">
        window.gp.header.Start({customerName: '', basket: {"Items":[],"ItemCount":0,"ItemTotal":"£0.00","CheckoutDestination":"/basket.htm"}, 
        accountDescription: 'Me', menus: '[]' }, false);
    </script>
</body>
</html>
