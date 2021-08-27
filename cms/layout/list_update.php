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
	
	
	


if(in_array("status",$fields)){
	$condition = "status='1'";
	if(!empty($_GET['tab'])){
		if($_GET['tab']=='hide'){
			$condition = " status='2' ";
		}
	}	
}else{
	$condition = " id !='' ";
}

$case_id = base64_decode($_GET['case_id']);
$condition .= " AND case_id='".$case_id."'";


if(!empty($_GET)){
	foreach((array)$_GET as $gn=>$gv){
		if(!empty($gv)){
			$condition .= " AND ".$gn."='".base64_decode($gv)."'";
		}
	}
}


if(!empty($_POST['submit'])){
	if($_POST['submit'] == 'Search'){
		$_SESSION[$module_name.'keyword'] = $_POST['keyword'];
		//$_SESSION['year'] = $_POST['year'];
		//$_SESSION['month'] = $_POST['month'];
	}elseif($_POST['submit'] == 'Reset'){
		$_SESSION[$module_name.'keyword'] = '';
		//$_SESSION['year'] = date("Y");
		//$_SESSION['month'] = '';
	}
}
if(!empty($_SESSION[$module_name.'keyword'])){
	$k=$_SESSION[$module_name.'keyword'];
	$condition .= " AND (";
	if($keywordMustFullWord==true){
		$p=1;
		foreach((array)$keywordFields as $f){
			if($p!=1){$condition.=" OR ";}$p++;
			$condition .= $f." REGEXP '[[:<:]]".$k."[[:>:]]'";
		}
	}else{
		$p=1;
		foreach((array)$keywordFields as $f){
			if($p!=1){$condition.=" OR ";}$p++;
			$condition .= $f." REGEXP '[[:<:]]".$k."[[:>:]]'";
		}
	}
	$condition .= " )";
	$condition = str_replace(" AND ( )", "", $condition);
}

$rows = readData($conn, $table, $condition, "created DESC");
$count = countData($conn, $table, $condition, "ORDER BY created DESC");
$display = countData($conn, $table, "status=1");
$hidden = countData($conn, $table, "status=2");

?>
<style>
.titleBlockInList {margin-top:4px; font-size:15px;}
.blockInList {margin-top:4px;;}
.thum {
	width:100%; height:100px; background-size:cover; background-position:center; background-repeat:no-repeat; border:1px solid #CCC;
}
.span_label { text-transform:capitalize; color:#999;}
.span_label::after { content:":"; }

</style>
<div class="col-12">
    <!--<h3>List <?php echo $module_name;?></h3>-->
    
	<?php if($keyword==true){?>
		<div class="row" style="margin:10px 0;">
            <form action="" method="post" enctype="multipart/form-data">
            <span class="glyphicon glyphicon-search" style="color:gray;"></span>
            <?php $kyplaceholder="";$p=1;
			foreach((array)$keywordFields as $f){ if($p!=1){$kyplaceholder.=", ";}$p++; $kyplaceholder.=$str_convert->to_eye($f);}?>
                <input name="keyword" value="<?php echo $_SESSION[$module_name.'keyword']?>" placeholder="<?php echo str_replace("_", " ", $kyplaceholder)?>" style="width:200px;"/>
                <input type="submit" name="submit" value="Search">
                <input type="submit" name="submit" value="Reset">
        	</form>
        </div>
    <?php }?>
    
    <form action="" method="post" enctype="multipart/form-data">
    <?php if(in_array("status",$fields) && in_array("Display",$actions)){?>
    <div id="tab" class="row">
    	<ul>
            <li id="display_tab"><a href="<?php echo $php?>?tab=display" title="Show display Item" class="content">On display ( <?php echo $display;?> )</a></li>
            <li id="hide_tab"><a href="<?php echo $php?>?tab=hide" title="Show hidden Item" class="content">Not on display ( <?php echo $hidden;?> )</a></li>
        </ul>
    </div>
    <?php }?>
    <div class="row tr" style="border-bottom:1px solid #CCC;">
        <div class="col" style="width:5% !important;"><input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'productIdList[]', this.checked)" title="Check all item"></div>
        <?php foreach((array)$actions as $action){?><input type="submit" name="action" value="<?php echo $action?>" onClick="return confirmAction('<?php echo $msg[$action]?>');" title="<?php echo $btn?> selected item(s)"><?php }?>
    </div>
    <div class="row tr" style="background:#ADBCBE;">
        <div class="col" style="width:2% !important;"></div>
        <div class="col" style=" <?php if($edit==true){?>width:82%<?php }else{?>width:96%<?php }?> !important;">
            <?php foreach((array)$cols as $colName => $colWidth){?>
                <div class="col-lg-<?php echo $colWidth?>"><?php echo $colName?></div>
            <?php }?>
        </div>
    </div>
    
	<?php if($count>0){
        foreach((array)$rows as $val){
			$c=1;?>
            <div class="row tr">
                <div class="col" style="width:2% !important;">
                    <input type="checkbox" value="<?php echo $val['id']; ?>" name="productIdList[]">
                    <input type="hidden" name="id" value="<?php echo $val['id'];?>" />
                </div>
                <div class="col" style=" <?php if($edit==true){?>width:82%<?php }else{?>width:96%<?php }?> !important;">
                <?php foreach((array)$cols as $colName => $colWidth){?>
                    <div class="col-lg-<?php echo $colWidth?>">
                        <?php foreach((array)$items[$colName] as $fieldName){?>
                        <div class="col-lg-12" style="padding:0;">
                            <?php if($type[$fieldName]=='text' || $type[$fieldName]=='number'){?>
                                <?php if($c==1){?>
                                    <div class="titleBlockInList">
                                        <span class="span_label">Title</span>
                                        <?php echo $str_convert->field_to_label($val[$fieldName])?>
                                    </div>
                                <?php }else{?>
                                    <div class="blockInList">
                                        <span class="span_label"><?php echo $str_convert->field_to_label($fieldName)?></span>
                                        <?php echo $str_convert->field_to_label($val[$fieldName])?>
                                    </div>
                                <?php }?>
                            <?php 
                            $c++;
                            }elseif($type[$fieldName]=='textarea'){?>
                                <div class="blockInList" style="max-height:60px; overflow:hidden;">
                                    <span class="span_label"><?php echo $str_convert->field_to_label($fieldName)?></span>
                                    <?php echo substr(strip_tags($str_convert->field_to_label($val[$fieldName])), 0, 90); if(strlen($album_name)>91) echo '..';?>
                                </div>
                            <?php }elseif($type[$fieldName]=='image' && !empty($val[$fieldName])){?>
                                <div class="blockInList">
                                    <div class="thum" style="background-image:url(../../<?php echo $val[$fieldName]?>); "></div>
                                </div>
                            <?php }elseif($type[$fieldName]=='file'){?>
                                <div class="blockInList">
                                    <?php if(!empty($val[$fieldName])){?>
                                        <a href="../../<?php echo $val[$fieldName]?>" target="_blank"><span class="glyphicon glyphicon-file"></span></a>
                                    <?php }else{?>
                                        <span class="glyphicon glyphicon-file" style="color:#999;"></span>
                                    <?php }?>
                                </div>
                            <?php }elseif($type[$fieldName]=='parent'){?>
                                <?php $pvs=readFirst($conn, $p_table[$fieldName], "status=1 AND id='".$val[$fieldName]."'", "position ASC");?>
                                <div class="blockInList">
                                    <span class="span_label"><?php echo $str_convert->field_to_label($p_title[$fieldName])?></span>
                                    <?php echo $pvs[$p_title[$fieldName]];?>
                                </div>
                            
                            <?php }?>
                            
                            <?php //if($val['created'] != '0000-00-00 00:00:00'){ echo date("M d, Y", strtotime($val['created']));}else{ echo 'undefined';}?>
                        </div>
                        <?php }?>
                    </div>
                <?php }?>
                </div>
                
                
                <?php if($edit==true){?>
                <style>
                .cute {width:80%; margin:0 10%;}
				</style>
                <div class="col text-center" style="width:14% !important;">
                	<div style="height:<?php if($photo_in_list==true){?>8px;<?php }else{?>12px;<?php }?>"></div>
                    <a href="<?php echo $php?>?id=<?php echo base64_encode($val['id'])?>&case_id=<?php echo $_GET['case_id']?>" class="btn btn-xs btn-default cute" >Edit</a>
                    
                	<?php if($photo_in_list==true){?>
                        <div class="btn btn-xs btn-default cute" style="margin-top:8px;" data-toggle="modal" data-target="#myModal<?php echo $val['id']?>">Edit photo<?php echo $val['id']?></div>
                        <div id="myModal<?php echo $val['id']?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Album: <?php echo $val['album_name'];?></h4>
                              </div>
                              <div class="modal-body">
                                <iframe src="layout/photos.php?parent_table=albums&parent_id=<?php echo $val['id']?>" 
                                style=" width:100%; height:380px;" frameborder="0"></iframe>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>                        
                	<?php }?>
                </div>
                <?php }?>
                
                
            </div>
        <?php }?>
        
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

</style>