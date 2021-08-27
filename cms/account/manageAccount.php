<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

$today=date("Y-m-d");

$temp_query_Recordset1 = "SELECT * FROM accounts WHERE status='Activated'";					 
$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset1) or die(mysqli_error());
$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);

do
{
	if($_POST[$row_Rs1['id']]=="Suspend")
	{	
		$this_host_product_id=$row_Rs1['id'];
		$insertSQL1 = "UPDATE accounts SET 
		status='Suspended' WHERE id='$this_host_product_id'"; 
		
		mysqli_select_db($conn, $database_conn);
		$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
	}
} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));
	

$temp_query_Recordset2 = "SELECT * FROM accounts WHERE status='Suspended'";					 
$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
$row_Rs1 = mysqli_fetch_assoc($Rs1);

do
{
	if($_POST[$row_Rs1['id']]=="Activate")
	{	
		$this_host_product_id=$row_Rs1['id']; 
		$insertSQL1 = "UPDATE accounts SET 
		status='Activated' WHERE id='$this_host_product_id'"; 
		//echo $insertSQL1;
		mysqli_select_db($conn, $database_conn);
		$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
	}
} while($row_Rs1 = mysqli_fetch_assoc($Rs1));

//Change Status - End
if($_POST['delete']=='Delete'){	
//Delete Testimonial - Start
$items_delete_array=$_POST['productIdList'];

if(!empty($_POST['productIdList']))
{
	foreach((array)$items_delete_array as $items_delete)
	{
		$del_data="delete from accounts WHERE id='$items_delete'";
		mysqli_select_db($conn, $database_conn);
		$dataResult1 = mysqli_query($conn, $del_data) or die(mysqli_error());			
	}
}
}


$status_condition = " AND status='Activated' ";

if($_GET['tab']=="suspend"){
	$status_condition = " AND status='Suspended' ";
}

if($_POST['search'] == 'Search'){
	$_SESSION['keyword'] = $_POST['keyword'];
}elseif($_POST['reset'] == 'Reset'){
	$_SESSION['keyword'] = '';
}


if($_SESSION['keyword'] != ''){
	$keyword_condition = " AND (
		first_name LIKE '%".$_SESSION['keyword']."%' OR 
		last_name LIKE '%".$_SESSION['keyword']."%' OR 
		email LIKE '%".$_SESSION['keyword']."%' OR 
		address LIKE '%".$_SESSION['keyword']."%' OR 
		address2 LIKE '%".$_SESSION['keyword']."%' OR 
		town LIKE '%".$_SESSION['keyword']."%' OR 
		country LIKE '%".$_SESSION['keyword']."%') ";
}else{
	$keyword_condition = '';
}


$query="SELECT * FROM accounts WHERE id !='' $status_condition $keyword_condition ORDER BY id DESC";



$currentPage = $_SERVER["PHP_SELF"];	
$maxRows_Rs1 = 20;
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

$query2=mysqli_query($conn, "SELECT * FROM accounts WHERE status='Suspended' $keyword_condition");
$total_testimonial_not_on_display = mysqli_num_rows($query2);
$query=mysqli_query($conn, "SELECT * FROM accounts WHERE status='Activated' $keyword_condition");
$total_testimonial_on_display = mysqli_num_rows($query);

?>


<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
</head>

<body onLoad="waitPreloadPage();">
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
			
            <div id="prepage" style="position:absolute; z-index:100; left:50%; top:50%; height:20px; width:20px;"><img src="../images/loading.gif"></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped">
        	<tr>
                <td colspan="2" class="border_background_no_color"><h3>Manage Accounts</h3></td>
            </tr>  
          <tr>
            <td rowspan="2" align="left" valign="top" class="border_background_no_color"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="288" align="left" valign="top"><table width="100%" align="left" cellpadding="0"  cellspacing="0">
                  <tr>
                    <td width="636" height="244" align="left" valign="top"><div align="left">
                      <form name="ProductListForm1" method="post" action="manageAccount.php?tab=activate&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1'];?>">
                          <div style="text-align:right;">
                          <input type="text" name="keyword" placeholder="Customers Name,  Address, Email or Postcode" value="<?php echo $_SESSION['keyword']?>" style="width:300px;">
                          <input type="submit" name="search" value="Search">
                          <input type="submit" name="reset" value="Reset">
                          </div>
                      </form>
                    
                      <?php 
                    if($_GET['tab']=="activate"||$_GET['tab']=="") { ?>              
                      <form name="ProductListForm1" method="post" action="manageAccount.php?tab=activate&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1'];?>">
                      <script>
                        function deleteProduct1()
                        {
                            var point = confirm("Are You Sure You Want To Delete?");
                            if(point==true)
                            {
                                var id= new Array('productIdList[]');
                                if(id=='')
                                {
                                    alert("No Item Selected");
                                    return false;
                                }
                                return true;
                            }
                            else
                            {
                                return false;
                            }
                        }
        
                      </script>
                        <div id="list">
                        <div id="tab">
                          <ul>
                            <li class="current"><a href="manageAccount.php?tab=activate" title="Activate account" class="content">Activated(
                                        <?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>
                                    0
                                    <?php }?>
                                    )</a></li>
                            <li class=""><a href="manageAccount.php?tab=suspend" title="Suspend account" class="content">Suspended (
                                        <?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>
                                    0
                                    <?php }?>
                                    )</a></li>
                          </ul>
                        </div>
                        
                        <div class="function"> <span class="content">Select
                            <input type="checkbox" name="checkbox" value="checkbox" checked disabled> 
                            to:
                            <input type="submit" name="delete" value="Delete" onClick="return deleteProduct1();" title="Delete selected item(s)">
                        </span></div>
                        <table border="0" cellpadding="4" cellspacing="1" width="100%">
                          <tr>
                            <th width="3%" class="content">
                              <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">                    </th>
                            <th width="9%" class="content">Suspend</th>
                            <th width="17%" class="content">First Name</th>
                            <th width="13%" class="content">Last Name</th>
                            <th width="13%" class="content">Email</th>
                            <th width="21%" class="content" align="center">Address</th>
                            <th width="10%" class="content" align="center">Status</th>
                            <th width="8%" class="content" align="center">Date</th>
                            <th width="6%" class="content" align="center">Edit</th>
                            <!--<th width="6%">Edit</th>-->
                          </tr>
        
                          <?php
                          $count=1;
                            if($row_Rs1!='')
                            {											
                                if($row_Rs1!='')
                                {
                                    do
                                    {
                        if($count%2==0)
                        $bgcolor='#f7f7f7';
                        else
                        $bgcolor='#FFFFFF';
                                    
                            ?>
                          <tr bgcolor="<?php echo $bgcolor;?>">
                            <td width="5%" class="content" bgcolor="<?php echo $bgcolor;?>">
                              <input type="checkbox" value="<?php echo $row_Rs1['id']; ?>" name="productIdList[]">
                                <br />                    </td>
                            <td width="11%" class="content01" style="text-align:center">
                              <input type="submit" name="<?php echo $row_Rs1['id']; ?>" value="Suspend" title="Suspend account"/>                      </td>
                              
                             
                            <td class="content01"><?php echo $row_Rs1['first_name']; ?></td>
                            <td class="content01"><?php echo $row_Rs1['last_name']; ?></td>
                            <td class="content01"><?php echo $row_Rs1['email']; ?></td>
                            <td class="content01">
								<?php echo $row_Rs1['address']; ?><br>
								<?php echo $row_Rs1['address2']; ?><br>
								<?php echo $row_Rs1['town']; ?><br>
								<?php echo $row_Rs1['country']; ?><br>
                            </td>
                            <td class="content01"><?php echo $row_Rs1['status']; ?></td>
                            <td class="content01"><?php echo $row_Rs1['created']; ?></td>
                            <td class="content01" align="center">
                            	<a href="editAccount.php?id=<?php echo base64_encode($row_Rs1['id'])?>"><img src="../images/b_edit.png" width="16" height="15" border="0"></a><br><br>
								<a href="accountBooking.php?id=<?php echo base64_encode($row_Rs1['id'])?>">Order</a>
                            </td>
                          </tr>
                          <?php $count++;
                                 } while($row_Rs1 = mysqli_fetch_assoc($Rs1));
                            }
                            else
                            { ?>
                          <tr>
                            <td width="5%"></td>
                            <td colspan="6" class="content">No Record Found.</td>
                          </tr>
                          <?php
                                }
                            }
                            else
                            { ?>
                          <tr>
                            <td width="5%"></td>
                            <td colspan="6" class="content">No Record Found.</td>
                            <!--<td></td>-->
                          </tr>
                          <?php } ?>
                          <!--Empty Detection End-->
                        </table>
                      </form>
                      <span class="content">
                      <!--Activated End-->
                      <?php } else if($_GET['tab']=="suspend") { ?>
                      <!--Suspended-->
                      </span>
                      <form name="ProductListForm2" method="post" action="manageAccount.php?tab=suspend&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1'];?>">
                      <script>
                        function deleteProduct2()
                        {
                                var id= new Array('productIdList[]');
                                if(id=='')
                                {
                                    alert("No Item Selected");
                                    return false;
                                }
                        
                            var point=confirm("Are You Sure You Want To Delete?");
                            if(point==true)
                            {
                                return true;
                            }
                            else
                            {
                                return false;
                            }
                            
                        }
        
                      </script>			  
                        <div id="list">
                        <div id="tab">
                          <ul>
                            <li class=""><a href="manageAccount.php?tab=activate" title="Activate account" class="content">Activated(
                                        <?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>
                                    0
                                    <?php }?>
                                    )</a></li>
                            <li class="current"><a href="manageAccount.php?tab=suspend" title="Suspend account" class="content">Suspended (
                                        <?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>
                                    0
                                    <?php }?>
                                    )</a></li>
                          </ul>
                        </div>
                        <div class="function"> <span class="content"> Select 
                            <input type="checkbox" name="checkbox" value="checkbox" checked disabled> 
                            to:
                            <input type="submit" name="delete" value="Delete" onClick="return deleteProduct2();" title="Delete selected item(s)" />
                        </span></div>
                        <table border="0" cellpadding="4" cellspacing="1" width="100%">
                          <tr>
                            <th width="3%" class="content">
                              <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">                    </th>
                            <th width="9%" class="content">Activated</th>
                            <th width="17%" class="content">First Name</th>
                            <th width="13%" class="content">Last Name</th>
                            <th width="13%" class="content">Email</th>
                            <th width="21%" class="content" align="center">Address</th>
                            <th width="10%" class="content" align="center">Status</th>
                            <th width="8%" class="content" align="center">Date</th>
                            <th width="6%" class="content" align="center">Edit</th>
                            <!--<th width="6%">Edit</th>-->
                          </tr>
                          <?php $count=1;
                            if($row_Rs1!='')
                            {											
                                if($row_Rs1!='')
                                { 
                                    do
                                    { 
                                    
                        if($count%2==0)
                        $bgcolor='#f7f7f7';
                        else
                        $bgcolor='#FFFFFF';
        
                        ?>
                          <tr bgcolor="<?php echo $bgcolor;?>">
                            <td width="3%" class="content" bgcolor="<?php echo $bgcolor;?>">
                              <input type="checkbox" value="<?php echo $row_Rs1['id']; ?>" name="productIdList[]">
                                <br />                    </td>
                            <td width="9%" class="content01" style="text-align:center">
                              <input type="submit" name="<?php echo $row_Rs1['id']; ?>" value="Activate" title="Activate account"/>                      </td>
                              
                             
                            <td class="content01"><?php echo $row_Rs1['first_name']; ?></td>
                            <td class="content01"><?php echo $row_Rs1['last_name']; ?></td>
                            <td class="content01"><?php echo $row_Rs1['email']; ?></td>
                            <td class="content01">
								<?php echo $row_Rs1['address']; ?><br>
								<?php echo $row_Rs1['address2']; ?><br>
								<?php echo $row_Rs1['town']; ?><br>
								<?php echo $row_Rs1['country']; ?><br>
                            </td>
                            <td class="content01"><?php echo $row_Rs1['status']; ?></td>
                            <td class="content01"><?php echo $row_Rs1['created']; ?></td>
                            <td class="content01" align="center">
                                <a href="editAccount.php?id=<?php echo base64_encode($row_Rs1['id'])?>"><img src="../images/b_edit.png" width="16" height="15" border="0"></a><br><br>
                                <a href="accountBooking.php?id=<?php echo base64_encode($row_Rs1['id'])?>">Order</a>
                            </td>
                          </tr>
                          <?php $count++;
                                 } while($row_Rs1 = mysqli_fetch_assoc($Rs1));
                            }
                            else
                            { ?>
                          <tr>
                            <td width="3%"></td>
                            <td colspan="6" class="content">No Record Found.</td>
                            <!--<td></td>-->
                          </tr>
                          <?php
                                                        }
                                                    }
                                                    else
                                                    { ?>
                          <tr>
                            <td width="3%"></td>
                            <td colspan="7" class="content">No Record Found.</td>
                            <!--<td></td>-->
                          </tr>
                          <?php } ?>
                          <!--Empty Detection End-->
                        <tr><td colspan="9">&nbsp;</td></tr>				  
                        </table>
                      </form>
                      <!--Suspended End-->
                      <?php } ?>
                      <!--End-->
                      </div>
                    </td>
                  </tr>
                  
                <tr><td colspan="4"><br></td></tr>
                <tr><td colspan="4"><div align="left" class="content">
                <?php if ($totalRows_Rs1 > 0 ) { ?> 
                      &nbsp;Total Records <?php echo ($startRow_Rs1 + 1) ?> to <?php echo min($startRow_Rs1 + $maxRows_Rs1, $totalRows_Rs1) ?> of <?php echo $totalRows_Rs1 ?> <br>
                        &nbsp;<a href="<?php printf("%s?pageNum_Rs1=%d%s", $currentPage, 0, $queryString_Rs1); ?>">First</a> 
                        <a href="<?php printf("%s?pageNum_Rs1=%d%s", $currentPage, max(0, $pageNum_Rs1 - 1), $queryString_Rs1); ?>">| Previous</a> | 
                        <a href="<?php printf("%s?pageNum_Rs1=%d%s", $currentPage, min($totalPages_Rs1, $pageNum_Rs1 + 1), $queryString_Rs1); ?>">Next</a> 
                        <a href="<?php printf("%s?pageNum_Rs1=%d%s", $currentPage, $totalPages_Rs1, $queryString_Rs1); ?>">| Last</a> |
                <?php } ?></div></td></tr>			  		  
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
function chkAll(frm, arr, mark)
{
  for (i = 0; i <= frm.elements.length; i++)
  {
   try
   {
     if(frm.elements[i].name == arr)
	 {
       frm.elements[i].checked = mark;
     }
   } catch(er) {}
  }
}

function jumpMenu(target,selObj,restore){ 
  if (selObj.selectedIndex>0 && selObj.options[selObj.selectedIndex].value != ''){
    window.open(selObj.options[selObj.selectedIndex].value,target);}
  else if(selObj.options[selObj.selectedIndex].value == '')  {selObj.selectedIndex=0;}
  if (restore) selObj.selectedIndex=0;
}

<!-- PreLoad Wait - Script -->
<!-- This script and more from http://www.rainbow.arch.scriptmania.com 

function waitPreloadPage() { //DOM
if (document.getElementById){
document.getElementById('prepage').style.visibility='hidden';
}else{
if (document.layers){ //NS4
document.prepage.visibility = 'hidden';
}
else { //IE4
document.all.prepage.style.visibility = 'hidden';
}
}
}
// End -->
</script>
</body>
</html>