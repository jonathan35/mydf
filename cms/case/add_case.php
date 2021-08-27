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
$table = 'cases';
$module = 'Case';
$fields = array(
	'id', 'title', 'created', 'target', 'end_date', 'category', 'embed_video',
	'photo01', 'photo02', 'photo03', 'photo04', 'photo05', 'photo06', 'photo07', 'photo08', 'photo09', 'photo10', 
	'fundraising_for', 'funds_banked_to', 'campaign_creator', 'creator_email', 'creator_message',
	'description',  'facebook', 'twitter', 'instagram', 'youtube', 'google', 'linkedin', 'pinterest', 'seo_description', 'seo_keyword'
);   //'actual', 'donations', 'creator_id','shares', 'donations','actual', 'status',, 'created', 'modified', 'payment_status', 'verification' 'brief', 
$value = array();
$type = array();
$placeholder = array();

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}

$value['created'] = date('d/m/Y');

if(empty($value['funds_banked_to'])){
	$value['funds_banked_to'] = 'CADPIS';
}


$placeholder['title'] = 'Campaign title';
$placeholder['embed_video'] = 'youtube or vimeo link';
$placeholder['facebook'] = 'www.facebook.com/pagename';
$placeholder['twitter'] = 'www.twitter.com/name';
$placeholder['instagram'] = 'www.instagram.com/name';
$placeholder['youtube'] = 'www.youtube.com/channel/channel_id';
$placeholder['google'] = 'www.plus.google.com/123456789012345678901';
$placeholder['linkedin'] = 'www.linkedin.com/company/0000';
$placeholder['pinterest'] = 'www.pinterest.com/name';
$placeholder['actual'] = 'Temporary actual donated amount';
$placeholder['donations'] = 'Number of donations';

$type['id'] = 'hidden';
$type['target'] = 'number';
$type['title'] = 'unique';
$type['end_date'] = $type['created'] = 'date';
$type['description'] = $type['seo_description'] = $type['seo_keyword'] = 'textarea'; $tinymce['description']=true;
$type['category'] = 'select'; 
$type['embed_video'] = 'video';
$categories = readData($conn, "category", " status ='1' ", "position ASC");
$option['category'][] = 'Choose category';
foreach((array)$categories as $category){
	$option['category'][$category['category_title']] = $category['category_title'];
}
$type['photo01'] = $type['photo02'] = $type['photo03'] = $type['photo04'] = $type['photo05'] = 
$type['photo06'] = $type['photo07'] = $type['photo08'] = $type['photo09'] = $type['photo10'] = 'image';
$required['title'] = $required['fundraising_for'] = $required['target'] = $required['end_date'] = 
$required['category'] = $required['story'] = 'required';

if(empty($id)){
	$required['photo01'] = 'required';
}


if($_POST['save'] == 'Save'){
	$result='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
			<strong>Failed to create case, please try later.</div>';
}

if(empty($id)){//add mode
	$data = array();

	if(!empty($_SESSION['user_id'])){
		$value['creator_id'] = $_SESSION['user_id'];
	}
	if($_POST['save'] == 'Save'){
		
		$exist = countData($conn, "cases", "title='".mysqli_real_escape_string($conn, $_POST['title'])."' AND id !='".$id."' ");
		
		$exist = 0;
		if($exist==0){
			$_POST['creator_id'] = '0';//$_SESSION['user_id'];this id from "login" table not "account" table.
			$_POST['payment_status'] = 'CADPIS';
			$_POST['verification'] = date("Y-m-d h:i:s");
			$_POST['created'] = substr($_POST['created'],6,4).'-'.substr($_POST['created'],3,2).'-'.substr($_POST['created'],0,2)." ".date("H:i:s");
			$_POST['modified'] = date("Y-m-d h:i:s");
			$_POST['verification'] = 'verified';
			$_POST['end_date'] = substr($_POST['end_date'],6,4).'-'.substr($_POST['end_date'],3,2).'-'.substr($_POST['end_date'],0,2)." ".date("H:i:s");
			unset($_POST['id']);
			if(sql_save($table, $_POST)){
				$j = readFirst($conn, 'cases', "", 'id DESC');	
				$id = $j['id'];
				foreach((array)$_FILES as $img_field => $v){
					if($_FILES[$img_field]['name']!=''){
						$msg = $img->upload_image($_FILES[$img_field], $table, $img_field, $id);
					}
				}
				$result='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						<strong>Case created. </strong>.</div>';
			}
		}else{
			$result='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
					<strong>Failed to create case, invalid case title. </strong>.</div>';
			
		}
	}
}else{//edit mode

	$_POST['modified'] = date("Y-m-d h:i:s");
	$_POST['created'] = date("Y-m-d", strtotime(substr($_POST['created'],3,2).'/'.substr($_POST['created'],0,2).'/'.substr($_POST['created'],6,4)))." ".date("H:i:s");
	$_POST['end_date'] = date("Y-m-d", strtotime(substr($_POST['end_date'],3,2).'/'.substr($_POST['end_date'],0,2).'/'.substr($_POST['end_date'],6,4)));
	if($_POST['save'] == 'Save'){
		foreach((array)$_FILES as $img_field => $v){
			if($_FILES[$img_field]['name']!=''){
				$msg = $img->upload_image($_FILES[$img_field], $table, $img_field, $id);
			}
		}
		$_POST['modified'] = date("Y-m-d h:i:s");
		if(sql_save($table, $_POST)){
			$result='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
					<strong>Case created. </strong>.</div>';
		}
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
	
	//Convert date to singapore standard	
	if(!empty($id)){
		if(!empty($value['created']) && $value['created'] != '0000-00-00 00:00:00' ){
			$value['created'] = substr($value['created'],8,2).'/'.substr($value['created'],5,2).'/'.substr($value['created'],0,4);
		}
		if(!empty($value['end_date']) && $value['end_date'] != '0000-00-00' ){
			$value['end_date'] = substr($value['end_date'],8,2).'/'.substr($value['end_date'],5,2).'/'.substr($value['end_date'],0,4);
		}
	}
	
		
}





?>





<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
<link href="../css/large.css" rel="stylesheet">
<link href="../../css/bootstrap-icon.css" rel="stylesheet">

<!--For date picker use - start -->
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/style.css">
<script src="<?php echo ROOT?>js/datepicker/jquery-1.12.4.js"></script>
<script src="<?php echo ROOT?>js/datepicker/jquery-ui.js"></script>
<script>$( function(){ $( ".datepicker" ).datepicker({ minDate: -365, maxDate: "+12M +1D", dateFormat: 'dd/mm/yy'});} );</script>
<!--For date picker use - end -->



<style>
input, textarea {width:300px;}

</style>

</head>
<body>
<?php include("layout/top.php");?>
<div class="container-fluid">
    <div class="row">
    <?php include("layout/menu.php");?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	        <?php if(!empty($result)){ echo $result;}?>
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10"><h3><?php echo $module;?></h3></div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="text-align:right;"><a class="btn btn-sm btn-default" href="cases.php">Back to listing</a></div>
            <form action="" method="post" enctype="multipart/form-data">
        		
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <?php 
				$i = $c = 0;
				foreach((array)$fields as $field){
					$c++;?>
                    
                	<?php if($c==18){?></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php }?>
                    <div style="margin-top:4px;">
                        <?php if($type[$field] != 'hidden'){
                        	if($type[$field] == 'image'){
                            $i++;
								if($i ==1){echo '<div style="margin-top:20px;">
									<big>Image</big>
									<small class="text-muted">(Recommanded size: 1000 x 1000 pixel)</small>
								</div>';}
							}elseif($type[$field] == 'video'){
								echo '<div style="margin-top:20px;">
									<big>Video</big>
									<small class="text-muted">(Format: MP4: max. size:15MB. Several minutes to upload video.)</small>
								</div>';
							}
                        ?>
                        <label style="vertical-align:top;">
							<?php if($required[$field] == 'required'){?><span class="red02">*</span><?php }?><!--
                            --><?php echo $str_convert->field_to_label($field)?>
                        </label>
						<?php }?>
                        
                        
                        
                        <?php if($type[$field] == 'select'){?>
                        	<select name="<?php echo $field?>" <?php echo $required[$field]?>>
								<?php foreach((array)$option[$field] as $option_v => $option_name){?>
                                <option value="<?php echo $option_v?>" <?php if($value[$field] == $option_v){?> selected <?php }?>><?php echo $option_name?></option>
                                <?php }?>
                       		</select>
                        <?php }elseif($type[$field] == 'date'){ ?>
                            <input name="<?php echo $field?>" type="text" class="datepicker" value="<?php echo $value[$field]?>" <?php echo $required[$field]?> autocomplete="off"> 
                        <?php }elseif($type[$field] == 'image' || $type[$field] == 'video'){?>
                        	<div class="col-12" <?php if($type[$field] == 'video'){?> style="margin-bottom:20px;"<?php }?>>
                            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                	
                                    <div class="def_img_bg" id="img<?php echo $field?>">
	                                    <?php if($type[$field] == 'image'){?>
                                    	<div style="background-image:url(../../<?php echo $value[$field]?>); background-size:contain;
                                        width:100px; height:80px; background-repeat:no-repeat; background-position:center; background-color:#CCC; "></div>
                                        <?php }else{?>
                                            <a href="<?php echo ROOT.$value[$field]?>" target="_blank">
                                            <div style="border:1px solid red; padding:8px 46px 10px 35px; width:95px; border-radius:6px; border:1px solid #D9686B;">
                                            <span class="glyphicon glyphicon-play" style="color:#D9686B; font-size:30px;"></span>
                                            </div>
                                            </a>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <div class="btn btn-sm" onClick="removeImg('cases', '<?php echo $id?>', '<?php echo $field?>');">
                                        <span class="glyphicon glyphicon-remove" style="color:red; cursor:pointer;"></span>Remove
                                    </div>
									<script>
                                    function removeImg(table, id, field){
                                        $.post( "/rohi.sg/cms/case/remove_img.php", {table:table, id:id, field:field}, function( result ) {
                                            $("#img"+field).fadeOut();
                                        });
                                    }
                                    </script>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <input name="<?php echo $field?>" type="file" id="<?php echo $field?>" value="<?php echo $value[$field]?>" <?php echo $required[$field]?> 
                                    accept="
									<?php if($type[$field] == 'image'){?>
										.png,.gif,.jpg,.jpeg
									<?php }elseif($type[$field] == 'video'){?>
                                    	.webm,.mkv,.flv,.vob,.wmv,.mov,.rmvb,.mp4,.mpg,.3gp
									<?php }?>" 
                                    >
                                    
                                    <?php if($field=='embed_video'){?>
                                    <video controls width="500px" id="vid" style="display:none"></video> 
									<script>       
									var objectUrl;    
									$(document).ready(function(){    
										$("#embed_video").change(function(e){
											var file = e.currentTarget.files[0];    
											objectUrl = URL.createObjectURL(file);   
											$("#vid").prop("src", objectUrl); 
											setTimeout(function() { check_length(); }, 1000);
										});    
										
										function check_length(){ 
											var seconds = $("#vid")[0].duration;
											if(seconds > 1200) 
											alert('Video duration should be less than 20 minutes');    
										}    
									}); 
                                    </script>                              
                                    <?php }?>
                                    
                                </div>
                            </div>
                        <?php }elseif($type[$field] == 'textarea'){?>
                        
                        	<?php if($tinymce[$field]==true){?>
                                <div>
                                <textarea name="<?php echo $field?>" class="tinymce" style="width:100%; min-height:550px;" 
                                placeholder="<?php echo $placeholder[$field]?>" <?php echo $required[$field]?>><?php echo $value[$field]?></textarea>
                                </div>
                            <?php }else{?>
                                <textarea name="<?php echo $field?>" placeholder="<?php echo $placeholder[$field]?>" <?php echo $required[$field]?> style="height:76px;"><?php echo $value[$field]?></textarea>
                                <!--<div style="display:inline-block;">
                                    <label></label>
                                    <div class="red" style="width:300px; display:inline-block; float:right; position:relative; left:6px; top:-5px;">
                                     	Embed video appear after the first image in details page.
                                    </div>
                                </div>-->
                            <?php }?>
                        <?php }elseif($type[$field] == 'unique'){?>
                            <input type="<?php echo $type[$field]?>" name="<?php echo $field?>" value="<?php echo $value[$field]?>" placeholder="<?php echo $placeholder[$field]?>" id="unique_title" <?php echo $required[$field]?>>
                            <div id="unique_title_result" style="margin-left:33%;"></div>
                            <script>
                            $( "#unique_title" ).keyup(function() {
                                checkUniqueTitle();
                            });
                            $(document).ready(function(){
                                checkUniqueTitle();
                            });
                            function checkUniqueTitle(){
								var id = '<?php echo $id?>';
                                var title = $("#unique_title").val();
                                $.post( "../../unique_title.php", {
                                    title:title, id:id
                                }, function( result ) {$("#unique_title_result").html(result);});
                            }
                            </script>
                            
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
<!-- TinyMCE -->
<script type="text/javascript" src="../../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        editor_selector : "tinymce",
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons2 : "styleselect,formatselect,fontselect,fontsizeselect,|,emotions,|,print,|,fullscreen",
		theme_advanced_buttons3 : "insertlayer,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,code,image,link,cleanup,help",
		theme_advanced_buttons4 : "tablecontrols,|,hr",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		//theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

</html>