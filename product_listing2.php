<?php include_once 'head.php';?>


<html lang="en">


<body class="container-fluid">
    <!-- Navigation row start-->
    <?php include("nav.php");?>
    <!-- Navigation row end-->
    <div class="row mt-5 mt-sm-5 mt-md-5 mt-lg-5 mb-2 mb-sm-2 mb-md-1 mb-lg-1"></div>

    <div class="row mt-5 pl-md-4 pr-md-4 pl-lg-4 pr-lg-4">
        <!--////////////////////////////////////////// category ////////////////////////////////////////////// -->
        <?php include("category_panel.php");?>
        <div class="col-lg-10 content mt-5 mt-sm-5 mt-md-1 mt-lg-1">

            <div class="row mb-5">

                <div class="col-12 breadcrumbs mt-5 mt-sm-5 mt-md-1 mt-lg-1">
                    <a href="home"><span>Home</span></a> > <a href="home"><span
                            class="selected">Snacks</span></a>
                </div>

            </div>

            <!-- product listing row start -->
            <div class="row best-deals mb-3">
                <div class="col-12">
                    <div class="row-header">Snaks</div><br />

                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-2">
                    <!-- show the count of products in the category -->
                    <div class="count-of-products">Showing 28 products</div>
                </div>
                <div class="offset-md-5 offset-lg-5 col-12 col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">
                    <select class="form-control">
                        <option>Sort by Latest</option>
                        <option>Highest Price</option>
                        <option>Lowest Price</option>
                        <option>A - Z</option>
                        <option>Z - A</option>
                    </select>
                </div>
            </div>
            <div class="row product-item category-product-listing mb-4">


                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">

                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            LOW PRICE ALWAYS
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item"
                                            src="images/Maggi_Kari.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- an example if there is no promotion -->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/naturel.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->


                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            NEW ARRIVAL
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/chicken.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            PRICE DROPPED
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/fish.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/banana.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/coffee.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">

                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            LOW PRICE ALWAYS
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item"
                                            src="images/Maggi_Kari.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- an example if there is no promotion -->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/naturel.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->


                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            NEW ARRIVAL
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/chicken.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            PRICE DROPPED
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/fish.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/banana.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/coffee.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">

                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            LOW PRICE ALWAYS
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item"
                                            src="images/Maggi_Kari.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- an example if there is no promotion -->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/naturel.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->


                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            NEW ARRIVAL
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/chicken.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            PRICE DROPPED
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/fish.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/banana.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/coffee.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">

                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            LOW PRICE ALWAYS
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item"
                                            src="images/Maggi_Kari.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- an example if there is no promotion -->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/naturel.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->


                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            NEW ARRIVAL
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/chicken.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label promotion text-center">
                            PRICE DROPPED
                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/fish.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/banana.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->

                <!-- product card start -->
                <div class="col-6 col-sm-4 col-md-2 col-lg-2">


                    <div class="card form-rounded">
                        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                        <div class="label text-center">

                        </div>
                        <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                            <a href="product_detail.php">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center list-thumbnail">
                                        <img class="img-fluid product-img" alt="cart item" src="images/coffee.png" />
                                        <div class="overlay text-center">
                                            <img class="img-fluid" alt="tick" src="images/tick.png" />
                                            <p>Item added<br />to cart!</p>
                                        </div>
                                    </div>
                                    <div class="col-12 product-detail text-left">
                                        <div class="product-description">
                                            <span class="truancate">Nescafe Original 3 in 1
                                                Original Flavoured (28 satchels which is a lotwefwefewfwe
                                                fwefwefwef</span>
                                        </div>
                                        <p>
                                            <small class="UOM form-text text-muted text-left">1 Pack</small>
                                            <span class="price">RM 24.80</span><br />
                                            <span class="price-was"><del>RM 35.80</del></span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-block text-white add-product-btn">ADD TO
                                        CART</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product card end -->


            </div>
            <!-- product listing row end -->

            <!--pagination -->
            <div class="row mt-5 mb-5">
                <div class="col-12 text-center">
                    insert pagination here
                </div>
            </div>






        </div>
    </div>
    <!--////////////////////////////////////////// category ////////////////////////////////////////////// -->

    <!--////////////////////////////////////////// footer ////////////////////////////////////////////// -->
    <?php include("footer.php");?>
    <!--////////////////////////////////////////// footer////////////////////////////////////////////// -->


</body>

</html>