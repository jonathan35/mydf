<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}


	$temp_query_Recordset1 = "SELECT * FROM events WHERE status='enable'";					 
	$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset1) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
	
	do
	{
		if($_POST[$row_Rs1['id']]=="Disable")
		{	
			$this_host_product_id=$row_Rs1['id'];
			$insertSQL1 = "UPDATE events SET status='disable' WHERE id='$this_host_product_id'"; 
			
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
		}
	} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));
	
	$temp_query_Recordset2 = "SELECT * FROM events WHERE status='disable'";					 
	$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($Rs1);
	
	do
	{
		if($_POST[$row_Rs1['id']]=="Enable")
		{	
			$this_host_product_id=$row_Rs1['id']; 
			$insertSQL1 = "UPDATE events SET status='enable' WHERE id='$this_host_product_id'"; 
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
		}
	} while($row_Rs1 = mysqli_fetch_assoc($Rs1));
	//Change Status - End
	
	//Delete Testimonial - Start
if($_POST['delete']=="Delete")
{		
	$items_delete_array=$_POST['productIdList'];
	
	if(!empty($_POST['productIdList']))
	{
		foreach((array)$items_delete_array as $items_delete)
		{
			$target_query = mysqli_query($conn, "SELECT * FROM events WHERE id='$items_delete'") or die(mysqli_error());
			$target = mysqli_fetch_assoc($target_query);
			
			if(!empty($target)){
				if(!empty($target)){
					@unlink('../../'.$target['photo']);
				}
				mysqli_query($conn, "DELETE FROM events WHERE id='$items_delete'") or die(mysqli_error());			
			}
		}
	}
}

$query="SELECT * FROM events WHERE status='enable' ORDER BY title ASC";

if($_GET['tab']=="disable")
{
		$query="SELECT * FROM events WHERE status='disable' ORDER BY title ASC";
}

	$currentPage = $_SERVER["PHP_SELF"];	
	$maxRows_Rs1 = 12;
	$pageNum_Rs1 = 0;
	if (isset($_GET['pageNum_Rs1'])) {
	  $pageNum_Rs1 = $_GET['pageNum_Rs1'];
	}
	$startRow_Rs1 = $pageNum_Rs1 * $maxRows_Rs1;
	
	$colname_Rs1 = "";
	//mysqli_select_db($conn, $database_conn);
	mysqli_select_db($conn, $DB->database_conn);	
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
	
	$query2=mysqli_query($conn, "SELECT * FROM events WHERE status='disable'");
	$total_testimonial_not_on_display = mysqli_num_rows($query2);
	$query=mysqli_query($conn, "SELECT * FROM events WHERE status='enable'");
	$total_testimonial_on_display = mysqli_num_rows($query);

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
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="table-responsive">
         	
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
            <tr>
                <td style="background-color:#FFF">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="border_background_no_color"><h3>Events</h3></td>
                    </tr>
                    <tr>
                        <td height="288" align="left" valign="top"><table width="100%" align="left" cellpadding="0"  cellspacing="0">
                    <tr>
                        <td width="636" height="244" align="left" valign="top"><div align="left">
                        <?php if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="") { ?>
                        <!--On Enable-->
                        <form name="form2" method="post" action="events.php?tab=approvedondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
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
                                <li class="current"><a href="events.php?tab=approvedondisplay" title="Enable Item" class="content">
                                    Enable (<?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>0<?php }?>)</a></li>
                                <li class=""><a href="events.php?tab=disable" title="Disable Item" class="content">
                                    Disable (<?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>0<?php }?>)</a></li>
                            </ul>
                        </div>
                        <div class="function"> 
                            <span class="content">
                                Select <input type="checkbox" name="checkbox" value="checkbox" checked disabled>
                                to: <input type="submit" name="delete" value="Delete" onClick="return deleteProduct1();" title="Delete selected item(s)">
                            </span>
                        </div>
                        <table border="0" cellpadding="4" cellspacing="1" width="100%">
                            <tr align="center">
                                <th width="5%" class="content">
                                    <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">


                                </th>
                                <th width="12%" class="content">Disable</th>
                                <th width="33%" class="content" style="text-align:left">Events </th>
                                <th width="14%" class="content" align="center">Update</th>
                                <th width="4%" class="content" align="center">Edit</th>
                            </tr>
                                <?php  $count=1;
                                if($row_Rs1!=''){
                                    do{
                                        if($count%2==0)
                                            $bgcolor='#f7f7f7';
                                        else
                                            $bgcolor='#FFFFFF';
                                ?>
                                <tr bgcolor="<?php echo $bgcolor;?>">
                                    <td width="6%" class="content"><input type="checkbox" value="<?php echo $row_Rs1['id']; ?>" name="productIdList[]"><br /></td>
                                    <!--onClick="return displayProduct();"-->
                                    <td align="center" class="content01">
                                        <input type="submit" name="<?php echo $row_Rs1['id']; ?>" value="Disable" 
                                            title="Disable This Product At Your Online List"/>
                                    </td>
                                    <td width="32%" class="content01" align="left">
                                        <input type="text" name="<?php echo 'title'.$row_Rs1['id'];?>" value="<?php echo $row_Rs1['title']; ?>"
                                             style="width:350px;">
                                    </td>
                                    <td align="center" class="content01">
                                        <input type="submit" name="<?php echo 'update'.$row_Rs1['id'];?>" value=" Update " onClick="return"><br><br>
                                    </td>
                                    <td align="center">
                                        <a href="editEvent.php?id=<?php echo base64_encode($row_Rs1['id'])?>">
                                        <img src="../images/b_edit.png" width="16" height="15" border="0"></a>&nbsp;
                                    </td>
                                
                                </tr>
                                <?php  	$count++;
                                    }while($row_Rs1 = mysqli_fetch_assoc($Rs1));
                                }else{ ?>
                                <tr>
                                <td width="6%"></td>
                                    <td colspan="6" class="content">No Record Found.</td>
                                </tr>
                                <?php } ?>
                                <!--Empty Detection End-->
                                <tr>
                                <td colspan="5">&nbsp; </td>
                                </tr>
                                </table>
                                </form>
                                <span class="content">
                                <!--On Enable End-->
                                <?php } else if($_GET['tab']=="disable") { ?>
                                <!--Not On Enable-->
                                </span>
                                <form name="ProductListForm2" method="post" 
                                    action="events.php?tab=disable&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
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
                                        <li class=""><a href="events.php?tab=approvedondisplay" title="Enable Item" class="content">
                                            Enable(<?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>0<?php }?>)</a></li>
                                        <li class="current"><a href="events.php?tab=disable" title="Disable Item" 
                                            class="content">
                                            Disable (<?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>0<?php }?> )</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="function"> 
                                    <span class="content">
                                    Select <input type="checkbox" name="checkbox" value="checkbox" checked disabled>
                                    to: <input type="submit" name="delete" value="Delete" onClick="return deleteProduct2();" title="Delete selected item(s)" /></span>
                                </div>
                                <table border="0" cellpadding="4" cellspacing="1" width="100%">
                                <tr align="center">
                                    <th width="8%" class="content">
                                        <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">
                                    </th>
                                    <th width="19%" class="content">Enable</th>
                                    <th width="57%" class="content">Event</th>
                                    <!--<th width="16%" class="content" align="center">Edit</th>-->
                                </tr>
                                <?php  $count=1;
                                    if($row_Rs1!=''){
                                        do{
                                            if($count%2==0)
                                                $bgcolor='#f7f7f7';
                                            else
                                                $bgcolor='#FFFFFF';
                                ?>
                                <tr bgcolor="<?php echo $bgcolor;?>">
                                    <td width="8%" class="content">
                                        <input type="checkbox" value="<?php echo $row_Rs1['id']; ?>" name="productIdList[]">                          
                                    </td>
                                    <td width="19%" class="content01" align="center">
                                        <input type="submit" name="<?php echo $row_Rs1['id']; ?>" value="Enable" title="Enable This Product At Your Online List"/>
                                    </td>
                                    <td align="left" class="content01">
                                        <?php echo 'title'.$row_Rs1['id'];?>
                                    </td>
                                   
                                   
                                    <td class="content" align="center">
                                        <a href="editEvent.php?id=<?php echo base64_encode($row_Rs1['id'])?>">
                                        <img src="../images/b_edit.png" width="16" height="15" border="0"></a>
                                    </td>
                                </tr>
                                <?php  $count++;
                                    } while($row_Rs1 = mysqli_fetch_assoc($Rs1));
                                }else{ ?>
                                <tr>
                                    <td width="8%"></td>
                                    <td colspan="6" class="content">No Record Found.</td>
                                </tr>
                                <?php } ?>
                                <!--Empty Detection End-->
                                <tr>
                                    <td colspan="5">&nbsp; </td>
                                </tr>
                            </table>
                            </form>
                            <!--Not On Enable End-->
                            <?php } ?>
                            <!--End-->
                            </div></td>
                        </tr>
                        <tr>
                        <td colspan="4">
                            <div align="left" class="content">
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
function check(){
	if(form1.title.value=="")
	{
		alert("Please enter events.");
		form1.title.focus();
		return false;
	}
	if(form1.photo.value==""){
		alert("Please enter browse an image for events.");
		form1.photo.focus();
		return false;
	}
	return true;
}

function chkAll(frm, arr, mark){
  for (i = 0; i <= frm.elements.length; i++){
   try{
     if(frm.elements[i].name == arr){
       frm.elements[i].checked = mark;
     }
   } catch(er) {}
  }
}
</script>
</body>

</html>