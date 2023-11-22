<?php

// Shortcode to display the multi-step registration form

function custom_registration_form_shortcode() {
    ob_start();
    ?>
<div class="container-fluid">
    <div class="row d-flex flex-column flex-md-row justify-content-center" style="gap:20px">
        <div class="col-11 col-md-3 columns-class d-flex flex-md-column  pt-5 pt-md-0" style="gap:7px">
            <div class="d-flex flex-column flex-md-row mt-md-4 mb-md-3" style="gap:20px">
                <div class="d-flex align-items-center justify-content-center"
                    style="z-index:1; background-color:#23DC32; height:40px; width:55px; border-radius:5px; color:white;">
                    <i id="firstClass" style="font-size:13px;" class="fa-solid fa-1"></i>
                </div>
                <div>
                    <h6 style="color:#32DC23; margin:0px; margin-bottom:5px">Personal Info</h6>
                    <p>Tell us about yourself to set up a secure account for you.</p>
                </div>
            </div>

            <div class="d-flex mb-3 flex-column flex-md-row" style="gap:20px">
                <div class="secondClass d-flex align-items-center justify-content-center"
                    style="z-index:1; background-color:#DEF1FD; height:40px; width:55px; border-radius:5px; color:#9E9E9E">
                    <i id="secondClass" style="font-size:13px;" class="fa-solid fa-2"></i>
                </div>
                <div>
                    <h6 style="margin:0px; margin-bottom:5px">Business Info</h6>
                    <p>Tell us about your business for a personalized experience.
                    </p>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row" style="gap:20px">
                <div class="d-flex align-items-center justify-content-center"
                    style="z-index:1; background-color:#DEF1FD; height:40px; width:38px; border-radius:5px; color:#9E9E9E">
                    <i id=thirdClass style="color:#32DC23; font-size:13px;" class="fa-solid fa-3"></i>
                </div>
                <div>
                    <h6 style="margin:0px; margin-bottom:5px">Verification</h6>
                    <p>Account verification via Email</p>
                </div>
            </div>
            <div class="hr-div">
                <hr>
            </div>
        </div>
        <div class="col-11 col-md-8  columns-class pt-3 pb-3 px-5">
            <form id="custom-registration-form" action="http://localhost/familythriftcenter/email-verification/"
                method="post">
                <!-- Step 1: Personal Information -->
                <div class="form-step" id="step-1">
                    <h2 style="font-size:24px;  font-weight:700; color:#23DC32">Personal Info</h2>
                    <p>Tell us about yourself to set up a secure account for you.</p>
                    <div class="form-row mb-3 mt-4">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name *</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name *</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone_number">Phone Number *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border:none ; background-color:#EFF2F5;">
                                        <img src="<?php echo plugins_url('alpha.png', __FILE__); ?>" alt="Phone Icon"
                                            style="width: 20px; height: 20px;">

                                    </span>
                                </div>
                                <input type="tel" class="form-control" id="phone_number" placeholder="Phone"
                                    name="phone_number" required>
                            </div>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password *</label>
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password" required onclick="showPasswordStrengthMeter()">
                            <div class="input-group-append d-flex justify-content-end">
                                <span class="input-group-text password-toggle alpha"
                                    onclick="togglePasswordVisibility('password')">
                                    <i style="color:#32DC23;" id="aa" class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirm_password">Confirm Password *</label>
                            <input type="password" class="form-control" id="confirm_password"
                                placeholder="Password Confirm" name="confirm_password" required>
                            <div class="input-group-append d-flex justify-content-end">
                                <span class="input-group-text password-toggle alpha"
                                    onclick="togglePasswordVisibility('confirm_password')">
                                    <i style="color:#32DC23;" id="bb" class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <!-- Password Strength Meter Container -->
                            <div class="password-strength" style="margin-top:-30px; display:none;">
                                <!-- <label for="password-strength-meter">Password Strength:</label> -->
                                <div id="password-strength-meter" class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0;"></div>
                                </div>
                                <div style="font-size:14px; " id="password-strength-label"
                                    class="password-strength-label">Very Weak</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-4" style="padding-left:5px; margin-top:-20px;">
                        <div class="form-check d-flex align-items-center">
                            <input type="checkbox" class="form-check-input" id="terms_and_conditions"
                                name="terms_and_conditions" required>
                            <label style="margin-left:10px;font-size:13px;line-height:20px; color: #9E9E9E;"
                                class="form-check-label" for="terms_and_conditions">By checking this box you
                                agree to SaasyPOS’s <span style="color:#23DC32;"><b>Terms & Condition</b></span> and
                                acknowledge <span style="color:#23DC32;"><b>End-User Agreement.</b></span><br>Your
                                account will be created and will be available for future login.</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 d-flex justify-content-start"><button
                                class="btn btn-custom-2 btn-primary" type="button" style="display:none">
                                <- Change Plan</button>
                        </div>
                        <div class="form-group col-md-6 d-flex justify-content-end">
                            <button class="btn btn-primary btn-custom" type="button" onclick="nextStep()">Continue<i
                                    style="margin-left:6px;" class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Step 2: Business Information -->
                <div class="form-step" id="step-2" style="display: none;">
                    <h6 style="font-size:24px; font-weight:700; color:#32DC23; margin:0px; margin-bottom:5px">Business
                        Info</h6>
                    <p>Tell us about your business</p>
                    <div class="form-group">
                        <label for="business_name">Company Name:</label>
                        <input type="text" class="form-control" id="business_name" name="business_name">
                    </div>

                    <!-- Hidden Div For storing the the value of bussiness divs -->
                    <div class="form-group" style='display: none;'>
                        <label for="business_phone">Business Phone:</label>
                        <input type="text" class="form-control" id="business_info_choice" name="business_info_choice">
                    </div>

                    <!-- Add the three boxes for business information -->
                    <div class="form-group">
                        <label for="business_info_choice">Choose Business Information:</label>
                        <div class="d-flex justify-content-center">

                            <div class="Option1 choice col-md-4 d-flex flex-column text-center pt-3"
                                onclick="selectBusinessInfo('Option1')">
                                <h6>Vapes/CBD</h6>
                                <p>My business belongs<br> to this category</p>
                            </div>
                            <div class="Option2 choice text-center col-md-4 pt-3"
                                onclick="selectBusinessInfo('Option2')">
                                <h6>Thrift</h6>
                                <p>My business belongs <br> to this category</p>
                            </div>
                            <div class="Option3 choice text-center col-md-4 pt-3"
                                onclick="selectBusinessInfo('Option3')">
                                <h6>General Retail</h6>
                                <p>My business belongs<br> to this category</p>
                            </div>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-6 d-flex justify-content-start"> <button
                                class="btn btn-custom btn-primary" type="button" onclick="prevStep()">Previous</button>
                        </div>
                        <div class="form-group col-md-6 d-flex justify-content-end">
                            <button class="btn btn-custom btn-primary" id=submit-form onclick="emailStep()"
                                type="submit">Submit</button>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>









<?php
    return ob_get_clean();
}

add_shortcode('custom_registration_form', 'custom_registration_form_shortcode');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['first_name'])) {
    custom_registration_handle_form();
}
//add_action('init', 'custom_registration_handle_form');
function custom_registration_handle_form() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_registration_data';
    $email = sanitize_email($_POST['email']); // Get the email value
    // Store the email value in the options table
    update_option('registration_email', $email);


    // Store the email value in a session variable
    //session_start();
    if (!session_id()) {
        session_start();
    }
    $_SESSION['registration_email'] = $email;
    // print_r($_SESSION['registration_email']);
    $wpdb->insert(
        $table_name,
        array(
            'first_name' => sanitize_text_field($_POST['first_name']),
            'last_name' => sanitize_text_field($_POST['last_name']),
            'email' => sanitize_email($_POST['email']),
            'phone_number' => sanitize_text_field($_POST['phone_number']),
            'password' => sanitize_text_field($_POST['password']),
            'terms_and_conditions' => isset($_POST['terms_and_conditions']) ? 1 : 0,
            'business_name' => sanitize_text_field($_POST['business_name']),
            'business_info_choice'=> sanitize_text_field($_POST['business_info_choice']),
        )
    );
    
   

      
}
?>