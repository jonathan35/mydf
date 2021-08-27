<?php 
	require_once("../../config/ini.php");
	require_once("../../pro/security.php");
	session_start();
	
	//$cart_id=session_id();
	$order_id = $defenders->escapeInjection(base64_decode($_GET['id'])); 
	$client_query = mysqli_query($conn, "SELECT * FROM product_comfirm WHERE reference_id='".$order_id."' order by reference_id desc limit 1 ");
	$client_set = mysqli_fetch_assoc($client_query);
	
	$cart_id = $client_set['session_id'];
	 	 
	$view_cart_query = mysqli_query($conn, "SELECT * FROM product_cart WHERE session_id='".$cart_id."'");
	$cart_number = mysqli_num_rows($view_cart_query);
	$view_cart_Recordset1 = mysqli_fetch_assoc($view_cart_query);
	
    $total=0;
?>
<script type="text/javascript" src="../../js/mootools.js"></script>
<script type="text/javascript" src="../../js/calendar.rc4.js"></script>
<script type="text/javascript">		
	//<![CDATA[
		window.addEvent('domready', function() { 
			myCal1 = new Calendar({ date1: 'd/m/Y' }, { classes: ['dashboard'], direction: 1, tweak: {x: 3, y: -3} });
			myCal2 = new Calendar({ date2: 'd/m/Y' }, { classes: ['dashboard'], direction: 1, tweak: {x: 3, y: -3} });
			myCal3 = new Calendar({ date3: 'd/m/Y' }, { classes: ['dashboard'], direction: 1, tweak: {x: 3, y: -3} });
		});
	//]]>
</script>
<link rel="stylesheet" type="text/css" href="../.../css/dashboard.css" media="screen" />  
<LINK rel="stylesheet" href="../../css.css" type="text/css">
<link href="../style.css" rel="stylesheet" type="text/css" />

<form name="order1" method="post" action="order_confirm.php?comfirm=1">

<body style="margin:0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td>
  		<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
          	<td class="content_text2">
                <span class="title8">
            	&nbsp;Order No. <?php echo $client_set['reference_id']+1000?></span><br>
				<?php if($client_set['confirm_date']!='0000-00-00') 
			 echo "&nbsp;&nbsp;Order date: <span class=\"title9\">".date("dS M Y", strtotime($client_set['confirm_date']))."</span>";?><br />
             
             <?php 
			 if($client_set['status']==1) $print_status = "Order Received";
			 elseif($client_set['status']==2) $print_status = "Payment Received";
			 elseif($client_set['status']==0) $print_status = "Completed & Shipped";
			 else $print_status = "Order In Progress";
			 ?>
            &nbsp;&nbsp;Order status: <span class="title9"><?php echo $print_status?></span>

            </td>
            <?php 
			if($client_set['status']==1){
				$tab = "approvedondisplay";
			}else{
				$tab = "approvednotondisplay";
			}
			
            ?>
          </tr>        
        
          <tr valign="bottom">
          	
            <?php 
			if($client_set['status']==1){
				$tab = "approvedondisplay";
			}else{
				$tab = "approvednotondisplay";
			}
			
            ?>
            <td align="right" bgcolor="#FFFFFF" class="content01">
                <img src="../../images/preview_bg.png" border="1" style="border-color:#CCC; vertical-align:bottom;">
                <a href="customerList.php?tab=<?php echo $tab;?>" class="title6"><strong>BACK TO LISTING</strong></a>&nbsp;&nbsp;
    		</td>
          </tr>
        </table>
    </td>
  </tr>
   <tr>
      <td height="32" align="left" valign="top">
        <div class="gradient5" style="margin-top:0px;">
            <h1><span></span>CUSTOMER SELECTED ITEM</h1>
        </div>
      
      </td>
   </tr>

  <tr>
    <td>
          <TABLE cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
          <TBODY>
            <TR>
              <TD id=basketLineItem vAlign=top align=right>
              <?php if($success!=''){?>
			  <img src="../../images/warning_success.gif" width="19" height="20" style="vertical-align:middle;">
			  <?php echo $success;}?>
              
<table cellspacing=0 cellpadding=5 width="100%" align=center border=0 class="content_text2">
                <TBODY>
            <TR>
              <TD id=basketLineItem vAlign=top align=right>
              <?php if($success!=''){?>
			  <img src="../../images/warning_success.gif" width="19" height="20" style="vertical-align:middle;">
			  <?php echo $success;}?>
              <table cellspacing=0 cellpadding="5" width="100%" align=center  class="content_text2" border=0>
                <tbody>
                  <tr>
                    <td align="right" colspan="5"></td>
                  </tr>
                  <tr bgcolor="#EFEFEF">
                    <td class="basketHeader" align="center" width="180">Product</td>
                    <td width="631" align="center" class="basketHeader">Product Detail</td>
                    <td width="54" align="center" class="basketHeader">Qty.</td>
                    
                    <td width="68" align="center" class="basketHeader">Unit Price</td>
                    <td width="65" align="center" class="basketHeader">Total</td>
                  </tr>
                  <!--Basket Line Items-->
                  <?php 
				  if ($cart_number > 0){
				  do{ 
				  $required_editing_id=$view_cart_Recordset1['id'];

				$layout_query=mysqli_query($conn, "SELECT cust_background FROM design_layout WHERE product_id='".$view_cart_Recordset1['product_id']."' and layout_name='".$view_cart_Recordset1['layout_name']."' ");
				$layout_Recordset1=mysqli_fetch_assoc($layout_query);

				  $color_qry = "SELECT * FROM color_db WHERE id='".$view_cart_Recordset1['color']."' ";					 
				  $color_set = mysqli_query($conn, $color_qry) or die(mysqli_error());
				  $color_record = mysqli_fetch_assoc($color_set);					  	  
				 
				 ?>
                  <tr valign="middle">
                    <td id=basketLineItem2 valign=center align="middle">
                         <table width="120" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><img width="180" height="180" src="../../<?php echo $view_cart_Recordset1['final_img']?>" <?php if($layout_Recordset1['cust_background']=='1'){?>style="border:#F00 solid 1px;"<?php }?>></td>
                          </tr>
                        </table>
                    </td>
					<?php 
						$prod_desc_query = mysqli_query($conn, "select brief, product_code, weight, option_status, option_available from sassy_product where id='".$view_cart_Recordset1['product_id']."' ");
						$prod_desc_set = mysqli_fetch_assoc($prod_desc_query);
                    ?>

                    <td class="copyright">
					<?php 
						if($prod_desc_set['product_code']!=''){
							echo "Product code: ".$prod_desc_set['product_code']."<br><br>";
						}
						
						if($layout_Recordset1['cust_background']=='1'){
							echo "<div style=\"border:1px #f00 solid; padding:1px 2px 1px 5px; color:#F00;\">Customise Background</div><br />";
						}			
						
						
						if($prod_desc_set['brief']!=''){
							echo $prod_desc_set['brief']."<br /><br />";
						}
						
					 	?>
					

<table width="98%" border="0" cellspacing="0" cellpadding="0" class="title3" align="left">
  <tr>
    <td width="32%" colspan="2" background="../../images/h_separator.png" style="background-repeat:repeat-x; background-position:center;">
        <img src="../../images/space.gif" width="20" height="12" />
    </td>
  </tr>

<?php if($view_cart_Recordset1['layout_name']!=''){ ?>
  <tr>
    <td width="48%">Layout:</td>
    <td width="52%"><?php echo $view_cart_Recordset1['layout_name']; ?></td>
  </tr>
<?php } ?> 
<?php if($view_cart_Recordset1['text01']!=''){ ?>
  <tr>
    <td>Text Line 1:</td>
    <td><?php echo $view_cart_Recordset1['text01']; ?></td>
  </tr>
<?php } ?> 
<?php if($view_cart_Recordset1['text02']!=''){ ?>
  <tr>
    <td>Text Line 2:</td>
    <td><?php echo $view_cart_Recordset1['text02']; ?></td>
  </tr>
<?php } ?> 
<?php if($view_cart_Recordset1['text03']!=''){ ?>
  <tr>
    <td>Text Line 3:</td>
    <td><?php echo $view_cart_Recordset1['text03']; ?></td>
  </tr>
<?php } ?> 
<?php if($view_cart_Recordset1['font']!=''){ ?>
  <tr>
    <td width="48%">Text Selected:</td>
    <td width="52%">
		<?php 
		$bg_query=mysqli_query($conn, "select * from font_db where font='".$view_cart_Recordset1['font']."' and status=1 ");
		$bg_set=mysqli_fetch_assoc($bg_query);
		echo $bg_set['font_name']; 
		?>	
	<?php //echo str_replace("font/","",$view_cart_Recordset1['font']); ?>
    </td>
  </tr>
<?php } ?> 
<?php if($view_cart_Recordset1['color']!=''){ ?>
  <tr valign="top">
    <td width="48%">Font Colour Selected:</td>
    <td width="52%">
		<?php 
		$color_query=mysqli_query($conn, "select * from color_db where id='".$view_cart_Recordset1['color']."' ");
		$color_set=mysqli_fetch_assoc($color_query);
		echo $color_set['color_name'];
		?>
    </td>
  </tr>
<?php } ?> 
<?php if($view_cart_Recordset1['background']!=''){ ?>
  <tr>
    <td width="48%">Background Colour Selected:</td>
    <td width="52%">
		<?php 
		$bg_query = mysqli_query($conn, "select * from background_db where photo1='".str_replace("../../photo/","photo/",$view_cart_Recordset1['background'])."' and status=1 ");
		$bg_set=mysqli_fetch_assoc($bg_query);
		echo $bg_set['background_name']; 
		?>	
	
	</td>
  </tr>
<?php } ?> 
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

				<?php if($prod_desc_set['option_status']=='on'){ ?>
                    
                        <table width="100%" border="0" class="copyright" cellpadding="2" cellspacing="2">
                          <tr>
                            <td bgcolor="#EFEFEF" width="85" align="center">Select</td>
                            <td bgcolor="#EFEFEF" width="250" align="left">Additional options</td>
                            <td bgcolor="#EFEFEF" width="95" align="center">Price A$</td>
                          </tr>
                <?	
                                            
                    $product_option = explode("|", $prod_desc_set['option_available']);

                     $option_available = '';
                     $count = 1;
                     foreach ($product_option as $key => $option){
                        if ($option == ''){
                            unset($option_array[$key]);
                        }else{
                            if($count !='1'){
                                $option_available .= ',';
                            }
                            $count ++;
                            $option_available .= $option;
                        }
                    }
                    
                    $option_query = mysqli_query($conn, "SELECT * FROM additional_option WHERE status='1' and id IN ($option_available) ORDER BY option_name ASC");
                    $option_set = mysqli_fetch_assoc($option_query);										

                          do{ 
                                $cart_option_query = mysqli_query($conn, "SELECT * FROM product_cart WHERE session_id='".$cart_id."' 
                                                                 and product_id='".$view_cart_Recordset1['product_id']."' AND option_id !='0' 
                                            AND option_id LIKE '%|".$option_set['id']."|%'");
                                            
                                $cart_option_set = mysqli_num_rows($cart_option_query);
                        
                                 ?>	
                                      <tr>
                                        <td align="center">
                                            <input 
                                                type="checkbox" 
                                                name="option<?php echo $view_cart_Recordset1['id'].'-'.$option_set['id'];?>" 
                                                value="<?php echo $option_set['id'];?>" disabled  
                                                <?php if(strstr($view_cart_Recordset1['option_id'], '|'.$option_set['id'].'|')){?> checked <?php }?>>
                                        </td>
                                        <td align="left"><?php echo $option_set['option_name'] ?></td>
                                        <td align="center"><?php echo $option_set['option_price'] ?></td>

                                      </tr>
                              
                          <?php }while($option_set = mysqli_fetch_assoc($option_query));?> 
                        </table>
					<?php }?>


                    </td>
                    <td id=basketLineItem2 valign=middle align="center">
                    
                    
                    <table width="10%" border="0" cellspacing="0" cellpadding="0" height="30" >
                      <tr>
                        <td class="content_text2"><?php echo $view_cart_Recordset1['quantity']; ?></td>
                      </tr>
                    </table>
                      </td>
                    <td id=basketLineItem2 valign=middle align="center"><?php 
						  $price=$view_cart_Recordset1['unit_price']; 

							echo "A$".number_format($price, 2, '.', '');	
						  
						  $product_collection_price = $product_collection_price.$price."|";
					  ?></td>
                    <td id="basketLineItem2" valign="middle" align="center"> A$<?php 
						$cart01 = 0;
						//$cart01 = $price * $view_cart_Recordset1['quantity'] / 1;
						
						///////////////////OPTION//////////////////////////////////////
						/*$option_array = explode("|", $view_cart_Recordset1['option_id']);
						
						foreach ($option_array as $key => $option){
							if ($option == ''){
								unset($option_array[$key]);
							}else{
								$option_cart_query = mysqli_query($conn, "SELECT * FROM additional_option WHERE status='1' and id= '".$option."' ");
								$option_cart = mysqli_fetch_assoc($option_cart_query);
								
								if(!empty($option_cart['option_price'])){
										$cart01 += $option_cart['option_price'];
								}
								
							}
						}*/
						
						$cart02 = $price * $view_cart_Recordset1['quantity'] / 1;
						//////WEIGHT START/////////////////
						$prod_weight_query=mysqli_query($conn, "select * from sassy_product where id='".$view_cart_Recordset1['product_id']."' ");
						$prod_weight_set=mysqli_fetch_assoc($prod_weight_query);
						$unit_weight = $prod_weight_set['weight']; 
						
						$sub_total_weight = $unit_weight * $view_cart_Recordset1['quantity'] / 1;
						
						$weight+=$sub_total_weight;
						//////WEIGHT END/////////////////
						
						
						$total+=$cart02;
	//echo round($cart01, 2); 
						echo number_format($cart02, 2, '.', '');
					?>
                      <!--Total Line Item Price--></td>
                  </tr>
                  <tr>
                  	<td colspan="5" background="../../images/h_separator.png" style="background-repeat:repeat-x;">
                    	<img src="../../images/space.gif" height="1" >
                    </td>
                  </tr>
                  <?php }while($view_cart_Recordset1=mysqli_fetch_assoc($view_cart_query));	  
	  }else{
	  ?>
                  <tr>
                    <td colspan="5" align="middle" valign=center id=basketLineItem2><br> YOUR BASKET CART ITEM IS EMPTY. </td>
                  </tr>
                  <?php } ?>

                  <!--Additional Buttons & Summary Information-->
                      <tr>
                        <td colspan="6">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:0px 4px 0px 4px;">

<tr>
                    <td valign=top colspan=2 rowspan=7>&nbsp;</td>
                    <td width="185" rowspan=7 align="right" valign=top><?php if ($cart_number!='0'){?>
                      <input name="image" type=image title="" src="../../images/spacer.gif" alt="" width=0 height=0>
                      <div id=clickHereToRecalculateTotalsDIV style="DISPLAY: none; WIDTH: 100px"> <img class="Up Arrow" src="../../images/up_arrow.gif">
                        <?php } ?>
                        <table class=updateQuantitiesAlert cellspacing=0 
                        cellpadding=3 width="100%">
                          <tbody>
                            <tr>
                              <td class=updateQuantitiesAlertText align="middle"><?php if ($cart_number!='0'){?>
                                Click here to update quantities &amp; recalculate totals.
                                <?php } ?>
                                <div></div></td>
                            </tr>
                          </tbody>
                        </table>
                      </div></td>
                    <!--Sub Total-->
                    <td width="187" align="right" id=basketLineItemLoopLeft class="content_text2"><b>Sub Total</b>&nbsp;&nbsp;</td>
                    <td width="73" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="100%" align="center"><?php echo "A$". number_format($total, 2, '.', ''); ?></td>
                      </tr>
                    </table></td>
                  </tr>

                        </table>
                        </td>
                      </tr>

                  
                  
                  
                  <!-- Grand Total -->
                  
                    <?php 
				  	$delivery_query=mysqli_query($conn, "select * from free_flow_text");
					$delivery=mysqli_fetch_assoc($delivery_query);
				  ?>

                </table></TD>
            </TR>
            <tr>
            	<td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                  	<?php 
						$discount_query = mysqli_query($conn, "SELECT * FROM client_discount WHERE session_id='".$cart_id."' order by id desc limit 1");
						$discount = mysqli_fetch_assoc($discount_query);
					?>
                  	<td width="31%" align="right">&nbsp;</td>
                    <td width="31%" align="left">&nbsp;</td>
                    <td width="4%" align="center">&nbsp;</td>
                    <td width="14%" valign="middle" align="right" class="content_text2">
                    <?php if($discount!= ''){ ?>
                        <?php if($discount['discount_status'] == '1'){?><b>Discount (<?php echo $discount['discount_rate']?>%)</b><br/><b>After Discount</b><?php 
							}elseif($discount['discount_status'] == '2'){?><b>Discount</b><br/><b>After Discount</b><?php }else{}?>
                    <?php }?>                        
                    </td>
                    <td width="13%" align="center" class="content_text2">
                    	<?php if($discount != ''){ ?>
							<?php if($discount['discount_rate'] !='' && $discount['final_price'] !='' ){ 
                                if($discount['discount_status'] == '1'){
                                    echo "(A$".$discount['discount_price'].")<br />";
                                }elseif($discount['discount_status'] == '2'){
                                    echo "(A$".$discount['discount_rate'].")<br />";
                                }
                                    echo "A$".$discount['final_price'];
                             }else{ ?>
                                    -
                            <?php }?>
                    <?php }else{ echo "-"; }?>
                    </td>
                  </tr>
                  
                  <tr valign="top">
                    <td width="31%" align="right">&nbsp;</td>

                  
<?php                 
$zone_query=mysqli_query($conn, "SELECT * FROM zone_area WHERE status=1 ORDER BY position ASC, maincat_name asc") or die(mysqli_error());
$zone_set = mysqli_fetch_assoc($zone_query);

?>
                    <td width="38%" align="center"></td>
                    <td width="4%" valign="middle" align="right" height="25">&nbsp;</td>
                    <td width="14%" valign="middle" align="right" class="content_text2"><b>Delivery</b></td>
					<td width="13%" align="center" valign="middle" class="content_text">
					
					
					<?php 
//$delivery_charges = base64_decode($_GET['d']);
					
//if($delivery_charges==''){
$price_q = mysqli_query($conn, "SELECT * FROM client_delivery WHERE session_id='".$cart_id."' and status=1 order by id desc limit 1");
$deliver_prc = mysqli_fetch_assoc($price_q);
$delivery_charges = $deliver_prc['final_price'];
//$delivery_charges = $client_set['ship_cost'];
//}
					
					
					if($delivery_charges!='') echo "A$ ".number_format($delivery_charges, 2, '.', ''); else echo "-&nbsp;&nbsp;&nbsp;&nbsp;";
					
					?>
                    <!--<input type="hidden" name="final_delivery_charges" value="<?php //echo $delivery_charges?>"> -->
                    </td>
                  </tr>
                  
                  <tr>
                  	<td colspan="5">
                    	<img src="../../images/space.gif" height="2" >
                    </td>
                  </tr>                  
                  <tr>
                  	<td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align=right>&nbsp;</td>
                    <td align="right" class="content_text2" height="30"><b>Grand Total</b></td>
                    <td align="center" class="title9" style="text-decoration:underline;">
					<?php 
						if($discount['final_price'] != ''){	
							
							$grant_total= $discount['final_price'] + $delivery_charges;
						
						}else{
							
							$grant_total= $total + $delivery_charges;
						}

							echo "A$".number_format($grant_total, 2, '.', ''); ?>

				  </td>
                 
                  
                  
                  
                  </tr>


                </table>
                </td>
            </tr>
          </table>              
              
              </TD>
            </TR>
          </TABLE>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="right">&nbsp;</td>
              </tr>              
              
            </table>
        
    
    
    
    <!--222222 -->
    </td>
  </tr>
  

  
  
<tr>
          <td height="32" align="left" valign="middle">
                      <div class="gradient5">
                <h1><span></span>BILLING DETAILS</h1>
            </div>
          
          </td>
        </tr>
  <tr align="center">
        <td><table width="80%" border="0" align="center" cellpadding="2" cellspacing="2">
          <tr align="left">
            <td width="28%" class="navigation1"> Name</td>
            <td width="5%" valign="top">:</td>
            <td width="67%">
            <input type="text" name="fname" id="fname" style="width:220px;" readonly="readonly" value="<?php echo $client_set['name']?>"/>
            </td>
            <input type="hidden" name="delivery_charges" value="<?php echo $delivery_charges?>"/>
            <input type="hidden" name="sub_total" value="<?php echo $total?>"/>
            <input type="hidden" name="grand_total" value="<?php echo number_format($grant_total, 2, '.', '')?>"/>

          </tr>
          <tr align="left">
            <td valign="top" class="navigation1">Delivery Address<br /></td>
            <td valign="top">:</td>
            
<?php 
$limited_area_q = mysqli_query($conn, "select * from zone_area where maincat_id='".$deliver_prc['selected_zone']."' and status=1");
$limited_area = mysqli_fetch_assoc($limited_area_q);
$area = $limited_area['maincat_name'];
?>            
            <td class="title10"><textarea name="address" id="address" style="width:220px;" rows="5" readonly="readonly"><?php echo $client_set['address']?></textarea>
              <br />
              <span style="color:#F00; font-size:12px;">
         Selected Delivery Method:<br>
		    	<?php echo $area?></span>
            </td>
          </tr>
          <tr align="left">
            <td class="navigation1">Contact Number</td>
            <td valign="top">:</td>
            <td><input type="text" name="phone" id="phone" style="width:220px;" readonly="readonly" value="<?php echo $client_set['telephone']?>" /></td>
          </tr>
          <tr align="left">
            <td class="navigation1">Mobile Phone</td>
            <td valign="top">:</td>
            <td><input type="text" name="mobile" id="mobile" style="width:220px;"  readonly="readonly" value="<?php echo $client_set['mobilephone']?>"/></td>
          </tr>
          <tr align="left">
            <td class="navigation1">Fax</td>
            <td valign="top">:</td>
            <td><input type="text" name="fax" id="fax" style="width:220px;" readonly="readonly" value="<?php echo $client_set['fax']?>" /></td>
          </tr>
          <tr align="left">
            <td class="navigation1">Email</td>
            <td valign="top">:</td>
            <td><input type="text" name="email" id="email" style="width:220px;" readonly="readonly" value="<?php echo $client_set['email']?>" />
            </td>
          </tr>
          <?php if(!empty($client_set['note'])){?>
          <tr align="left">
            <td class="navigation1" valign="top">Note</td>
            <td valign="top">:</td>
            <td><?php 
				$find = array("<p>","</p>");
				echo str_replace($find,'',$client_set['note']);?></td>
          </tr>
          <?php }?>
        </table></td>
  </tr>
</table>
</form>
</body>

