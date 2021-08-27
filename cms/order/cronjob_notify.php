<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';

$cron_job = true;
$timep = substr(date('Y-m-d H:i:s', strtotime("-30 minutes")),0,16);
$current_order = sql_read("select * from orders where payment_status='Paid' AND status = 'New' AND (cron = '' OR cron IS NULL OR cron < '".$timep."') limit 1");

include 'email_notify.php';
?>