<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

//*************************************************Edit Country*************************************************
	$temp_query_Recordset = "SELECT * FROM post_zone";					 
	$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
	do
	{
		if($_POST['update'.$row_Rs1['id']]=="Update")
		{
			$zone = $_POST['zone'.$row_Rs1['id']];	
			$volume_from = $_POST['volume_from'.$row_Rs1['id']];
			$volume_to = $_POST['volume_to'.$row_Rs1['id']];
			$price = $_POST['price'.$row_Rs1['id']];
			$position = $_POST['position'.$row_Rs1['id']];

			$id = $row_Rs1['id'];
			
			$date_modify=date("Y-m-d");
			
			 mysqli_query($conn, "UPDATE post_zone SET zone_id='".$zone."', position='".$position."', price='".$price."', volume_from='".$volume_from."', volume_to='".$volume_to."' WHERE id='".$id."'");
							
										
			$success1='<font color="#336600">zone updated</font>';
		}else
			$success1='<font color="#CC3300">failed to update zone</font>';
	} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));	


//******************************************Add Country*************************************************
if($_GET['add']==1){
if($_POST['submit']==' Submit ')
{
	
	$zone=mysqli_real_escape_string($conn, $_POST['zone_id']);
	$volume_from=mysqli_real_escape_string($conn, $_POST['volume_from']);
	$volume_to=mysqli_real_escape_string($conn, $_POST['volume_to']);
	$price=mysqli_real_escape_string($conn, $_POST['price']);
	
	$date_posted=date("Y-m-d");

	if(mysqli_query($conn, "INSERT INTO post_zone (zone_id, price, volume_from, volume_to, status, position) 
								values ('".$zone."', '".$price."', '".$volume_from."', '".$volume_to."', '1', '0')"))		
		$success='<font color="#336600">zone added</font>';
	else
		$success='<font color="#CC3300">Failed to add zone</font>';
}
}
//*************************************************Manage Country*************************************************
$today=date("Y-m-d");
///////////////display//////////////////////////////////////////////////////////////
$temp_query_Recordset2 = "SELECT * FROM post_zone WHERE status=0";					 
$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
$row_Rs1 = mysqli_fetch_assoc($Rs1);

do
{
	if($_POST[$row_Rs1['id']]=="Display")
	{	
		$this_host_product_id=$row_Rs1['id']; 
		$insertSQL1 = "UPDATE post_zone SET 
		status='1' WHERE id='$this_host_product_id'"; 
		//echo $insertSQL1;
		mysqli_select_db($conn, $database_conn);
		$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
	}
} while($row_Rs1 = mysqli_fetch_assoc($Rs1));
///////////////////////////////////display///////////////////////////////////////////

$temp_query_Recordset1 = "SELECT * FROM post_zone WHERE status=1";					 
$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset1) or die(mysqli_error());
$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);

do
{
	if($_POST[$row_Rs1['id']]=="Not Display")
	{	
		$this_host_product_id=$row_Rs1['id'];
		$insertSQL1 = "UPDATE post_zone SET status='0' WHERE id='$this_host_product_id'"; 
		
		mysqli_select_db($conn, $database_conn);
		$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
	}
} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));

//Delete Testimonial - Start
if($_POST['delete']=="Delete")
{
	$items = $_POST['productIdList'];
	if(!empty($_POST['productIdList'])){
		foreach((array)$items as $item)
		{
			mysqli_query($conn, "DELETE FROM post_zone WHERE id='".$item."'") or die(mysqli_error());			
		}
	}
}

if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="")
{
if($_GET['main']!=''){
	$maincat01 = mysqli_real_escape_string($conn, $_GET['main']);
	$query="SELECT * FROM post_zone WHERE status=1 and zone_id='".$maincat01."' ORDER BY position ASC";
}else{
	$query="SELECT * FROM post_zone WHERE status=1 ORDER BY position ASC";
}
}
else if($_GET['tab']=="approvednotondisplay")
{
if($_GET['main']!=''){
	$maincat01 = mysqli_real_escape_string($conn, $_GET['main']);
	$query="SELECT * FROM post_zone WHERE status=0 and zone_id='".$maincat01."' ORDER BY position ASC";
}else{	
	$query="SELECT * FROM post_zone WHERE status=0 ORDER BY position ASC";
}
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

$query2=mysqli_query($conn, "SELECT * FROM post_zone WHERE status=0");
$total_testimonial_not_on_display = mysqli_num_rows($query2);
$query=mysqli_query($conn, "SELECT * FROM post_zone WHERE status=1");
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
                    <td colspan="2" class="border_background_no_color"><h3>Create Price of Zone</h3></td>
                </tr> 
              <tr>
                <td align="left" valign="top" class="border_background_no_color">
                  <table width="100%" align="left" cellpadding="2"  cellspacing="2" border="0">
                    <form name="form1" method="post" action="createPrice.php?add=1" enctype="multipart/form-data">
            
                      <tr>
                        <td colspan="2" class="main_title"><strong><?php echo $success;?></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="red">*Indicate required fields </td>
                      </tr>
              
            <?php          
                $zone_qry = mysqli_query($conn, "SELECT * FROM zone_area WHERE status=1 order by position asc, maincat_id desc");
                $zone_set = mysqli_fetch_assoc($zone_qry);
                     
            ?>           
                      <tr valign="top">
                        <td width="20%" class="main_title"><span class="red">*</span>Zone&nbsp;</td>
                        <td>
                            <select name="zone_id">
                                <option value="">select zone</option>
                                <?php do{?>
                                <option value="<?php echo $zone_set['maincat_id']?>"><?php 
								$limit = 60 - strlen($zone_set['maincat_name']);
								echo $zone_set['maincat_name']." : ".substr($zone_set['area_cover'],0,$limit); if(strlen($zone_set['area_cover'])>$limit) echo "..";?></option>
                                <?php }while($zone_set = mysqli_fetch_assoc($zone_qry))?>
                            </select>
                        </td>
                
					  <tr valign="top">
                          <td width="20%" class="main_title"><span class="red">*</span>Volume Range  <span class="red02">CM<sup>3</sup></span>&nbsp;</td>
                          <td width="80%">
                          <div style="display:inline-block; width:100px;">
                          <span class="red02">From</span>
                          <input name="volume_from" type="text"  size="5" maxlength="5">
                          </div>
                          <div style="display:inline-block; width:100px;">
                          <span class="red02">To</span>
                          <input name="volume_to" type="text"  size="5" maxlength="5">
                          </div>
                            <span class="red02">Numeric only</span>
                            
                          </td>
                      </tr>           
					  <tr valign="top">
                          <td width="20%" class="main_title"><span class="red">*</span>Price  <span class="red02">A$</span>&nbsp;</td>
                          <td width="80%"><input name="price" type="text" >
                            
                            <span class="red02">Numeric only</span></td>
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
                        <td colspan="2" class="border_background_no_color"><h3>Manage Price of Zone</h3></td>
                    </tr> 
                    <tr>
                      <td height="288" align="left" valign="top"><table width="100%" align="left" cellpadding="0"  cellspacing="0">
                          <tr>
                            <td width="636" height="244" align="left" valign="top"><div align="left">
            
                                <?php 
                        if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="") { ?>
                                <!--On Display-->
                                <form name="form2" method="post" action="createPrice.php?tab=approvedondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
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
                                      <li class="current"><a href="createPrice.php?tab=approvedondisplay" title="Display Product Item Online" class="content">On Display (
                                            <?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>
                                        0
                                        <?php }?>
                                        )</a></li>
                                      <li class=""><a href="createPrice.php?tab=approvednotondisplay" title="Not Display Product Item Online" class="content">Not On Display (
                                            <?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>
                                        0
                                        <?php }?>
                                        )</a></li>
                                    </ul>
                                  </div>
                                  <div class="function">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td><span class="content" style="padding-left:5px;"> Select 
                                          <input type="checkbox" name="checkbox2" value="checkbox" checked disabled>
                                          to:
                                          <input type="submit" name="delete" value="Delete" onClick="return deleteProduct1();" title="Delete selected item(s)">
                                        </span></td>
                                        <td align="right"><span class="content" style="padding-right:5px;"> Filter:
                                        
                                            <?php 
				$zone_area_query = mysqli_query($conn, "SELECT * FROM zone_area WHERE status=1 order by position asc, maincat_id desc");
                $zone_area = mysqli_fetch_assoc($zone_area_query);

											
											?>
                                            
                                            
                                            <select name="filter"  onChange="javascript:jumpMenu('_self',this,0)">
                                              <option value="">-Select1 package-</option>
                                              <?php do{?>
                                              <option value="<?php printf($currentPage); ?>?main=<?php echo $zone_area['maincat_id']?>&tab=<?php echo $_GET['tab'];?>"   
                                <?php if($_GET['main'] == $zone_area['maincat_id']){?>selected <?php }?>><?php echo $zone_area['maincat_name']." : ".$zone_area['area_cover']?></option>
                                              <?php }while($zone_area = mysqli_fetch_assoc($zone_area_query));?>

                                          </select>
                                        </span></td>
                                      </tr>
                                    </table>
                                  </div>
                                  <table border="0" cellpadding="4" cellspacing="1" width="100%">
                                    <tr>
                                      <th width="5%" class="content">
                                        <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">                          </th>
                                      <th width="8%" class="content">On Display</th>
                                      
                                      <th width="30%" class="content">Zone</th>
                                      <th width="15%" class="content">Volume From</th>
                                      <th width="15%" class="content">Volume To</th>
                                      <th width="10%" class="content">Price</th>
                                        <th width="10%" class="content" align="center">Position No. </th>
                                      <th width="10%" class="content" align="center">Update</th>
                                      
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
                                        <input type="checkbox" value="<?php echo $row_Rs1['id']; ?>" name="productIdList[]">
                                        <br />                          </td>
                                      <td width="13%" class="content01" align="center">
                                        <input type="submit" name="<?php echo $row_Rs1['id']; ?>" value="Not Display" title="Not Display This Item"/>                          </td>
                                      <td align="left" class="content01">
                               
            <?php          
                $zone_area_query = mysqli_query($conn, "SELECT * FROM zone_area WHERE status=1 order by position asc, maincat_id desc");
                $zone_area = mysqli_fetch_assoc($zone_area_query);
                     
            ?>
            <select name="<?php echo 'zone'.$row_Rs1['id'] ?>" style="width:220px;">
              <option value="">select zone</option>
                                <?php do{?>
                                <option value="<?php echo $zone_area['maincat_id']?>" <?php if($zone_area['maincat_id']==$row_Rs1['zone_id']){?> selected<?php }?>>
                                <?php 
								$limit = 60 - strlen($zone_area['maincat_name']);
								echo $zone_area['maincat_name']." : ".substr($zone_area['area_cover'],0,$limit); if(strlen($zone_area['area_cover'])>$limit) echo "..";?></option>
                                <?php }while($zone_area = mysqli_fetch_assoc($zone_area_query))?>
                          </select>
                                      
                                      
                                      </td>
                                      <!--<td align="center" class="content"><input type="text" name="<?php //echo 'area'.$row_Rs1['id'] ?>" value="<?php //echo $row_Rs1['area_cover'];  ?>" size="14"></td> -->
                                      <td align="center" class="content01"><input name="<?php echo 'volume_from'.$row_Rs1['id']; ?>" type="text" value="<?php echo $row_Rs1['volume_from'];?>" size="5" width="5"></td>
                                      <td align="center" class="content01"><input name="<?php echo 'volume_to'.$row_Rs1['id']; ?>" type="text" value="<?php echo $row_Rs1['volume_to'];?>" size="5" width="5"></td>
                                      <td align="center" class="content01"><input type="text" name="<?php echo 'price'.$row_Rs1['id'] ?>" value="<?php echo $row_Rs1['price'];  ?>" size="4" style="text-align:right"></td>
                                      <td align="center" class="content01"><input name="<?php echo 'position'.$row_Rs1['id']; ?>" type="text" value="<?php echo $row_Rs1['position'];?>" size="3" width="5"></td>
                                      
                                      <td align="center" class="content01"><input type="submit" name="<?php echo 'update'.$row_Rs1['id'];?>" value="Update" ></td>
                                      
                                    </tr>
                                    <?php  $count++;
                                     } while($row_Rs1 = mysqli_fetch_assoc($Rs1));
                                }
                                else
                                { ?>
                                    <tr>
                                      <th width="6%"></th>
                                      <td colspan="8" class="content">No Record Found.</td>
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
                                      <td colspan="9">&nbsp; </td>
                                    </tr>
                                  </table>
                                </form>
                                <span class="content">
                                <!--On Display End-->
                                <?php } else if($_GET['tab']=="approvednotondisplay") { ?>
                                <!--Not On Display-->
                                </span>
                                <form name="ProductListForm2" method="post" action="createPrice.php?tab=approvednotondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
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
                                      <li class=""><a href="createPrice.php?tab=approvedondisplay" title="Display Product Item Online" class="content">On Display(
                                            <?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>
                                        0
                                        <?php }?>
                                        )</a></li>
                                      <li class="current"><a href="createPrice.php?tab=approvednotondisplay" title="Not Display Product Item Online" class="content">Not On Display (
                                            <?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>
                                        0
                                        <?php }?>
                                        )</a></li>
                                    </ul>
                                  </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                          <td>
                                          <span class="content" style="padding-left:5px;">
            Select <input type="checkbox" name="checkbox" value="checkbox" checked disabled>
            to: <input type="submit" name="delete" value="Delete" onClick="return deleteProduct2();" title="Delete selected item(s)">
                                          </span>
                                          </td>
                                          <td align="right">
                                          <?php $qry=mysqli_query($conn, "select * from maincat where status=1 order by position asc"); $main=mysqli_fetch_assoc($qry); ?>
                                          <span class="content" style="padding-right:5px;">
                                            Filter:
                                            <?php 
				$zone_area_query = mysqli_query($conn, "SELECT * FROM zone_area WHERE status=1 order by position asc, maincat_id desc");
                $zone_area = mysqli_fetch_assoc($zone_area_query);

											
											?>
                                            
                                            
                                            <select name="filter" onChange="javascript:jumpMenu('_self',this,0)">
                                              <option value="">-Select package-</option>
                                              <?php do{?>
                                              <option value="<?php printf($currentPage); ?>?main=<?php echo $zone_area['maincat_id']?>&tab=<?php echo $_GET['tab'];?>" <?php if($_GET['main'] == $zone_area['maincat_id']){?>selected <?php }?>><?php echo $zone_area['maincat_name']." : ".$zone_area['area_cover']?></option>
                                              <?php }while($zone_area = mysqli_fetch_assoc($zone_area_query));?>
                                            </select>
                                            </span>
                                          </td>
                                      </tr>
                                  </table>                      
                                  
                                  <table border="0" cellpadding="4" cellspacing="1" width="100%">
                                    <tr>
                                      <th width="3%" class="content">
                                        <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">                          </th>
                                      <th width="10%" class="content">On Display</th>
                                      <th width="25%" class="content">Post Package</th>
                                      <th width="18%" class="content">Zone</th>
                                      <!--<th width="14%" class="content">Cover Area </th> -->
                                      <th width="12%" class="content">Price</th>
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
                                        <input type="checkbox" value="<?php echo $row_Rs1['id']; ?>" name="productIdList[]">
                                        <br />                          </td>
                                      <td width="13%" class="content01" align="center">
                                        <input type="submit" name="<?php echo $row_Rs1['id']; ?>" value="Display" title="Display This Item"/>                          </td>
                                      <td align="left" class="content01">
                               
            <?php          
                $zone_area_query = mysqli_query($conn, "SELECT * FROM zone_area WHERE status=1 order by position asc, maincat_id desc");
                $zone_area = mysqli_fetch_assoc($zone_area_query);
                     
            ?>
            <select name="<?php echo 'zone'.$row_Rs1['id'] ?>" style="width:220px;">
              <option value="">select zone</option>
                                <?php do{?>
                                <option value="<?php echo $zone_area['maincat_id']?>" <?php if($zone_area['maincat_id']==$row_Rs1['zone_id']){?> selected<?php }?>>
                                <?php 
								$limit = 60 - strlen($zone_area['maincat_name']);
								echo $zone_area['maincat_name']." : ".substr($zone_area['area_cover'],0,$limit); if(strlen($zone_area['area_cover'])>$limit) echo "..";?></option>
                                <?php }while($zone_area = mysqli_fetch_assoc($zone_area_query))?>
                          </select>
                                      
                                      
                                      </td>
                                      <!--<td align="center" class="content"><input type="text" name="<?php //echo 'area'.$row_Rs1['id'] ?>" value="<?php //echo $row_Rs1['area_cover'];  ?>" size="14"></td> -->
                                      <td align="center" class="content01"><input name="<?php echo 'volume_from'.$row_Rs1['id']; ?>" type="text" value="<?php echo $row_Rs1['volume_from'];?>" size="5" width="5"></td>
                                      <td align="center" class="content01"><input name="<?php echo 'volume_to'.$row_Rs1['id']; ?>" type="text" value="<?php echo $row_Rs1['volume_to'];?>" size="5" width="5"></td>
                                      <td align="center" class="content01"><input type="text" name="<?php echo 'price'.$row_Rs1['id'] ?>" value="<?php echo $row_Rs1['price'];  ?>" size="4" style="text-align:right"></td>
                                      <td align="center" class="content01"><input name="<?php echo 'position'.$row_Rs1['id']; ?>" type="text" value="<?php echo $row_Rs1['position'];?>" size="3" width="5"></td>
                                      
                                      <td align="center" class="content01"><input type="submit" name="<?php echo 'update'.$row_Rs1['id'];?>" value="Update" ></td>
                                     
                                    </tr>
                                    <?php  $count++;
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
                            </td>
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


function check()
{
	if(form1.zone_id.value=="")
	{
		alert("Please select a zone.");
		form1.zone_id.focus();
		return false;
	}
	if(form1.volume_from.value=="")
	{
		alert("Please enter volume range (from) price.");
		form1.volume_from.focus();
		return false;
	}
	if(form1.volume_to.value=="")
	{
		alert("Please enter volume range (to) price.");
		form1.volume_to.focus();
		return false;
	}
	if(form1.price.value=="")
	{
		alert("Please enter price.");
		form1.price.focus();
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

function jumpMenu(target,selObj,restore){ 
  if (selObj.selectedIndex>0 && selObj.options[selObj.selectedIndex].value != ''){
    window.open(selObj.options[selObj.selectedIndex].value,target);}
  else if(selObj.options[selObj.selectedIndex].value == '')  {selObj.selectedIndex=0;}
  if (restore) selObj.selectedIndex=0;
}
</script>
</body>
</html>