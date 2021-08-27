<? 
require_once '../../config/ini.php'; 
require_once('../../config/str_convert.php');
require_once '../../config/image.php';

if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

$table = 'child_files';
$module_name = 'Files';
$php = 'child_files.php';
$add = true;
$edit = true;
$duplicate = false;
$list_method = 'block';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name');
$filter = false;
$filFields = array();


$actions=array('Delete');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');

$unique_validation=array('name');

$fields = array('id', 'name', 'file');
//, '360_image'
$value = array();
$type = array();
$width = array();//width for input field

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(
	0=>array('2', '1'), 
	//1=>array('12', '5'),
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
//$type['position'] = 'number';
//$type['publish_date'] = 'date';
//$type['project_information'] = 'textarea'; $tinymce['project_information']=true;  $labelFullRow['project_information']=true; $height['project_information'] = '420px;'; $width['project_information'] = '100%;'; 
$type['position'] = 'number';
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide');


/*
$type['month'] = 'select';
for ($y=(date('Y')-1); $y<=(date('Y')+1); $y++) {
	for ($m=1; $m<=12; $m++) {
		$option['month'][$y.'-'.date('m', mktime(0,0,0,$m, 1, date('Y'))).'-01'] = date('M', mktime(0,0,0,$m, 1, date('Y'))).' '.$y;
	}
}*/



//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');
$type['file'] = 'image';
//$type['360_video'] = 'video'; 

$attributes['name'] = array('required' => 'required'); //placeholder
/*$attributes['price_from'] = array('step' => '.01', 'placeholder'=>'RM'); 
$attributes['itinerary'] = array('placeholder'=>'PDF'); 

echo '<div style="margin-left:20%;">';
foreach((array)$fields as $field){
	echo $field;
	echo $width[$field];
	echo '<br>';
	print_r($fic_1);
}
echo '</div>';*/

$cols = $items =array();
$cols = array('Photo' => '12');//Column title and width
$items['Photo'] = array('file', 'name');


//$items['Programme'] = array('programme','experience','experience_detail');
//$items['Condition'] = array('illnesses','bankrupt','court');



?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>WELCOME TO CONTENT MANAGEMENT SYSTEM</title>

<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
<link href="../css/medium.css" rel="stylesheet">
<link href="../../css/bootstrap-icon.css" rel="stylesheet">



<!--For date picker use - start -->
<link rel="stylesheet" href="<?=$root_dir?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?=$root_dir?>js/datepicker/style.css">
<script src="<?=$root_dir?>js/datepicker/jquery-1.12.4.js"></script>
<script src="<?=$root_dir?>js/datepicker/jquery-ui.js"></script>
<script src="../../js/general.js"></script>

<script>
$( function() {
    $( ".datepicker" ).datepicker({ /*minDate: +7,*/ maxDate: "+6M +1D", dateFormat: 'dd/mm/yy' });
} );
</script>
<!--For date picker use - end -->
<style>
label {
	width:30%;
	text-transform:capitalize;	
}
.div_input {
	width:70%;
}
</style>


</head>
<body class="nopadding" style="overflow-x:hidden;" >
<div class="container-fluid nopadding">
    <div class="row nopadding">
		<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 main" style="background:#F8F8F8;padding-top:0;">
            <? if($add==true || $_GET['id']){?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding" style="margin-bottom:30px;">


				<script src="../../js/jquery.min.js"></script>
				<script src="../js/img_upload.js"></script>
                <?
                
					if($_POST['add'] == 'Add'){
						
						$save = '<span style="color:red;">Data not saved.</span>';
						
						$_POST['belong'] = $_GET['belong'];
						
						unset($_POST['id']);
						if(saveData($table, $_POST)){
							$j = readFirst($pamconnection, $table, "", 'id DESC');	
							$id = $j['id'];
								foreach((array)$_FILES as $img_field => $v){
									if($_FILES[$img_field]['name']!=''){
										$img->upload_image($_FILES[$img_field], $table, $img_field, $id);
								}
							}
							unset($id);
							$save = '<span style="color:green;">Data added.</span>';
						}
					}
					?>
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding">
                    <h3 style="line-height:0.6; padding-top:0;">
                        Add <? echo $module_name;?>
                    </h3>
                </div>
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding" style="margin-top:12px; <? if($type[$field]=='hidden'){?> display:none;<? }?>">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom:10px; text-align:left;">
                               <? if($_GET['id'] && !empty($value[$field])){//Remove feature only available when edit mode?>
                                 <img src="../../<?=$value[$field]?>" class="img-responsive" id="previewing" alt="" 
                                 style="max-height:70px; max-width:120px;">
                                <div class="col">
                                    <div class="btn btn-sm " onClick="removeImg('<?=$table?>', '<?=$id?>', '<?=$field?>')">
                                    <span class="glyphicon glyphicon-remove" style="color:red; cursor:pointer;"></span>
                                    Remove</div>
                                    <script>
                                    function removeImg(table, id, field){
                                        $.post( "../layout/remove_img.php", {table:table, id:id, field:field}, function( result ) {
                                            $("#img"+field).fadeOut();
                                        });
                                    }
                                    </script>
                                </div>
                                <? }else{?>
                                    <? if($type[$field] == 'image'){?>
                                        <div id="img<?=$field?>"><!--class="def_img_bg" -->
                                            <img src="../../images/default_img.jpg" class="img-responsive" id="previewing<?=$field?>" 
                                            alt="" style="max-height:70px; max-width:120px;">
                                              <!--<span class="glyphicon glyphicon-picture" style="font-size:30px; color:#ccc;"></span>-->
                                        </div>
                                    <? }elseif($type[$field] == 'video'){?>
                                        <div style="border:1px solid red; padding:6px 18px 8px 12px; width:43px; border-radius:4px; border:1px solid #D9686B;">
                                            <span class="glyphicon glyphicon-play" style="color:#D9686B; font-size:20px;"></span>
                                        </div>
                                    <? }elseif($type[$field] == 'pdf'){?>
                                        <img src="../images/pdf.png" width="50px"></span>
                                    <? }?>
                                <? }?>
                                
                                <div class="col">
                                    <input name="<?=$field?>" type="file" value="<?=$value[$field]?>" <? if(empty($_GET['id'])){ echo $required[$field]; }?>
                                    id="imgfile<?=$field?>" 
                                    accept="
                                    <? if($type[$field] == 'image'){?>
                                        .png,.gif,.jpg,.jpeg
                                    <? }elseif($type[$field] == 'video'){?>
                                        .webm,.mkv,.flv,.vob,.avi,.wmv,.mov,.rmvb,.mp4,.mpg
                                    <? }elseif($type[$field] == 'pdf'){?>
                                        .pdf
                                    <? }?>" style=" <?=$styles?>"> 
                                    
                                    <script>                                
                                    $("#imgfile<?=$field?>").change(function() {
                                       var file = this.files[0];
                                       var imagefile = file.type;
                                       var extmatch = ["image/jpeg","image/png","image/jpg","image/gif"];
                                                    
                                       if(!((imagefile==extmatch[0]) || (imagefile==extmatch[1]) || (imagefile==extmatch[2]))){
                                          return false;
                                       }else{
                                          var reader = new FileReader();
                                          reader.onload = imageIsLoaded;
                                          reader.readAsDataURL(this.files[0]);
                                       }
                                    });
                                                
                                    function imageIsLoaded(e) {
                                        $('#previewing<?=$field?>').attr('src', e.target.result);
                                        $('#previewing<?=$field?>').attr('width', '250px');
                                        $('#previewing<?=$field?>').attr('height', '230px');
                                    };
                                    </script>  
                                    
                                                                  
                                </div>
                                <div class="col">
                                    <input type="submit" name="add" value="Add" class="btn btn-primary" >
                                    <? if($save){echo $save;}?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-top:1px solid #CCC; border-bottom:1px solid white; height:0; padding-bottom:0;">&nbsp;</div>
            <? }?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom:30px; padding:0 0 20px 0; ">
				<? include("../layout/list.php");?>
			</div>
		</div>
    </div>
</div>
</body>

<script>

function chkAll(frm, arr, mark){
  for (i = 0; i <= frm.elements.length; i++)
  {
   try
   {
     if(frm.elements[i].name == arr)
	 {
       frm.elements[i].checked = mark;
     }
   } catch(er) {}
  }
}
</script>


<script type="text/javascript" src="<?=ROOT_R?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?=ROOT_R?>js/layout.js"></script>



</html>