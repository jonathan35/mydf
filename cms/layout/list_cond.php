<?php


if(in_array("status",$fields)){
	
	if(!empty($_GET['tab'])){
		$params[] = array_search($_GET['tab'], $option['status']);
		$condition = ' where status=? ';
	}else{
		$params[] = 1;
		$condition = ' where status=?';
	}
}else{
	$params[] = '';
	$condition = " where id !=? ";
}


$condition_ext = '';

if(!empty($_GET['list_cond'])){//format are &list_cond=belong:news_releases-1
	$paras = explode(",",$_GET['list_cond']);
	foreach((array)$paras as $para){
		$co = explode(":",$para);
		$condition .= ' AND '.$co[0]."='".$co[1]."'";
	}
}


if(!empty($_POST['submit']) || $_GET['filter'] == 'reset'){
	if($_POST['submit'] == 'Search'){
		
		foreach((array)$_POST as $postname => $postvalue){
			if(empty($postvalue)){
				if($postname == 'keyword'){
					$_SESSION[$module_name.'-search-'.$postname] = '';
				}else{
					$_SESSION[$module_name.'-filter-'.$postname] = '';
				}
			}elseif($postname != 'submit'){
				if($postname == 'keyword'){
					$_SESSION[$module_name.'-search-'.$postname] = $postvalue;
				}else{
					$_SESSION[$module_name.'-filter-'.$postname] = $postvalue;
				}
			}
		}
	}elseif($_POST['submit'] == 'Reset' || $_GET['filter'] == 'reset'){
		
		foreach((array)$_SESSION as $sn => $sv){
			
			if(strpos($sn, '-search-') || strpos($sn, '-filter-')){
				$_SESSION[$sn] = '';
			}
		}
	}
}



foreach((array)$_SESSION as $sessionname => $sessionvalue){	
		
	if($keyword == true){
		if(strpos($sessionname, '-search-')){
			if(!empty($_SESSION[$sessionname])){
				$k=$_SESSION[$sessionname];
				$condition_ext .= " AND (";
				if($keywordMustFullWord==true){
					$p=1;
					foreach((array)$keywordFields as $f){
						if($p!=1){$condition_ext.=" OR ";}$p++;
						$params[] = ' [[:<:]]'.$k.'[[:>:]]';
						$condition_ext .= $f.' REGEXP ?';
					}
				}else{
					$p=1;
					foreach((array)$keywordFields as $f){
						if($p!=1){$condition_ext.=" OR ";}$p++;
						$params[] = '%'.$k.'%';
						$condition_ext .= $f.' LIKE ?';
					}
				}
				$condition_ext .= " )";
				$condition_ext = str_replace(" AND ( )", "", $condition_ext);
			}
		}
	}
		
	if(@$filter == true){
		if(strpos($sessionname, '-filter-')){
			if(!empty($_SESSION[$sessionname])){
				$sna = explode('-filter-', $sessionname);
				$sn = $sna[1];
				if(!empty($search_field[$sna[1]])) $sn = $search_field[$sna[1]];
				$condition_ext .= " AND (".$sn."='".$sessionvalue."' )";
			}
		}
	}
}

if(empty($sort)){
	$sort = " order by created DESC limit 500 ";
}


?>