
<script type='text/javascript' src='<?php echo ROOT?>cms/js/jquery-3.5.1.js'></script>

<style>
.search_output {display:none; background:#EFEFEF; box-shadow:2px 2px 2px rgba(0,0,0,.5); color:#333; max-height:80vh; overflow-y:scroll; cursor:default; position:absolute; z-index:3;}
</style>

<?php 
$id = base64_decode(@$_GET['id']);
$fields_count = count($fields);

if(!empty($id)){     
    
    $_SESSION['refresher_folder'] = $folder;
    $_SESSION['refresher_php'] = $php;
}

if(!empty($_POST['add2020']) || !empty($_POST['update2020']) || !empty($_POST['duplicate2020'])){//['save'] == 'Update'
           
    $uniq_pass = true;
    
    if(!empty($unique_validation)){
        $existed = array();
        foreach((array)$unique_validation as $validateField){

            if($_POST['update2020']){
                $existing = sql_count('select id from '.$table.' where '.$validateField.'=? and id!=?','si',array($_POST[$validateField], $_POST['id']));
            }else{
                $existing = sql_count('select id from '.$table.' where '.$validateField.'=?','s',$_POST[$validateField]);
            }

            if($existing >0){
                $existed[] = $validateField;
            }
        }
        if(count($existed)>0){
            $exist_list = implode(',',$existed);
            $_SESSION['session_msg'] = '<div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
                style="position:relative; top:-2px;">×</a>
                <span style="text-transform:capitalize;">'.$exist_list.'</span> existed, use different <span style="text-transform:capitalize;">'.$exist_list.'</span>.</div>';
            $uniq_pass = false;
        }
    }
        

    if($uniq_pass){

        $save = '<span style="color:red;">Data not saved.</span>';

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

        if($_POST['duplicate2020'] == 'Duplicate'){//add mode
        
            $data = sql_read('select * from '.$table.' where id=? order by id DESC limit 1', 's', $id);	
            unset($data['id']);
            $data['created'] = $data['modified'] = date("Y-m-d h:i:s");
        
            if(sql_save($table, $data)){
                $save = '<span style="color:green;">Data duplicated.</span>';
            }
        }elseif($_POST['add2020'] == 'Add'){//add mode
        
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
                if(sql_save($table, $_POST)){
                    $j = sql_read('select * from '.$table.' order by id DESC limit 1');
                    $jid = $j['id'];
                    foreach((array)$_FILES as $img_field => $v){
                        if(@!empty($_FILES[$img_field][$c]['name'])){                        
                            $img->upload_image($_FILES[$img_field][$c], $table, $img_field, $jid);

                            //Resize image
                            if(!empty($resize_width[$img_field]) && !empty($resize_height[$img_field])){
                                $image = sql_read("select $img_field from $table where id=? limit 1", 'i', $jid);
                                foreach($image as $i){
                                    echo $img->resize_image('../../'.$i, $resize_width[$img_field], $resize_height[$img_field], $crop=FALSE);
                                }
                            }
                        }
                    }
                    $save = '<span style="color:green;">Data added.</span>';
                }
            }
        
            
        }elseif($_POST['update2020'] == 'Update'){//edit mode
            
            $_SESSION['refresher'] = $defender->encrypt('encrypt', $_POST['id']);
            $_FILES = $img->convert_123to132($_FILES);

            $no_of_photo = 0;//0 = 1 photo, because array[0] means 1 photo.
            foreach((array)$_FILES as $field_name => $_FILESpara){
                $count_photo = count($_FILES[$field_name]);
                if($count_photo>1 && $count_photo>$no_of_photo){
                    $no_of_photo = $count_photo-1;//-1 because array key start from 0
                }
            }
                
            for($c=0; $c<=$no_of_photo; $c++){
                if(sql_save($table, $_POST)){
                    foreach((array)$_FILES as $img_field => $v){
                        if(@!empty($_FILES[$img_field][$c]['name'])){
                            $img->upload_image($_FILES[$img_field][$c], $table, $img_field, $id);

                            //Resize image
                            if(!empty($resize_width[$img_field]) && !empty($resize_height[$img_field])){
                                $image = sql_read("select $img_field from $table where id=? limit 1", 'i', $id);
                                foreach($image as $i){
                                    echo $img->resize_image('../../'.$i, $resize_width[$img_field], $resize_height[$img_field], $crop=FALSE);
                                }
                            }
                        }
                    }
                    $save = '<span style="color:green;">Data added.</span>';
                }
            }
            
        }
    }
}



if(!empty($id)){//edit mode
	$data = sql_read('select * from '.$table.' where id=? limit 1', 's', $id);	
	if(!empty($data)){
		foreach((array)$fields as $field){
			if(!empty($data[$field])){
                //if($type[$field] == 'textarea' && $tinymce[$field]==true){
                //    $value[$field] = str_replace('<body', '<body class="bg_tran"', $data[$field]);
                //}else{
                    $value[$field] = $data[$field];
                //}
			}
		}
	}
}
?>
<?php /*
<div class="add-trigger" style="position:relative; top:-24px; left:-24px; z-index:1;">
    <div class="add-trigger-btn" style="width: 50px; height:50px; border-radius:0 0 100%; background-image: linear-gradient(to right, #ff758c 0%, #ff7eb3 100%);box-shadow:2px 2px 3px rgba(0,0,0,.1)" >
        +
    </div>
</div>

<script>
$('.add-trigger').click(function(){
    //var ch = $('#addbody').css('height');
    
    //if(ch != 'auto'){
        $('#addbody').animate({height: 'auto', left: '0'}, 15000, function(){});
    //}else{
     //   $('#addbody').animate({height: '0'}, 1000);
    //}
})

</script>

*/?>

<div id="addbody" class="row pb-1 mb-5" style="border-bottom:1px solid #DDD;">
<div class="col">
<div class="row">
    <div class="col-12">
        <h3 class="pl-2">
            <?php if($id){?>Edit<?php }else{?>Create<?php }?> <?php echo $module_name;?>
            
            <?php if(!empty($_SESSION['proj_name'])){
                if($table == 'packages' || $table == 'project_details' || $table == 'project_photos' || $table == 'project_pdfs' || $table == 'causes_of_delay' || $table == 'contractual_issues'){ 
                    echo '<div style="padding-top:20px; font-size:16px; color:orange; line-height:1.5;">'.$_SESSION['proj_name'].'</div>';
                }
            }?>
            <?php /*if($add==true && $id){?><a href="<?php echo $php?>?tab=<?php echo $_GET['tab']?>" class="btn btn-link" >Add new</a><?php }*/?>
        </h3>
    </div>
    <?php if($back){?>
    <div class="col-2" style="text-align:right;">
        <a class="btn btn-sm" href="cases.php">Back to listing</a>
    </div>
    <?php }?>
</div>


<div class="row">
    <div class="col-12">
    
        <form action="" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone" target="_self">

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
                
                if(empty($attributes[$field])) $attributes[$field] = '';
                if(empty($style[$field])) $style[$field] = '';
                if(empty($type[$field])) $type[$field] = '';
                if(empty($value[$field])) $value[$field] = '';
                if(empty($remark[$field])) $remark[$field] = '';
                if(empty($multiple[$field])) $multiple[$field] = '';
                if(empty($tinymce[$field])) $tinymce[$field] = '';
                if(empty($height[$field])) $height[$field] = '';
                if(empty($width[$field])) $width[$field] = '';              

                
                $attrs = '';
                if($attributes[$field] == true){
                    foreach((array)$attributes[$field] as $att_l => $att_v){
                        $attrs .= ' '.$att_l.'="'.$att_v.'"';
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
                <div class="row p-0">
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




                
    
                    <div class="col-12 <?php echo $field?>" style="margin-top:12px; <?php if($type[$field]=='hidden'){?> display:none;<?php }?>">
                    
                            <?php if($type[$field] != 'hidden' || ($type[$field] == 'photos' && $_GET['id'])){ ?>
                                <label <?php echo $attrs?> style=" <?php if($labelFullRow[$field]==true){?>width:100%;<?php }?>">
                                    <?php if(!empty($label[$field])){ echo $str_convert->field_to_label($label[$field]);}else{echo $str_convert->field_to_label($field);}?>
                                </label>
                            <?php }?>
                            <?php if($type[$field] != 'hidden'){?><div class="div_input" style="width:<?php echo $width[$field]?>"><?php }?>
                            
                            <?php if($type[$field] == 'tag'){?>
                                <div id="tag_module"><?php include("../layout/tag_input.php");?></div>
                            <?php }elseif($type[$field] == 'photos'){?>
                                    <?php if(!empty($_GET['id'])){?>
                                        <div id="photos_module"><?php include("../layout/photos.php");?></div>
                                    <?php }?>
                            <?php }elseif($type[$field] == 'select'){


                                if(isset($value[$field])){
                                    $checked=$value[$field];               
                                }else{
                                    $checked=$default_value[$field];
                                }?>
                                <select name="<?php echo $field?>" <?php echo $attrs?> style=" <?php echo $styles?>" class="<?php if($child[$field]){?> parent-filter-child<?php }?>">
                                    <?php foreach((array)$option[$field] as $option_v => $option_name){?>
                                    <option value="<?php echo $option_v?>" <?php if($checked == $option_v){?> selected <?php }?> 
                                    
                                    <?php 
                                    if(!empty($parent[$field])){?>
                                        parent-name="<?php echo $parent[$field]?>" parent-value="<?php echo $parent_val[$field][$option_v]?>" 
                                    <?php }?>
                                    ><?php echo $option_name?></option>
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
                                <label style="width:auto; padding-right:20px;">
                                    <input name="<?php echo $field?>" value="<?php echo $option_v?>" type="radio" <?php if($checked==$option_v){?>checked<?php }?> <?php echo $attrs?> style=" <?php echo $styles?>; width:20px;"> 
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
                                        <input type="checkbox" value="<?php echo $option_v?>" <?php if(in_array($option_v, $v)){?> checked="checked" <?php }?> name="<?php echo $field?>[]" <?php echo $attrs?> style=" float:left; width:30px; position:relative; top:-2px; <?php echo $styles?>">
                                        <?php echo $option_name;?>
                                    </label>
                                    <?php }?>
                                
                            <?php }elseif($type[$field] == 'parent'){
                                $ps=sql_read('select * from '.$p_table[$field].' where status=1 order by position ASC');
                                ?>
                                
                                <select name="<?php echo $field?>" <?php echo $attrs?> style=" <?php echo $styles?>">
                                    <?php foreach((array)$ps as $p){?>
                                    <option value="<?php echo $p[$p_value[$field]]?>" <?php if($value[$field] == $p[$p_value[$field]]){?> selected <?php }?>><?php echo $p[$p_title[$field]]?></option>
                                    <?php }?>
                                </select>
                            <?php }elseif($type[$field] == 'date'){?>
                                <input name="<?php echo $field?>" type="text" class="datepicker" value="<?php echo $value[$field]?>" <?php echo $attrs?> style="width:<?php echo $width[$field]?> <?php echo $styles?>"> 
                            <?php }elseif($type[$field] == 'image' || $type[$field] == 'video'){?>
                                <div class="col-12" style="margin-bottom:10px; text-align:left;">
                                
                                
                                    <?php $i++;
                                    if($i ==1){
                                        if(!empty($remark[$field])){
                                            echo $remark[$field];
                                        }else{
                                            echo '<div><small class="text-muted" >Recommanded size: 1200 x 1000 pixel</small></div>';
                                        }
                                    }?>
                                <?php if($_GET['id']){//Remove feature only available when edit mode?>
                                    <div class="col" style=" padding:0;">
                                        <?php if($type[$field] == 'image'){?>
                                        
                                            <div class="def_img_bg" id="preview<?php echo $field?>" style="overflow:show;">
                                                <img src="../../<?php echo $value[$field]?>" class="img-fluid" alt="" >
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
                                            <div class="col-12" id="preview<?php echo $field?>">
                                                <div class="col-12" style="z-index:1; background:black;">
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
                                                <div class="col-12" style="margin:10px 0 20px 0;">
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
                                        
                                        $.post( "../layout/remove_img.php", {table:table, id:id, field:field}, function( result ) {
                                            $("#preview"+field).fadeOut();
                                        });
                                    }
                                    function unlink_video(table, id, field){
                                        $.post( "../layout/unlink_img.php", {table:table, id:id, field:field}, function( result ) {
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
                                        <div style="text-align: right;">
                                            <?php if($tinymce_photo){?>
                                                <div class="mymodal-btn btn btn-xs btn-default list-edit" link="../layout/photos.php?parent_table=<?php echo $table?>&parent_id=0" style="padding-right:6px; color:white;">
                                                    <img src="../../cms/images/photo.png" style="margin-right:3px;">
                                                    Upload Photos
                                                </div>
                                            <?php }?>
                                        </div>
                                        <textarea name="<?php echo $field?>" class="tinymce" style="height:<?php echo $height[$field]?>; width:<?php echo $width[$field]?>; <?php echo $styles?>"
                                        <?php echo $attrs?>><?php echo $value[$field]?></textarea>
                                    </div>
                                <?php }else{?>
                                    <div>
                                        <textarea name="<?php echo $field?>" <?php echo $attrs?> 
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
                                <input type="<?php echo $type[$field]?>" name="<?php echo $field?>[]" value="<?php echo $value[$field]?>" <?php echo $attrs?> style=" display:inline-block; width:84%; <?php echo $styles?>">
                                </div>
                                
                            <?php }elseif($type[$field] == 'password'){?>
                                <input type="<?php echo $type[$field]?>" name="<?php echo $field?>" value="" <?php echo $attrs?> minlength="5" style="width:<?php echo $width[$field]?> <?php echo $styles?>">
                            <?php }else{?>
                                <input type="<?php echo $type[$field]?>" name="<?php echo $field?>" value="<?php echo $value[$field]?>" <?php echo $attrs?> style="width:<?php echo $width[$field]?> <?php echo $styles?>">
                            <?php }?>
                            <?php if($type[$field] != 'hidden'){?></div><?php }?>


                            <?php 
                            if($type[$field] != 'image' && $type[$field] != 'video'){
                                if(!empty($remark[$field])){
                                    echo '<label></label><div class="div_input" style="padding-left:4px; color: gray;">'.$remark[$field].'</div>';
                                }
                            }
                            ?>

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
                //if($_SESSION['group_id'] == '1' || $table == 'product'){
                if(!empty($id)){?>
                    <input type="submit" name="update2020" value="Update" class="btn" >
                    <?php if($duplicate == true){?>
                        <input type="submit" name="duplicate2020" value="Duplicate" class="btn" >
                    <?php }?>
                <?php }else{?>
                    <input type="submit" name="add2020" value="Add" class="btn" >
                <?php }
                //}?>
                <?php if($save){echo $save;}?>
            </div>
            


            
            <?php //include("multiple_photo.php");?>                                   
            
        </form>
    </div>
</div>
</div>
</div>

<?php include '../layout/mymodal.php';?>




<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=gatdhrv8n8doaiigadcftgdcvtqx6wrdigixtfxcw5w0lpqp"></script>
<script>
/*
tinymce.init({
selector: '.inline_tinymce',
inline: true,
theme: 'modern',
plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help code',
toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
image_advtab: true,
templates: [
{ title: 'Test template 1', content: 'Test 1' },
{ title: 'Test template 2', content: 'Test 2' }
],
content_css: [
	'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
	'//fonts.googleapis.com/css?family=Raleway',
	//'//www.tinymce.com/css/codepen.min.css'
]
}); */
tinymce.init({
selector: '.tinymce',
theme: 'modern',
plugins: 'noneditable print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help code',
toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor fontsizeselect | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
noneditable_noneditable_class: "mceNonEditable",
image_advtab: true,
templates: [
{ title: 'Test template 1', content: 'Test 1' },
{ title: 'Test template 2', content: 'Test 2' }
],
content_css: [
	'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
	'//fonts.googleapis.com/css?family=Raleway',
	//'//www.tinymce.com/css/codepen.min.css'
]
});


</script>
<style>
.mce-notification-inner, #mceu_0 {display:none!important;}
#mceu_17 { box-shadow:1px 1px 2px gray; border:1px solid lightgray; }
</style>


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
