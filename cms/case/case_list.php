<?php 
require_once '../../config/ini.php'; 
session_start();
?>
<style>
.yellow {
	background-color:#FF9;	
}
</style>
<div style="width:703px; ">
<?php 
if(!empty($_POST['keyword'])){

	$k = mysqli_real_escape_string($conn, $_POST['keyword']);
	if($_POST['time'] =='pass'){
		$t = " AND (actual >= target OR end_date <= '".date("Y-m-d")."')";
	}else{
		$t = " AND (end_date > '".date("Y-m-d")."' AND actual < target)";
	}
	
	
	
	$cases = readData($conn, "cases", " title!='' AND title LIKE '%".$k."%' ORDER BY id DESC");
	
	if(!empty($cases)){?>
    <div style="width:100%; padding:4px;"><?php echo $_POST['keyword']?></div>
    
		<?php foreach((array)$cases as $case){?><!--
			--><div class="ky_option" id="case_<?php echo $case['id']?>" name="<?php echo $case['title']?>" onclick="choose_case('<?php echo $case['id']?>');">
				<div class="case_thum" style=" background-image:url(../../<?php echo $case['photo01'];?>);"></div>
				<div class="case_name">
					<?php echo str_replace($_POST['keyword'], '<span class="yellow">'.$_POST['keyword'].'</span>', $case['title']);?>	
				</div>
			</div><!--
            --><?php 
		}
	}
}
?>
</div>