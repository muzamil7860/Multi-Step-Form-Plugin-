<?php

function custom_email_form_shortcode()
{
    if (!session_id()) {
        session_start();
    }

    if (!isset($_SESSION['user_email'])) {
        exit;
    }

    print_r($_SESSION);
    print_r("---------------");

    if (isset($_SESSION['user_email'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'custom_registration_data';
        $email = $_SESSION['user_email'];
        $existing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
        print_r($existing_row);
    }

    if (empty($existing_row['business_id']) ||
        empty($existing_row['saasy_user_id']) ||
        empty($existing_row['business_name']) ||
        empty($existing_row['business_info_choice'])) {
        exit;
    }

    // Check if the email is stored in the session
    if (isset($_SESSION['user_email'])) {
        $user_email = $_SESSION['user_email'];
    }
    ob_start();

    ?>

<div class="conatiner-fluid loader" style="display:none">
    <div class="ngx-spinner-overlay">
        <div class="la-square-jelly-box">
            <div></div>
            <div></div>
        </div>
        <div class="loading-text">
            <p style="font-size:14px;">Please wait while Loading...</p>
        </div>
    </div>
</div>

<div class="container-fluid main-container" style="background-color:#F2F8FC;">
    <div class="row d-flex justify-content-center pt-5 pb-5" style="gap:20px">

        <div class="col-11 col-md-9  columns-class-email pb-3 pt-3 px-3 px-md-5">
            <div class="text-center">
                <a href="https://saasypos.com/"> <img src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>"
                        alt="Phone Icon" style="width: 180px; "></a>
                <h2 class="heading_02" style="font-size:24px;  font-weight:700; color:#23DC32; margin-bottom:4px;">
                    30-Day Free
                    Trial
                </h2>
                <p class="paraclass paraClassCustom">
                    Unlimited access to all features. No credit card required</p>
            </div>
            <div class="text-center d-flex flex-column align-items-center justify-content-center inner-div-email-fir ">
                <div class="inner-div-email">
                    <h6 class="heading_06"
                        style="font-size:18px; font-weight:700; color:black; margin:0px; margin-bottom:5px">Verify
                        Your Email Address</h6>
                    <p class="paraClassCustom mt-3 mb-3">We have sent an account verification email on <span
                            style="color:#23DC32; font-weight:500;">
                            <?php echo $user_email; ?>
                        </span>
                        to verify your email
                        and activate your account.<br>If you
                        don’t see it, please check your spam/junk folder. </p>
                </div>
                <div class="hidData d-flex flex-column align-items-center">

                    <p class="paraClassCustom hidPara"> Didn t receive the verification code? <button
                            class="btn btn-customm btn-primary" id="resendEmail">Resend Code</button> </p>
                    <!-- Add OTP input field -->
                    <input style="width:200px; margin-top:10px; margin-bottom:10px;" type="tel" id="otp" name="otp"
                        class="hidInput form-control text-center" placeholder="Enter your OTP" required>
                    <!-- Error div for displaying OTP validation error -->
                    <div id="otpError" style="color: red; font-size:14px;"></div>
                    <button class="hidButton btn btn-custom btn-primary" style="margin-top:5px;" id="verifyOtp">Verify
                        OTP</button>

                    <a href="https://preapp.saasypos.com/#/pages/signin"><button
                            class="showButton btn btn-custom btn-primary" id="verifyOtp" style="display:none;">Login To
                            Dashboard</button></a>

                </div>
            </div>
        </div>
    </div>
</div>




<?php
return ob_get_clean();
}

add_shortcode('custom_email_form', 'custom_email_form_shortcode');

?>