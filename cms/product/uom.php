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

$table = 'uom';
$module_name = 'Unit of Measurement';
$php = 'uom';
$add = true;
$edit = true;
$list = true;
$list_method = 'list';


$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'username');
$filter = false;
$filFields = array('product');
if($_SESSION['group_id'] == '1'){
	$actions=array('Delete', 'Display', 'Hide', 'Remove Promotion');//, 'Display', 'Hide'
	$msg['Delete']='Are you sure you want to delete?';
	$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
	$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
	$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
	$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');
	$msg['Remove Promotion']='Are you sure you want to set as no promotion?';	$db['Remove Promotion']=array('promo', '');	
}else{

	$actions=array();
}

$unique_validation=array();


$fields = array('id', 'region', 'brand', 'category', 'sub_category', 'sku', 'uom_name', 'position', 'status', 'seo_title', 'seo_keyword', 'seo_description');
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


$type['region'] = 'select'; $option['region'] = array();
$results = sql_read('select * from region where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['region'][$a['id']] = ucwords($a['region']);
}

$type['location'] = 'select'; $option['location'] = array();
$results = sql_read('select * from location where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['location'][$a['id']] = ucwords($a['location']);
}


$type['product'] = 'select'; $option['product'] = array();
if(!empty($selected_region)){
	$selected_loc = sql_read('select id, region, sku, product_name from product where location=? order by position ASC', 's', $selected_region);
}else{
	$products = sql_read('select id, region, sku, product_name from product order by position ASC');
}
if(@count($products)){
	foreach((array)$products as $a){
		$option['product'][$a['id']] = ucwords($a['product']);
	}
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
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide'); $default_value['status'] = '1';
$type['popular'] = 'select'; $option['popular'] = array('No'=>'No','Yes'=>'Yes'); $default_value['popular'] = 'No';
//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');
//$type['thumbnail_photo'] = 'image';

$required['title'] = 'required';


$cols = $items =array();
$cols = array('SKU' => '1', 'Product' => '2', 'UOM' => '1', 'Price' => '1', 'Region > Location' => '2', 'Stock Qty.' => '1', 'Low Stock' => '1', 'NEW ARRIVAL' => '1', 'LOW PR. ALWAYS' => '1', 'PRICE DROPPED' => '1', 'Price Was (RM)' => '1');//Column title and width


//$items['Programme'] = array('programme','experience','experience_detail');
//$items['Condition'] = array('illnesses','bankrupt','court');





?>

<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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

if(!empty($_POST['save2020']) && !empty($_SESSION['location'])){

	$loc = sql_read('select * from location where id=? limit 1', 's', $_SESSION['location']);
	$uoms = sql_read('select * from uom where region=?' , 's', $loc['region']);
	$stock_promos = sql_read('select * from stock_promo where location=?', 's', $_SESSION['location']);
	
	$exist_list = array();
	if($stock_promos){
		foreach((array)$stock_promos as $stock){
			$exist_list[] = $stock['uom'];
		}
	}

	//-------------------- Insert ----------------------
	foreach((array)$uoms as $uo){
		$stock = '0';
		$stock_low = '0';
		$new = '0';
		$low = '0';
		$dropped = '0';
		$was = '0';
		$promo = '';
		
		if(!empty($_POST['stock'][$uo['id']])){
			$stock = $_POST['stock'][$uo['id']];
		}
		if(!empty($_POST['stock_low'][$uo['id']])){
			$stock_low = $_POST['stock_low'][$uo['id']];
		}		
		if(!empty($_POST['promo'][$uo['id']])){
			$promo = $_POST['promo'][$uo['id']];
		}
		if(!empty($_POST['was'][$uo['id']])){
			$was = $_POST['was'][$uo['id']];
		}
	
		if(!in_array($uo['id'], $exist_list)){
			if(mysqli_query($conn, "INSERT INTO stock_promo (uom, location, stock, stock_low, promo, was, created, modified) VALUES ('".$uo['id']."', '".$_SESSION['location']."', '".$stock."', '".$stock_low."', '".$promo."', '".$was."', '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."')")){
				$save = '<span style="color:green;">Data saved.</span>';
				
			}
		}else{

			if(mysqli_query($conn, "UPDATE stock_promo SET stock= '".$stock."', stock_low= '".$stock_low."',  promo= '".$promo."', was= '".$was."' WHERE location = '".$_SESSION['location']."' AND uom='".$uo['id']."'")){
				$save = '<span style="color:green;">Data saved.</span>';

			
			}
		}		
	}
}




if($_POST['action'] == 'Remove Promotion'){ 
	$items_array=$_POST['productIdList'];
	if(!empty($_POST['productIdList'])){
		foreach((array)$items_array as $item){		
			mysqli_query($conn, "UPDATE stock_promo SET promo='' WHERE uom='".$item."' AND location = '".$_SESSION['location']."'");			
		}
	}

}elseif($_POST['action']=="Delete"){
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
			$data['id']=$items_id;
			$data[$db[$_POST['action']][0]]=$db[$_POST['action']][1];
			if(sql_save($table, $data));
		}
	}
}
	
	
if(in_array("status",$fields)){	
	if(!empty($_GET['tab'])){
		$params[] = array_search($_GET['tab'], $option['status']);
		$condition = " where status=? ";
	}else{
		$params[] = 1;
		$condition = " where status=?";
	}
}else{
	$params[] = '';
	$condition = " where id !=? ";
}
	
if($_GET['l']){
	$_SESSION['location'] = $defender->encrypt('decrypt',$_GET['l']);
}

if($_SESSION['group_id'] == '1'){
	if(!empty($_SESSION['location'])){				
		$the_location = sql_read('select * from location where id=? LIMIT 1' ,'s', $_SESSION['location']);		
		$params[] = $selected_region = $the_location['region'];
		$region_cond = " AND region = ? ";	
	}
}elseif($_SESSION['group_id'] == '2'){//store admin		
	$user = sql_read('select * from login where id=? LIMIT 1' ,'s', $_SESSION['user_id']);	
	if(!empty($user['location'])){
		$_SESSION['location'] = $user['location'];		
		$user_location = sql_read('select * from location where id=? LIMIT 1' ,'s', $user['location']);
		$params[] = $selected_region = $user_location['region'];
		$region_cond = " AND region = ? ";	
	}

}

if(empty($sort)){
	$sort = " order by created DESC limit 500 ";
}

$rows = sql_read('select * from '.$table.' '.$condition.' '.$region_cond.' '.$sort, str_repeat('s',count($params)), $params);
$count = sql_count('select * from '.$table.' '.$condition.' '.$region_cond.' '.$sort, str_repeat('s',count($params)), $params);

/*
echo 'select * from '.$table.' '.$condition.' '.$region_cond.' '.$sort;
debug($rows);
debug($params);
echo '<br>----------1----------<br>';
*/

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
.location-block {display:inline-block; border:1px solid #94e34f; padding:2px 10px; margin-right:4px; color:#000; border-radius:4px; transition:background 0.6s;}
.location-block:hover {background:#63d600;}
.location-active {background:#cdffa1;}
</style>
<div class="col-12 p-0">
    <h3>UOM & Price</h3>
	<div style="padding:10px 0; margin-bottom:10px; border-top:4px solid #82bf6f;">
		<div style="display:inline-block; font-size:18px; color:#82bf6f; vertical-align:top; "> Location: </div>
		<div style="display:inline-block;">

			<?php 
			$regions = sql_read('select * from region where status=1 order by position ASC, region ASC');
			
			foreach((array)$regions as $r){?>
				
				<?php 
				if($_SESSION['group_id'] == '1'){
					$filter_locations = sql_read('select * from location where status=? AND region=? order by position ASC', 'ss', array(1, $r['id']));
				}else{	
					$filter_locations = sql_read('select * from location where status=? AND id=? AND region=? order by position ASC', 'sss', array(1, $_SESSION['location'], $r['id']));
				}
				
				if($filter_locations){?>
					<div style="padding:2px 0;">
					<?php
						echo '<div style="display:inline-block; width: 160px; text-align:right; padding-right:6px;">'.$r['region'].'</div>';
						foreach((array)$filter_locations as $l){
							$enc_location_id = $defender->encrypt('encrypt',$l['id']);
							?>
							<a href="<?php echo $php.'?l='.$enc_location_id?>">
								<div class="location-block <?php if($_SESSION['location'] == $l['id']){?>location-active<?php }?>">					
									<?php echo $l['location'];?>
								</div></a>
						<?php }?>
					</div>
				<?php }?>
				
			<?php }	?>
		<?php //	?>
		</div>	
	</div>

	<?php if(empty($_SESSION['location'])){		
		return false;
	}?>

	
	<?php 
	if($keyword==true || $filter==true){?>
		<div class="row" style="margin:10px 0;">
			<form action="" method="post" enctype="multipart/form-data">
            <span class="glyphicon glyphicon-search" style="color:gray;"></span>
            
            <?php 
		  if($keyword==true){
		  $kyplaceholder="";$p=1;
			foreach((array)$keywordFields as $f){ if($p!=1){$kyplaceholder.=", ";}$p++; $kyplaceholder.=$str_convert->to_eye($f);}?>
                <input name="keyword" value="<?php echo $_SESSION[$module_name.'-search-keyword']?>" placeholder="<?php echo str_replace("_", " ", $kyplaceholder)?>" style="width:200px;"/>
            <?php }?>
			 
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
                
                	<select name="<?php echo $field?>">
                    <option value="">All <?php echo str_replace("_", " ", $field)?></option>
					<?php 
                      foreach((array)$option[$field] as $option_v => $option_name){
                           
                      $countItem = sql_count('select id from '.$table.' where '.$field.' =?', 's', $option_v);
                      if($countItem>0){
                           $c = ' (<span id="status_figure_'.$option_v.'">'.$countItem.'</span>)';
                      }else{
                           $c = '';
                      }
                      ?>
                    <option value="<?php echo $option_v?>" <?php if($_SESSION[$module_name.'-filter-'.$field] == $option_v){?> selected <?php }?>><?php echo $option_name.$c?></option>
                    <?php }?>
                  </select>
                <?php }}}?>
                
                <input type="submit" name="submit" value="Search">
                <input type="submit" name="submit" value="Reset">
			</form>
		</div>
	<?php }?>
    
	<form action="" method="post" enctype="multipart/form-data" >
	
	<div class="col">
    <?php if(in_array("status",$fields)){?>
    <div id="tab" class="row">
        <ul class="nav nav-tabs">
            <?php foreach((array)$option['status'] as $v => $l){
				$tabparams[0] = $v;
				if(!empty($selected_region)){
					$tabparams[1] = $selected_region;	
				}
                $s_count = sql_count('select * from '.$table.' where status=?'.$region_cond , str_repeat('s',count($tabparams)), $tabparams);
                ?>
                <li <?php if((empty($_GET['tab']) && $v == 1) || $_GET['tab'] == $l){?>class="active"<?php }?>>
                <a href="<?php echo $php?>?tab=<?php echo $l?>" class="content"><?php echo $l?> ( <?php echo $s_count;?> )</a>
                </li>
            <?php }?>
        </ul>
    </div>
	<?php }?>
	</div>
    
    <div class="nav-act">
		<div class="row pt-2 pb-1">
			<div class="col-1" style="width:5% !important;">
			<?php if(!empty($actions)){?>
				<input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)" title="Check all item">
				<span class="glyphicon glyphicon-arrow-down" style="color:#CCC; padding-left:1px;"></span>
			<?php }?>
			</div>
			<div class="col-2" style="float:right">				
				<input type="submit" name="save2020" value="Save">
				<?php echo $save?>
			</div>
			<div class="col-9 pt-0" style="">
			<?php foreach((array)$actions as $action){?><input type="submit" name="action" value="<?php echo $action?>" onClick="return confirmAction('<?php echo $msg[$action]?>');" title="<?php echo $msg[$action]?> selected item(s)"><?php }?>
			</div>
		</div>
	</div>
	</div>
	</div>
	
	<div class="col-12">
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

	$product_list = array();
	if(@count($products)){
		foreach((array)$products as $p){
			$product_list[$p['id']] = $p;
		}
	}
	
	
	if($count>0){
		
	$itemCount=1;
	$maxPerPage=50;
		if($list_method=='list'){
        foreach((array)$rows as $val){
			$stock_promo = sql_read('select * from stock_promo where location=? AND uom=? LIMIT 1', 'ss', array($_SESSION['location'], $val['id']));			

			if(!empty($val['package_date'])){
				$val['package_date'] = substr($val['package_date'],8,2).'/'.substr($val['package_date'],5,2).'/'.substr($val['package_date'],0,4);
			}

			$c=1;?>
            <tr class="page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>" id="row<?php echo $val['id']?>">
                <td style="width:2% !important;">
					<?php if(!empty($actions)){?>
                    <input type="checkbox" value="<?php echo $val['id']; ?>" name="productIdList[]">
					<?php }?>
                    <input type="hidden" name="id" value="<?php echo $val['id'];?>" />
                </td>
				<td>
					<?php echo $product_list[$val['product']]['sku'];?>
                </td>
				<td>
					<?php echo $product_list[$val['product']]['product_name'];?>
                </td>
                <td>
					<?php echo $val['uom'];?>
                </td>
				<td>
					<?php echo $val['price'];?>
                </td>
				<td>
					<?php echo $option['region'][$val['region']];?> > 
					<?php echo $option['location'][$_SESSION['location']];?>
                </td>
				<td>
					<input type="number" name="stock[<?php echo $val['id']?>]" value="<?php echo $stock_promo['stock']?>" style="width:60px;">
                </td>
				<td>
					<input type="number" name="stock_low[<?php echo $val['id']?>]" value="<?php echo $stock_promo['stock_low']?>" style="width:60px;">
                </td>
				<td>					
					<input type="radio" name="promo[<?php echo $val['id']?>]" value="new" <?php if($stock_promo['promo'] == 'new'){ echo 'checked';}?>>
                </td>
				<td>				
					<input type="radio" name="promo[<?php echo $val['id']?>]" value="low" <?php if($stock_promo['promo'] == 'low'){ echo 'checked';}?>>
                </td>
				<td>
					<input type="radio" name="promo[<?php echo $val['id']?>]" value="drop" <?php if($stock_promo['promo'] == 'drop'){ echo 'checked';}?>>
                </td>
				<td>
					<input type="number" name="was[<?php echo $val['id']?>]" value="<?php if($stock_promo['was'] !='0.00') echo $stock_promo['was'];?>" style="width:80px;" placeholder="Was(RM)" step="any" min="<?php echo $val['price'];?>">
                </td>

            </tr>
        <?php 
		  $itemCount++;
		  }
	
		}?>
        </tbody>
		</table>
		</div>
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