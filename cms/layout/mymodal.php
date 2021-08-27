<style>
.mymodal {
	display:none;
	position:fixed;
	left:0;	top:0;
	z-index:999;
	width:100vw;
	height:100vh;
	background:rgba(0,0,0,.9);
}
.mymodal-container {
	background:#FFF;
	z-index:1000;
	width:80%;
	margin:40px 10%;
	min-height:200px;
	padding:0;
	padding-left:1%;
}
.mymodal-body {	
	width:100%;
}
.mymodal .close {
	width:50px; min-height:50px; background:#CCC;
	position:relative;
	border-radius:0 25px 25px 0;
	right:-50px;
	padding:12px 17px;
	float:right;
	cursor:pointer;
}

.mymodal-iframe {	
	width:100%;
	height:calc(90vh - 60px);
	position:relative;
	top:-20px;
}
</style>


<?php 
$small_mymodal = array(
	'category', 'sub_category', 'brand', 'region', 'location', 'region', 'xxx', 'xxx'
);

if(in_array($table, $small_mymodal)){?>
<style>
.mymodal-container {
	width:70%;
	margin:40px 15%;
}
</style>
<?php }?>

<div class="mymodal">                      
	<div class="mymodal-container">
		<div class="close">&times;</div>
		<div class="mymodal-body">
			<iframe class="mymodal-iframe" src="" frameborder="0"></iframe>
			<span class="refresher"></span>
		</div>
	</div>
</div>




<script>
$('.close').click(function(){
	$('.mymodal').hide();
	refresher();
});
$('.mymodal').click(function(){
	$('.mymodal').hide();
	refresher();
});
$('.mymodal-btn').click(function(){
	$('.mymodal').css('display', 'block').fadeIn();
	var link = $(this).attr('link')+'&no_list=true';
	
	if(link){
		$('.mymodal-iframe').attr('src', link);
	}
});
function refresher(){
	if($(".mymodal-btn").hasClass("ref-btn")){
		$.get("../layout/refresher.php", function(r) {
			$(".refresher"+r).css('display', 'none');
			$.post("../layout/value.php", {get_config_only:true}, function(data){

				$(".trrefresher"+r+" td:first").after('<td class=""><td>'+data);
				$(".trrefresher"+r+" td:eq(1)").css('display', 'none');
				$(".trrefresher"+r+" td:eq(2)").css('display', 'none');
			})
		});
	}
}
</script>