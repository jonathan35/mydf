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

$table = 'delivery_tier';
$module_name = 'Delivery Tier';
$php = 'delivery_tier';
$folder = 'setup';
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = " order by position ASC, created DESC limit 500";


$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'username');
$filter = true;
$filFields = array('region', 'location', 'area');

$actions=array('Delete', 'Display', 'Hide');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');

//$unique_validation=array('tier');

$fields = array('id', 'region', 'location', 'area', 'status', 'tier', 'min_checkout_price', 'max_checkout_price', 'delivery_fee');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('5', '4'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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

$attributes['area'] = array('required' => 'required');
$placeholder['title'] = 'Title for profile page';
$label['delivery_fee'] = 'Delivery Fee (RM)';
//$placeholder['post_content'] = 'Description for profile page';

$child['region'] = true;
$type['region'] = 'select'; $option['region'] = array();
$results = sql_read('select * from region where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['region'][$a['id']] = ucwords($a['region']);
}

$child['location'] = true;
$parent['location'] = 'region'; $parent_val['location'] = array();
$type['location'] = 'select'; $option['location'] = array();
$results = sql_read('select * from location where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['location'][$a['id']] = ucwords($a['location']);
	if(!empty($parent['location'])){
		$parent_val['location'][$a['id']] = $a[$parent['location'] ];
	}
}

$parent['area'] = 'location'; $parent_val['area'] = array();
$type['area'] = 'select'; $option['area'] = array();
$results = sql_read('select * from area where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['area'][$a['id']] = ucwords($a['area']);
	if(!empty($parent['area'])){
		$parent_val['area'][$a['id']] = $a[$parent['area'] ];
	}
}

$type['id'] = 'hidden';
$type['password'] = 'password';
$type['position'] = 'number';
//$type['publish_date'] = 'date';
//$type['address'] = 'textarea'; $tinymce['address']=false;  $labelFullRow['address']=false; $height['address'] = '80px;'; $width['address'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide'); $default_value['status'] = '1';
//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');
//$type['thumbnail_photo'] = 'image';
$attributes['region'] = array('required' => 'required');
$attributes['location'] = array('required' => 'required');
$attributes['area'] = array('required' => 'required');
$attributes['status'] = array('required' => 'required');
$attributes['tier'] = array('required' => 'required');
$attributes['min_checkout_price'] = array('required' => 'required');
$attributes['max_checkout_price'] = array('required' => 'required');
$attributes['delivery_fee'] = array('required' => 'required');

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
$cols = array('Region' => '2', 'Location' => '2', 'Area' => '2', 'Tier' => '2', 'Min' => '1', 'Max' => '1', 'Fee (RM)' => '2');//Column title and width
$items['Region'] = array('region');
$items['Location'] = array('location');
$items['Area'] = array('area');
$items['Tier'] = array('tier');
$items['Min'] = array('min_checkout_price');
$items['Max'] = array('max_checkout_price');
$items['Fee (RM)'] = array('delivery_fee');
//$items['Programme'] = array('programme','experience','experience_detail');
//$items['Condition'] = array('illnesses','bankrupt','court');

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
	<?php if($add==true || $_GET['id']){?>
	<div class="col-12">
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
	$(".div_input > select[name=region]").change(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=location]").change(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=area]").change(function(){
		auto_fill_min();
	})


	function auto_fill_min(){

		$("input[name=min_checkout_price]").attr('readonly', 'readonly');
		
		var region = $(".div_input > select[name=region]").val();
		var location = $(".div_input > select[name=location]").val();		
		var area = $(".div_input > select[name=area]").val();

		$.post('get_min.php', {region:region, location:location, area:area}, function(return_fee){
			$("input[name=min_checkout_price]").val(return_fee);
		})

	}
	</script>

<?php }?>


</html>
<?php }?>