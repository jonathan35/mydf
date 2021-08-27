<style>
.search_output {display:none; background:#EFEFEF; box-shadow:2px 2px 2px rgba(0,0,0,.5); color:#333; max-height:80vh; overflow-y:scroll; cursor:default; position:absolute; z-index:3;}
</style>

<?php 
$id = base64_decode(@$_GET['id']);
$fields_count = count($fields);

if($_POST['add'] || $_POST['update'] || $_POST['duplicate'] == 'Duplicate'){//['save'] == 'Update'
	$save = '<span style="color:red;">Data not saved.</span>';
    

	if(!empty($_GET['case'])){
		$case_id = base64_decode($_GET['case']);
	}else{
		$case_id = base64_decode($_GET['case_id']);	
	}
	
    

	foreach((array)$fields as $f){
		if($type[$f]=='checkbox'){
			$_POST[$f] = serialize($_POST[$f]);
		}
		if($type[$f]=='password'){
			if(empty($_POST[$f])){
				unset($_POST[$f]);
			}else{
				$_POST[$f] = hash('md5',$_POST[$f]);
			}
		}
	}

	/*if($_POST['duplicate'] == 'Duplicate'){//add mode
	
		$data = sql_read('select * from '.$table.' where id=? order by id DESC', 's', $id);	
		unset($data['id']);
		$data['created'] = $data['modified'] = date("Y-m-d h:i:s");
	
		if(sql_save($table, $data)){
			$save = '<span style="color:green;">Data duplicated.</span>';
		}
    }else*/
    
    if($_POST['add'] == 'Add'){//add mode
       
		if(!empty($unique_validation)){
			$existed = array();
			foreach((array)$unique_validation as $validateField){
                $existing = sql_count('select id from '.$table.' where '.$validateField.'=?','s',$_POST[$validateField]);
				
				if($existing >0){
					$existed[] = $validateField.' exist, use other '.$validateField;	
				}
				//echo $existing;
				//echo $validateField.'...';				
			}
			if(count($existed)>0){
				return false;
			}
		}
		
		//if(strstr($_POST['date'], '/')){
		//	$_POST['date'] = date("Y-m-d", strtotime(substr($_POST['date'],3,2).'/'.substr($_POST['date'],0,2).'/'.substr($_POST['date'],6,4)));
		//}
		
		unset($_POST['id']);
		
	
		$_FILES = $img->convert_123to132($_FILES);
			
		$no_of_photo = 0;//0 = 1 photo, because array[0] means 1 photo.
		foreach((array)$_FILES as $field_name => $_FILESpara){
			$count_photo = count($_FILES[$field_name]);
			if($count_photo>1 && $count_photo>$no_of_photo){
				$no_of_photo = $count_photo-1;//-1 because array key start from 0
			}
		}
			
		for($c=0; $c<=$no_of_photo; $c++){            
            
            $count_post = @count($_POST);
            $c = 1;
            if($count_post>0){
                $vals = $col = ' (';
                foreach((array)$_POST as $pk => $pv){
                    $col .= $pk;
                    $vals .= '?';
                    if($c<$count_post){ $col .= ','; $vals .= ',';}
                    $c++;
                }
                $col .= ')';
                $vals .= ')';
            }
            
            if(sql_save('insert into '.$table.' ', str_repeat('s',$count_post) , $_POST)){//sql_save($table, $_POST)
				$j = sql_read('select * from '.$table.' order by id DESC limit 1');
				$jid = $j['id'];
				foreach((array)$_FILES as $img_field => $v){
					if(@!empty($_FILES[$img_field][$c]['name'])){                        
						$img->upload_image($_FILES[$img_field][$c], $table, $img_field, $jid);
					}
				}
				$save = '<span style="color:green;">Data added.</span>';
			}
		}
        
	}elseif($_POST['update'] == 'Update'){//edit mode
        
		if(strstr($_POST['date'], '/')){
			$_POST['date'] = date("Y-m-d", strtotime(substr($_POST['date'],3,2).'/'.substr($_POST['date'],0,2).'/'.substr($_POST['date'],6,4)));
		}
		
		//$_POST['created'] = date("Y-m-d", strtotime(substr($_POST['created'],3,2).'/'.substr($_POST['created'],0,2).'/'.substr($_POST['created'],6,4)))." 00:00:00";
		$_POST['modified'] = date("Y-m-d h:i:s");
		
		$_FILES = $img->convert_123to132($_FILES);
			
		$no_of_photo = 0;//0 = 1 photo, because array[0] means 1 photo.
		foreach((array)$_FILES as $field_name => $_FILESpara){
			$count_photo = count($_FILES[$field_name]);
			if($count_photo>1 && $count_photo>$no_of_photo){
				$no_of_photo = $count_photo-1;//-1 because array key start from 0
			}
		}
			
		for($c=0; $c<=$no_of_photo; $c++){

            $id = $_POST['id'];
            unset($_POST['id']);
            $count_post = @count($_POST);
            $c = 1;
            if($count_post>0){
                $update_qry = ' set ';
                foreach((array)$_POST as $pk => $pv){
                    $udata[] = $pv;
                    $update_qry .= $pk.'=?';
                    if($c<$count_post){ $update_qry .= ', ';}
                    $c++;
                }
            }
            $udata[] = $id;
            $update_qry .= ' where id=? ';


            debug($_POST);
            $save = '<span style="color:red;">Data not Updat111e.</span>';
            echo 'update '.$table.' '.$update_qry;
            echo str_repeat('s',count($udata));
            debug($udata);
            if(sql_save('update '.$table.' '.$update_qry, str_repeat('s',count($udata)), $udata)){
                $save = '<span style="color:red;">Data nasdsdsadsadot Update.</span>';
			//sql_save($table, $_POST)
				foreach((array)$_FILES as $img_field => $v){
					if(@!empty($_FILES[$img_field][$c]['name'])){
						$img->upload_image($_FILES[$img_field][$c], $table, $img_field, $id);
					}
				}
				$save = '<span style="color:green;">Data added.</span>';
            }
            debug($_SESSION['sql_error']);
		}
	}
}



if(!empty($id)){//edit mode
	$data = sql_read('select * from '.$table.' where id=? limit 1', 's', $id);	
	if(!empty($data)){
		foreach((array)$fields as $field){
			if(!empty($data[$field])){
				$value[$field] = $data[$field];
			}
		}
	}
}


if(!empty($value['package_date'])){
$value['package_date'] = substr($value['package_date'],8,2).'/'.substr($value['package_date'],5,2).'/'.substr($value['package_date'],0,4);
}
if(!empty($value['duration_and_progress_update_date'])){
$value['duration_and_progress_update_date'] = substr($value['duration_and_progress_update_date'],8,2).'/'.substr($value['duration_and_progress_update_date'],5,2).'/'.substr($value['duration_and_progress_update_date'],0,4);
}
if(!empty($value['contract_commencement_date'])){
$value['contract_commencement_date'] = substr($value['contract_commencement_date'],8,2).'/'.substr($value['contract_commencement_date'],5,2).'/'.substr($value['contract_commencement_date'],0,4);
}
if(!empty($value['contract_completion_date'])){
$value['contract_completion_date'] = substr($value['contract_completion_date'],8,2).'/'.substr($value['contract_completion_date'],5,2).'/'.substr($value['contract_completion_date'],0,4);
}
if(!empty($value['revised_completion_date'])){
$value['revised_completion_date'] = substr($value['revised_completion_date'],8,2).'/'.substr($value['revised_completion_date'],5,2).'/'.substr($value['revised_completion_date'],0,4);
}
if(!empty($value['financial_statement_update_date'])){
$value['financial_statement_update_date'] = substr($value['financial_statement_update_date'],8,2).'/'.substr($value['financial_statement_update_date'],5,2).'/'.substr($value['financial_statement_update_date'],0,4);
}
if(!empty($value['contractual_issues_update_date'])){
$value['contractual_issues_update_date'] = substr($value['contractual_issues_update_date'],8,2).'/'.substr($value['contractual_issues_update_date'],5,2).'/'.substr($value['contractual_issues_update_date'],0,4);
}
if(!empty($value['workdone_for_all_package_update_date'])){
$value['workdone_for_all_package_update_date'] = substr($value['workdone_for_all_package_update_date'],8,2).'/'.substr($value['workdone_for_all_package_update_date'],5,2).'/'.substr($value['workdone_for_all_package_update_date'],0,4);
}


?>

<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
	<h3>
		<?php if($id){?>Edit<?php }else{?>Add<?php }?> <?php echo $module_name;?>
        <?php if(!empty($_SESSION['proj_name'])){
            if($table == 'packages' || $table == 'project_details' || $table == 'project_photos' || $table == 'project_pdfs' || $table == 'causes_of_delay' || $table == 'contractual_issues'){ 
                echo '<div style="padding-top:20px; font-size:16px; color:orange; line-height:1.5;">'.$_SESSION['proj_name'].'</div>';
            }
        }?>
        <?php if($add==true && $id){?><a href="<?php echo $php?>?tab=<?php echo $_GET['tab']?>" class="btn btn-link" >Add new</a><?php }?>
    </h3>
</div>
<?php if($back){?>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="text-align:right;">
    <a class="btn btn-sm btn-default" href="cases.php">Back to listing</a>
</div>
<?php }?>
<div class="col-12 p-0">
    <form action="" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
		<?php 
		$rowEnd = $rowStart = $colEnd = $colStart = $colCount = array();
		
		$rowItems = 0;
		foreach((array)$fic_1 as $fic_r => $fic_i){
			foreach((array)$fic_i as $a => $b){
				$rowItems += $b;
			}
			$rowEnd[$fic_r] = $rowItems;
			$colCount[$fic_r] = count($fic_i);
		}
		foreach((array)$rowEnd as $bEnd => $bEndV){
			$rowStartByRow = $bEndV - ($rowEnd[$bEnd]-$rowEnd[$bEnd-1])+1;
			$rowStart[$bEnd] = $rowStartByRow;
		}
		$bb = $c = 0;
		foreach((array)$fic_1 as $cStart){
			foreach((array)$cStart as $a => $b){
				$bb += $b;
				$colEnd[$c] = $bb;
				$colStart[$c] = ($colEnd[$c]-$b)+1;
				$c++;
			}
		}

		
        $item = 1;
        $i = $col = $rowCount = 0;
        foreach((array)$fields as $field){
            
            if(empty($attribute[$field])) $attribute[$field] = '';
            if(empty($style[$field])) $style[$field] = '';
            if(empty($type[$field])) $type[$field] = '';
            if(empty($value[$field])) $value[$field] = '';
            if(empty($remark[$field])) $remark[$field] = '';
            if(empty($multiple[$field])) $multiple[$field] = '';
            if(empty($tinymce[$field])) $tinymce[$field] = '';
            if(empty($height[$field])) $height[$field] = '';
            if(empty($width[$field])) $width[$field] = '';              

			
			$attrbutes = '';
			if($attribute[$field] == true){
				foreach((array)$attribute[$field] as $att_l => $att_v){
					$attrbutes .= ' '.$att_l.'="'.$att_v.'"';
				}
			}
            $styles = '';
            if(!empty($style[$field])){
                if($style[$field] == true){
                    foreach((array)$style[$field] as $att_l => $att_v){
                        $styles .= ' '.$att_l.':'.$att_v.'; ';
                    }
                }
            }

			if(in_array($item, $rowStart)){?>
            <div class="col-12 p-0">
			<?php }?>
            
            <?php 
			$column_code = ' display:inline-block; float: left; position: relative; min-height: 1px; padding-left: 15px; box-sizing: border-box;';
			if($colCount[$rowCount]>=2){
				$d = 100/$colCount[$rowCount]-3;
				$column_code .= 'width:'.$d.'%; padding-right:3%;';
			}else{
				$column_code .= 'width:100%;';
			}
			//echo $column_code; 
			if(in_array($item, $colStart)){?>
                <div style=" <?php echo $column_code?>">
            <?php }?>
    
            
                   <div class="col-12 p-0 <?php echo $field?>" style="margin-top:12px; <?php if($type[$field]=='hidden'){?> display:none;<?php }?>">
                   
                   
                   
                   
                        <?php if($type[$field] != 'hidden' || ($type[$field] == 'photos' && $_GET['id'])){ ?>
                            <label <?php echo $attrbutes?> style=" <?php if($labelFullRow[$field]==true){?>width:100%;<?php }?>">
                                <?php if(!empty($label[$field])){ echo $str_convert->field_to_label($label[$field]);}else{echo $str_convert->field_to_label($field);}?>
                            </label>
                        <?php }?>
                        <?php if($type[$field] != 'hidden'){?><div class="div_input" style="width:<?php echo $width[$field]?>"><?php }?>
                        
                        <?php if($type[$field] == 'tag'){?>
                            <div id="tag_module"><?php include(ROOT."cms/layout/tag_input.php");?></div>
                        <?php }elseif($type[$field] == 'photos'){?>
                                <?php if(!empty($_GET['id'])){?>
                                    <div id="photos_module"><?php include(ROOT."cms/layout/photos.php");?></div>
                                <?php }?>
                        <?php }elseif($type[$field] == 'select'){
                            if(isset($value[$field])){
                                $checked=$value[$field];               
                            }else{
                                $checked=$default_value[$field];
                            }?>
                            <select name="<?php echo $field?>" <?php echo $attrbutes?> style=" <?php echo $styles?>">
                                <?php foreach((array)$option[$field] as $option_v => $option_name){?>
                                <option value="<?php echo $option_v?>" <?php if($checked == $option_v){?> selected <?php }?>><?php echo $option_name?></option>
                                <?php }?>
                            </select>   
                        <?php }elseif($type[$field] == 'radio'){
                            if(isset($value[$field])){
                                $checked=$value[$field];
                            }elseif($field == 'project' && !empty($_SESSION['proj_id'])){
                                $checked = $_SESSION['proj_id'];
                            }else{
                                $checked=$default_value[$field];
                            }
                            
                            foreach((array)$option[$field] as $option_v => $option_name){?>
                            <label style="width:auto;">
                                <input name="<?php echo $field?>" value="<?php echo $option_v?>" type="radio" <?php if($checked==$option_v){?>checked<?php }?> <?php echo $attrbutes?> style=" <?php echo $styles?>; width:20px;"> 
                                <span style="position:relative; top:-2px;"><?php echo $option_name?></span>
                            </label>
                            <?php }?>                 

                        <?php }elseif($type[$field] == 'datalist'){
                            if(!empty($value[$field])){
                                $checked=$value[$field];                            
                            }else{
                                $checked=$default_value[$field];
                            }?>
                            <input type="text" list="list<?php echo $field?>" value="<?php echo $option[$field][$value[$field]]?>" id="autoselect<?php echo $field?>" var 
                            data-table="packages" data-sfield="package_name" data-order="package_name ASC" data-display="package_name"/>
                            <datalist id="list<?php echo $field?>">
                                <?php foreach((array)$option[$field] as $option_v => $option_name){?>
                                    <option value="<?php echo $option_name?>" <?php if($checked == $option_v){?> selected <?php }?> 
                                    data-value="<?php echo $option_v?>"><?php echo $option_name?></option>
                                <?php }?>
                            </datalist>                           
							<input type="hidden" name="<?php echo $field?>" id="autoselect<?php echo $field?>-hidden" value="<?php echo $value[$field]?>" >
                        <?php }elseif($type[$field] == 'autosuggest'){                           
                            
                            if(empty($value[$field]) && !empty($_SESSION[$field])){
                               $value[$field]=$_SESSION[$field];////Last Selected value
                            }elseif($field == 'hidden-package' && !empty($_SESSION['pack_id'])){
                                $value[$field] = $_SESSION['pack_id'];//Global Search value
                            }?>
                            <input type="text" value="<?php echo $option[$field][$value[$field]]?>" class="search_input" id="search-input-<?php echo $field?>"
                             autocomplete="off" data-input="<?php echo $field?>" data-table="<?php echo $foreign_table[$field]?>" data-field="<?php echo $foreign_field[$field]?>"/>
                            <div class="search_output output<?php echo $field?>">
                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                            </div>
							<input type="hidden" name="<?php echo $field?>" id="hidden-<?php echo $field?>" value="<?php echo $value[$field]?>" >


                        <?php }elseif($type[$field] == 'checkbox'){
					   $v = unserialize($value[$field]);
                            ?>
                                <?php foreach((array)$option[$field] as $option_v => $option_name){?>
                                <label style="padding-left:0; width:auto; padding-right:30px;">
                                     <input type="checkbox" value="<?php echo $option_v?>" <?php if(in_array($option_v, $v)){?> checked="checked" <?php }?> name="<?php echo $field?>[]" <?php echo $attrbutes?> style=" float:left; width:30px; position:relative; top:-2px; <?php echo $styles?>">
                                     <?php echo $option_name;?>
                                </label>
                                <?php }?>
                            
                        <?php }elseif($type[$field] == 'parent'){
                            $ps=sql_read('select * from '.$p_table[$field].' where status=1 order by position ASC');
                            ?>
                            
                            <select name="<?php echo $field?>" <?php echo $attrbutes?> style=" <?php echo $styles?>">
                                <?php foreach((array)$ps as $p){?>
                                <option value="<?php echo $p[$p_value[$field]]?>" <?php if($value[$field] == $p[$p_value[$field]]){?> selected <?php }?>><?php echo $p[$p_title[$field]]?></option>
                                <?php }?>
                            </select>
                        <?php }elseif($type[$field] == 'date'){?>
                            <input name="<?php echo $field?>" type="text" class="datepicker" value="<?php echo $value[$field]?>" <?php echo $attrbutes?> style="width:<?php echo $width[$field]?> <?php echo $styles?>"> 
                        <?php }elseif($type[$field] == 'image' || $type[$field] == 'video'){?>
                            <div class="col-12" style="margin-bottom:10px; text-align:left;">
                            
                            
                                <?php $i++;
                                if($i ==1){
                                    if(!empty($remark[$field])){
                                        echo $remark[$field];
                                    }else{
                                        echo '<div><small class="text-muted" >Recommanded size: 800 x 400 pixel</small></div>';
                                    }
                                }?>
                               <?php if($_GET['id']){//Remove feature only available when edit mode?>
                                <div class="col" style=" padding:0;">
                                    <?php if($type[$field] == 'image'){?>
                                    
                                        <div class="def_img_bg" id="preview<?php echo $field?>" style="overflow:show;">
                                            <img src="../../<?php echo $value[$field]?>" class="img-responsive" alt="" >
															<?php if(!empty($value[$field])){?>
                                                   <div class="btn btn-xs btn-danger" onclick="removeImg('<?php echo $table?>','<?php echo $id?>', '<?php echo $field?>')" 
                                                   style="margin:10px 0 20px 0;">
                                                      <span class="glyphicon glyphicon-remove" style="color:white;" ></span>Remove
                                                   </div>
                                             <?php }?>
                                        </div>                                     
                                    <?php }elseif($type[$field] == 'video'){
                                            if(!empty($value[$field])){
                                            ?>
                                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="preview<?php echo $field?>">
                                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="z-index:1; background:black;">
                                                <div class="item text-center" style="background:black; ">
                                                    <video width="100%" controls>
                                                      <?php if(!empty($value[$field])){?>
                                                        <source src="<?php echo ROOT.$value[$field]?>" type="video/mp4">
                                                        <?php }?>
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                                <span class=""></span>
                                             </div>
                                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin:10px 0 20px 0;">
                                                <div class="btn btn-xs btn-danger" onclick="removeImg('<?php echo $table?>','<?php echo $id?>', '<?php echo $field?>')">
                                                   <span class="glyphicon glyphicon-remove" style="color:white;" ></span>Remove
                                                </div>
                                                <div class="btn btn-xs btn-warning" onclick="removeImg('<?php echo $table?>','<?php echo $id?>', '<?php echo $field?>')">
                                                   <span class="glyphicon glyphicon-remove" style="color:white;" ></span>Unlink
                                                </div>
                                             </div>
                                          </div>
                                    	<?php }else{?>
                                    
                                           <div style="border:1px solid red; padding:6px 18px 8px 12px; width:43px; border-radius:4px; border:1px solid #D9686B;">
                                               <span class="glyphicon glyphicon-play" style="color:#D9686B; font-size:20px;"></span>
                                           </div>
                                        <?php }?>
                                    <?php }?>
                                </div>
                                
                                <div class="col">
                                 <script>
                                 function removeImg(table, id, field){
												$.post( "layout/remove_img.php", {table:table, id:id, field:field}, function( result ) {
                                         $("#preview"+field).fadeOut();
                                    });
                                 }
                                 function unlink_video(table, id, field){
                                    $.post( "layout/unlink_img.php", {table:table, id:id, field:field}, function( result ) {
                                         $("#preview"+field).fadeOut();
                                     });
                                 }
                                 </script>
                                </div>
                                <?php }else{?>
                                    <?php if($type[$field] != 'image'){?>
                                        <div style="border:1px solid red; padding:6px 18px 8px 12px; width:43px; border-radius:4px; border:1px solid #D9686B;">
                                            <span class="glyphicon glyphicon-play" style="color:#D9686B; font-size:20px;"></span>
                                        </div>
                                    <?php }?>
                                <?php }?>
                                <div class="col" style="padding:0;">
                                    <input name="<?php echo $field?>[]" type="file" value="<?php echo $value[$field]?>" <?php if(empty($_GET['id'])){ echo $required[$field]; }?>
                                    accept="
                                    <?php if($type[$field] == 'image'){?>
                                        .png,.gif,.jpg,.jpeg
                                    <?php }elseif($type[$field] == 'video'){?>
                                        .webm,.mkv,.flv,.vob,.avi,.wmv,.mov,.rmvb,.mp4,.mpg
                                    <?php }?>" style=" <?php echo $styles?>; 
                                    <?php if($multiple[$field] == true){?>
                                         border:1px dashed #CCC; text-align:center; width:100%; 
                                         padding-top:40px; padding-bottom:20px; background-color:rgba(200,200,200,.2); margin-left:0; left:0; position:relative;
                                    <?php }?>"
                                    <?php if($multiple[$field] == true){?>
                                         multiple="multiple"
                                    <?php }?>
                                    onchange="readURL(this);"
                                    >
                                    <!--<img id="blah" src="#" alt="your image" />-->
                                    <?php if($multiple[$field] == true){?>
                                    <span style="position:relative; top:-70px; height:0; overflow:visible; left:6px; width:100%; font-size:14px; color:#999;">
                                        <span class="glyphicon glyphicon-picture" style="color:#ccc; font-size:18px;"></span>
                                        Drop files to upload
                                    </span>
                                    <?php }?>
                                </div>
                                
                            </div>
                        <?php }elseif($type[$field] == 'textarea'){?>
                            <?php if($tinymce[$field]==true){?>
                                <div>
                                    <textarea name="<?php echo $field?>" class="tinymce" style="height:<?php echo $height[$field]?>; width:<?php echo $width[$field]?>; <?php echo $styles?>"
                                    <?php echo $attrbutes?>><?php echo $value[$field]?></textarea>
                                </div>
                            <?php }else{?>
                                <div>
                                    <textarea name="<?php echo $field?>" <?php echo $attrbutes?> 
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
                            <input type="<?php echo $type[$field]?>" name="<?php echo $field?>[]" value="<?php echo $value[$field]?>" <?php echo $attrbutes?> style=" display:inline-block; width:84%; <?php echo $styles?>">
                            </div>
                            
                        <?php }elseif($type[$field] == 'password'){?>
                            <input type="<?php echo $type[$field]?>" name="<?php echo $field?>" value="" <?php echo $attrbutes?> minlength="5" style="width:<?php echo $width[$field]?> <?php echo $styles?>">
                        <?php }else{?>
                            <input type="<?php echo $type[$field]?>" name="<?php echo $field?>" value="<?php echo $value[$field]?>" <?php echo $attrbutes?> style="width:<?php echo $width[$field]?> <?php echo $styles?>">
                        <?php }?>
                        <?php if($type[$field] != 'hidden'){?></div><?php }?>
                    </div>
            
            	<?php if(in_array($item, $colEnd)){?>
                </div>
				<?php }?>
                
        	<?php if(in_array($item, $rowEnd)){ $rowCount++;?>
            </div>
			<?php }?> 
        <?php 
        $item++;
        }?>
        <div class="col-12" style="text-align:center; padding:30px;">
            <?php 
            if($_SESSION['group_id'] == '1'){
            if(!empty($id)){?>
                <input type="submit" name="update" value="Update" class="btn btn-primary" >
                <?php if($duplicate == true){?>
                	<input type="submit" name="duplicate" value="Duplicate" class="btn btn-primary" >
                <?php }?>
            <?php }else{?>
                <input type="submit" name="add" value="Add" class="btn btn-primary" >
            <?php }
            }?>
            <?php if($save){echo $save;}?>
        </div>
        
        
		<?php //include("multiple_photo.php");?>                                   
        
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

<script>
function readURL(input) {
   if (input.files && input.files[0]) {
	  var reader = new FileReader();

	  reader.onload = function (e) {
		 $('#blah')
			.attr('src', e.target.result)
			.width(150)
			.height(200);
	  };
	  reader.readAsDataURL(input.files[0]);
   }
}	                                
</script>
