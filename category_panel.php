
    <!--Side panel start-->
    <div class="side-panel col-lg-2 d-none d-md-block">

        <!--Category panel start-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card form-rounded mb-2">
                    <div class="card-body pl-4 pr-4 text-left">

                        <!--offers row start -->
                        <div class="row mb-3">
                            <div class="col-12 offers">
                                <p class="category-panel-header pl-3">Offers</p>
                                <div style="border-top:3px solid #F32758; width:40px; height:0; position:relative; left:14px; top:-8px;"></div>
                                <div class="category-list p-3" id="best_deals">Best Deals</div>                 
                                <div class="category-list p-3" id="best_sellers">Best Sellers</div>
                            </div>
                        </div>
                        <!--offers row end-->

                        <!--category row start-->
                        <div class="row">
                            <div class="col-12 offers">
                                <p class="category-panel-header pl-3">Category</p>
                                <div style="border-top:3px solid #F32758; width:40px; height:0; position:relative; left:14px; top:-8px;"></div>

                                <ul class="list-unstyled components">
                                <?php 
                                $cats = sql_read('select * from category where status=1 order by position asc, id desc');

                                if(count($cats)>0){
                                    foreach((array)$cats as $cat){
                                        $cat_enc_id = $defender->encrypt('encrypt', $cat['id']);

                                        $scats = sql_read('select * from sub_category where status=1 AND category=? order by position asc, id desc','s',$cat['id']);
                                    ?>
                                                               
                                        <li class="">
                                    <div class="category-list p-3" <?php if(count($scats)>0){?> href="#pageSubmenu<?php echo $cat_enc_id;?>" data-toggle="collapse" aria-expanded="false"<?php }?> id="<?php echo $cat_enc_id;?>">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <?php echo $cat['category'];?>
                                                    </div>
                                                    <?php if(count($scats)>0){?>
                                                    <div class="col-3 pt-1">
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <?php }?>
                                                </div>
                                            </div>
                                            <?php if(count($scats)>0){?>
                                            <ul class="collapse subcategory list-unstyled" id="pageSubmenu<?php echo $cat_enc_id;?>">
                                                <?php foreach((array)$scats as $scat){
                                                    $scat_enc_id = $defender->encrypt('encrypt', $scat['id']);
                                                    ?>
                                                <a href="#">
                                                <li class="mb-1 subcat-list" id="<?php echo $scat_enc_id;?>">
                                                    <div class="row">
                                                        <div class="offset-3 col-9">
                                                            <?php echo $scat['sub_category']?>
                                                        </div>
                                                    </div>
                                                </li>
                                                </a>
                                                <?php }?>

                                            </ul>
                                            <?php }?>

                                        </li>
                                
                                    <?php 
                                    }
                                }?>



                                 
                                </ul>
                            </div>
                        </div>
                        <!--categiry row end-->


                    </div>
                </div>

            </div>
        </div>
        <!--Category panel end-->

        <!--Information panel start-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card information form-rounded mt-4">
                    <div class="card-body p-3 pl-4 pr-4">
                        <div class="row">
                            <div class="col-3 pl-3 pr-0 d-flex" style="justify-content: center; align-self: center;">
                                <img class="" src="images/truck.png" width="100%">
                            </div>
                            <div class="col-9 text-left p-2">
                                <span class="font-weight-bold">Fast Delivery</span><br />
                                <span style="font-size:92%;">Deliver to your doorstep</span>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-12">
                <div class="card information form-rounded">
                    <div class="card-body p-3 pl-4 pr-4">
                        <div class="row">
                            <div class="col-3 pl-3 pr-0 pt-1 pb-1 d-flex" style="justify-content: center; align-self: center;">
                                <img class="" src="images/money.png" width="90%">
                            </div>
                            <div class="col-9 text-left p-2">
                                <span class="font-weight-bold">Money Saving</span><br />
                                <span style="font-size:92%;">At lowest price</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <div class="card information form-rounded">
                    <div class="card-body p-3 pl-4 pr-4">
                        <div class="row">
                            <div class="col-3 pl-3 pr-0 d-flex" style="justify-content: center; align-self: center;">
                                <img class="" src="images/diamond.png" width="84%">
                            </div>
                            <div class="col-9 text-left p-2">
                                <span class="font-weight-bold">Loyalty Program</span><br />
                                <span style="font-size:92%;">Earn rebates by purchase</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <div class="card information form-rounded">
                    <div class="card-body p-3 pl-4 pr-4">
                        <div class="row">
                            <div class="col-3 pl-3 pr-0 d-flex" style="justify-content: center; align-self: center;">
                                <img class="" src="images/lock.png" width="62%">
                            </div>
                            <div class="col-9 text-left p-2">
                                <span class="font-weight-bold">Secure Checkout</span><br />
                                <span style="font-size:92%;">Malaysia Payment</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--Information panel end-->
    </div>
    <!--Side panel end-->  

<script>

/* -------------------- Navigator for Left Menu ---------------------------- */
$('.category-list').click(function () {
    $('.cat-active').removeClass('cat-active');
    $(this).addClass('cat-active');
    var i =  $(this).attr('id');

    $.post( "product_listing.php", { i: i}).done(function( data ) {
        $( "#product_list" ).html(data);
        window.scrollTo(0, 0);
    });
})

$('.subcat-list').click(function(){                                       
    event.preventDefault();
    $('.subcat-list').removeClass('sub-active');
    $(this).addClass('sub-active');
    var s =  $(this).attr('id');

    $.post( "product_listing.php", { s: s}).done(function( data ) {
        $( "#product_list" ).html(data);
        window.scrollTo(0, 0);
    });
})


</script>