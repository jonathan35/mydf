<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}
require_once('../../config/str_convert.php');
require_once '../../config/image.php';
//include '../cms/layout/savelog.php';



$table = 'passkeys';
$module_name = 'Passkey';
$php = 'passkey';
$add = true;
$edit = true;
$list = true;
$list_method = 'list';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('passkey');

$actions=array('Delete');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');

$unique_validation=array('email');


$fields = array('id', 'passkey');
$value = array();
$type = array();
$width = array();//width for input field

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('2','1'));
//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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
$type['position'] = 'number';
//$type['publish_date'] = 'date';
//$type['address'] = 'textarea'; $tinymce['address']=false;  $labelFullRow['address']=false; $height['address'] = '80px;'; $width['address'] = '100%;'; 
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide');
$type['account_id'] = 'checkbox'; $option['account_id'] = array();
$accounts = readData($conn, 'accounts', "status='1'", 'company_name ASC');
foreach((array)$accounts as $a){
	$option['account_id'][$a['id']] = ucwords($a['company_name']);
}


//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');
//$type['graph_image'] = 'image';
//$type['360_video'] = 'video'; 
/*
$attributes['title'] = array('required' => 'required'); //placeholder
$attributes['actual'] = array('step' => '.01', 'placeholder'=>'%'); 
$attributes['schedule'] = array('step' => '.01', 'placeholder'=>'%'); 
$attributes['variance'] = array('step' => '.01', 'placeholder'=>'%'); 
$attributes['days'] = array('step' => '.01'); 
$attributes['spi'] = array('step' => '.01'); 
$attributes['cps'] = array('step' => '.01', 'placeholder'=>'%'); 
$attributes['value'] = array('step' => '.01', 'placeholder'=>'RM'); 


if(empty($id)){
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
echo '</div>';*/

$cols = $items =array();
$cols = array('Passkey' => '12');
$items['Passkey'] = array('passkey');





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
	width:35%;
	text-transform:capitalize;	
}
.div_input {
	width:65%;
}
</style>


</head>
<body>
<?php include("layout/top.php");?>
<div class="container-fluid">
    <div class="row">
    <?php include("layout/menu.php");?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="background:#F8F8F8;">
            <?php if($add==true || $_GET['id']){?>
            <div class="col-12 p-0" style="margin-bottom:30px;">
				<?php include("layout/add.php");?>
			</div>
            <div class="col-12" style="border-top:1px solid #CCC; border-bottom:1px solid white; height:0; padding-bottom:20px;">&nbsp;</div>
            <?php }?>
            <div class="col-12" style="margin-bottom:30px; padding:0 0 20px 0; ">
				<?php include("layout/list.php");?>
			</div>
		</div>
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