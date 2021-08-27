<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES' || $_SESSION['logged_in']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

	$id = base64_decode($_GET['id']);
	if(!empty($id)){
		
		$customer_query = mysqli_query($conn, "SELECT * FROM accounts WHERE id='".$id."' LIMIT 1");
		$customer = mysqli_fetch_assoc($customer_query);
		/*
		echo '<div style="border:1px solid #CCC; margin:20px 3% 0 20%; padding:20px;">';
		echo "Name: ".$customer['first_name'].' '.$customer['last_name'].'<br>';
		echo 'Email: '.$customer['email'].'<br>';
		echo 'Address: '.$customer['address'].'<br>';
		echo 'Address 2: '.$customer['address2'].'<br>';
		echo 'Town: '.$customer['town'].'<br>';
		echo 'Country: '.$customer['country'];
		echo '</div>';
		*/
		$query="SELECT * FROM product_comfirm WHERE account_id='".$id."'  ORDER BY reference_id desc";
			
	
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
	}
?>


<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
</head>

<body>
<!--////////////////////////////////////////// TOP MENU START////////////////////////////////////////////// -->
<?php include("layout/top.php");?>
<!--////////////////////////////////////////// TOP MENU START////////////////////////////////////////////// -->

<div class="container-fluid">
    <div class="row">
    <!--////////////////////////////////////////// SIDE MENU START////////////////////////////////////////////// -->
	<?php include("layout/menu.php");?>
    <!--////////////////////////////////////////// SIDE MENU END////////////////////////////////////////////// -->
    
    <!--////////////////////////////////////////// CONTENT START////////////////////////////////////////////// -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" align="center">
          <div class="table-responsive">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
              <tr>
                <td class="border_background_no_color">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><h3>Order List for <?php echo $customer['first_name'].' '.$customer['last_name'];?> </h3>
                        
						<a class="btn-info btn-xs" href="manageAccount.php">Account List</a><br><br>

                        </td>
                    </tr> 
                    <tr>
                      <td height="288" align="left" valign="top"><table width="100%" align="left" cellpadding="0"  cellspacing="0">
                          <tr>
                            <td width="636" height="244" align="left" valign="top"><div align="left">
                                <form name="form2" method="post" action="customerList.php?tab=approvedondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
                                  <script>
                            function deleteProduct1(){
                                var chkboxes = document.getElementsByName('productIdList[]');
                                var item_selected = 0;
                                
                                for(var x = 0;x<chkboxes.length;x++){
                                    if(chkboxes[x].checked == true){
                                        item_selected++;
                                    }
                                }
                                
                                if(item_selected == 0){
                                    alert("No Item Selected");
                                    return false;
                                }else{
                                    var point=confirm("Are You Sure You Want To Delete?");
                                    if(point==true){
                                        return true;
                                    }else{
                                        return false;
                                    }
                                }
                            }
                          </script>
                                  <div class="function"></div>
                                  <table border="0" cellpadding="4" cellspacing="1" width="100%">
                                    <tr align="center">
                                      <th width="4%" class="content">
                                        <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">       
                                      </th>
                                      <th width="22%" class="content">Order Status</th>
                                      <!--<th width="12%" class="content">Photo </th> -->
                                      <th width="19%" class="content">Order&nbsp;Detail</th>
                                      <th width="33%" class="content">Customer&nbsp;Detail</th>
                                        <?php
                                            if($_SESSION['group_id'] == 1){
                                        ?>
                                      <th width="22%" class="content" align="center">Total</th>
                                      <?php
                                            }
                                        ?>
                                      <!--<th width="8%" class="content" align="center">View</th> -->
                                    </tr>
                                    <?php  $count=1;
                                        if($row_Rs1!=''){											
                                            do{
                                                if($count%2==0)
                                                $bgcolor='#f7f7f7';
                                                else
                                                $bgcolor='#FFFFFF';
                                    ?>
                                    <tr bgcolor="<?php echo $bgcolor;?>" style="border-bottom:1px solid #CCC;">
                                      <td width="4%" class="content">
                                        <?php
                                            if(($_SESSION['group_id'] == 1) || ($row_Rs1['allow_to_delete'] != "" && $_SESSION['group_id'] == 2)){
                                        ?>
                                            <input type="checkbox" value="<?php echo $row_Rs1['reference_id']; ?>" name="productIdList[]"><br /> 
                                        <?php
                                            }
                                        ?>							
                                      </td>
                                      <!--onClick="return displayProduct();"-->
                                      <td width="22%" class="content01" align="center">
                                        <input type="submit" name="<?php echo $row_Rs1['reference_id']; ?>" value="Payment Received" 
                                            title="Set This Order Status to Payment Received"/>
                                        <?php
                                            if($row_Rs1['allow_to_delete'] != "" && $_SESSION['group_id'] == 1){
                                                echo '<br/><br/><span style="color:green;font-size:10px;">Deletable by Non-Administrator</span>';
                                            }
                                        ?>								
                                      </td>
                                      <td align="left" class="content01">
                                        <?php echo "Order No.: <span class=\"title9\">
                                                <a href=\"../delivery/order_form.php?id=".base64_encode($row_Rs1['session_id'])."\" target=\"_blank\">".($row_Rs1['reference_id']+1000)."</a>
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
                                      <?php
                                            if($_SESSION['group_id'] == 1){
                                        ?>
                                      <td align="left" class="content01">
                                          <?php echo "Shipping: A$".number_format($row_Rs1['ship_cost'],2); ?><br>
                                          <?php //echo "Product: A$".number_format($row_Rs1['sub_total'],2); ?><!--<br>-->
                                          <?php echo "Total: <span class=\"title9\">A$".number_format($row_Rs1['grand_total'],2)."</span>"; ?>
                                      </td>
                                      <?php
                                            }
                                        ?>
                                      <!--<td class="content" align="center"><a href="order_form.php?id=<?php //echo base64_encode($row_Rs1['reference_id'])?>">
                                      Order Detail</a></td> -->
                                    </tr>
                                    <?php  $count++;
                                         } while($row_Rs1 = mysqli_fetch_assoc($Rs1));
                                }else{ ?>
                                    <tr>
                                      <td width="4%"></td>
                                      <td colspan="6" class="content">No Record Found.</td>
                                    </tr>
                                <?php } ?>
                                  </table>
                                </form>
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
          </div>
        </div>
    <!--////////////////////////////////////////// CONTENT END////////////////////////////////////////////// -->
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>

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

function jumpMenu(target,selObj,restore){ 
  if (selObj.selectedIndex>0 && selObj.options[selObj.selectedIndex].value != ''){
    window.open(selObj.options[selObj.selectedIndex].value,target);}
  else if(selObj.options[selObj.selectedIndex].value == '')  {selObj.selectedIndex=0;}
  if (restore) selObj.selectedIndex=0;
}
</script>
</body>
</html>