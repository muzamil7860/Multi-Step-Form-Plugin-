<?php

//Starting the session
add_action('init', function () {
    if (!session_id()) {
        session_start();
    }
});

function custom_registration_form_shortcode()
{
    ob_start();
    ?>

<div class="conatiner-fluid loader" style="display:none;">
    <div class="ngx-spinner-overlay">
        <div class="la-square-jelly-box">
            <div></div>
            <div></div>
        </div>
        <div class="loading-text">
            <p>Please wait while Loading...</p>
        </div>
    </div>
</div>

<div class="container-fluid main-container1 fluid-spinner-container py-3 ">
    <div class="row d-flex flex-column flex-md-row justify-content-center align-items-center align-items-md-start"
        style="gap:20px;">
        <!-- //here -->
        <div class="col-11 col-md-3 columns-class first-column d-flex flex-column flex-md-column pt-2 pt-md-0 green-div"
            style="gap:7px; padding-right:30px;">
            <!-- ////////////// -->
            <div class="text-center-first text-center">
                <a href="https://saasypos.com/"> <img
                        src="<?php echo plugins_url('./assets/images/logo.png', __FILE__); ?>" alt="Phone Icon"
                        style="width: 180px; "></a>
                <h2 style="font-size:22px;  font-weight:700; color:#23DC32;">
                    30-Day Free
                    Trial
                </h2>
                <p class="paraclass">
                    Unlimited access to all features. No credit card required</p>
            </div>
            <!-- ////////////// -->
            <div class="hello d-flex flex-row flex-md-column" style="gap:10px">
                <div class="gappingClass d-flex flex-column flex-md-row mt-md-4 mb-md-3 col-4 col-md-12 align-items-center align-items-md-start"
                    style="padding:0px">
                    <div class="settingwidthGreen d-flex align-items-center justify-content-center px-0 px-md-3"
                        style="height:45px; z-index:1; background-color:#23DC32; border-radius:5px; color:white;">
                        <i id="firstClass" style="font-size:16px;" class="fa-solid fa-1"></i>
                    </div>
                    <div>
                        <h6 class="heading" style="color:#32DC23; margin:0px; margin-bottom:5px">Personal Info</h6>
                        <p class="first-col-para">Tell us about yourself to set up a secure account for you.</p>
                    </div>
                </div>

                <div class="gappingClass d-flex mb-3 flex-column flex-md-row col-4 col-md-12 align-items-center align-items-md-start"
                    style="padding:0px">
                    <div class="settingwidthGreen secondClass d-flex align-items-center justify-content-center px-0 px-md-3"
                        style="height:45px; z-index:1; background-color:#DEF1FD; border-radius:5px; color:#9E9E9E">
                        <i id="secondClass" style="font-size:16px;" class="fa-solid fa-2"></i>
                    </div>
                    <div>
                        <h6 class="heading" style="margin:0px; margin-bottom:5px">Business Info</h6>
                        <p class="first-col-para">Tell us about your business for a personalized experience.
                        </p>
                    </div>
                </div>



                <div class="gappingClass d-flex flex-column flex-md-row col-4 col-md-12 align-items-center align-items-md-start"
                    style="padding:0px;">
                    <div class="settingwidthGreen d-flex align-items-center justify-content-center px-3"
                        style="height:45px; z-index:1; background-color:#DEF1FD; border-radius:5px; color:#9E9E9E">
                        <i id=thirdClass style="color:#32DC23; font-size:16px;" class="fa-solid fa-3"></i>
                    </div>
                    <div class="mb-lg-3">
                        <h6 class="heading" style="margin:0px; margin-bottom:5px">Verification</h6>
                        <p class="first-col-para">Account verification with <br> your Email</p>
                    </div>
                </div>
                <div class="hr-div">
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-11 col-md-8  columns-class  px-md-5" style="padding-top:10px;">
            <form id="custom-registration-form" action="http://localhost/familythriftcenter/email-verification/"
                method="post">
                <!-- Step 1: Personal Information -->
                <div class="form-step" id="step-1">
                    <div class="text-center">
                        <a href="https://saasypos.com/"> <img class="d-none d-md-block"
                                src="<?php echo plugins_url('./assets/images/logo.png', __FILE__); ?>" alt="Phone Icon"
                                style="width: 180px; "></a>
                        <h2 class="d-none d-md-block" style="font-size:22px;  font-weight:700; color:#23DC32;">
                            30-Day Free
                            Trial
                        </h2>
                        <p class="paraclass d-none d-md-block">
                            Unlimited access to all features. No credit card required</p>
                    </div>
                    <div class="pt-2 pt-md-3">
                        <h4 style="color:#23DC32; margin-bottom:4px;">Personal Info
                        </h4>
                        <p>Tell us about yourself to set up a secure account for you.</p>
                    </div>
                    <div class="form-row" style="margin-top:8px;">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name <span class="required-asterisk">*</span></label>
                            <input type="text" class="form-control required-asterisk" id="first_name" name="first_name"
                                required>
                            <!-- Add this div below the Name input field -->
                            <div id="name-error-message" class="error-div" style="color: red; font-size:13px;"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name <span class="required-asterisk">*</span></label>
                            <input type="text" class="form-control required-asterisk" id="last_name" name="last_name"
                                required>
                            <!-- Add this div below the Last Name input field -->
                            <div id="lastNameError" class="error-div" style="color: red; font-size:13px;"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email <span class="required-asterisk">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <!--div below the email input field -->
                            <div id="email-error-message" class="error-div" style="color: red; font-size:13px;"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone_number">Phone Number <span class="required-asterisk">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border:none ; background-color:#EFF2F5;">
                                        <img src="<?php echo plugins_url('./assets/images/AmericanFlag.png', __FILE__); ?>"
                                            alt="Phone Icon" style="width: 20px; height: 20px;">

                                    </span>
                                </div>
                                <input type="tel" class="form-control required-asterisk" id="phone_number"
                                    name="phone_number" required>
                            </div>
                            <!-- Add this div below the Name input field -->
                            <div id="phone-error-message" class="error-div" style="color: red; font-size:13px;"></div>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group form-group-password col-md-6">
                            <label for="password">Password <span class="required-asterisk">*</span></label>
                            <input type="password" class="form-control required-asterisk" id="password" name="password"
                                required onclick="showPasswordStrengthMeter()">
                            <div class="input-group-append d-flex justify-content-end">
                                <span class="input-group-text password-toggle alpha"
                                    onclick="togglePasswordVisibility('password')">
                                    <i style="color:#32DC23;" id="aa" class="fas fa-eye"></i>
                                </span>
                            </div>

                            <div id="password-feedback" class="error-div-password"
                                style="color: red; font-size: 13px; margin-top:-15px; margin-bottom:20px; line-height:20px">
                            </div>
                            <!-- ///////////// -->
                            <div class="password-strength" style="margin-top:-5px; display:none;">
                                <div id="password-strength-meter" class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0;"></div>
                                </div>
                                <div style="font-size:13px; " id="password-strength-label"
                                    class="password-strength-label">Very Weak</div>
                            </div>
                            <!-- ///////////// -->
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirm_password">Confirm Password <span
                                    class="required-asterisk">*</span></label>
                            <input type="password" class="form-control required-asterisk" id="confirm_password"
                                name="confirm_password" required>
                            <div class="input-group-append d-flex justify-content-end">
                                <span class="input-group-text password-toggle alpha"
                                    onclick="togglePasswordVisibility('confirm_password')">
                                    <i style="color:#32DC23;" id="bb" class="fas fa-eye"></i>
                                </span>
                            </div>
                            <!--div below the password input field -->
                            <div id="password-error-message" class="error-div-password"
                                style="color: red; font-size:13px; position:relative;bottom:20px;"></div>
                        </div>
                    </div>
                    <div class="form-row" style="padding-left:5px; margin-top:-20px;">
                        <div class="form-check d-flex align-items-md-center">
                            <input type="checkbox" class="form-check-input required-asterisk" id="terms_and_conditions"
                                name="terms_and_conditions" required>
                            <label style="margin-left:10px;font-size:13px;line-height:20px; color: #9E9E9E;"
                                class="form-check-label" for="terms_and_conditions">By checking this box you
                                agree to SaasyPOS’s <a href="https://saasypos.com/terms-of-services/"
                                    target="_blank"><span style="color:#23DC32;"><b>Terms of Services</b></span></a> and
                                acknowledge <a href="https://saasypos.com/privacy-policy/" target="_blank"><span
                                        style="color:#23DC32;"><b>Privacy Policy</b></span></a><br></label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 d-flex justify-content-start"><button
                                class="btn btn-custom-2 btn-primary" type="button" style="display:none">
                                <- Change Plan</button>
                        </div>
                        <div class="form-group col-md-6 d-flex justify-content-end">
                            <button class="btn btn-primary btn-custom" id="nextStepSaasy" type="button"
                                onclick="nextStep()">Continue<i style="margin-left:6px;"
                                    class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Step 2: Business Information -->
                <div class="form-step" id="step-2" style="display: none;">
                    <div class="text-center">
                        <a href="https://saasypos.com/" class="d-none d-md-block"> <img
                                src="<?php echo plugins_url('./assets/images/logo.png', __FILE__); ?>" alt="Phone Icon"
                                style="width: 180px; "></a>
                        <h2 class="d-none d-md-block" style="font-size:22px;  font-weight:700; color:#23DC32;">
                            30-Day Free
                            Trial
                        </h2>
                        <p class="paraclass">
                            Unlimited access to all features. No credit card required</p>
                    </div>
                    <h6 style="font-size:24px; font-weight:700; color:#32DC23; margin:0px; margin-bottom:5px">Business
                        Info</h6>
                    <p>Tell us about your business</p>
                    <div class="form-group">
                        <label for="business_name">Company Name:</label>
                        <input type="text" class="form-control required-asterisk" id="business_name"
                            name="business_name">
                        <!-- Add this div below the business name input field -->
                        <div id="business-name-error-message" class="error-div" style="color: red; font-size:13px;">
                        </div>
                    </div>

                    <!-- Hidden Div For storing the the value of bussiness divs -->
                    <div class="form-group" style='display: none;'>
                        <label for="business_phone">Business Phone:</label>
                        <input type="text" class="form-control required-asterisk" id="business_info_choice"
                            name="business_info_choice">
                    </div>

                    <!-- Add the three boxes for business information -->
                    <div class="form-group">
                        <label for="business_info_choice">Choose Business Information:</label>
                        <div class="d-flex justify-content-center">

                            <div class="Option1 choice col-4 col-md-4 d-flex flex-column text-center pt-3"
                                onclick="selectBusinessInfo('1623770609262')">
                                <h6 class="h6-mobile">Vapes/CBD</h6>
                                <p class="d-none d-md-block">My business belongs<br> to this category</p>
                            </div>
                            <div class="Option2 choice text-center col-4 col-md-4 pt-3"
                                onclick="selectBusinessInfo('1623770635155')">
                                <h6 class="h6-mobile">Thrift</h6>
                                <p class="d-none d-md-block">My business belongs <br> to this category</p>
                            </div>
                            <div class="Option3 choice text-center col-4 col-md-4 pt-3"
                                onclick="selectBusinessInfo('1623770624890')">
                                <h6 class="h6-mobile">General Retail</h6>
                                <p class="d-none d-md-block">My business belongs<br> to this category</p>
                            </div>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-6 d-flex justify-content-start"> <button
                                class="btn btn-custom-previous btn-primary" type="button" onclick="prevStep()"><i
                                    style="margin-right:6px;" class="fa-solid fa-arrow-left"></i>Back</button>
                        </div>
                        <div class="form-group col-6 d-flex justify-content-end">
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

//-----------------Ajax Handling Whole Form 1 Api-------------------------------

function custom_form_ajax_full_api()
{

// Enqueue the script
    wp_enqueue_script('custom-form-ajax-full-api', plugin_dir_url(__FILE__) . './assets/js/AjaxHandeling/AjaxScriptFormApi_1.js', array('jquery'), '1.0', true);

// Localize the script
    wp_localize_script('custom-form-ajax-full-api', 'customFormFullApi', array('ajaxurl' => admin_url('admin-ajax.php')));
}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_form_ajax_full_api');

add_action('wp_ajax_custom_form_ajax_full_form', 'custom_form_ajax_handler_full_form');
add_action('wp_ajax_nopriv_custom_form_ajax_full_form', 'custom_form_ajax_handler_full_form');

function custom_form_ajax_handler_full_form()
{

    $first_name = sanitize_text_field($_POST['firstName']);
    $last_name = sanitize_text_field($_POST['lastName']);
    $email = sanitize_text_field($_POST['email']);
    $phone_number = sanitize_text_field($_POST['phone']);
    $password = sanitize_text_field($_POST['password']);

    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "CreateBusinessUserV2";

// Make request to custom API for email validation
    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(

            "firstName" => $first_name,
            "lastName" => $last_name,
            "email" => $email,
            "confirmEmail" => $email,
            "password" => $password,
            "confirmPassword" => $password,
            "phone" => $phone_number,
            "doAgree" => true,
            "userExist" => false,

        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),
        'timeout' => 30,
    ));
    wp_send_json_success($api_response);

}

//Storing user id (data) in option table
function store_data_in_options_table()
{
    $data_inside_data = sanitize_text_field($_POST['dataInsideData']);

// Update the option in the WordPress options table
    update_option('saasy_user_id', $data_inside_data);

    // Store data in session
    $_SESSION['saasy_user_id'] = $data_inside_data;

    wp_die(); // This is required to terminate immediately and return a proper response
}

// Hook the handler to the corresponding action
add_action('wp_ajax_store_data_in_options_table', 'store_data_in_options_table');
add_action('wp_ajax_nopriv_store_data_in_options_table', 'store_data_in_options_table');

//Storing business id (data) in sessions
function store_business_data_in_options_table_handler()
{
    $data_inside_data = sanitize_text_field($_POST['dataInsideData']);

// Store data in session
    $_SESSION['saasy_user_bus_id'] = $data_inside_data;
    echo $data_inside_data;
    wp_die(); // This is required to terminate immediately and return a proper response
}

// Hook the handler to the corresponding action
add_action('wp_ajax_store_business_data_in_options_table', 'store_business_data_in_options_table_handler');
add_action('wp_ajax_nopriv_store_business_data_in_options_table', 'store_business_data_in_options_table_handler');

//Calling function for opt
//--------------------------------------------------------
function function_opt_handler()
{

    $BusinessId = $_SESSION['saasy_user_bus_id'];
    $UserId = $_SESSION['saasy_user_id'];

    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "SendOTP";

    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(
            'BusinessId' => $BusinessId,
            'UserId' => $UserId,
        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),

    ));
    wp_send_json_success($api_response);

}

// Hook the handler to the corresponding action
add_action('wp_ajax_function_opt', 'function_opt_handler');
add_action('wp_ajax_nopriv_function_opt', 'function_opt_handler');

// Calling for otp in email page
//--------------------------------------------------------
function function_opt_emailpage_handler()
{

    $BusinessId = $_SESSION['saasy_user_bus_id'];
    $UserId = $_SESSION['saasy_user_id'];

    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "SendOTP";

    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(
            'BusinessId' => $BusinessId,
            'UserId' => $UserId,
        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),

    ));
    wp_send_json_success($api_response);

}

// Hook the handler to the corresponding action
add_action('wp_ajax_function_opt_emailpage', 'function_opt_emailpage_handler');
add_action('wp_ajax_nopriv_function_opt_emailpage', 'function_opt__emailpage_handler');

function custom_form_ajax_email_otp_page()
{

// Enqueue the script
    wp_enqueue_script('ResendEmailOtp', plugin_dir_url(__FILE__) . './assets/js/AjaxHandeling/ResendEmailOtp.js', array('jquery'), '1.0', true);

// Localize the script
    wp_localize_script('ResendEmailOtp', 'ResendEmailOtp', array('ajaxurl' => admin_url('admin-ajax.php')));
}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_form_ajax_email_otp_page');

//--------------------------------------------------------

//Verifying Otp Function

add_action('wp_ajax_verify_otp', 'verify_otp_callback');
add_action('wp_ajax_nopriv_verify_otp', 'verify_otp_callback');

function verify_otp_callback()
{
    // Get the OTP from the AJAX request
    $otp = sanitize_text_field($_POST['otp']);
    $BusinessId = $_SESSION['saasy_user_bus_id'];
    $UserId = $_SESSION['saasy_user_id'];
    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "VerifyOTP";

    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(
            'BusinessId' => $BusinessId,
            'UserId' => $UserId,
            'Code' => $otp,
        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),

    ));
    wp_send_json_success($api_response);
}

function custom_form_ajax_email_otp_page_verify()
{

// Enqueue the script
    wp_enqueue_script('VerifyEmailOtp', plugin_dir_url(__FILE__) . './assets/js/AjaxHandeling/AjaxVerifyingOtp.js', array('jquery'), '1.0', true);

// Localize the script
    wp_localize_script('VerifyEmailOtp', 'VerifyEmailOtp', array('ajaxurl' => admin_url('admin-ajax.php')));
}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_form_ajax_email_otp_page_verify');

//Finish Api Call Function:

add_action('wp_ajax_after_verify_otp', 'after_verify_otp_callback');
add_action('wp_ajax_nopriv_after_verify_otp', 'after_verify_otp_callback');

function after_verify_otp_callback()
{

    $BusinessId = $_SESSION['saasy_user_bus_id'];
    $UserId = $_SESSION['saasy_user_id'];

    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "FinishSignUpProcess";

    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(
            "businessId" => $BusinessId,
            "NoOfLocations" => 1,
            "PerNoOfRegister" => 1,
            "NoOfRegisters" => 1,
            "userID" => $UserId,
            "SaveInfo" => false,
            "subscription" => array(
                "TransactionDetails" => null,
                "hardwarePkgId" => [],
                "IsFreeTrial" => true,
                "totalHardwarePkgCost" => 0,
                "planCost" => 0,
                "planId" => "162851695001",
                "totalCost" => 0,
                "subscriptionPlanPkg" => array(
                    array(
                        "packageId" => "162851695001",
                        "qty" => 1,
                        "pricePerPackage" => 0,
                        "subTotalCost" => 0,
                        "packageType" => 0,
                        "discountValue" => 0,
                        "taxValue" => 0,
                        "discountAmount" => 0,
                        "taxAmount" => 0,
                        "isDiscountPercent" => false,
                        "isTaxPercent" => false,
                        "totalPrice" => 0,
                    ),
                ),
                "WooCommercePlanPkg" => [],
                "DomainPlanPkg" => [],
                "hardwarePkg" => [],
                "TotalTaxAmount" => 0,
                "subTotalCost" => 0,
                "TotalDiscountAmount" => 0,
                "TotalTaxValue" => 0,
                "TotalDiscountValue" => 0,
                "IsTotalTaxPercente" => false,
                "IsTotalDiscountPercent" => false,
                "SubscribedFeatures" => []
            ),
            "CCCustomerProfile" => null
        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),

    ));
    wp_send_json_success($api_response);
}

//--------------------------------------------------------
//-----------------Ajax Handling Whole Form 2 Api-------------------------------

function custom_form_ajax_full_api_two()
{

// Enqueue the script
    wp_enqueue_script('custom-form-ajax-full2-api', plugin_dir_url(__FILE__) . './assets/js/AjaxHandeling/AjaxScriptFormApi_2.js', array('jquery'), '1.0', true);

// Localize the script
    wp_localize_script('custom-form-ajax-full2-api', 'customFormFull2Api', array('ajaxurl' => admin_url('admin-ajax.php'), 'verification_url' => esc_url(get_option('custom_settings')['email_verification_url'])));
}

// Hook the function to wp_enqueue_scripts action

add_action('wp_enqueue_scripts', 'custom_form_ajax_full_api_two');

add_action('wp_ajax_custom_form_ajax_full_form_two', 'custom_form_ajax_handler_full_form_two');
add_action('wp_ajax_nopriv_custom_form_ajax_full_form_two', 'custom_form_ajax_handler_full_form_two');

function custom_form_ajax_handler_full_form_two()
{

    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "CreateBusinessInfoV2";
    error_log('Received AJAX request:');
    error_log(print_r($_POST, true));

    $userID = get_option('saasy_user_id');
    $userIdSessions = $_SESSION['saasy_user_id'];
    $email = sanitize_text_field($_POST['email']);
    $phone_number = sanitize_text_field($_POST['phone']);
    $business_name = sanitize_text_field($_POST['business_name']);
    $business_info_choice = sanitize_text_field($_POST['business_info_choice']);

    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(

            "businessId" => 0,
            "userID" => $userIdSessions,
            "companyName" => $business_name,
            "businessName" => $business_name,
            "industryTypeId" => $business_info_choice,
            "phone" => $phone_number,
            "email" => $email,
            "address" => "abc123",
            "zip" => "54000",
            "city" => "houston",
            "state" => "AS",
            "selectedState" => null,
            "industry" => $business_info_choice,
            "contactEmail" => $email,

        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),
        'timeout' => 30,
    ));

// Log the API response
    error_log('API Response:');
    error_log(print_r($api_response, true));

    wp_send_json_success($api_response);

    // Decode the JSON string in the "body" property
    $body_data = json_decode($api_response['data']['body']);

    // Access the "data" field
    $result = $body_data->data;

    // Print or log the result
    echo $result;

}

//-----------------Ajax Handling First Form-------------------------------

add_action('wp_ajax_custom_form_ajax', 'custom_form_ajax_handler');
add_action('wp_ajax_nopriv_custom_form_ajax', 'custom_form_ajax_handler');

$options = get_option('custom_settings');
$save_data_to_db = isset($options['save_data_to_db']) ? $options['save_data_to_api'] : 0;

if ($save_data_to_db == 1) {
    function custom_form_ajax()
    {
// Enqueue the script
        //wp_enqueue_script('custom-form-ajax', plugin_dir_url(__FILE__) . 'AjaxScriptForm1.js', array('jquery'), '1.0', true);

// Localize the script
        wp_localize_script('custom-form-ajax', 'customForm', array('ajaxurl' => admin_url('admin-ajax.php')));
    }

// Hook the function to wp_enqueue_scripts action
    add_action('wp_enqueue_scripts', 'custom_form_ajax');

    function custom_form_ajax_handler()
    {
//check_ajax_referer('custom_form_nonce', 'security');

// Check if required fields are empty
        // if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['phone_number']) || empty($_POST['password'])) {
        //     echo 'error';
        //     wp_die();
        // }

// // Check if passwords match
// $password = sanitize_text_field($_POST['password']);
// $confirm_password = sanitize_text_field($_POST['confirm_password']);

// if ($password !== $confirm_password) {
//     echo 'password_mismatch';
//     wp_die();
// }

        if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
            global $wpdb;

            $table_name = $wpdb->prefix . 'custom_registration_data';

            $first_name = sanitize_text_field($_POST['first_name']);
            $last_name = sanitize_text_field($_POST['last_name']);
            $email = sanitize_text_field($_POST['email']);
            $phone_number = sanitize_text_field($_POST['phone_number']);
            $password = sanitize_text_field($_POST['password']);
            $terms_and_conditions = isset($_POST['terms_and_conditions']) ? 1 : 0;

            $wpdb->insert(
                $table_name,
                array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'phone_number' => $phone_number,
                    'password' => $password,
                    'terms_and_conditions' => $terms_and_conditions,
                )
            );
            if (!session_id()) {
                session_start();
            }
            $_SESSION['user_email'] = $email;
            echo 'success';
        }

        wp_die();
    }
}

//-----------------Ajax Handling Second Form-------------------------------

add_action('wp_ajax_custom_2form_ajax', 'custom_2form_ajax_handler');
add_action('wp_ajax_nopriv_custom_2form_ajax', 'custom_2form_ajax_handler');

$options = get_option('custom_settings');
$save_data_to_db = isset($options['save_data_to_db']) ? $options['save_data_to_api'] : 0;

if ($save_data_to_db == 1) {
    function custom_2form_ajax_handler()
    {

// Check if required fields are empty
        if (empty($_POST['business_name']) || empty($_POST['business_info_choice'])) {
            echo 'error';
            wp_die();
        }

        if (isset($_POST['business_name']) && isset($_POST['business_info_choice'])) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'custom_registration_data';
            $business_name = sanitize_text_field($_POST['business_name']);
            $business_info_choice = sanitize_text_field($_POST['business_info_choice']);
            $email = get_option('user_email');

            if (!session_id()) {
                session_start();
            }

// Check if the email is stored in the session
            if (isset($_SESSION['user_email'])) {
                $user_email = $_SESSION['user_email'];
            }

            $wpdb->update(
                $table_name,
                array(
                    'business_name' => $business_name,
                    'business_info_choice' => $business_info_choice,
                ),
                array('email' => $user_email)
            );

            echo 'success';
        }
        wp_die();
    }

    function custom_2form_ajax()
    {
// Enqueue the script
        // wp_enqueue_script('custom-2form-ajax', plugin_dir_url(__FILE__) . 'AjaxScriptForm2.js', array('jquery'), '1.0', true);

// Localize the script
        wp_localize_script('custom-2form-ajax', 'custom2Form', array('ajaxurl' => admin_url('admin-ajax.php')));
    }

// Hook the function to wp_enqueue_scripts action
    add_action('wp_enqueue_scripts', 'custom_2form_ajax');

}

//-----------------Ajax Handling Email Field With Api-------------------------------

function custom_email_validation_ajax_handler()
{

    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "IsUserExist";
// check_ajax_referer('custom_form_nonce', 'security');

    if (isset($_POST['email'])) {
        $email = sanitize_text_field($_POST['email']);

// Make request to custom API for email validation
        $api_response = wp_remote_post($full, array(
            'body' => json_encode(array('Username' => $email)),
            'headers' => array('Content-Type' => 'application/json',
                'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
            ),
        ));

        if (is_wp_error($api_response)) {
// Handle error, e.g., log or display an error message
// echo $api_response;
            echo "error";
        } else {
            $api_data = json_decode(wp_remote_retrieve_body($api_response));
// echo $api_data;
            echo json_encode($api_data->data);

            if ($api_data->data) {
// Email exists, send response to the client
//  echo 'exists';
            } else {
// Email is unique, send response to the client
//  echo 'unique';
            }

        }
    }

    wp_die();
}

// Hook the email validation function to AJAX action
add_action('wp_ajax_custom_email_validation_ajax', 'custom_email_validation_ajax_handler');
add_action('wp_ajax_nopriv_custom_email_validation_ajax', 'custom_email_validation_ajax_handler');

function custom_email_form_ajax()
{
// Enqueue the script
    wp_enqueue_script('custom-email-form-ajax', plugin_dir_url(__FILE__) . './assets/js/AjaxHandeling/AjaxEmailApi.js', array('jquery'), '1.0', true);

// Localize the script
    wp_localize_script('custom-email-form-ajax', 'customEmailForm', array('ajaxurl' => admin_url('admin-ajax.php')));
}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_email_form_ajax');

//----------------- Ajax Handling Business Name Field With Api -------------------------------

function custom_business_name_validation_ajax_handler()
{
    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "IsCompanyExist";
// check_ajax_referer('custom_form_nonce', 'security');

    if (isset($_POST['business_name'])) {
        $businessName = sanitize_text_field($_POST['business_name']);

// Make request to custom API for business name validation
        $api_response = wp_remote_post($full, array(
            'body' => json_encode(array('CompanyName' => $businessName)),
            'headers' => array('Content-Type' => 'application/json',
                'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E'),
        ));

        if (is_wp_error($api_response)) {
// Handle error, e.g., log or display an error message
            echo 'error';
        } else {
            $api_data = json_decode(wp_remote_retrieve_body($api_response));
            echo json_encode($api_data->data);
            if ($api_data->exists) {
// Business name exists, send response to the client
// echo 'exists';
            } else {
// Business name is unique, send response to the client
// echo 'unique';
            }
        }
    }

    wp_die();
}

// Hook the business name validation function to AJAX action
add_action('wp_ajax_custom_business_name_validation_ajax', 'custom_business_name_validation_ajax_handler');
add_action('wp_ajax_nopriv_custom_business_name_validation_ajax', 'custom_business_name_validation_ajax_handler');

function custom_business_form_ajax()
{
// Enqueue the script
    wp_enqueue_script('custom-business-form-ajax', plugin_dir_url(__FILE__) . './assets/js/AjaxHandeling/AjaxBusinessApi.js', array('jquery'), '1.0', true);

// Localize the script
    wp_localize_script('custom-business-form-ajax', 'customBusinessForm', array('ajaxurl' => admin_url('admin-ajax.php')));
}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_business_form_ajax');

// Handler for Ajax to set the boolean value to true for local wp custom plugin table attribut verification_status

// Hook the business name validation function to AJAX action
add_action('wp_ajax_function_local_verification_status', 'function_local_verification_status_handler');
add_action('wp_ajax_nopriv_function_local_verification_status', 'function_local_verification_status_handler');
function function_local_verification_status_handler()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';
// Check if the email is stored in the session
    if (isset($_SESSION['user_email'])) {
        $user_email = $_SESSION['user_email'];
    }

    $wpdb->update(
        $table_name,
        array(
            'verification_status' => true,
        ),
        array('email' => $user_email)
    );

    echo 'success';
    wp_die();
}

?>