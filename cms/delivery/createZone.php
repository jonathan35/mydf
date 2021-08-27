<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

//*************************************************Edit Country*************************************************
	$temp_query_Recordset = "SELECT * FROM zone_area";					 
	$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
	do
	{
		if($_POST['update'.$row_Rs1['maincat_id']]==" Update ")
		{	
		
			$id_data=$row_Rs1['maincat_id'];
		
			$insertSQL1 = "UPDATE zone_area SET maincat_name='".$_POST['maincat_name'.$row_Rs1['maincat_id']]."', area_cover='".$_POST['area'.$row_Rs1['maincat_id']]."', position='".$_POST['position'.$row_Rs1['maincat_id']]."' WHERE maincat_id='".$id_data."'"; 
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
			$success1='<font color="#336600">Zone updated</font>';
		}else
			$success1='<font color="#CC3300">failed to update Zone</font>';
	} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));	

$maincat_query=mysqli_query($conn, "SELECT maincat_name FROM zone_area WHERE status!=-1 ORDER BY maincat_name");
$maincat_set=mysqli_fetch_assoc($maincat_query);

$selected_section_query=mysqli_query($conn, "SELECT * FROM zone_area WHERE maincat_id='".$_GET['id']."' ");
$selected_section_set=mysqli_fetch_array($selected_section_query);


//******************************************Add Country*************************************************
if($_POST['submit']==' Submit ')
{
	$zone_area = mysqli_real_escape_string($conn, $_POST['maincatname']);
	$area = mysqli_real_escape_string($conn, $_POST['area']);

	if(mysqli_query($conn, "INSERT INTO zone_area (maincat_id, maincat_name, area_cover, status, date_posted) VALUES ('', '$zone_area', '$area', 1, '".date('Y-m-d')."')"))		
		$success='<font color="#336600">zone added</font>';
	else
		$success='<font color="#CC3300">Failed to add zone</font>';
}
//*************************************************Manage Country*************************************************
$today=date("Y-m-d");




///////////////display//////////////////////////////////////////////////////////////
$temp_query_Recordset2 = "SELECT * FROM zone_area WHERE status=0";					 
$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
$row_Rs1 = mysqli_fetch_assoc($Rs1);

do
{
	if($_POST[$row_Rs1['maincat_id']]=="Display")
	{	
		$this_host_product_id=$row_Rs1['maincat_id']; 
		$insertSQL1 = "UPDATE zone_area SET 
		status='1' WHERE maincat_id='$this_host_product_id'"; 
		//echo $insertSQL1;
		mysqli_select_db($conn, $database_conn);
		$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
	}
} while($row_Rs1 = mysqli_fetch_assoc($Rs1));
///////////////////////////////////display///////////////////////////////////////////

$temp_query_Recordset1 = "SELECT * FROM zone_area WHERE status=1";					 
$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset1) or die(mysqli_error());
$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);

do
{
	if($_POST[$row_Rs1['maincat_id']]=="Not Display")
	{	
		$this_host_product_id=$row_Rs1['maincat_id'];
		$insertSQL1 = "UPDATE zone_area SET 
		status='0' WHERE maincat_id='$this_host_product_id'"; 
		
		mysqli_select_db($conn, $database_conn);
		$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
	}
} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));

$temp_query_Recordset2 = "SELECT * FROM zone_area WHERE status=0";					 
$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
$row_Rs1 = mysqli_fetch_assoc($Rs1);

do
{
	if($_POST[$row_Rs1['maincat_id']]=="Display")
	{	
		$this_host_product_id=$row_Rs1['maincat_id']; 
		$insertSQL1 = "UPDATE zone_area SET 
		status='1' WHERE maincat_id='$this_host_product_id'"; 
		//echo $insertSQL1;
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
		$del_data="UPDATE zone_area SET status='-1' WHERE maincat_id='$items_delete'";
		mysqli_select_db($conn, $database_conn);
		$dataResult1 = mysqli_query($conn, $del_data) or die(mysqli_error());			
	}
}
}

if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="")
{
	$query="SELECT * FROM zone_area WHERE status=1 ORDER BY position ASC, maincat_name ASC";
}
else if($_GET['tab']=="approvednotondisplay")
{
	$query="SELECT * FROM zone_area WHERE status=0 ORDER BY position ASC, maincat_name ASC";
}

$currentPage = $_SERVER["PHP_SELF"];	
$maxRows_Rs1 = 12;
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

$query2=mysqli_query($conn, "SELECT * FROM zone_area WHERE status=0");
$total_testimonial_not_on_display = mysqli_num_rows($query2);
$query=mysqli_query($conn, "SELECT * FROM zone_area WHERE status=1");
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
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" align="center">
          <div class="table-responsive">
          	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                <tr>
                    <td colspan="2" class="border_background_no_color"><h3>Create Zone</h3></td>
                </tr> 
              <tr>
                <td align="left" valign="top" class="border_background_no_color">
                  <table width="100%" align="left" cellpadding="2"  cellspacing="2" border="0">
                    <form name="form1" method="post" action="createZone.php?add=1&tab=approvedondisplay" enctype="multipart/form-data">
                      <tr>
                        <td colspan="2" class="main_title"><strong><?php echo $success;?></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="red">*Indicate required fields </td>
                      </tr>
            
                      <tr>
                        <td width="20%" class="main_title"><span class="red">*</span>Add Zone&nbsp;</td>
                        <td><input type="text" name="maincatname" maxlength="25">
                        <span class="red02">
                        <br>Limited 25 character only</span></td>
                      </tr>
                      <tr valign="top">
                          <td width="20%" class="main_title">Cover Area &nbsp;</td>
                          <td width="80%"><input type="text" name="area" maxlength="50">
                            <span class="red02">
                        <br>Limited 50 character only</span></td>
                      </tr>           
                      
                      
                      <tr>
                        <td align="center" colspan="2">
                          <input type="submit" name="submit" value=" Submit " onClick="return check();">
            &nbsp;
                          <input type="reset" name="reset" value=" Reset ">            </td>
                      </tr>
                    </form>
                </table></td>
              </tr>
              <tr>
                <td style="background-color:#FFF">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="2" class="border_background_no_color"><h3>Manage Zone</h3></td>
                    </tr> 
                    <tr>
                      <td height="288" align="left" valign="top"><table width="100%" align="left" cellpadding="0"  cellspacing="0">
                          <tr>
                            <td width="636" height="244" align="left" valign="top"><div align="left">
                                <?php 
                        if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="") { ?>
                                <!--On Display-->
                                <form name="form2" method="post" action="createZone.php?tab=approvedondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
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
                                  <div id="tab">
                                    <ul>
                                      <li class="current"><a href="createZone.php?tab=approvedondisplay" title="Display Product Item Online" class="content">On Display (
                                            <?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>
                                        0
                                        <?php }?>
                                        )</a></li>
                                      <li class=""><a href="createZone.php?tab=approvednotondisplay" title="Not Display Product Item Online" class="content">Not On Display (
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
                                    <tr align="center">
                                      <th width="6%" class="content">
                                        <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">                          </th>
                                      <th width="14%" class="content">On Display</th>
                                      <!--<th width="12%" class="content">Photo</th>-->
                                      <th width="35%" class="content" style="text-align:left">Zone</th>
                                      <th width="21%" class="content" style="text-align:left">Area </th>
                                        <th width="10%" class="content" align="center">Position No. </th>
                                         <th width="11%" class="content" align="center">Update</th>
                                     
                                    </tr>
                                    <?php  $count=1;
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
                                      <td width="6%" class="content">
                                        <input type="checkbox" value="<?php echo $row_Rs1['maincat_id']; ?>" name="productIdList[]">
                                        <br />                          </td>
                                      <!--onClick="return displayProduct();"-->
                                      <td width="14%" class="content01" align="center">
                                        <input type="submit" name="<?php echo $row_Rs1['maincat_id']; ?>" value="Not Display" title="Not Display This Product At Your Online List"/>                          </td>
                                      
                                      <td align="left" class="content01">
                                      
                                      <input type="text" name="<?php echo 'maincat_name'.$row_Rs1['maincat_id'];?>" value="<?php echo $row_Rs1['maincat_name']; ?>" style="width:350px;">
                                      
                                      </td>
                                      <td class="content01"><input type="text" name="<?php echo 'area'.$row_Rs1['maincat_id'];?>" value="<?php echo $row_Rs1['area_cover']; ?>" style="width:200px;"></td>
                                      <td align="center" class="content01"><input name="<?php echo 'position'.$row_Rs1['maincat_id']?>" type="text" value="<?php echo $row_Rs1['position'];?>" style="width:20px;" width="5"></td>
                                      <td align="center" class="content01"><input type="submit" name="<?php echo 'update'.$row_Rs1['maincat_id'];?>" value=" Update " onClick="return">
                                      &nbsp;</td>
                                      
                                    </tr>
                                    <?php  $count++;
                                     } while($row_Rs1 = mysqli_fetch_assoc($Rs1));
                                }
                                else
                                { ?>
                                    <tr>
                                      <td width="6%"></td>
                                      <td colspan="6" class="content">No Record Found.</td>
                                      <!--<td></td>-->
                                    </tr>
                                    <?php 
                                    }
                                }
                                else
                                { ?>
                                    <?php } ?>
                                    <!--Empty Detection End-->
                                    <tr>
                                      <td colspan="5">&nbsp; </td>
                                    </tr>
                                  </table>
                                </form>
                                <span class="content">
                                <!--On Display End-->
                                <?php } else if($_GET['tab']=="approvednotondisplay") { ?>
                                <!--Not On Display-->
                                </span>
                                <form name="ProductListForm2" method="post" action="createZone.php?tab=approvednotondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1=1']?>">
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
                                  <div id="tab">
                                    <ul>
                                      <li class=""><a href="createZone.php?tab=approvedondisplay" title="Display Product Item Online" class="content">On Display(
                                            <?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>
                                        0
                                        <?php }?>
                                        )</a></li>
                                      <li class="current"><a href="createZone.php?tab=approvednotondisplay" title="Not Display Product Item Online" class="content">Not On Display (
                                            <?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>
                                        0
                                        <?php }?>
                                        )</a></li>
                                    </ul>
                                  </div>
                                   <div class="function"> <span class="content">Select
                                      <input type="checkbox" name="checkbox" value="checkbox" checked disabled>
                                    to:
                                    <input type="submit" name="delete" value="Delete" onClick="return deleteProduct2();" title="Delete selected item(s)" />
                                  </span></div>
                                  <table border="0" cellpadding="4" cellspacing="1" width="100%">
                                    <tr align="center">
                                      <th width="5%" class="content">
                                        <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">                          </th>
                                      <th width="15%" class="content">On Display</th>
                                     <!-- <th width="10%" class="content">Photo </th> -->
                                      <th width="35%" class="content" style="text-align:left"> Zone</th>
                                      <th width="21%" class="content" style="text-align:left">Area</th>
                                        <th width="10%" class="content" align="center">Position No. </th>
                                      <th width="11%" class="content" align="center">Update</th>
                                       
                                    </tr>
                                    <?php  $count=1;
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
                                      <td width="5%" class="content">
                                        <input type="checkbox" value="<?php echo $row_Rs1['maincat_id']; ?>" name="productIdList[]">
                                        <br />                          </td>
                                      <!--onClick="return displayProduct();"-->
                                      <td width="15%" class="content01" align="center">
                                        <input type="submit" name="<?php echo $row_Rs1['maincat_id']; ?>" value="Display" title="Display This Product At Your Online List"/>                          </td>
                                       
                                      <td align="left" class="content01"><input type="text" name="<?php echo 'maincat_name'.$row_Rs1['maincat_id'];?>" value="<?php echo $row_Rs1['maincat_name']; ?>" style="width:350px;">                         </td>
                                      <td align="center" class="content01"><input type="text" name="<?php echo 'area'.$row_Rs1['maincat_id'];?>2" value="<?php echo $row_Rs1['area_cover']; ?>" style="width:200px;"></td>
                                      <td align="center" class="content01"><input name="<?php echo 'position'.$row_Rs1['maincat_id']?>" type="text" value="<?php echo $row_Rs1['position'];?>" style="width:20px;" width="5"></td>
                                      <td align="center" class="content01"><input type="submit" name="<?php echo 'update'.$row_Rs1['maincat_id'];?>" value=" Update " onClick="return">&nbsp;</td>
                                             
                                    </tr>
                                    <?php  $count++;
                                     } while($row_Rs1 = mysqli_fetch_assoc($Rs1));
                                }
                                else
                                { ?>
                                    <tr>
                                      <td width="5%"></td>
                                      <td colspan="6" class="content">No Record Found.</td>
                                      <!--<td></td>-->
                                    </tr>
                                    <?php 
                                    }
                                }
                                else
                                { ?>
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

<script language="javascript">
function check()
{
	if(form1.maincatname.value=="")
	{
		alert("Please enter zone name.");
		form1.maincatname.focus();
		return false;
	}
	return true;
}

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
</script>
</body>
</html>