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



$table = 'subscribe';
$module_name = 'Subscriber';
$php = 'subscriber';
$add = false;
$edit = true;
$export = true;
$photo_in_list = false;

$keyword = true;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array("first_name", "last_name", "email");

$actions=array('Delete');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');



$fields = array('id', 'first_name', 'last_name', 'email', 'status');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array('3', '2');//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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


$placeholder['title'] = 'Title for your news update';
$placeholder['post_content'] = 'Description for your news update';


$type['id'] = $type['position'] = 'hidden';
//$type['target'] = 'number';
//$type['publish_date'] = 'date';
//$type['post_content'] = 'textarea'; $tinymce['post_content']=true;  $labelFullRow['post_content']=true; $height['post_content'] = '300px;'; $width['post_content'] = '100%;'; 
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','0'=>'Not display');
//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');
//$type['thumbnail_photo'] = 'image';

$required['title'] = $required['thumbnail_photo'] = $required['post_content'] = 'required';


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
$cols = array('Name' => '4','Email' => '5');//Column title and width
$items['Name'] = array('first_name', 'last_name');
$items['Email'] = array('email');
?>



<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
<link href="../css/medium.css" rel="stylesheet">
<!--<link href="../css/medium.css" rel="stylesheet">-->
<link href="../../css/bootstrap-icon.css" rel="stylesheet">

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
	width:25%;
	text-transform:capitalize;	
}
.div_input {
	width:75%;
}

</style>
</head>
<body>
<?php include("layout/top.php");?>
<div class="container-fluid">
    <div class="row">
    <?php include("layout/menu.php");?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php if($export==true){?>
            <div class="col-12" style=" padding:0; text-align:right;">
                <form id="export" action="layout/export.php" target="_new"  method="post" enctype="multipart/form-data" style="margin-bottom:0;">
                    <input type="hidden" name="table" value="<?php echo $table?>">
                <button type="submit" form="export" value="Submit" style="padding:3px 10px;"><span class="glyphicon glyphicon-save"></span> Export CSV</button>
                </form>
			</div>
            <?php }?>
            <?php if($add==true || $_GET['id']){?>
            <div class="col-12" style="margin-bottom:30px; padding:0 0 20px 0;">
				<?php include("layout/add.php");?>
			</div>
            <?php }?>
            <div class="col-12" style="margin-bottom:30px; padding:0 0 20px 0;">
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