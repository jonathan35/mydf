<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
//include '../layout/savelog.php';

?>


<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>WELCOME TO CONTENT MANAGEMENT SYSTEM</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../css/medium.css" rel="stylesheet">
    <link href="../../css/bootstrap-icon.css" rel="stylesheet">


    <script src="chartjs/Chart.min.js"></script>
    <script src="chartjs/utils.js"></script>
    <style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>


    <style>
    .block { width:17%; margin:0 1%; height:180px; display:inline-block; color:white; font-size:16px; text-align:center; padding-top:80px;}
    @media (min-width:1400px){.block { height:200px; padding-top:90px;}}
    </style>
</head>
<body>
<?php include("layout/top.php");?>
<div class="container-fluid">
    <div class="row">
    <?php include("layout/menu.php");?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="background:#F8F8F8;">
            
            <div class="col-12" style="margin-bottom:30px; ">
            

                <?php 
                $day1 = $day2 = $day3 = $day4 = $day5 = $day6 = $day7 = $day8 = $day9 = $day10 = $day11 = $day12 = $day11 = $day12 = $day13 = $day14 = $day15 = $day16 = $day17 = $day18 = $day19 = $day20 = $day21 = $day22 = $day23 = $day24 = $day25 = $day26 = $day27 = $day28 = $day29 = $day30 = $day31 = 0;
            
                if($_GET['y']){
                    $year = $_GET['y'];
                }else{
                    $year = date('Y');
                }

                if($_GET['m']){
                    $month = $_GET['m'];
                }else{
                    $month = date('m');
                }


                for($d=1; $d<=31; $d++){
                    $theday = sprintf("%02d", $d);
                    ${'d'.$d} = sql_read(
                        'select * from orders where created LIKE ? AND payment_status = ? AND status = ? AND delivery_method = ?',
                        'ssss',
                        array(
                            $year.'-'.$month.'-'.$theday.'%', 'Paid', 'Delivered', 'deliver'
                        )
                    );

                    ${'day'.$d} = 0;
                    if(!empty(${'d'.$d})){
                        foreach((array)${'d'.$d} as $vd){
                            ${'day'.$d} += $vd['total'];
                        }
                    }
                }
                
                ?>

                <select name="year" onchange="location = this.value;">
                    <option value="">Select Year</option>
                    <?php for($y=2020; $y<=date('Y'); $y++){?>
                    <option value="mtd.php?y=<?php echo $y;?>&m=<?php echo $_GET['m']?>" <?php if($_GET['y'] == $y){?>selected<?php }?>><?php echo $y;?></option>
                    <?php }?>
                </select>
                <select name="to_month" onchange="location = this.value;">
                    <?php for($m=1; $m<=12; $m++){
                        $mo = sprintf("%02d", $m); ?>
                        <option value="mtd.php?y=<?php echo $_GET['y'];?>&m=<?php echo $mo?>" <?php if($_GET['m'] == $mo){?>selected<?php }?>><?php echo date('M', mktime(0, 0, 0, $m, 10));?></option>
                    <?php }?>
				</select>

     
                <div>
                    <h2>Month to Date Sales Report for <?php echo date("F", mktime(0, 0, 0, $month, 10)).' '.$year;?></h2>
                    <div style="padding:20px 0;">
                        <div class="block" style="background:#2752b8;">
                            <?php                
                            $revenue = 0;
                            $totalq = mysqli_query($conn, "SELECT SUM(total) as revenue FROM orders WHERE created LIKE '".$year."-".$month."-%' AND payment_status = 'Paid' AND status = 'Delivered'");
                            $total = mysqli_fetch_object($totalq);
                            $revenue += $total->revenue;
                            ?>
                            Revenue<br>RM<?php echo number_format($revenue,2, '.',',')?>&nbsp;
                        </div>
                        <div class="block" style="background:#54acbf;">
                            <?php                
                            $today_sales = 0;
                            $today_totalq = mysqli_query($conn, "SELECT SUM(total) as sum_today FROM orders WHERE created LIKE '".date('Y-m-d')." %' AND payment_status = 'Paid' AND status = 'Delivered'");
                            $today_total = mysqli_fetch_object($today_totalq);
                            $today_sales += $today_total->sum_today;
                            ?>
                            Today<br>RM<?php echo number_format($today_sales,2, '.',',')?>&nbsp;
                        </div>
                        <div class="block" style="background:#15b35c;">
                            <?php                
                            $order_count = 0;
                            $order_countq = mysqli_query($conn, "SELECT COUNT(id) as order_count FROM orders WHERE created LIKE '".$year."-".$month."-%' AND payment_status = 'Paid' ");
                            $order_c = mysqli_fetch_object($order_countq);
                            $order_count += $order_c->order_count;
                            ?>
                            Order<br><?php echo $order_count?>&nbsp;
                        </div>
                        <div class="block" style="background:#eb9100;">
                            <?php                
                            $complete_count = 0;
                            $order_complete_countq = mysqli_query($conn, "SELECT COUNT(id) as complete_count FROM orders WHERE created LIKE '".$year."-".$month."-%' AND payment_status = 'Paid' AND status = 'Delivered'");
                            $order_complete_count = mysqli_fetch_object($order_complete_countq);
                            $complete_count += $order_complete_count->complete_count;
                            ?>
                            Complete<br><?php echo $complete_count?>&nbsp;
                        </div>
                        <div class="block" style="background:#eb4700;">
                        <?php                
                            $decline_count = 0;
                            $order_decline_countq = mysqli_query($conn, "SELECT COUNT(id) as decline_count FROM orders WHERE created LIKE '".$year."-".$month."-%' AND payment_status = 'Paid' AND status = 'Decline'");
                            $order_decline_count = mysqli_fetch_object($order_decline_countq);
                            $decline_count += $order_decline_count->decline_count;
                            ?>
                            Decline<br><?php echo $decline_count?>&nbsp;
                        </div>
                    </div>
                    <?php 
                    for($d=1; $d<=31; $d++){
                        echo ${'day'.$d};
                        if($d<31) echo ',';
                    }
                    ?>
                    <div id="container" style="width:100%;">
                        <canvas id="canvas"></canvas>
                    </div>

                    <script>
                        var MONTHS = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
                        var color = Chart.helpers.color;
                        var barChartData = {
                            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
                            datasets: [{
                                label: 'Sales (RM)',
                                backgroundColor: color(window.chartColors.blue).alpha(1).rgbString(),
                                borderColor: window.chartColors.blue,
                                borderWidth: 1,
                                data: [
                                    12, 
                                    12, 
                                    12, 
                                    12, 
                                    12, 
                                    12, 
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12,
                                    12 

                                   

                                    <?php /*
                                    for($d=1; $d<=31; $d++){ 
                                        echo ${'day'.$d};
                                        if($d<31) echo ',';
                                    }*/
                                    ?>
                            }]

                        };

                        window.onload = function() {
                            var ctx = document.getElementById('canvas').getContext('2d');
                            window.myBar = new Chart(ctx, {
                                type: 'bar',
                                data: barChartData,
                                options: {
                                    responsive: true,
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            padding: 40
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: ''
                                    },
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                callback: function(value, index, values) {
                                                    return 'RM' + value;
                                                }
                                            }
                                        }]
                                    }
                                }
                            });

                        };

                        document.getElementById('randomizeData').addEventListener('click', function() {
                            var zero = Math.random() < 0.2 ? true : false;
                            barChartData.datasets.forEach(function(dataset) {
                                dataset.data = dataset.data.map(function() {
                                    return zero ? 0.0 : randomScalingFactor();
                                });

                            });
                            window.myBar.update();
                        });

                        var colorNames = Object.keys(window.chartColors);
                        document.getElementById('addDataset').addEventListener('click', function() {
                            var colorName = colorNames[barChartData.datasets.length % colorNames.length];
                            var dsColor = window.chartColors[colorName];
                            var newDataset = {
                                label: 'Dataset ' + (barChartData.datasets.length + 1),
                                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                                borderColor: dsColor,
                                borderWidth: 1,
                                data: []
                            };

                            for (var index = 0; index < barChartData.labels.length; ++index) {
                                newDataset.data.push(randomScalingFactor());
                            }

                            barChartData.datasets.push(newDataset);
                            window.myBar.update();
                        });

                        document.getElementById('addData').addEventListener('click', function() {
                            if (barChartData.datasets.length > 0) {
                                var month = MONTHS[barChartData.labels.length % MONTHS.length];
                                barChartData.labels.push(month);

                                for (var index = 0; index < barChartData.datasets.length; ++index) {
                                    // window.myBar.addData(randomScalingFactor(), index);
                                    barChartData.datasets[index].data.push(randomScalingFactor());
                                }

                                window.myBar.update();
                            }
                        });

                        document.getElementById('removeDataset').addEventListener('click', function() {
                            barChartData.datasets.pop();
                            window.myBar.update();
                        });

                        document.getElementById('removeData').addEventListener('click', function() {
                            barChartData.labels.splice(-1, 1); // remove the label first

                            barChartData.datasets.forEach(function(dataset) {
                                dataset.data.pop();
                            });

                            window.myBar.update();
                        });
                    </script>
                </div>



			</div>
		</div>
    </div>
</div>
</body>

<script>
function chkAll(frm, arr, mark){
  for (i = 0; i <= frm.elements.length; i++){
   try{
     if(frm.elements[i].name == arr){
       frm.elements[i].checked = mark;
     }
   } catch(er) {}
  }
}
</script>


<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>


</html>