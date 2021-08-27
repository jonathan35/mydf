<?php 
include_once 'head.php';

$product = $photos = array();

if($_GET['i']){
    
    $id = $defender->encrypt('decrypt', $_GET['i']);
    $location = $_SESSION['location'];
    $region_sess = $_SESSION['region'];

    $product = sql_read("
        SELECT
            product.id, product.product_name, product.viewed,             
            product.region, product.brand, product.category AS category_id, product.sub_category AS sub_category_id, product.brand AS brand_id, product.sku, product.product_name, product.seo_title, product.seo_keyword, product.seo_description, product.viewed, product.best_deals, product.best_sellers, product.recommended, product.description, 
            category.category, sub_category.sub_category, brand.brand, 
            uom.id AS uom, uom.price AS price, uom.uom AS uom_name, 
            stock_promo.stock, stock_promo.promo 
        FROM uom 
        INNER JOIN product ON uom.product = product.id AND product.status=1 
        INNER JOIN stock_promo ON stock_promo.uom = uom.id AND stock_promo.location = ?
        JOIN brand ON product.brand = brand.id 
        JOIN category ON product.category = category.id 
        JOIN sub_category ON product.sub_category = sub_category.id         
        WHERE uom.id = ? AND uom.region = ? limit 1 
    ", 'sss', array($location, $id, $region_sess));

    if($product['id']){
        $photos = sql_read('select * from photos where product=?', 's', $product['id']);
        if(count($photos)>0){
            $product['photos'] = $photos;
        }
    }
    
    if($product['id']){
        $data = array();
        $data['id'] = $product['id'];
        $data['viewed'] = $product['viewed']+1;
        sql_save('product', $data);
    }

    $pid = $defender->encrypt('encrypt', $product['uom']);
    $uid = uniqid().$pid;
    $max = $product['stock'];

}
?>


<html lang="en">


<script>
document.title = '<?php echo $product['seo_title']?>';
</script>

<meta name="description" content="<?php echo $product['seo_description']?>">
<meta name="keywords" content="<?php echo $product['seo_keyword']?>">


<body class="container-fluid">
    <!-- Navigation row start-->
    <?php include("nav.php");?>
    <!-- Navigation row end-->
    <div class="row mt-5 mt-sm-5 mt-md-5 mt-lg-5 mb-2 mb-sm-2 mb-md-1 mb-lg-1"></div>

    <div class="row mt-5 pl-md-4 pr-md-4 pl-lg-4 pr-lg-4 mb-5">
        <!--////////////////////////////////////////// category ////////////////////////////////////////////// -->
        <?php include("category_panel.php");?>
        <div class="col-lg-10 content mt-5 mt-sm-5 mt-md-1 mt-lg-1" id="product_list">
            <?php 
            if(count($product)>0){?>

            <div class="row">
                <div class="col-12 breadcrumbs mt-5 mt-sm-5 mt-md-1 mt-lg-1">
                    <div class="d-block d-sm-none col-12"><br><br></div>
                    <a href="home"><span>Home</span></a> 
                    
                    <span style="color:#B8B8B8;">
                    <?php 
                    if(!empty($product['category_id']) && !empty($product['category'])){                        
                        $enc_cat_id = $defender->encrypt('encrypt', $product['category_id']);?>
                        > <span class="navigator path-link" nav-target="#product_list" nav-link="product_listing.php" nav-post='{"i":"<?php echo $enc_cat_id;?>"}'><?php echo $product['category'];?></span>
                    <?php }?>
                    
                    <?php 
                    if(!empty($product['sub_category_id']) && !empty($product['sub_category'])){
                        $enc_scat_id = $defender->encrypt('encrypt', $product['sub_category_id']);?>
                        > <span class="navigator path-link" nav-target="#product_list" nav-link="product_listing.php" nav-post='{"s":"<?php echo $enc_scat_id;?>"}'><?php echo $product['sub_category'];?></span>
                    <?php }?>
                    </span>
                    <?php if(!empty($product['product_name'])){
                        echo ' > '.$product['product_name'];
                    }?>
                </div>

            </div>

            <div class="row mt-4 back-link">
                <a href="#" class="navigator path-link" nav-target="#product_list" nav-link="product_listing.php" nav-post='{"s":"<?php echo $enc_scat_id;?>"}'>
                    <div class="col-12">
                        <i class="fas fa-arrow-left"></i> Back
                    </div>
                </a>
            </div>

        



            <div class="row mt-4">

                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card form-rounded">

                        <div id="myCarousel" class="carousel slide">
                            <!-- main slider carousel items -->
                            <div class="carousel-inner product-lightbox" style="display:flex; align-items:center">

                                <?php 
                                
                                if(count($product['photos'])>0){
                                    $c = 0;

                                    foreach((array)$product['photos'] as $photo){?>

                                    <div class="carousel-item <?php if($c==0) echo 'active'?>" data-slide-number="<?php echo $c?>">
                                        <img src="<?php echo $photo['photo']?>" class="img-fluid">
                                    </div>
                                    <?php 
                                    $c++;
                                    }
                                }

                                
                                
                                if(count($product['photos'])>1){?>
                                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#CarouselTest" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>

                                <?php }?>

                            </div>
                            <!-- main slider carousel nav controls -->

                            <?php 
                                if(count($product['photos'])>1){?>
                                <ul class="carousel-indicators mx-auto px-2">
                                    <?php 
                                    $c = 0;

                                    foreach((array)$product['photos'] as $photo){?>
                                    <li class="list-inline-item <?php if($c==0) echo 'active'?>">
                                        <a id="carousel-selector-<?php echo $c?>" class="selected" data-slide-to="<?php echo $c?>"
                                            data-target="#myCarousel">
                                            <img src="<?php echo $photo['photo']?>" class="img-fluid">
                                        </a>
                                    </li>
                                    <?php $c++;
                                    }?>
                                </ul>
                            <?php }?>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="row mb-3">
                        <div class="col-12">
                            <p class="product-detail-title"><?php if($product['product_name']) echo $product['product_name'];?></p>
                        </div>
                    </div>
                    <?php if($product['description']){?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <p class="product-detail-description-title">Product Description</p>
                            <p class="product-detail-description">
                                <?php echo nl2br($product['description']); ?>
                            </p>
                        </div>
                    </div>
                    <?php }?>
                    <!--
                    <div class="row mb-5">
                        <div
                            class="col-12 col-sm-3 col-md-3 col-lg-3 text-center text-sm-center text-md-left text-lg-left">
                            <p class="product-detail-select-title pt-2">Select Quantity</p>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="row">
                                <div class="col-4 text-right">
                                    <button type="button" class="btn btn-lg cart-counter-btn"><i
                                            class="text-white fas fa-minus"></i></button>
                                </div>
                                <div class="col-4 text-center">
                                    <input class="form-control cart-counter-input" type="number" placeholder="1" min="1"
                                        max="" disabled>
                                </div>
                                <div class="col-4 text-left">
                                    <button type="button" class="btn btn-lg cart-counter-btn"><i
                                            class="text-white fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="row">

                        <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                            <small class="product-detail-UOM"><?php if($product['uom_name']) echo $product['uom_name'];?></small>
                            <p class="product-detail-price">RM <?php if($product['price']) echo $product['price'];?></p>

                        </div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 mb-5">
                            <div class="row pl-3 pr-3 pt-lg-3 pt-md-3 big-cart">

                                <?php include 'add_to_cart_button.php';?>
                                <!--
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white btn-lg add-product-btn">ADD TO
                                        CART</i>
                                </div>-->

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php }?>



        </div>
    </div>


    <!--////////////////////////////////////////// footer ////////////////////////////////////////////// -->
    <?php include("footer.php");?>
    <!--////////////////////////////////////////// footer////////////////////////////////////////////// -->

</body>

</html>