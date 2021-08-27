<?php 


$case_id = base64_decode($_GET['case_id']);
$query = "SELECT * FROM cases WHERE id='".$case_id."' LIMIT 1 ";
$case_qry = mysqli_query($conn, $query);
$case = mysqli_fetch_assoc($case_qry);

?>

<div class="col-lg-2" style="width:100px; height:100px; border-radius:50%; border:2px solid #2a71a3; overflow:hidden; 
background-image:url(../../<?php echo $case['photo01'];?>); background-position:center center; background-size:cover;"></div>
<div class="col-lg-10" style="font-size:16px;">
    <h1><?php echo $case['title'];?></h1>
    <div class="col" style="width:100%;">
        <?php 
        $who = readFirst($conn, 'accounts', " id='".$case['creator_id']."' ");
        if(!empty($who)){?>
        <div>
            <span class="glyphicon glyphicon-user"></span>
            <strong>Creator: </strong>
            <?php echo $who['first_name'].' '.$who['last_name'];?> (<?php echo $who['email']?>)
        </div>
        <?php }?>
    </div>
</div>