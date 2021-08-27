<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';

?>


<html lang="en">

<body class="container-fluid p-0">
    <div class="my-container pb-1">

        <?php include 'header.php';?>

        <?php include 'banner.php';?>
    </div>
    <div class="row"><div class="col-12"><br><br><br></div></div>
    <div class="row"><div class="col-12 d-none d-md-inline"><br><br></div></div>

    <div class="row p-5" style="background:#EFEFEF; box-shadow: inset 0 0 4px rgba(0,0,0,.3)">
        <div class="col-12 col-md-10 offset-md-1 text-center">
            <div class="h1">
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; line-height:1; ">
                    <div>WHO WE ARE</div>
                    <div style="width:60px; height:30px; border-bottom:2px solid #ac8f5a;"></div>
                </div>
            </div>
            <div class="h2">
            The Malaysia DanceSport Federation (MYDF) is the Malaysia National Sports Association (NSA) governing all aspects of  both Amateur and Professional DanceSport nationwide, either through its Office Bearers, Member bodies and Members or by administrative agreements with other persons and organizations. 
            </div>
            <div class="p-4">
                <button class="btn btn-default btn-gold-shine">
                    A B O U T &nbsp;&nbsp;U S
                </button>
            </div>
        </div>
    </div>


    <div class="row"><div class="col-12"><br><br></div></div>
    <div class="row"><div class="col-12 d-none d-md-inline"><br><br></div></div>

    <div class="row ">
        <div class="col-12 text-center">
            <div class="h1"><span>WE WORK WITH</span></div>
            <div>We are supported by</div>
            <div class="">
                <?php include 'home_developers.php';?>
            </div>
        </div>
    </div>

    <div class="row"><div class="col-12"><br><br><br></div></div>
           
    <div class="my-container why_choose_us scroll_animate" ani-sub=".choose-block" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC; background-color: #eeeeee; background-image:url('images/shape-bg.svg'); 
    
    
    
    
    background-repeat: repeat;">
        <div class="row"><div class="col-12"><br><br></div></div>
        <div class="row"><div class="col-12 d-none d-md-inline"><br><br></div></div>
        <div class="row">
            <div class="col-10 offset-1 text-center">
                <div class="h1"><span style="color:white;">WHY CHOOSE US</span></div>

                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <?php 
                            $home_blocks = sql_read('select * from home_block where status=? order by position asc', 'i', 1);
                            foreach((array)$home_blocks as $home_block){

                                $cl = array('#ff9f38', '#abcf29', '#48b867', '#38ab96', '#3d77a1', '#584aa1', '#8e47a8', '#d959b2', '#bd4646');
                                $cl2 = array('#ffc44f', '#b8d453', '#63c77f', '#6bc2b2', '#78a2bf', '#9084d1', '#c68cdb', '#e889cb', '#eb6060');
                            $bg = 'background-image: linear-gradient(to right top, '.$cl[rand(0,8)].', '.$cl2[rand(0,8)].');';
                            ?>
                            <div class="col-12 col-md-4">
                                <div class="choose-block" style="<?php echo $bg?>; opacity:1; background: url('<?php echo $home_block['background']?>'); background-size:cover; background-position:center;">
                                    <?php echo $home_block['block_text']?>
                                </div>
                            </div>
                            <? }?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row"><div class="col-12"><br><br></div></div>
        <div class="row"><div class="col-12 d-none d-md-inline"><br><br></div></div>
    </div>


    <div class="my-container">
        <?php include 'row3.php' ?>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="row"><div class="col-12"><br><br><br></div></div>
            <div class="row"><div class="col-12 d-none d-md-inline"><br><br></div></div>

            <? include 'footer.php';?>        
        </div>
    </div>                
            

</body>

</html>
