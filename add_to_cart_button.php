<div class="add_to_cart_button" id="a2c_area<?php echo $uid;?>">

    <?php 
    
    
    if($max<1){?>
        <button type="button" class="out-of-stock btn btn-block text-white add-product-btn">OUT OF STOCK</button>
    <?php }else{

        $added_qty = $items_id_qty[$pid];
        
        ?>
        <button type="button" class="add_to_cart btn btn-block text-white add-product-btn" data-id="<?php echo $pid;?>" data-uid="<?php echo $uid;?>" id="add_to_cart<?php echo $uid?>" style="<?php if($added_qty){?>display:none;<?php }?>">ADD TO CART</button>
     
        <div class="a2c_pm" id="a2c<?php echo $uid;?>" style="<?php if($added_qty){?>display:flex;<?php }?>">
            <div class="a2c_left" data-uid="<?php echo $uid?>">
                <img src="images/remove-white-18dp.svg">
            </div>
            <div class="a2c_center" data-uid="<?php echo $uid?>">            
                <input type="number" value="<?php if($added_qty) echo $added_qty; else echo '1';?>" id="a2cinput<?php echo $uid?>" data-id="<?php echo $pid;?>" max="<?php echo $max;?>" data-uid="<?php echo $uid;?>" class="addtocart">
            </div>
            <div class="a2c_right" data-uid="<?php echo $uid?>">
                <img src="images/add-white-18dp.svg">
            </div>
        </div>
    <?php }//debug($exist_items)?>
</div>
