
<div class="mobile-menu col-lg-2 p-0 mt-3 d-md-none">

  
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-2">
                <div class="card-body pl-4 pr-4 text-left">

               
                    <div class="row mb-3">
                        <div class="col-12 offers">
                            <p class="category-panel-header pl-3">Offers</p>
                            <div style="border-top:3px solid #F32758; width:40px; height:0; position:relative; left:14px; top:-8px;"></div>
                            <form action="home" method="post" class="mobile-form">
                                <input type="hidden" name="i" value="best_deals">
                                <input type="submit" value="Best Deals" class="category-list-mobile p-3">
                            </form>
                            <form action="home" method="post" class="mobile-form">
                                <input type="hidden" name="i" value="best_sellers">
                                <input type="submit" value="Best Sellers" class="category-list-mobile p-3">
                            </form>
                        </div>
                    </div>

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
                                        <div>
                                         
                                            <form action="home" method="post" class="mobile-form">
                                                <input type="hidden" name="i" value="<?php echo $cat_enc_id;?>">
                                                <input type="submit" value="<?php echo $cat['category'];?>" class="category-list-mobile p-3">
                                            </form>
                                             
                                        </div>
                                        <?php if(count($scats)>0){?>
                                        <ul class="subcategory list-unstyled">
                                            <?php foreach((array)$scats as $scat){
                                                $scat_enc_id = $defender->encrypt('encrypt', $scat['id']);
                                                ?>
                                                <form action="home" method="post" class="mobile-form offset-2 col-10">
                                                    <input type="hidden" name="s" value="<?php echo $scat_enc_id;?>">
                                                    <input type="submit" value="<?php echo $scat['sub_category']?>" class="category-list-mobile p-3" style="background-color:white; color:#333; padding-top:0 !important; padding-bottom:0 !important;">
                                                </form>
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
                    


                </div>
            </div>

        </div>
    </div>

</div>


