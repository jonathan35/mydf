<?php
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
require_once '../../config/security.php';
//include '../cms/layout/savelog.php';

session_start();



if($_SESSION['user_id']){
    $storeadmin = sql_read('select * from login where id=? limit 1', 's', $_SESSION['user_id']);	
}


function dateDiffInDays($date1, $date2){ 
    $diff = strtotime($date2) - strtotime($date1); 
    return abs(round($diff / 86400)); 
} 

$params[] = '';
$condition = " where id !=? ";

if((!empty($_SESSION['from_year']) || !empty($_SESSION['from_month']) || !empty($_SESSION['to_year']) || !empty($_SESSION['to_month'])) AND (empty($_SESSION['from_year']) || empty($_SESSION['from_month']) || empty($_SESSION['to_year']) || empty($_SESSION['to_month']))){
    echo '<script>alert("All date fields must all fill in togather.")</script>';
}elseif(!empty($_SESSION['from_year']) && !empty($_SESSION['from_month']) && !empty($_SESSION['to_year']) && !empty($_SESSION['to_month'])){
    $date1 = '01-'.$_SESSION['from_month'].'-'.$_SESSION['from_year'];
    if($_SESSION['to_month'])
    $date2 = cal_days_in_month(CAL_GREGORIAN, $_SESSION['to_month'], $_SESSION['to_year']).'-'.$_SESSION['to_month'].'-'.$_SESSION['to_year'];
    $dateDiff = dateDiffInDays($date1, $date2);
    
    if(($_SESSION['from_year']*(int)$_SESSION['from_month']) > ($_SESSION['to_year']*(int)$_SESSION['to_month'])){
        echo '<script>alert("\'Date to\' must be later than \'date to\'.")</script>';
    }elseif($dateDiff>365){
        echo '<script>alert("maximum one year date range.")</script>';
    }else{
        $params[] = $_SESSION['from_year'].'-'.$_SESSION['from_month'].'-01';
        $params[] = $_SESSION['to_year'].'-'.$_SESSION['to_month'].'-31';
        $condition .= ' AND created >= ? AND created <= ?';	

    }
}

if(!empty($_SESSION['area'])){
    $params[] = $_SESSION['area'];
    $condition .= ' AND area = ?';
}
if(!empty($_SESSION['driver'])){
    $params[] = $_SESSION['driver'];
    $condition .= ' AND driver = ?';
}
if(!empty($_SESSION['status'])){
    $params[] = $_SESSION['status'];
    $condition .= ' AND status = ?';
}
if(!empty($_POST['k'])){
    $keyword = str_replace(array('E00000','E0000','E000','E00','E0'),'',$_POST['k']);
    $params[] = '%'.$keyword.'%';
    $params[] = '%'.$keyword.'%';
    $params[] = '%'.$keyword.'%';
    
    $condition .= " AND (id LIKE ? OR receipt_id LIKE ? OR customer_name LIKE ?)";
}

$sort = ' order by created DESC limit 2000';


$rows = sql_read('select * from orders '.$condition.' '.$sort, str_repeat('s',count($params)), $params);
$count = sql_count('select * from orders '.$condition.' '.$sort, str_repeat('s',count($params)), $params);

?>


<?php if($count>0){?>
    <table class="table table-striped" width="100%" id="item_list">
        <thead>
            <tr>
                <th>No.&nbsp;</th>
                <th>Order ID&nbsp;</th>
                <th>Receipt ID&nbsp;</th>
                <th>Delivered on&nbsp;</th>
                <th>Delivery person&nbsp;</th>
                <th>Customer name&nbsp;</th>
            </tr>
        </thead>
        <tbody>

        <?php     
                        
            $drivers = array();
            $drs = sql_read('select * from driver where status=? order by name ASC', 's', 1);
            foreach((array)$drs as $d){
                $drivers[$d['id']] = ucwords($d['name']);
            }

            $customers = array();
            $cus = sql_read('select * from member where status=? order by name ASC', 's', 'Activated');
            foreach((array)$cus as $c){
                $customers[$c['id']] = ucwords($c['name']);
            }

            $c=1;
            foreach((array)$rows as $val){?>
                <tr>
                    <td><?php echo $c;?></td>
                    <td><a href="../../the_order/<?php echo $defender->encrypt('encrypt', $val['id'])?>" target="_blank"><?php echo $mo = 'E'.sprintf("%06d", $val['id']); ?></a></td>
                    <td><?php if(!empty($val['receipt_id'])) echo $val['receipt_id']; else echo '-'; ?></td>
                    <td><?php if(!empty($val['delivered_date'])) echo date('d/m/Y', strtotime($val['delivered_date']));?></td>
                    <td><?php if(!empty($drivers[$val['driver']])) echo $drivers[$val['driver']]; ?></td>
                    <td><?php if(!empty($customers[$val['member']])) echo $customers[$val['member']]; ?></td>
                </tr>
            <?php 
            $c++;
            }
            ?>
        </tbody>
    </table>
       
<?php }else{?>
    <div>
        No record found
    </div>
<?php }?>