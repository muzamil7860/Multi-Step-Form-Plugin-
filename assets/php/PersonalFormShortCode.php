<?php

//Starting the session
add_action('init', function () {
    if (!session_id()) {
        session_start();
    }
});

function custom_registration_form_shortcode()
{

    //colors through variables
    //   $personalInfoColor = '#23DC32'; // Green color
    $personalInfoColor = '#1429EF'; // Green color
    $BackgroundColor = '#DEF1FD'; // Light blue color
    $options = get_option('custom_settings');
    $save_redirect_url = $options['email_verification_url'];
    // print_r($_SESSION);
    ob_start();
    ?>

<div class="monster" id="monsterDiv" style="display:none">
    <button class="close-button" style="display:none;">
        <img src="http://lincsell.com/wp-content/uploads/2024/01/crooos-sign.svg" alt="Close" />
    </button>
    <!-- /////////////////////////////////////////////	 -->
    <div class="loader" style="display:none">
        <div class="ngx-spinner-overlay">
            <div class="col-12 d-flex align-items-center justify-content-center flex-column">
                <img style="width:150px !important;" decoding="async"
                    src="https://lincsell.com/wp-content/uploads/2024/01/LincSell-Icon-2-2.gif" data-no-lazy="1"
                    alt="logo">
                <p class="plugin_para_load" style="color:white">Please wait ...</p>
            </div>



        </div>
    </div>

    <div class="loaderError" style="display:none">
        <div class="ngx-spinner-overlay">
            <div class="col-12 d-flex align-items-center justify-content-center flex-column">
                <img style="width:150px !important;" decoding="async"
                    src="https://lincsell.com/wp-content/uploads/2024/01/LincSell-Icon-2-2.gif" data-no-lazy="1"
                    alt="logo">
                <p class="plugin_para_load" style="color:white">Try Again By Refreshing The Page ...</p>
            </div>



        </div>
    </div>
    <style>
    .plugin_para_load {
        position: relative;
        bottom: 40px;
    }

    .ngx-spinner-overlay {
        background-color: rgba(0, 0, 0, 0.9);
        z-index: 99999;
        position: fixed;
        opacity: 1;
        width: 100%;
        height: 100%;
        display: flex !important;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    </style>
    <!-- ////////////////////////////////////////////// 	 -->
    <div class="firstStep" style="display:none">
        <div class="container-fluid main-container1 fluid-spinner-container justify-content-center align-items-center"
            style="display:flex">
            <style>
            .close-button {
                position: fixed;
                top: 10px;
                right: -20px;
                background-color: transparent !important;
                border: none;
                font-size: 40px;
                cursor: pointer;
                color: white;
                outline: none;
                z-index: 999999;
            }

            .close-button span {
                font-weight: bold;
            }
            </style>

            <div class="col-12 col-lg-9 d-flex flex-column flex-md-row justify-content-center align-items-center align-items-md-start"
                style="gap:20px;">
                <div class="col-12 col-12-pL columns-class  d-flex align-items-center justify-content-center"
                    style="padding-top:10px;">
                    <form class="col-12" id="custom-registration-form"
                        action="http://localhost/familythriftcenter/email-verification/" method="post">
                        <!-- Step 1: Personal Information -->
                        <div class="col-12 form-step form-mob-div" id="step-1">
                            <div class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="#"> <img src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>"
                                            alt="Phone Icon" style="width: 180px; "></a>
                                </div>

                                <p class="plugin_para paraClassCustom paraclass">
                                    Start Your 30-Day Free Trial Now!</p>
                            </div>

                            <div class="form-row form-above-spacing">
                                <div class="form-group col-md-6 padding-right">
                                    <label class="label_plug" for="first_name">First Name </label>
                                    <input type="text" class="form-control border-radius border-class" id="first_name"
                                        name="first_name" required autofocus>
                                    <!-- Add this div below the Name input field -->
                                    <div id="name-error-message" class="error-div" style="color: red; font-size:13px;">
                                    </div>
                                </div>

                                <div class="form-group col-md-6 padding-left">
                                    <label class="label_plug" for="last_name">Last Name</label>
                                    <input type="text" class="form-control border-radius border-class" id="last_name"
                                        name="last_name" required>
                                    <!-- Add this div below the Last Name input field -->
                                    <div id="lastNameError" class="error-div" style="color: red; font-size:13px;"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 padding-right">
                                    <label class="label_plug" for="email">Email <span
                                            class="required-asterisk">*</span></label>
                                    <input type="email" class="form-control border-radius border-class" id="email"
                                        name="email" required>
                                    <!--div below the email input field -->
                                    <div id="tempClass" style="display:none;">
                                        <div class="d-flex flex-row justify-content-between">
                                            <div id="email-error-message" class="error-div"
                                                style="color: red; font-size:13px; flex-grow: 1;">
                                            </div>
                                            <a class="small-buttons-yes" id="continueProcessButtonClose"
                                                type="button">No
                                            </a>
                                            <a class="small-buttons-no" id="continueProcessButton" type="button">Yes
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 padding-left">
                                    <label class="label_plug" for="phone_number">Phone<span
                                            class="required-asterisk">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend" style="margin-right:-10px;">
                                            <span class="input-group-text"
                                                style="border:none ; border-radius: 10px 0px 0px 10px; background-color:#EFF2F5;">
                                                <img src="<?php echo plugins_url('../images/AmericanFlag.png', __FILE__); ?>"
                                                    alt="Phone Icon" style="width: 20px; height: 20px;">

                                            </span>
                                        </div>
                                        <input type="tel" class="form-control border-radius" id="phone_number"
                                            name="phone_number" placeholder="xxx-xxx-xxxx" required>
                                    </div>
                                    <!-- Add this div below the Name input field -->
                                    <div id="phone-error-message" class="error-div" style="color: red; font-size:13px;">
                                    </div>

                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group form-group-password col-md-12 password-row">
                                    <label class="label_plug" for="password">Password </label>
                                    <input type="password" class="form-control border-radius border-class" id="password"
                                        name="password" required onclick="showPasswordStrengthMeter()">
                                    <div class="input-group-append d-flex justify-content-end">
                                        <span class="input-group-text password-toggle alpha"
                                            onclick="togglePasswordVisibility('password')">
                                            <i style="color:<?php echo $personalInfoColor; ?>;" id="aa"
                                                class="fas fa-eye"></i>
                                        </span>
                                    </div>

                                    <div id="password-feedback" class="error-div-password password-feedback-width"
                                        style="font-size: 13px; margin-top:-22px; line-height:20px">
                                    </div>

                                    <div class="password-strength" style="margin-top:-5px; display:none;">
                                        <div id="password-strength-meter" class="progress1 d-none">
                                            <div class="progress-bar" role="progressbar" style="width: 0;"></div>
                                        </div>
                                        <div style="font-size:13px; margin-top:-22px; margin-bottom:3px; "
                                            id="password-strength-label" class="password-strength-label d-none">Very
                                            Weak
                                        </div>
                                    </div>
                                    <!-- ///////////// -->
                                </div>
                                <div class="form-group col-md-6 d-none">
                                    <label for="confirm_password">Confirm Password <span
                                            class="required-asterisk">*</span></label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password" required>
                                    <div class="input-group-append d-flex justify-content-end">
                                        <span class="input-group-text password-toggle alpha"
                                            onclick="togglePasswordVisibility('confirm_password')">
                                            <i style="color:<?php echo $personalInfoColor; ?>;" id="bb"
                                                class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    <!-- div below the password input field -->
                                    <div id="password-error-message" class="col-6 error-div-password"
                                        style="color: red; font-size:13px; position:relative;bottom:20px;"></div>
                                </div>



                            </div>
                            <div class="form-group businessDiv">
                                <label class="label_plug" for="business_name">Business Name<span
                                        class="required-asterisk">
                                        *</span></label>
                                <input type="text" class="form-control border-radius border-class" id="business_name"
                                    name="business_name">
                                <!-- Add this div below the business name input field -->
                                <div id="business-name-error-message" class="error-div"
                                    style="color: red; font-size:13px;">
                                </div>
                            </div>
                            <div class="form-row d-flex justify-content-center align-items-center"
                                style="margin-top:-20px; margin-bottom:20px;">

                                <div
                                    class="col-12 col-md-6 form-group form-group-custom d-flex justify-content-center align-items-center">
                                    <button class="spacing-btn btn btn-primary btn-custom" id="nextStepSaasy"
                                        type="button" onclick="nextStep()">Create My Free Account
                                    </button>
                                </div>
                            </div>
                            <div class="form-row d-flex justify-content-center align-items-center"
                                style="margin-top:-20px; margin-bottom:20px;">
                                <div
                                    class="col-10 col-md-5 justify-content-center form-check d-flex align-items-md-center">
                                    <input type="checkbox" class="form-check-input required-asterisk d-none"
                                        id="terms_and_conditions" name="terms_and_conditions" required>
                                    <label class="label_plug text-center"
                                        style="margin-top:4px;font-size:13px;line-height:20px; color: #b3b0b0;"
                                        class="form-check-label text-center" for="terms_and_conditions">By clicking
                                        "Create
                                        my
                                        account", you
                                        agree to our <a href="https://lincsell.com/terms-of-service/"
                                            target="_blank"><span style="color:white; font-weight:500;">Terms of
                                                Service</span></a> and <a href="https://lincsell.com/privacy-policy/"
                                            target="_blank"><span style="color:white; font-weight:500;">Privacy
                                                Policy.</span></a><br></label>
                                </div>
                            </div>




                        </div>

                        <!-- Step 2: Business Information -->
                        <div class="form-step" id="step-2" style="display:none;">

                            <div class="text-center">
                                <a href="https://lincsell.com/" class="d-none d-md-block"> <img
                                        src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>"
                                        alt="Phone Icon" style="width: 180px; "></a>
                                <h2 class="heading_02 d-none d-md-block"
                                    style="font-size:22px;  font-weight:700; color:<?php echo $personalInfoColor; ?>;">
                                    30-Day Free
                                    Trial
                                </h2>
                                <p class="paraclass paraClassCustom d-none d-md-block">
                                    Unlimited access to all features. No credit card required</p>
                            </div>
                            <h4 class="heading_04"
                                style=" font-weight:700; color:<?php echo $personalInfoColor; ?>; margin:0px; margin-bottom:5px">
                                Business
                                Info</h4>
                            <p class="paraClassCustom">Tell us about your business for a personalized experience.</p>
                            <div class="form-group">
                                <label for="business_name">Company Name:</label>
                                <input type="text" class="form-control" id="business_name" name="business_name">
                                <!-- Add this div below the business name input field -->
                                <div id="business-name-error-message" class="error-div"
                                    style="color: red; font-size:13px;">
                                </div>
                            </div>

                            <!-- Hidden Div For storing the the value of bussiness divs -->
                            <div class="form-group" style='display: none;'>
                                <label for="business_phone">Business Phone:</label>
                                <input type="text" class="form-control" id="business_info_choice"
                                    name="business_info_choice">
                            </div>

                            <!-- Add the three boxes for business information -->
                            <div class="form-group">
                                <label for="business_info_choice">Choose Business Information:</label>
                                <div class="d-flex justify-content-center">

                                    <div class="Option1 choice col-4 col-md-4 d-flex flex-column text-center pt-3"
                                        onclick="selectBusinessInfoTest('1623770609262')">
                                        <h6 class="heading_06 h6-mobile">Vapes/CBD</h6>
                                        <p class="paraClassCustom d-none d-md-block">My business belongs<br> to this
                                            category
                                        </p>
                                    </div>
                                    <div class="Option2 choice text-center col-4 col-md-4 pt-3"
                                        onclick="selectBusinessInfoTest('1623770635155')">
                                        <h6 class="heading_06 h6-mobile">Thrift</h6>
                                        <p class="paraClassCustom d-none d-md-block">My business belongs <br> to this
                                            category
                                        </p>
                                    </div>
                                    <div class="Option3 choice text-center col-4 col-md-4 pt-3"
                                        onclick="selectBusinessInfoTest('1623770624890')">
                                        <h6 class="heading_06 h6-mobile">General Retail</h6>
                                        <p class="paraClassCustom d-none d-md-block">My business belongs<br> to this
                                            category
                                        </p>
                                    </div>
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-6 d-flex justify-content-start"> <button
                                        class="btn btn-custom-previous btn-primary" type="button"
                                        onclick="prevStep()"><i style="margin-right:6px;"
                                            class="fa-solid fa-arrow-left"></i>Back</button>
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
    </div>

    <div class="container-fluid main-container main-container-email justify-content-center align-items-center "
        style="display:none;">
        <div class="d-flex justify-content-center pt-5 pb-5" style="gap:20px">

            <div class="col-11 col-md-11  columns-class-email pb-3 pt-3 px-3 px-md-3">
                <div class="d-flex flex-column align-items-center">
                    <a href="https://lincsell.com/"> <img
                            src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>" alt="Phone Icon"
                            style="width: 180px; "></a>

                    <p class="plugin_para paraclass paraClassCustom" style="font-family: 'Mona Bold', Sans-serif



                        !important;">
                        Verify Your Account!</p>
                </div>
                <div
                    class="text-center d-flex flex-column align-items-center justify-content-center inner-div-email-fir ">
                    <div class="inner-div-email">
                        <h6 class="heading_06"
                            style="font-size:18px; font-weight:700; color:black; margin:0px; margin-bottom:5px">
                            Verify
                            Your Email Address</h6>
                        <p class="plugin_para paraClassCustom mt-3 mb-3">Check your inbox!<br>
                            We've sent a 6-digit verification code to <b><span class="putEmail" style="color:white;">
                                </span></b><br>If you don't receive it within a few minutes, please check your spam or
                            junk
                            folder.
                        </p>
                    </div>
                    <div class="mt-2 mb-3">
                        <p class="plugin_para paraClassCustom hidPara" style="margin-bottom:0px;">Enter Verification
                            Code Here</p>

                    </div>
                    <div class="hidData d-flex flex-column align-items-center">

                        <!-- Add OTP input field -->
                        <!-- <input style="width:200px; margin-top:10px; margin-bottom:10px;" type="tel" id="otp" name="otp"
                            class="hidInput form-control text-center" placeholder="Enter your OTP" required> -->
                        <!-- -------------------------- -->
                        <div id="otpContainer">
                            <input type="text" id="otpBoxFirst" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
                            <input type="text" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
                            <input type="text" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
                            <input type="text" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
                            <input type="text" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
                            <input type="text" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
                        </div>


                        <!-- -------------------------- -->
                        <!-- Error div for displaying OTP validation error -->
                        <div id="otpError" style="color: red; font-size:14px;"></div>

                        <button class="hidButton btn btn-custom btn-cus btn-primary" style="margin-top:25px;"
                            id="verifyOtp">Verify My Account</button>
                        <button onclick="changeEmail()" class="hidButton btn btn-custom btn-cus btn-primary d-none"
                            style="margin-top:5px;" id="verifyOtp">ChangeEmail</button>

                        <a href="<?php echo $save_redirect_url ?>"><button
                                class="showButton btn btn-custom btn-cus btn-primary" id="verifyOtp"
                                style="display:none">Login To
                                Dashboard</button></a>
                        <div class="mt-5">
                            <p class="plugin_para paraClassCustom hidPara" style="margin-bottom:0px;"> Didn't receive
                                the
                                verification code?</p>
                            <button class="btn btn-customm btn-primary" id="resendEmail">Resend Code</button>
                            <div> <span id="countdownAlpha"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- --------------------------------------After success -->

    <div class="container-fluid main-container main-container-after-email justify-content-center align-items-center "
        style="display:none;">
        <div class="d-flex justify-content-center pb-3" style="gap:20px">

            <div class="col-11 col-md-11  columns-class-email pb-3 pt-3 px-0 px-md-3">
                <div class="d-flex flex-column align-items-center">
                    <a href="https://lincsell.com/"> <img
                            src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>" alt="Phone Icon"
                            style="width: 180px; "></a>

                    <div class="mt-3 mb-3"><img src="http://lincsell.com/wp-content/uploads/2024/01/Check-mark.gif"
                            style="width:80px;" alt="Phone Icon">
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center justify-content-center inner-div-email-fir ">
                    <div class="inner-div-email">
                        <h6 class="heading_06"
                            style="font-size:18px; font-weight:700; color:white; margin:0px; margin-top:5px; margin-bottom:3px">
                            Welcome Aboard!</h6>
                        <p class="paraClassCustom mt-3 mb-3"></p>
                    </div>
                    <div class="col-12 mb-3">
                        <p class="plugin_para paraClassCustom paraClassCustombeta hidPara text-center"
                            style="margin-bottom:0px; margin-top:0px;">
                            Your free
                            trial account has been
                            created.<b style="color:#5cf94b"><br>Your trial will remain active until <span
                                    id="dateFormat"></span></b><br>
                            We will notify you before your trial ends, ensuring you have all the information needed
                            to decide on continuing with us.
                        </p>

                    </div>
                    <!-- 					---------------------------------------------------------------------- -->
                    <button onclick="changeEmail()" class="hidButton btn btn-custom btn-cus btn-primary d-none"
                        style="margin-top:5px;" id="verifyOtp">ChangeEmail</button>

                    <a style="margin-top:5px;" href="<?php echo $save_redirect_url ?>"><button
                            class="showButton btn btn-custom btn-cus btn-primary" id="redirectTester">Login To
                            Business Dashboard</button></a>
                    <div>

                        <p class="plugin_para paraClassCustom hidPara" style="margin-bottom:0px;">Redirecting in
                            <span id="countdown">59</span>s ...
                        </p>

                    </div>
                    <!-- 					------------------------------------------------------------------------------ -->
                    <div class="hidData d-flex flex-column align-items-center">
                        <h6 class="heading_06 "
                            style="font-size:18px; font-weight:700; color:white; margin:0px;margin-top:40px; margin-bottom:15px">
                            During your trial, you will enjoy:</h6>
                        <div class="d-flex justify-content-center flex-wrap pt-5 pb-5">
                          <div class="col-6 col-md-3">
                                <div class="col-1 d-flex align-items-center justify-content-center"
                                    style="margin-bottom:10px; background-color:white;border-radius:8px; font-family:'Mona Bold'; color:black">
                                    1
                                </div>
                                <div class="rem-pad d-flex flex-column align-items-md-start">
                                    <p class="plugin_para text-start paraclass paraClassCustom"
                                        style="font-family: 'Mona Bold', Sans-serif !important;font-size:18px;">
                                        Business Dashboard</p>
                                    <p class="plugin_para paraClassCustom paraClassCustombeta " style="margin-top:0px">
                                        Get insights &
                                        manage your business seamlessly
                                        with our
                                        dashboard.</p>
                                </div>
                            </div>


                            <div class="col-6 col-md-3">
                                <div class="col-1 d-flex align-items-center justify-content-center"
                                    style="margin-bottom:10px; background-color:white;border-radius:8px; font-family:'Mona Bold'; color:black">
                                    2
                                </div>
                               
								 <div class="rem-pad d-flex flex-column align-items-start">
                                    <p class="plugin_para text-start paraclass paraClassCustom"
                                        style="font-family: 'Mona Bold', Sans-serif !important;font-size:18px;">
                                        Basic Online Store

                                    </p>
                                    <p class="plugin_para paraClassCustom paraClassCustombeta text-start"
                                        style="margin-top:0px">Get your
                                        products online
                                        swiftly with our easy-to-set-up store platform.</p>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="col-1 d-flex align-items-center justify-content-center"
                                    style="margin-bottom:10px; background-color:white;border-radius:8px; font-family:'Mona Bold'; color:black">
                                    3
                                </div>
								   <div class="rem-pad d-flex flex-column align-items-start">
                                    <p class="plugin_para text-start paraclass paraClassCustom"
                                        style="font-family: 'Mona Bold', Sans-serif !important;font-size:18px;">
                                        Demo Customer App</p>
                                    <p class="plugin_para paraClassCustom paraClassCustombeta" style="margin-top:0px">
                                        Preview the customer
                                        experience with
                                        a demo of our dedicated customer app.</p>
                                </div>
                              
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="col-1 d-flex align-items-center justify-content-center"
                                    style="margin-bottom:10px; background-color:white;border-radius:8px; font-family:'Mona Bold'; color:black">
                                    4
                                </div>                    
								 <div class="rem-pad d-flex flex-column align-items-md-start">
                                    <p class="plugin_para text-start paraclass paraClassCustom"
                                        style="font-family: 'Mona Bold', Sans-serif !important;font-size:18px;">
                                        POS App</p>
                                    <p class="plugin_para paraClassCustom paraClassCustombeta " style="margin-top:0px">A
                                        mobile point-of-sale
                                        application
                                        to streamline sales transactions.</p>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>







</div>

<?php
return ob_get_clean();
}

add_shortcode('custom_registration_form', 'custom_registration_form_shortcode');

// ***********************************************************************************************************

function custom_registration_form_shortcode_after_success()
{

    $personalInfoColor = '#1429EF'; // Green color
    $BackgroundColor = '#DEF1FD'; // Light blue color
    $options = get_option('custom_settings');
    $save_redirect_url = $options['email_verification_url'];
    ob_start();
    ?>

<div class="monster" id="monsterDiv">
    <button class="close-button">
        <img src="http://lincsell.com/wp-content/uploads/2024/01/crooos-sign.svg" alt="Close" />
    </button>

    <div class="loader" style="display:none">
        <div class="ngx-spinner-overlay">
            <div class="col-12 d-flex align-items-center justify-content-center flex-column">
                <img style="width:150px !important;" decoding="async"
                    src="https://lincsell.com/wp-content/uploads/2024/01/LincSell-Icon-2-2.gif" data-no-lazy="1"
                    alt="logo">
                <p class="plugin_para_load" style="color:white">Please wait ...</p>
            </div>



        </div>
    </div>

    <div class="loaderError" style="display:none">
        <div class="ngx-spinner-overlay">
            <div class="col-12 d-flex align-items-center justify-content-center flex-column">
                <img style="width:150px !important;" decoding="async"
                    src="https://lincsell.com/wp-content/uploads/2024/01/LincSell-Icon-2-2.gif" data-no-lazy="1"
                    alt="logo">
                <p class="plugin_para_load" style="color:white">Try Again By Refreshing The Page ...</p>
            </div>



        </div>
    </div>
    <style>
    .plugin_para_load {
        position: relative;
        bottom: 40px;
    }

    .ngx-spinner-overlay {
        background-color: rgba(0, 0, 0, 0.9);
        z-index: 99999;
        position: fixed;
        opacity: 1;
        width: 100%;
        height: 100%;
        display: flex !important;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    </style>


    <div class="container-fluid main-container main-container-after-email justify-content-center align-items-center ">
        <div class="d-flex justify-content-center pb-3" style="gap:20px">

            <div class="col-11 col-md-11  columns-class-email pb-3 pt-3 px-0 px-md-3">
                <div class="d-flex flex-column align-items-center">
                    <a href="https://lincsell.com/"> <img
                            src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>" alt="Phone Icon"
                            style="width: 180px; "></a>

                    <div class="mt-3 mb-3"><img src="http://lincsell.com/wp-content/uploads/2024/01/Check-mark.gif"
                            style="width:80px;" alt="Phone Icon">
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center justify-content-center inner-div-email-fir ">
                    <div class="inner-div-email">
                        <h6 class="heading_06"
                            style="font-size:18px; font-weight:700; color:white; margin:0px; margin-top:5px; margin-bottom:3px">
                            Welcome Aboard!</h6>
                        <p class="paraClassCustom mt-3 mb-3"></p>
                    </div>
                    <div class="col-12 mb-3">
                        <p class="plugin_para paraClassCustom paraClassCustombeta hidPara text-center"
                            style="margin-bottom:0px; margin-top:0px;">
                            Your free
                            trial account has been
                            created.<b style="color:#5cf94b"><br>Your trial will remain active until <span
                                    id="dateFormat"></span></b><br>
                            We will notify you before your trial ends, ensuring you have all the information needed
                            to decide on continuing with us.
                        </p>

                    </div>
                    <!-- 					---------------------------------------------------------------------- -->
                    <button onclick="changeEmail()" class="hidButton btn btn-custom btn-cus btn-primary d-none"
                        style="margin-top:5px;" id="verifyOtp">ChangeEmail</button>

                    <a style="margin-top:5px;" href="<?php echo $save_redirect_url ?>"><button
                            class="showButton btn btn-custom btn-cus btn-primary" id="redirectTester">Login To
                            Business Dashboard</button></a>
                    <div>

                        <!-- <p class="plugin_para paraClassCustom hidPara" style="margin-bottom:0px;">Redirecting in
                            <span id="countdown">59</span>s ...
                        </p> -->

                    </div>
                    <!-- 					------------------------------------------------------------------------------ -->
                    <div class="hidData d-flex flex-column align-items-center">
                        <h6 class="heading_06 "
                            style="font-size:18px; font-weight:700; color:white; margin:0px;margin-top:40px; margin-bottom:15px">
                            During your trial, you will enjoy:</h6>
                        <div class="d-flex justify-content-center flex-wrap pt-5 pb-5">
                            <div class="col-6 col-md-3">
                                <div class="col-1 d-flex align-items-center justify-content-center"
                                    style="margin-bottom:10px; background-color:white;border-radius:8px; font-family:'Mona Bold'; color:black">
                                    1
                                </div>
                                <div class="rem-pad d-flex flex-column align-items-md-start">
                                    <p class="plugin_para text-start paraclass paraClassCustom"
                                        style="font-family: 'Mona Bold', Sans-serif !important;font-size:18px;">
                                        Business Dashboard</p>
                                    <p class="plugin_para paraClassCustom paraClassCustombeta " style="margin-top:0px">
                                        Get insights &
                                        manage your business seamlessly
                                        with our
                                        dashboard.</p>
                                </div>
                            </div>


                            <div class="col-6 col-md-3">
                                <div class="col-1 d-flex align-items-center justify-content-center"
                                    style="margin-bottom:10px; background-color:white;border-radius:8px; font-family:'Mona Bold'; color:black">
                                    2
                                </div>
                               
								 <div class="rem-pad d-flex flex-column align-items-start">
                                    <p class="plugin_para text-start paraclass paraClassCustom"
                                        style="font-family: 'Mona Bold', Sans-serif !important;font-size:18px;">
                                        Basic Online Store

                                    </p>
                                    <p class="plugin_para paraClassCustom paraClassCustombeta text-start"
                                        style="margin-top:0px">Get your
                                        products online
                                        swiftly with our easy-to-set-up store platform.</p>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="col-1 d-flex align-items-center justify-content-center"
                                    style="margin-bottom:10px; background-color:white;border-radius:8px; font-family:'Mona Bold'; color:black">
                                    3
                                </div>
								   <div class="rem-pad d-flex flex-column align-items-start">
                                    <p class="plugin_para text-start paraclass paraClassCustom"
                                        style="font-family: 'Mona Bold', Sans-serif !important;font-size:18px;">
                                        Demo Customer App</p>
                                    <p class="plugin_para paraClassCustom paraClassCustombeta" style="margin-top:0px">
                                        Preview the customer
                                        experience with
                                        a demo of our dedicated customer app.</p>
                                </div>
                              
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="col-1 d-flex align-items-center justify-content-center"
                                    style="margin-bottom:10px; background-color:white;border-radius:8px; font-family:'Mona Bold'; color:black">
                                    4
                                </div>                    
								 <div class="rem-pad d-flex flex-column align-items-md-start">
                                    <p class="plugin_para text-start paraclass paraClassCustom"
                                        style="font-family: 'Mona Bold', Sans-serif !important;font-size:18px;">
                                        POS App</p>
                                    <p class="plugin_para paraClassCustom paraClassCustombeta " style="margin-top:0px">A
                                        mobile point-of-sale
                                        application
                                        to streamline sales transactions.</p>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>







</div>
<style>
.close-button {
    position: fixed;
    top: 10px;
    right: -20px;
    background-color: transparent !important;
    border: none;
    font-size: 40px;
    cursor: pointer;
    color: white;
    outline: none;
    z-index: 999999;
}
	
	.close-button:active {
    background-color: transparent !important;
}

.close-button span {
    font-weight: bold;
}
</style>
<?php
return ob_get_clean();
}

add_shortcode('custom_registration_form_after_success', 'custom_registration_form_shortcode_after_success');

?>