<?php
?>

<!-- Login/Signup Popup Modal -->
<div class="modal fade" id="loginSignupModal" tabindex="-1" role="dialog" aria-labelledby="loginSignupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-pills mb-0" id="authTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login-tab-pane" type="button" role="tab" aria-controls="login-tab-pane" aria-selected="true">Sign In</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="signup-tab" data-bs-toggle="pill" data-bs-target="#signup-tab-pane" type="button" role="tab" aria-controls="signup-tab-pane" aria-selected="false">Sign Up</button>
                    </li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="authTabsContent">
                    <!-- Login Form -->
                    <div class="tab-pane fade show active" id="login-tab-pane" role="tabpanel" aria-labelledby="login-tab" tabindex="0">
                        <form id="loginForm" method="POST">
                            <div class="form-group mb-3">
                                <label for="login_email">Email Address</label>
                                <input type="email" class="form-control" id="login_email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="login_password">Password</label>
                                <input type="password" class="form-control" id="login_password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="form-group mb-3">
                                <div id="login_message"></div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                        </form>
                    </div>

                    <!-- Signup Form -->
                    <div class="tab-pane fade" id="signup-tab-pane" role="tabpanel" aria-labelledby="signup-tab" tabindex="0">
                        <form id="signupForm" method="POST">
                            <div class="form-group mb-3">
                                <label for="signup_name">Full Name</label>
                                <input type="text" class="form-control" id="signup_name" name="uname" placeholder="Enter your full name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="signup_phone">Phone Number</label>
                                <input type="text" class="form-control" id="signup_phone" name="phone" placeholder="Enter your phone number" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="signup_email">Email Address</label>
                                <input type="email" class="form-control" id="signup_email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="signup_address">Address</label>
                                <textarea class="form-control" id="signup_address" name="address" placeholder="Enter your address" rows="2" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="signup_password">Password</label>
                                <input type="password" class="form-control" id="signup_password" name="password" placeholder="Create a password" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="signup_confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="signup_confirm_password" placeholder="Confirm your password" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="signup_licence">Driving Licence Number</label>
                                <input type="text" class="form-control" id="signup_licence" name="licence" placeholder="Enter your licence number" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="signup_adhar">Aadhar Card Number</label>
                                <input type="text" class="form-control" id="signup_adhar" name="adhar" placeholder="Enter your aadhar number" required>
                            </div>
                            <div class="form-group mb-3">
                                <div id="signup_message"></div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Login Form Submit
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        $.ajax({
            url: '<?php echo $base_url;?>process_user_login.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#login_message').html('<span class="text-info">Logging in...</span>');
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#login_message').html('<span class="text-success">' + response.message + '</span>');
                    setTimeout(function() {
                        $('#loginSignupModal').modal('hide');
                        location.reload();
                    }, 1000);
                } else {
                    $('#login_message').html('<span class="text-danger">' + response.message + '</span>');
                }
            },
            error: function() {
                $('#login_message').html('<span class="text-danger">An error occurred. Please try again.</span>');
            }
        });
    });

    // Signup Form Submit
    $('#signupForm').on('submit', function(e) {
        e.preventDefault();
        
        var password = $('#signup_password').val();
        var confirm_password = $('#signup_confirm_password').val();
        
        if (password !== confirm_password) {
            $('#signup_message').html('<span class="text-danger">Passwords do not match!</span>');
            return;
        }
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: '<?php echo $base_url;?>process_user_signup.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#signup_message').html('<span class="text-info">Processing...</span>');
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#signup_message').html('<span class="text-success">' + response.message + '</span>');
                    setTimeout(function() {
                        $('#loginSignupModal').modal('hide');
                        location.reload();
                    }, 1500);
                } else {
                    $('#signup_message').html('<span class="text-danger">' + response.message + '</span>');
                }
            },
            error: function() {
                $('#signup_message').html('<span class="text-danger">An error occurred. Please try again.</span>');
            }
        });
    });

    // Clear messages when switching tabs
    $('#login-tab').on('click', function() {
        $('#login_message').html('');
    });
    $('#signup-tab').on('click', function() {
        $('#signup_message').html('');
    });
});
</script>

<style>
#loginSignupModal .modal-header {
    border-bottom: none;
    padding-bottom: 0;
}
#loginSignupModal .nav-pills {
    display: flex;
    gap: 10px;
}
#loginSignupModal .nav-pills .nav-link {
    background: #f0f0f0;
    border-radius: 25px;
    padding: 10px 30px;
    color: #333;
    border: none;
}
#loginSignupModal .nav-pills .nav-link.active {
    background: #ffc107;
    color: #333;
}
#loginSignupModal .modal-dialog {
    max-width: 500px;
}
#loginSignupModal .form-control {
    border-radius: 5px;
    padding: 12px;
    border: 1px solid #ddd;
}
#loginSignupModal .form-control:focus {
    border-color: #ffc107;
    box-shadow: none;
}
#loginSignupModal .btn-primary {
    background: #ffc107;
    border: none;
    padding: 12px;
    font-weight: 600;
    color: #333;
}
#loginSignupModal .btn-primary:hover {
    background: #e0a800;
}
#loginSignupModal label {
    font-weight: 500;
    margin-bottom: 5px;
    color: #333;
}
</style>