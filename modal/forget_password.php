<div id="forgetPasswordModal" class="modal fade" role="dialog">
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
                                <p class="text-white forget-title-label">Forgot your password?</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <p class="text-white">It's easy to reset your password. Just tell us the email address registered with us </p>
                            </div>
                        </div>
                        <div class="row">
                            <form action="" method="post" enctype="multipart/form-data" style="width:100%;">
                                <input type="hidden" name="action" value="reset_password">                        
                                <div class="col-12 form-group">
                                    <label class="email edit-input-label" for="new-email">Email Address</label>
                                    <input type="email" class="login-input form-control p-3" name="email" id="email"
                                        placeholder="Email Address">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 offset-md-6 offset-lg-6 text-center form-group">
                                    <button type="submit" value="submit" class="btn alert-btn btn-block p-2"><span
                                            class="center-word">Send</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>