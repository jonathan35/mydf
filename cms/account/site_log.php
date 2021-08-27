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



$table = 'visitors';
$module_name = 'Site Log';
$php = 'site_log';
$add = false;
$edit = false;
$duplicate = false;
$list_method = 'list';

$keyword = false;//Component to search by keyword
$filter = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'email');
$filFields=array('user');

$actions=array('Delete');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');

$unique_validation=array('email');

$fields = array('id', 'ip', 'user', 'country', 'action', 'created');

$value = array();
$type = array();
$width = array();//width for input field

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(
	0=>array('4','1'), 

);//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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
$type['cause_of_delay'] = 'textarea'; $tinymce['cause_of_delay']=false;  $labelFullRow['cause_of_delay']=true; $height['cause_of_delay'] = '80px;'; $width['cause_of_delay'] = '100%;'; 

  
$type['date'] = 'date'; 
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide');
$type['user'] = 'select'; $option['user'] = array();

$aa = sql_read('select * from login order by name ASC');
foreach((array)$aa as $a){
	$option['user']['login:'.$a['id']] = ucwords($a['name']).' (Admin)';
}

$bb = sql_read('select * from accounts order by company_name ASC');
foreach((array)$bb as $b){
	$option['user']['accounts:'.$b['id']] = ucwords($b['company_name']).' ('.$b['email'].')';
}


$type['month'] = 'select';
for ($y=(date('Y')-1); $y<=(date('Y')+1); $y++) {
	for ($m=1; $m<=12; $m++) {
		$option['month'][$y.'-'.date('m', mktime(0,0,0,$m, 1, date('Y'))).'-01'] = date('M', mktime(0,0,0,$m, 1, date('Y'))).' '.$y;
	}
}
/*
echo '<pre style="padding-left:20%;">';
print_r($option['month']);
echo '</pre>';
*/
//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');
$type['graph_image'] = 'image';
$type['360_video'] = 'video'; 

$attributes['project'] = array('required' => 'required'); //placeholder
$attributes['contract_sum'] = array('step' => '.01'); 
$attributes['workdone_paid_to_date'] = array('step' => '.01', 'placeholder'=>'RM'); 
$attributes['package_date'] = 'date'; 


$style['project'] = array('width' => '90%'); //placeholder
$style['project_package'] = array('width' => '100%'); //placeholder


/*
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
$cols = array('User' => '10', 'Date' => '2');//'IP' => '2', , 'Country' => '1''Action' => '1', 
$items['User'] = array('user');
$items['IP'] = array('ip');
$items['Country'] = array('country');
$items['Action'] = array('login_logout');
$items['Date'] = array('created');

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
    $( ".datepicker" ).datepicker({ /*minDate: +7,*/ maxDate: "+10Y +6M +1D", dateFormat: 'yy/mm/dd' });
} );
</script>
<!--For date picker use - end -->
<style>
label {
	width:40%;
	text-transform:capitalize;	
}
.div_input {
	width:60%;
}
</style>


</head>
<body>


<div class="row">

	<div class="col-12">
            <?php if($add==true || $_GET['id']){?>
            <div class="col-12 p-0" style="margin-bottom:30px;">
				<?php include("layout/add.php");?>
			</div>
            <div class="col-12" style="border-top:1px solid #CCC; border-bottom:1px solid white; height:0; padding-bottom:20px;">&nbsp;</div>
            <?php }?>
            <div class="col-12" style="margin-bottom:30px; padding:0 0 20px 0; ">



<?php 

if($_POST['action']=="Delete"){
	$items_delete_array=$_POST['productIdList'];
	if(!empty($_POST['productIdList'])){
		foreach((array)$items_delete_array as $items_delete){
			$target_query = mysqli_query($conn, "SELECT * FROM $table WHERE id='$items_delete'") or die(mysqli_error());
			$target = mysqli_fetch_assoc($target_query);
			
			if(!empty($target)){
				if(!empty($target)){
					@unlink('../../'.$target['image']);
				}
				mysqli_query($conn, "DELETE FROM $table WHERE id='$items_delete'") or die(mysqli_error());			
			}
		}
	}
}elseif(!empty($_POST['action'])){	
	$items_id_array=$_POST['productIdList'];
	if(!empty($_POST['productIdList'])){
		foreach((array)$items_id_array as $items_id){
			$data['id']=$items_id;
			$data[$db[$_POST['action']][0]]=$db[$_POST['action']][1];
			if(sql_save($table, $data));
		}
	}
}
	
	
include '../cms/layout/list_cond.php';

if($_POST['submit'] == 'Reset'){ $_POST['user']=$_POST['date_from']=$_POST['date_to']='';}

if(!empty($_POST['user'])){
	$condition .= " AND user ='".$_POST['user']."'";	
}
if(!empty($_POST['date_from'])){
	$condition .= " AND created >='".str_replace('/','-',$_POST['date_from'])."'";	
}
if(!empty($_POST['date_to'])){
	$condition .= " AND created <='".str_replace('/','-',$_POST['date_to'])." 23:59:59'";	
}

$condition .= " AND user NOT LIKE '%site_log.php%' ";

$sort = " order by created DESC limit 500";

$rows = sql_read('select * from '.$table.' '.$condition.' '.$condition_ext.' '.$sort, str_repeat('s',count($params)), $params);
$count = sql_count('select * from '.$table.' '.$condition.' '.$condition_ext.' '.$sort, str_repeat('s',count($params)), $params);


?>

<style>
.titleBlockInList {margin-top:4px; font-size:15px;}
.blockInList {margin-top:4px;;}
.thum {
	width:100%; height:100px; background-size:cover; background-position:center; background-repeat:no-repeat; border:1px solid #CCC;
}
.span_label { text-transform:capitalize; color:#999;}
.span_label::after { content:":"; }
<?php 
if($list_method == 'list'){
if($edit==true){?>
	.edit_column {width:82% !important;}
<?php }else{?>
	.edit_column {width:96% !important;}
<?php }
}?> 


</style>
<div class="col-12">
    <h3><?php echo $module_name;?></h3>    
    
    <form action="" method="post" enctype="multipart/form-data">
      
    <div class="row tr" style="border-bottom:1px solid #CCC; background-color:white; border-top:none; padding:10px;">
        <div class="col" style="width:5% !important;"><input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)" title="Check all item"></div>
        <?php foreach((array)$actions as $action){?><input type="submit" name="action" value="<?php echo $action?>" onClick="return confirmAction('<?php echo $msg[$action]?>');" title="<?php echo $btn?> selected item(s)"><?php }?>
    </div>
    

	<div class="row tr" style="background:#DDD; border:none; border-bottom:2px solid #999;">
		
			<div class="col-11 offset-1" style=" <?php if($edit==true){?>width:82%<?php }else{?>width:96%<?php }?> !important;">
				<div class="row">
					<?php foreach((array)$cols as $colName => $colWidth){?>
						<div class="col-<?php echo $colWidth?>"><?php echo $colName?></div>
					<?php }?>
				</div>
			</div>
	</div>
	<?php 
	if($count>0){
		
	$itemCount=1;
	$maxPerPage=50;
		if($list_method=='list'){
        foreach((array)$rows as $val){
			$c=1;?>
            <div class="row page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>">
                <div class="col-1" style="width:2% !important;">
                    <input type="checkbox" value="<?php echo $val['id']; ?>" name="productIdList[]">
                    <input type="hidden" name="id" value="<?php echo $val['id'];?>" />
                </div>
                <div class="col-11 edit_column">
					<div class="row">
					<?php foreach((array)$cols as $colName => $colWidth){?>
						
                        <div class="col-<?php echo $colWidth?>">
                            <?php foreach((array)$items[$colName] as $fieldName){?>
                              <div class="col-12" style="padding:0;">
									<?php 
									if(strpos($val[$fieldName], 'http')){
										$explodedByColon = explode(':',$val[$fieldName]);
										$exploded = explode('http',$explodedByColon[2]);
										echo $exploded[0].'<br>';
										echo '<a href="http://'.$exploded[1].'" target="_blank">http://'.$exploded[1].'</a>';
									}elseif($type[$fieldName] == 'select'){ ?>										
                                        <div class="blockInList"><?php echo $option[$fieldName][$val[$fieldName]].' '.$val['login_logout'];?></div>
                                   <?php }else{?>                              
                                        <div class="blockInList"><?php echo $val[$fieldName]?></div>
								   <?php }?>
                                   
                              </div>
							  <?php 
							$c++;
							}?>
						</div>										
					<?php }?>
					</div>
                </div>
            </div>
        <?php 
		  $itemCount++;
		  }
		}?>
        
        <?php include("../../paging.php");?>
        
	<?php }else{?>
        <table>
        	<tr><td>No record found</td></tr>
		</table>
    <?php }?>
</form>
</div>



		</div>
    </div>
</div>
</body>

<script>
function confirmAction(msg){
	var point = confirm(msg);
	if(point==true){
		var id= new Array('productIdList[]');
		if(id==''){
			alert("No Item Selected");
			return false;
		}
		return true;
	}else{
		return false;
	}
}
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

</html>