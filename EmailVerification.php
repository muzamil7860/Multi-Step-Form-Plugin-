<?php 


function custom_email_form_shortcode() {
    
    ob_start();
    // $email = isset($_SESSION['registration_email']) ? $_SESSION['registration_email'] : '';
    $email = get_option('registration_email', '');
    ?>
<div class="container-fluid">
    <div class="row d-flex flex-column flex-md-row justify-content-center" style="gap:20px">
        <div class="col-11 col-md-3 columns-class d-flex flex-md-column pt-5 pt-md-0" style="gap:20px">
            <div class="d-flex flex-column flex-md-row mt-md-4 mb-md-2" style="gap:20px">
                <div
                    style="z-index:1; background-color:#23DC32; height:30px; padding:5px; padding-left:9px; padding-right:9px; border-radius:5px; color:white">
                    <i class="fas fa-check"></i>
                </div>
                <div>
                    <h6 style="margin:0px; margin-bottom:5px">Personal Info</h6>
                    <p>Tell us about yourself</p>
                </div>
            </div>

            <div class="d-flex mb-2 flex-column flex-md-row" style="gap:20px">
                <div class="secondClass"
                    style="z-index:1; background-color:#23DC32; height:30px; padding:5px; padding-left:9px; padding-right:9px; border-radius:5px; color:#9E9E9E">
                    <i style="color:white" class="fa-solid fa-check"></i>
                </div>
                <div>
                    <h6 style="margin:0px; margin-bottom:5px">Business Info</h6>
                    <p>Tell us about your business
                    </p>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row" style="gap:20px">
                <div
                    style="z-index:1; background-color:#32DC23; height:30px; padding:5px; padding-left:10px; padding-right:10px; border-radius:5px; color:#9E9E9E">
                    <i style="color:white" class="fa-solid fa-3"></i>
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
            <div class="email-verification mt-2 mb-2">
                <h6 style="font-size:24px; font-weight:700; color:#32DC23; margin:0px; margin-bottom:5px">Verification
                </h6>
                <p>Account verification via Email</p>
                <div class="text-center mt-5 mb-5">
                    <h6 style="font-size:18px; font-weight:700; color:black; margin:0px; margin-bottom:5px">Verify
                        Your Email Address</h6>
                    <p>We have sent an account verification email <span style="color:#32DC23"><b> <?php echo $email;?>
                            </b></span>
                        to verify your email
                        and activate your account. If you
                        don’t see it, please check your spam/junk folder. </p>
                    <p>Didn t receive the verification code?</p>
                    <button class="btn btn-custom btn-primary ">Resend Email</button>
                </div>
            </div>
        </div>
    </div>
</div>
>


<?php
    return ob_get_clean();
}

add_shortcode('custom_email_form', 'custom_email_form_shortcode');


?>