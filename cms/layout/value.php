<?php 

if($_POST['get_config_only']){

	require_once '../../config/ini.php';
	require_once '../../config/str_convert.php';
	require_once '../../config/security.php';
	$id = $defender->encrypt('decrypt', $_SESSION['refresher']);
	$folder = $_SESSION['refresher_folder'];
	$php = $_SESSION['refresher_php'];
	$refresher = 'refresher'.$_SESSION['refresher'];
	require_once '../'.$folder.'/'.$php.'.php';

	$val = sql_read("select * from $php where id=? limit 1", 'i', $id);

}

foreach((array)$cols as $colName => $colWidth){
	
	
	?>
	<td class="<?php echo $refresher?>">
		<?php foreach((array)$items[$colName] as $fieldName){?>		
		<div class="col-12" style="padding:0;">
			<?php if($type[$fieldName]=='text' || $type[$fieldName]=='number' || $type[$fieldName]=='date' || $type[$fieldName]=='email'){?>
				<div class="blockInList">
					<?php if(!isset($list_sort)){?>
					<span class="span_label"><?php echo $str_convert->field_to_label($fieldName)?></span>
					<?php }?>
					<?php echo $str_convert->field_to_label($val[$fieldName])?>
				</div>
			<?php 
			$c++;
			}elseif($type[$fieldName]=='money'){?>
				<div class="blockInList">
					<?php if(!isset($list_sort)){?>
					<span class="span_label"><?php echo $str_convert->field_to_label($fieldName)?></span>
					<?php }?>
					<?php echo number_format($str_convert->field_to_label($val[$fieldName]),2,'.',',')?>
				</div>
			<?php }elseif($type[$fieldName]=='textarea'){?>
				<div class="blockInList" style="max-height:60px; overflow:hidden;">
					<?php if(!isset($list_sort)){?>
					<span class="span_label"><?php echo $str_convert->field_to_label($fieldName)?></span>
					<?php }?>
					<?php echo substr(strip_tags($str_convert->field_to_label($val[$fieldName])), 0, 90); if(strlen($album_name)>91) echo '..';?>
				</div>
			<?php }elseif($type[$fieldName]=='image' && !empty($val[$fieldName])){?>
				<div class="blockInList">
					<div class="btn btn-xs copy_link" onclick="copy(this, 'thelink<?php echo $fieldName.$val['id']?>')">Copy link</div>
                    <input class="link_value" id="thelink<?php echo $fieldName.$val['id']?>" value="../../<?php echo $val[$fieldName]?>">
					<div class="thum" style="background-image:url(../../<?php echo $val[$fieldName]?>); "></div>
				</div>
			<?php }elseif($type[$fieldName]=='pdf'){?>
				<div class="blockInList">
                	<?php if(!empty($val[$fieldName])){?>
                        <div class="btn btn-xs copy_link" onclick="copy(this, 'thelink<?php echo $fieldName.$val['id']?>')">Copy link</div>
                        <input class="link_value" id="thelink<?php echo $fieldName.$val['id']?>" value="../../<?php echo $val[$fieldName]?>">
                        <a href="../../<?php echo $val[$fieldName]?>" target="_blank">
                        
                        <object data="../../<?php echo $val[$fieldName]?>" type="application/pdf" width="100%" height="100px">
                            <div style="background:#DB5344; color:white; font-size:20px; padding-top:10px; width:100%; height:45px; text-align:center;">PDF</div>
                        </object>
                        </a>
                    <?php }else{?>
                        <div style="background:#DB5344; color:white; font-size:20px; padding-top:25px; width:100%; height:100px; text-align:center;">
                        PDF <div style="font-size:14px;">not found</div>
                        </div>
                    <?php }?>
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
			
			<?php }elseif($type[$fieldName] == 'select' || $type[$fieldName] == 'datalist' || $type[$fieldName] == 'autosuggest'){ ?>
				<div class="blockInList">
					<?php if(!isset($list_sort)){?>
					<span class="span_label"><?php echo $str_convert->field_to_label($fieldName)?></span>
					<?php }?>
					<?php if(!empty($val[$fieldName])) echo $option[$fieldName][$val[$fieldName]];?>
				</div>
			
		<?php }?>
			
			<?php //if($val['created'] != '0000-00-00 00:00:00'){ echo date("M d, Y", strtotime($val['created']));}else{ echo 'undefined';}?>
	
		</div>
		<?php }?>
	</td>

<?php }?>
