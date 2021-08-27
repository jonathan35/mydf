<?php 
require_once '../../config/ini.php'; 


if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>CONTENT MANAGEMENT SYSTEM</title>

<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/solid.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/solid.min.css">



<script type='text/javascript' src='<?php echo ROOT?>cms/js/jquery-3.5.1.js'></script>
<?php /*<script type='text/javascript' src='<?php echo ROOT?>cms/js/bootstrap.js'></script>*/?>
<script type='text/javascript' src='<?php echo ROOT?>cms/js/bootstrap.min.4.5.0.js'></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-white-gra shadow-sm">    
    <?php $who = sql_read('select * from login where id=? limit 1','s',$_SESSION['user_id']);?>
    
    <img src="../images/account_circle.svg" width="24">
    <span class="d-none d-md-block pl-1">
      <?php if(!empty($who['name'])){ echo $who['name']?> (Last login on <?php echo date('d-m-y, g:ia', strtotime($who['modified']));?>)<?php }?>
    </span>
    <span class="d-block d-md-none">CMS</span>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="d-inline d-sm-none rel-nav">
    <div class="collapse navbar-collapse abso-nav" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo ROOT?>cms/authentication/change_password">Change Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo ROOT?>cms/authentication/logout">Sign Out</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="col d-none d-md-block text-right" style="float:right">
    <span class="navbar-text">
      <a href="<?php echo ROOT?>cms/authentication/change_password">Change Password</a>
    </span>
    <span class="navbar-text pl-4">
      <a href="<?php echo ROOT?>cms/authentication/logout">Sign Out</a>
    </span>
  </div>
</nav>


<div class="container-fluid">
  <div class="row" >
    <div class="col-2 d-none d-md-block p-0 pt-0 leftmenu" style="min-height: calc(100vh - 44px);">
      <?php include '../layout/menu.php';?>
    </div>
    <div class="col-12 col-md-10 pt-4 pl-4 pr-4" id="module-body">
      <?php      
      if(!empty($_GET['fol']) && !empty($_GET['pag'])){
        if(stripos('?',$_GET['pag'])){
          $pageArr = explode('?',$_GET['pag']);
          $page = $pageArr[0].'.php?'.$pageArr[1];          
        }else{
          $page = $_GET['pag'].'.php';
        }
        include '../../cms/'.$_GET['fol'].'/'.$page;
      }
      ?>    
    </div>
  </div>
</div>

<?php //include '../layout/mymodal.php';?>

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

<div id="session-page"></div>


<? /*
<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
*/?>

</html>