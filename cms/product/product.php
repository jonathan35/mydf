<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
//include '../layout/savelog.php';

session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Area:../authentication/login.php");
}

$table = 'product';
$module_name = 'Product';
$php = 'product';
$folder = 'product';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = " order by position ASC, created DESC limit 500";
$more_photos = true;


$keyword = true;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'location');
$filter = true;
$filFields = array('category');



$actions=array('Delete', 'Display', 'Hide');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');

//$unique_validation=array('tier');

$fields = array('id', 'category', 'sub_category', 'photo',  'name', 'location', 'size', 'new', 'bedrooms', 'bathrooms', 'position', 'status', 'description');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('5', '7'), 1 => array(1));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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


$label['size'] = 'Size (sq.ft.)';

$child['category'] = true;
$type['category'] = 'select'; $option['category'] = array();
$results = sql_read('select * from category where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['category'][$a['id']] = ucwords($a['category']);
}


$parent['sub_category'] = 'category'; $parent_val['sub_category'] = array();
$type['sub_category'] = 'select'; $option['sub_category'] = array();
$results = sql_read('select * from sub_category where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['sub_category'][$a['id']] = ucwords($a['sub_category']);
	if(!empty($parent['sub_category'])){
		$parent_val['sub_category'][$a['id']] = $a[$parent['sub_category'] ];
	}
}


$type['id'] = 'hidden';
$type['photo'] = 'image';
$type['password'] = 'password';
$type['bedrooms'] = 'number';
$type['bathrooms'] = 'number';
$type['position'] = 'number';
//$type['publish_date'] = 'date';
$type['description'] = 'textarea'; $tinymce['description']=true;  $labelFullRow['description']=false; $height['description'] = '200px;'; $width['description'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide'); $default_value['status'] = '1';
$type['new'] = 'select'; $option['new'] = array('Yes'=>'Yes','No'=>'No'); $default_value['new'] = 'Yes';



$attributes['category'] = array('required' => 'required');
$attributes['sub_category'] = array('required' => 'required');
$attributes['status'] = array('required' => 'required');
$attributes['bedrooms'] = array('placeholder' => 'Bedrooms Count', 'max' => '99');
$attributes['bathrooms'] = array('placeholder' => 'Bathrooms Count', 'max' => '99');
$attributes['size'] = array('placeholder' => 'Size in square feet');
$attributes['name'] = array('placeholder' => 'Product Name');
$attributes['location'] = array('placeholder' => 'Product Location');
$attributes['position'] = array('placeholder' => 'A number for sorting');

$remark['photo'] = 'Recommanded size: 1200 x 1000 pixel';


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

$cols = array('Category' => '3', 'Product' => '2', 'Name' => '5', 'Location' => '2');//Column title and width
$items['Category'] = array('category', 'sub_category');
$items['Product'] = array('photo');
$items['Name'] = array('name');
$items['Location'] = array('location');

if(empty($_POST['get_config_only'])){
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


<div class="row">
	<?php if($_GET['no_list'] != 'true'){?>
	<div class="btn btn-secondary ml-3 mb-3" onclick="$('.add_product').fadeToggle(); $('.icon_add, .icon_minus').toggle();">
		Add Product
		<span class="icon_add" style="font-size:20px;">+</span>
		<span class="icon_minus collapse" style="font-size:20px;"> - </span>
	</div>
	<?php }?>
	
	<?php if($add==true || $_GET['id']){?>
	<div class="col-12 <?php if($_GET['no_list'] != 'true'){?>collapse add_product<?php }?>">
		<?php include '../layout/add.php';?>
	</div>
	<?php }?>
</div>
<div class="row">
	<div class="col-12">
		<?php if(!$_GET['no_list']) include '../layout/list.php';?>
	</div>
</div>

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


<?php if(empty($_GET['id'])){?>


	<script>
	

	$(document).ready(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=category]").change(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=sub_category]").change(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=area]").change(function(){
		auto_fill_min();
	})


	function auto_fill_min(){

		$("input[name=min_checkout_price]").attr('readonly', 'readonly');
		
		var category = $(".div_input > select[name=category]").val();
		var sub_category = $(".div_input > select[name=sub_category]").val();		
		var area = $(".div_input > select[name=area]").val();

		$.post('get_min.php', {category:category, sub_category:sub_category, area:area}, function(return_fee){
			$("input[name=min_checkout_price]").val(return_fee);
		})

	}
	</script>

<?php }?>


</html>
<?php }?>