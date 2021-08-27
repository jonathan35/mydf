<?php 
include_once '../../config/ini.php';
require_once('../../config/security.php');

if(empty($_SESSION['month']))$_SESSION['month'] = date('m');
if(empty($_SESSION['year']))$_SESSION['year'] = date('Y');


if($_POST['filter'] == 'Filter'){
	if($_POST['month']) $_SESSION['month'] = $_POST['month'];
	if($_POST['year']) $_SESSION['year'] = $_POST['year'];
}elseif($_POST['reset'] == 'Reset'){
	if($_POST['month']) $_SESSION['month'] = date('m');
	if($_POST['year']) $_SESSION['year'] = date('Y');
}

$con = "id !='' AND card_number !='' AND created LIKE '".$_SESSION['year'].'-'.$_SESSION['month']."-%' ";
$cc = readData($conn, 'donations', $con, 'id DESC');
$table = 'donations';
$fields = 'Product,TxnRef,Email,Ai Notification,Card Holder,Currency,Total Amount,Card Type,Card Number,Expires Date,Is Recurring,Frequency,Day,Month,Date,Start Time,Recurring Type,Occurrences';
$filename = "data_export_" . date("Y-m-d");
$sql_csv = mysqli_query($conn, "SELECT * FROM $table WHERE $con ORDER BY id DESC") or die("Error: " . mysqli_error());
$value = array();
$g = 0;
$field_count = count(explode(',',$fields))-1;	
	
while($row = mysqli_fetch_assoc($sql_csv)){
	
	$value[$g] = array();
	$value[$g][0] = $row['donation_type'];//'Monthly Donation';
	$value[$g][1] = date("Ymd").substr('00000000', 0, 8-strlen($row['id'])).$row['id'];
	if($row['email'] != ''){ $value[$g][2]=$row['email']; }else{ $value[$g][2]= 'Undefined';}
	$value[$g][3]='Y';
	if($row['card_first_name'].$row['card_last_name'] != ''){ 
		$value[$g][4]= $defender->mc_decrypt($row['card_first_name'], ENCRYPTION_KEY).' '.$defender->mc_decrypt($row['card_last_name'], ENCRYPTION_KEY); 
	}else{
		$value[$g][4]='Undefined';
	}
	$value[$g][5]='SGD';
	if($row['total_amount'] != ''){ $value[$g][6]=$row['total_amount']; }else{ $value[$g][6]='Undefined';}
	if($defender->mc_decrypt($cc_d['card_type'], ENCRYPTION_KEY) == 'Visa'){
		 $value[$g][7]='V'; 
	}elseif($defender->mc_decrypt($cc_d['card_type'], ENCRYPTION_KEY) == 'Master'){
		 $value[$g][7]='M';
	}else{
		 $value[$g][7]='Undefined';
	}
	//if($row['card_country'] != ''){ $value[$g][8]=$defender->mc_decrypt($row['card_country'], ENCRYPTION_KEY); }else{ $value[$g][8]='Undefined';}
	if($row['card_number'] != ''){
		$value[$g][8]=str_replace(" ", "", $defender->mc_decrypt($row['card_number'], ENCRYPTION_KEY)); 
	}else{ 
		$value[$g][8]='Undefined';
	}
	if($row['card_expires'] != ''){ 
		$value[$g][9]= $defender->mc_decrypt($row['card_expires'], ENCRYPTION_KEY); 
	}else{ 
		$value[$g][9]= 'Undefined';
	}
	$value[$g][10]='Y';	
	if($row['donation_type'] == 'Give Monthly – To Celebrate the Memory of Someone Special'){
		$value[$g][11]='Y';	
	}else{
		$value[$g][11]='M';	
	}
	$value[$g][12]='';	
	$value[$g][13]='';	
	$value[$g][14]=substr($row['created'], 8 , 2);	
	$value[$g][15]='12';	
	$value[$g][16]='U';	
	$value[$g][17]='';	
	
	
	/*if($row['csv'] != ''){ $value[$g][11]=$defender->mc_decrypt($row['csv'], ENCRYPTION_KEY); }else{ $value[$g][11]='Undefined';}
	if($row['help_community_amount'] != ''){ $value[$g][12]=$row['help_community_amount']; }else{ $value[$g][12]='Undefined';}
	$value[$g][13]=$row['created'];*/
	$g++;
}
	

if($_POST['export'] == 'Export'){
	

	header("Content-type:text/octect-stream");
	header("Content-Disposition:attachment; filename = $filename.csv");
		
	
	print $fields."\n";
	for($a=0; $a<$g; $a++){
		for($b=0; $b<=$field_count; $b++){
			print $value[$a][$b].',';
		}
		print "\"\n";
	}
	exit;
	/*
	while($row = mysqli_fetch_assoc($sql_csv)){
		print 'Monthly Donation,';
		print 'Undefined,';
		if($row['email'] != ''){ print $row['email'].','; }else{ print 'Undefined,';}
		print 'Y,';
		if($row['card_first_name'].$row['card_last_name'] != ''){ 
			print $defender->mc_decrypt($row['card_first_name'], ENCRYPTION_KEY).' '.$defender->mc_decrypt($row['card_last_name'], ENCRYPTION_KEY).','; 
		}else{
			print 'Undefined,';
		}
		print 'SGD,';
		if($row['help_community_amount'] != ''){ print $row['help_community_amount'].','; }else{ print 'Undefined,';}

		if($defender->mc_decrypt($cc_d['card_type'], ENCRYPTION_KEY) == 'Visa'){
			 print 'V,'; 
		}elseif($defender->mc_decrypt($cc_d['card_type'], ENCRYPTION_KEY) == 'Visa'){
			 print 'M,';
		}
		if($row['card_country'] != ''){ print $defender->mc_decrypt($row['card_country'], ENCRYPTION_KEY).','; }else{ print 'Undefined,';}
		if($row['card_number'] != ''){ print $defender->mc_decrypt($row['card_number'], ENCRYPTION_KEY).','; }else{ print 'Undefined,';}
		if($row['card_expires'] != ''){ print $defender->mc_decrypt($row['card_expires'], ENCRYPTION_KEY).','; }else{ print 'Undefined,';}
		if($row['csv'] != ''){ print $defender->mc_decrypt($row['csv'], ENCRYPTION_KEY).','; }else{ print 'Undefined,';}
		if($row['help_community_amount'] != ''){ print $row['help_community_amount'].','; }else{ print 'Undefined,';}

		print $row['created'];
		print "\"\n";

		//print '"' . stripslashes(implode('","',$row)) . "\"\n";
		
	}*/
	
	
	
}


?>








<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">

<style>
th {
	background-color:#DFDFDF;
	font-size:10px;
	text-align:center;
	border-left:1px solid #999;
	border-right:1px solid #999;
	border-bottom:1px solid #999;
	border-top:1px solid #999;
}
td {
	background-color:#FFF;
	border-left:1px solid #999;
	border-right:1px solid #999;
	border-bottom:1px solid #999;
	font-size:10px;
	text-align:center;
}
.general {
	font-family:Arial, Helvetica, sans-serif; 
	font-size:12px;
}
table{
	border-left:1px solid #CCC;
	border-bottom:1px solid #CCC;
}

</style>
</head>

<body>
<!--////////////////////////////////////////// TOP MENU START////////////////////////////////////////////// -->
<?php include("layout/top.php");?>
<!--////////////////////////////////////////// TOP MENU START////////////////////////////////////////////// -->

<div class="container-fluid">
    <div class="row">
    <!--////////////////////////////////////////// SIDE MENU START////////////////////////////////////////////// -->
	<?php include("layout/menu.php");?>
    <!--////////////////////////////////////////// SIDE MENU END////////////////////////////////////////////// -->

    <!--////////////////////////////////////////// CONTENT START////////////////////////////////////////////// -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" align="" >
        
        
            
            <form action="" method="post" enctype="multipart/form-data" style=" position:relative; display:inline-block; width:50%;">
                <select name="year">
                    <?php for($a=2016; $a<=2040; $a++){?>
                    <option value="<?php echo $a?>" <?php if($_SESSION['year'] == $a){?> selected="selected"<?php }?>><?php echo $a?></option>
                    <?php }?>
                </select>
                
                <select name="month">
                    <option value="01" <?php if($_SESSION['month'] == '01'){?> selected="selected"<?php }?>>Jan</option>
                    <option value="02" <?php if($_SESSION['month'] == '02'){?> selected="selected"<?php }?>>Feb</option>
                    <option value="03" <?php if($_SESSION['month'] == '03'){?> selected="selected"<?php }?>>Mar</option>
                    <option value="04" <?php if($_SESSION['month'] == '04'){?> selected="selected"<?php }?>>Apr</option>
                    <option value="05" <?php if($_SESSION['month'] == '05'){?> selected="selected"<?php }?>>May</option>
                    <option value="06" <?php if($_SESSION['month'] == '06'){?> selected="selected"<?php }?>>Jun</option>
                    <option value="07" <?php if($_SESSION['month'] == '07'){?> selected="selected"<?php }?>>Jul</option>
                    <option value="08" <?php if($_SESSION['month'] == '08'){?> selected="selected"<?php }?>>Aug</option>
                    <option value="09" <?php if($_SESSION['month'] == '09'){?> selected="selected"<?php }?>>Sep</option>
                    <option value="10" <?php if($_SESSION['month'] == '10'){?> selected="selected"<?php }?>>Oct</option>
                    <option value="11" <?php if($_SESSION['month'] == '11'){?> selected="selected"<?php }?>>Nov</option>
                    <option value="12" <?php if($_SESSION['month'] == '12'){?> selected="selected"<?php }?>>Dec</option>
                </select>
                <input type="submit" name="filter" value="Filter" /> 
                <input type="submit" name="reset" value="Reset" />
            </form>
            
            <form action="" method="post" enctype="multipart/form-data" 
                style=" position:relative; display:inline-block; width:49%; text-align:right;">
                <input type="submit" name="export" value="Export" style="padding:4px 30px;"/>
            </form>

			<h3><?php echo 'Monthly Donate Report for '.date('M', mktime(0, 0, 0, $_SESSION['month'], 10)).', '.$_SESSION['year'].' ';?></h3>

        
          <div class="table-responsive">


            <table width="100%" border="0" cellspacing="1" cellpadding="4" class="general" style="background-color:#CCC;" >
            
              <tr>
              
                <?php 
                $th = explode(',', $fields);
                
                foreach ($th as $label){
                ?>
                <th>&nbsp;<?php echo $label?></th>
                <?php }?>
              </tr>
              <?php 
              $s = 1;
			  
			for($a=0; $a<$g; $a++){
				echo "<tr>";
				for($b=0; $b<=$field_count; $b++){
					echo '<td>&nbsp;'.$value[$a][$b].'</td>';
				}
				echo "</tr>";
			}
					  
              /*foreach((array)$cc_decrypted as $info){?>
              <tr>
                <td>&nbsp;<?php echo $s?></td>
                <td>&nbsp;Monthly Donation</td>
                <td>&nbsp;</td>
                <td>&nbsp;<?php echo $info['email']?></td>
                <td>&nbsp;Y</td>
                <td>&nbsp;<?php echo $info['card_first_name']?> <?php echo $info['card_last_name']?></td>
                <td>&nbsp;SGD</td>
                <td>&nbsp;<?php echo $info['help_community_amount']?></td>
                <td>&nbsp;<?php if($info['card_type'] == 'Visa'){ echo 'V'; }elseif($info['card_type'] == 'Visa'){ echo 'M';}?></td>
                
                <td>&nbsp;<?php echo $info['card_country']?></td>
                <td>&nbsp;<?php echo $info['card_number']?></td>
                <td>&nbsp;<?php echo $info['card_expires']?></td>
                <td>&nbsp;<?php echo $info['csv']?></td>
                <td>&nbsp;<?php echo $info['created']?></td>
              </tr>
              <?php $s++;}*/?>
            </table>
          </div>
			<div class="general" style="color:#666; margin-top:10px;">CADPIS admin is required to export monthly report, modify if necessary and import to MC payment MAP system.</div>
            <div class="general" style="margin:10px 0; text-align:left;">
            Please learn to import data to MC payment? <a href="batch processing.pdf" target="_blank">guideline here</a>.
            </div>


          
          
        </div>
    <!--////////////////////////////////////////// CONTENT END////////////////////////////////////////////// -->
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>

</body>
</html>
