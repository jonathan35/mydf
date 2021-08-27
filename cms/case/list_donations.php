<?php 
if($_POST['action']=="Delete"){
	$items_delete_array=$_POST['IdList'];
	if(!empty($_POST['IdList'])){
		foreach((array)$items_delete_array as $items_delete){
			$donation_items = readFirst($conn, "donation_items", "id='".$items_delete."'");			
			deleteData($conn, "donation_items", "id='".$items_delete."'");			
			if(!empty($donation_items['donation_id'])){
				deleteData($conn, "donations", "id='".$donation_items['donation_id']."'");	
			}
		}
	}
	if(!empty($_POST['IdFirst'])){
		deleteData($conn, "payments", "id='".$_POST['IdFirst']."'");	
	}
}elseif(!empty($_POST['action'])){	
	$items_id_array=$_POST['productIdList'];
	if(!empty($_POST['productIdList'])){
		foreach((array)$items_id_array as $items_id){
			$data['id']=$items_id;
			$data[$db[$_POST['action']][0]]=$db[$_POST['action']][1];
			if(sql_save("donation_items", $data));
		}
	}
}
	
$condition = "case_id ='".base64_decode($_GET['case'])."' ";

$rows = readData($conn, "donation_items", $condition, "created ASC"); 
$count = countData($conn, "donation_items", $condition, "ORDER BY created ASC");
?>
<style>
.titleBlockInList {margin-top:4px; font-size:15px;}
.blockInList {margin-top:4px;;}
.thum {
	width:100%; height:100px; background-size:cover; background-position:center; background-repeat:no-repeat; border:1px solid #CCC;
}
.span_label { text-transform:capitalize; color:#999;}
.span_label::after { content:":"; }

</style>
<div class="col-12">
    <h3>List Donation History</h3>
    
    <form action="" method="post" enctype="multipart/form-data">
    <div class="row tr" style="border-bottom:1px solid #CCC;">
        <div class="col" style="width:5% !important;"><input name="Input" type="checkbox" value="" onClick="chkAll(this.form, 'IdList[]', this.checked)" title="Check all item"></div>
        <?php foreach((array)$actions as $action){?><input type="submit" name="action" value="<?php echo $action?>" onClick="return confirmAction('<?php echo $msg[$action]?>');" title="<?php echo $btn?> selected item(s)"><?php }?>
    </div>
    <div class="row tr" style="background:#ADBCBE;">
		<div class="col-12">
			<div class="col-lg-6">Donation</div>
			<div class="col-lg-4">Donor</div>
			<div class="col-lg-2" style="text-align:right;">Amount</div>
        </div>
    </div>
    <?php 	$total = 0;?>
    <?php 
    $creator_first_donate=readFirst($conn, "payments", "case_id='".base64_decode($_GET['case'])."' AND payment_status='paid'");
	if(!empty($creator_first_donate)){
		$total+=$creator_first_donate['amount'];
	?>
		<div class="row tr">
        
            <div class="col" style="width:2% !important;">
                <input type="checkbox" value="<?php echo $creator_first_donate['id']; ?>" name="IdFirst">
                <input type="hidden" name="id" value="<?php echo $creator_first_donate['id'];?>" />
            </div>
        
			<div class="col" style="width:95%">
				<div class="col-12">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="blockInList">Type: <?php echo $creator_first_donate['payment_type']?></div>
						<div class="blockInList">Date: <?php echo $creator_first_donate['created']?></div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="blockInList">First donation to create case</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="text-align:right;">
						<div class="blockInList">S$<?php echo $creator_first_donate['amount']?></div>
					</div>
				</div>
			</div>
        </div>    
    <?php }?>
	<?php 
	if($count>0){
        foreach((array)$rows as $val){
			$amount=$val['amount'];
			$donate=readFirst($conn, "donations", "id='".$val['donation_id']."' AND payment_status='paid'");
			
			if(!empty($donate)){
		
		
			?>
			<div class="row tr">
				<div class="col" style="width:2% !important;">
					<input type="checkbox" value="<?php echo $val['id']; ?>" name="IdList[]">
					<input type="hidden" name="id" value="<?php echo $val['id'];?>" />
				</div>
				<div class="col" style="width:95%">
					<div class="col-12">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="blockInList">Type: <?php echo $donate['donation_type']?></div>
							<div class="blockInList">Privacy: <?php echo $donate['individual_organisation']?></div>
							<div class="blockInList">Date: <?php echo $val['created']?></div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div class="blockInList"><?php echo $val['donor_name']?>: <?php echo $val['donor_message']?></div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="text-align:right;">
							<div class="blockInList">S$<?php echo $amount?></div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			$total += $amount;
			}
		}?>
        
	<?php }else{
		if(empty($creator_first_donate)){?>
        <table>
        	<tr><td>No record found</td></tr>
		</table>
    <?php }
	}?>
</form>
</div>

<?		//$qry = mysqli_query($conn, "SELECT SUM(amount) as total FROM donation_items WHERE case_id='".$case['id']."' ");
		//$xxx = mysqli_fetch_assoc($qry);
?>
<?php //=$xxx['total']?>

<div class="col-12" style="text-align:right; font-weight:bold; border-top:2px solid #999;">
    <h2><span style="color:#CCC">Total:</span>S$<?php echo $total?></h2>
</div>


<script>
(function(){ 
	var current_tab='<?php echo $_GET['tab'];?>';
	if(current_tab==''||current_tab=='display'){
		$("#display_tab").attr('class', 'current');$("#hide_tab").attr('class', '');
	}else{
		$("#hide_tab").attr('class', 'current');$("#display_tab").attr('class', '');
	}
})()
</script>
	<script>
		function confirmAction(msg){
			var point = confirm(msg);
			if(point==true){
				var id= new Array('IdList[]');
				if(id==''){
					alert("No Item Selected");
					return false;
				}
				return true;
			}else{
				return false;
			}
		}
	</script>

<style>
.modal {  z-index:5000;}
.modal-dialog {width:80% ; margin:50px auto;}

</style>