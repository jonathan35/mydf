<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
require_once('../../config/security.php');

session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

/*
Database parameter in below:
/cms/layout/shuttle-export-master/import.php line 13 & 14
/cms/layout/shuttle-export-master/demo.php line 6 to 9
*/




?>

<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--For date picker use - start -->
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/style.css">
<script src="<?php echo ROOT?>js/datepicker/jquery-1.12.4.js"></script>
<script src="<?php echo ROOT?>js/datepicker/jquery-ui.js"></script>

<script>
$( function() {
    $( ".datepicker" ).datepicker({ /*minDate: +7,*/ maxDate: "+10Y +6M +1D", dateFormat: 'yy/mm/dd' });
} );
</script>
<!--For date picker use - end -->

</head>
<body>
<?php include("layout/top.php");?>
<div class="container-fluid">
    <div class="row">
    <?php include("layout/menu.php");?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main p-0" style="background:#F8F8F8;">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 p-0" style="padding-bottom:20px;">
                <div class="col-lg-12" style="padding:50px 20px;">
                    <?php 
				
				if(!empty($_POST['Backup'])){
					include 'shuttle-export-master/demo.php';
					$save = '<span style="color:green;"> Backup successfully</span>';	
				}
				if(!empty($_POST['Restore'])){
					include 'shuttle-export-master/demo.php';
					include 'shuttle-export-master/import.php';
					$save_restore = '<span style="color:green;"> Backup successfully</span>';	
				}


				if(!empty($_POST['delete'])){
					if(!empty($_POST['delete_file'])){
						if(unlink($_POST['delete_file'])){
							$save_delete = '<span style="color:green;"> Database deleted</span>';	
						}else{
							$save_delete = '<span style="color:red;"> Database delete fail</span>';	
						}
					}
				}
				
				?>
                    
                    <form action="" method="POST" enctype="MULTIPART/FORM-DATA" style="padding:30px;">
                         <img src="shuttle-export-master/img/backup.png" width="60px">
                         Backup current database.<br>
                         <input type="submit" name="Backup" value="Backup Now">
                         <?php if(!empty($save)) echo $save;?>
                    </form>
                    
                    <div class="row" style="border-top:1px solid #CCC;"></div>
                    
                    <form action="" method="POST" enctype="MULTIPART/FORM-DATA" style="padding:30px;">
                         <img src="shuttle-export-master/img/restore.png" width="50px">
                         Restore current database.<br>
                         <input type="file" name="sql_file" accept=".sql, .txt" required>
                         <input type="submit" name="Restore" value="Restore Now">
                         <?php if(!empty($save)) echo $save_restore;?>
                    </form>
                    
                    
                    
                </div>
            </div>



            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-bottom:20px; border-left:1px solid #CCC; background-color:#f2f2f2">
			  <?php 
                 $dir    = 'shuttle-export-master/backup_db/';
                 $files = scandir($dir);
                 unset($files[0]); unset($files[1]);
                 ?>
                 <div class="col-lg-12" style="padding-top:20px;padding-left:0;padding-bottom:20px;">
                 	<img src="shuttle-export-master/img/download.png" width="50px">
                    Download database
                 </div>
                 <div class="row"><?php if(!empty($save_delete)) echo '<div class="col-lg-12">'.$save_delete.'</div>';?></div>
                 
                 <?php 
			  $itemCount=1;
			  $maxPerPage=10;
			  
			  foreach((array)$files as $f){?>
                    <div class="row tr page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?> ">

                         <div class="col-lg-7" style="padding-top:6px;">
                           <?php echo $itemCount;?>. 
                           <?php echo $f;?>
                           <!--Backup at <?php echo substr($f,10,2);?>-<?php echo substr($f,8,2);?>-<?php echo substr($f,4,4);?>, <?php echo substr($f,12,2);?>:<?php echo substr($f,14,2);?>:<?php echo substr($f,16,2);?>-->
                         </div>
                         <div class="col-lg-5">
                           <a href="<?php echo $dir.$f;?>" download="<?php echo $dir.$f;?>"><button>Download</button></a>
                           <form method="POST" action="" enctype="MULTIPART/FORM-DATA" style="display:inline;">
                           	<input type="HIDDEN" name="delete_file" value="<?php echo $dir.$f;?>">
                           	<input type="SUBMIT" name="delete" value="Delete">
                         
                           </form>
                         </div>
                    </div>
                 <?php 
			  $itemCount++;
			  }?>
                 <div class="col-xs-12 col-sn-12 col-md-12 col-lg-12">
			  	<?php include("../../paging.php");?>
                 </div>
                 
            </div>
		</div>
    </div>
</div>
</body>

<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>

</html>