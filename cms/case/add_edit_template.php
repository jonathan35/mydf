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



$id = base64_decode($_GET['id']);
$case_id = base64_decode($_GET['case']);
$table = 'case_update';
$module = 'Update of Case';
$fields = array('id', 'case_id', 'title', 'image', 'video', 'description', 'date', 'created', 'modified');
$value = array();
$type = array();
$placeholder = array();

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}


$placeholder['title'] = 'Title of update';
$placeholder['video'] = 'youtube or vimeo link';
$placeholder['description'] = 'Latest happening';

$type['id'] = 'hidden';
$type['case_id'] = 'hidden';
//$type['target'] = 'number';
$type['date'] = 'date';
$type['description'] = 'textarea';
//$type['category'] = 'select'; $option['category'] = array(''=>'Choose case category','Family'=>'Family','Children'=>'Children','Medical'=>'Medical');
$type['image'] = 'image';

$required['title'] = $required['description'] = $required['date'] = 'required';

/*if(empty($id)){
	$required['photo01'] = 'required';
}*/


if(empty($id)){//add mode
	$data = array();

	if(!empty($_SESSION['user_id'])){
		$value['creator_id'] = $_SESSION['user_id'];
	}
	if($_POST){
		$_POST['creator_id'] = $_SESSION['user_id'];
		$_POST['verification'] = date("Y-m-d h:i:s");
		$_POST['created'] = date("Y-m-d h:i:s");
		$_POST['modified'] = date("Y-m-d h:i:s");
		$_POST['verification'] = 'verified';
		
		
		if($_POST['end_date']){
			$_POST['end_date'] = date("Y-m-d", strtotime(substr($_POST['end_date'],3,2).'/'.substr($_POST['end_date'],0,2).'/'.substr($_POST['end_date'],6,4)));
		}
		
		unset($_POST['id']);
		if(sql_save($table, $_POST)){
			$j = readFirst($conn, 'cases', "", 'id DESC');	
			$id = $j['id'];
			foreach((array)$_FILES as $img_field => $v){
				if($_FILES[$img_field]['name']!=''){
					$msg = $img->upload_image($_FILES[$img_field], $table, $img_field, $id);
				}
			}
		}
	}
}else{//edit mode

	if($_POST){
		foreach((array)$_FILES as $img_field => $v){
			if($_FILES[$img_field]['name']!=''){
				$msg = $img->upload_image($_FILES[$img_field], $table, $img_field, $id);
			}
		}
		$_POST['modified'] = date("Y-m-d h:i:s");
		sql_save($table, $_POST);	
	}
	
	$condition = " id = '".$id."'";
	$order = '';
	$data = readFirst($conn, 'cases', $condition, $order);	
	if(!empty($data)){
		foreach((array)$fields as $field){
			if(!empty($data[$field])){
				$value[$field] = $data[$field];
			}
		}
	}
		
}
?>



<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
<link href="../../css/simple_form.css" rel="stylesheet">
<link href="../../css/backend.css" rel="stylesheet">
<link href="../../css/bootstrap-icon.css" rel="stylesheet">

<!--For date picker use - start -->
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/style.css">
<script src="<?php echo ROOT?>js/datepicker/jquery-1.12.4.js"></script>
<script src="<?php echo ROOT?>js/datepicker/jquery-ui.js"></script>
<script>
$( function() {
    $( ".datepicker" ).datepicker({ minDate: +7, maxDate: "+6M +1D", dateFormat: 'dd/mm/yy' });
} );
</script>    
<!--For date picker use - end -->



<style>
input {width:300px;}
textarea {width:100%; min-height:500px;}

</style>

</head>
<body>
<?php include("layout/top.php");?>
<div class="container-fluid">
    <div class="row">
    <?php include("layout/menu.php");?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10"><h3><?php echo $module;?></h3></div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="text-align:right;"><a class="btn btn-sm btn-default" href="cases.php">Back to listing</a></div>
            <form action="" method="post" enctype="multipart/form-data">
        
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <?php 
				$c = 0;
				foreach((array)$fields as $field){
					$c++;?>
                    
                	<?php if($c==20){?></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php }?>
                    <div style="margin-top:4px;">
                        <?php if($type[$field] != 'hidden'){?><label><?php echo $str_convert->field_to_label($field)?></label><?php }?>
                        <?php if($type[$field] == 'select'){?>
                        	<select name="<?php echo $field?>" <?php echo $required[$field]?>>
								<?php foreach((array)$option[$field] as $option_v => $option_name){?>
                                <option value="<?php echo $option_v?>" <?php if($value[$field] == $option_v){?> selected <?php }?>><?php echo $option_name?></option>
                                <?php }?>
                       		</select>
                        <?php }elseif($type[$field] == 'date'){?>
                            <input name="<?php echo $field?>" type="text" class="datepicker" value="<?php echo $value[$field]?>" <?php echo $required[$field]?>> 
                        <?php }elseif($type[$field] == 'image'){?>
                        	<div class="col-12">
                            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <div class="def_img_bg" id="img<?php echo $field?>">
                                    	<img src="../../<?php echo $value[$field]?>" class="img-responsive" alt="" >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <div class="btn btn-sm "><span class="glyphicon glyphicon-remove" style="color:red; cursor:pointer;" 
                                    onClick="removeImg('cases', '<?php echo $id?>', '<?php echo $field?>')"></span>Remove</div>
									<script>
                                    function removeImg(table, id, field){
                                        $.post( "/rohi.sg/cms/case/remove_img.php", {table:table, id:id, field:field}, function( result ) {
                                            $("#img"+field).fadeOut();
                                        });
                                    }
                                    </script>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <input name="<?php echo $field?>" type="file" value="<?php echo $value[$field]?>" <?php echo $required[$field]?>> 
                                </div>
                            </div>
                        <?php }elseif($type[$field] == 'textarea'){?>
                        	<div>
                            <textarea name="<?php echo $field?>" placeholder="<?php echo $placeholder[$field]?>" <?php echo $required[$field]?>><?php echo $value[$field]?></textarea>
                            </div>
						<?php }else{?>
                            <input type="<?php echo $type[$field]?>" name="<?php echo $field?>" value="<?php echo $value[$field]?>" placeholder="<?php echo $placeholder[$field]?>" <?php echo $required[$field]?>>
						<?php }?>
                        
                        
                    </div>
                    
                <?php }?>
                </div>
                <div class="col-12" style="text-align:center;">
				<input type="submit" value="Save" name="save">
                </div>
            </form>
		</div>
    </div>
</div>
</body>

</html>