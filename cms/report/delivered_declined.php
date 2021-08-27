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


if($_SESSION['validation']=='YES' && !empty($storeadmin['id'])){
}else{
	header("Location:../authentication/login.php");
}

?>


<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<script src="../../js/jquery-3.5.0.js"></script>

<style>
td, th {
border: 1px solid #AAA !important;
}
tr:nth-child(even) { background-color:#EEE;}	
select {width:auto; padding-right:30px;}
</style>

</head>
<body>
<div class="row">


	<div class="col-12" style="margin-bottom:30px;">
		
		<?php 
		if($_POST['submit'] == 'Reset'){
			$_SESSION['from_year'] = $_SESSION['from_month'] = $_SESSION['to_year'] = $_SESSION['to_month'] = $_SESSION['area'] = $_SESSION['driver'] = $_SESSION['status'] = '';
		}elseif($_POST['submit'] == 'Search'){
			$_SESSION['from_year'] = $_POST['from_year'];
			$_SESSION['from_month'] = $_POST['from_month'];
			$_SESSION['to_year'] = $_POST['to_year'];
			$_SESSION['to_month'] = $_POST['to_month'];
			$_SESSION['area'] = $_POST['area'];
			$_SESSION['driver'] = $_POST['driver'];
			$_SESSION['status'] = $_POST['status'];
		}
		?>

		<div class="col-12 p-0">
			<h3>Orders Delivered or Orders Declined Status Report</h3>

			<form action="" method="post" enctype="multipart/form-data" style="padding:20px; border:1px solid #DDD; padding:16 8 8 8; background:#EFEFEF; margin-bottom:20px;">
				<div class="row">
					<div class="col-3">Select Period From</div>					
					<div class="col-9">						
						<select name="from_year">
							<option value="">Year</option>
							<?php for($y=2020; $y<=date('Y'); $y++){?>
							<option value="<?php echo $y;?>" <?php if($_SESSION['from_year'] == $y){?>selected<?php }?>>
								<?php echo $y;?>
							</option>
							<?php }?>
						</select>
						<select name="from_month">
							<option value="">Month</option>
							<?php for($m=1; $m<=12; $m++){
								$mo = sprintf("%02d", $m); ?>
								<option value="<?php echo $mo?>" <?php if($_SESSION['from_month'] == $mo){?>selected<?php }?>>
									<?php echo date('M', mktime(0, 0, 0, $m, 10));?>
								</option>
							<?php }?>
						</select>

						&nbsp;&nbsp;&nbsp;To&nbsp;&nbsp;&nbsp;

						<select name="to_year">
							<option value="">Year</option>
							<?php for($y=2020; $y<=date('Y'); $y++){?>
							<option value="<?php echo $y;?>" <?php if($_SESSION['to_year'] == $y){?>selected<?php }?>>
								<?php echo $y;?>
							</option>
							<?php }?>
						</select>
						<select name="to_month">
							<option value="">Month</option>
							<?php for($m=1; $m<=12; $m++){
								$mo = sprintf("%02d", $m); ?>
								<option value="<?php echo $mo?>" <?php if($_SESSION['to_month'] == $mo){?>selected<?php }?>>
									<?php echo date('M', mktime(0, 0, 0, $m, 10));?>
								</option>
							<?php }?>
						</select>
					
					</div>
				</div>
				<div class="row" style="height:10px;"></div>
				<div class="row">
					<div class="col-3">
						Store Location Selected					
					</div>					
					<div class="col-9">

						<?php 
						
						$location = sql_read('select * from location where id=? limit 1', 's', $storeadmin['location']);
						$region = sql_read('select * from region where id=? limit 1', 's', $location['region']);					
						$areas = sql_read('select * from area where location=? order by position ASC, area ASC', 's', $location['id']);
						
						echo $region['region'];
						?>

						<select name="area">
							<option value="">All Area</option>
							<?php foreach((array)$areas as $area){?>
							<option value="<?php echo $area['id']?>" <?php if($_SESSION['area'] == $area['id']){?>selected<?php }?>>
									<?php echo $area['area'];?>
								</option>
							<?php }?>
						</select>
						&nbsp;&nbsp;&nbsp;By&nbsp;&nbsp;&nbsp;

						<?php $drivers = sql_read('select * from driver where status=? order by name ASC', 's', 1);?>

						<select name="driver">
							<option value="">All Driver</option>
							<?php foreach((array)$drivers as $driver){?>
							<option value="<?php echo $driver['id']?>" <?php if($_SESSION['driver'] == $driver['id']){?>selected<?php }?>>
									<?php echo $driver['name'];?>
								</option>
							<?php }?>
						</select>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;						
						Order Status&nbsp;&nbsp;
						<select name="status">
							<option value="">All status</option>							
							<option value="Delivered" <?php if($_SESSION['status'] == 'Delivered'){?>selected<?php }?>>Delivered</option>
							<option value="Declined" <?php if($_SESSION['status'] == 'Decline'){?>selected<?php }?>>Declined</option>
						</select>
						
					</div>
				</div>
				<div style="height:10px;"></div>
				<div class="row">
					<div class="col-3"></div>					
					<div class="col-9">
						<input type="submit" name="submit" value="Search">
						<input type="submit" name="submit" value="Reset">
					</div>
				</div>
			</form>


			<div class="row">
				<div class="col-3">
					Search order status by			
				</div>					
				<div class="col-5" class="form-group">							
					<input name="keyword" id="search_order" class="form-control" type="search" id="myInput" autocomplete="off" placeholder="Order ID, receipt ID or customer name">
					<script>
					$("#search_order").on('keyup', function(e){
						var v = $(this).val();								
						$( "#order_list" ).load( "delivered_declined_list.php", {k:v});						
					});					
					</script>
				</div>
			</div>


			<div style="font-size:18px; padding:20 0 2 0;">Your selected result</div>

			
			<span id="order_list"><?php include 'delivered_declined_list.php';?></span>

			<script>
			
			</script>
		</div>


	</div>      

</div> 


</body>

<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
</html>