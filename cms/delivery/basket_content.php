<?php 
	 require_once("../../config/ini.php");
	 
	 //$cart_id=session_id();
	 //$user = $_SESSION['username'];
	 $currentPage=$_SERVER['PHP_SELF'];
	 
 
     $total=0;
	 $weight=0;
     $hidden_id='';
	 $product_collection_price='';	  
	 mysqli_select_db($conn, $database_conn);

	 if ($_POST['submit']=='buy')
	 {
		$maincat=mysqli_real_escape_string($conn, $_POST['cart_product_id']);
		$prod_name=mysqli_real_escape_string($conn, $_POST['cart_layout_name']);
		
		$text01 = mysqli_real_escape_string($conn, $_POST['cart_text1']);
		$text02 = mysqli_real_escape_string($conn, $_POST['cart_text2']);
		$text03 = mysqli_real_escape_string($conn, $_POST['cart_text3']);
		
		$cart_a01 = mysqli_real_escape_string($conn, $_POST['cart_a1']);
		$cart_a02 = mysqli_real_escape_string($conn, $_POST['cart_a2']);
		$cart_a03 = mysqli_real_escape_string($conn, $_POST['cart_a3']);
		
		$x01 = mysqli_real_escape_string($conn, $_POST['cart_x1']);
		$x02 = mysqli_real_escape_string($conn, $_POST['cart_x2']);
		$x03 = mysqli_real_escape_string($conn, $_POST['cart_x3']);

		$y01 = mysqli_real_escape_string($conn, $_POST['cart_y1']);
		$y02 = mysqli_real_escape_string($conn, $_POST['cart_y2']);
		$y03 = mysqli_real_escape_string($conn, $_POST['cart_y3']);
		
		$r01 = mysqli_real_escape_string($conn, $_POST['cart_r1']);
		$r02 = mysqli_real_escape_string($conn, $_POST['cart_r2']);
		$r03 = mysqli_real_escape_string($conn, $_POST['cart_r3']);
		
		$s01 = mysqli_real_escape_string($conn, $_POST['cart_s1']);
		$s02 = mysqli_real_escape_string($conn, $_POST['cart_s2']);
		$s03 = mysqli_real_escape_string($conn, $_POST['cart_s3']);
		
		$max01 = mysqli_real_escape_string($conn, $_POST['cart_max1']);
		$max02 = mysqli_real_escape_string($conn, $_POST['cart_max2']);
		$max03 = mysqli_real_escape_string($conn, $_POST['cart_max3']);
		
		

		$color = mysqli_real_escape_string($conn, $_POST['cart_pre_color']);
		$background = mysqli_real_escape_string($conn, $_POST['cart_background']);
		$font = mysqli_real_escape_string($conn, $_POST['cart_fontfile']);
		
		$price = mysqli_real_escape_string($conn, $_POST['cart_price']);
		
		$date_posted=date("Y-m-d");
	
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE START///////////////////
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE START///////////////////
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE START///////////////////
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE START///////////////////
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE START///////////////////
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE START///////////////////

	$font = str_replace("../../","",$font);
	$RGB_qry = mysqli_query($conn, "SELECT * FROM color_db WHERE id='".$color."' ");			 
	$RGB_set = mysqli_fetch_assoc($RGB_qry);	

//header("Content-type: image/png");


//START-----THIS PART IS FOR ANTI-ALIAS BETWEEN BACKGROUN COLOR WITH FONT COLOR////
//THE TASK IS TO DETECT THE MIDDLE BACKGROUND COLOR- and craete the aliasing color/////

$the_background = str_replace("../../","",$background);

$getExt = explode ('.', $the_background);
$file_ext = $getExt[count($getExt)-1];

if($file_ext=='jpeg' || $file_ext=='jpg' || $file_ext=='png' || $file_ext=='gif'){
	
	$im = imagecreatetruecolor (300, 300);
	
	if($file_ext=='jpeg' || $file_ext=='jpg'){
	$background_im = imagecreatefromjpeg($the_background);
	$im = imagecreatefromjpeg($the_background);
	}
	if($file_ext=='png'){
	$background_im = imagecreatefrompng($the_background);
	$im = imagecreatefrompng($the_background);
	}
	if($file_ext=='gif'){
	$background_im = imagecreatefromgif($the_background);
	$im = imagecreatefromgif($the_background);
	}
	
	// get a color
	if($_GET['cart']=='1'){
			$start_x = 75;
			$start_y = 75;
	}else{
			$start_x = 150;
			$start_y = 150;
	}
	$color_index = imagecolorat($background_im, $start_x, $start_y);
	
	// make it human readable
	$color_tran = imagecolorsforindex($background_im, $color_index);
	
	// what is it ?
	//print_r($color_tran);
	$background_color = imagecolorallocate ($im, $color_tran[red], $color_tran[green], $color_tran[blue]);
}else{
	$background_color = imagecolorallocate ($im, 255, 255, 255);
}

//END-----THIS PART IS FOR ANTI-ALIAS BETWEEN BACKGROUN COLOR WITH FONT COLOR////
//THE TASK IS TO DETECT THE MIDDLE BACKGROUND COLOR/////

$text_color = imagecolorallocate ($im, $RGB_set['r_color'], $RGB_set['g_color'], $RGB_set['b_color']);
		
		
		
		$x1 = $x01;
		/////////////////////THIS PART IS TO CONTROL THE TEXT IS WITHIN THE LIMITED SIZE -- START////////////////
		if($max01!=''&&$max01!='0'){
			$max_weight01 = $max01;
		}else{
			$max_weight01 = 300-20-$x01;
		}		
			$max_box_width01 = $max_weight01;
			$get_size01 = $s01;
				$check_bbox1 = imagettfbbox($get_size01, $r01, $font, $text01);
				$current_box_width01 = (abs($check_bbox1[2]) - abs($check_bbox1[0]));
			
			if($current_box_width01 > $max_box_width01){
				
				for ($j = $get_size01; $j > 1; $j--){
					$find_bbox1 = imagettfbbox($j, $r01, $font, $text01);
					$find_box_width01 = (abs($find_bbox1[2]) - abs($find_bbox1[0]));
						if($find_box_width01 > $max_box_width01){
							$font_size01 = $j-1;
						}
				}
			}
			if($font_size01=='')$font_size01 = $s01;
		
		/////////////////////THIS PART IS TO CONTROL THE TEXT IS WITHIN THE LIMITED SIZE -- END////////////////		
		$center_check1 = $cart_a01;
		if($center_check1=='1'){
				$bbox1 = imagettfbbox($font_size01, $r01, $font, $text01);	
				$x1 = ((300-(abs($bbox1[2]) - abs($bbox1[0])))/2);
				$x1 = $x1;
			}elseif($center_check1=='3'){
				$bbox1 = imagettfbbox($font_size01, $r01, $font, $text01);	
				$x1 = ((300-(abs($bbox1[2]) - abs($bbox1[0])))-$x01);
				$x1 = $x1;
			}		
		$x1 = $x1;
		$y1 = $y1;
		//imagettftext($im, 11, $r01, 22, $_GET['y1'], $text_color, "arial.ttf", $font);
		imagettftext($im, $font_size01, $r01, $x1, $y01, $text_color, $font, $text01);




		$x2 = $x02;
		/////////////////////THIS PART IS TO CONTROL THE TEXT IS WITHIN THE LIMITED SIZE -- START////////////////
		if($max02!=''&&$max02!='0'){
			$max_weight02 = $max02;
		}else{
			$max_weight02 = 300-20-$x02;
		}
		
			$max_box_width02 = $max_weight02;
			$get_size02 = $s02;
				$check_bbox2 = imagettfbbox($get_size02, $r02, $font, $text02);
				$current_box_width02 = (abs($check_bbox2[2]) - abs($check_bbox2[0]));
			
			if($current_box_width02 > $max_box_width02){
				
				for ($j = $get_size02; $j > 1; $j--){
					$find_bbox2 = imagettfbbox($j, $r02, $font, $text02);
					$find_box_width02 = (abs($find_bbox2[2]) - abs($find_bbox2[0]));
						if($find_box_width02 > $max_box_width02){
							$font_size02 = $j-1;
						}
				}
			}
			if($font_size02==''){$font_size02 = $s02;}

		/////////////////////THIS PART IS TO CONTROL THE TEXT IS WITHIN THE LIMITED SIZE -- END////////////////
		
		
		$center_check2 = $cart_a02;
			if($center_check2=="1"){
				
					$bbox2 = imagettfbbox($font_size02, $r02, $font, $text02);	
					$x2 = ((300-(abs($bbox2[2]) - abs($bbox2[0])))/2);
					$x2 = $x2;
			}elseif($center_check2=='3'){
				$bbox2 = imagettfbbox($font_size02, $r02, $font, $text02);	
				$x2 = ((300-(abs($bbox2[2]) - abs($bbox2[0])))-$x02);
				$x2 = $x2;
			}		
		$x2 = $x2;
		$y2 = $y2;
		imagettftext($im, $font_size02, $r02, $x2, $y02, $text_color, $font, $text02);
	
	
	
	
	
		$x3 = $x03;
		/////////////////////THIS PART IS TO CONTROL THE TEXT IS WITHIN THE LIMITED SIZE -- START////////////////
		if($max03!=''&&$max03!="0"){
			$max_weight03 = $max03;
		}else{
			$max_weight03 = 300-20-$x03;
		}
			$max_box_width03 = $max_weight03;
			$get_size03 = $s03;
				$check_bbox3 = imagettfbbox($get_size03, $r03, $font, $text03);
				$current_box_width03 = (abs($check_bbox3[2]) - abs($check_bbox3[0]));
			
			if($current_box_width03 > $max_box_width03){
				
				for ($j = $get_size03; $j > 1; $j--){
					$find_bbox3 = imagettfbbox($j, $r03, $font, $text03);
					$find_box_width03 = (abs($find_bbox3[2]) - abs($find_bbox3[0]));
						if($find_box_width03 > $max_box_width03){
							$font_size03 = $j-1;
						}
				}
			}
			if($font_size03=='')$font_size03 = $s03;

		/////////////////////THIS PART IS TO CONTROL THE TEXT IS WITHIN THE LIMITED SIZE -- END////////////////
		
		$center_check3 = $cart_a03;
		if($center_check3=='1'){
				$bbox3 = imagettfbbox($font_size03, $r03, $font, $text03);	
				$x3 = ((300-(abs($bbox3[2]) - abs($bbox3[0])))/2);
				$x3 = $x3;
		}elseif($center_check3=='3'){
				$bbox3 = imagettfbbox($font_size03, $r03, $font, $text03);	
				$x3 = ((300-(abs($bbox3[2]) - abs($bbox3[0])))-$x03);
				$x3 = $x3;
		}
		$x3 = $x3;
		$y3 = $y3;
		imagettftext($im, $font_size03, $r03, $x3, $y03, $text_color, $font, $text03);		
	$rand_name = uniqid('').'.png';
	$created_img = "png_../../images/".$rand_name;
	if(imagepng ($im,"png_../../images/$rand_name","0")){
		$success_create_img = '1';
		
		
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE END///////////////////
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE END///////////////////
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE END///////////////////
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE END///////////////////
/////////////////GENERATE THE PNG FILE AND SAVE IT SOME WHERE END///////////////////			
	
	
	
	
		if(mysqli_query($conn, "INSERT INTO product_cart ( session_id, unit_price, quantity, product_id, layout_name, status,
												   text01, text02, text03, align01, align02, align03,
												   x01, x02, x03, y01, y02, y03,
												   r01, r02, r03, s01, s02, s03,
												   color, font, background, final_img ) 
		values ('".$cart_id."', '".$price."', '1', '".$maincat."','".$prod_name."','1',
													'".$text01."','".$text02."','".$text03."',
													'".$cart_a01."','".$cart_a02."','".$cart_a03."',
													'".$x01."','".$x02."','".$x03."','".$y01."','".$y02."','".$y03."',
													'".$r01."','".$r02."','".$r03."','".$s01."','".$s02."','".$s03."',
													'".$color."','".$font."','".$background."','".$created_img."' )")){		
			$success='<font color="#336600">Product added</font>';
		}else{
			$success='<font color="#CC3300">Failed to add Product</font>';
		}
	 }
	}
	
	
	$view_cart_query=mysqli_query($conn, "SELECT * FROM product_cart WHERE session_id='".$cart_id."'");
	$cart_number=mysqli_num_rows($view_cart_query);
	$view_cart_Recordset1=mysqli_fetch_assoc($view_cart_query);	
	
	
	
?> 
<HTML>
<HEAD>
<TITLE>Welcome to Pretty Petals - The florist who cares</title>
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK rel="stylesheet" href="../../css.css" type="text/css">
<SCRIPT language=javascript>
//Do not delete these lines. Used in Menu Javascript. 
var everythingLoaded =false;
var m_sstore_url=""
var m_sshop_args =""
var m_sshop_args_iis =""
var m_samp = ""
</SCRIPT>			
<SCRIPT language="JavaScript" type="text/javascript" src="../../js/js.js" ></script>
		
<script language="javascript">
function addtofavorite()
{
	if( window.sidebar && window.sidebar.addPanel)
	{
		window.sidebar.addPanel( this.title, this.href, '');
	}
	else if( window.external && navigator.platform == 'Win32')
	{
		window.external.AddFavorite(location.href, document.title);
	}
	else if( window.opera && window.print )
	{
		return true;
	}
	else if( document.layers )
	{
		window.alert( 'Please click OK then press Ctrl+D to create a bookmark' );
	}
	else
	{
		window.alert( 'Please use your browser\'s bookmarking facility to create a bookmark' );
	}
	return false;
}
</script>
<SCRIPT language=JavaScript>
function changeQty(objName,mathematics){
		place = eval('document.basketform.' + objName)
		place.value = parseInt(place.value) + parseInt(mathematics);
		if (place.value < 0)
		{
			place.value = 0;
		}
		if (isNaN(place.value))
		{
			place.value = 1;
		}
}
function showDisplayTable(tableToShow){
	if (document.layers) { // < NN6
		document.layers[tableToShow].display = '';
	} else if (document.all) { // IE
		document.all[tableToShow].style.display = '';
	} else if (document.getElementById) { // NN6
		var lyr = getMyHTMLElement(tableToShow);
		if (lyr && lyr.css) lyr.css.display = "";
	}
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</SCRIPT>		
	<style type="text/css">
<!--
.style1 
{	
	color: #EC53BE;
	font-family: Verdana;
	font-weight:bold;
}
-->
</style>
</HEAD>

	<BODY>
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="1%" valign="top"><img src="../../images/space.gif" width="10" height="250"></td>
        <td width="98%" align="left" valign="top">
        
        
        <form name="basketform" method="post" action="xt_orderform_update_quantities.php">
          <TABLE cellSpacing="0" cellPadding="5" width="100%" align="center" border="0">
          <TBODY>
            <TR>
              <TD id=basketLineItem vAlign=top align=right>
              <?php if($success!=''){?>
			  <img src="../../images/warning_success.gif" width="19" height="20" style="vertical-align:middle;">
			  <?php echo $success;}?>
              <table cellspacing=0 cellpadding="5" width="100%" align=center  class="content_text2"
                  border=0>
                <tbody>
                  <tr>
                    <td align="right" colspan="5"></td>
                  </tr>
                  <tr bgcolor="#EFEFEF">
                    <td class="basketHeader" align="center" width="173">Product</td>
                    <td width="415" align="center" class="basketHeader">Product Detail</td>
                    <td width="132" align="center" class="basketHeader">Qty.</td>
                    
                    <td width="133" align="center" class="basketHeader">Unit Price</td>
                    <td width="108" align="center" class="basketHeader">Total</td>
                  </tr>
                  <!--Basket Line Items-->
                  <?php 
				  if ($cart_number > 0){
				  do{ 
				  $required_editing_id=$view_cart_Recordset1['id'];
				  /*$edit_query_Recordset = "SELECT * FROM product WHERE id='$required_editing_id' ";					 
				  $edit_Recordsetexist = mysqli_query($conn, $edit_query_Recordset) or die(mysqli_error());
				  $edit_row_Recordsetexist = mysqli_fetch_assoc($edit_Recordsetexist);					  	  */
				 
				  $color_qry = "SELECT * FROM color_db WHERE id='".$view_cart_Recordset1['color']."' ";					 
				  $color_set = mysqli_query($conn, $color_qry) or die(mysqli_error());
				  $color_record = mysqli_fetch_assoc($color_set);					  	  
				 
				 ?>
                  <tr valign="middle">
                    <td id=basketLineItem2 valign=center align="middle">
                         <table width="120" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><img width="120" height="120" src="<?php echo $view_cart_Recordset1['final_img']?>"></td>
                          </tr>
                        </table>
                    </td>
<?php 
$prod_desc_query=mysqli_query($conn, "select brief, product_code,weight from sassy_product where id='".$view_cart_Recordset1['product_id']."' ");
$prod_desc_set=mysqli_fetch_assoc($prod_desc_query);
?>

                    <td class="copyright">
					<?php 
					if($prod_desc_set['product_code']!=''){
						echo "Product code: ".$prod_desc_set['product_code']."<br><br>";
					}
					if($prod_desc_set['brief']!=''){
						echo $prod_desc_set['brief']."<br>";
					}
					?>
                    </td>
                    <td id=basketLineItem2 valign=middle align="center">
                    
                    
                    <table width="10%" border="0" cellspacing="0" cellpadding="0" height="30" >
                      <tr>
                        <td>
                        <input name="<?php echo 'qty_'.$view_cart_Recordset1['id']; ?>" class=textFieldNoWidth id="<?php echo 'qty_'.$view_cart_Recordset1['id']; ?>" title="Please click 'Update Quantities' button after you have made the change." onChange="showDisplayTable('clickHereToRecalculateTotalsDIV'); if (isNaN(document.basketform.<?php echo 'qty_'.$view_cart_Recordset1['id']; ?>.value)){ alert('Please enter a digit'); return false;}" alt="Please click 'Update Quantities' button after you have made the change." value="<?php echo $view_cart_Recordset1['quantity']; ?>" style="width:16px; border:solid 1px #ccc; color:#666; padding:7px 2px 7px 2px;">
                        
                        </td>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="4">
                              <tr>
                                <td>
                                <a href="javascript:changeQty('<?php echo 'qty_'.$view_cart_Recordset1['id']; ?>','1')"> <img src="../../images/box_plus.gif" alt="Increase Quantity"  width="11" height="11" hspace=2 border=0 title="Increase Quantity" onClick="showDisplayTable('clickHereToRecalculateTotalsDIV')"> </a>
                               </td>
                              </tr>
                              <tr>
                                <td> <a title="Decrease Quantity" href="javascript:changeQty('<?php echo 'qty_'.$view_cart_Recordset1['id']; ?>','-1')" alt="Decrease Quantity"> <img onClick="showDisplayTable('clickHereToRecalculateTotalsDIV')" hspace=2 src="../../images/box_minus.gif"  width="11" height="11" border=0> </a>
                                    
                                </td>
                              </tr>                              
                            </table>                        
                        </td>
                      </tr>
                    </table>

<!--Quantity-->
                      
                      
                      <img src="../../images/space.gif" width="20" height="5"><br>
                      <a class=gen-link title=Remove href="xt_orderform_delitem.php?id=<?php echo base64_encode($view_cart_Recordset1['id']); ?>"  alt="Remove"> <font  style="color:#666; font:Arial, Helvetica, sans-serif; font-size:11px;">Remove<br>
Item</font> </a></td>
                    <td id=basketLineItem2 valign=middle align="center"><?php 
						  $price=$view_cart_Recordset1['unit_price']; 

							echo "A$".number_format($price, 2, '.', '');	
						  
						  $product_collection_price = $product_collection_price.$price."|";
					  ?></td>
                    <td id="basketLineItem2" valign="middle" align="center"> A$<?php 
						$cart01 = 0;
						$cart01 = $price * $view_cart_Recordset1['quantity'] / 1;
						
						//////WEIGHT START/////////////////
						$prod_weight_query=mysqli_query($conn, "select * from sassy_product where id='".$view_cart_Recordset1['product_id']."' ");
						$prod_weight_set=mysqli_fetch_assoc($prod_weight_query);
						$unit_weight = $prod_weight_set['weight']; 
						
						$sub_total_weight = $unit_weight * $view_cart_Recordset1['quantity'] / 1;
						
						$weight+=$sub_total_weight;
						//////WEIGHT END/////////////////
						
						
						$total+=$cart01;
	//echo round($cart01, 2); 
						echo number_format($cart01, 2, '.', '');
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
                    <td width="195" align="right" id=basketLineItemLoopLeft class="content_text2"><b>Sub Total</b>&nbsp;&nbsp;</td>
                    <td width="65" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="100%" align="center"><?php 
                                                
                                                        echo "A$". number_format($total, 2, '.', ''); 
                                             
                                                 
                                           ?></td>
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
                  	<td colspan="5" background="../../images/h_separator.png" style="background-repeat:repeat-x;">
                    	<img src="../../images/space.gif" height="2" >
                    </td>
                  </tr>
                  <tr valign="top">
                  	
                    <td width="31%" align="right"> <br>
						<span class="copyright">Please select the zone of delivery to<br>
generate the delivery charges</span><br>
                        (<a href="javascript:;" onClick="MM_openBrWindow('delivery_charges.php','','scrollbars=yes,width=500,height=500')">Learn More</a>)
                        
                        
                        </td>

                  
<?php                 
$zone_query=mysqli_query($conn, "SELECT * FROM zone_area WHERE status=1 ORDER BY position ASC, maincat_name asc") or die(mysqli_error());
$zone_set = mysqli_fetch_assoc($zone_query);

?>
                    <td width="36%" align="center">
             
                    </td>
                    <td width="6%" valign="middle" align="right">&nbsp;</td>
                    <td width="14%" valign="middle" align="right" class="content_text2"><b>Delivery</b></td>
					<td width="13%" align="center" valign="middle" class="content_text2">
					
					
					<?php 
$delivery_charges = base64_decode($_GET['d']);
					
if($delivery_charges==''){
$price_q = mysqli_query ("select * from client_delivery where session_id='".$cart_id."' and status=1 order by id desc limit 1", $conn);
$deliver_prc = mysqli_fetch_assoc($price_q);
$delivery_charges = $deliver_prc['final_price'];
}
					
					
					if($delivery_charges!='') echo "A$ ".number_format($delivery_charges, 2, '.', ''); else echo "-&nbsp;&nbsp;&nbsp;&nbsp;";
					
					?>
                    <!--<input type="hidden" name="final_delivery_charges" value="<?php //echo $delivery_charges?>"> -->
                    </td>
                  </tr>
                  
                  <tr>
                  	<td colspan="5" background="../../images/h_separator.png" style="background-repeat:repeat-x;">
                    	<img src="../../images/space.gif" height="2" >
                    </td>
                  </tr>                  
                  <tr>
                  	<td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align=right>&nbsp;</td>
                    <td align="right" class="content_text2"><b>Grand Total</b></td>
                    <td align="center" class="content_text2"><?php 
						$grant_total= $total + $delivery_charges;

							echo "A$".number_format($grant_total, 2, '.', ''); 

				  ?></td>
                 
                  
                  
                  
                  </tr>


                </table>
                </td>
            </tr>
          </TABLE>
        </form>
          </td>
        <td width="3%" align="left" valign="top"><p><img src="../../images/space.gif" width="25" height="250"> <br>
        </p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td id="hdotline"><img src="../../images/core/spacer.gif" width="1" height="1"></td>
  </tr>  
</table>
</body>
</html>