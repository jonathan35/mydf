<div id="signupModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-edit-panel">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
                <div class="login-panel form-rounded">
                    <div class="pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
                        <div class="row p-4">
                            <div class="col-12 text-center mb-4">
                                <p class="login-title h1 text-white">Create Account</p>
                            </div>

                            <div class="col-12 form-group mb-4">
                                <label class="signup-label" for="name-input">Full Name</label>
                                <input type="text" class="signup-input form-control p-3" id="name" name="name"
                                    placeholder="Name">
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label class="signup-label" for="email-input">Email Address</label>
                                <input type="email" class="signup-input form-control p-3" id="email" name="email"
                                    placeholder="Email">
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label class="signup-label" for="mobile-input">Mobile Number (MY)</label>
                                <input type="text" class="signup-input form-control p-3" id="mobile" name="mobile"
                                    placeholder="Mobile">
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label class="signup-label" for="password-input">Password</label>
                                <input type="password" class="signup-input form-control p-3" id="password"
                                    name="password" placeholder="Password">
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label class="signup-label" for="confirm-password-input">Confirm Password</label>
                                <input type="password" class="signup-input form-control p-3" id="confirm-password"
                                    name="confirm-password" placeholder="Confirm Password">
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label class="signup-label" for="region-input">Region</label>
                                <select id="region" name="region" class="form-control signup-input">
                                    <option selected disabled hidden>Select Region</option>
                                    <option value="Kuching">Kuching</option>
                                    <option value="Sibu">Sibu</option>
                                    <option value="Miri">Miri</option>
                                </select>
                            </div>
                            <div class="col-3 col-sm-3 col-md-2 col-lg-2 form-group">
                                <i class="alert-icon fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="col-9 col-sm-9 col-md-10 col-lg-10 form-group mb-4">
                                <p class="notification-alert">You have selected a different region,
                                    your cart will be emptied.</p>
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label class="signup-label" for="area-input">Area</label>
                                <select id="area" name="area" class="form-control signup-input">
                                    <option selected disabled hidden>Select Area</option>
                                    <option value="Kuching">10th Mile</option>
                                    <option value="Sibu">BDC</option>
                                    <option value="Miri">Green Road</option>
                                </select>
                            </div>

                            <div class="col-12 form-group mb-4">
                                <label class="signup-label" for="delivery1-input">Delivery Address</label>
                                <textarea class="form-control signup-input" id="delivery1" name="delivery1"
                                    rows="3"></textarea>
                            </div>

                            <div class="col-12 form-check mb-4">
                                <input type="checkbox" class="signup-label" id="terms-check-input" name="terms">
                                <label class="form-check-label text-white" for="terms-check-input">I agree to the Terms
                                    of Use and Privacy Policy</label>
                            </div>

                            <div class="col-12 text-center form-group">
                                <button onclick="$('#signupModal').one('hidden.bs.modal', function() { $('#alertModal').modal('show'); }).modal('hide');" type="submit" value="signup-submit" class="btn login-btn btn-block p-3"><span
                                        class="center-word">CREATE</span></button>
                            </div>
                            <div class="col-12 text-center create-account form-group">
                                <a onclick="$('#signupModal').one('hidden.bs.modal', function() { $('#loginModal').modal('show'); }).modal('hide');"
                                    href=#>Login</a>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

