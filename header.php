
<div class="row">
    
    <div class="col-4 p-3 pt-md-4">
        <button class="navbar-toggler menu-toggler pb-3" type="button" onclick="$('#toggleMenu, .page_title').fadeToggle();">
        
        <!--data-toggle="collapse" data-target="#toggleMenu" aria-controls="toggleMenu" aria-expanded="false" aria-label="Toggle navigation"-->
            <span class="navbar-toggler-icon pt-2">
                <i class="fas fa-bars burger-menu"></i>
            </span>
            <span class="burger-menu-txt d-none d-md-inline">Menu</span>
        </button>
    </div>

    <div class="col-4 pt-1 pb-1 text-center">
        <a href="<?php echo ROOT?>home" class="d-none d-md-block"><img src="<?php echo ROOT?>images/logo.png" alt="" class="img-fluid" style=" margin-top:6px;"></a>
        <a href="<?php echo ROOT?>home" class="d-md-none"><img src="<?php echo ROOT?>images/icon.png" alt="" class="img-fluid" style="max-height:70px; margin-top:6px;"></a>
    </div>

    <div class="col-4 text-right social-icon p-3 pl-0 pt-4">
        <div class="pt-md-2">
            <a href="https://m.facebook.com/" target="_blank"><img src="<?php echo ROOT?>images/facebook-circle.svg"></a>
            <a href="https://www.instagram.com/" target="_blank"><img src="<?php echo ROOT?>images/instagram-circle.svg"></a>
            <a href="https://wa.link/60168653947" target="_blank"><img src="<?php echo ROOT?>images/whatsapp-circle.svg"></a>
        </div>
    </div>
</div>

<div class="menu collapse" id="toggleMenu">
    <div class="menu-inner">
        <div class="row">
            <div class="d-none d-md-inline col-md"></div>                        
            <div class="col-12 col-md p-2">

            <a href="#<?php echo ROOT?>products">MYDF Ranking</a>
            </div>            
            <div class="col-12 col-md p-2">
            <a href="#<?php echo ROOT?>news">News</a>
            </div>            
            <div class="col-12 col-md p-2">
            <a href="#<?php echo ROOT?>contact_us">Contact Us</a>
            </div>
            <?php 
            $pages = sql_read('select * from pages where status = ? order by position asc, id desc', 'i', 1);
            foreach((array)$pages as $page){?>
            <div class="col-12 col-md p-2">
                <a href="#<?php echo ROOT.'page/'.$str_convert->to_url($page['title'])?>" style="text-transform: capitalize;"><?php echo $page['title']?></a>
            </div>
            <?php }?>
            <div class="d-none d-md-inline col-md"></div>
        </div>
    </div>

</div>