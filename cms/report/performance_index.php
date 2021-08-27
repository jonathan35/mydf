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

</head>
<body>

<div class="row">

    <div class="col-12">
        

            

            <?php 

            $am1 = $am2 = $am3 = $am4 = $am5 = $am6 = $am7 = $am8 = $am9 = $am10 = $am11 = $am12 = 0;
            $sm1 = $sm2 = $sm3 = $sm4 = $sm5 = $sm6 = $sm7 = $sm8 = $sm9 = $sm10 = $sm11 = $sm12 = 0;
            
            $s = sql_read('select * from time_span_standard where id=? limit 1', 's', 1);
            
            $sm1 += $s['january'];
            $sm2 += $s['february'];
            $sm3 += $s['march'];
            $sm4 += $s['april'];
            $sm5 += $s['may'];
            $sm6 += $s['jun'];
            $sm7 += $s['july'];
            $sm8 += $s['august'];
            $sm9 += $s['september'];
            $sm10 += $s['october'];
            $sm11 += $s['november'];
            $sm12 += $s['december'];

            if($_GET['y']){
                $year = $_GET['y'];
            }else{
                $year = date('Y');
            }
            $sql = 'select * from orders where created LIKE ? AND payment_status = ? AND status = ? AND delivery_method = ? ';


            for($m=1; $m<=12; $m++){
                $mo = sprintf("%02d", $m);
                ${'m'.$m} = sql_read($sql, 'ssss', array($year.'-'.$mo.'-%', 'Paid', 'Delivered', 'deliver'));

                ${'am'.$m} = $addtime = 0;
                if(!empty(${'m'.$m})){
                    foreach((array)${'m'.$m} as $t){
                        $addtime += $t['accepted_span']+$t['receipt_span']+$t['delivered_span'];
                    }
                }
                ${'am'.$m} += $addtime;
            }
    
            ?>
       
  
                <div class="row">
                    <div class="col-2 pb-4">
                        <select name="year" onchange="location = this.value;">
                            <option value="">Select Year</option>
                            <?php for($y=2020; $y<=date('Y'); $y++){?>
                            <option value="performance_index?y=<?php echo $y;?>" <?php if($_GET['y'] == $y){?>selected<?php }?>><?php echo $y;?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
	
                <div>
                    <h2>Time Span Report on <?php echo $year;?> (Actual vs Standard)</h2>
                    <div style="color:#666;">
                        Time span is the time average time to accept, receipt and deliver for all orders.
                    </div>
                    <div id="container" style="width:100%;">
                        <canvas id="canvas"></canvas>
                    </div>


                    <script>
                        var MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        var color = Chart.helpers.color;
                        var barChartData = {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                label: 'Actual Time Span',
                                backgroundColor: color(window.chartColors.red).alpha(1).rgbString(),
                                borderColor: window.chartColors.red,
                                borderWidth: 1,
                                data: [
                                    <?php echo $am1?>,
                                    <?php echo $am2?>,
                                    <?php echo $am3?>,
                                    <?php echo $am4?>,
                                    <?php echo $am5?>,
                                    <?php echo $am6?>,
                                    <?php echo $am7?>,
                                    <?php echo $am8?>,
                                    <?php echo $am9?>,
                                    <?php echo $am10?>,
                                    <?php echo $am11?>,
                                    <?php echo $am12?>
                                ]
                            }, {
                                label: 'Standard Time Span',
                                backgroundColor: color(window.chartColors.blue).alpha(1).rgbString(),
                                borderColor: window.chartColors.blue,
                                borderWidth: 1,
                                data: [
                                    <?php echo $sm1?>,
                                    <?php echo $sm2?>,
                                    <?php echo $sm3?>,
                                    <?php echo $sm4?>,
                                    <?php echo $sm5?>,
                                    <?php echo $sm6?>,
                                    <?php echo $sm7?>,
                                    <?php echo $sm8?>,
                                    <?php echo $sm9?>,
                                    <?php echo $sm10?>,
                                    <?php echo $sm11?>,
                                    <?php echo $sm12?>
                                ]
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
                                                    return value + ' hr';
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