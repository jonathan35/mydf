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



$table = 'donations';
$module = 'Donations collected';
$fields = array('id', 'individual_organisation', 'donation_type', 'amount', 'date', 'donor_name', 'donor_message');
$value = array();
$type = array();
$width = array();//width for input field
$actions = array("Delete");
$msg["Delete"] = 'Are you sure to delete?';

$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array('5', '3');//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}
$placeholder['donor_name'] = 'Leave empty for anonymous';

$type['id'] = 'hidden';
$type['amount'] = 'number';
$type['date'] = 'date';
$type['donor_message'] = 'textarea'; $height['donor_message'] = '110px;'; $width['donor_message'] = '100%;'; 
$type['donation_type'] = 'select'; $option['donation_type'] = array(
	'Donate to Help Someone in Need'=>'Donate to Help Someone in Need','Give Monthly'=>'Give Monthly','Make a One-Time Donation'=>'Make a One-Time Donation',
	'Make a Gift Donation'=>'Make a Gift Donation','Give Monthly – To Celebrate the Memory of Someone Special'=>'Give Monthly (Memory)',
	'Memorial gift'=>'One-Time Donation (Memory)',
	'Workplace Giving'=>'Workplace Giving','Corporate Matching Gift'=>'Corporate Matching Gift'
);
$type['individual_organisation'] = 'select'; $option['individual_organisation'] = array('individual'=>'individual','organisation'=>'organisation');
$type['image'] = 'image';

$required['title'] = $required['donation_type'] = 'required';

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
$cols = array('Donation date' => '3', 'Donor name' => '3', 'Donor message' => '3', 'Amount' => '3');//Column title and width
$items['Donor date'] = array('created');
$items['Donor name'] = array('donor_name');
$items['Donor message'] = array('donor_message');
$items['Amount'] = array('amount');
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
label {width:40%;}
.div_input {width:60%;}
</style>
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
				<?php include("add_donation.php");?>
			</div>
            <div class="col-12" style=" border-bottom:1px solid #CCC; margin-bottom:30px; padding:0 0 20px 0;">
				<?php include("list_donations.php");?>
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