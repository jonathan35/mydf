<?php 

include_once 'head.php';



if($_POST['i']=='best_deals'){
    $title = 'Best Deals';
    $path = '<span style="color:#B8B8B8;"> > <span class="selected">Best Deals</span></span>';
    $products = get_products('best_deals', '', $_POST['sort']);
}elseif($_POST['i']=='best_sellers'){
    $title = 'Best Sellers';
    $path = '<span style="color:#B8B8B8;"> > <span class="selected">Best Sellers</span></span>';
    $products = get_products('best_sellers', '', $_POST['sort']);
}elseif(!empty($_POST['i'])){
    $cat_id = $defender->encrypt('decrypt', $_POST['i']);
    $set_cat = sql_read('select * from category where id=? limit 1', 's', $cat_id);
    $title = $set_cat['category'];
    $path = '<span style="color:#B8B8B8;"> > <span class="selected">'.$title.'</span></span>';
    $products = get_products('category', $set_cat['id'], $_POST['sort']);
}elseif(!empty($_POST['s'])){
    $scat_id = $defender->encrypt('decrypt', $_POST['s']);
    $set_scat = sql_read('select * from sub_category where id=? limit 1', 's', $scat_id);
    $set_cat = sql_read('select * from category where id=? limit 1', 's', $set_scat['category']);
    $title = $set_scat['sub_category'];
    $enc_cat_id = $defender->encrypt('encrypt', $set_cat['id']);   
    $path = '<span style="color:#B8B8B8;"> > <span class="navigator path-link" nav-target="#product_list" nav-link="product_listing.php" nav-post=\'{"i":"'.$enc_cat_id.'"}\'>'.$set_cat['category'].'</span> > <span class="selected">'.$title.'</span></span>';
    $products = get_products('sub_category', $set_scat['id'], $_POST['sort']);
}elseif(!empty($_POST['k'])){
    $title = $_POST['k'];
    $path = '<span style="color:#B8B8B8;"> > <span class="selected">'.$title.'</span></span>';
    $products = get_products('keyword', $_POST['k'], $_POST['sort']);
}


$count_product = @count((array)$products);

?>


<div class="loader-lds-ellipsis"><div class="lds-ellipsis"><div></div><div></div><div></div></div></div>

<div class="col-lg-12 content mt-0 pt-xs-0 mt-sm-5 mt-md-1 mt-lg-1">

    <div class="row mb-5">

        <div class="col-12 breadcrumbs mt-5 mt-sm-5 mt-md-1 mt-lg-1">
            <a href="home"><span>Home</span></a> <?php echo $path?>         
        </div>

        <div class="row mt-4 back-link pl-3">
            <?php 
            $link = 'href="'.ROOT.'"';
          
            if(!empty($_POST['s'])){
                $en_cat_id = $defender->encrypt('encrypt', $set_cat['id']);
                $link = 'href="#" class="navigator" nav-target="#product_list" nav-link="product_listing.php" nav-post=\'{"i":"'.$en_cat_id.'"}\'';
            }
            ?>
            <a <?php echo $link?>>
                <div class="col-12">
                    <i class="fas fa-arrow-left"></i> Back
                </div>
            </a>
        </div>

        
    </div>

    <!-- product listing row start -->
    <div class="row best-deals mb-3">
        <div class="col-12">
            <div class="row-header">
                <?php echo $title?>
                <div class="pink-line"></div>
            </div>
            
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-2">
            <!-- show the count of products in the category -->
            <div class="count-of-products">Showing <?php echo $count_product?> products</div>
        </div>
        <div class="offset-md-5 offset-lg-5 col-12 col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">
            <select class="form-control" onchange="sort_it(this);">
                <option>Sort by Latest</option>
                <?php
                if(!empty($_POST['k'])){
                    $l = 'k';
                    $lv = $_POST['k'];
                }elseif(!empty($_POST['s'])){
                    $l = 's';
                    $lv = $_POST['s'];
                }else{
                    $l = 'i';
                    $lv = $_POST['i'];
                }
                $ps = $_POST['sort'];
                ?>
                <option nav-target="#product_list" nav-link="product_listing.php" nav-post='{"<?php echo $l?>":"<?php echo $lv?>", "sort":"price_desc"}' <?php if($ps=='price_desc'){?>selected<?php }?>>Highest Price</option>
                <option nav-target="#product_list" nav-link="product_listing.php" nav-post='{"<?php echo $l?>":"<?php echo $lv?>", "sort":"price_asc"}' <?php if($ps=='price_asc'){?>selected<?php }?>>Lowest Price</option>
                <option nav-target="#product_list" nav-link="product_listing.php" nav-post='{"<?php echo $l?>":"<?php echo $lv?>", "sort":"alphabet_asc"}' <?php if($ps=='alphabet_asc'){?>selected<?php }?>>A - Z</option>
                <option nav-target="#product_list" nav-link="product_listing.php" nav-post='{"<?php echo $l?>":"<?php echo $lv?>", "sort":"alphabet_desc"}' <?php if($ps=='alphabet_desc'){?>selected<?php }?>>Z - A</option>
            </select>
        </div>
    </div>
    <div class="row product-item category-product-listing mb-4">

    <?php
    if($count_product>0){

        $itemCount=1;
        $maxPerPage=30;

        foreach((array)$products as $product){
            
        $pid = $defender->encrypt('encrypt', $product['uom']);
        $uid = uniqid().$pid;
        $max = $product['stock'];
        ?>
        <!-- product card start -->
        <div class="col-6 col-sm-4 col-md-2 col-lg-2 p-2 p-sm-3 page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>">
            <div class="card form-rounded">
                <div class="label <?php if(!empty($product['promo'])) echo 'promotion';?> text-center">
                    
                    <?php 
                    if(!empty($product['promo'])){
                        if($product['promo'] == 'new'){
                            echo 'NEW ARRIVAL';
                        }elseif($product['promo'] == 'low'){
                            echo 'LOW PRICE ALWAYS';
                        }elseif($product['promo'] == 'drop'){
                            echo 'PRICE DROPPED';
                        }
                    }
                    ?>
                </div>
                <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                    <a href="detail?i=<?php echo $pid;?>">
                        <div class="row">
                            <div class="col-12 mb-3 list-thumbnail">
                                <img class="img-fluid product-img" alt="cart item"
                                    src="<?php echo ROOT.$product['photos'][0]['photo'];?>" onerror="this.onerror=null; this.src='images/photo-gray.svg'" />
                                <div class="overlay text-center overlay<?php echo $uid;?>">
                                    <img class="img-fluid" alt="tick" src="images/tick.png" />
                                    <p>Item added<br />to cart!</p>
                                </div>
                            </div>
                            <div class="col-12 product-detail text-left">
                                <div class="product-description">
                                    <span class="truancate"><?php echo $product['product_name']; ?>
                                </span>
                                </div>
                                <p>
                                    <small class="UOM form-text text-muted text-left"><?php echo $product['uom_name']?></small>
                                    <span class="price">RM <?php echo $product['price']?></span><br />
                                    <?php if($product['was']>0){?>
                                    <span class="price-was"><del>RM <?php echo $product['was']?></del></span>
                                    <?php }?>
                                </p>

                            </div>
                        </div>
                    </a>
                    <div class="row">
                        <div class="col-12 text-center">
                        <?php 

                        include 'add_to_cart_button.php';
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- product card end -->

        <?php     
        $itemCount++;
        }
    }?>                 

       
    </div>
        <div class="row mt-5 mb-5">
        <div class="col-12 text-center">
            <?php include 'paging.php';?>
        </div>
    </div>
</div>



<script>
$(document).ready(function(){
    $('.loader-lds-ellipsis').slideUp();
});
$('.loader-lds-ellipsis').slideUp();
</script>

<script src="js/add_to_cart_button.js"></script>
<script src="js/functions.jquery.js"></script>


<script>
function sort_it(e) {
    
  var target = $(e).children("option:selected").attr("nav-target");
  var link = $(e).children("option:selected").attr("nav-link");
  var post = $(e).children("option:selected").attr("nav-post");
  var post_obj = JSON.parse(post);

  $.post(link, post_obj).done(function (data) {
    $(target).html(data);
  });
}
</script>