<?php

session_start();
date_default_timezone_set('ASIA/KUALA_LUMPUR');
error_reporting(0);


//------------------- Database Connection ---------------------
Class DBConn{
	var $hostname = "localhost";
	var $database = "mydf";//xando_borneorealestate
	var $username = "root";//xando_bre_user
	var $password = "";//asouihd97239ptig8fewipugsdipfgyu
}

$DB = New DBConn;

$conn = mysqli_connect($DB->hostname, $DB->username, $DB->password) or trigger_error(mysql_error(),E_USER_ERROR);
mysqli_select_db($conn, $DB->database);




//------------------- Constant ---------------------
if (!defined('HTTP')) {
	define('HTTP', 'https://');
}

if (!defined('ROOT')) {
	define('ROOT', @str_repeat('../', count(explode("/", $_SERVER['REQUEST_URI'])) - 3));
}

if (!defined('A_ROOT')) {
	define('A_ROOT', 'https://localhost/');
}

if (!defined('ENCRYPTION_KEY')) {
	define('ENCRYPTION_KEY', '5415426461280412780323a78478124387234892747370');
}

if (!defined('SEC_NODE')) {
	define('SEC_NODE', '?v='.date("ymdhis"));
}



/*------------------- Security ---------------------
SQL injection (SQLI)
- Prepared Statements (PS) prevented SQLI ,SQLI need hacker to manipulate both parameter and value. In PS, hacker can only manipulate value but not parameter.

Stored/Reflected Cross Site Scripting (XSS) & Remote File Inclusion (RFI)
- Prevent on input: Remove 'script' & 'php' tag 
- Prevent on output: Remove executable content (tag/link) from user/database before run in URL or display content.
- <img src="nonexistent" onerror="evil()"> - Handled by strip_tags

PHP Function selection knowledge:
1. mysqli_real_escape_string - No need handle single quotes. The SQL query and the data never mix.
2. htmlspecialchars/htmlentities - use when output, not input
3. stripslashes - no need remove back slash.
4. strip_tags prevented
	- Tags like "html", "body", "b", "br", "em", "hr", "i", "li", "ol", "p", "s", 
		"span", "table", "tr", "td", "u", "ul", etc
	- Attributes like "class", "id", "style", "href", etc..
	- Javascript event like onclick, onerror, etc..
	- <?php, <?, ?>, <script>, </script>

Current Weakness
1. strip_tags can't prevent broken tags like <scr/* *\/ipt>
2. Output lack function like htmlspecialchars 
*/

$tag_allowed = array('<br>');
$post_exception = array('page');//tinymce & link $_POST's name here
$danger_links = array('https://www', 'https://', 'http://www', 'http://','');//strip_tags dont remove these
$danger_links_exception = array('google_map_link');

foreach((array)$_POST as $key => $val){
	if(!is_array($val)){
		if(!in_array($key, $post_exception)){
			$_POST[$key] = @strip_tags($val, $tag_allowed);//This will remove tinymce's HTML tags
		}else{
			$_POST[$key] = str_replace(array(
				'<?php', '<?', '?>', '<script>','</script>'
			), '', $val);
		}
		if(!in_array($key, $danger_links_exception)){
			$_POST[$key] = str_replace($danger_links, '', $val);
		}
	}
}



//------------------- Mysql Query - Prepared Statement ---------------------

function sql_exec($query, $type = null, $params = null){	
	
	global $conn;
	$_SESSION['sql_error'] = '';
	
	if(!$type && $params){
		$type = str_repeat('s',count($params));
	}

	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $query)){		
		$_SESSION['sql_error'] .= 'Failed to prepare..';
		return array();
	}else{

		if(isset($type) && isset($params)){
			if(is_array($params)){//$params is array
				mysqli_stmt_bind_param($stmt, $type, ...$params);	
			}else{
				mysqli_stmt_bind_param($stmt, $type, $params);	
			}
		}

		if(!mysqli_stmt_execute($stmt)){
			$_SESSION['sql_error'] .= 'Failed to execute..';
			return false;
		}else{
			return true;
		}
	}
}


function sql_read($query, $type = null, $params = null){	
	
	global $conn;
	$_SESSION['sql_error'] = '';

	if(!$type && $params){
		$type = str_repeat('s',count($params));
	}

	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $query)){		
		$_SESSION['sql_error'] .= 'Failed to prepare..';
		return array();
	}else{

		if(isset($type) && isset($params)){
			if(is_array($params)){//$params is array
				@mysqli_stmt_bind_param($stmt, $type, ...$params);	
			}else{
				@mysqli_stmt_bind_param($stmt, $type, $params);	
			}
		}

		if(!mysqli_stmt_execute($stmt)){
			$_SESSION['sql_error'] .= 'Failed to execute..';
			return array();
		}else{
			
			$return = mysqli_stmt_get_result($stmt);
			@$rows = mysqli_num_rows($return);
			
			if($rows > 0){
				if(stripos($query, 'limit 1')){
					$result = mysqli_fetch_assoc($return);
					return $result;
					
				}else{
					
					$results = array();
					$c = 0;
					while($result = mysqli_fetch_assoc($return)){
						$results[$c] = $result;
						$c++;
					}
					return $results;
				}
			}
		}
	}
}


function sql_count($query, $type = null, $params = null){

	global $conn;
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $query)){
		return 'Failed to prepare..';
	}else{
		if(isset($type) && isset($params)){
			if(is_array($params)){//$params is array
				mysqli_stmt_bind_param($stmt, $type, ...$params);
			}else{				
				mysqli_stmt_bind_param($stmt, $type, $params);	
			}
		}

		if(!mysqli_stmt_execute($stmt)){
			return 'Failed to execute..';
		}else{
			$rows = 0;
			$return = mysqli_stmt_get_result($stmt);
			return $rows += @mysqli_num_rows($return);
		}
	}	
}


function sql_save($table = null, $data = array()){
	
	global $conn;
	$stmt = mysqli_stmt_init($conn);

	/*---- Unset Submit Button ----*/
	unset($data['add2020']);
	unset($data['update2020']); 
	unset($data['duplicate2020']);
	unset($data['save2020']);	

	$_SESSION['sql_error'] = implode("|",$data);
	

	if(!isset($data['id'])){
		$data['created'] = date('Y-m-d H:i:s');
	}
	$data['modified'] = date('Y-m-d H:i:s');
		
	
	if(!isset($data['id'])){//add

		$qry_cols = $qry_paras = $type = '';
		$vals = array();
		$c = 1;
		$max_c = count($data);
		foreach((array)$data as $field => $value){
			$vals[] = $value;
			if($c < $max_c){ 
				$qry_cols .= $field.', ';  
				$qry_paras .= '?, ';
			}else{
				$qry_cols .= $field;
				$qry_paras .= '?';
			}
			$type .= 's';
			$c++;
		}

		$query = 'INSERT INTO '.$table.'('.$qry_cols.') VALUES ('.$qry_paras.')';

	}else{//edit
		$data_fields = $data; unset($data_fields['id']); $id = $data['id'];

		$qry_cols_paras = $type = '';
		$vals = array();
		$c = 1;
		$max_c = count($data_fields);
		foreach((array)$data_fields as $field => $value){
			$vals[] = $value;
			if($c < $max_c){
				$qry_cols_paras .= $field.'=?, ';
			}else{
				$qry_cols_paras .= $field.'=?';
			}
			$type .= 's';
			$c++;
		}
		$vals[] = $id; $type .= 's';
		$query = 'UPDATE '.$table.' SET '.$qry_cols_paras.' WHERE id=?';		
	}
		

	if(!mysqli_stmt_prepare($stmt, $query)){		
		return false;		
	}else{		
		if(count($vals)>0){
			if(!mysqli_stmt_bind_param($stmt, $type, ...$vals)){
				return false;
			}else{	
				if(!mysqli_stmt_execute($stmt)){
					return true;
				}else{					
					return true;
				}	
			}
		}
	}
}


function debug($debugData = array()){
	echo '<pre>';
	print_r($debugData);
	echo '</pre>';
}


function br($repeat=1){
	for($r=1; $r<=1; $r++){
		echo '<br>1';
	}
}

/*
function sql_save($query, $type = null, $params = null){

	if(!isset($type) || !isset($type)){
		return false;
	}else{

		global $conn;
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $query)){
			return false;
		}else{
			if(@count($params)>1){//$params is array
				mysqli_stmt_bind_param($stmt, $type, ...$params);	
			}else{
				mysqli_stmt_bind_param($stmt, $type, $params);	
			}

			if(!mysqli_stmt_execute($stmt)){
				return false;
			}else{
				return true;
			}
		}
	}	
}
*/

?>