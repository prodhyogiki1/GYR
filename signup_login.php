<div class="modal fade" id="signupLoginModal" tabindex="-1" role="dialog" aria-labelledby="signupLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="signupLoginModalLabel">Login / Sign Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="signupLoginTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="signup-tab" data-toggle="tab" href="#signupTab" role="tab" aria-controls="signupTab" aria-selected="true">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="login-tab" data-toggle="tab" href="#loginTab" role="tab" aria-controls="loginTab" aria-selected="false">Login</a>
                    </li>
                </ul>
                <div class="tab-content pt-4" id="signupLoginTabContent">
                    <div class="tab-pane fade show active" id="signupTab" role="tabpanel" aria-labelledby="signup-tab">
                        <div id="signupMessage" class="alert d-none"></div>
                        <form id="signupForm">
                            <div class="form-group">
                                <label for="signupName">Name</label>
                                <input type="text" class="form-control" id="signupName" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label for="signupEmail">Email</label>
                                <input type="email" class="form-control" id="signupEmail" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="signupPhone">Phone</label>
                                <input type="tel" class="form-control" id="signupPhone" name="phone" placeholder="Enter mobile number" required maxlength="10">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Send OTP</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="loginTab" role="tabpanel" aria-labelledby="login-tab">
                        <div id="loginMessage" class="alert d-none"></div>
                        <form id="loginForm">
                            <div class="form-group">
                                <label for="loginPhone">Mobile Number</label>
                                <input type="tel" class="form-control" id="loginPhone" name="phone" placeholder="Enter mobile number" required maxlength="10">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Send OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
