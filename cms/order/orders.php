<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
require_once '../../config/security.php';
//include '../cms/layout/savelog.php';

session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

$table = 'orders';
$module_name = 'Order';
$php = '../order/orders';
//$edit_php = 'add_orders';
$add = false;
$edit = false;
$list_method = 'list';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'username');
$filter = true;
$filFields = array('area', 'driver');//location


if((array)$_GET['tab'] == 'Decline'){
	$actions=array('Refund');
}elseif($_GET['tab'] == 'Delivered'){
	$actions=array();
}elseif($_GET['tab'] == 'Receipt'){
	$actions=array('Delivered');
}elseif($_GET['tab'] == 'Accept'){
	$actions=array('Receipt');
}elseif($_GET['tab'] == 'New' || empty($_GET['tab'])){
	$actions=array('Accept', 'Decline');//, 'Display', 'Hide'
}


$msg['Delete']='Are you sure you want to set as delete?';
$msg['New']='Are you sure you want to set to confirm?';			$db['New']=array('status', 'New');
$msg['Accept']='Are you sure you want to set to accept?';		$db['Accept']=array('status', 'Accept');
$msg['Decline']='Are you sure you want to set to decline?';		$db['Decline']=array('status', 'Decline');
$msg['Receipt']='Are you sure you want to set to receipt?';		$db['Receipt']=array('status', 'Receipt');
$msg['Delivered']='Are you sure you want to set to delivered?';	$db['Delivered']=array('status', 'Delivered');
$msg['Refund']='Are you sure you want to refund rebated amount?';	$db['Refund']=array('status', 'Refunded');
//$msg['Popular']='Are you sure you want to set as popular?';	$db['Popular']=array('popular', 'Yes');
//$msg['Not Popular']='Are you sure you want to set as not popular?';	$db['Not Popular']=array('popular', 'No');

$unique_validation=array();


$fields = array('id', 'location', 'driver', 'customer_name', 'customer_email', 'customer_address', 'total', 'receipt_id', 'accepted_span', 'receipt_span', 'delivered_span', 'accepted_date', 'receipt_date', 'delivered_date', 'payment_date', 'payment_status', 'status');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('9', '3'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}
/* Tag module uses session*/
$type['tag'] = 'tag';
$_SESSION['tag_name']='tag';//name for input table field.
$_SESSION['tag_module']=$table;
$_SESSION['module_row_id']='';
if(!empty($_GET['id'])){
	$_SESSION['module_row_id']=base64_decode($_GET['id']);
}



$placeholder['title'] = 'Title for profile page';
//$placeholder['post_content'] = 'Description for profile page';


$type['location'] = 'select'; $option['location'] = array();
$results = sql_read('select * from location where status=? order by position ASC, location ASC', 's', 1);
foreach((array)$results as $a){
	$option['location'][$a['id']] = ucwords($a['location']);
}

$type['area'] = 'select'; $option['area'] = array();
$results = sql_read('select * from area where status=? order by position ASC, area ASC', 's', 1);
foreach((array)$results as $a){
	$option['area'][$a['id']] = ucwords($a['area']);
}
$type['driver'] = 'select'; $option['driver'] = array();
$results = $results = sql_read('select * from driver where status=? order by name ASC', 's', 1);
foreach((array)$results as $a){
	$option['driver'][$a['id']] = ucwords($a['name']);
}



$type['id'] = 'hidden';
$type['password'] = 'password';
$type['position'] = 'number';
$type['stock'] = 'number';
//$type['publish_date'] = 'date';
$type['seo_title'] = 'textarea'; $tinymce['seo_title']=false;  $labelFullRow['seo_title']=false; $height['seo_title'] = '70px;'; $width['seo_title'] = '100%;';
$type['seo_keyword'] = 'textarea'; $tinymce['seo_keyword']=false;  $labelFullRow['seo_keyword']=false; $height['seo_keyword'] = '70px;'; $width['seo_keyword'] = '100%;'; 
$type['seo_description'] = 'textarea'; $tinymce['seo_description']=false;  $labelFullRow['seo_description']=false; $height['seo_description'] = '70px;'; $width['seo_description'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('New'=>'New','Accept'=>'Accept','Receipt'=>'Receipt','Delivered'=>'Delivered','Decline'=>'Decline','Refunded'=>'Refunded'); $default_value['status'] = 'New';
$type['popular'] = 'select'; $option['popular'] = array('No'=>'No','Yes'=>'Yes'); $default_value['popular'] = 'No';
//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');
//$type['thumbnail_photo'] = 'image';


$required['title'] = 'required';


/*if(empty($id)){
	$required['photo01'] = 'required';
}*/
/*
echo '<div style="margin-left:20%;">';
foreach((array)$fields as $field){
	echo $field;
	echo $width[$field];
	echo '<br>';
	print_r($fic_1);
}
echo '</div>';
*/
$cols = $items =array();
$cols = array('Order' => '3', 'Payment' => '2', 'Customer' => '3', 'Delivery' => '2', 'Address' => '3');
/*
$items['Order'] = array('total', 'receipt_id', 'confirmed_date');
$items['Driver & Area'] = array('area', 'driver', 'delivered_date');
$items['Customer'] = array('customer_name', 'customer_email', 'customer_address');
$items['Payment'] = array('payment_status', 'payment_date');
$items['Status'] = array('status');
delivered_date');*/
?>



<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/dashboard.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<link href="css/medium.css" rel="stylesheet">
<link href="../css/bootstrap-icon.css" rel="stylesheet">



<!--For date picker use - start -->
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/style.css">
<script src="<?php echo ROOT?>js/datepicker/jquery-1.12.4.js"></script>
<script src="<?php echo ROOT?>js/datepicker/jquery-ui.js"></script>
<script>
$( function() {
    $( ".datepicker" ).datepicker({ /*minDate: +7,*/ maxDate: "+10Y +6M +1D", dateFormat: 'dd/mm/yy' });
} );
</script>
<!--For date picker use - end -->
<style>
label {width:30%;}
.div_input {width:69%;}
</style>


</head>
<body>

<div class="row">
	<div class="col-12">
				
<style>
.list_search_output {display:none; background:#EFEFEF; box-shadow:2px 2px 2px rgba(0,0,0,.5); color:#333; max-height:80vh; overflow-y:scroll; cursor:default; position:absolute; z-index:10;}
</style>
<?php 
if($_POST['action']=="Delete"){
	$items_delete_array=$_POST['productIdList'];
	if(!empty($_POST['productIdList'])){
		foreach((array)$items_delete_array as $items_delete){
			$target_query = mysqli_query($conn, "SELECT * FROM $table WHERE id='$items_delete'") or die(mysqli_error());
			$target = mysqli_fetch_assoc($target_query);
			
			if(!empty($target)){
				if(!empty($target)){
					@unlink('../../'.$target['image']);
				}
				mysqli_query($conn, "DELETE FROM $table WHERE id='$items_delete'") or die(mysqli_error());			
			}
		}
	}
}elseif(!empty($_POST['action'])){

	$items_id_array=$_POST['productIdList'];
	if(!empty($_POST['productIdList'])){
		foreach((array)$items_id_array as $items_id){

			$current_order = sql_read('select * from orders where id=? limit 1' ,'s', $items_id);
			
			$editdata['id']=$items_id;

			if($_POST['action'] == 'Accept'){
				$editdata['status'] = 'Accept';
				$editdata['accepted_date'] = date('Y-m-d H:i:s');
				$editdata['accepted_span'] = number_format((strtotime(date('Y-m-d H:i:s')) - strtotime($current_order['confirmed_date']))/3600,2);
			}elseif($_POST['action'] == 'Decline'){
				$editdata['status'] = 'Decline';
				$editdata['decline_date'] = date('Y-m-d H:i:s');
				$editdata['decline_span'] = number_format((strtotime(date('Y-m-d H:i:s')) - strtotime($current_order['confirmed_date']))/3600,2);
				$editdata['decline_remark'] = $_POST['decline_remark'];
			}elseif($_POST['action'] == 'Receipt'){
				$editdata['status'] = 'Receipt';
				$editdata['receipt_date'] = date('Y-m-d H:i:s');
				$editdata['receipt_span'] = number_format((strtotime(date('Y-m-d H:i:s')) - strtotime($current_order['accepted_date']))/3600,2);
				$editdata['receipt_id'] = strtoupper(uniqid());
			}elseif($_POST['action'] == 'Delivered'){
				$editdata['status'] = 'Delivered';
				$editdata['delivered_date'] = date('Y-m-d H:i:s');
				$editdata['delivered_span'] = number_format((strtotime(date('Y-m-d H:i:s')) - strtotime($current_order['receipt_date']))/3600,2);
			}elseif($_POST['action'] == 'Refund'){
				$editdata['status'] = 'Refunded';
				$editdata['rebate_used'] = '0.00';
				$editdata['rebate_earned'] = '0.00';
			}

			if(sql_save('orders', $editdata)){
				
				/* ---------------------- Stock - Start ---------------------------*/
				if($_POST['action'] == 'Refund'){
					$items = sql_read('
						select i.uom, i.uom_id, i.quantity, sp.stock, sp.id as stock_id  
						from items as i          
						INNER JOIN stock_promo AS sp ON sp.uom = i.uom_id AND sp.location = ? 
						where session=? AND location_id=? 
					', 'sss', array($current_order['location'], $current_order['session'], $current_order['location']));
				
					foreach((array)$items as $item){
						$stock_promo['id'] = $item['stock_id'];
						$stock_promo['stock'] = $item['stock'] + $item['quantity'];
						sql_save('stock_promo', $stock_promo);
					}
				}
				/* ---------------------- Stock - End ---------------------------*/

								
				$save = '<div style="color:green;padding:6px 10px; border:1px solid green; border-radius:6px; width:100%;">Data saved.</div>';
				
				include 'email_notify.php';

			}
		}
	}

	

}
	


if(in_array("status",$fields)){	
	if(!empty($_GET['tab'])){
		$data[] = array_search($_GET['tab'], $option['status']);
		$condition = " where status=?";
	}else{
		$data[] = 'New';
		$condition = " where status=?";
	}
}else{
	$data[] = '';
	$condition = " where id !='' ";
}



if($_POST['submit'] == 'Reset'){
	$_SESSION['year'] = $_SESSION['from_month'] = $_SESSION['to_month'] = $_SESSION['filter_area'] = $_SESSION['driver'] = '';
}elseif($_POST['submit'] == 'Search'){
	if(!empty($_POST['year'])) $_SESSION['year'] = $_POST['year'];
	if(!empty($_POST['from_month'])) $_SESSION['from_month'] = $_POST['from_month'];
	if(!empty($_POST['to_month'])) $_SESSION['to_month'] = $_POST['to_month'];
	if(!empty($_POST['area'])) $_SESSION['filter_area'] = $_POST['area'];
	if(!empty($_POST['driver'])) $_SESSION['driver'] = $_POST['driver'];
}


$condition_ext = strstr($condition_ext, 'AND (from_year', true);

if($_SESSION['year'] && $_SESSION['from_month'] && $_SESSION['to_month']){
	if($_SESSION['from_month'] > $_SESSION['to_month']){
		echo "<script>alert('Month to must be greater than month from.');</script>";
	}else{
		$data[] = $_SESSION['year'].'-'.$_SESSION['from_month'].'-01';
		$data[] = $_SESSION['year'].'-'.$_SESSION['to_month'].'-31';
		$condition_ext .= " AND created >= ? AND created <= ? ";	
	}
}

if(!empty($_SESSION['filter_area'])){
	$data[] = $_SESSION['filter_area'];
	$condition_ext .= " AND area = ? ";	
}
if(!empty($_SESSION['driver'])){
	$data[] = $_SESSION['driver'];
	$condition_ext .= " AND driver = ? ";	
}


if(empty($sort)){
	$sort = " order by created DESC limit 500 ";
}

$_SESSION['error'] = 'select * from '.$table.' '.$condition.' '.$condition_ext.' '.$sort.'--'.implode(',',$data);


$rows = sql_read('select * from '.$table.' '.$condition.' '.$condition_ext.' '.$sort, str_repeat('s',count($data)), $data);
$count = sql_count('select * from '.$table.' '.$condition.' '.$condition_ext.' '.$sort, str_repeat('s',count($data)), $data);


$_SESSION['error'] .= 'count:'.$count;


?>

<style>
.titleBlockInList {margin-top:4px; font-size:15px;}
.blockInList {margin-top:4px;;}
.thum {
	width:100%; height:100px; background-size:cover; background-position:center; background-repeat:no-repeat; border:1px solid #CCC;
}
.span_label { text-transform:capitalize; color:#999; display:none;}
.span_label::after { content:":"; }
<?php 
if($list_method == 'list'){
if($edit==true){?>
	.edit_column {width:82% !important;}
<?php }else{?>
	.edit_column {width:96% !important;}
<?php }
}?> 


</style>


<div class="col-12 p-0">
    <!--<h3>List <?php echo $module_name;?></h3>-->
	
	<?php if(!empty($save)) echo $save;?>

	<?php 
        if($table == 'packages' || $table == 'project_details' || $table == 'project_photos' || $table == 'project_pdfs' || $table == 'causes_of_delay' || $table == 'contractual_issues'){ 
			if(!empty($_SESSION['proj_name'])){
				echo '<div style="padding-bottom:20px; font-size:16px; color:orange; line-height:1.5;">'.$_SESSION['proj_name'].'</div>';
			}
			if(!empty($_SESSION['pack_name'])){
				echo '<div style="padding-bottom:20px; font-size:16px; color:green; line-height:1.5;">'.$_SESSION['pack_name'].'</div>';
			}
		}
	?>
	
	<?php if($keyword==true || $filter==true){?>
		<div class="row" style="margin:10px 0; ">
			<form class="col-12" action="" method="post" enctype="multipart/form-data">
            <span class="glyphicon glyphicon-search" style="color:gray;"></span>
            
            <?php 
		  if($keyword==true){
		  $kyplaceholder="";$p=1;
			foreach((array)$keywordFields as $f){ if($p!=1){$kyplaceholder.=", ";}$p++; $kyplaceholder.=$str_convert->to_eye($f);}?>
                <input name="keyword" value="<?php echo $_SESSION[$module_name.'-search-keyword']?>" placeholder="<?php echo str_replace("_", " ", $kyplaceholder)?>" style="width:200px;"/>
            <?php }?>
			<div class="row">
			 <?php 
			 if($filter==true){
			 foreach((array)$filFields as $field){
				 if($type[$field] == 'datalist'){?>
                <input type="text" list="listlist<?php echo $field?>" value="<?php echo $option[$field][$_SESSION[$module_name.'-filter-'.$field]]?>" id="filterautoselect<?php echo $field?>" style="width:70%;"/>
                <datalist id="listlist<?php echo $field?>">
                    <?php foreach((array)$option[$field] as $option_v => $option_name){?>
                        <option value="<?php echo $option_name?>" <?php if($checked == $option_v){?> selected <?php }?> 
                        data-value="<?php echo $option_v?>"><?php echo $option_name?></option>
                    <?php }?>
                </datalist>
                <input type="hidden" name="<?php echo $field?>" id="filterautoselect<?php echo $field?>-hidden" value="<?php echo $_SESSION[$module_name.'-filter-'.$field]?>" >
                
				<?php }elseif($type[$field] == 'autosuggest'){?>
                    <input type="text" value="" class="search_input" id="search-input-filter-<?php echo $field?>"
                     autocomplete="off" data-input="filter-<?php echo $field?>" data-table="<?php echo $foreign_table[$field]?>" 
                     data-field="<?php echo $foreign_field[$field]?>" 
                     style="min-width:400px; padding:4px;" <?php foreach((array)$attribute[$field] as $a => $b){ echo $a.'="'.$b.'"'; }?>/>
                    <div class="search_output outputfilter-<?php echo $field?>">
                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                    </div>
                    <input type="hidden" name="<?php echo $field?>" id="hidden-filter-<?php echo $field?>" value="" >
                
                <?php }else{?>
                	<div class="col-2">
						<select name="<?php echo $field?>">
							<option value="">All <?php echo str_replace("_", " ", $field)?></option>
							<?php 
							foreach((array)$option[$field] as $option_v => $option_name){
								
							$countItem = sql_count("select * from '.$table.' where '.$field.' =? and payment_status='Paid'", 's', $option_v);

							if($countItem>0){
								$c = ' (<span id="status_figure_'.$option_v.'">'.$countItem.'</span>)';
							}else{
								$c = '';
							}
							?>
							<option value="<?php echo $option_v?>" <?php if($_SESSION[$module_name.'-filter-'.$field] == $option_v){?> selected <?php }?>><?php echo $option_name.$c?></option>
							<?php }?>
						</select>
					</div>
                <?php }}}?>


				<div class="col-2">					
					<select name="year">
						<option value="">Year from</option>
						<?php for($y=2020; $y<=date('Y'); $y++){?>
							<option value="<?php echo $y;?>" <?php if($_POST['year'] == $y){?>selected<?php }?>><?php echo $y;?></option>
						<?php }?>
					</select>
				</div>
				<div class="col-2">
					<select name="from_month">
						<option value="">Month from</option>
						<?php for($m=1; $m<=12; $m++){
							$mo = sprintf("%02d", $m); ?>
							<option value="<?php echo $mo;?>" <?php if($_POST['from_month'] == $mo){?>selected<?php }?>><?php echo date('M', mktime(0, 0, 0, $m, 10));?></option>
						<?php }?>
					</select>
				</div>
				<div class="col-2">										
					<select name="to_month">
						<option value="">Month to</option>
					<?php for($m=1; $m<=12; $m++){
						$mo = sprintf("%02d", $m); ?>
						<option value="<?php echo $mo;?>" <?php if($_POST['to_month'] == $mo){?>selected<?php }?>><?php echo date('M', mktime(0, 0, 0, $m, 10));?></option>
					<?php }?>
					</select>
				</div>
			</div>


			<div class="row pt-2 pb-5">
				<div class="col-12">
					<input type="submit" name="submit" value="Search">
					<input type="submit" name="submit" value="Reset">					
				</div>
			</div>



			</form>
		</div>
	<?php }?>
    
	<form action="" method="post" enctype="multipart/form-data" >
	
	<div class="col">
    <?php if(in_array("status",$fields)){?>
    <div id="tab" class="row">
        <ul class="nav nav-tabs">
            <?php foreach((array)$option['status'] as $v => $l){
                $s_count = sql_count('select * from '.$table.' where status=?', 's', $v);
                ?>
                <a href="<?php echo $php?>?tab=<?php echo $l?>" class="content"><li <?php if((empty($_GET['tab']) && $v == 'New') || $_GET['tab'] == $l){?>class="active"<?php }?>>
                <?php echo $l?> ( <?php echo $s_count;?> )
                </li></a>
            <?php }?>
        </ul>
    </div>
    <?php }?>
	</div>
	
    <div class="nav-act">	
		<div class="row pt-2 pb-1">		
			<div class="col-auto">
				<?php if(@count($actions)>0){?>
				<input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)" title="Check all item">
				<span class="glyphicon glyphicon-arrow-down" style="color:#CCC; padding-left:1px;"></span>
				<?php }?>
			</div>
			<div class="col-11">
				<div class="row">
				<?php 
				if(@count($actions)>0){
					foreach((array)$actions as $action){
						if($action == 'Decline') echo '<span style="font-size:12px; padding-top:4px; padding-left:100px;">&nbsp;Decline remark: </span><div class="col-4"><input type="text" name="decline_remark" style="padding:4px 10px; "></div>';

						?><input type="submit" name="action" value="<?php echo $action?>" onClick="return confirmAction('<?php echo $msg[$action]?>');" title="<?php echo $msg[$action]?> selected item(s)">
				<?php }
				}?>
				</div>
			</div>
		</div>
	</div>

	<table class="table table-striped" width="100%" id="item_list">
	<thead>    
		<?php if($list_method=='list'){?>
		<tr>
			<th style="width:2% !important;"></th>
			<?php 
			if($edit==true){	$usable_width = 88/12;	}else{	$usable_width = 96/12;}
			$c=2;
			foreach((array)$cols as $colName => $colWidth){?>
				<th style="
					width:<?php echo $usable_width*$colWidth;?>%; 
					<?php if($list_sort){?>cursor:pointer;<?php }?>
				" 
				<?php if($list_sort){?> onClick="sortTable('#item_list', '<?php echo $c;?>')" <?php }?>
				>
					<?php echo $colName?>
					<?php if($list_sort){?>&#8597;<?php }?>
				</th>
			<?php }?>
			
		</tr>
		<?php }?>
    

    </thead>
	<tbody>
    
	<?php 

	
	if($count>0){
				
	$itemCount=1;
	$maxPerPage=50;
		
        foreach((array)$rows as $val){

			if(!empty($val['package_date'])){
				$val['package_date'] = substr($val['package_date'],8,2).'/'.substr($val['package_date'],5,2).'/'.substr($val['package_date'],0,4);
			}
			$c=1;?>
            <tr class="page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>" id="row<?php echo $val['id']?>">
                <td style="width:2% !important;">
					<?php if(@count($actions)>0){?>
                    <input type="checkbox" value="<?php echo $val['id']; ?>" name="productIdList[]">
					<?php }?>
                    <input type="hidden" name="id" value="<?php echo $val['id'];?>" />
					
                </td>
                <td>
					<div class="col-lg-12" style="padding:0; font-size:22px;">					
						<a href="<?php echo ROOT?>the_order/<?php echo $defender->encrypt('encrypt',$val['id']);?>" target="_blank"><?php echo $mo = 'E'.sprintf("%06d", $val['id']); ?></a>
					</div>
					<div class="col-lg-12" style="padding:0;">
						<?php if(!empty($val['receipt_id'])) echo '<span style="color:gray;">Receipt ID: </span>'.$val['receipt_id'];?>
					</div>
					<div class="col-lg-12" style="padding:0;">
						<?php if(!empty($val['total'])) echo '<span style="color:gray;">Total: </span>RM'.$val['total'];?>
					</div>
				</td>
				<td>
					<div class="col-lg-12" style="padding:0; font-size:22px;">
						<?php if(!empty($val['payment_status'])) echo $val['payment_status'];?>
					</div>
					<div class="col-lg-12" style="padding:0;">
						<?php if(!empty($val['payment_date'])) echo date('d/m/Y', strtotime($val['payment_date']));?>
					</div>
					<div class="col-lg-12" style="padding:0;">
						<?php if($val['rebate_used']>0) echo '<span class="text-muted">Rebate Used:</span> RM'.$val['rebate_used'];?>
					</div>
					<div class="col-lg-12" style="padding:0;">
						<?php if($val['rebate_gained']>0) echo '<span class="text-muted">Rebate Gain:</span> RM'.$val['rebate_gained'];?>
					</div>
				</td>		
                <td>
					<div class="col-lg-12" style="padding:0;">
						<?php 
						if(!empty($val['member'])){
							$member = sql_read('select * from member where id =? limit 1', 's', $val['member']);
						}						
						if(!empty($member['name'])) echo '<span style="color:gray;">Name: </span>'.$member['name'];?>
					</div>			
					<div class="col-lg-12" style="padding:0;">
						<?php if(!empty($member['email'])) echo '<span style="color:gray;">Email: </span>'.$member['email'];?>
					</div>
					<div class="col-lg-12" style="padding:0;">
						<?php if(!empty($member['mobile_number'])) echo '<span style="color:gray;">Mobile: </span>'.$member['mobile_number'];?>
					</div>
				</td>
				
				<td>
					<div class="col-lg-12" style="padding:0;">
						<?php if(!empty($option['driver'][$val['driver']])) echo '<span style="color:gray;">Driver: </span>'.$option['driver'][$val['driver']];?>					
					</div>
					<div class="col-lg-12" style="padding:0;">
						<?php if(!empty($option['area'][$val['area']])) echo '<span style="color:gray;">Area: </span>'.$option['area'][$val['area']];?>
					</div>
					<div class="col-lg-12" style="padding:0;">
						<?php 
						if(!empty($val['delivery_method'])){
							echo '<span style="color:gray;">Method: </span>
							<span style="text-transform: capitalize;">'.$val['delivery_method'].'</span>';
						}
						if($val['delivery_method'] == 'pickup'){
							echo '<br>'.$val['pickup_time'];
						}				
						?>
					</div>
				</td>
				<td>
					<div class="col-lg-12" style="padding:0;">
						<?php if(!empty($val['address'])) echo $val['address'];?>
					</div>		
				</td>


            </tr>
        <?php 
		  $itemCount++;
		  }
		?>
        </tbody>
		</table>
        <?php include("../../paging.php");?>
        
	<?php }else{?>
        <table>
        	<tr><td>No record found</td></tr>
		</table>
    <?php }?>
</form>
</div>


<script>

	
function sortTable(table, col) {
	
	thead =$(table).find('thead');
	tbody =$(table).find('tbody');
	
	var ss = thead.find('th:nth-child('+col+')').attr('sorting');
	if (ss=='desc') {
		thead.find('th:nth-child('+col+')').attr('sorting','asc');
		var asc = 'desc';
	} else {
		thead.find('th:nth-child('+col+')').attr('sorting','desc');
		var asc = 'asc';
	}
	
    tbody.find('tr').sort(function(a, b) {
        if (asc == 'asc') {
            return $('td:nth-child('+col+')', a).text().localeCompare($('td:nth-child('+col+')', b).text());
        } else {
            return $('td:nth-child('+col+')', b).text().localeCompare($('td:nth-child('+col+')', a).text());
        }
    }).appendTo(tbody);
    
}


(function(){ 
	var current_tab='<?php echo $_GET['tab'];?>';
	if(current_tab==''||current_tab=='display'){
		$("#display_tab").attr('class', 'current');$("#hide_tab").attr('class', '');
	}else{
		$("#hide_tab").attr('class', 'current');$("#display_tab").attr('class', '');
	}
})()



function removeThis(id){//alert(id);
	$.ajax({url: "layout/remove_item.php?table=<?php echo $table?>&id="+id, success: function(result){
		$("#row"+id).html(result).delay(2000).fadeOut();
	}});
}



function confirmAction(msg){
	var point = confirm(msg);
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
        

<style>
.modal {  z-index:5000;}
.modal-dialog {width:80% ; margin:50px auto;}

</style>


	</div>

</div>
</body>

<script>
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


<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/functions.jquery.js"></script>
<?php include '../../config/session_msg.php';?>



</html>