<?php 
require_once '../../config/ini.php'; 


$save='';
if($_POST['save_tag']=='save'){
	$data['id']='1';//This is for post module;
	$data['keyword']=$_POST['keyword'];
	if(sql_save("tags", $data)){
		echo '<span id="save" style="color:green;">Save!</span>';
	}else{
		echo '<span id="save" style="color:red;">Failed to save!</span>';
	}
}

if(!empty($_SESSION['tag_module']) && !empty($_SESSION['tag_name'])){
	$post_tags = readFirst($conn, "tags", " module = '".$_SESSION['tag_module']."'");
	//$tags=explode(',', preg_replace( "/\r|\n/", "", $post_tags['keyword']));
	$tags=explode(',', preg_replace( "/\r|\n/", "", str_replace(array(', ', ' ,'),array(',',','),$categories['keyword'])));
	foreach((array)$tags as $k=>$v){
		if(is_null($v) || $v == '') unset($tags[$k]);
	}
	
	$selected_tags = readFirst($conn, $_SESSION['tag_module'], " id = '".$_SESSION['module_row_id']."'");
	$selected_tags = $selected_tags[$_SESSION['tag_name']];
}

?>
<style>
.tag_block {
	display:inline-block;
	border:1px solid #CCC;
	background:#F5F5F5;
	color:#666;
	padding:4px 10px;
	margin:2px 1px;
	cursor:pointer;
	
}
.tag_selected {
	border:1px solid #63C781 !important;
}
.glyphicon-asterisk {font-size:10px; color:#CCC;}
.glyphicon-ok {font-size:10px;color:#63C781; }

</style>
<?php if(!empty($tags)){?>
<div>
    <input type="hidden" name="<?php echo $_SESSION['tag_name']?>" id="tag_input" value="<?php echo $selected_tags?>" />
	<?php 
	$c=1;
	
	if(count($tags)>1){
		foreach((array)$tags as $tag){
			$checked = '';
			$icon_asterisk = "";
			$icon_ok = "display:none;";
			if(strstr($selected_tags, $tag)){//strstr($selected_tags, $tag.',') || strstr($selected_tags, ','.$tag)
				$checked = 'tag_selected';
				$icon_asterisk = "display:none;";
				$icon_ok = "";
			}
			?>
		<div class="tag_block <?php echo $checked;?>" id="tag<?php echo $c?>" onclick="toggleCheck('<?php echo $tag?>', '#tag<?php echo $c?>','.checked<?php echo $c?>','.uncheck<?php echo $c?>');">
			<span class="glyphicon glyphicon-ok checked<?php echo $c?>" style=" <?php echo $icon_ok?>"></span>
			<span class="glyphicon glyphicon-asterisk uncheck<?php echo $c?>" style=" <?php echo $icon_asterisk?>"></span>
			<?php echo $tag; ?>
		</div>
	<?php 	$c++;
		}
	}?>
    
	<div class="btn btn-xs" onclick="toggleEdit();" style="color:#999;"><span class="glyphicon glyphicon-edit"></span> Edit Tags</div>
	<div id="edit_area" style="display:none; background:#F9F9F9; border:1px solid #F2F2F2; padding:4px; padding-bottom:30px;">
	        <textarea id="post_keyword" style="width:100%; height:70px;"><?php echo $post_tags['keyword']?></textarea>
            <div class="red">Seperate tag by ","</div>
			<div class="btn btn-xs btn-success" style="display:inline-block; float:right; position:relative;" onclick="saveTag();"><span class="glyphicon glyphicon-edit"></span> Save</div>
    </div>
</div>
<?php }?>
<script>

function fadeSaveResult(){
	$("#save").delay(2000).fadeOut();	
}
fadeSaveResult();

function saveTag(){
	var post_keyword = $("#post_keyword").val();
	$.post( "layout/tag_input.php", {
		save_tag:'save', keyword:post_keyword
	}, function( result ) {$("#tag_module").html(result);});
}

function toggleEdit(){
	$("#edit_area").fadeToggle();
}

function toggleCheck(val, eID, checked, uncheck){
	var v=$("#tag_input").val();
	var vl='';
	
	if($(eID).hasClass("tag_selected")){//alert('uncheck it');
		$(eID).removeClass("tag_selected");
		$(checked).hide();
		$(uncheck).fadeIn();
		vl = v.replace(","+val,"").replace(val,"").replace(/^,/, '');
		$("#tag_input").val(vl);
		
	}else{//alert('check it');
		$(eID).addClass("tag_selected");
		$(checked).fadeIn();
		$(uncheck).hide();
		
		if(v==''){ vl=val;}else{vl=v+","+val;}
		$("#tag_input").val(vl);
	}
	
}
</script> 
