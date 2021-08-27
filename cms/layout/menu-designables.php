<?php 
	$page_name = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>

<div class="col-sm-3 col-md-2 sidebar">
  <h4>Product</h4>
  <ul class="nav nav-sidebar">
    <li <?php if($page_name == 'review.php'){?>class="active"<?php }?>><a href="../product/review.php">Review <?php if($review_alert > 0){?><span style="color:red; font-weight:bold;"><?php echo $review_alert?></span><?php }?></a></li>
    <li <?php if($page_name == 'createCategory.php'){?>class="active"<?php }?>><a href="../product/createCategory.php">Main Category</a></li>
    <li <?php if($page_name == 'createSubCategory.php'){?>class="active"<?php }?>><a href="../product/createSubCategory.php">Sub Category</a></li>
    <li <?php if($page_name == 'createFont.php'){?>class="active"<?php }?>><a href="../product/createFont.php">Font</a></li>
    <li <?php if($page_name == 'createColor.php'){?>class="active"<?php }?>><a href="../product/createColor.php">Color</a></li>
    <li <?php if($page_name == 'createSize.php'){?>class="active"<?php }?>><a href="../product/createSize.php">Size</a></li>
    <?php 
	$review_alert_query=mysqli_query($conn, "SELECT * FROM review WHERE approval=''");
	$review_alert = mysqli_num_rows($review_alert_query);?>
    <li <?php if($page_name == 'createBackground.php' || $page_name == 'editBackground.php'){?>class="active"<?php }?>><a href="../product/createBackground.php">Background</a></li>
    
    
    <!--<li <?php if($page_name == 'createDiscount.php'){?>class="active"<?php }?>><a href="../product/createDiscount.php">Discount</a></li>-->
  </ul>
  
  <ul class="nav nav-sidebar" style="border-top:1px solid #DADEF1;">
    <li <?php if($page_name == 'createProduct.php'){?>class="active"<?php }?>><a href="../product/createProduct.php">Create Product</a></li>
    <li <?php if($page_name == 'manageProduct.php' || $page_name == 'editProduct.php'){?>class="active"<?php }?>><a href="../product/manageProduct.php">Manage Product</a></li>
    <li <?php if($page_name == 'createLayout.php'){?>class="active"<?php }?>><a href="../product/createLayout.php?default=1">Create Layout</a></li>
    <li <?php if($page_name == 'manageLayout.php'){?>class="active"<?php }?>><a href="../product/manageLayout.php">Manage Layout</a></li>
    <li <?php if($page_name == 'createAttachment.php'){?>class="active"<?php }?>><a href="../product/createAttachment.php">Product Attachment</a></li>
    <li <?php if($page_name == 'createGallery.php' || $page_name == 'editGallery.php'){?>class="active"<?php }?>><a href="../product/createGallery.php">Product Photo Gallery</a></li>
  </ul>
  
  <h4>Order & Shipping</h4>
  <ul class="nav nav-sidebar">
    <li <?php if($page_name == 'createZone.php'){?>class="active"<?php }?>><a href="../delivery/createZone.php">Delivery Zone</a></li>
    <li <?php if($page_name == 'createPrice.php'){?>class="active"<?php }?>><a href="../delivery/createPrice.php">Delivery Price</a></li>
    <li <?php if($page_name == 'editCart.php'){?>class="active"<?php }?>><a href="../delivery/editCart.php">Terms of Delivery</a></li>
    <li <?php if($page_name == 'customerList.php'){?>class="active"<?php }?>><a href="../delivery/customerList.php">Order Basket</a></li>
  </ul>
  
  <h4>Dynamic Content</h4>
  <ul class="nav nav-sidebar">
    <li <?php if($page_name == 'editLogo.php'){?>class="active"<?php }?>><a href="../content/editLogo.php">Logo</a></li>
    <li <?php if($page_name == 'editHomeTitle.php'){?>class="active"<?php }?>><a href="../content/editHomeTitle.php">Home Title</a></li>
    <li <?php if($page_name == 'createContent.php' || $page_name == 'editContent.php'){?>class="active"<?php }?>><a href="../content/createContent.php">Free Format Content</a></li>
  </ul>
  
  <h4>Account</h4>
  <ul class="nav nav-sidebar">
    <li <?php if($page_name == 'manageUser.php' || $page_name == 'editUser.php' || $page_name == 'accountBooking.php'){?>class="active"<?php }?>><a href="../account/manageAccount.php">Accounts</a></li>
  </ul>
  
  
  
  <h4>&nbsp;</h4>
  
</div>
