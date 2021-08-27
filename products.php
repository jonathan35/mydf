<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';

?>

<html lang="en">


<div class="cat-trigger d-sm-none" onclick="$('.category-panel').toggleClass('category-active');"><i class="fa fa-search" aria-hidden="true"></i></div>


<body class="container-fluid p-0">
    <div class="my-container">

        <?php include 'header.php';?>
        <div style="height:66px;">
            <div class="page_title">
                Products
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center pt-4 pb-3" style="color:#003466; font-size:18px;">
                We have more products that are not listed here, please get in contact with us to find a perfect products!
            </div>
        </div>
        
        <?php 
        $categories = sql_read("select * from category where status =? order by position asc, category asc", 's', 1);
        $products = sql_read("select * from product where status =? order by position asc, modified desc", 's', 1);

        foreach((array)$categories as $cat){
            $en_cat[$cat['id']] = $defender->encrypt('encrypt', $cat['id']);
        }
        ?>

        <div class="row wave_rec">

            <div class="col-12 col-md-3 pt-3 category-panel">
                <div class="pro-cat" onclick="filter_product('.fil-cat')">
                    All Products
                </div>
                <?php 
                foreach((array)$categories as $cat){?>
                    <div class="pro-cat" onclick="open_sub('#cat-<?php echo $en_cat[$cat['id']]?>')">
                        <?php echo $cat['category'];?>
                    </div>
                    <div class="subcat" prv="false" id="cat-<?php echo $en_cat[$cat['id']]?>" style="display:none; ">
                    <?php 

                    $scats = sql_read("select * from sub_category where status =? and category=?", 'ii', array(1, $cat['id']));

                    foreach((array)$scats as $scat){
                        $en_scat[$scat['id']] = $defender->encrypt('encrypt', $scat['id']);
                        ?>
                        <div class="pro-scat" 
                        onclick="filter_product('.fil-<?php echo $en_scat[$scat['id']]?>')">
                            <div class="row">
                                <div class="col-1">
                                    <img src="<?php echo ROOT?>images/chair-20.png">
                                </div>
                                <div class="col-10 pr-0">
                                    <?php echo $scat['sub_category'];?>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    </div>
                <?php }?>

                <script>
                function open_sub(t){
                  
                    //$('.subcat').hide();
                    $('.subcat').slideUp();

                    let current = $(t).attr('prv');

                    if(current == 'false'){
                        //$(t).removeClass('d-none');
                        $(t).attr('prv', 'true');
                        $(t).slideDown();
                    }else{
                        $(t).attr('prv', 'false');
                    }

                }
                function filter_product(cat){
                    $('.fil-cat').hide();
                    $(cat).fadeIn();
                }
                </script>
            </div>
            

            <div class="col-12 col-md-9 p-4 pl-2 pr-md-5"><!-- pl-md-5-->
                <div class="row">

                <?php        
                               
                $itemCount=1;
                $maxPerPage=20;

                foreach((array)$products as $product){?>

                    <div class="col-12 col-sm-4 pb-4 ani_card fil-cat fil-<?php echo $en_scat[$product['sub_category']];?> page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>">
                        <div class="product-item">
                            <a href="product_details/<?php echo $str_convert->to_url($product['name']);?>" style="text-decoration:none;">
                                    <div class="col-12 mb-2 list-zoom">
                                        <div class="bg-cover list-thum" style="background-image:url('<?php echo ROOT.$product['photo'];?>')"></div>
                                    </div>
                                    <div class="col-12 text-center" style="height:80px;">
                                        <div class="truancate">
                                            <?php echo $product['name']; ?>
                                        </div>
                                    </div>
                                
                               
                            </a>
                        </div>
                    </div>
                <?php }?>
                </div>
                
                <?php include 'paging.php';?>
            </div>

            
        </div>

    </div>


    <div class="row">
        <div class="col-12">
            <div class="row"><div class="col-12"><br><br><br><br><br></div></div>
            <? include 'footer.php';?>        
        </div>
    </div>                
            

</body>

</html>
