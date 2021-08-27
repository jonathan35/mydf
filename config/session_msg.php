<?php 

if(!empty($_SESSION['session_msg'])){?>
    <div id="session_msg" class="fadeInRight">
        <?php echo $_SESSION['session_msg'];
        unset($_SESSION['session_msg']);
        ?>
    </div>
<?php }?>

<style>
#session_msg { 
    margin:180px 5%; width:90%; 
    position:fixed; top:0; right:-100%; z-index:9999;  opacity:0.9;
    animation-name:slideInOutLeft;
    animation-duration:8s;
}
@media only screen and (min-width: 600px) {
    #session_msg { 
        margin:70px 10%; width:80%; 
    }
}
@keyframes slideInOutLeft {
    0% {right:-100%;}
    20% {right:0;}
    80% {right:0;}
    100% {right:-100%;}
}
</style>
<script>
$('.fadeInRight').click(function(){

    $('.fadeInRight').fadeOut();

})

</script>

