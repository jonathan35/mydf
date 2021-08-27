<? 
require_once 'config/ini.php';

print_r(mysqli_error($conn));

session_start();
?>
<pre>
<?
print_r($_SESSION);

?>
</pre>