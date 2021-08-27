<div id="emailModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-edit-panel">
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
                <div class="login-panel form-rounded">
                    <div class="pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
                        <div class="row">
                            <div class="col-12">
                            <p class="text-white edit-title-label">Change Email Address</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group">

                            <form action="" method="post" enctype="multipart/form-data" style="width:100%;">
                                <label class="new-email edit-input-label keyup-validate" validate-input="email" validate-result="#validate_result" for="new-email">New Email Address</label>
                                    <input type="email" class="login-input form-control p-3" name="new_email" id="new-email"
                                        placeholder="Email Address">
                                        <div id="validate_result"></div>
                                </div>
                                <div class="col-12 form-group">
                                <label class="old-email edit-input-label" for="old-email">Old Email Address</label>
                                    <input type="email" class="login-input form-control p-3" name="old_email" id="old-email"
                                        placeholder="Email Address">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 offset-md-6 offset-lg-6 text-center form-group">
                                    <button type="submit" value="submit" class="btn alert-btn btn-block p-3"><span class="center-word">Confirm</span></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>