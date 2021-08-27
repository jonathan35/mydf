<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

//*************************************************Edit Category*************************************************
		$temp_query_Recordset = "SELECT * FROM category";					 
		$temp_Recordsetexist = mysqli_query($conn, "SELECT * FROM category") or die(mysqli_error());
		$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
		
		
		
		do
		{
			if($_POST['update'.$row_Rs1['id']]==" Update ")
			{	
			
				$id_data=$row_Rs1['id'];
			
				$insertSQL1 = "UPDATE category SET category_title='".$_POST['category_title'.$row_Rs1['id']]."', position='".$_POST['position'.$row_Rs1['id']]."' WHERE id='".$id_data."'"; 
				mysqli_select_db($conn, $database_conn);
				$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
				$success1='<font color="#336600">Category updated</font>';
			}else
				$success1='<font color="#CC3300">failed to update category</font>';
		} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));	
	
	$category_query=mysqli_query($conn, "SELECT category_title FROM category WHERE status!=-1 ORDER BY category_title");
	$category_set=mysqli_fetch_assoc($category_query);

	$selected_section_query=mysqli_query($conn, "SELECT * FROM category WHERE id='".$_GET['id']."' ");
	$selected_section_set=mysqli_fetch_array($selected_section_query);
	
	
//******************************************Add Category*************************************************
	if($_POST['submit']==' Submit '){
		if(!empty($_GET['id'])){$data['id'] = base64_decode($_GET['id']);}
		$data['category_title'] = $_POST['category_title'];
		$data['seo_title'] = $_POST['seo_title'];
		$data['seo_keyword'] = $_POST['seo_keyword'];
		$data['seo_description'] = $_POST['seo_description'];
		//$data['icon_photo'] = $file;
		$data['sorting_target'] = $_POST['sorting'];
		$data['status'] = '1';
		$data['position'] = '0';
		$data['created'] = date('Y-m-d H:i:s');
		$data['modified'] = date('Y-m-d H:i:s');
		
		if(sql_save('category', $data))
			$success='<font color="#336600">category added</font>';
		else
			$success='<font color="#CC3300">Failed to add category</font>';
	}
	
	$category_query=mysqli_query($conn, "SELECT category_title FROM category WHERE status=1 ORDER BY category_title");
	$category_set=mysqli_fetch_assoc($category_query);



//*************************************************Manage Category*************************************************
	$today=date("Y-m-d");
	
	
	///////////////display//////////////////////////////////////////////////////////////
	$temp_query_Recordset2 = "SELECT * FROM category WHERE status=0";					 
	$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($Rs1);

	do
	{
		if($_POST[$row_Rs1['id']]=="Display")
		{	
			$this_host_product_id=$row_Rs1['id']; 
			$insertSQL1 = "UPDATE category SET 
			status='1' WHERE id='$this_host_product_id'"; 
			//echo $insertSQL1;
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
		}
	} while($row_Rs1 = mysqli_fetch_assoc($Rs1));
	///////////////////////////////////display///////////////////////////////////////////
	
	$temp_query_Recordset1 = "SELECT * FROM category WHERE status=1";					 
	$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset1) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
	
	do
	{
		if($_POST[$row_Rs1['id']]=="Not Display")
		{	
			$this_host_product_id=$row_Rs1['id'];
			$insertSQL1 = "UPDATE category SET 
			status='0' WHERE id='$this_host_product_id'"; 
			
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
		}
	} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));
	
	$temp_query_Recordset2 = "SELECT * FROM category WHERE status=0";					 
	$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($Rs1);
	
	do
	{
		if($_POST[$row_Rs1['id']]=="Display")
		{	
			$this_host_product_id=$row_Rs1['id']; 
			$insertSQL1 = "UPDATE category SET 
			status='1' WHERE id='$this_host_product_id'"; 
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
			$target_query = mysqli_query($conn, "SELECT * FROM category WHERE id='$items_delete'") or die(mysqli_error());
			$target = mysqli_fetch_assoc($target_query);
			
			if(!empty($target)){
				if(!empty($target)){
					@unlink('../../'.$target['photo1']);
				}
				mysqli_query($conn, "UPDATE category SET status='-1' WHERE id='$items_delete'") or die(mysqli_error());			
			}
		}
	}
}

if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="")
{
		$query="SELECT * FROM category WHERE status=1 ORDER BY position ASC, category_title ASC";
}
else if($_GET['tab']=="approvednotondisplay")
{
		$query="SELECT * FROM category WHERE status=0 ORDER BY position ASC, category_title ASC";
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
	
	$query2=mysqli_query($conn, "SELECT * FROM category WHERE status=0");
	$total_testimonial_not_on_display = mysqli_num_rows($query2);
	$query=mysqli_query($conn, "SELECT * FROM category WHERE status=1");
	$total_testimonial_on_display = mysqli_num_rows($query);
	
	$edit='';
	if($_GET['id']){
		$id=base64_decode($_GET['id']);
		$edit=readFirst($conn, "category", "id='".$id."'");
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
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="table-responsive">
         	
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
            <tr>
            	<td colspan="2" class="border_background_no_color">
                	<h3>Create Category</h3> 
					<?php if($_GET['id']){?><a class="btn btn-sm btn-default" href="createCategory.php">Back to listing</a><?php }?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" class="border_background_no_color">
                <table width="100%" align="left">
                <form name="form1" method="post" action="createCategory.php?id=<?php echo $_GET['id']?>" enctype="multipart/form-data">
                    <tr>
                        <td colspan="2" class="main_title"><strong><?php echo $success;?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="red">*Indicate required fields </td>
                    </tr>
                    <tr>
                        <td width="20%" class="main_title"><span class="red">*</span>Add category:&nbsp;</td>
                        <td><input type="text" name="category_title" value="<?php echo $edit['category_title']?>">
                        <span class="red02">Special characters  !@#$%^&*():"'/ are not allowed.</span>
                        </td>
                    </tr>
                <tr>
                    <td class="main_title">Category (SEO):&nbsp;</td>
                    <td><textarea name="seo_title" style="width:550px; height:50px;"><?php echo $edit['seo_title']?></textarea></td>
                </tr>
                <tr>
                    <td class="main_title">Keyword (SEO):&nbsp;</td>
                    <td><textarea name="seo_keyword" style="width:550px; height:50px;"><?php echo $edit['seo_keyword']?></textarea></td>
                </tr>             
                <tr>
                    <td class="main_title">Description (SEO):&nbsp;</td>
                    <td><textarea name="seo_description" style="width:550px; height:50px;"><?php echo $edit['seo_description']?></textarea></td>
                </tr>             
                <!--<tr>
                    <td class="main_title">Sorting/Position :&nbsp;</td>
                    <td>
                    	<select name="sorting">
                        	<option value="on_first">Sort on First</option>
                        	<option value="dont_sort">I sort myself later</option>
                            <?php 
							$cats_query = mysqli_query($conn, "SELECT * FROM category WHERE status ='1' ORDER BY category_title ASC");
							$cats = mysqli_fetch_assoc($cats_query);
							
							do{
							?>
                                <option value="<?php echo $cats['id']?>">Sort before <?php echo $cats['category_title']?></option>
                            <?php }while($cats = mysqli_fetch_assoc($cats_query));?>
                            
                        </select>
                    </td>
                </tr>  -->           
                    
                <!--<tr>
                    <td align="left" class="main_title" colspan="2">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                Info at top:&nbsp;
                                <label>On <input type="radio" name="info_top" value="1" style="vertical-align:middle;"></label>&nbsp;&nbsp;&nbsp;
                                <label>Off <input type="radio" name="info_top" value="0" style="vertical-align:middle;" checked></label><br>
                                <span class="red02">Click 'On' to show this info at the top of category page. Default is 'Off'.</span>
                            </td>
                            <td>
                                Display Sub-category:&nbsp;
                                <label>On <input type="radio" name="display_list" value="1" style="vertical-align:middle;" checked></label>&nbsp;&nbsp;&nbsp;
                                <label>Off <input type="radio" name="display_list" value="0" style="vertical-align:middle;"></label><br>
                                <span class="red02">Click 'On' to show sub-category below the info. Default is 'On'.</span>
                            </td>
                        </tr>
                    </table>
                    </td>
                </tr>                   
                <tr>
                    <td colspan="2"><textarea name="description_top" class="mceEditor" style="width:100%; height:290px;"></textarea></td>
                </tr> 
                <tr>
                    <td align="left" class="main_title" colspan="2">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                Info at below:&nbsp;
                                <label>On <input type="radio" name="info_below" value="1" style="vertical-align:middle;"></label>&nbsp;&nbsp;&nbsp;
                                <label>Off <input type="radio" name="info_below" value="0" style="vertical-align:middle;" checked></label><br>
                                <span class="red02">Click 'On' to show this info at the below of category page. Default is 'Off'.</span>
                            </td>
                        </tr>
                    </table>
                    </td>
                </tr>                      
                <tr>
                    <td colspan="2"><textarea name="description_below" class="mceEditor" style="width:100%; height:290px;"></textarea></td>
                </tr> -->             
                <tr>
                    <td align="center" colspan="2"><input type="submit" name="submit" value=" Submit " onClick="return check();"></td>
                </tr>
                </form>
                </table></td>
            </tr>
            <tr>
                <td style="background-color:#FFF">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="border_background_no_color"><h3>Manage Category</h3></td>
                    </tr>
                    <tr>
                        <td height="288" align="left" valign="top"><table width="100%" align="left" cellpadding="0"  cellspacing="0">
                    <tr>
                        <td width="636" height="244" align="left" valign="top"><div align="left">
                        <?php if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="") { ?>
                        <!--On Display-->
                        <form name="form2" method="post" action="createCategory.php?tab=approvedondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
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
                                <li class="current"><a href="createCategory.php?tab=approvedondisplay" title="Display Product Item Online" class="content">
                                    On Display (<?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>0<?php }?>)</a></li>
                                <li class=""><a href="createCategory.php?tab=approvednotondisplay" title="Not Display Product Item Online" class="content">
                                    Not On Display (<?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>0<?php }?>)</a></li>
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
                                <th width="12%" class="content">Not on Display</th>
                                <th width="33%" class="content" style="text-align:left">Category </th>
                                <th width="16%" class="content" align="center">Position No. </th>
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
                                        <input type="submit" name="<?php echo $row_Rs1['id']; ?>" value="Not Display" 
                                            title="Not Display This Product At Your Online List"/>
                                    </td>
                                    <td width="32%" class="content01" align="left">
                                        <input type="text" name="<?php echo 'category_title'.$row_Rs1['id'];?>" value="<?php echo $row_Rs1['category_title']; ?>"
                                             style="width:350px;">
                                    </td>
                                
                                    <td align="center" class="content01">
                                        <input name="<?php echo 'position'.$row_Rs1['id']?>" type="text" value="<?php echo $row_Rs1['position'];?>" 
                                            style="width:35px;">
                                    </td>
                                    <td align="center" class="content01">
                                        <input type="submit" name="<?php echo 'update'.$row_Rs1['id'];?>" value=" Update " onClick="return"><br><br>
                                    </td>
                                    <td align="center">
                                        <a href="createCategory.php?id=<?php echo base64_encode($row_Rs1['id'])?>">
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
                                <!--On Display End-->
                                <?php } else if($_GET['tab']=="approvednotondisplay") { ?>
                                <!--Not On Display-->
                                </span>
                                <form name="ProductListForm2" method="post" 
                                    action="createCategory.php?tab=approvednotondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
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
                                        <li class=""><a href="createCategory.php?tab=approvedondisplay" title="Display Product Item Online" class="content">
                                            On Display(<?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>0<?php }?>)</a></li>
                                        <li class="current"><a href="createCategory.php?tab=approvednotondisplay" title="Not Display Product Item Online" 
                                            class="content">
                                            Not On Display (<?php if ($total_testimonial_not_on_display!=0){echo $total_testimonial_not_on_display;}else{?>0<?php }?> )</a>
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
                                    <th width="4%" class="content">
                                        <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">
                                    </th>
                                    <th width="14%" class="content">On Display</th>
                                    <th width="32%" class="content">Category </th>
                                    <th width="16%" class="content" align="center">Position No. </th>
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
                                    <td width="4%" class="content">
                                        <input type="checkbox" value="<?php echo $row_Rs1['id']; ?>" name="productIdList[]">                          
                                    </td>
                                    <td width="14%" class="content01" align="center">
                                        <input type="submit" name="<?php echo $row_Rs1['id']; ?>" value="Display" title="Display This Product At Your Online List"/>
                                    </td>
                                    <td align="left" class="content01">
                                        <input type="text" name="<?php echo 'category_title'.$row_Rs1['id'];?>" value="<?php echo $row_Rs1['category_title']; ?>" 
                                            style="width:350px;"><br>
                                    </td>
                                    <td align="center" class="content01">
                                        <input name="<?php echo 'position'.$row_Rs1['id']?>" type="text" value="<?php echo $row_Rs1['position'];?>" 
                                            style="width:35px;" width="5">
                                    </td>
                                    <td align="center" class="content01" >
                                        <input type="submit" name="<?php echo 'update'.$row_Rs1['id'];?>" value=" Update " onClick="return">&nbsp;
                                    </td>
                                    <td class="content" align="center">
                                        <a href="createCategory.php?id=<?php echo base64_encode($row_Rs1['id'])?>">
                                        <img src="../images/b_edit.png" width="16" height="15" border="0"></a>
                                    </td>
                                </tr>
                                <?php  $count++;
                                    } while($row_Rs1 = mysqli_fetch_assoc($Rs1));
                                }else{ ?>
                                <tr>
                                    <td width="4%"></td>
                                    <td colspan="6" class="content">No Record Found.</td>
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
	if(form1.category_title.value=="")
	{
		alert("Please enter category.");
		form1.category_title.focus();
		return false;
	}
	if(form1.photo.value==""){
		alert("Please enter browse an image for category.");
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