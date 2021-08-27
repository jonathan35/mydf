<?php 
include_once 'head.php';

if($_GET['t']){
    $title = $str_convert->to_query($_GET['t']);
    $ffpage = sql_read("select * from pages where status = ? and title like ? limit 1", 'is', array(1, '%'.$title.'%'));
}
?>

<html lang="en">
<body class="container-fluid p-0">
    <div class="my-container">
        
        <?php include 'header.php';?>
        <div style="height:66px;">
            <div class="page_title">
                <?php echo $ffpage['title'];?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-4">
                <?php
                $ffpage['content'] = str_replace(array('../../', '<img'), array(ROOT, '<img class="img-fluid"'), $ffpage['content']);                
                echo $ffpage['content'];?>
            </div>        
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row"><div class="col-12"><br><br><br><br><br></div></div>
            <? include 'footer.php';?>        
        </div>
    </div>                
            

</body>

</html>

