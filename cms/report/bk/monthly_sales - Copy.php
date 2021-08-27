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

    <!--For date picker use - start -->
    <link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/style.css">
    <script src="<?php echo ROOT?>js/datepicker/jquery-1.12.4.js"></script>
    <script src="<?php echo ROOT?>js/datepicker/jquery-ui.js"></script>
    <script>
    $( function() {
        $( ".datepicker" ).datepicker({ /*minDate: +7,*/ maxDate: "+10Y +6M +1D", dateFormat: 'dd/mm/yy' });
    } );
    </script>

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
<?php include("layout/top.php");?>
<div class="container-fluid">
    <div class="row">
    <?php include("layout/menu.php");?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="background:#F8F8F8;">
            
            <div class="col-12" style="margin-bottom:30px; ">
            

            <?php 

            $am1 = $am2 = $am3 = $am4 = $am5 = $am6 = $am7 = $am8 = $am9 = $am10 = $am11 = $am12 = 0;
            
            $s = readFirst($conn, 'time_span_standard', "id=1");

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
            $cond = "AND payment_status = 'Paid' AND status = 'Delivered' ";

            $m1 = readData($conn, 'orders', "created LIKE '".$year."-01-%' ".$cond);
            $m2 = readData($conn, 'orders', "created LIKE '".$year."-02-%' ".$cond);
            $m3 = readData($conn, 'orders', "created LIKE '".$year."-03-%' ".$cond);
            $m4 = readData($conn, 'orders', "created LIKE '".$year."-04-%' ".$cond);
            $m5 = readData($conn, 'orders', "created LIKE '".$year."-05-%' ".$cond);
            $m6 = readData($conn, 'orders', "created LIKE '".$year."-06-%' ".$cond);
            $m7 = readData($conn, 'orders', "created LIKE '".$year."-07-%' ".$cond);
            $m8 = readData($conn, 'orders', "created LIKE '".$year."-08-%' ".$cond);
            $m9 = readData($conn, 'orders', "created LIKE '".$year."-09-%' ".$cond);
            $m10 = readData($conn, 'orders', "created LIKE '".$year."-10-%' ".$cond);
            $m11 = readData($conn, 'orders', "created LIKE '".$year."-11-%' ".$cond);
            $m12 = readData($conn, 'orders', "created LIKE '".$year."-12-%' ".$cond);
            

            $t=0; foreach((array)$m1 as $t){$am1 += $t['total'];}
            $t=0; foreach((array)$m2 as $t){$am2 += $t['total'];}
            $t=0; foreach((array)$m3 as $t){$am3 += $t['total'];}
            $t=0; foreach((array)$m4 as $t){$am4 += $t['total'];}
            $t=0; foreach((array)$m5 as $t){$am5 += $t['total'];}
            $t=0; foreach((array)$m6 as $t){$am6 += $t['total'];}
            $t=0; foreach((array)$m7 as $t){$am7 += $t['total'];}
            $t=0; foreach((array)$m8 as $t){$am8 += $t['total'];}
            $t=0; foreach((array)$m9 as $t){$am9 += $t['total'];}
            $t=0; foreach((array)$m10 as $t){$am10 += $t['total'];}
            $t=0; foreach((array)$m11 as $t){$am11 += $t['total'];}
            $t=0; foreach((array)$m12 as $t){$am12 += $t['total'];}
            
            ?>

                <select name="year" onchange="location = this.value;">
                    <option value="">Select Year</option>
                    <?php for($y=2020; $y<=date('Y'); $y++){?>
                    <option value="monthly_sales.php?y=<?php echo $y;?>" <?php if($_GET['y'] == $y){?>selected<?php }?>><?php echo $y;?></option>
                    <?php }?>
                </select>
    
                <div>
                    <h2>Monthly Sales Report <?php echo $year;?></h2>
              
                    <div id="container" style="width:100%;">
                        <canvas id="canvas"></canvas>
                    </div>

                    <!--
                    <button id="randomizeData">Randomize Data</button>
                    <button id="addDataset">Add Dataset</button>
                    <button id="removeDataset">Remove Dataset</button>
                    <button id="addData">Add Data</button>
                    <button id="removeData">Remove Data</button>-->



                    <script>
                        var MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        var color = Chart.helpers.color;
                        var barChartData = {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                label: 'Monthly Sales (RM)',
                                backgroundColor: color(window.chartColors.blue).alpha(1).rgbString(),
                                borderColor: window.chartColors.blue,
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