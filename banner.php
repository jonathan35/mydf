<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">


</div>

<div class="banner-section">
<?php 

$banners = sql_read('select * from banner where status=1 order by position asc, id desc');

$cb = @count($banners);

if($cb>0){?>


    <div class="card form-rounded card-banner">
        <div id="CarouselBanner" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php for($n=0; $n<$cb; $n++){?>
                <li data-target="#CarouselBanner" data-slide-to="<?php echo $n?>" class="<?php if($c==0) echo 'active'; ?>"></li>                
                <?php }?>
            </ol>
            <div class="carousel-inner">
                <?php 
                $c = 1;
                foreach((array)$banners as $banner){?>
                <div class="carousel-item <?php if($c==1) echo 'active'; ?> " style="background-image:url('<?php echo ROOT.$banner['banner']?>');">
                    <div class="d-none d-md-block">
                        <?php echo $banner['text_in_desktop']?>
                    </div>
                    <div class="d-block d-md-none">
                        <?php echo $banner['text_in_mobile']?>
                    </div>
                </div>
                <?php 
                $c++;
                }
                
                if($cb>1){?>             
                <a class="carousel-control-prev" href="#CarouselBanner" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#CarouselBanner" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <?php }?>
            </div>
        </div>
    </div>

<script>

$('.carousel').carousel();
</script>

<?php }?>

</div>