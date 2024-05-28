<<<<<<< HEAD
=======
//comment
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
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
<<<<<<< HEAD
	//------------------------------------------------------------------
	if (email_vad === "") {
      toastr.error("Please enter a valid email address.", "Action Needed!");
=======

    if (email_vad === "") {
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
      return false;
    }

    if (!emailRegex_vad.test(email_vad)) {
<<<<<<< HEAD
		jQuery("#email-error-message").text(
          "Please enter a valid email address."
        );
      return false;
    }

	//------------------------------------------------------------------
=======
      return false;
    }

>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
    if (errorContainerEmail_vad.html().trim() == "") {
      if (
        firstName_vad === "" ||
        lastName_vad === "" ||
        email_vad === "" ||
        phoneNumber_vad === "" ||
<<<<<<< HEAD
        password_vad === "" ||
        confirmPassword_vad === "" ||
        password_vad !== confirmPassword_vad
=======
        password_vad === ""
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
      ) {
        return false;
      }

      if (phoneNumber_vad.replace(/\D/g, "").length != 10) {
        return false;
      }

      if (!emailRegex_vad.test(email_vad)) {
        return false;
      }
<<<<<<< HEAD

      // Check if the terms and conditions checkbox is checked
      if (!termsCheckbox_vad.checked) {
=======
      if (
        errorContainerEmail_vad.html().trim() ==
        "Do you want to continue previous ?"
      ) {
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
        return false;
      }
    }

    if (
      errorContainerEmail_vad.html().trim() ==
      "Email already exists. Please choose a different one."
    ) {
      return false;
    }
<<<<<<< HEAD
    
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
  
=======
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
      jQuery("#password-feedback").css("color", "red");
      return false;
    }
    //-----------------------------------------------------------------------------
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
    //---------------------------Personal Info Data Attributes----------------
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email = $("#email").val();
    var phone_number = $("#phone_number").val();
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();
    var terms_and_conditions = $("#terms_and_conditions").val();
<<<<<<< HEAD
=======

>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
    var errorContainerEmail = jQuery("#email-error-message");
    var errorContainer = $("#password-error-message");

    //---------------------Businessinfo Info Data Attributes---------------------------------

    var business_name = $("#business_name").val();
    var business_info_choice = $("#business_info_choice").val();
    var businessError = jQuery("#business-name-error-message");
    var loader = $(".loader");

<<<<<<< HEAD
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
=======
    // Business field checks
    // -------------------Businessinfo Info Conditions--------------------------------------

    if (business_name === "") {
      businessError.text("Please Fill The Business Name!");
      return false;
    }

    if (businessError.html().trim() == "Please Fill The Business Name!") {
      return false;
    }
    //------------------------gobal variable assinger
    var userIdGlobal;
    var businessIdGlobal;
    // Show loader before making the AJAX request
    loader.css("display", "block");
    //--------------------------------------------------
    //--------------------------------------------------
    $.ajax({
      url: customEmailForm.ajaxurl, // Replace with your custom API endpoint
      type: "POST",
      data: {
        action: "custom_business_name_validation_ajax", // Keep the action identifier
        business_name: business_name,
      },
      success: function (response) {
        console.log(response);
        if (response.error) {
          console.error(response);
          return;
        }
        var gettingData = JSON.parse(response.body);
        var modifiedResponse = gettingData.data;
        if (modifiedResponse == true) {
          businessError.text("Company Name already exists.");
          businessError.css("color", "red");
          loader.css("display", "none");
          return;
        } else {
          businessError.text("");
        }

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
            business_name: business_name,
            terms_and_conditions: terms_and_conditions,
          },
          success: function (response) {
            console.log(response);
            $.ajax({
              type: "post",
              url: customFormFullApi.ajaxurl,
              data: {
                action: "custom_form_ajax_full_form",
                firstName: first_name,
                lastName: last_name,
                email: email,
                confirmEmail: email,
                phone: phone_number,
                password: password,
                doAgree: true,
                userExist: false,
                userID: "",
                companyName: "",
              },

              success: function (response) {
                console.log(response);
                if (response.error) {
                  console.error(response);
                  jQuery(".loaderError").css("display", "block");
                  return;
                }
                const parsedResponse = JSON.parse(response.body);
                if (parsedResponse.success == false) {
                  console.error(response);
                  console.error(parsedResponse.message);
                  console.error(
                    "Error Occured in the Api responsible for Submitting User Info in WP"
                  );
                  return;
                } else {
                  console.log(response);
                  // Parse the 'body' property of the 'data' property as JSON
                  var responseData = JSON.parse(response.body);

                  // Access the 'data' property inside the parsed response
                  var dataInsideData = responseData.data;
                  userIdGlobal = responseData.data;
                  //    alert(userIdGlobal);
                  console.log(typeof dataInsideData);

                  // Check if any field is empty
                  if (
                    !first_name ||
                    !last_name ||
                    !email ||
                    !phone_number ||
                    !password
                  ) {
                    return false;
                  }

                  // Third Ajax Call to Storing user id (data) in sessions and database
                  $.ajax({
                    type: "post",
                    url: customFormFullApi.ajaxurl,
                    data: {
                      action: "store_data_in_options_table",
                      dataInsideData: dataInsideData,
                      email: email,
                    },
                    success: function (storeResponse) {
                      //      alert(storeResponse);
                      console.log(
                        "Data stored in options table (UserID):",
                        storeResponse
                      );

                      // Forth Ajax Call to Storing business name and business type with the help of userid
                      $.ajax({
                        type: "post",
                        url: customFormFull2Api.ajaxurl,
                        data: {
                          action: "custom_form_ajax_full_form_two",
                          userIdGlobal: userIdGlobal,
                          email: email,
                          phone: phone_number,
                          business_name: business_name,
                          business_info_choice: business_info_choice,
                        },

                        success: function (response) {
                          console.log(response);
                          console.log(response);
                          if (response.error) {
                            console.error(response);
                            jQuery(".loaderError").css("display", "block");
                            return;
                          }
                          const parsedResponse = JSON.parse(response.body);
                          if (parsedResponse.success == false) {
                            console.error(response);
                            console.error(
                              "Error Occured in the Api responsible for Submitting Bussiness Name in WP and Making Business in Azure Api  "
                            );
                            console.error(parsedResponse.message);
                            return;
                          } else {
                            // Parse the 'body' property of the 'data' property as JSON
                            var responseData = JSON.parse(response.body);
                            // Access the 'data' property inside the parsed response
                            var dataInsideData = responseData.data;
                            businessIdGlobal = responseData.data;
                            //         alert(businessIdGlobal);
                            console.log(dataInsideData);

                            // Fifth Ajax Call Storing user bussinessid (data) to Sesssions
                            $.ajax({
                              type: "post",
                              url: customFormFullApi.ajaxurl,
                              data: {
                                action: "store_business_data_in_options_table",
                                dataInsideData: dataInsideData,
                                email: email,
                              },
                              success: function (storeResponse) {
                                //               alert(storeResponse);
                                console.log(
                                  "Data stored in session bussiness",
                                  storeResponse
                                );
                                // Sixth Ajax Call to send request for otp by sending bussiness id and user id
                                $.ajax({
                                  type: "post",
                                  url: customFormFull2Api.ajaxurl,
                                  data: {
                                    action: "function_opt",
                                    user_id_global: userIdGlobal,
                                    business_id_global: businessIdGlobal,
                                  },

                                  success: function (response) {
                                    jQuery(".putEmail").text(email);
                                    console.log(response);
                                    if (response.error) {
                                      console.error(response);
                                      jQuery(".loaderError").css(
                                        "display",
                                        "block"
                                      );
                                      return;
                                    }
                                    const parsedResponse = JSON.parse(
                                      response.body
                                    );
                                    if (parsedResponse.success == false) {
                                      console.error(response);
                                      console.error(
                                        "Error Occured in the Api responsible for Sending OTP"
                                      );
                                      console.error(parsedResponse.message);
                                      return;
                                    } else {
                                      
                                      jQuery("#step-1").fadeOut(500);
                                      jQuery("#step-2").fadeIn(500);
                                      jQuery("#submit-form").show();
                                      jQuery(
                                        "#custom-registration-form"
                                      ).hide();
                                      jQuery(".firstStep").hide();
                                      jQuery(".main-container-email").show();
                                      loader.css("display", "none");
										var otpboxx = jQuery("#otpBoxFirst");
										otpboxx.focus();
                                    }
                                  },
                                  error: function (xhr, status, error) {
                                    console.error(
                                      "AJAX request failed:",
                                      error
                                    );
                                  },
                                });
                              },
                              error: function (xhr, status, error) {
                                console.error("AJAX request failed:", error);
                              },
                            });
                          }
                        },
                        error: function (xhr, status, error) {
                          console.error("AJAX request failed:", error);
                        },
                      });
                    },
                    error: function (xhr, status, error) {
                      console.error("AJAX request failed:", error);
                    },
                  });
                }
              },
              error: function (xhr, status, error) {
                console.error("AJAX request failed:", error);
              },
            });
          },
          error: function (xhr, status, error) {
            console.error("AJAX request failed:", error);
          },
        });
      },
      error: function (xhr, status, error) {
        console.error("AJAX request failed:", error);
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
      },
    });

    return false;
  });
});
