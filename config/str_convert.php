<?php 

class str_convert{
		
	function to_url($str) {
		$f = array(' ', '&', '/', '.', "'");
		$r = array('-', 'and', 'slash', '_', '\'');
		$converted_str = rawurlencode(str_replace($f, $r, $str));
		return $converted_str;
	}

	function to_query($str){
		$f = array("slash", '-', 'and', "'");
		$r = array('_', '_', '%', "_");
		//, "../../" --> backdirectoryx2
		$converted_str = str_replace($f, $r, rawurldecode($str));

		return $converted_str;
	}
	
	function to_eye($str){//also for display value from database into input field
		
		$f = array("-", 'slash', "\'", "backdirectoryx2");
		$r = array(' ', '/', "'", "../../");
		
		$converted_str = stripslashes(str_replace($f, $r, $str));
		return $converted_str;
	}
	
	
	function field_to_label($str){//also for display value from database into input field
		
		$f = array("_", 'slash', "\'");
		$r = array(' ', '/', "'");
		
		$converted_str = stripslashes(str_replace($f, $r, $str));
		return $converted_str;
	}
	
}

$str_convert = new str_convert;

?>
