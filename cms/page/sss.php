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

$table = 'url_page';
$module_name = 'Header Page';
$php = 'url_page';
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = " order by position ASC";

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'username');
$filter = true;
$filFields = array('display_section');

$actions=array('Delete', 'Display', 'Hide');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');

$unique_validation=array();


$fields = array('id', 'title', 'url', 'position', 'status', 'url_type', 'open_method', 'display_section', 'display_at_home_page', 'display_at_user_page', 'display_under_category');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('5', '6'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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


$attributes['url'] = array('placeholder' => 'https://google.com, folder/file_name.html');

$type['id'] = 'hidden';
$type['password'] = 'password';
$type['position'] = 'number';
//$type['publish_date'] = 'date';
//$type['address'] = 'textarea'; $tinymce['address']=false;  $labelFullRow['address']=false; $height['address'] = '80px;'; $width['address'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide'); $default_value['status'] = '1';
$type['url_type'] = 'select'; $option['url_type'] = array('Absolute URL'=>'Absolute URL (https://google.com)','Relative URL'=>'Relative URL (folder/file_name.html)'); $default_value['url_type'] = '1';

$type['open_method'] = 'select'; $option['open_method'] = array('Open as new window'=>'Open as new window','Open in current window'=>'Open in current window'); $default_value['open_method'] = '1';
$type['display_section'] = 'select'; $option['display_section'] = array('Header'=>'Header','Footer'=>'Footer','Footer (Copyright)'=>'Footer (Copyright)'); $default_value['display_section'] = 'Header';
$type['display_under_category'] = 'select'; $option['display_under_category'] = array('Knowledge Centre'=>'Knowledge Centre','Support'=>'Support','About KuchingGiG'=>'About KuchingGiG'); $default_value['display_under_category'] = 'Header';

$type['display_at_home_page'] = 'radio'; $option['display_at_home_page'] = array('No'=>'No','Yes'=>'Yes'); $default_value['display_at_home_page'] = 'No';
$type['display_at_user_page'] = 'radio'; $option['display_at_user_page'] = array('No'=>'No','Yes'=>'Yes'); $default_value['display_at_user_page'] = 'No';


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
$cols = array('Title' => '3', 'Url_type' => '3', 'Url' => '4', 'Position' => '2');//Column title and width
$items['Title'] = array('title');
$items['Url_type'] = array('url_type');
$items['Url'] = array('url');
$items['Position'] = array('position');
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
<?php include("layout/top.php");?>
<div class="container-fluid">
    <div class="row">
    <?php include("layout/menu.php");?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="background:#F8F8F8;">
            <?php if($add==true || $_GET['id']){?>
			<div class="col-12" style="margin-bottom:30px; ">
			<div style="color:red; padding:20px 0 20px 0 ;">
				*Requirement: For relative url type, upload .html file through Cpanel and enter relative URL here, example like <u>folder_name/file_name.html</u>
				</div>
				<?php include("layout/add.php");?>
123
				<div id="sss">sss</div>

				<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
                
                <script>
				$("#sss").fadeOut(1000);

				</script>
                <script>
				$(document).ready(function(){
					var opt = $("select[name=display_section]").val();
					
					if(opt == 'Header'){
						display_section_header();
					if(opt == 'Footer'){
						display_section_header();
					} else {
						display_section_copyright();
					}
				});


				$("select[name=display_section]").change(function(){ 
					alert();
					var opt = $(this).val();
					if(opt == 'Header'){
						display_section_header();
					if(opt == 'Footer'){
						display_section_header();
					} else {
						display_section_copyright();
					}				
				});

				function display_section_header(){					
					$('.display_at_home_page').fadeIn('fast');
					$('.display_at_user_page').fadeIn('fast');
					$('.display_under_category').fadeOut('fast');
				}

                function display_section_footer(){
					$('.display_under_category').fadeIn('fast');
					$('.display_at_home_page').fadeOut('fast');
					$('.display_at_user_page').fadeOut('fast');				
				}	               

				function display_section_copyright(){					
					$('.display_under_category').fadeOut('fast');
					$('.display_at_home_page').fadeOut('fast');
					$('.display_at_user_page').fadeOut('fast');						
				}

				
                </script>


				<?php if(!empty($id) && $value['display_section']=='Header'){?>
                	<script>$(function(){display_section_header();});</script>
                <?php }elseif(!empty($id) && $value['display_section']=='Footer'){?>
					<script>$(function(){display_section_footer();});</script>
				<?php }elseif(!empty($id) && $value['display_section']=='Footer (Copyright)'){?>
					<script>$(function(){display_section_copyright();});</script>
                <?php }?>


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

$("input[name='url']").on('keyup', function(){
	var v = $("input[name='url']").val();
	var v = v.replace('https://','');
	var v = v.replace('http://','');
	$("input[name='url']").val(v);

});


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