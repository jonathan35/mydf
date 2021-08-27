<?php 
require_once '../../config/ini.php'; 

$read_id = base64_decode($_GET['id']);
$read_table = $_GET['table'];
$read_fields = json_decode(base64_decode($_GET['fields']), true);


$the_reads = sql_read("select * from $read_table where id=? limit 1", 'i', $read_id);
unset($the_reads['id']);
unset($the_reads['modified']);


$data['id'] = $read_id;
$data['status'] = 'Read';

sql_save($read_table, $data);

?>


<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">

<?php 
foreach((array)$the_reads as $l => $v){?>
<div class="row">
    <div class="col-1 text-capitalize text-muted"><?php echo $l;?></div>
    <div class="col-11"><?php echo $v;?></div>
</div>
<?php }?>
