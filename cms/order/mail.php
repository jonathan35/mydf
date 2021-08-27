<?php





$headers[] = 'From: Grocere';
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
mail('jonathan.wphp@gmail.com', 'Test', 'message', implode("\r\n", $headers));

?>