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

$table = 'message_contact';
$module_name = 'Contact Message';
$php = 'message_contact';
$folder = 'content';//auto refresh row once edit modal closed
$add = false;
$edit = false;
$read = true;
$list = true;
$list_method = 'list';
$sort = " order by id DESC limit 500";
$more_photos = false;


$keyword = true;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'email');
$filter = false;
$filFields = array('category');



$actions=array('Delete', 'New', 'Read', 'Replied');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['New']='Are you sure you want to set as new?';	$db['New']=array('status', 'New');
$msg['Read']='Are you sure you want to set as read?';			$db['Read']=array('status', 'Read');
$msg['Replied']='Are you sure you want to set as repied?';	$db['Repied']=array('status', 'Repied');


//$unique_validation=array('tier');

$fields = array('id', 'name', 'email', 'contact', 'designation', 'address', 'company', 'date', 'message', 'status');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('5', '6'), 1 => array(1));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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
$type['date'] = 'date';
$type['description'] = 'textarea'; $tinymce['description']=true;  $labelFullRow['description']=false; $height['description'] = '200px;'; $width['description'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('New'=>'New','Read'=>'Read','Replied'=>'Replied'); $default_value['status'] = '1';
$type['new'] = 'select'; $option['new'] = array('Yes'=>'Yes','No'=>'No'); $default_value['new'] = 'Yes';


$attributes['category'] = array('required' => 'required');
$attributes['sub_category'] = array('required' => 'required');
$attributes['status'] = array('required' => 'required');
$attributes['bedrooms'] = array('placeholder' => 'Bedrooms Count', 'max' => '99');
$attributes['bathrooms'] = array('placeholder' => 'Bathrooms Count', 'max' => '99');
$attributes['size'] = array('placeholder' => 'Size in square feet');
$attributes['name'] = array('placeholder' => 'Message Name');
$attributes['location'] = array('placeholder' => 'Message Location');
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

$cols = array('Company' => '2', 'Name' => '2', 'Email/Contact' => '3', 'Address' => '3', 'Date' => '1', 'Status' => '1');//Column title and width
$items['Company'] = array('company');
$items['Name'] = array('designation', 'name');
$items['Email/Contact'] = array('email', 'contact');
$items['Date'] = array('date');
$items['Status'] = array('status');
$items['Address'] = array('address');

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
	<?php if($read==true || $_GET['id']){?>
	<div class="col-12 <?php if($_GET['no_list'] != 'true'){?>collapse add_property<?php }?>">
		<?php include '../layout/read.php';?>
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


</html>
<?php }?>