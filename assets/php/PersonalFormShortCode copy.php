<?php

//Starting the session
add_action('init', function () {
    if (!session_id()) {
        session_start();
    }
});

function custom_registration_form_shortcode_after_success()
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
        <img src="http://stg.stg.stg.lincsell.com/wp-content/uploads/2024/01/crooos-sign.svg" alt="Close" />
    </button>

    <div class="loader" style="display:none">
        <div class="ngx-spinner-overlay">
            <div class="col-12 d-flex align-items-center justify-content-center flex-column">
                <img style="width:150px !important;" decoding="async"
                    src="https://stg.stg.stg.lincsell.com/wp-content/uploads/2024/01/LincSell-Icon-2-2.gif" data-no-lazy="1"
                    alt="logo">
                <p class="plugin_para_load" style="color:white">Please wait ...</p>
            </div>



        </div>
    </div>

    <div class="loaderError" style="display:none">
        <div class="ngx-spinner-overlay">
            <div class="col-12 d-flex align-items-center justify-content-center flex-column">
                <img style="width:150px !important;" decoding="async"
                    src="https://stg.stg.stg.lincsell.com/wp-content/uploads/2024/01/LincSell-Icon-2-2.gif" data-no-lazy="1"
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
                    <a href="https://stg.stg.stg.lincsell.com/"> <img
                            src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>" alt="Phone Icon"
                            style="width: 180px; "></a>

                    <div class="mt-3 mb-3"><img src="http://stg.stg.stg.lincsell.com/wp-content/uploads/2024/01/Check-mark.gif"
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
                        <div class="d-flex align-items-center justify-content-center flex-wrap pt-5 pb-5">
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

                            <div class="col-6 col-md-3">
                                <div class="col-1 d-flex align-items-center justify-content-center"
                                    style="margin-bottom:10px; background-color:white;border-radius:8px; font-family:'Mona Bold'; color:black">
                                    3
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
                                    4
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

add_shortcode('custom_registration_form_after_success', 'custom_registration_form_shortcode_after_success');

?>