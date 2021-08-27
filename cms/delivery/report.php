<?php 
require_once '../../config/ini.php'; 


$year = $_GET['y'];



if($_GET['type'] == '1'){?>


<html>
  <head>
    <script type="text/javascript" src="js/loader.js"></script>
    
    
	<script type="text/javascript">
		<?php  $max_month = 12;//date('m');?>
	
        google.charts.load("current", {packages:['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawChart);
		
		<?php for($each_month=1; $each_month<=$max_month; $each_month++){?>
        google.charts.setOnLoadCallback(drawChart<?php echo $each_month?>);
		<?php }?>
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Density", { role: "style" } ],
            
            <?php 
           
            
            for($month=1; $month<=$max_month; $month++){ 
                $monthName = date('F', mktime(0, 0, 0, $month, 10));
                $b = 0;
                $qry = mysqli_query($conn, "SELECT SUM(grand_total) as totalprice FROM product_comfirm WHERE status=1 AND confirm_date LIKE '".$year."-".sprintf("%02d", $month)."-%'");
                $set = mysqli_fetch_assoc($qry);
                
                $b += $set['totalprice'];
            
            
            ?>
            
            ["<?php echo $monthName?>", <?php echo round($b)?>, "#06C"],
            <?php }?>
    
    
          ]);
    
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);
    
	
          var options = {
          title: 'Sales by Value for <?php echo $year?>',
           
			titleTextStyle: {color: 'black', fontSize: 18},
            width: '90%',
            height: 200,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
			vAxis: {
				title: 'Value (AUD$)'
			},
          };
		  
          var chart = new google.visualization.ColumnChart(document.getElementById("yearlychart"));
          chart.draw(view, options);
      }
	  
	  
	  <?php for($each_month=1; $each_month<=$max_month; $each_month++){
		  $each_month_name = date('F', mktime(0, 0, 0, $each_month, 10));
		  ?>
	  
        function drawChart<?php echo $each_month?>() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Density", { role: "style" } ],
            
            <?php 
			
			
            $max_day = cal_days_in_month(CAL_GREGORIAN, $each_month, $year); // 31
            
            for($day=1; $day<=$max_day; $day++){ 
                $b = 0;
                $qry = mysqli_query($conn, "SELECT SUM(grand_total) as totalprice FROM product_comfirm WHERE status=1 AND confirm_date = '".$year."-".sprintf("%02d", $each_month)."-".sprintf("%02d", $day)."' ");
                $set = mysqli_fetch_assoc($qry);
                
                $b += $set['totalprice'];
            
            
            ?>
            
            ["<?php echo $day?>", <?php echo round($b)?>, "#06C"],
            <?php }?>
    
    
          ]);
    
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);
    
	
          var options = {
          title: 'Sales by Value for <?php echo $year.' '.$each_month_name?>',
           
			titleTextStyle: {color: 'black', fontSize: 18},
            width: '90%',
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
			vAxis: {
				title: 'Value (AUD$)'
			},
          };
		  
          var chart = new google.visualization.ColumnChart(document.getElementById("monthlychart<?php echo $each_month?>"));
          chart.draw(view, options);
      }
	  <?php }?>
	  
	  
    </script>
</head>    
<body>
    <div id="yearlychart" style="width: 100%;"></div>   
	<?php for($each_month=1; $each_month<=$max_month; $each_month++){?>
        <div id="monthlychart<?php echo $each_month?>" style="width: 100%; margin-top:20px;"></div> 
    <?php }?>   
</body>
</html>

<?php }?>

