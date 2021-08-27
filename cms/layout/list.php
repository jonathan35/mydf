<?php if($list != false){?>
<style>
.list_search_output {display:none; background:#EFEFEF; box-shadow:2px 2px 2px rgba(0,0,0,.5); color:#333; max-height:80vh; overflow-y:scroll; cursor:default; position:absolute; z-index:10;}
</style>
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

/*
echo 'select * from '.$table.' '.$condition.' '.$condition_ext.' '.$sort;
debug($params);
debug($rows);
*/

$rows = sql_read('select * from '.$table.' '.$condition.' '.$condition_ext.' '.$sort, str_repeat('s',count($params)), $params);
$count = sql_count('select * from '.$table.' '.$condition.' '.$condition_ext.' '.$sort, str_repeat('s',count($params)), $params);


?>

<style>
.titleBlockInList {margin-top:4px; font-size:15px;}
.blockInList {margin-top:4px;;}
.thum {
	width:100%; height:100px; background-size:cover; background-position:center; background-repeat:no-repeat; border:1px solid #CCC;
}
.span_label { text-transform:capitalize; color:#999; display:none;}
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
<div class="row">
<div class="col-12">
    <h3>List <?php echo $module_name;?></h3>
	<?php 
        if($table == 'packages' || $table == 'project_details' || $table == 'project_photos' || $table == 'project_pdfs' || $table == 'causes_of_delay' || $table == 'contractual_issues'){ 
			if(!empty($_SESSION['proj_name'])){
				echo '<div style="padding-bottom:20px; font-size:16px; color:orange; line-height:1.5;">'.$_SESSION['proj_name'].'</div>';
			}
			if(!empty($_SESSION['pack_name'])){
				echo '<div style="padding-bottom:20px; font-size:16px; color:green; line-height:1.5;">'.$_SESSION['pack_name'].'</div>';
			}
		}
	?>
	
	<?php if($keyword==true || $filter==true){?>
		<div class="row" style="margin:10px 0;">
			<form class="col-12 pb-4" action="" method="post" enctype="multipart/form-data" target="_self">
			<div class="row">
            <span class="glyphicon glyphicon-search" style="color:gray;"></span>
            
        	<?php 
			if($keyword==true){
				include '../layout/keyword_search.php';
            }?>
			 
			 <?php 
			 if($filter==true){
			 foreach((array)$filFields as $field){
				if($type[$field] == 'datalist'){?>
                <input type="text" list="listlist<?php echo $field?>" value="<?php echo $option[$field][$_SESSION[$module_name.'-filter-'.$field]]?>" id="filterautoselect<?php echo $field?>" style="width:70%;"/>
                <datalist id="listlist<?php echo $field?>">
                    <?php foreach((array)$option[$field] as $option_v => $option_name){?>
                        <option value="<?php echo $option_name?>" <?php if($checked == $option_v){?> selected <?php }?> 
                        data-value="<?php echo $option_v?>"><?php echo $option_name?></option>
                    <?php }?>
                </datalist>
                <input type="hidden" name="<?php echo $field?>" id="filterautoselect<?php echo $field?>-hidden" value="<?php echo $_SESSION[$module_name.'-filter-'.$field]?>" >
                
				<?php }elseif($type[$field] == 'autosuggest'){?>
                    <input type="text" value="" class="search_input" id="search-input-filter-<?php echo $field?>"
                     autocomplete="off" data-input="filter-<?php echo $field?>" data-table="<?php echo $foreign_table[$field]?>" 
                     data-field="<?php echo $foreign_field[$field]?>" 
                     style="min-width:400px; padding:4px;" <?php foreach((array)$attributes[$field] as $a => $b){ echo $a.'="'.$b.'"'; }?>/>
                    <div class="search_output outputfilter-<?php echo $field?>">
                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                    </div>
                    <input type="hidden" name="<?php echo $field?>" id="hidden-filter-<?php echo $field?>" value="" >
                
                <?php }else{ ?>
					<div class="col-2">
                	<select name="<?php echo $field?>">
						<option value="">All <?php echo str_replace("_", " ", $field)?></option>
						<?php 
						foreach((array)$option[$field] as $option_v => $option_name){                        
							$countItem = sql_count('select * from '.$table.' where '.$field.'=?', 's', $option_v);
							if($countItem>0){
								$c = ' (<span id="status_figure_'.$option_v.'">'.$countItem.'</span>)';
							}else{
								$c = '';
							}
						?>
						<option value="<?php echo $option_v?>" <?php if($_SESSION[$module_name.'-filter-'.$field] == $option_v){?> selected <?php }?>><?php echo $option_name;?></option>
						<?php }?>
					</select>
					</div>
				<?php 
				}
			}
		}?>
                
                &nbsp;&nbsp;<input type="submit" name="submit" value="Search">
				&nbsp;&nbsp;<input type="submit" name="submit" value="Reset">
			</div>
			</form>
		</div>
	<?php }?>
    
	<form class="" action="" method="post" enctype="multipart/form-data" target="_self">
	
	<div class="col">
	<?php 
	if(in_array("status",$fields)){?>
    <div id="tab" class="row">
        <ul class="nav nav-tabs">
            <?php foreach((array)$option['status'] as $v => $l){
				$params[0] = $v;
				$s_count = sql_count('select * from '.$table.' '.$condition.' '.$condition_ext, str_repeat('s',count($params)), $params);
				?>
				<a href="?tab=<?php echo $l?>" class="content">
                <li <?php if((empty($_GET['tab']) && $v == 1) || $_GET['tab'] == $l){?>class="active"<?php }?>>
                <?php echo $l?> ( <?php echo $s_count;?> )
                </li></a>
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

	<table class="table table-striped" width="100%" id="item_list">
	<thead>    
		<?php if($list_method=='list'){?>
		<tr>
			<th style="width:2% !important;"></th>
			<?php 
			if($edit==true){	$usable_width = 88/12;	}else{	$usable_width = 96/12;}
			$c=2;
			foreach((array)$cols as $colName => $colWidth){?>
				<th style="
					width:<?php echo $usable_width*$colWidth;?>%; 
					<?php if($list_sort){?>cursor:pointer;<?php }?>
				" 
				<?php if($list_sort){?> onClick="sortTable('#item_list', '<?php echo $c;?>')" <?php }?>
				>
					<?php echo $colName?>
					<?php if($list_sort){?>&#8597;<?php }?>
				</th>
			<?php }?>
			<th>&nbsp;</th>			
		</tr>
		<?php }?>
    

    </thead>
	<tbody>
    
	<?php 
	
	if($count>0){
		
	$itemCount=1;
	$maxPerPage=50;
		if($list_method=='list'){
        foreach((array)$rows as $val){

			if(!empty($val['date'])){
				$val['date'] = substr($val['date'],8,2).'/'.substr($val['date'],5,2).'/'.substr($val['date'],0,4);
			}

			$c=1;
			
			$refresher = 'refresher'.$defender->encrypt('encrypt', $val['id']);

			?>
            <tr class="page page<?php echo $itemCount?> <?php echo 'tr'.$refresher?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>" id="row<?php echo $val['id']?>">
			
                <td style="width:2% !important;">
					<?php if(!empty($actions)){?>
                    	<input type="checkbox" value="<?php echo $val['id']; ?>" name="productIdList[]">
					<?php }?>
                    <input type="hidden" name="id" value="<?php echo $val['id'];?>" />
					
                </td>
                
				<?php include '../layout/value.php';?>
                
                
                
                
                <td class="text-center" style="width:10% !important;">                         
					<?php 
					
					if($edit){
					if(!empty($edit_php)) $edit_page = $edit_php; else $edit_page = $php;?>
					<!--
					<a href="<?php echo $edit_page?>?id=<?php echo base64_encode($val['id'])?>" class="btn btn-xs btn-default list-edit" ><img src="<?php echo ROOT.'cms/images/edit.png'?>" width="22"></a>
					-->
					
					<div link="<?php echo $edit_page?>.php?id=<?php echo base64_encode($val['id'])?>" class="mymodal-btn btn btn-xs btn-default list-edit ref-btn" ><img src="<?php echo ROOT.'cms/images/edit.png'?>" width="22"></div>
					<?php }?>
					<?php if($read){?>
						<div link="../layout/read.php?id=<?php echo base64_encode($val['id'])?>&table=<?php echo $table?>&fields=<?php echo base64_encode(json_encode($fields))?>" class="mymodal-btn btn btn-xs btn-default list-edit"><img src="<?php echo ROOT.'cms/images/envelope_open.svg'?>" width="22" style="padding-right:2px;"></div>
					<?php }?>
					
					<?php if($more_photos==true){?>
						<div class="mymodal-btn btn btn-xs btn-default list-edit" link="../layout/photos.php?parent_table=<?php echo $table?>&parent_id=<?php echo $val['id']?>" >
							<img src="<?php echo ROOT.'cms/images/photo.png'?>" style="margin-right:3px;">
						</div>
                	<?php }?>
                </td>
                

				<?php /*if($delete_in_row){?>
                <td class="col text-center" style="width:4% !important; color:#CCC;">
					<span class="glyphicon glyphicon-remove" style=" font-size:13px; margin-top:10px;" onclick="removeThis(<?php echo $val['id']?>)"></span>
				</td>
				<?php }*/?>
            </tr>
        <?php 
		  $itemCount++;
		  }
		}elseif($list_method=='block'){
        	foreach((array)$rows as $val){?>
            
            <div style="display:inline-block; width:150px; margin-top:10px; <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>" id="row<?php echo $val['id']?>">	  
                <div style="display:inline-block; width:100%; border:1px sold #CCC; padding:0">	
                    <div style="padding-left:14px;">	  
                        <input type="checkbox" value="<?php echo $val['id']; ?>" name="productIdList[]">
                         <div class="col text-center" style="width:4% !important; color:#CCC;">
	                         <span class="glyphicon glyphicon-remove" style=" font-size:13px; margin-top:10px;" onclick="removeThis(<?php echo $val['id']?>)"></span>
                         </div>
                        <input type="hidden" name="id" value="<?php echo $val['id'];?>" />
                	</div>
                    <div style="">
						<?php include '../layout/value.php';?>
                	</div>
                </div>  
            </div>  
            <?php 
			$itemCount++;
			}?>
		<?php }?>
        </tbody>
		</table>
        <?php include("../../paging.php");?>
        
	<?php }else{?>
		<table>
        	<tr><td>No record found</td></tr>
		</table>
    <?php }?>
</form>
</div>
</div>


<?php include '../layout/mymodal.php';?>

<script>

	
function sortTable(table, col) {
	
	thead =$(table).find('thead');
	tbody =$(table).find('tbody');
	
	var ss = thead.find('th:nth-child('+col+')').attr('sorting');
	if (ss=='desc') {
		thead.find('th:nth-child('+col+')').attr('sorting','asc');
		var asc = 'desc';
	} else {
		thead.find('th:nth-child('+col+')').attr('sorting','desc');
		var asc = 'asc';
	}
	
    tbody.find('tr').sort(function(a, b) {
        if (asc == 'asc') {
            return $('td:nth-child('+col+')', a).text().localeCompare($('td:nth-child('+col+')', b).text());
        } else {
            return $('td:nth-child('+col+')', b).text().localeCompare($('td:nth-child('+col+')', a).text());
        }
    }).appendTo(tbody);
    
}


(function(){ 
	var current_tab='<?php echo $_GET['tab'];?>';
	if(current_tab==''||current_tab=='display'){
		$("#display_tab").attr('class', 'current');$("#hide_tab").attr('class', '');
	}else{
		$("#hide_tab").attr('class', 'current');$("#display_tab").attr('class', '');
	}
})()



function removeThis(id){//alert(id);
	$.ajax({url: "layout/remove_item.php?table=<?php echo $table?>&id="+id, success: function(result){
		$("#row"+id).html(result).delay(2000).fadeOut();
	}});
}



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
<?php }?>