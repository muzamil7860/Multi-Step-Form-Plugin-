jQuery(document).ready(function ($) {
  $("#nextStepSaasy").on("click", function (el) {
    el.preventDefault();

    // -------------------------------------------------

    // Validate fields for Step 1
    var firstName_vad = document.getElementById("first_name").value;
    var lastName_vad = document.getElementById("last_name").value;
    var email_vad = document.getElementById("email").value;
    var phoneNumber_vad = document.getElementById("phone_number").value;
    var password_vad = document.getElementById("password").value;
    var confirmPassword_vad = document.getElementById("confirm_password").value;
    var termsCheckbox_vad = document.getElementById("terms_and_conditions");
    var errorContainerEmail_vad = jQuery("#email-error-message");
    var emailRegex_vad = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	//------------------------------------------------------------------
	if (email_vad === "") {
      toastr.error("Please enter a valid email address.", "Action Needed!");
      return false;
    }

    if (!emailRegex_vad.test(email_vad)) {
		jQuery("#email-error-message").text(
          "Please enter a valid email address."
        );
      return false;
    }

	//------------------------------------------------------------------
    if (errorContainerEmail_vad.html().trim() == "") {
      if (
        firstName_vad === "" ||
        lastName_vad === "" ||
        email_vad === "" ||
        phoneNumber_vad === "" ||
        password_vad === "" ||
        confirmPassword_vad === "" ||
        password_vad !== confirmPassword_vad
      ) {
        return false;
      }

      if (phoneNumber_vad.replace(/\D/g, "").length != 10) {
        return false;
      }

      if (!emailRegex_vad.test(email_vad)) {
        return false;
      }

      // Check if the terms and conditions checkbox is checked
      if (!termsCheckbox_vad.checked) {
        return false;
      }
    }

    if (
      errorContainerEmail_vad.html().trim() ==
      "Email already exists. Please choose a different one."
    ) {
      return false;
    }
    
    //--------------------------------------------------

	//-----------------------------------------------------------------------------
  //handeling password
  // Regular expressions for validation
  var uppercaseRegex = /[A-Z]/;
  var lowercaseRegex = /[a-z]/;
  var digitRegex = /\d/;
  var specialCharRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/;

  // Check if all criteria are met
  if (
    password_vad.length >= 8 &&
    uppercaseRegex.test(password_vad) &&
    lowercaseRegex.test(password_vad) &&
    digitRegex.test(password_vad) &&
    specialCharRegex.test(password_vad)
  ) {
  } else {
    return false;
  }
  //-----------------------------------------------------------------------------
  
    //---------------------------Personal Info Data Attributes----------------
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email = $("#email").val();
    var phone_number = $("#phone_number").val();
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();
    var terms_and_conditions = $("#terms_and_conditions").val();
    var errorContainerEmail = jQuery("#email-error-message");
    var errorContainer = $("#password-error-message");

    //---------------------Businessinfo Info Data Attributes---------------------------------

    var business_name = $("#business_name").val();
    var business_info_choice = $("#business_info_choice").val();
    var businessError = jQuery("#business-name-error-message");
    var loader = $(".loader");

    // SECOND Ajax Call that is storing personal information to lOCAL wp cUSTOM tAble //can move this
    $.ajax({
      type: "post",
      url: customFormFullApi.ajaxurl,
      data: {
        action: "custom_form_ajax",
        first_name: first_name,
        last_name: last_name,
        email: email,
        phone_number: phone_number,
        password: password,
        terms_and_conditions: terms_and_conditions,
      },
      success: function (response) {
        console.log(response);
      },
    });

    return false;
  });
});
