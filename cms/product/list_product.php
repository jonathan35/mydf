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
$php = 'list_product';
$edit_php = 'add_product';
$more_photos = true;


if($_POST['action'] == 'Delete'){
	
	foreach((array)$_POST['productIdList'] as $k => $id){		
		$p_uom = sql_read("select id from uom where product=?",'s',$id);		
		if(@count($p_uom)){
			foreach((array)$p_uom as $a){
				sql_exec("delete from stock_promo where uom=?",'s',$a['id']);
			}
			sql_exec("delete from uom where product=?",'s',$id);
		}
	}

}


if($_SESSION['group_id'] == '1'){

	$add = false;
	$edit = true;
	$list_method = 'list';
	$delete_in_row = true;
	
	$keyword = false;//Component to search by keyword
	$keywordMustFullWord=false;
	$keywordFields=array('name', 'username');
	$filter = true;
	$filFields = array('region', 'category', 'sub_category');
	
	$actions=array('Delete', 'Display', 'Hide');//, 'Display', 'Hide'
	$msg['Delete']='Are you sure you want to delete?';
	$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
	$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
	$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
	$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');
	$msg['Popular']='Are you sure you want to set as popular?';	$db['Popular']=array('popular', 'Yes');
	$msg['Not Popular']='Are you sure you want to set as not popular?';	$db['Not Popular']=array('popular', 'No');


}else{

	$add = false;
	$edit = true;
	$list_method = 'list';
	$delete_in_row = false;

	$keyword = false;//Component to search by keyword
	$keywordMustFullWord=false;
	$keywordFields=array('name', 'username');
	$filter = true;
	$filFields = array('category', 'sub_category');
	
	$actions=array();

	$lo = sql_read('select * from location where id =?' , 's', $_SESSION['location']);

	
	
}
$unique_validation=array();


$fields = array('id', 'region', 'brand', 'category', 'sub_category', 'sku', 'product_name', 'position', 'status', 'seo_title', 'seo_keyword', 'seo_description', 'viewed');
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

$type['brand'] = 'select'; $option['brand'] = array();
$results = sql_read('select * from brand where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['brand'][$a['id']] = ucwords($a['brand']);
}

$type['category'] = 'select'; $option['category'] = array();
$results = sql_read('select * from category where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['category'][$a['id']] = ucwords($a['category']);
}

$type['sub_category'] = 'select'; $option['sub_category'] = array();
$results = sql_read('select * from sub_category where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['sub_category'][$a['id']] = ucwords($a['sub_category']);
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
$cols = array('SKU' => '1', 'Product Description' => '2', 'Region' => '2', 'Brand' => '2', 'Category' => '2', 'Sub Category' => '2', 'Viewed' => '1');//Column title and width
$items['SKU'] = array('sku');
$items['Product Description'] = array('product_name');
$items['Region'] = array('region');
$items['Brand'] = array('brand');
$items['Category'] = array('category');
$items['Viewed'] = array('viewed');
$items['Sub Category'] = array('sub_category');





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
		<!--<style>
		.add_photo {
			float:right; font-size:14px; border:3px solid #afdb00; border-radius:26px; padding:8px 30px; cursor:pointer; transition:background .4s; background:#EFEFEF;
		}
		.add_photo:hover {background:#afdb00;}
		</style>
		<div class="add_photo mymodal-btn" link="../product/add_product.php">
			Add <?php echo $module_name?>
		</div>-->
	</div>
</div>
<div class="row">
	<div class="col-12">
		<?php include '../layout/list.php';?>
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