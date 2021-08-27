<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
//include '../layout/savelog.php';


session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

$table = 'news';
$module_name = 'News';
$php = 'news';
$folder = 'content';
$add = true;
$edit = true;
$tinymce_photo = true;
$list = true;
$list_method = 'list';
$sort = ' order by position ASC, id DESC';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'username');

$actions=array('Delete', 'Display', 'Hide');
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');

$unique_validation=array();


$fields = array('id', 'title', 'photo', 'news_date', 'release_date', 'conceal_date', 'position', 'status', 'file_attachment', 'news_content');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('8', '2'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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


$attributes['photo'] = array('required' => 'required');
$attributes['position'] = array('placeholder' => 'A number for sorting');
$attributes['release_date'] = array('placeholder' => 'Leave empty for immediate release');
$attributes['conceal_date'] = array('placeholder' => 'Leave empty for not conceal');

$type['id'] = 'hidden';
$type['password'] = 'password';
$type['position'] = 'number';
$type['news_date'] = 'date';
$type['release_date'] = 'date';
$type['conceal_date'] = 'date';
$type['file_attachment'] = 'file';
$type['photo'] = 'image';
$type['news_content'] = 'textarea'; $tinymce['news_content']=false;  $labelFullRow['news_content']=true; $height['news_content'] = '250px;'; $width['news_content'] = '100%;';
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide'); $default_value['status'] = '1';
//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');



$type['navigator'] = 'select'; $option['navigator'] = array();
$results = sql_read('select * from navigator where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['navigator'][$a['id']] = ucwords($a['section']);
}


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
$cols = array('News' => '3', 'Photo' => '2', 'News Date' => '2', 'Release Date' => '2', 'Conceal Date' => '2', 'Status' => '1');//Column title and width
$items['News'] = array('title');
$items['Photo'] = array('photo');
$items['News Date'] = array('news_date');
$items['Release Date'] = array('release_date');
$items['Conceal Date'] = array('release_date');
$items['Status'] = array('status');
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
    $( ".datepicker" ).datepicker({ /*minDate: +7,*/ maxDate: "+1Y +6M +1D", dateFormat: 'yy-mm-dd' });
} );
</script>
<!--For date picker use - end -->
<style>
label {width:30%;}
.div_input {width:69%;}
</style>


<div class="row">

	<?php if($_GET['no_list'] != 'true'){?>
	<div class="btn btn-secondary ml-3 mb-3" onclick="$('.add_page').fadeToggle(); $('.icon_add, .icon_minus').toggle();">
		Add <?php echo $module_name?>
		<span class="icon_add" style="font-size:20px;">+</span>
		<span class="icon_minus collapse" style="font-size:20px;"> - </span>
	</div>
	<?php }?>

	<?php if($add==true || $_GET['id']){?>
	<div class="col-12 <?php if($_GET['no_list'] != 'true'){?>collapse add_page<?php }?>">
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



</html>
<?php }?>