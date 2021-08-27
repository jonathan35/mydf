<?php 
session_start();

foreach((array)$_POST as $k => $v){
	$_SESSION[$k]=$v;	
}

?>