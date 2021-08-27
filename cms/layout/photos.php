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


$table = 'photos';
$module_name = 'Photos';
$php = 'photos';
$add = true;
$edit = false;
$duplicate = true;
$list_method = 'block';//list
$export = true;


$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'email');
$filter = false;
$filFields = array('product');

$actions=array('Delete');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');

//$unique_validation=array('email');

$fields = array('id', 'photo');//, 'parent_table', 'parent_id', 'status', 'position'


if($_POST){
	$_POST['parent_id'] = $_GET['parent_id'];
	$_POST['parent_table'] = $_GET['parent_table'];
	$_POST['status'] = 1;
	$_POST['position'] = 0;

}

$value = array();
$type = array();
$width = array();//width for input field

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(
	0=>array('2', '0'), 
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

  
$type['id'] = 'hidden';
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide');
$type['photo'] = 'image';

$multiple['photo'] = true;



/*
$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');

$type['position'] = 'number';
$type['publish_date'] = 'date';
$type['address'] = 'textarea'; $tinymce['address']=false;  $labelFullRow['address']=false; $height['address'] = '80px;'; $width['address'] = '100%;'; 
$type['cause_of_delay'] = 'textarea'; $tinymce['cause_of_delay']=false;  $labelFullRow['cause_of_delay']=true; $height['cause_of_delay'] = '80px;'; $width['cause_of_delay'] = '100%;';
$type['360_video'] = 'video'; 


$placeholder['title'] = 'Title for profile page';

$attributes['project'] = array('required' => 'required'); //placeholder
$attributes['contract_sum'] = array('step' => '.01'); 
$attributes['workdone_paid_to_date'] = array('step' => '.01', 'placeholder'=>'RM'); 
$attributes['package_date'] = 'date'; 

$style['project'] = array('width' => '90%'); //placeholder

*/

$cols = $items =array();
$cols = array('Photos' => '12');//Column title and width
$items['Photos'] = array('');
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
label {width:30%;}
.div_input {width:69%;}
</style>


</head>
<body style="overflow-x:hidden;">
<div class="row">  
	<div class="col-12">
		<div class="row">
            <?php if($add==true || $_GET['id']){?>
            <div class="col-12">
            	<?php include '../layout/add.php';?>
            </div>
            <?php }?>
            <div class="col-12">
				
				
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

include '../layout/list_cond.php';
$params = array();
$sort = ' order by position asc, id asc';
$condition = " where id !=? ";

$params[] = '';


if(!empty($_GET['parent_id'])){
	$params[] = $_GET['parent_id'];
	$condition .= ' AND parent_id=? ';
}
if(!empty($_GET['parent_table'])){
	$params[] = $_GET['parent_table'];
	$condition .= ' AND parent_table=? ';
}


$rows = sql_read('select * from '.$table.' '.$condition.' '.$condition_ext.' '.$sort, str_repeat('s',count($params)), $params);
$count = sql_count('select * from '.$table.' '.$condition.' '.$condition_ext, str_repeat('s',count($params)), $params);

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
    <!--<h3>List <?php echo $module_name;?></h3>-->

	<?php if($keyword==true || $filter==true){?>
		<div class="row" style="margin:10px 0;">
			<form action="" method="post" enctype="multipart/form-data">
            <span class="glyphicon glyphicon-search" style="color:gray;"></span>
            
            <?php 
		  if($keyword==true){
		  $kyplaceholder="";$p=1;
			foreach((array)$keywordFields as $f){ if($p!=1){$kyplaceholder.=", ";}$p++; $kyplaceholder.=$str_convert->to_eye($f);}?>
                <input name="keyword" value="<?php echo $_SESSION[$module_name.'-search-keyword']?>" placeholder="<?php echo str_replace("_", " ", $kyplaceholder)?>" style="width:200px;"/>
            <?php }?>
			 
			 <?php 
			 if($filter==true){
			 foreach((array)$filFields as $field){?>
				<?php if($type[$field] == 'autosuggest'){?>
                    <input type="text" value="" class="search_input" id="search-input-filter-<?php echo $field?>"
                     autocomplete="off" data-input="filter-<?php echo $field?>" data-table="<?php echo $parent_table[$field]?>" 
                     data-field="<?php echo $foreign_field[$field]?>" 
                     style="min-width:400px; padding:4px;"/>
                    <div class="search_output outputfilter-<?php echo $field?>">
                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                    </div>
                    <input type="hidden" name="<?php echo $field?>" id="hidden-filter-<?php echo $field?>" value="" >
                <?php }}}?>
                
                <input type="submit" name="submit" value="Search">
                <input type="submit" name="submit" value="Reset">
			</form>
		</div>
	<?php }?>
    
	<form action="" method="post" enctype="multipart/form-data" >
	
	<div class="col">
    <?php if(in_array("status",$fields)){?>
    <div id="tab" class="row">
        <ul class="nav nav-tabs">
            <?php foreach((array)$option['status'] as $v => $l){
                $s_count = sql_count('select id from '.$table.' where status=?' , 's', $v);
                ?>
                <li <?php if((empty($_GET['tab']) && $v == 1) || $_GET['tab'] == $l){?>class="active"<?php }?>>
                <a href="<?php echo $php?>?tab=<?php echo $l?>" class="content"><?php echo $l?> ( <?php echo $s_count;?> )</a>
                </li>
            <?php }?>
        </ul>
    </div>
    <?php }?>
	</div>
	
    <div class="nav-act">	
		<div class="row pt-2 pb-1">
			<div class="col-auto">
			<?php if(!empty($actions)){?>
				<input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)" title="Check all item">
				<span class="glyphicon glyphicon-arrow-down" style="color:#CCC; padding-left:1px;"></span>
			</div>
			<div class="col-auto">
			<?php }?>
			<?php foreach((array)$actions as $action){?><input class="btn-check"  type="submit" name="action" value="<?php echo $action?>" onClick="return confirmAction('<?php echo $msg[$action]?>');" title="<?php echo $msg[$action]?> selected item(s)"><?php }?>
			</div>
		</div>
    </div>
    
    <div style="background:#DDD; border:none; border-bottom:2px solid #999;">
        <div class="col" style="width:2% !important;"></div>
        <div class="col" style=" <?php if($edit==true){?>width:82%<?php }else{?>width:96%<?php }?> !important;">
            <?php foreach((array)$cols as $colName => $colWidth){?>
                <div class="col-lg-<?php echo $colWidth?>"><?php echo $colName?></div>
            <?php }?>
        </div>
    </div>
	<?php 
	if($count>0){
		
	$itemCount=1;
	$maxPerPage=50;


	$arr = array();
	foreach((array)$rows as $key => $item){
	   $arr[$item['parent_id']][$key] = $item;
	}
	ksort($arr, SORT_NUMERIC);
	
        	foreach((array)$arr as $pack_id => $pval){?>
             <div class="page page<?php echo $itemCount?>"  style="border-bottom:1px solid #CCC; padding:10px 0;  <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>">
			<?php 
			$foreign_data = sql_read('select * from "'.$parent_table.'" where id=?', 's', $pack_id);
	
			//echo '<h4 style="color:#333;">'.$foreign_data['name'].'</h4>';
			?>
                 <div style="display:table-cell; width:50px;">
                    <input type="checkbox" value="" target-group="group<?php echo $foreign_data['id']?>" class="groupcheck" style=" border:1px solid red;">
                     <span class="glyphicon glyphicon-arrow-right" style="color:#CCC; font-size:13px; top:-1px;"></span>
                 </div>
                 <div class="sortable" style="display:table-cell; border:1px dashed #CCC; background-color:#EFEFEF; padding:10px;">
                 
                    <?php foreach((array)$pval as $val){?>
                      <div id="row<?php echo $val['id']?>" sort-group="sg-<?php echo $foreign_data['id']?>" class="sg-<?php echo $foreign_data['id']?>" 
                      style="display:inline-block; width:150px; margin:5px;" >	  
                          <div style="display:inline-block; width:100%; border:1px sold #CCC; padding:0">	
                              <div style="padding-left:14px;">
                                  <input type="checkbox" value="<?php echo $val['id']; ?>" name="productIdList[]" class="group<?php echo $foreign_data['id']?>">
                                  <input type="hidden" name="id" value="<?php echo $val['id'];?>" />
                                  <!--<a href="<?php echo $php?>?id=<?php echo base64_encode($val['id'])?>" class="btn btn-xs btn-default cute" style="float:right;">Edit</a>-->
								  
								  
								  <div data="../../<?php echo $val['photo']?>" class="copyclipboard">Copy</div>
                                   <div class="col text-center" style="width:4% !important; color:#CCC; float:right; top:-7px; right:10px;">
                                        <span class="glyphicon glyphicon-remove" style=" font-size:13px; margin-top:10px;" onclick="removeThis(<?php echo $val['id']?>)"></span>
                                   </div>
                              </div>
                              <div>
                                  <div class="blockInList">
                                      <div class="thum" style="background-image:url(../../<?php echo $val['photo']?>); "></div>
                                  </div>
                              </div>
                          </div>  
                      </div>
                    <?php 
                    $itemCount++;
                    }
                    ?>
                 </div>
                 
                 <span class="result"></span>
                 <script>
                 $(".sortable").sortable({
				update: function( event, ui ) {
					var sgid = $(this).find("div").attr("sort-group");
					var arr = {};
					$("."+sgid).each(function( index ) {
						var i = $(this).attr('id').replace('row','');
						if(i!='')	arr[i] = index+1;
					});
					$.post( "layout/sort.php?table=<?php echo $table?>",arr).done(function( data ) {
						//$( ".result" ).html( data );
					});
				}
                 });                 
                 </script>
             </div>
		<?php }?>
        
        <?php include("../../paging.php");?>
        
	<?php }else{?>
        <table>
        	<tr><td>No record found</td></tr>
		</table>
    <?php }?>
</form>
</div>


<script>
(function(){ 
	var current_tab='<?php echo $_GET['tab'];?>';
	if(current_tab==''||current_tab=='display'){
		$("#display_tab").attr('class', 'current');$("#hide_tab").attr('class', '');
	}else{
		$("#hide_tab").attr('class', 'current');$("#display_tab").attr('class', '');
	}
})()
</script>
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
	</script>
        

<style>
.modal {  z-index:5000;}
.modal-dialog {width:80% ; margin:50px auto;}
.copyclipboard { display:inline-block; cursor:default; border:1px solid #CCC; padding:2px 10px;}
.copyclipboard:hover {background-color:#CCC;}
</style>                
                

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

$("input[class='groupcheck']").each(function(){
  $(this).click(function(){
    var c = $(this).attr("target-group");
    if($(this).is(":checked")){
     $("."+c).prop("checked",true);
    }else{
       $("."+c).prop("checked",false);
    }
  })
})

function removeThis(id){
	$.ajax({url: "layout/remove_item.php?table=<?php echo $table?>&id="+id, success: function(result){
		$("#row"+id).html(result).delay(2000).fadeOut();
	}});
}


</script>


<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>

<script> 
$(".search_input").on('keyup dblclick', function(){
	var val = $(this).val();
	var input = $(this).data("input");
	var table = $(this).data("table");
	var field = $(this).data("field");
	$(".output"+input).css("display", "block");
	$.post( "layout/search_product.php", { input:input, keyword: val, table: table , field:field})
		.done(function( data ) {
		$(".output"+input).html(data);
	});	
});
function autofil(e){
	var id_val = $(e).data("val");
	var input_name = $(e).data("input");
	var data = {};	data[input_name] = id_val;	
	$("#search-input-"+input_name).val($(e).html());
	$("#hidden-"+input_name).val(id_val);
	$.post( "layout/set_session.php", data);	
}
$("body").click(function(e){
	$(".search_output").fadeOut('fast');
});

$('.copyclipboard').click(function(){
	var copyText = $(this).attr('data');
	var dummy = document.createElement("textarea");
	document.body.appendChild(dummy);
	dummy.value = copyText;
	dummy.select();
	document.execCommand("copy");
	document.body.removeChild(dummy);
	$(this).fadeOut();
	$(this).fadeIn();
})
</script>

</html>