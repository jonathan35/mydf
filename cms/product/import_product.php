<?php
require_once '../../config/ini.php'; 

$save = false;

if($_FILES['excel']!=''){
	$file_source = $_FILES['excel']['tmp_name'];
	$file = 'items.xlsx';

	if($file != ''){
		$file_path="../../".$file;
		if(move_uploaded_file($file_source, $file_path)){
			$save = true;
		}
	}
}



if($save == true){
	require '../vendor/autoload.php';

	$inputFileType = 'Xlsx';
	$inputFileName = '../../items.xlsx';//not case sensitive
	//$sheetname = 'Data Sheet #3';
	$max_rows = 3000;


	class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
	{
		public function readCell($column, $row, $worksheetName = '') {
			//  Read rows 1 to 7 and columns A to E only
			
			global $max_rows;

			if ($row >= 1 && $row <= $max_rows) {
				if (in_array($column,range('A','E'))) {
					return true;
				}
			}
			return false;
		}
	}


	$filterSubset = new MyReadFilter();
	$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
	$reader->setReadFilter($filterSubset);
	$spreadsheet = $reader->load($inputFileName);
	?>


	<table style="border:1px solid gray;">

	<?php 
	
	$region_id = 0;

	if(!empty($_POST['region'])){
		$region_id = $_POST['region'];
	}
	$_SESSION['error'] = 'start: ';
	for($a=1; $a<=$max_rows; $a++){	
		
		$cell_sku = $spreadsheet->getActiveSheet()->getCell('A'.$a)->getValue();
		$cell_name = $spreadsheet->getActiveSheet()->getCell('B'.$a)->getValue();
		$cell_uom = $spreadsheet->getActiveSheet()->getCell('C'.$a)->getValue();
		$cell_price = $spreadsheet->getActiveSheet()->getCell('D'.$a)->getValue();
	
		if(!empty($cell_sku)) $sku = $cell_sku;//inherite previous row sku if empty
		if(!empty($cell_name)) $name = $cell_name;//inherite previous row description if empty
		$uom = $cell_uom;
		$price = $cell_price;

		if(!empty($cell_uom)){//ignore row that has no uom
			
			// ------------------ Product - Start ------------------------------			
			unset($prod['id']);
			$prod = sql_read('select * from product where sku = ? AND region=? limit 1', 'ss', array($sku, $region_id));


			$prod_data = array();

			if(!empty($prod['id'])){
				$prod_data['id'] = $prod['id'];//if have id then UPDATE, if no id then INSERT
			}
			$prod_data['sku'] = $sku;
			$prod_data['product_name'] = $name;
			$prod_data['region'] = $region_id;
	
			if(empty($cell_price) && !empty($prod_data['sku'])){//Hide product under this condition			
				$prod_data['status'] = 0;
			}else{
				$prod_data['status'] = 1;
			}

			if(sql_save('product', $prod_data)){
				$prod_for_uom = sql_read('select * from product where sku = ? AND region=? limit 1', 'ss', array($sku, $region_id));
			}
			// ------------------ Product - End ------------------------------

			

			// ------------------ UOM - Start ------------------------------			
			$uom_data = array();
			
			$prod_uom = sql_read('select * from uom where product = ? AND uom = ? AND region= ? limit 1', 'sss', array($prod_for_uom['id'], $uom, $region_id));

			if(!empty($prod_uom['id'])){
				$uom_data['id'] = $prod_uom['id'];//if have id then UPDATE, if no id then INSERT
			}else{
				unset($uom_data['id']);
				$uom_data['position'] = 1;
			}
			
			$uom_data['product'] = $prod_for_uom['id'];
			$uom_data['uom'] = $uom;
			$uom_data['price'] = $price;
			
			$uom_data['status'] = 1;
			$uom_data['region'] = $region_id;
			
			if(empty($cell_price)){
				$uom_data['status'] = 0;
			}
			//$_SESSION['error:'.$prod['id']] = 'prod_for_uom:'.$prod_for_uom['id'].', uom:'. $uom.', region_id:'.$region_id.', $prod_uom_id:'.$prod_uom['id'].'vs'.$uom_data['id'];

			sql_save('uom', $uom_data);
			// ------------------ UOM - End ------------------------------
			/*
			echo '<div style="padding-left:17%;">';
			echo '<tr>';
			echo '<td>'.$sku.'</td>';
			echo '<td>'.$name.'</td>';
			echo '<td>'.$uom.'</td>';
			echo '<td>'.$price.'</td>';
			echo '</tr>';	
			echo '</div>';	
			*/
		
		}
	}


	/* --------------------- Hide (status=0) product that is not in excel ------------------------------------------
	$sheet_sku_list = '(';
	
	for($a=1; $a<=$max_rows; $a++){
		$thesku = $spreadsheet->getActiveSheet()->getCell('A'.$a)->getValue();
		if(!empty($thesku)){
			if($a>1) $sheet_sku_list .= ',';
			$sheet_sku_list .= "'".$thesku."'";	
		}		
	}
	$sheet_sku_list .= ')';
	mysqli_query($conn, "UPDATE product SET status='0' WHERE sku NOT IN ".$sheet_sku_list." ");	
*/
	?>
	</table>

<?php }?>


<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
<style>
select, input { width:90%;}
</style>
</head>

<body>

<div class="row">
	<div class="col-5">
		<h3>Import Product</h3>
		<form name="form1" method="post" action="" enctype="multipart/form-data">
			


			<div style="font-size:16px;">
				<div class="row" style="padding:6px;">
					<div class="col-12 main_title">Import to which region?</div>
					<div class="col-12">
						<select name="region">
						<?php 
						
						$regions = sql_read('select * from region where status=1 order by position ASC');
						
						foreach((array)$regions as $region){?>
							<option value="<?php echo $region['id']?>"><?php echo $region['region']?></option>
						<?php }?>
						</select>
					</div>
				</div>

				<div class="row" style="padding:16px;">
					<div class="col-12 main_title">Browse Excel file (.xlsx)</div>
					<div class="col-12">
						<input type="file" name="excel">
					</div>
				</div>

				<div class="row" style="padding:6px;">
					<div class="col-7 offset-5">
						<input type="submit" value="Import Now" ><?php if($save) echo '<span style="color:green;">Data imported.</span>';?>
					</div>
				</div>

			</div>

		</form>
	</div>
	<div class="col-lg-7">
	
	
	<h4 style="color:#4287f5;">What import does?</h4>
		<ul>
			<li>Import will update SKU, product description, OUM & price only.</li>
			<li>Row with price empty, system will the hide UOM but not product.</li>
			<li>Row with both SKU & price empty, system will hide the product.</li>
		</ul>

		<h4 style="color:#4287f5;">What is the format?</h4>
		<ul>					
			<li>Must be 4 columns only.</li>
			<li>First column must be SKU.</li>
			<li>Second column must be Porduct Description.</li>
			<li>Third column must be OUM.</li>					
			<li>Fourth column must be Price.</li>
		</ul>
		
		<br>
		Follow spreadsheet format like this:<br>
		<img src="../images/sample-excel.png" style="opacity:0.7; border:1px solid gray;"><br><br><br>

	</div>
</div>

</body>
</html>

