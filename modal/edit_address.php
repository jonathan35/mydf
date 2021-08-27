<div id="editProfileAddressModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-black" aria-hidden="true">&times;</span>
                </button>
                <div class="form-rounded">
                    <div class="pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
                        <div class="row p-4">
                            <div class="col-12 text-center mb-4">
                                <p class="edit-delivery-title">Add new delivery address</p>
                            </div>

                            <form action="" method="post" enctype="multipart/form-data" class="row">
                        
                            <div class="col-12 form-group mb-4">
                                <label class="edit-delivery-label" for="area-input">Area</label>
                                <select id="area" name="area" class="form-control signup-input" required>
                                    <option selected disabled hidden>Select Area</option>
                                    <?php 
                                    if(@count($region_areas)>0){
                                        foreach((array)$region_areas as $area){?>
                                            <option value="<?php echo $defender->encrypt('encrypt', $area['id'])?>"><?php echo $area['area']?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>

                            <div class="col-12 form-group mb-4">
                                <label class="edit-delivery-label" for="address">Delivery Address</label>
                                <textarea class="form-control signup-input" id="address" name="address"
                                    rows="3"  required></textarea>
                            </div>
                            

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center form-group">
                                <button value="cancel" data-dismiss="modal" 
                                    class="btn cancel-btn btn-block p-2">Cancel</button>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center form-group">
                               <button type="submit" value="submit"
                                    class="btn alert-btn btn-block p-2">Confirm</button></a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>