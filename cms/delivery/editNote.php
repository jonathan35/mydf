<?php 
require_once '../../config/ini.php';
require_once("../../pro/security.php");
if(!empty($_GET['id'])){
	
	$id = $defenders->escapeInjection(base64_decode($_GET['id']));
	
	if($_POST['submit']=='Submit'){
		
		$notes = $_POST['note'];
		
		if(mysqli_query($conn, "UPDATE product_comfirm SET note='".$notes."' WHERE reference_id='".$id."'")){
			$save="<font color=#006633>Save successfully</font>";
		}else{ 
			$save="<font color=#ff0000>Failed to Save</font>";
		}
	}
	
	$note_qry = mysqli_query($conn, "SELECT * FROM product_comfirm WHERE reference_id='".$id."'");
	$note = mysqli_fetch_assoc($note_qry);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CMS</title>
<link href="../js/draggable/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="../js/draggable/jquery.min.js"></script>
<script src="../js/draggable/jquery-ui.min.js"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="../../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,insertdate,inserttime,|,forecolor,backcolor",
		theme_advanced_buttons2 : "styleselect,formatselect,fontsizeselect,fontselect,|,fullscreen",
		theme_advanced_buttons3 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo",
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<div style="text-align:left; width:100%;">
	<form action="editNote.php?id=<?php echo base64_encode($id)?>" method="post" enctype="multipart/form-data">
           	 	<div style="text-align:left;font-family:Arial, Helvetica, sans-serif; font-size:80%; padding:1%; color:#000;">
                    <strong>Note :</strong>
                </div>
                <div>            
					<textarea name="note" class="mceEditor" id="editor1"><?php echo $note['note']?></textarea>
                </div><br/>
            <input type="submit" name="submit" value="Submit">
            <div style="text-align:left; width:96%; font-family:Arial, Helvetica, sans-serif; font-size:80%; padding:1%;">
				<?php echo $save?>
            </div>
    </form>
</div>
</body>
</html>
<?php }?>
