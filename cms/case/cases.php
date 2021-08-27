<?php 
require_once '../../config/ini.php'; 
require_once('../../config/str_convert.php');
require_once('../../config/cronjob_cases.php');

session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}


	$temp_query_Recordset1 = "SELECT * FROM cases WHERE status='enable' OR status=''";					 
	$temp_Recordsetexist = mysqli_query($conn, $temp_query_Recordset1) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist);
	
	do
	{
		if($_POST[$row_Rs1['id']]=="Disable")
		{	
			$this_host_product_id=$row_Rs1['id'];
			$insertSQL1 = "UPDATE cases SET status='disable' WHERE id='$this_host_product_id'"; 
			
			mysqli_select_db($conn, $database_conn);
			$Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());
		}
	} while($row_Rs1 = mysqli_fetch_assoc($temp_Recordsetexist));
	
	$temp_query_Recordset2 = "SELECT * FROM cases WHERE status='disable'";					 
	$Rs1 = mysqli_query($conn, $temp_query_Recordset2) or die(mysqli_error());
	$row_Rs1 = mysqli_fetch_assoc($Rs1);
	
	do
	{
		if($_POST[$row_Rs1['id']]=="Enable")
		{	
			$this_host_product_id=$row_Rs1['id']; 
			$insertSQL1 = "UPDATE cases SET status='enable' OR status='' WHERE id='$this_host_product_id'"; 
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
			$target_query = mysqli_query($conn, "SELECT * FROM cases WHERE id='$items_delete'") or die(mysqli_error());
			$target = mysqli_fetch_assoc($target_query);
			
			if(!empty($target)){
				if(!empty($target['photo01'])) @unlink('../../'.$target['photo01']);
				if(!empty($target['photo02'])) @unlink('../../'.$target['photo02']);
				if(!empty($target['photo03'])) @unlink('../../'.$target['photo03']);
				if(!empty($target['photo04'])) @unlink('../../'.$target['photo04']);
				if(!empty($target['photo05'])) @unlink('../../'.$target['photo05']);
				if(!empty($target['photo06'])) @unlink('../../'.$target['photo06']);
				if(!empty($target['photo07'])) @unlink('../../'.$target['photo07']);
				if(!empty($target['photo08'])) @unlink('../../'.$target['photo08']);
				if(!empty($target['photo09'])) @unlink('../../'.$target['photo09']);
				if(!empty($target['photo10'])) @unlink('../../'.$target['photo10']);
				if(!empty($target['embed_video'])) @unlink('../../'.$target['embed_video']);
				
				mysqli_query($conn, "DELETE FROM cases WHERE id='$items_delete'") or die(mysqli_error());			
			}
		}
	}
}

if($_POST['featured']=="Set as featured")
{	
	$items_array=$_POST['productIdList'];
	
	if(!empty($_POST['productIdList']))
	{
		foreach((array)$items_array as $items_delete)
		{
			$data['id'] = $items_delete;
			$data['featured'] = 'true';
			sql_save('cases', $data);
		}
	}
}
if($_POST['featured']=="Remove featured")
{	
	$items_array=$_POST['productIdList'];
	
	if(!empty($_POST['productIdList']))
	{
		foreach((array)$items_array as $items_delete)
		{
			$data['id'] = $items_delete;
			$data['featured'] = '0';
			sql_save('cases', $data);
		}
	}
}


$cond = "id !=''";
$order = "ORDER BY id DESC limit 50";

if(!empty($_POST['submit'])){
	if($_POST['submit'] == 'Search'){
		//$_SESSION['year'] = date("Y");
		$query_month = '__';
		$cond = " id != '' ";
		$_SESSION['year'] = $_POST['year'];
		$_SESSION['month'] = $_POST['month'];
		$_SESSION['keyword'] = $_POST['keyword'];
		$_SESSION['verification'] = $_POST['verification'];
		$_SESSION['end_date'] = $_POST['end_date'];
		
		
		if(!empty($_SESSION['month'])){
			$query_month = $_SESSION['month'];	
		}
		
		
		if(!empty($_SESSION['year'])){
			$cond .= " AND created LIKE '".$_SESSION['year']."-".$query_month."-__%'";
		}
		if(!empty($_SESSION['keyword'])){
			//$cond .= " AND (title LIKE '% ".$_SESSION['keyword']." %' OR title LIKE '".$_SESSION['keyword']."%' OR title LIKE '%".$_SESSION['keyword']."'
			//OR description LIKE '% ".$_SESSION['keyword']." %' OR description LIKE '".$_SESSION['keyword']."%' OR description LIKE '%".$_SESSION['keyword']."')";
			
			
			$keywords = explode(' ',$_SESSION['keyword']);
			$cond .= " AND (";
			
			if($_POST['exact']=='true'){
				$cond .= " 
							title REGEXP '[[:<:]]".$_SESSION['keyword']."[[:>:]]' OR 
							description REGEXP '[[:>:]]".$_SESSION['keyword']."[[:>:]]' OR 
							fundraising_for REGEXP '[[:>:]]".$_SESSION['keyword']."[[:>:]]' ";
			}else{
				if(count($keywords)>0){
					$c=1;
					foreach((array)$keywords as $k){
						if($c!=1) $cond .= " OR ";
						$cond .= " title REGEXP '[[:<:]]".$k."[[:>:]]' OR 
						description REGEXP '[[:<:]]".$k."[[:>:]]' OR 
						fundraising_for REGEXP '[[:<:]]".$k."[[:>:]]' ";
						$c++;
					}
				}
			}
			$cond .=")";
		}
		
		
		
		if(!empty($_SESSION['verification'])){
			$cond .= " AND (verification = '".$_SESSION['verification']."' OR verification = '')";
		}
		if(!empty($_SESSION['end_date'])){
			if($_SESSION['end_date'] == 'current'){
				$cond .= " AND (actual < target AND end_date > '".date("Y-m-d")."' ) ";
			}elseif($_SESSION['end_date'] == 'pass'){
				$cond .= " AND (actual > target OR end_date <= '".date("Y-m-d")."' ) ";
			}
		}
	}elseif($_POST['submit'] == 'Reset'){
		$_SESSION['year'] = date("Y");
		$_SESSION['month'] = '';
		$_SESSION['keyword'] = '';
		$_SESSION['verification'] = '';
		$_SESSION['end_date'] = '';
	}
	
	$order = "ORDER BY id DESC";
	
}


$query="SELECT * FROM cases WHERE $cond $order ";//status='enable' OR status='' 
//echo '<pre style="margin-left:20%;">';echo $query.'</pre>';
$Rs1 = mysqli_query($conn, $query);
$row_Rs1 = mysqli_fetch_assoc($Rs1);

?>


<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
<link href="../../css/bootstrap-icon.css" rel="stylesheet">

<script src="<?php echo ROOT?>js/jquery.min.js" type="text/javascript"></script>


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
        	<style>
			.white {color:white;}
			.search input[type=submit] {padding:4px 15px 3px 15px;}
			</style>
			<div style="vertical-align:top;">
                <div class="search" style="background-color:#354D66; padding:5px 15px; vertical-align:top;">
                <span style="font-size:20px;" class="white">Filter&nbsp;&nbsp;&nbsp;&nbsp;</span>
            	<form action="" method="post" enctype="multipart/form-data" style=" vertical-align:top;">
                    <?php 
					if(!empty($_SESSION['keyword'])){
						$keyword = $_SESSION['keyword'];
					}
                    
                    ?>
                    <input name="keyword" value="<?php echo $keyword?>" placeholder="Keyword of Case title or description" style="width:200px;">
                    <select name="verification">
                    	<option value="">Verified & Unverified</option>
                    	<option value="verified" <?php if($_SESSION['verification'] == 'verified'){?> selected<?php }?>>VERIFIED</option>
                    	<option value="unverified" <?php if($_SESSION['verification'] == 'unverified'){?> selected<?php }?>>PENDING</option>
                    </select>
                    <select name="end_date">
                    	<option value="">Current & Pass</option>
                    	<option value="current" <?php if($_SESSION['end_date'] == 'current'){?> selected<?php }?>>Current</option>
                    	<option value="pass" <?php if($_SESSION['end_date'] == 'pass'){?> selected<?php }?>>Pass</option>
                    </select>
                    
                    <?php 
					$selected_year = date("Y");
					if(!empty($_SESSION['year'])){
						$selected_year = $_SESSION['year'];
					}
					?>
                    <span class="white">&nbsp;&nbsp;&nbsp;&nbsp;Created on</span>
                    <select name="year">
                    	<option value="1970" <?php if($y == '1970'){?> selected<?php }?>>1970</option>
                    	<?php for($y=2000; $y<=date("Y"); $y++){?>
                    	<option value="<?php echo $y?>" <?php if($y == $selected_year){?> selected<?php }?>><?php echo $y?></option>
                        <?php }?>
                    </select>
                    
                    <?php 
					$selected_month = '';
					if(!empty($_SESSION['month'])){
						$selected_month = $_SESSION['month'];
					}
					?>
                    
                    <select name="month">
                    	<option value="">All Month</option>
                    
                    	<?php for($m=1; $m<=12; $m++){
							$mon = sprintf("%02d", $m);
							$mon_name = date('M', mktime(0, 0, 0, $m, 10));
							?>
                    	<option value="<?php echo $mon;?>" <?php if($mon == $selected_month){?> selected<?php }?>><?php echo $mon_name?></option>
                        <?php }?>
                    </select>
                    
                    <input type="submit" name="submit" value="Search">
                    <input type="submit" name="submit" value="Reset">
                    <label style="color:white;">
                        <input type="checkbox" name="exact" value="true" <?php if($_REQUEST['exact']=='true'){?>checked <?php }?>> 
                        Search by exact keyword
                    </label>
                    
                    
                </form>
            	</div>
            </div>        
          <div class="table-responsive">

          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
            <tr>
                <td style="background-color:#FFF">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="border_background_no_color">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0;">
                        <h3>Cases <?php if(!empty($_SESSION['year'])){ echo ' on '.$_SESSION['year']; }?> 
						<?php if($_SESSION['month']){ $mon_name = date('M', mktime(0, 0, 0, $_SESSION['month'], 10));echo $mon_name; } ?>
                        </h3>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align:right;">
                        	<a href="add_case.php"><button class="btn btn-success">Add case</button></a>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td height="288" align="left" valign="top"><table width="100%" align="left" cellpadding="0"  cellspacing="0">
                    <tr>
                        <td width="636" height="244" align="left" valign="top"><div align="left">
                        <?php if($_GET['tab']=="approvedondisplay"||$_GET['tab']=="") { ?>
                        <!--On Enable-->
                        <form name="form2" method="post" action="cases.php?tab=approvedondisplay&pageNum_Rs1=<?php echo $_GET['pageNum_Rs1']?>">
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
                        <div class="function"> 
                            <span class="content">
                                Select <input type="checkbox" name="checkbox" value="checkbox" checked disabled>
                                to: <input type="submit" name="delete" value="Delete" onClick="return deleteProduct1();" title="Delete selected item(s)">
                                
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    to: <button type="submit" name="featured" value="Set as featured" title="Set selected item(s) as featured cases"><span class="glyphicon glyphicon-tags" style="padding-right:5px; top:2px; color:green;"></span> Set as featured</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    to: <button type="submit" name="featured" value="Remove featured" title="Remove selected item(s) from featured cases"><span class="glyphicon glyphicon-tags" style="padding-right:5px; top:2px; color:red;"></span> Remove featured</button>
                                
                            </span>
                        </div>
                        <table border="0" cellpadding="4" cellspacing="1" width="100%">
                            <tr align="center">
                                <th width="5%" class="content">
                                    <input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)">


                                </th>
                                <th width="70%" class="content" style="text-align:left">Cases </th>
                                <th width="15%" class="content" align="center">Verification</th>
                                <th width="10%" class="content" align="center">Edit</th>
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
                                    <td class="content01" align="left">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="height:100px;  width:140px;
                                        background-image:url('<?php echo '../../'.$row_Rs1['photo01']?>'); 
                                        background-size:contain; background-repeat:no-repeat; background-position:center center;"></div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                        	<div style="margin:5px 0; color:black; font-size:16px;">
											<a href="<?php echo ROOT?>case/details/<?php echo $str_convert->to_url($row_Rs1['title'])?>" target="_blank"><?php echo $row_Rs1['title'];?></a>
                                            </div>
                                        	<div style="margin:2px 0;">
                                                <div>
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                    <strong>Created on: </strong>
                                                    <?php if($row_Rs1['created'] != '0000-00-00'){ echo date("M d, Y", strtotime($row_Rs1['created']));}else{ echo 'undefined';}?>
                                                </div>
                                            	<div>
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                    <strong>End date: </strong>
                                                    <?php if($row_Rs1['end_date'] != '0000-00-00'){ echo date("M d, Y", strtotime($row_Rs1['end_date']));}else{ echo 'undefined';}?>
												</div>
                                                
                                            </div>
                                            <?php 
											$who = readFirst($conn, 'accounts', " id='".$row_Rs1['creator_id']."' ");
											if(!empty($who)){?>
                                            <div>
                                                <span class="glyphicon glyphicon-user"></span>
                                                <strong>Creator: </strong>
                                                <?php echo $who['first_name'].' '.$who['last_name'];?> (<?php echo $who['email']?>)
                                            </div>
                                            <?php }?>
                                            <?php if($row_Rs1['featured'] == 'true'){?>
												<span class="glyphicon glyphicon-tags" style="color:green"></span> Featured case
                                            <?php }?>
                                            
                                            
                                            
                                        
                                        </div>
                                    	
                                       
                                    </td>
                                    <td align="center">
                                        <div id="verification<?php echo $row_Rs1['id']?>">
                                            <?php if($time!='pass'){
                                                if($row_Rs1['verification'] == 'verified'){
                                                    $color = '#068A7A';
                                                    $verification_label = 'VERIFIED';
                                                    $verification_brief = 'VERIFIED means that CADPIS case workers have contacted and verified that the cases are valid.';
                                                }else{
                                                    $color = '#CA6060';
                                                    $verification_label = 'PENDING';
                                                    $verification_brief = 'PENDING means that CADPIS case workers are still in the process of verifying the cases.';
                                                }
                                                ?>
                                                <span style="font-size:14px; margin:5px 0 5px 0; cursor:default; color:<?php echo $color?>;" title="Note: CADPIS ensures that there is donor accountability. <?php echo $verification_brief?> "><?php echo $verification_label?></span>
                                            <?php }?>
                                        </div>
                                    	<style>
										.cus { margin-top:5px; width:60px;}
                                        </style>
                                        <a onClick="verify('<?php echo ($row_Rs1['id'])?>')" class="btn btn-xs btn-default cus" >Verify</a>
                                        <a onClick="pending('<?php echo ($row_Rs1['id'])?>')" class="btn btn-xs btn-default cus" >Unverify</a>
                                        
										<?php 
                                        if($row_Rs1['payment_status'] == 'CADPIS'){
											$sign = '<span class="glyphicon glyphicon-eye-open"></span>';
                                            $payment_color = '#068A7A';
                                            $payment_status = 'CADPIS';
										}elseif($row_Rs1['payment_status'] == 'paid'){
											$sign = '<span class="glyphicon glyphicon-eye-open"></span>';
                                            $payment_color = '#068A7A';
                                            $payment_status = 'PAID';
                                        }else{
											$sign = '<span class="glyphicon glyphicon-eye-close"></span>';
                                            $payment_color = '#CA6060';
                                            $payment_status = 'UNPAID';
                                        }
                                        ?>
                                        <div style="font-size:14px; color:<?php echo $payment_color?>; margin-top:6px;">
                                        	<?php echo $sign?>
                                            <?php echo $payment_status?>
                                        </div>
                                        
                                    </td>
                                    <td align="center">
                                        <a href="add_case.php?id=<?php echo base64_encode($row_Rs1['id'])?>" class="btn btn-xs btn-default cus" >Edit</a>
                                        <a href="update.php?case_id=<?php echo base64_encode($row_Rs1['id'])?>" class="btn btn-xs btn-default cus" >Update</a>
                                        <a href="donation.php?case=<?php echo base64_encode($row_Rs1['id'])?>" class="btn btn-xs btn-default cus" >Donation</a>
                                        
                                        <script>
                                        function verify(id){
											$.post( "/rohi.sg/cms/case/verify_case.php", {id:id, verification:'verified', }, function( result ) {
												$("#verification"+id).html(result);
											});
										}
                                        function pending(id){
											$.post( "/rohi.sg/cms/case/verify_case.php", {id:id, verification:'pending', }, function( result ) {
												$("#verification"+id).html(result);
											});
										}
                                        </script>
                                    </td>
                                </tr>
                                <?php  	$count++;
                                    }while($row_Rs1 = mysqli_fetch_assoc($Rs1));
                                }else{ ?>
                                <tr>
                                <td width="3%"></td>
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
		alert("Please enter cases.");
		form1.title.focus();
		return false;
	}
	if(form1.photo.value==""){
		alert("Please enter browse an image for cases.");
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