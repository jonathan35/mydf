<style>
.result-row {background-color:#EFEFEF; border-bottom:1px solid #CCC; padding:6px; transition: background-color .5s;}
.result-row:hover {background-color:#FFF;}
</style>
<style>
.highlight {  font-weight:bold;}
</style>
<?php 
require_once '../../config/ini.php'; 




$output = 'Searching..';


//if(!empty($_POST['keyword'])){
	//echo '<pre>';
	//print_r($_POST);
	
	$keywords = explode(" ", $_POST['keyword']);
	
	$qs = "SELECT * FROM ".$_POST['table']." WHERE status = '1' AND ( "; 
	$a=1;
	foreach((array)$keywords as $keyword){
		//if(!empty($keyword)){
			if($a!=1) $qs .= " AND ";
			$qs .= $_POST['field']." LIKE '%".$keyword."%' ";
			$a++;
		//}
	}
	$qs .= ") ORDER BY ".$_POST['field']." ASC";
	//echo $qs;
	
	$q = mysqli_query($conn, $qs);
	$num_rows = mysqli_num_rows($q);
	
	if($num_rows > 0){
	
		while($result = mysqli_fetch_assoc($q)){
			
			$aa = readData($conn, 'project_details', "package='".$result['id']."'", 'package_date ASC');
			foreach((array)$aa as $a){
				echo '<div class="col-12 result-row" data-input="'.$_POST['input'].'" data-val="'.$a['id'].'" onClick="autofil(this);">';
				echo $result[$_POST['field']].' ('.$a['package_date'].')';
				echo '</div>';
			}
		}

	
	}else{
		echo '<div class="col-12" style="border-bottom:1px solid #EFEFEF;">
			No data found.
		</div>';
		
	}
	//echo '</pre>';	
	
//}

?>
