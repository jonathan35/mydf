<?php 
require_once '../../config/ini.php'; 
session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

if ($_GET['description']!=="")
	{
	$query=mysqli_query($conn, "select * from free_flow_text");
	$row_Rs1=mysqli_fetch_assoc($query);
	}

if($_POST['submit']==" Submit ")
{
	$description=$_POST['description'];
	$description= str_replace ("'","&#39;",$description);
	$description= str_replace ("<br>","", $description);		
	$description= str_replace ("\\","", $description);	
	$description= str_replace ("'","\'", $description);	

	$learn_more=$_POST['learn_more'];
	$learn_more= str_replace ("'","&#39;",$learn_more);
	$learn_more= str_replace ("<br>","", $learn_more);		
	$learn_more= str_replace ("\\","", $learn_more);	
	$learn_more= str_replace ("'","\'", $learn_more);	
	
if(mysqli_query($conn, "update free_flow_text set description='$description', learn_more='$learn_more', charges='".$_POST['charges']."'"))
	{
		$save='yes';
		$query=mysqli_query($conn, "select * from free_flow_text");
		$row_Rs1=mysqli_fetch_assoc($query);
	}
else{$save='no';}		
}

?>


<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
</head>

<body>
<!--////////////////////////////////////////// TOP MENU START////////////////////////////////////////////// -->
<?php include("layout/top.php");?>
<!--////////////////////////////////////////// TOP MENU START////////////////////////////////////////////// -->

<div class="container-fluid">
    <div class="row">
    <!--////////////////////////////////////////// SIDE MENU START////////////////////////////////////////////// -->
	<?php include("layout/menu.php");?>
    <!--////////////////////////////////////////// SIDE MENU END////////////////////////////////////////////// -->
    
    <!--////////////////////////////////////////// CONTENT START////////////////////////////////////////////// -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" align="center">
          <div class="table-responsive">
          	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
              <tr>
                <td class="border_background_no_color">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="2" class="border_background_no_color"><h3>Edit Delivery Terms</h3></td>
                    </tr> 
                  <tr>
                    <td class="border_background_no_color">    
            
            <table width="100%" align="left" cellpadding="2"  cellspacing="2">
              <form name="form1" method="post" action="editCart.php?id=<?php echo $_GET['id']?>" enctype="multipart/form-data">
            
            
                <tr>
                  <td colspan="2" class="main_title"><strong><?php if($save=='yes')
                    {echo '<font color="#336600"> Updated Successfully</font>';}
                    elseif($save=='no')
                    {echo '<font color="#CC3300">Failed to Update</font>';}
                ?></strong></td>
                </tr>
                <tr>
                  <td colspan="2" align="left" class="red">*Indicates required fields </td>
                </tr>
               <tr>
                  <td width="20%" valign="top" class="main_title">Extra Description (Learn More): </td>
                  <td align="left"><textarea name="learn_more" cols="120" rows="20" id="learn_more" class="tinymce"><?php echo $row_Rs1['learn_more']?></textarea></td>
                </tr> 
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr>
                  <td width="20%" valign="top" class="main_title">Description : </td>
                  <td align="left"><textarea name="description" rows="20" cols="120" class="tinymce"><?php echo $row_Rs1['description']?></textarea></td>
                </tr>
                <tr>
                  <td align="center" colspan="2"><input type="submit" name="submit" value=" Submit " onClick="return check();">
                    &nbsp;
                    <input type="reset" name="reset" value=" Reset "></td>
                </tr>
              </form>
            </table>
                
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
          </div>
        </div>
    <!--////////////////////////////////////////// CONTENT END////////////////////////////////////////////// -->
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>

<!-- TinyMCE -->
<script type="text/javascript" src="../../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons2 : "styleselect,formatselect,fontselect,fontsizeselect,|,emotions,|,print,|,fullscreen",
		theme_advanced_buttons3 : "insertlayer,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,code,image,cleanup,help",
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
</body>
</html>