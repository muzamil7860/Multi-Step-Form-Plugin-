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
		<img src="../wp-content/uploads/2024/01/crooos-sign.svg" alt="Close" />
	</button>



	<!-- ----------------------------------------------------- -->
	<!-- Sending Otp Loader -->
	<div class="ngx-spinner-overlay loaderSending" style="display:none; ">

		<i class="fas fa-spinner fa-spin" style="color:white; font-size:27px;"></i>
		<div class="loading-text mt-2" style="color:white">
			<p>Sending Verification Code...</p>
		</div>
	</div>

	<!-- verifying Otp Loader  -->
	<div class="ngx-spinner-overlay loaderVerifying" style="display:none;">

		<i class="fas fa-spinner fa-spin" style="color:white; font-size:27px;"></i>
		<div class="loading-text mt-2" style="color:white">
			<p class="verifying_init">Verifying Code...</p>
		</div>
	</div>

	<!-- Error Loader -->

	<div class="ngx-spinner-overlay loaderErroring " style="display:none;">
		<div>
			<div class="loading-text mt-2 d-flex flex-column align-items-center justify-content-center" style="color:white">
				<p style="font-weight: 600; font-size: 20px; letter-spacing: 0.05rem;">Try Again!</p>
				<p>Refresh the page or check your network.</p>
				<a style="width:fit-content; font-size: 15px; letter-spacing: 0.05rem; border-radius:24px;padding-right: 35px;padding-left: 35px;" class="small-buttons-no py-2" id="refreshButton" type="button">Refresh Page</a>
			</div>
		</div>
	</div>

	<!-- Backend Error Loader -->
	<div class="ngx-spinner-overlay loaderTechErroring" style="display:none;">
		<div>
			<div class="loading-text mt-2 d-flex flex-column align-items-center justify-content-center" style="color:white">
				<p style="font-weight: 600; font-size: 20px; letter-spacing: 0.05rem;">Try Later!</p>
				<p style="text-align:center;">
					We are unable to create your account at the moment.<br> 
					Kindly contact support <a href="mailto:info@lincsell.com" style="color: white; text-decoration: underline;">info@lincsell.com</a>
				</p>
				<a href="mailto:info@lincsell.com" style="width:fit-content; font-size: 15px; letter-spacing: 0.05rem; border-radius:24px; padding-right: 35px; padding-left: 35px;" class="small-buttons-no py-2" id="techButton" type="button">Contact Here</a>
			</div>
		</div>
	</div>
	<!-- 	Popup For Previous Continue ? -->



	<div class="ngx-spinner-overlay loaderContinue" style="display:none;" >
		<div class="loading-text mt-2" style="color:white;">
			<div class="d-flex flex-column align-items-center justify-content-center " style="height:100vh;">
				<p style="font-weight: 600; font-size: 20px; letter-spacing: 0.05rem;">Pickup where you left off</p>
				<p style="text-align:center;">It looks like you started your free trial process with this email but didn’t complete it.
					<br>Would you like to continue the previous session?</p>
				<div style="d-flex flex-row">
					<a style="width:fit-content; font-size: 15px; letter-spacing: 0.05rem; border-radius:7px;padding-right: 35px;padding-left: 35px;" class="small-buttons-yes py-2" id="continueProcessButtonClose" type="button">Start with New Email </a>
					<a style="width:fit-content; font-size: 15px; letter-spacing: 0.05rem; border-radius:7px;padding-right: 35px;padding-left: 35px;" class="small-buttons-no py-2" id="continueProcessButton" type="button">Continue Previous Session
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- ----------------------------------------------------- -->
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
						  action="" method="post">
						<!-- Step 1: Personal Information -->
						<div class="col-12 form-step form-mob-div" id="step-1">
							<div class="text-center">
								<div class="d-flex align-items-center justify-content-center">
									<a href="#"> <img src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>"
													  alt="Phone Icon" style="width: 180px; "></a>
								</div>

								<p class="plugin_para paraClassCustom paraclass">
									Start Your 30-Day Free Trial Now!</p>
								<div class="d-flex flex-wrap align-items-center justify-content-center" style="gap:15px; margin-bottom:15px;">

									<!-- Secure & Safe -->

									<div class="d-flex align-items-center" style="gap:10px; font-size:14px;">
										<svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 15 15">
											<path fill="#3cda10" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd" />
										</svg>
										<p style="color:white; margin:0px;">Secure & Safe</p>
									</div>

									<!-- No Hidden Fee -->
									<div class="d-flex align-items-center" style="gap:10px; font-size:14px;">
										<svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 15 15">
											<path fill="#3cda10" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd" />
										</svg>
										<p style="color:white; margin:0px;">No Hidden Fee</p>
									</div>
									<!-- No Credit Card Required -->
									<div class="d-flex align-items-center" style="gap:10px; font-size:14px;">
										<svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 15 15">
											<path fill="#3cda10" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd" />
										</svg>
										<p style="color:white; margin:0px;">No Credit Card Required</p>
									</div>
								</div>
							</div>

							<div class="form-row form-above-spacing">
								<div class="form-group col-md-6 padding-right">
									<label class="label_plug" for="first_name">First Name<span
																							   class="required-asterisk">*</span> </label>
									<input type="text" class="form-control border-radius border-class" id="first_name"
										   name="first_name" required autofocus>
									<!-- Add this div below the Name input field -->
									<div id="name-error-message" class="error-div" style="color: red; font-size:13px;">
									</div>
								</div>

								<div class="form-group col-md-6 padding-left">
									<label class="label_plug" for="last_name">Last Name<span
																							 class="required-asterisk">*</span></label>
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
									<div class="input-group-append">
										<span
											  style="visibility:hidden; position: relative; bottom: 39px; left: 85%; color: #1629EF; background-color:#ffffff00;"
											  class="email-loader input-group-text">
											<i id="loadingIcon" class="fas fa-spinner fa-spin"></i>
										</span>
									</div>
									<div id="tempClass" style="display:none; margin-top:-26px;">
										<div class="d-flex flex-row justify-content-between">
											<div id="email-error-message" class="error-div emailErrorDivCase"
												 style="color: red; font-size:13px; flex-grow: 1;">
											</div>
											<a class="small-buttons-yes" style="display:none;" id="continueProcessButtonClose"
											   type="button">No
											</a>
											<a class="small-buttons-no" style="display:none;" id="continueProcessButton" type="button">Yes
											</a>
										</div>
									</div>
								</div>

								<div class="form-group col-md-6 padding-left phoneAlphaAbove">
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



							<!-- --------------------------- -->

							<!-- 1 -->
							<div class="form-row d-flex justify-content-between pt-2 pt-md-0 px-1">
								<div id="twoColAlphaId" class="form-group twoColAlpha twoMobcol">
									<label for="has_website" class="label_plug">Do you have a website?<span
																											class="required-asterisk">*</span></label>
									<select id="has_website" name="has_website" class="form-control dropDown">
										<option value="">Select</option>
										<option value="yes">Yes</option>
										<option value="no">No</option>
									</select>
									<div id="has_website-error-message" class="error-div"
										 style="color: red; font-size:13px;">
									</div>
								</div>

								<div class="form-group twoCol twoMobcol" id="website_platform" style="display:none;">
									<label for="platform" class="label_plug">Platform of your website?<span
																											class="required-asterisk">*</span></label>
									<select id="platform" name="platform" class="form-control dropDown ">
										<option value="">Select</option>
										<option value="woocommerce">WooCommerce</option>
										<option value="shopify">Shopify</option>
										<option value="square">Square</option>
										<option value="other">Other</option>
									</select>
									<div id="has_platform-error-message" class="error-div"
										 style="color: red; font-size:13px;">
									</div>
								</div>
							</div>

							<!-- 2 -->
							<div class="form-group pt-2 pt-md-0">
								<label for="has_domain" class="label_plug">Do you have a registered domain?<span
																												 class="required-asterisk">*</span></label>
								<select id="has_domain" name="has_domain" class="form-control dropDown">
									<option value="">Select</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
								<div id="registerDomain-feedback" class="registerDomain-div"
									 style="display:none; font-size: 13px;line-height:20px;color:#ffffffd6;margin-top:5px;">
									Your
									webstore will be hosted on our subdomain i.e., yourwebsite.lincsell.com
								</div>
								<div id="has_domain-error-message" class="error-div"
									 style="color: red; font-size:13px;">
								</div>

							</div>

							<div class="form-group" id="website_domain" style="display: none;">
								<label for="domain" class="label_plug">Registered domain<span
																							  class="required-asterisk">*</span></label>
								<input type="text" class="form-control border-radius border-class" id="domain"
									   name="domain">
								<div id="has_registered-error-message" class="error-div"
									 style="color: red; font-size:13px;">
								</div>
							</div>
							<!-- 3 -->
							<div class="form-group businessDiv" style="margin-top:-15px;">
								<label class="label_plug" for="business_name">Business Name<span
																								 class="required-asterisk">*</span></label>
								<input type="text" class="form-control border-radius border-class" id="business_name"
									   name="business_name">
								<div class="input-group-append">
									<span class="email-loader-buzz input-group-text">
										<i id="loadingIcon" class="fas fa-spinner fa-spin"></i>
									</span>
								</div>
								<div id="business-name-error-message" class="error-div"
									 style="color: red; font-size:13px;">
								</div>
							</div>
							<div class="form-group" style="margin-top:-35px;">
								<label class="label_plug" for="industry">Industry<span
																					   class="label_plug required-asterisk">*</span></label>
								<select class="form-control form-select dropDown" id="industry" name="industry"
										required>
									<option value="">Select Industry</option>
									<option value="1623770624890">General Retail</option>
									<option value="1623770635155">Thrift</option>
									<option value="1623770609262">Vapes/CBD</option>
									<option value="1623770624899">Apparel & Footwear</option>
									<option value="1623770624898">Food & Drink</option>
									<option value="1623770624895">Health Care & Fitness</option>
									<option value="1623770624896">Beauty & Personal Care</option>
									<option value="1623770624897">Services</option>
									<option value="1623770624893">Wine & Liquor</option>
									<option value="1623770624891">Goods & Accessories</option>
									<option value="1623770624894">Other</option>
								</select>
								<div id="industry-error-message" class="error-div" style="color: red; font-size:13px;">
								</div>
							</div>

							<div class="form-row pb-5">
								<div class="form-group form-group-password col-md-12 password-row">
									<label class="label_plug" for="password">Password<span
																						   class="required-asterisk">*</span></label>
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
							<!-- --------------------------- -->
							<div class="form-row d-flex justify-content-center align-items-center decentSpace">

								<div
									 class="col-12 col-md-12 form-group form-group-custom d-flex justify-content-center align-items-center">
									<button class="spacing-btn btn btn-primary btn-custom impBtn" style="width:100%;" id="nextStepSaasy"
											type="button">Create My Free Account
									</button>
								</div>
							</div>
							<div class="form-row d-flex justify-content-center align-items-center" style="margin-bottom:20px;"
								 >
								<div
									 class="col-10 col-md-9 justify-content-center form-check d-flex align-items-md-center">
									<input type="checkbox" class="form-check-input required-asterisk d-none"
										   id="terms_and_conditions" name="terms_and_conditions" required>
									<label class="label_plug text-center"
										   style="margin-top:4px;font-size:13px;line-height:20px; color: #b3b0b0;"
										   class="form-check-label text-center" for="terms_and_conditions">By clicking
										"Create
										my Free
										account", you
										agree to our <a href="../terms-of-service/"
														target="_blank"><span style="color:white; font-weight:500;">Terms of
										Service</span></a> and <a href="../privacy-policy/"
																  target="_blank"><span style="color:white; font-weight:500;">Privacy
										Policy.</span></a><br></label>
								</div>
							</div>




						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid main-container main-container-email justify-content-center align-items-center "
		 style="display:none;" >
		<div class="d-flex justify-content-center pt-5 pb-5" style="gap:20px">

			<div class="col-11 col-md-11  columns-class-email pb-3 pt-3 px-3 px-md-3">
				<div class="d-flex flex-column align-items-center">
					<a href="<?php echo home_url(); ?>"> <img
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
						<p class="plugin_para paraClassCustom mt-3 mb-3" style="line-height:22px;">Check your inbox!
							We've sent a 6-digit verification code to <br><b><span class="putEmail" style="color:#FA4B1B;">
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


						<!--                         <div id="otpContainer">
<input type="text" class="otpBox" id="theOtpF" maxlength="1" pattern="\d"
inputmode="numeric" />
<input type="text" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
<input type="text" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
<input type="text" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
<input type="text" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
<input type="text" class="otpBox" maxlength="1" pattern="\d" inputmode="numeric" />
</div> -->

						<div id="otpContainer">
							<input type="text" class="otpBox otpBoox1" id="theOtpF" maxlength="1" pattern="\d"
								   inputmode="numeric" />
							<input type="text" class="otpBox otpBoox2" maxlength="1" pattern="\d" inputmode="numeric" />
							<input type="text" class="otpBox otpBoox3" maxlength="1" pattern="\d" inputmode="numeric" />
							<input type="text" class="otpBox otpBoox4" maxlength="1" pattern="\d" inputmode="numeric" />
							<input type="text" class="otpBox otpBoox5" maxlength="1" pattern="\d" inputmode="numeric" />
							<input type="text" class="otpBox otpBoox6" maxlength="1" pattern="\d" inputmode="numeric" />
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
							<button class="btn btn-customm btn-primary" id="resendEmail" disabled>Resend Code</button>
							<div> <span id="countdownAlpha"></span></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<style>
		#business-name-error-message {
			margin-top: -18px;
			margin-bottom: 32px;
		}
		.decentSpace{
			margin-top:-20px;
		}
		@media(max-width:480px) {
			.decentSpace{
				margin-top:10px;
				margin-bottom:0px;
			}
			.phoneAlphaAbove {
				margin-top: -20px;
			}

			.emailErrorDivCase {
				margin-bottom: 18px;
			}
		}

		.bootstrap-select.btn-group [data-id="myControl"]+.dropdown-menu.open {
			width: 250px !important;
			overflow: auto !important;
			background-color: red !important;
		}

		.dropDown {
			border-radius: 10px !important;
			font-size: 14px !important;
			color: #606060 !important;
			padding-left: 15px !important;
			height: 50px !important;
		}

		#nextStepSaasy:disabled {
			background-color: #d3d3d3;
		}

		option {
			border-radius: 50px;
		}
	</style>

	<?php
		return ob_get_clean();
}

add_shortcode('custom_registration_form', 'custom_registration_form_shortcode');

	?>