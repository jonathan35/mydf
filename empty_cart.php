<?php 
require_once 'config/ini.php';

sql_exec('delete from items where session = ?','s',session_id());

include_once 'head.php';

?>
<html lang="en">
<!--////////////////////////////////////////// Head ////////////////////////////////////////////// -->

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
                </div>
            </a>
        </div>

        <div class="row mt-4 pl-lg-5 pr-lg-5 pl-md-5 pr-md-5 mb-md-5 mb-lg-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card form-rounded">
                    <div class="card-body pl-md-3 pr-md-3 pl-lg-3 pr-lg-3">
                        <div class="row p-md-4 p-lg-4 mb-md-5 mb-lg-5 mt-lg-5 mt-lg-5">
                            <div class="col-12 text-center mb-4 mt-lg-5 mt-lg-5">
                                <i class="fas fa-shopping-cart fa-5x"></i>
                                <p class="empty-title">Your shopping cart is <span class="card-header-title">empty!</span></p>
                            </div>
                            <div class="col-12 text-center mb-md-5 mb-lg-5">
                                <a href="home"><button type="submit"  class="btn empty-btn pt-3 pb-3 pl-5 pr-5">CONTINUE SHOPPING</span></button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--////////////////////////////////////////// Footer ////////////////////////////////////////////// -->
    <?php include("footer.php");?>
    <!--////////////////////////////////////////// Footer ////////////////////////////////////////////// -->

</body>

</html>