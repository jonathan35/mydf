<?php 
require_once '../../config/ini.php'; 
require_once '../../config/image.php';

session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}
	
//*************************************************Edit News*************************************************
		$temp_query_Recordset = "SELECT * FROM news";					 
		$temp_Recordsetexist = mysqli_query($conn, "SELECT * FROM news") or die(mysqli_error());
		$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
		
		do
		{
			if($_POST['update'.$row_Rs1['id']]==" Update ")
			{	
			
				$id_data=$row_Rs1['id'];
			
				$insertSQL1 = "UPDATE news SET title='".$_POST['title'.$row_Rs1['id']]."', position='".$_POST['position'.$row_Rs1['id']]."' WHERE id='".$id_data."'"; 
				mysqli_select_db($conn, $database_conn);
				$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
				$success1='<font color="#336600">News updated</font>';
			}else
				$success1='<font color="#CC3300">failed to update news</font>';
		} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));	
	
	$news_query=mysqli_query($conn, "SELECT title FROM news WHERE status!=-1 ORDER BY title");
	$news_set=mysqli_fetch_assoc($news_query);

	$selected_section_query=mysqli_query($conn, "SELECT * FROM news WHERE id='".$_GET['id']."' ");
	$selected_section_set=mysqli_fetch_array($selected_section_query);
	
//******************************************Add News*************************************************
	if($_POST['submit']==' Submit '){
		if(!empty($_POST['id']))$data['id'] = $_POST['id']; 
		$data['title'] = $_POST['title'];
		$data['case_id'] = $_POST['case_id'];
		$data['description'] = $_POST['description'];
		$data['source'] = $_POST['source'];
		$data['source_link'] = $_POST['source_link'];
		$data['status'] = '1';
		$data['posting_date'] = date("Y-m-d", strtotime(substr($_POST['posting_date'],3,2).'/'.substr($_POST['posting_date'],0,2).'/'.substr($_POST['posting_date'],6,4)));
		$data['end_date'] = date("Y-m-d", strtotime(substr($_POST['end_date'],3,2).'/'.substr($_POST['end_date'],0,2).'/'.substr($_POST['end_date'],6,4)));
		$data['created'] = date('Y-m-d H:i:s');
		$data['modified'] = date('Y-m-d H:i:s');

		if(sql_save('news', $data)){
			$j = readFirst($conn, 'news', "", 'id DESC');	
			$id = $j['id'];
			$img->upload_image($_FILES['photo'], 'news', 'photo', $id);
			$success='<font color="#336600">News saved</font>';
		}else{
			$success='<font color="#CC3300">Failed to add news</font>';
		}
	}
	//$news_query=mysqli_query($conn, "SELECT title FROM news WHERE status=1 ORDER BY title");
	//$news_set=mysqli_fetch_assoc($news_query);
//*************************************************Manage News*************************************************
	$today=date("Y-m-d");
	
	
	///////////////display//////////////////////////////////////////////////////////////
	$temp_query_Recordset2 = "SELECT * FROM news WHERE status=0";					 
	$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($Rs1);

	do
	{
		if($_POST[$row_Rs1['id']]=="Display")
		{	
			$this_host_product_id=$row_Rs1['id']; 
			$insertSQL1 = "UPDATE news SET 
			status='1' WHERE id='$this_host_product_id'"; 
			//echo $insertSQL1;
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
		}
	} while($row_Rs1 = mysqli_fetch_assoc($Rs1));
	///////////////////////////////////display///////////////////////////////////////////
	
	$temp_query_Recordset1 = "SELECT * FROM news WHERE status=1";					 
	$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset1) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
	
	do
	{
		if($_POST[$row_Rs1['id']]=="Not Display")
		{	
			$this_host_product_id=$row_Rs1['id'];
			$insertSQL1 = "UPDATE news SET 
			status='0' WHERE id='$this_host_product_id'"; 
			
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
		}
	} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));
	
	$temp_query_Recordset2 = "SELECT * FROM news WHERE status=0";					 
	$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($Rs1);
	
	do
	{
		if($_POST[$row_Rs1['id']]=="Display")
		{	
			$this_host_product_id=$row_Rs1['id']; 
			$insertSQL1 = "UPDATE news SET 
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
			$target_query = mysqli_query($conn, "SELECT * FROM news WHERE id='$items_delete'") or die(mysqli_error());
			$target = mysqli_fetch_assoc($target_query);
			
			if(!empty($target)){
				if(!empty($target)){
					@unlink('../../'.$target['photo']);
				}
				mysqli_query($conn, "UPDATE news SET status='-1' WHERE id='$items_delete'") or die(mysqli_error());			
			}
		}
	}
}

if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="")
{
		$query="SELECT * FROM news WHERE status=1 ORDER BY position ASC, title ASC";
}
else if($_GET['tab']=="approvednotondisplay")
{
		$query="SELECT * FROM news WHERE status=0 ORDER BY position ASC, title ASC";
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
	
	$query2=mysqli_query($conn, "SELECT * FROM news WHERE status=0");
	$total_testimonial_not_on_display = mysqli_num_rows($query2);
	$query=mysqli_query($conn, "SELECT * FROM news WHERE status=1");
	$total_testimonial_on_display = mysqli_num_rows($query);
	
if(!empty($_GET['id']))	{
	
	$id = base64_decode($_GET['id']);
	$news = readFirst($conn, "news", "id='".$id."'");
	
	if(!empty($news['case_id']))	{
		$case = readFirst($conn, "cases", "id='".$news['case_id']."'");
	}
}
	
	
	
	
?>


<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">

<script src="../css/jquery.js"></script>


<style>
input[type=text] {width:250px;}
textarea {width:500px;height:100px;}
#case_result { position:absolute; border: 1px solid #999; box-shadow:1px 1px 1px #999; background-color:white;}
.ky_option { display: block; border-bottom: 1px solid #999; text-align: left;  border-left:1px solid #999; background-color:#DFDFDF; z-index:2;
padding:2px 6px; cursor: pointer; width:350px; height:55px; overflow:hidden; display:inline-block;}
.case_thum { display:inline-block; background-size:contain; width:50px; height:50px; border-radius:50%; border:2px solid #999; }
.case_name {display:inline-block; width:280px; left:50px;}
.case_name, .case_name, .case_name { overflow:hidden; vertical-align:top;}
</style>
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
            	<td colspan="2" class="border_background_no_color"><h3><?php if(!empty($case['id'])){?>Edit<?php }else{?>Create<?php }?> News</h3></td>
            </tr>
            <?php if(!empty($case['id'])){?>
            <div class="col-12" style="text-align:right;"><a class="btn btn-sm btn-success" href="createNews.php">Add News</a></div>
            <?php }?>
            <tr>
                <td align="left" valign="top" class="border_background_no_color">
                <table width="100%" align="left">
                <form name="form1" method="post" enctype="multipart/form-data">
                	<input type="hidden" name="id" value="<?php echo $news['id']?>">
                    <tr>
                        <td colspan="2" class="main_title"><strong><?php echo $success;?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="red">*Indicate required fields </td>
                    </tr>
                    <tr>
                        <td width="20%" class="main_title"><span class="red">*</span>News Title:&nbsp;</td>
                        <td><input type="text" name="title" value="<?php echo $news['title']?>" required>
                        <span class="red02">Special characters  !@#$%^&*():"'/ are not allowed.</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="main_title"><span class="red">*</span>News Photo:&nbsp;</td>
                        <td>
                        	<?php if(!empty($news['photo'])){?>
                            	<span id="ph">
                                    <img src="<?php echo '../../'.$news['photo']?>" style="max-width:400px; max-height:250px;">
                                    <div class="btn btn-sm" onClick="removeImg('news', '<?php echo $news['id']?>', 'photo', '#ph')">
                                        <span class="glyphicon glyphicon-remove" style="color:red; cursor:pointer;"></span>Remove
                                    </div>
								</span>
							<?php }?>
                        	<input type="file" name="photo" value="<?php echo $news['photo']?>" <?php if(empty($news['id'])){?>required <?php }?>>
							<span class="red02">Recommended size:400 x 250 pixel.</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="main_title"><span class="red">*</span>Posting date:&nbsp;</td>
                        <td><input type="text" name="posting_date" class="datepicker" value="<?php echo $news['posting_date']?>" required></td>
                    </tr>
                    <tr>
                        <td class="main_title"><span class="red">*</span>Date end:&nbsp;</td>
                        <td><input type="text" name="end_date" class="datepicker" value="<?php echo $news['end_date']?>" required>
                        <span class="red02">Show as current news before date end, show as pass news when date end.</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="main_title"><span class="red">*</span>Case for news:&nbsp;</td>
                        <td>
                        	<input type="text" name="case_picker" id="case_picker" placeholder="Enter case title to search" value="<?php echo $case['title']?>" autocomplete="off">
	                        <div id="case_result"></div>                      	
							<input type="hidden" name="case_id" id="case_id" value="<?php echo $news['case_id']?>">
                        </td>
                    </tr>
                <tr>
                    <td class="main_title"><span class="red">*</span>Description:&nbsp;</td>
                    <td><textarea name="description" required><?php echo $news['description']?></textarea></td>
                </tr>
                <tr>
                    <td class="main_title"><span class="red">*</span>Source:&nbsp;</td>
                    <td><input type="text" name="source" value="<?php echo $news['source']?>" required></td>
                </tr>           
                <tr>
                    <td class="main_title">Source link:&nbsp;</td>
                    <td><input type="text" name="source_link" value="<?php echo $news['source_link']?>" placeholder="http://source.com"></td>
                </tr>   
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
                        <td class="border_background_no_color"><h3>Manage News</h3></td>
                    </tr>
                    <tr>
                        <td height="288" align="left" valign="top"><table width="100%" align="left" cellpadding="0"  cellspacing="0">
                    <tr>
                        <td width="636" height="244" align="left" valign="top"><div align="left">
                        <?php if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="") { ?>
                        <!--On Display-->
                        <form name="form2" method="post" action="createNews.php?tab=approvedondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
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
                                <li class="current"><a href="createNews.php?tab=approvedondisplay" title="Display Product Item Online" class="content">
                                    On Display (<?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>0<?php }?>)</a></li>
                                <li class=""><a href="createNews.php?tab=approvednotondisplay" title="Not Display Product Item Online" class="content">
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
                                <th width="4%" class="content">
                                    <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">
                                </th>
                                <th width="9%" class="content">Not on Display</th>
                                <th width="20%" class="content" style="text-align:left">News </th>
                                <th width="20%" class="content" style="text-align:left">Title </th>
                                <th width="20%" class="content" style="text-align:left">Case </th>
                                <th width="8%" class="content" align="center">Position No. </th>
                                <th width="8%" class="content" align="center">Update</th>
                                <th width="7%" class="content" align="center">Edit</th>
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
                                    <td class="content"><input type="checkbox" value="<?php echo $row_Rs1['id']; ?>" name="productIdList[]"><br /></td>
                                    <!--onClick="return displayProduct();"-->
                                    <td align="center" class="content01">
                                        <input type="submit" name="<?php echo $row_Rs1['id']; ?>" value="Not Display" 
                                            title="Not Display This Product At Your Online List"/>
                                    </td>
                                    <td class="content01" align="left">
                                    	<?php if(!empty($row_Rs1['photo'])){?><img src="<?php echo '../../'.$row_Rs1['photo']?>" class="img-responsive" style="max-height:100px;"><?php }?>
                                    </td>
                                    <td>
                                        <input type="text" name="<?php echo 'title'.$row_Rs1['id'];?>" value="<?php echo $row_Rs1['title']; ?>"
                                             style="width:200px;">
                                    </td>
                                    <td>
                                    
                                    <?php $case = readFirst($conn, 'cases', " id = '". $row_Rs1['case_id']."' " );
									if(!empty($case)){
									?>
                                    <?php if(!empty($case['photo01'])){?> <div class="case_thum" style=" background-image:url(../../<?php echo $case['photo01'];?>);"></div><?php }?>
                                    <div style="display:inline-block; vertical-align:top; width:auto; padding-top:3px;"><?php echo $case['title'];?></div>
                                    <?php }?>
                                    
                                    </td>
                                
                                    <td align="center" class="content01">
                                        <input name="<?php echo 'position'.$row_Rs1['id']?>" type="text" value="<?php echo $row_Rs1['position'];?>" 
                                            style="width:35px;">
                                    </td>
                                    <td align="center" class="content01">
                                        <input type="submit" name="<?php echo 'update'.$row_Rs1['id'];?>" value=" Update " onClick="return"><br><br>
                                    </td>
                                    <td align="center">
                                        <a href="createNews.php?id=<?php echo base64_encode($row_Rs1['id'])?>">
                                        <img src="../images/b_edit.png" width="16" height="15" border="0"></a>&nbsp;
                                    </td>
                                
                                </tr>
                                <?php  	$count++;
                                    }while($row_Rs1 = mysqli_fetch_assoc($Rs1));
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
                                <span class="content">
                                <!--On Display End-->
                                <?php } else if($_GET['tab']=="approvednotondisplay") { ?>
                                <!--Not On Display-->
                                </span>
                                <form name="ProductListForm2" method="post" 
                                    action="createNews.php?tab=approvednotondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
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
                                        <li class=""><a href="createNews.php?tab=approvedondisplay" title="Display Product Item Online" class="content">
                                            On Display(<?php if ($total_testimonial_on_display!=0){ echo $total_testimonial_on_display;}else{?>0<?php }?>)</a></li>
                                        <li class="current"><a href="createNews.php?tab=approvednotondisplay" title="Not Display Product Item Online" 
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
                                <th width="9%" class="content">Not on Display</th>
                                <th width="23%" class="content" style="text-align:left">News </th>
                                <th width="37%" class="content" style="text-align:left">Case </th>
                                <th width="12%" class="content" align="center">Position No. </th>
                                <th width="8%" class="content" align="center">Update</th>
                                <th width="7%" class="content" align="center">Edit</th>
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
                                    <td class="content"><input type="checkbox" value="<?php echo $row_Rs1['id']; ?>" name="productIdList[]"><br /></td>
                                    <td align="center" class="content01">
                                        <input type="submit" name="<?php echo $row_Rs1['id']; ?>" value="Display" 
                                            title="Display This Product At Your Online List"/>
                                    </td>
                                    <td class="content01" align="left">
                                    	<?php if(!empty($row_Rs1['photo'])){?><img src="<?php echo '../../'.$row_Rs1['photo']?>" class="img-responsive" style="max-height:100px;"><?php }?>
                                    </td>
                                    <td>
                                        <input type="text" name="<?php echo 'title'.$row_Rs1['id'];?>" value="<?php echo $row_Rs1['title']; ?>"
                                             style="width:200px;">
                                    </td>
                                    <td>
                                    
                                    <?php $case = readFirst($conn, 'cases', " id = '". $row_Rs1['case_id']."' " );
									if(!empty($case)){
									?>
                                    <?php if(!empty($case['photo01'])){?> <div class="case_thum" style=" background-image:url(../../<?php echo $case['photo01'];?>);"></div><?php }?>
                                    <div style="display:inline-block; vertical-align:top; width:auto; padding-top:3px;"><?php echo $case['title'];?></div>
                                    <?php }?>
                                    
                                    </td>
                                
                                    <td align="center" class="content01">
                                        <input name="<?php echo 'position'.$row_Rs1['id']?>" type="text" value="<?php echo $row_Rs1['position'];?>" 
                                            style="width:35px;">
                                    </td>
                                    <td align="center" class="content01">
                                        <input type="submit" name="<?php echo 'update'.$row_Rs1['id'];?>" value=" Update " onClick="return"><br><br>
                                    </td>
                                    <td align="center">
                                        <a href="createNews.php?id=<?php echo base64_encode($row_Rs1['id'])?>">
                                        <img src="../images/b_edit.png" width="16" height="15" border="0"></a>&nbsp;
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

<!--For date picker use - start -->
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/style.css">
<script src="<?php echo ROOT?>js/datepicker/jquery-1.12.4.js"></script>
<script src="<?php echo ROOT?>js/datepicker/jquery-ui.js"></script>
<script>
$( function() {
    $( ".datepicker" ).datepicker({ /*minDate: +7, maxDate: "+6M +1D"*/ dateFormat: 'dd/mm/yy' });
} );
</script>
<!--For date picker use - end -->


<script>
			
$( "#case_picker" ).keyup(function( event ) {
	
	$("#case_result").html('');	
	
	var keyword = $("#case_picker").val();
	
	$.post( "/rohi.sg/cms/case/case_list.php", {keyword:keyword, }, function( result ) {
		var cont = $("#case_result").html();
		if(cont == ''){
			$("#case_result").html(result);
		}
		//$("#case_result").replaceWith('<div id="case_result">'+result+'</div>');
	});	
});			

function choose_case(id){
	$("#case_id").val(id);
	var title = $("#case_"+id).attr('name');
	$("#case_picker").val(title);	
	$("#case_result").html('');	
}
						
function check(){
	if(form1.case_id.value=="")
	{
		alert("Please enter correct case title");
		form1.case_picker.focus();
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