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

$table = 'product';
$module_name = 'Product';
$php = 'add_product';
$add = false;
$edit = false;
$list_method = 'list';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'username');

$actions=array('Delete', 'Display', 'Hide', 'Popular', 'Not Popular');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');
$msg['Popular']='Are you sure you want to set as popular?';	$db['Popular']=array('popular', 'Yes');
$msg['Not Popular']='Are you sure you want to set as not popular?';	$db['Not Popular']=array('popular', 'No');

$unique_validation=array();



$fields = array('id', 'region', 'brand', 'category', 'sub_category', 'sku', 'product_name', 'description', 'best_deals', 'best_sellers', 'recommended', 'position', 'status', 'seo_title', 'seo_keyword', 'seo_description');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('8', '8'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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

$type['brand'] = 'select'; $option['brand'] = array();
$results = sql_read('select * from brand where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['brand'][$a['id']] = ucwords($a['brand']);
}

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




$type['best_deals'] = 'radio';
$option['best_deals'] = array('Yes' => 'Yes', 'No' => 'No');
$type['best_sellers'] = 'radio';
$option['best_sellers'] = array('Yes' => 'Yes', 'No' => 'No');
$type['recommended'] = 'radio';
$option['recommended'] = array('Yes' => 'Yes', 'No' => 'No');


$type['id'] = 'hidden';
$type['password'] = 'password';
$type['position'] = 'number';
$type['stock'] = 'number';
//$type['publish_date'] = 'date';
$type['description'] = 'textarea'; $tinymce['description']=false;  $labelFullRow['description']=false; $height['description'] = '240px;'; $width['description'] = '100%;';
$type['seo_title'] = 'textarea'; $tinymce['seo_title']=false;  $labelFullRow['seo_title']=false; $height['seo_title'] = '80px;'; $width['seo_title'] = '100%;';
$type['seo_keyword'] = 'textarea'; $tinymce['seo_keyword']=false;  $labelFullRow['seo_keyword']=false; $height['seo_keyword'] = '80px;'; $width['seo_keyword'] = '100%;'; 
$type['seo_description'] = 'textarea'; $tinymce['seo_description']=false;  $labelFullRow['seo_description']=false; $height['seo_description'] = '80px;'; $width['seo_description'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide'); $default_value['status'] = '1';
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
$cols = array('Category' => '4', 'Sub Category' => '4', 'Product' => '4');//Column title and width
$items['Category'] = array('category');
$items['Sub Category'] = array('sub_category');
$items['Product'] = array('product');
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

<script src="<?php echo ROOT?>js/jquery-3.5.0.js"></script>



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
		<?php 
		include '../layout/add.php';
		
		
		

			if($_POST['submit'] == 'add2020' && empty($_GET['id'])){
				/*
				$uom = array();
				$fresh_product = sql_read('select id from product order by id desc limit 1');				
				$uom['product'] = $fresh_product['id'];
				$uom['region'] = $fresh_product['region'];

				sql_save('uom', $uom);*/
			}

		
		
		?>
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