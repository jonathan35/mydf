<?php 


session_start();

if($_POST['address'] == '1'){
    $_SESSION['address'] = '1';
}elseif($_POST['address'] == '2'){
    $_SESSION['address'] = '2';
}



?>

<script>
alert();
</script>