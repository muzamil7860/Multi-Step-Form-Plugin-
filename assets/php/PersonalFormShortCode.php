<?php

//Starting the session
add_action('init', function () {
    if (!session_id()) {
        session_start();
    }
});

function custom_registration_form_shortcode()
{
    $options = get_option('custom_settings');
    $save_redirect_url = $options['email_verification_url'];

    ob_start();
    ?>

<div class="conatiner-fluid loader"  >
    <div class="ngx-spinner-overlay">
        <div class="la-square-jelly-box">
            <div></div>
            <div></div>
        </div>
        <div class="loading-text">
            <p>Please wait while we are loading...</p>
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
                <a href="https://saasypos.com/"> <img src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>"
                        alt="Phone Icon" style="width: 180px; "></a>
                <h2 class="heading_02" style="font-size:22px;  font-weight:700; color:#23DC32;">
                    30-Day Free
                    Trial
                </h2>
                <p class="paraclass paraClassCustom">
                    No credit card required</p>
            </div>
            <!-- ////////////// -->
            <div class="hello d-flex flex-row flex-md-column" style="gap:10px">
                <div class="gappingClass d-flex flex-column flex-md-row mt-md-4 mb-md-3 col-4 col-md-12 align-items-center align-items-md-start"
                    style="padding:0px">
                    <div class="settingwidthGreen d-flex align-items-center justify-content-center theOne" id="theOne"
                        style="height:45px; z-index:1; background-color:#23DC32; border-radius:5px; color:white;">
                        <i id="firstClass" style="font-size:14px;" class="fa-solid fa-1"></i>
                    </div>
                    <div class="uper_margin_mobile">
                        <h6 class="heading_06 heading" style="color:#23DC32; margin:0px;">Personal
                            Info</h6>
                        <p class="paraclass paraClassCustom first-col-para" style="margin-top:5px;">Tell us about
                            yourself to set up a secure
                            account for you.
                        </p>
                    </div>
                </div>

                <div class="gappingClass d-flex mb-3 flex-column flex-md-row col-4 col-md-12 align-items-center align-items-md-start"
                    style="padding:0px">
                    <div class="settingwidthGreen secondClass d-flex align-items-center justify-content-center theTwo"
                        style="height:45px; z-index:1; background-color:#DEF1FD; border-radius:5px; color:#9E9E9E">
                        <i id="secondClass" style="font-size:16px;" class="fa-solid fa-2"></i>
                    </div>
                    <div class="uper_margin_mobile">
                        <h6 class="heading_06 heading" style="margin:0px; margin-bottom:5px">Business Info</h6>
                        <p class="paraClassCustom first-col-para">Tell us about your business for a personalized
                            experience.
                        </p>
                    </div>
                </div>



                <div class="gappingClass d-flex flex-column flex-md-row col-4 col-md-12 align-items-center align-items-md-start"
                    style="padding:0px;">
                    <div class="settingwidthGreen d-flex align-items-center justify-content-center theThree"
                        style="height:45px; z-index:1; background-color:#DEF1FD; border-radius:5px; color:#9E9E9E">
                        <i id=thirdClass style="color:#23DC32; font-size:16px;" class="fa-solid fa-3"></i>
                    </div>
                    <div class="uper_margin_mobile mb-md-3">
                        <h6 class="heading_06 heading" style="margin:0px; margin-bottom:5px">Verification</h6>
                        <p class="paraClassCustom first-col-para">Account verification with your email.</p>
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
                                src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>" alt="Phone Icon"
                                style="width: 180px; "></a>
                        <h2 class="heading_02 d-none d-md-block"
                            style="font-size:22px;  font-weight:700; color:#23DC32;">
                            30-Day Free
                            Trial
                        </h2>
                        <p class="paraClassCustom paraclass d-none d-md-block">
                            No credit card required</p>
                    </div>
                    <div class="pt-2 pt-md-3">
                        <h4 class="heading_04" style="color:#23DC32; margin-bottom:4px;">Personal Info
                        </h4>
                        <p class="paraClassCustom">Tell us about yourself to set up a secure account for you.</p>
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
                            <div id="tempClass" style="display:none;">
                                <div class="d-flex flex-row justify-content-between">
                                    <div id="email-error-message" class="error-div"
                                        style="color: red; font-size:13px; line-height:20px; flex-grow: 1;">
                                    </div>
                                    <a class="small-buttons-yes" id="continueProcessButtonClose" type="button">No
                                    </a>
                                    <a class="small-buttons-no" id="continueProcessButton" type="button">Yes
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phone_number">Phone Number <span class="required-asterisk">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border:none ; background-color:#EFF2F5;">
                                        <img src="<?php echo plugins_url('../images/AmericanFlag.png', __FILE__); ?>"
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
                                    <i style="color:#23DC32;" id="aa" class="fas fa-eye"></i>
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
                                <div style="font-size:13px; margin-top:3px; margin-bottom:3px; "
                                    id="password-strength-label" class="password-strength-label">Very Weak</div>
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
                                    <i style="color:#23DC32;" id="bb" class="fas fa-eye"></i>
                                </span>
                            </div>
                            <!--div below the password input field -->
                            <div id="password-error-message" class="error-div-password"
                                style="color: red; font-size:13px; position:relative;bottom:20px;"></div>
                        </div>
                    </div>
                    <div class="form-row" style="padding-left:25px; margin-top:-20px; margin-bottom:20px;">
                        <div class="form-check d-flex align-items-md-start col-lg-9">
                            <input type="checkbox" class="form-check-input required-asterisk" id="terms_and_conditions"
                                name="terms_and_conditions" required>
                            <label style="margin-left:10px;font-size:13px;line-height:20px; color: #777777;"
                                class="form-check-label" for="terms_and_conditions">By checking this box you
                                agree to SaasyPOS’s <a href="https://saasypos.com/terms-of-service/"
                                    target="_blank"><span style="color:#23DC32;font-weight:500;">Terms of
                                        Service</span></a> and
                                acknowledge <a href="https://saasypos.com/privacy-policy/" target="_blank"><span
                                        style="color:#23DC32; font-weight:500;">Privacy Policy.</span></a><br></label>
                        </div>
                        <div
                            class="form-group form-group-custom col-lg-3 d-flex justify-content-end align-items-center">
                            <button class="spacing-btn btn btn-primary btn-custom" id="nextStepSaasy" type="button"
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
                                src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>" alt="Phone Icon"
                                style="width: 180px; "></a>
                        <h2 class="heading_02 d-none d-md-block"
                            style="font-size:22px;  font-weight:700; color:#23DC32;">
                            30-Day Free
                            Trial
                        </h2>
                        <p class="paraclass paraClassCustom d-none d-md-block">
                           No credit card required</p>
                    </div>
                    <h4 class="heading_04" style=" font-weight:700; color:#23DC32; margin:0px; margin-bottom:5px">
                        Business
                        Info</h4>
                    <p class="paraClassCustom">Tell us about your business for a personalized experience.</p>
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
                                onclick="selectBusinessInfoTest('1623770609262')">
                                <h6 class="heading_06 h6-mobile">Vapes/CBD</h6>
                                <p class="paraClassCustom d-none d-md-block">My business belongs<br> to this category
                                </p>
                            </div>
                            <div class="Option2 choice text-center col-4 col-md-4 pt-3"
                                onclick="selectBusinessInfoTest('1623770635155')">
                                <h6 class="heading_06 h6-mobile">Thrift</h6>
                                <p class="paraClassCustom d-none d-md-block">My business belongs <br> to this category
                                </p>
                            </div>
                            <div class="Option3 choice text-center col-4 col-md-4 pt-3"
                                onclick="selectBusinessInfoTest('1623770624890')">
                                <h6 class="heading_06 h6-mobile">General Retail</h6>
                                <p class="paraClassCustom d-none d-md-block">My business belongs<br> to this category
                                </p>
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


<div class="container-fluid main-container main-container-email" style="background-color:#F2F8FC; display:none;">
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
                    No credit card required</p>
            </div>
            <div class="text-center d-flex flex-column align-items-center justify-content-center inner-div-email-fir ">
                <div class="inner-div-email">
                    <h6 class="heading_06"
                        style="font-size:18px; font-weight:700; color:black; margin:0px; margin-bottom:5px">Verify
                        Your Email Address</h6>
                    <p class="paraClassCustom mt-3 mb-3">We have sent an account verification email on <span
                            class="putEmail" style="color:#23DC32; font-weight:500;">
                        </span>
                        to verify your email
                        and activate your account.<br>If you
                        don't see it, please check your spam/junk folder. </p>
                </div>
                <div class="hidData d-flex flex-column align-items-center">

                    <p class="paraClassCustom hidPara"> Didn't receive the verification code? <button
                            class="btn btn-customm btn-primary" id="resendEmail">Resend Code</button> </p>
                    <!-- Add OTP input field -->
                    <input style="width:200px; margin-top:10px; margin-bottom:10px;" type="tel" id="otp" name="otp"
                        class="hidInput form-control text-center" placeholder="Enter your OTP" required>
                    <!-- Error div for displaying OTP validation error -->
                    <div id="otpError" style="color: red; font-size:14px;"></div>
                    <button class="hidButton btn btn-custom btn-primary" style="margin-top:5px;" id="verifyOtp">Verify
                        OTP</button>

                    <!-- <a href="https://preapp.saasypos.com/#/pages/signin"><button -->
                    <a href="<?php echo $save_redirect_url ?>"><button class="showButton btn btn-custom btn-primary"
                            id="verifyOtp" style="display:none;">Login To
                            Dashboard</button></a>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
return ob_get_clean();
}

add_shortcode('custom_registration_form', 'custom_registration_form_shortcode');

?>