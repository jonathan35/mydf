<?php 
include_once 'head.php';
include_once 'config/session_msg.php';

if(@count($items)<1){
    header("Location:empty_cart");
}

?>


<html lang="en">
<body class="container-fluid">
    <!-- Navigation row start-->
    <?php include("nav.php");?>
    <!-- Navigation row end-->
    <div class="row mt-5">
        <div class="col mt-5 mt-sm-5 mt-md-1 mt-lg-1 mb-2 mb-sm-2 mb-md-1 mb-lg-1">

        </div>
    </div>

    <!-- Back link-->
    <div class="pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
        <div class="row mt-5 back-link pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
            <a href="home">
                <div class="col-12 mt-5 mt-sm-5 mt-md-1 mt-lg-1">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </div>
            </a>
        </div>

        <div class="row mt-4 pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card cart form-rounded">
                    <div class="card-body pl-md-3 pr-md-3 pl-lg-3 pr-lg-3">
                        <div class="row p-md-4 p-lg-4">
                            <div class="col-12 text-left">
                                <p class="card-header-title">Cart</p>
                            </div>
                            <div class="col-12 scrollable">




<?php 
//$items = sql_read('select * from items where session=?', 's', session_id());

if(@count($items)>0){
    foreach((array)$items as $item){
        $pid = $defender->encrypt('encrypt', $item['uom_id']);
        $uid = uniqid().$pid;
        $max = $item['stock'];
    ?>
    <div class="row mb-5" id="item<?php echo $uid?>">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-2 col-lg-2 mb-1">                
                    <img class="img-fluid" alt="cart item" src="<?php echo ROOT.$item['photo'];?>" onerror="this.onerror=null; this.src='images/photo-gray.svg'">      
                </div>
                <div class="col-6 col-sm-6 col-md-5 col-lg-5 mb-1">
                    <p>
                        <div class="cart-product-description">
                            <?php if($item['product']) echo $item['product'];?>
                        </div>
                        <div class="cart-product-brand">
                            <?php if($item['brand']) echo 'Brand: '.$item['brand'];?>
                        </div>
                        <div class="cart-product-unit">
                        <?php if($item['unit_price']) echo 'RM'.$item['unit_price'];?> 
                        
                        <?php if($item['uom']) echo 'RM'.$item['uom'];?>
                        </div>
                    </p>
                </div>
                <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-center">
                    <p>Select Quantity</p>
                    <div class="cart-counter big-cart">
                        <?php         
        
                        include 'add_to_cart_button.php';
                        ?>

                        <!--
                        <div class="row">
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-lg cart-counter-btn"><i
                                        class="text-white fas fa-minus"></i></button>
                            </div>
                            <div class="col-4 text-center">
                                <input class="form-control cart-counter-input" type="number"
                                    placeholder="1" min="1" max="" disabled>
                            </div>
                            <div class="col-4 text-left">
                                <button type="button" class="btn btn-lg cart-counter-btn"><i
                                        class="text-white fas fa-plus"></i></button>
                            </div>
                        </div>-->

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-center">
            <p class="cart-price" id="total_price<?php echo $uid?>" data-unit-price="<?php echo $item['unit_price']?>">
                <?php echo 'RM'.$item['total_price']?>
            </p>
            <button type="button" class="btn cart-remove-btn p-2" onclick="remove_item('<?php echo $uid?>')"><i
                    class="fas fa-times"></i>
                Remove item</button>
        </div>
    </div>
    <?php 
    }
}else{ 
    echo 'No items in your cart..';
}?>

                               

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4" id="right_column">
                <?php                 
                if(empty($_SESSION['auth_user']['id'])){
                    if($_POST['action'] == 'signup'){
                        include("cart_signup.php");
                    }else{
                        include("cart_login.php");
                    }
                }else{
                    include("cart_summary_panel.php");
                }
                ?>
            </div>

            <script>
            /*
            $('.ajax_submit').click(function(e){
                event.preventDefault();
                var form = $(this).closest('form').fadeOut();                
            })
*/
            /*
            $.post('add_to_cart_button_qry.php', {u:pid, q:qty},function(data){
                $('#cart_summary').load('cart_summary.php');            
                return true;
            })*/
            
            
            </script>


        </div>
    </div>



    <!--////////////////////////////////////////// Footer ////////////////////////////////////////////// -->
    <?php include("footer.php");?>
    <!--////////////////////////////////////////// Footer ////////////////////////////////////////////// -->

</body>

</html>