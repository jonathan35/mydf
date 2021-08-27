
<div class="row text-center p-4 p-md-2" style="background:#252c38; color:#FFF; font-size:15px;">
    <div class="col-12 col-md-10 offset-md-1">
        <div class="row text-center pt-2">
            <div class="col-12 text-center back-top">
                <i class="fa fa-chevron-circle-up back-top-icon" aria-hidden="true" onclick="scroll_top();" style="-webkit-filter: drop-shadow(0 0 5px #222); filter: drop-shadow(0 0 5px #222); position:relative; top:7px;"></i>
            </div>
            <script>
            function scroll_top(){
                var body = $("html, body");
                body.stop().animate({scrollTop:0}, 500, 'swing', function() { });
            }
            </script>
        </div>
        <?php /*
        <div class="row d-flex pt-4 pb-5 text-left" >

            <div class="col-12 col-md">
                <div class="footer-title pt-4 pt-md-2">Products</div>
                <div class="row">                
                    <?php 
                    $types = sql_read("select * from category where status=1 order by position asc, id desc limit 8");
                    foreach($types as $type){?>
                    <div class="col-6 col-md-12 pt-1">
                        <a href="#<?php echo ROOT?>type/<?php echo $str_convert->to_url($type['category'])?>" style="color:lightblue;"><?php echo $type['category']?></a>
                    </div>
                    <?php }?>


                </div>
            </div>

            <div class="col-12 col-md">
                
       
                <div class="footer-title pt-4 pt-md-2">
                    <div style="width:140px; overflow:display;">Open</div>
                </div>
                <div class="pb-1">
                    Monday to Saturday:<br>
                    12.00pm - 8.00pm<br>
                    Sunday & Public Holidays:<br>
                    By Appointment<br>
                </div>

                <div class="footer-title pt-4 pt-md-2">Email</div>
                <div class="pb-1">
                    info@mydf.org.my<br>
                    liewchiihuin@gmail.com
                </div>
            </div>


            <div class="col-12 col-md">
                <div class="footer-title pt-4 pt-md-2">Social</div>
                <div class="pb-1">
                    <a href="https://www.facebook.com/" target="_blank">
                        <img src="<?php echo ROOT?>images/facebook-f.svg" width="14px" style="margin:10px">
                    </a>
                    <a href="https://wa.me/60168653957" target="_blank">
                        <img src="<?php echo ROOT?>images/whatsapp.svg" width="20px" style="margin:10px">
                    </a>
                    <a href="#" target="_blank">
                    <img src="<?php echo ROOT?>images/instagram.svg" width="20px" style="margin:10px">
                    </a>
                </div>
                <div class="footer-title pt-4 pt-md-2">Contact</div>
                <div class="pb-1">
                    Person: Mike
                </div>
                <div class="pb-1">
                    Fax: +6 082 234 050
                </div>
                <div class="pb-1">
                    Phone: +6 016 860 6677<br> 
                    +6 016 861 6677
                </div>
                
                
            </div>

            <div class="col-12 col-md">
                

                <div class="footer-title pt-4 pt-md-2">Address</div>
                <div class="pb-1">
                    Washington Audio<br>
                    3rd Floor, T26 & T27,<br>
                    One Jaya Lifestyle,<br>
                    Jalan Song,<br>
                    93350 Kuching,<br>
                    Sarawak, East Malaysia.
                </div>
                <br><br>
                <div class="pb-1">
                <a href="https://www.google.com/maps/place/Washington+Audio/@1.5175374,110.3627953,17z/data=!3m1!4b1!4m5!3m4!1s0x31fba717c2313b5f:0x49d570dec075c958!8m2!3d1.517532!4d110.364984" target="_blank" style="color:lightblue;">
                    <img src="<?php echo ROOT?>images/678111-map-marker-512.webp" width="18px" style="display:inline-block;">View Map</a>
                </div>
            </div>
        </div>

        <br><br>*/?>

        <div class="row">
            <div class="col-12 pb-2 text-muted">
                <?php echo date('Y')?>. mydf.org.my All rights reserved. Powered by Quest Marketing.
            </div>
        </div>




    </div>
</div>



<div id="enquiryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-edit-panel">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-black" aria-hidden="true">&times;</span>
                </button>
                <div class="login-panel form-rounded">
                    <?php include 'message.php'?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function change_title(title){
    $('input[name=tour]').val(title);
}
</script>

<?php include_once 'config/session_msg.php';?>