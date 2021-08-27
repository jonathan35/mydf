<? 
session_start();


foreach((array)$_SESSION as $a => $v){
    unset($_SESSION[$a]);
}

?>
