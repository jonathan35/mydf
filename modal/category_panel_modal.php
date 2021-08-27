<div id="categoryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-category-panel">
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-black" aria-hidden="true">&times;</span>
                </button>
                <!--Category panel start-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-rounded mb-2">
                            <div class=" pl-4 pr-4 text-left">

                                <!--offers row start -->
                                <div class="row mb-3">
                                    <div class="col-12 offers">
                                        <p class="category-panel-header pl-3">Offers</p>

                                        <a href="#">
                                            <div class="category-list p-3">Best Deals</div>
                                        </a>

                                        <a href="#">
                                            <div class="category-list p-3">Best Sellers</div>
                                        </a>


                                    </div>

                                </div>
                                <!--offers row end-->

                                <!--category row start-->
                                <div class="row">
                                    <div class="col-12 offers">
                                        <p class="category-panel-header pl-3">Category</p>

                                        <ul class="list-unstyled components">

                                            <!--category without sub category -->
                                            <a class="category-item" href="product_listing.php">
                                                <li class="">
                                                    <div class="category-list p-3">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                Snacks
                                                            </div>
                                                            <div class="col-3 pt-1">
                                                                <i class="fas fa-plus"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>

                                            <!--category with sub category -->
                                            <a class="category-item" href="#pageSubmenu" data-toggle="collapse"
                                                aria-expanded="false">
                                                <li class="">
                                                    <div class="category-list p-3">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                Diary
                                                            </div>
                                                            <div class="col-3 pt-1">
                                                                <i class="fas fa-plus"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="collapse subcategory list-unstyled" id="pageSubmenu">
                                                        <a href="#">
                                                            <li
                                                                class="mb-1 <?= ($activePage == 'manage-food-category') ? 'active':''; ?>">
                                                                <div class="row">
                                                                    <div class="offset-3 col-9">
                                                                        Milk
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </a>
                                                        <a href="#">
                                                            <li
                                                                class="mb-1 <?= ($activePage == 'manage-food-category') ? 'active':''; ?>">
                                                                <div class="row">
                                                                    <div class="offset-3 col-9">
                                                                        Butter
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </a>
                                                        <a href="#">
                                                            <li
                                                                class="mb-1 <?= ($activePage == 'manage-food-category') ? 'active':''; ?>">
                                                                <div class="row">
                                                                    <div class="offset-3 col-9">
                                                                        Cheese
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </a>
                                                    </ul>
                                                </li>
                                            </a>

                                        </ul>
                                    </div>
                                </div>
                                <!--categiry row end-->


                            </div>
                        </div>

                    </div>
                </div>
                <!--Category panel end-->
            </div>
        </div>
    </div>
</div>