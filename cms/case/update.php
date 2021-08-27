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



$table = 'case_updates';
$module = 'Case Update';
$add = true;
$edit = true;
$photo_in_list = false;

$actions=array('Delete');//, 'Display', 'Hide'
$fields = array('id', 'created', 'case_id', 'title', 'image', 'video', 'description');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();



#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array('5', '1');//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}


$placeholder['title'] = 'Title for your update';
$placeholder['description'] = 'Latest happening';

$type['id'] = 'hidden';
$type['case_id'] = 'hidden';
$type['video'] = 'video';
//$type['target'] = 'number';
$type['date'] = $type['created'] = 'date';
$type['description'] = 'textarea'; $height['description'] = '120px;'; $width['description'] = '100%;'; 
//$type['video'] = 'textarea'; $height['video'] = '40px;'; $width['video'] = '100%;'; 
//$type['category'] = 'select'; $option['category'] = array(''=>'Choose case category','Family'=>'Family','Children'=>'Children','Medical'=>'Medical');
$type['image'] = 'image';

$required['title'] = $required['description'] = $required['date'] = 'required';

$cols = $items =array();
$cols = array('Update' => '2','Title' => '4','Description' => '4','Date' => '3');//Column title and width
$items['Update'] = array('image');
$items['Title'] = array('title');
$items['Description'] = array('description');
$items['Date'] = array('created');

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



</head>
<body>
<?php include("layout/top.php");?>
<div class="container-fluid">
    <div class="row">
    <?php include("layout/menu.php");?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="col-12" style=" border-bottom:1px solid #CCC; margin-bottom:30px; padding:0 0 20px 0;">
				<?php include("case.php");?>
			</div>
            <div class="col-12" style=" border-bottom:1px solid #CCC; margin-bottom:30px; padding:0 0 20px 0;">
				<?php include("layout/add_update.php");?>
			</div>
            <div class="col-12" style=" border-bottom:1px solid #CCC; margin-bottom:30px; padding:0 0 20px 0;">
				<?php include("layout/list_update.php");?>
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
</html>