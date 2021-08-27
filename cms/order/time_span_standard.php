<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
//include '../layout/savelog.php';

session_start();
if($_SESSION['validation']=='YES' && (@$_SESSION[group_id] == '1' || @$_SESSION[group_id] == '2')){
}else{
	header("Location:../authentication/login.php");
}

$table = 'time_span_standard';
$module_name = 'Time Span Standard (hours)';
$php = 'time_span_standard';
$add = false;
$edit = true;
$list_method = 'list';

$keyword = true;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'username');

$actions=array('Delete');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');

$unique_validation=array('username');


//accept
//delivered


$fields = array('id', 'january', 'february', 'march', 'april', 'may', 'jun', 'july', 'august', 'september', 'october', 'november', 'december');


$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('5', '4', '4'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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


$type['id'] = 'hidden';
$type['password'] = 'password';
//$type['position'] = 'number';
//$type['publish_date'] = 'date';
//$type['address'] = 'textarea'; $tinymce['address']=false;  $labelFullRow['address']=false; $height['address'] = '80px;'; $width['address'] = '100%;'; 
$type['notify_when_confirmed'] = 'radio'; $option['notify_when_confirmed'] = array('Yes'=>'Yes', 'No'=>'No');
$type['notify_when_accepted'] = 'radio'; $option['notify_when_accepted'] = array('Yes'=>'Yes', 'No'=>'No');
$type['notify_when_receipt'] = 'radio'; $option['notify_when_receipt'] = array('Yes'=>'Yes', 'No'=>'No');
$type['notify_when_delivered'] = 'radio'; $option['notify_when_delivered'] = array('Yes'=>'Yes', 'No'=>'No');

$type['status'] = 'select'; $option['status'] = array('1'=>'Activated','0'=>'Suspended'); $default_value['status'] = '1';


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
$cols = array('Email' => '4', 'Notify when Confirmed' => '2', 'Notify when Accepted' => '2', 'Notify when Receipt' => '2', 'Notify when Delivered' => '2');//Column title and width
$items['Email'] = array('email');
$items['Notify when Confirmed'] = array('notify_when_confirmed');
$items['Notify when Accepted'] = array('notify_when_confirmed');
$items['Notify when Receipt'] = array('notify_when_confirmed');
$items['Notify when Delivered'] = array('notify_when_delivered');

$cols = $items =array();
$cols = array('Email' => '6', 'Notify Status' => '6');//Column title and width
$items['Email'] = array('email');
$items['Notify Status'] = array('notify_status');


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
label {
	width:40%;
	text-transform:capitalize;	
}
.div_input {
	width:30%;
}
</style>


</head>
<body>



<div class="row">
	<?php if($add==true || $_GET['id']){?>
	<div class="col-12">
		<?php include '../layout/add.php';?>
	</div>
	<?php }?>
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