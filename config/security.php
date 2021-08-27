<?php 


class defender{

	function encrypt($action, $string) {
		$output = false;
		
		$encrypt_method = "AES-256-CBC";
		//pls set your unique hashing key
		global $secret_key;//'s7d897231a6081923915223sd7s805a19d8asd';
		$secret_iv = '82396243ads89124hjw8951w4890e75143';
	
		// hash
		$key = hash('sha256', $secret_key);
	
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
	
		//do the encyption given text/string/number
		if( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
			//decrypt the given text/string/number
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
	
		return $output;
	}	
		
	
	/*
	http://blog.koonk.com/2015/07/46-useful-php-code-snippets-that-can-help-you-with-your-php-projects/
	http://webdeveloperplus.com/php/21-really-useful-handy-php-code-snippets/
	https://code.tutsplus.com/tutorials/9-useful-php-functions-and-features-you-need-to-know--net-11304
	*/
	
	function clean($input){
		if (is_array($input)){
			foreach ($input as $key => $val){
				$output[$key] = clean($val);
			}
		}else{
			$output = (string) $input;	// if magic quotes is on then use strip slashes
			if (get_magic_quotes_gpc()){
				$output = stripslashes($output);
			}// $output = strip_tags($output);
			$output = htmlentities($output, ENT_QUOTES, 'UTF-8');
		}
	// return the clean text
		return $output;
	}

	// Encrypt Function
	function mc_encrypt($encrypt, $key){
		$encrypt = serialize($encrypt);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
		$key = pack('H*', $key);
		$mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
		$passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
		$encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
		return $encoded;
	}
	
	// Decrypt Function
	function mc_decrypt($decrypt, $key){
		$decrypt = explode('|', $decrypt.'|');
		$decoded = base64_decode($decrypt[0]);
		$iv = base64_decode($decrypt[1]);
		if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
		$key = pack('H*', $key);
		$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
		$mac = substr($decrypted, -64);
		$decrypted = substr($decrypted, 0, -64);
		$calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
		if($calcmac!==$mac){ return false; }
		$decrypted = unserialize($decrypted);
		return $decrypted;
	}

	
		
	function encryptDecryptURL($text, $key ='') {
		// return text unaltered if the key is blank
		if ($key == '') {
			return $text;
		}
	
		// remove the spaces in the key
		$key = str_replace(' ', '', $key);
		if (strlen($key) < 8) {
			exit('key error');
		}
		// set key length to be no more than 32 characters
		$key_len = strlen($key);
		if ($key_len > 32) {
			$key_len = 32;
		}
	
		$k = array(); // key array
		// fill key array with the bitwise AND of the ith key character and 0x1F
		for ($i = 0; $i < $key_len; ++$i) {
			$k[$i] = ord($key[$i])+-0x1A;
			
		}
	
		// perform encryption/decryption
		for ($i = 0, $j = 0; $i < strlen($text); ++$i) {
			$e = ord($text[$i]);
			// if the bitwise AND of this character and 0xE0 is non-zero
			// set this character to the bitwise XOR of itself and the jth key element
			// else leave this character alone
			if ($e & 0xE0) {
				$text[$i] = chr($e ^ $k[$j]);
			}
			// increment j, but ensure that it does not exceed key_len-1
			$j = ($j + 1) % $key_len;
		}
		return $text;
	}


	function escapeInjection($variable){
		
		global $conn;
		
		$variable = strip_tags(mysqli_real_escape_string($conn, $variable)); 
		
		$variable = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $variable);
		$variable = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $variable);
		$variable = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $variable);
		$variable = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $variable );
    	$variable = str_ireplace( '%3Cscript', '', $variable );
		$variable = html_entity_decode($variable, ENT_COMPAT, 'UTF-8');
		 
		// Remove any attribute starting with "on" or xmlns
		$variable = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $variable);
		 
		// Remove javascript: and vbscript: protocols
		$variable = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $variable);
		$variable = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $variable);
		$variable = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $variable);
		 
		// Remove namespaced elements (we do not need them)
		$variable = preg_replace('#</*\w+:\w[^>]*+>#i', '', $variable);
		 
		do{		// Remove really unwanted tags
				$old_variable = $variable;
				$variable = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $variable);
		}
		while ($old_variable !== $variable);
		
		return $variable;  
	}



	
}

$defender = new defender;
?>
