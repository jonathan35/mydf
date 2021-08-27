<?php 

$id = base64_decode($_GET['id']);
$fields_count = count($fields);


if($_POST['add'] or $_POST['update']){//['save'] == 'Update'
	$save = '<span style="color:red;">Data not saved.</span>';
	if($_POST['add'] == 'Add'){//add mode
	
		$_POST['individual_organisation'] = $_POST['individual_organisation'];
		$_POST['case_id'] = base64_decode($_GET['case']);
		$_POST['donation_type'] = $_POST['donation_type'];
		$_POST['payment_status'] = 'paid';
		$_POST['total_amount'] = $_POST['amount'];
		$_POST['payment_date'] = date("Y-m-d", strtotime(substr($_POST['date'],3,2).'/'.substr($_POST['date'],0,2).'/'.substr($_POST['date'],6,4)))." 00:00:00";
		$_POST['created'] = date("Y-m-d h:i:s");
		$_POST['modified'] = date("Y-m-d h:i:s");
		
		unset($_POST['id']);
		if(sql_save($table, $_POST)){
			$donation=readFirst($conn, "donations", "", "id DESC");
			if(!empty($donation['id'])){
				$item = array();
				$item['case_id'] = base64_decode($_GET['case']);
				$item['donation_id'] = $donation['id'];
				$item['donor_name'] = $_POST['donor_name'];
				$item['donor_message'] = $_POST['donor_message'];
				$item['created'] = date("Y-m-d", strtotime(substr($_POST['date'],3,2).'/'.substr($_POST['date'],0,2).'/'.substr($_POST['date'],6,4)))." 00:00:00";
				$item['amount'] = $_POST['amount'];
				if(sql_save('donation_items', $item)){
					$save = '<span style="color:green;">Data added.</span>';
				}
			}
		}
	}elseif($_POST['update'] == 'Update'){//edit mode
		foreach((array)$_FILES as $img_field => $v){
			if($_FILES[$img_field]['name']!=''){
				$msg = $img->upload_image($_FILES[$img_field], $table, $img_field, $id);
			}
		}
		$_POST['created'] = date("Y-m-d", strtotime(substr($_POST['created'],3,2).'/'.substr($_POST['created'],0,2).'/'.substr($_POST['created'],6,4)))." 00:00:00";
		$_POST['modified'] = date("Y-m-d h:i:s");
		if(sql_save($table, $_POST)){
			$save = '<span style="color:green;">Data saved.</span>';
		}
	}
}


if(!empty($id)){//edit mode
	$condition = " id = '".$id."'";
	$order = '';
	$data = readFirst($conn, $table, $condition, $order);	
	if(!empty($data)){
		foreach((array)$fields as $field){
			if(!empty($data[$field])){
				$value[$field] = $data[$field];
			}
		}
	}
}

$column_code = ' display:inline-block; float: left; position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px; box-sizing: border-box;';
if($fic_1 && count($fic_1)>=2){
	$d = 100/count($fic_1)-5;
	$column_code .= 'width:'.$d.'%; padding-right:5%;';
}else{
	$column_code .= 'width:100%;';
}


?>


<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
	<h3 class="col-lg-12">
		<?php if($id){?>Edit<?php }else{?>Add<?php }?> <?php echo $module_name;?>
        <?php if($add==true && $id){?><a href="<?php echo $php?>?tab=<?php echo $_GET['tab']?>" class="btn btn-xs btn-success cus" >Add new</a><?php }?>
    </h3>
    
</div>
<?php if($back){?>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="text-align:right;">
    <a class="btn btn-sm btn-default" href="cases.php">Back to listing</a>
</div>
<?php }?>


<div class="col-12">
    <form action="" method="post" enctype="multipart/form-data">
        <?php 
        $item = 1;
        $i = $col = 0;
        $starter = true;
        foreach((array)$fields as $field){
            if($starter == true){$starter = false;?><div style=" <?php echo $column_code?>"><?php }?>
    
            
           <div class="row" style="margin-top:12px; <?php if($type[$field]=='hidden'){?> display:none;<?php }?>">
                <?php if($type[$field] != 'hidden' || ($type[$field] == 'photos' && $_GET['id'])){ ?>
                	<label <?php if($required[$field]==true){?>class="required"<?php }?> style=" <?php if($labelFullRow[$field]==true){?>width:100%;<?php }?>">
						<?php if(!empty($label[$field])){ echo $str_convert->field_to_label($label[$field]);}else{echo $str_convert->field_to_label($field);}?>
                   	</label>
				<?php }?>
                <?php if($type[$field] != 'hidden'){?><div class="div_input"><?php }?>
                
                
                <?php if($type[$field] == 'tag'){?>
                	<div id="tag_module"><?php include(ROOT."cms/layout/tag_input.php");?></div>
                <?php }elseif($type[$field] == 'photos'){?>
						<?php if(!empty($_GET['id'])){?>
                            <div id="photos_module"><?php include(ROOT."cms/layout/photos.php");?></div>
                        <?php }?>
                <?php }elseif($type[$field] == 'select'){
					if(!empty($value[$field])){
						$checked=$value[$field];
					}else{
						$checked=$default_value[$field];
					}?>
                    <select name="<?php echo $field?>" <?php echo $required[$field]?>>
                        <?php foreach((array)$option[$field] as $option_v => $option_name){?>
                        <option value="<?php echo $option_v?>" <?php if($checked == $option_v){?> selected <?php }?>><?php echo $option_name?></option>
                        <?php }?>
                    </select>
                    
                <?php }elseif($type[$field] == 'parent'){
					$ps=readData($conn, $p_table[$field], "status=1", "position ASC");
					?>
                    
                    <select name="<?php echo $field?>" <?php echo $required[$field]?>>
                        <?php foreach((array)$ps as $p){?>
                        <option value="<?php echo $p[$p_value[$field]]?>" <?php if($value[$field] == $p[$p_value[$field]]){?> selected <?php }?>><?php echo $p[$p_title[$field]]?></option>
                        <?php }?>
                    </select>
                <?php }elseif($type[$field] == 'date'){?>
                    <input name="<?php echo $field?>" type="text" class="datepicker" value="<?php echo $value[$field]?>" <?php echo $required[$field]?> style="width:<?php echo $width[$field]?>"> 
                <?php }elseif($type[$field] == 'image'){?>
                    <div class="col-12" style="margin-bottom:10px; text-align:left;">
						<?php $i++;
                        if($i ==1){
                            echo '<div><small class="text-muted" >Recommanded size: 650 x 400 pixel</small></div>';
                        }?>
                       <?php if($_GET['id']){//Remove feature only available when edit mode?>
                        <div class="col" style=" padding:0;">
                            <div class="def_img_bg" id="img<?php echo $field?>">
                                <img src="../../<?php echo $value[$field]?>" class="img-responsive" alt="" >
                            </div>
                        </div>
                        <div class="col">
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
                        <?php }else{?>
                        	<span class="glyphicon glyphicon-picture" style="font-size:30px; color:#ccc;"></span>
                        <?php }?>
                        <div class="col">
                            <input name="<?php echo $field?>" type="file" value="<?php echo $value[$field]?>" <?php if(empty($_GET['id'])){ echo $required[$field]; }?>> 
                        </div>
                    </div>
                <?php }elseif($type[$field] == 'textarea'){?>
					<?php if($tinymce[$field]==true){?>
                        <div>
                            <textarea name="<?php echo $field?>" class="tinymce" style="height:<?php echo $height[$field]?>; width:<?php echo $width[$field]?>;"
                            placeholder="<?php echo $placeholder[$field]?>" <?php echo $required[$field]?>><?php echo $value[$field]?></textarea>
                        </div>
                    <?php }else{?>
                        <div>
                            <textarea name="<?php echo $field?>" placeholder="<?php echo $placeholder[$field]?>" <?php echo $required[$field]?> 
                            style="height:<?php echo $height[$field]?>; width:<?php echo $width[$field]?>;"><?php echo $value[$field]?></textarea>
                        </div>
                    <?php }?>
                <?php }elseif($type[$field] == 'file'){?>
                	<div style="width:<?php echo $width[$field]?>">
                	<?php if($_GET['id']){?>
                    	<a href="../../<?php echo $value[$field]?>" target="_blank" style="display:inline-block; width:8%;">
                        <span class="glyphicon glyphicon-file"></span>
                        </a>
                    <?php }?>
	                <input type="<?php echo $type[$field]?>" name="<?php echo $field?>" value="<?php echo $value[$field]?>" placeholder="<?php echo $placeholder[$field]?>" <?php echo $required[$field]?> style=" display:inline-block; width:84%;">
                    </div>
                    
                <?php }else{?>
                    <input type="<?php echo $type[$field]?>" name="<?php echo $field?>" value="<?php echo $value[$field]?>" placeholder="<?php echo $placeholder[$field]?>" <?php echo $required[$field]?> style="width:<?php echo $width[$field]?>">
                <?php }?>
                <?php if($type[$field] != 'hidden'){?></div><?php }?>
            </div>
            
            <?php if($item == $fields_count || $item==$fic_1[$col]){ $col++; $starter = true;?></div><?php }?>  
        <?php 
        $item++;
        }?>
        <div class="col-12" style="text-align:center;">
        	<?php if(!empty($id)){?>
                <input type="submit" name="update" value="Update" >
            <?php }else{?>
                <input type="submit" name="add" value="Add" >
                
            <?php }?>
            <?php if($save){echo $save;}?>
        </div>
    </form>
</div>


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
