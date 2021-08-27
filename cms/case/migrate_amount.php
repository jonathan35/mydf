<?php 
require_once '../../config/ini.php'; 

$condition = "session_id LIKE '201708%' ";

$rows = readData($conn, "donations", $condition, "created DESC"); 
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
        <div class="col" style="width:5% !important;"></div>
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
        foreach((array)$rows as $val){
		$items=readFirst($conn, "donation_items", "donation_id='".$val['id']."'");
		
		$data['id']=$items['id'];
		$data['amount']=$val['total_amount'];
		$data['session_id']=$val['session_id'];
		
		
		
		
		
		?>
		<div class="row tr" style="border:1px dashed gray;">
			<?php if(sql_save("donation_items", $data)){echo 'save! '; print_r($data);}?>
        </div>
        <?php }?>
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
				var id= new Array('productIdList[]');
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