Use ?str=yourstring
<?php 
if($_GET['str']){
	echo hash('md5',$_GET['str']);
}
?>