<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';

$count_item = $total_rebatible = 0;

$count_item = @count($items);
$item_total = item_total();

echo $item_total;

if($count_item>0){
?>

<style>

.summary-item-count-outter {
    position:relative; top:-15px; right:-2px; width:0; height:0; float:right;
}
.summary-item-count-inner {
    width:24px; height:24px; padding-top:2px; text-align:center; background:#F32758; border-radius:50%; box-shadow:0 7px 11px rgba(243, 39, 88, .6); font-size:13px;
}
@media (max-width: 800px) {
    .summary-item-count-outter {
        position:relative; top:2px; right:20px; width:0; height:0; float:right;
    }
}


</style>


    <div class="summary-item-count-outter">
        <div class="summary-item-count-inner">
        <?php echo $count_item?>
        </div>
    </div>
<?php }?>