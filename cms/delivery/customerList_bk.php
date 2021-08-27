<?php 
require_once '../../config/ini.php';  
session_start();
	if($_SESSION['validation']=='YES'){
	
	}else{
		header("Location:../authentication/login.php");
	}
	
//*************************************************Edit Country*************************************************
	$temp_query_Recordset = "SELECT * FROM product_comfirm";					 
	$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
	
	do{
		if($_POST['update'.$row_Rs1['reference_id']]==" Update "){	
		
			$id_data = $row_Rs1['reference_id'];
			$insertSQL1 = "UPDATE product_comfirm SET maincat_name='".$_POST['maincat_name'.$row_Rs1['reference_id']]."', 
								position='".$_POST['position'.$row_Rs1['reference_id']]."' WHERE reference_id='".$id_data."'"; 
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
			$success1='<font color="#336600">Category updated</font>';
		}else
			$success1='<font color="#CC3300">failed to update category</font>';
	}while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));	
	
	
	///////////////display//////////////////////////////////////////////////////////////
	$temp_query_Recordset2 = "SELECT * FROM product_comfirm WHERE status=0 or status=2";					 
	$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($Rs1);

	do{
		if($_POST[$row_Rs1['reference_id']]=="Revert to Progress"){	
			$this_host_product_id=$row_Rs1['reference_id']; 
			$insertSQL1 = "UPDATE product_comfirm SET status='1' WHERE reference_id='".$this_host_product_id."'"; 
			//echo $insertSQL1;
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
		}
	}while($row_Rs1 = mysqli_fetch_assoc($Rs1));
	///////////////////////////////////display///////////////////////////////////////////
	
	$temp_query_Recordset1 = "SELECT * FROM product_comfirm WHERE status=2";					 
	$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset1) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
	
	do{
		if($_POST[$row_Rs1['reference_id']]=="Completed & Shipped"){	
			$this_host_product_id=$row_Rs1['reference_id'];
			$insertSQL1 = "UPDATE product_comfirm SET status='0' WHERE reference_id='".$this_host_product_id."'"; 
			
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
		}
	}while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));

////////////////////////////////Set Order as Payment Received/////////////////////////////////
	$temp_query_Recordset1 = "SELECT * FROM product_comfirm WHERE status=1";					 
	$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset1) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
	
	do{
		if($_POST[$row_Rs1['reference_id']]=="Payment Received"){	
			$this_host_product_id=$row_Rs1['reference_id'];
			$insertSQL1 = "UPDATE product_comfirm SET status='2' WHERE reference_id='$this_host_product_id'"; 
			
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
		}
	}while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));




if($_POST['delete']=="Delete"){		
	$items_delete_array = $_POST['productIdList'];
	
	if(!empty($_POST['productIdList'])){
		foreach((array)$items_delete_array as $items_delete){
			$del_data="UPDATE product_comfirm SET status='-1' WHERE reference_id='".$items_delete."'";
			mysqli_select_db($conn, $database_conn);
			$dataResult1 = mysqli_query($conn, $del_data) or die(mysqli_error());			
		}
	}
}

	$get_year = $_GET['y']; //if($get_year=='') $get_year = date("Y"); echo $get_year."-"; 
	$get_month = $_GET['m']; //if($get_month=='') $get_month = date("m"); echo $get_month."-"; 
			if(strlen($get_month)==1){
				$get_month = "0".$get_month;
			}
	$get_day = $_GET['d']; 
	
	/*
	if($get_day==''){
		if(date("d")>=1 && date("d")<=5) $get_day = 1; 
		if(date("d")>=6 && date("d")<=10) $get_day = 2;
		if(date("d")>=11 && date("d")<=15) $get_day = 3;
		if(date("d")>=16 && date("d")<=20) $get_day = 4;
		if(date("d")>=21 && date("d")<=25) $get_day = 5;
		if(date("d")>=26 && date("d")<=31) $get_day = 6;
	}//echo $get_day; */
	
	$get_y_m = $get_year."-".$get_month;

if($get_year!=''){
	//echo "<br>".$get_y_m;
	$y_m_d_query = "and confirm_date like '$get_year%'";

}

if($get_month!=''){
	//echo "<br>".$get_y_m;
	$y_m_d_query = "and confirm_date like '$get_y_m%'";
}

if($get_day==1){
	$y_m_d_query = "and (confirm_date='$get_y_m'"."'-01' || confirm_date='$get_y_m'"."'-02' ||  confirm_date='$get_y_m'"."'-03' ||  
						 confirm_date='$get_y_m'"."'-04' ||  confirm_date='$get_y_m'"."'-05')";
}elseif($get_day==2){
	$y_m_d_query = "and (confirm_date='$get_y_m'"."'-06' || confirm_date='$get_y_m'"."'-07' ||  confirm_date='$get_y_m'"."'-08' ||  
						 confirm_date='$get_y_m'"."'-09' ||  confirm_date='$get_y_m'"."'-10')";
}elseif($get_day==3){
	$y_m_d_query = "and (confirm_date='$get_y_m'"."'-11' || confirm_date='$get_y_m'"."'-12' ||  confirm_date='$get_y_m'"."'-13' ||  
						 confirm_date='$get_y_m'"."'-14' ||  confirm_date='$get_y_m'"."'-15')";
}elseif($get_day==4){
	$y_m_d_query = "and (confirm_date='$get_y_m'"."'-16' || confirm_date='$get_y_m'"."'-17' ||  confirm_date='$get_y_m'"."'-18' ||  
						 confirm_date='$get_y_m'"."'-19' ||  confirm_date='$get_y_m'"."'-20')";
}elseif($get_day==5){
	$y_m_d_query = "and (confirm_date='$get_y_m'"."'-21' || confirm_date='$get_y_m'"."'-22' ||  confirm_date='$get_y_m'"."'-23' ||  
						 confirm_date='$get_y_m'"."'-24' ||  confirm_date='$get_y_m'"."'-25')";
}elseif($get_day==6){
	$y_m_d_query = "and (confirm_date='$get_y_m'"."'-26' || confirm_date='$get_y_m'"."'-27' ||  confirm_date='$get_y_m'"."'-28' ||  
						 confirm_date='$get_y_m'"."'-29' ||  confirm_date='$get_y_m'"."'-30' ||  confirm_date='$get_y_m'"."'-31')";
}

if($_GET['tab']=="approvedondisplay"||$_GET['tab']==""){
		$query="SELECT * FROM product_comfirm WHERE status=1 $y_m_d_query ORDER BY reference_id desc";
		
}else if($_GET['tab']=="paymentreceived"){
		$query="SELECT * FROM product_comfirm WHERE status=2 $y_m_d_query ORDER BY reference_id desc";
		
}else if($_GET['tab']=="approvednotondisplay"){
		$query="SELECT * FROM product_comfirm WHERE status=0 $y_m_d_query ORDER BY reference_id desc";
}

	$currentPage = $_SERVER["PHP_SELF"];	
	$maxRows_Rs1 = 25;
	$pageNum_Rs1 = 0;
	if (isset($_GET['pageNum_Rs1'])) {
	  $pageNum_Rs1 = $_GET['pageNum_Rs1'];
	}
	$startRow_Rs1 = $pageNum_Rs1 * $maxRows_Rs1;
	
	$colname_Rs1 = "";
	mysqli_select_db($conn, $database_conn);
	
	$query_limit_Rs1 = sprintf("%s LIMIT %d, %d", $query, $startRow_Rs1, $maxRows_Rs1);
	$Rs1 = mysqli_query($conn, $query_limit_Rs1) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($Rs1);
	
	if (isset($_GET['totalRows_Rs1'])) {
	  $totalRows_Rs1 = $_GET['totalRows_Rs1'];
	} else {
	  $all_Rs1 = mysqli_query($conn, $query);
	  $totalRows_Rs1 = mysqli_num_rows($all_Rs1);
	  
	}
	$totalPages_Rs1 = ceil($totalRows_Rs1/$maxRows_Rs1)-1;
	
	$queryString_Rs1 = "";
	if (!empty($_SERVER['QUERY_STRING'])) {
	  $params = explode("&", $_SERVER['QUERY_STRING']);
	  $newParams = array();
	  foreach ($params as $param) {
		if (stristr($param, "pageNum_Rs1") == false && 
			stristr($param, "totalRows_Rs1") == false) {
		  array_push($newParams, $param);
		}
	  }
	  if (count($newParams) != 0) {
		$queryString_Rs1 = "&" . htmlentities(implode("&", $newParams));
	  }
	}	

	$query3 = mysqli_query($conn, "SELECT * FROM product_comfirm WHERE status=2 $y_m_d_query");
	$total_testimonial_on_payment = mysqli_num_rows($query3);
	$query2 = mysqli_query($conn, "SELECT * FROM product_comfirm WHERE status=0 $y_m_d_query");
	$total_testimonial_not_on_display = mysqli_num_rows($query2);
	$query = mysqli_query($conn, "SELECT * FROM product_comfirm WHERE status=1 $y_m_d_query");
	$total_testimonial_on_display = mysqli_num_rows($query);
	
?>	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script language="JavaScript" src="../js/bbcode.js"></script>
<script language="JavaScript" src="../js/validate.js"></script>
<script language="JavaScript" src="../js/message.js"></script>
<script language="javascript" src="../js/menuAtNews.js"></script>

<script language="JavaScript">
function chkAll(frm, arr, mark){
  for (i = 0; i <= frm.elements.length; i++){
   try{
     if(frm.elements[i].name == arr){
       frm.elements[i].checked = mark;
     }
   } catch(er) {}
  }
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>

<title>CMS</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/common.css" rel="stylesheet" type="text/css">
<link href="../css/component.css" rel="stylesheet" type="text/css">
<link href="../css/font.css" rel="stylesheet" type="text/css">
<link href="../css/layout.css" rel="stylesheet" type="text/css">
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../../css.css" rel="stylesheet" type="text/css" />

<?php //if ($_GET['add']==1){?>
<script language="javascript">
function check(){
	if(form1.maincatname.value==""){
		alert("Please enter main category.");
		form1.maincatname.focus();
		return false;
	}
	return true;
}
</script>
<?php //}?>
<script language="javascript">
function findItem(n, d){
	var p,x,i;
	if(!d) d=document;
	if((p=n.indexOf("?"))>0&&parent.frames.length){
		d=parent.frames[n.substring(p+1)].document;
		n=n.substring(0,p);
	}
	if(!(x=d[n])&&d.all)
		x=d.all[n];
	for (i=0;!x&&i<d.forms.length;i++)
		x=d.forms[i][n];
	for(i=0;!x&&d.layers&&i<d.layers.length;i++)
		x=findItem(n,d.layers[i].document);
	return x;
}
</script>
<script language="JavaScript">
function jumpMenu(target,selObj,restore){ 
  if (selObj.selectedIndex>0 && selObj.options[selObj.selectedIndex].value != ''){
    window.open(selObj.options[selObj.selectedIndex].value,target);}
  else if(selObj.options[selObj.selectedIndex].value == '')  {selObj.selectedIndex=0;}
  if (restore) selObj.selectedIndex=0;
}
</script>

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="32" align="left" valign="middle">
                      <div class="gradient5">
                <h1><span></span>CUSTOMER LIST</h1>
            </div>
          
          </td>
        </tr>
        <tr>
          <td align="right" class="content01">
          <a href="customerList.php">View All</a>
          &nbsp;&nbsp;&nbsp; or &nbsp;&nbsp;&nbsp;
            Filter: 
            <span class="content" style="padding-right:5px;">
            <select name="year_filter" onChange="javascript:jumpMenu('_self',this,0)">
            	<option value="">-Year-</option>
                <?php for($i=2010 ; $i<=2050; $i++){?>
                    <option value="<?php printf($currentPage); ?>?tab=<?php echo $_GET['tab'];?>&y=<?php echo $i?>" <?php if($get_year==$i){?>selected<?php }?>>
					<?php echo $i?></option>
				<?php }?>
            </select>
            </span>    
           
            <span class="content" style="padding-right:5px;">
            <select name="month_filter" onChange="javascript:jumpMenu('_self',this,0)">
            	<option value="">-Month-</option>
                <?php for($i=1 ; $i<=12; $i++){?>
                    <option value="<?php printf($currentPage); ?>?tab=<?php echo $_GET['tab'];?>&y=<?php echo $_GET['y']?>&m=<?php echo $i?>" 
					<?php if($get_month==$i){?>selected<?php }?>><?php echo $i?></option>
				<?php }?>
            </select>
            </span>
            
            <span class="content" style="padding-right:5px;">
            <select name="day_filter" onChange="javascript:jumpMenu('_self',this,0)">
            	<option value="">-Day-</option>
                <option value="<?php printf($currentPage); ?>?tab=<?php echo $_GET['tab'];?>&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=1" 
				<?php if($get_day==1){?>selected<?php }?>>day 1 ~ 5</option>
                <option value="<?php printf($currentPage); ?>?tab=<?php echo $_GET['tab'];?>&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=2" 
				<?php if($get_day==2){?>selected<?php }?>>day 6 ~ 10</option>
                <option value="<?php printf($currentPage); ?>?tab=<?php echo $_GET['tab'];?>&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=3" 
				<?php if($get_day==3){?>selected<?php }?>>day 11 ~ 15</option>
                <option value="<?php printf($currentPage); ?>?tab=<?php echo $_GET['tab'];?>&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=4" 
				<?php if($get_day==4){?>selected<?php }?>>day 16 ~ 20</option>
                <option value="<?php printf($currentPage); ?>?tab=<?php echo $_GET['tab'];?>&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=5" 
				<?php if($get_day==5){?>selected<?php }?>>day 21 ~ 25</option>
                <option value="<?php printf($currentPage); ?>?tab=<?php echo $_GET['tab'];?>&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=6" 
				<?php if($get_day==6){?>selected<?php }?>>day 26 ~ 31</option>
            </select>
            </span>                                            
          </td>
        </tr>        
        <tr>
          <td height="288" align="left" valign="top"><table width="100%" align="left" cellpadding="0"  cellspacing="0">
              <tr>
                <td width="636" height="244" align="left" valign="top"><div align="left">
                    <?php 
			if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="") { ?>
                    <!--On Revert to Progress-->
                    <form name="form2" method="post" action="customerList.php?tab=approvedondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
                      <script>
			  	function deleteProduct1(){
					var point = confirm("Are You Sure You Want To Delete?");
					if(point==true){
						var id= new Array('productIdList[]');
						if(id==''){
							alert("No Item Selected");
							return false;
						}
						return true;
					}else{
						return false;
					}
				}
			  </script>
                      <div id="tab">
                        <ul>
                          <li class="current">
                          <a href="customerList.php?tab=approvedondisplay&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=<?php echo $_GET['d']?>" 
                          		title="Pending Order" class="content">In Progress Order (
                                <?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>0<?php }?> )</a></li>
                          <li class="">
                          <a href="customerList.php?tab=paymentreceived&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=<?php echo $_GET['d']?>" 
                          	title="Payment Received Order" class="content">Payment Received (
                                <?php if ($total_testimonial_on_payment!=0){ echo $total_testimonial_on_payment;}else{?>0<?php }?> )</a></li>
                          <li class="">
                          <a href="customerList.php?tab=approvednotondisplay&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=<?php echo $_GET['d']?>" 
                          		title="Completed & Shipped Order" class="content">Completed & Shipped (
                                <?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>0<?php }?> )</a></li>
                        </ul>
                      </div>
                      <div class="function"><span class="content">
                      Select <input type="checkbox" name="checkbox" value="checkbox" checked disabled>
                      to: <input type="submit" name="delete" value="Delete" onClick="return deleteProduct1();" title="Delete selected item(s)">
                      </span></div>
                      <table border="0" cellpadding="4" cellspacing="1" width="100%">
                        <tr bgcolor="#CCCCCC" align="center">
                          <th width="4%" class="content">
                            <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">                          </th>
                          <th width="22%" class="content">Order Status</th>
                          <!--<th width="12%" class="content">Photo </th> -->
                          <th width="19%" class="content">Order&nbsp;Detail</th>
                          <th width="33%" class="content">Customer&nbsp;Detail</th>
                          <th width="22%" class="content" align="center">Total</th>
                          <!--<th width="8%" class="content" align="center">View</th> -->
                        </tr>
                        <tr>
                          <td colspan="2"></td>
                        </tr>
                        <?php  $count=1;
							if($row_Rs1!=''){											
								do{
									if($count%2==0)
									$bgcolor='#F0F0F0';
									else
									$bgcolor='#FFFFFF';
						?>
                        <tr bgcolor="<?php echo $bgcolor;?>">
                          <th width="4%" class="content">
                            <input type="checkbox" value="<?php echo $row_Rs1['reference_id']; ?>" name="productIdList[]"><br />                          
                          </th>
                          <!--onClick="return displayProduct();"-->
                          <td width="22%" class="content" align="center">
                          	<input type="submit" name="<?php echo $row_Rs1['reference_id']; ?>" value="Payment Received" 
                            	title="Set This Order Status to Payment Received"/>                          
                          </td>
                          <td align="left" class="content01">
							<?php echo "Order No.: <span class=\"title9\">
									<u><a href=\"order_form.php?id=".base64_encode($row_Rs1['reference_id'])."\">".($row_Rs1['reference_id']+1000)."</a></u>
									</span><br>"; 
			
							$quantity_query=mysqli_query($conn, "SELECT * FROM product_cart WHERE session_id='".$row_Rs1['session_id']."'");
							$quantity_Recordset=mysqli_fetch_assoc($quantity_query);	
							do{
								if($quantity_Recordset['product_id']!=''){
									
									$prod_desc_query=mysqli_query($conn, "select product_code from sassy_product where id='".$quantity_Recordset['product_id']."' ");
									$prod_desc_set=mysqli_fetch_assoc($prod_desc_query);
									
										if($prod_desc_set['product_code']!=''){
											echo $prod_desc_set['product_code']." ".$quantity_Recordset['quantity']."<br>";
										}	
								}		
							}while($quantity_Recordset=mysqli_fetch_assoc($quantity_query));					
			
							if($row_Rs1['confirm_date']!='0000-00-00') echo "Order Date: ".date("dS M Y", strtotime($row_Rs1['confirm_date'])); ?>
			
                          </td>
                          <td align="left" class="content01">
							  <?php if($row_Rs1['name']) echo "Name: <span class=\"main_title\">".$row_Rs1['name']."</span><br>"; ?>
                              <?php if($row_Rs1['telephone']) echo "Telephone: <span class=\"main_title\">".$row_Rs1['telephone']."</span><br>"; ?>
                              <?php if($row_Rs1['mobilephone']) echo "Mobile Phone: <span class=\"main_title\">".$row_Rs1['mobilephone']."</span><br>"; ?>
                              <?php if($row_Rs1['fax']) echo "Fax no.: <span class=\"main_title\">".$row_Rs1['fax']."</span><br>"; ?>
                              <?php if($row_Rs1['email']) echo "Email: <span class=\"main_title\">".$row_Rs1['email']."</span><br>"; ?>						  
                              <?php if($row_Rs1['address']) echo "Address: <span class=\"main_title\">".$row_Rs1['address']."</span><br>"; ?>
                              Note : <?php if(!empty($row_Rs1['note'])){ 
												$find = array("<p>","</p>");
												echo str_replace($find,'',$row_Rs1['note']);
											}?> 
                              <a href="javascript:;" onMouseOver="MM_swapImage('note','','../images/b_edit.png',1)" onMouseOut="MM_swapImgRestore()">
                              <img src="../images/b_edit.png" name="note" id="note" 
                    			onClick="MM_openBrWindow('editNote.php?id=<?php echo base64_encode($row_Rs1['reference_id']); ?>','',
                                	'scrollbars=yes,width=450,height=300')">
                              </a>
                          </td>
                          
                          <td align="left" class="content_text2">
							  <?php echo "Shipping: A$".number_format($row_Rs1['ship_cost'],2); ?><br>
                              <?php echo "Product: A$".number_format($row_Rs1['sub_total'],2); ?><br>
                              <?php echo "Total: <span class=\"title9\"><u>A$".number_format($row_Rs1['grand_total'],2)."</u></span>"; ?>
                          </td>
                          <!--<td class="content" align="center"><a href="order_form.php?id=<?php //echo base64_encode($row_Rs1['reference_id'])?>">
                          Order Detail</a></td> -->
                        </tr>
						<?php  $count++;
                             } while($row_Rs1 = mysqli_fetch_assoc($Rs1));
					}else{ ?>
                        <tr>
                          <th width="4%"></th>
                          <td colspan="6" class="content">No Record Found.</td>
                          <!--<td></td>-->
                        </tr>
                    <?php } ?>
                      </table>
                    </form>
                    <?php } else if($_GET['tab']=="paymentreceived") { ?>

                    
                <form name="ProductListForm2" method="post" action="customerList.php?tab=paymentreceived&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
                <script>
					function deleteProduct2(){
						var id= new Array('productIdList[]');
						if(id==''){
							alert("No Item Selected");
							return false;
						}
					
						var point=confirm("Are You Sure You Want To Delete?");
						if(point==true){
							return true;
						}else{
							return false;
						}
						
					}
			  	</script>
                      <div id="tab">
                        <ul>
                          <li class="">
                          <a href="customerList.php?tab=approvedondisplay&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=<?php echo $_GET['d']?>" 
                          	title="Pending Order" class="content">In Progress Order (
                                <?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>0<?php }?> )</a></li>
                          <li class="current">
                          <a href="customerList.php?tab=paymentreceived&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=<?php echo $_GET['d']?>" 
                          	title="Payment Received Order" class="content">Payment Received (
                                <?php if ($total_testimonial_on_payment!=0){ echo $total_testimonial_on_payment;}else{?>0<?php }?> )</a></li>
                          <li class="">
                          <a href="customerList.php?tab=approvednotondisplay&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=<?php echo $_GET['d']?>" 
                          	title="Completed & Shipped Order" class="content">Completed & Shipped (
                                <?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>0<?php }?> )</a></li>
                        </ul>
                      </div>
                      <div class="content"> 
                          Select <input type="checkbox" name="checkbox" value="checkbox" checked disabled>
                          to: <input type="submit" name="delete" value="Delete" onClick="return deleteProduct2();" title="Delete selected item(s)" />
                      </div>
                      <table border="0" cellpadding="4" cellspacing="1" width="100%">
                        <tr bgcolor="#CCCCCC" align="center">
                          <th width="4%" class="content">
                            <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">                          </th>
                          <th width="22%" class="content">Order Status</th>
                          <th width="19%" class="content">Order&nbsp;Detail</th>
                          <th width="33%" class="content">Customer&nbsp;Detail</th>
                          <th width="22%" class="content">Total</th>
                          <!-- <th width="8%" class="content">View</th>
                          <th width="10%" class="content">Photo </th> -->
                        </tr>
                        <?php  $count=1;
							if($row_Rs1!=''){											
								do{
									if($count%2==0)
									$bgcolor='#E6E6E6';
									else
									$bgcolor='#FFFFFF';
						?>
                        <tr bgcolor="<?php echo $bgcolor;?>">
                          <th width="4%" class="content">
                            <input type="checkbox" value="<?php echo $row_Rs1['reference_id']; ?>" name="productIdList[]"><br />                          
                          </th>
                          <!--onClick="return displayProduct();"-->
                          <td width="22%" class="content" align="center">
                          <input type="submit" name="<?php echo $row_Rs1['reference_id']; ?>" value="Completed & Shipped" 
                          	title="Set This Order Status to Completed & Shipped"/> <br> <br>
                          <input type="submit" name="<?php echo $row_Rs1['reference_id']; ?>" value="Revert to Progress" 
                          	title="Revert This Order Status to Progress status"/>                          
                          </td>
                          <td align="left" class="content01">
						  	<?php echo "Order No.: <span class=\"title9\">
						  	<u><a href=\"order_form.php?id=".base64_encode($row_Rs1['reference_id'])."\">".($row_Rs1['reference_id']+1000)."</a></u>
							</span><br>"; 
			
							$quantity_query=mysqli_query($conn, "SELECT * FROM product_cart WHERE session_id='".$row_Rs1['session_id']."'");
							$quantity_Recordset=mysqli_fetch_assoc($quantity_query);	
							
							do{
								if($quantity_Recordset['product_id']!=''){
									
									$prod_desc_query=mysqli_query($conn, "select product_code from sassy_product where id='".$quantity_Recordset['product_id']."' ");
									$prod_desc_set=mysqli_fetch_assoc($prod_desc_query);
									
										if($prod_desc_set['product_code']!=''){
											echo $prod_desc_set['product_code']." ".$quantity_Recordset['quantity']."<br>";
										}	
								}		
							}while($quantity_Recordset=mysqli_fetch_assoc($quantity_query));					
			
							if($row_Rs1['confirm_date']!='0000-00-00') echo "Order Date: ".date("dS M Y", strtotime($row_Rs1['confirm_date'])); ?></td>
                            
                          <td align="left" class="content01">
							<?php if($row_Rs1['name']) echo "Name: <span class=\"main_title\">".$row_Rs1['name']."</span><br>"; ?>
                            <?php if($row_Rs1['telephone']) echo "Telephone: <span class=\"main_title\">".$row_Rs1['telephone']."</span><br>"; ?>
                            <?php if($row_Rs1['mobilephone']) echo "Mobile Phone: <span class=\"main_title\">".$row_Rs1['mobilephone']."</span><br>"; ?>
                            <?php if($row_Rs1['fax']) echo "Fax no.: <span class=\"main_title\">".$row_Rs1['fax']."</span><br>"; ?>
                            <?php if($row_Rs1['email']) echo "Email: <span class=\"main_title\">".$row_Rs1['email']."</span><br>"; ?>
						 	<?php if($row_Rs1['address']) echo "Address: <span class=\"main_title\">".$row_Rs1['address']."</span><br>"; ?>
                            Note : <?php if(!empty($row_Rs1['note'])){ 
												$find = array("<p>","</p>");
												echo str_replace($find,'',$row_Rs1['note']);
											}?> 
                              <a href="javascript:;" onMouseOver="MM_swapImage('note','','../images/b_edit.png',1)" onMouseOut="MM_swapImgRestore()">
                              <img src="../images/b_edit.png" name="note" id="note" 
                    			onClick="MM_openBrWindow('editNote.php?id=<?php echo base64_encode($row_Rs1['reference_id']); ?>','',
                                	'scrollbars=yes,width=450,height=300')">
                              </a>
                          </td>
                          <td align="left" class="content_text2">
						  	<?php echo "Shipping: A$".number_format($row_Rs1['ship_cost'],2); ?><br>
                            <?php echo "Product: A$".number_format($row_Rs1['sub_total'],2); ?><br>
                            <?php echo "Total: <span class=\"title9\"><u>A$".number_format($row_Rs1['grand_total'],2)."</u></span>"; ?></td>
                          	<!--<td align="center" class="content"><a href="order_form.php?id=<?php //echo base64_encode($row_Rs1['reference_id'])?>">  
                            Order Detail</a></td> -->
                        </tr>
							<?php  $count++;
                             } while($row_Rs1 = mysqli_fetch_assoc($Rs1));
					}else{?>
                        <tr>
                          <th width="4%"></th>
                          <td colspan="6" class="content">No Record Found.</td>
                          <!--<td></td>-->
                        </tr>
                    <?php } ?>
                        <!--Empty Detection End-->
                        <tr>
                          <td colspan="5">&nbsp; </td>
                        </tr>
                      </table>
                    </form>                    
                    
                    <?php } else if($_GET['tab']=="approvednotondisplay") { ?>
                    <form name="ProductListForm2" method="post" action="customerList.php?tab=approvednotondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
                      <script>
						function deleteProduct2(){
							var id= new Array('productIdList[]');
							if(id==''){
								alert("No Item Selected");
								return false;
							}
						
							var point=confirm("Are You Sure You Want To Delete?");
							if(point==true){
								return true;
							}else{
								return false;
							}
							
						}
                      </script>
                      <div id="tab">
                        <ul>
                          <li class="">
                          <a href="customerList.php?tab=approvedondisplay&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=<?php echo $_GET['d']?>" 
                          	title="Pending Order" class="content">In Progress Order (
                                <?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>0<?php }?> )</a></li>
                          <li class=""><a href="customerList.php?tab=paymentreceived&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=<?php echo $_GET['d']?>" 
                          	title="Payment Received Order" class="content">Payment Received (
                                <?php if ($total_testimonial_on_payment!=0){ echo $total_testimonial_on_payment;}else{?>0<?php }?> )</a></li>
                          <li class=""><a href="customerList.php?tab=approvednotondisplay&y=<?php echo $_GET['y']?>&m=<?php echo $_GET['m']?>&d=<?php echo $_GET['d']?>"
                          	title="Completed & Shipped Order" class="content">Completed & Shipped (
                                <?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>0<?php }?> )</a></li>
                        </ul>
                      </div>
                      <div class="content"> 
                          Select <input type="checkbox" name="checkbox" value="checkbox" checked disabled>
                          to: <input type="submit" name="delete" value="Delete" onClick="return deleteProduct2();" title="Delete selected item(s)" />
                      </div>
                      <table border="0" cellpadding="4" cellspacing="1" width="100%">
                        <tr bgcolor="#CCCCCC" align="center">
                          <th width="4%" class="content">
                            <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">                          </th>
                          <th width="22%" class="content">Order Status</th>
                          <th width="19%" class="content">Order&nbsp;Detail</th>
                          <th width="33%" class="content">Customer&nbsp;Detail</th>
                          <th width="22%" class="content">Total</th>
                          <!-- <th width="8%" class="content">View</th>
                          <th width="10%" class="content">Photo </th> -->
                        </tr>
                        <?php  $count=1;
							if($row_Rs1!=''){											
								do{
									if($count%2==0)
									$bgcolor='#E6E6E6';
									else
									$bgcolor='#FFFFFF';
						?>
                        <tr bgcolor="<?php echo $bgcolor;?>">
                          <th width="4%" class="content">
                            <input type="checkbox" value="<?php echo $row_Rs1['reference_id']; ?>" name="productIdList[]"><br />                          
                          </th>
                          <!--onClick="return displayProduct();"-->
                          <td width="22%" class="content" align="center">
                            <input type="submit" name="<?php echo $row_Rs1['reference_id']; ?>" value="Revert to Progress" 
                            	title="Revert This Order Status to In Progress"/>                          
                          </td>
                          <td align="left" class="content01">
						  	<?php echo "Order No.: <span class=\"title9\">
								<u><a href=\"order_form.php?id=".base64_encode($row_Rs1['reference_id'])."\">".($row_Rs1['reference_id']+1000)."</a></u>
								</span><br>"; 
			
						$quantity_query=mysqli_query($conn, "SELECT * FROM product_cart WHERE session_id='".$row_Rs1['session_id']."'");
						$quantity_Recordset=mysqli_fetch_assoc($quantity_query);	
							do{
								if($quantity_Recordset['product_id']!=''){
									
									$prod_desc_query=mysqli_query($conn, "select product_code from sassy_product where id='".$quantity_Recordset['product_id']."' ");
									$prod_desc_set=mysqli_fetch_assoc($prod_desc_query);
									
										if($prod_desc_set['product_code']!=''){
											echo $prod_desc_set['product_code']." ".$quantity_Recordset['quantity']." <br>";
										}	
								}		
							}while($quantity_Recordset=mysqli_fetch_assoc($quantity_query));					
			
								if($row_Rs1['confirm_date']!='0000-00-00') echo "Order Date: ".date("dS M Y", strtotime($row_Rs1['confirm_date'])); ?>
                          </td>
                          <td align="left" class="content01">
							<?php if($row_Rs1['name']) echo "Name: <span class=\"main_title\">".$row_Rs1['name']."</span><br>"; ?>
							<?php if($row_Rs1['telephone']) echo "Telephone: <span class=\"main_title\">".$row_Rs1['telephone']."</span><br>"; ?>
                            <?php if($row_Rs1['mobilephone']) echo "Mobile Phone: <span class=\"main_title\">".$row_Rs1['mobilephone']."</span><br>"; ?>
                            <?php if($row_Rs1['fax']) echo "Fax no.: <span class=\"main_title\">".$row_Rs1['fax']."</span><br>"; ?>
                            <?php if($row_Rs1['email']) echo "Email: <span class=\"main_title\">".$row_Rs1['email']."</span><br>"; ?>
						    <?php if($row_Rs1['address']) echo "Address: <span class=\"main_title\">".$row_Rs1['address']."</span><br>"; ?>
                            Note : <?php if(!empty($row_Rs1['note'])){ 
												$find = array("<p>","</p>");
												echo str_replace($find,'',$row_Rs1['note']);
											}?>
                              <a href="javascript:;" onMouseOver="MM_swapImage('note','','../images/b_edit.png',1)" onMouseOut="MM_swapImgRestore()">
                              <img src="../images/b_edit.png" name="note" id="note" 
                    			onClick="MM_openBrWindow('editNote.php?id=<?php echo base64_encode($row_Rs1['reference_id']); ?>','',
                                	'scrollbars=yes,width=450,height=300')">
                              </a>
                          </td>
                          <td align="left" class="content_text2">
						  	<?php echo "Shipping: A$".number_format($row_Rs1['ship_cost'],2); ?><br>
                            <?php echo "Product: A$".number_format($row_Rs1['sub_total'],2); ?><br>
                            <?php echo "Total: <span class=\"title9\"><u>A$".number_format($row_Rs1['grand_total'],2)."</u></span>"; ?>
                          </td>
                          	<!--<td align="center" class="content"><a href="order_form.php?id=<?php //echo base64_encode($row_Rs1['reference_id'])?>">  
                            Order Detail</a></td> -->
                        </tr>
                        <?php   $count++;
						 	}while($row_Rs1 = mysqli_fetch_assoc($Rs1));
						}else{ ?>
                            <tr>
                              <th width="4%"></th>
                              <td colspan="6" class="content">No Record Found.</td>
                              <!--<td></td>-->
                            </tr>
                        <?php } ?>
                        <!--Empty Detection End-->
                        <tr>
                          <td colspan="5">&nbsp; </td>
                        </tr>
                      </table>
                    </form>
                    <!--Not On Display End-->
                    <?php } ?>
                    <!--End-->
                </div></td>
              </tr>
              <tr>
                <td colspan="4"><div align="left" class="content">
                    <?php if ($totalRows_Rs1 > 0 ) { ?>
&nbsp;Total Records <?php echo ($startRow_Rs1 + 1) ?> to <?php echo min($startRow_Rs1 + $maxRows_Rs1, $totalRows_Rs1) ?> of <?php echo $totalRows_Rs1 ?> <br>
&nbsp;<a href="<?php printf("%s?pageNum_Rs1=%d%s", $currentPage, 0, $queryString_Rs1); ?>">First</a> <a href="<?php printf("%s?pageNum_Rs1=%d%s", $currentPage, max(0, $pageNum_Rs1 - 1), $queryString_Rs1); ?>">| Previous</a> | <a href="<?php printf("%s?pageNum_Rs1=%d%s", $currentPage, min($totalPages_Rs1, $pageNum_Rs1 + 1), $queryString_Rs1); ?>">Next</a> <a href="<?php printf("%s?pageNum_Rs1=%d%s", $currentPage, $totalPages_Rs1, $queryString_Rs1); ?>">| Last</a> |
                    <?php } ?>
                </div></td>
              </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
