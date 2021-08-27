<?php 
require_once 'config/ini.php';
require_once 'config/security.php';

$order_id = $defender->encrypt('decrypt', $_POST['oid']);
$driver_id = $defender->encrypt('decrypt', $_POST['driver']);

$data['id'] = $order_id;
$data['driver'] = $driver_id;

sql_save('orders', $data);
?>