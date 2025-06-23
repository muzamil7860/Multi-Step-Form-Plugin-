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
    // var errorContainerIndustry_vad = jQuery("#industry-error-message");
    // var industry = jQuery("#industry").val();
    // var has_website = jQuery("#has_website").val();
    // var has_website_error_container = jQuery("#has_website-error-message");
    // var has_platform = jQuery("#platform").val();
    // var has_platform_error_container = jQuery("#has_platform-error-message");
    // var has_domain = jQuery("#has_domain").val();
    // var has_domain_error_message = jQuery("#has_domain-error-message");
    // var has_registered = jQuery("#domain").val();
    // var has_registered_error_message = jQuery("#has_registered-error-message");

    var alphaT = jQuery("#lastNameError");
    var betaT = jQuery("#name-error-message");
    var cetaT = jQuery("#phone-error-message");
    var detaT = jQuery("#email-error-message");
    var eetaT = jQuery("#password-error-message");
    var fetaT = jQuery("#password-feedback");

    if (email_vad === "") {
      detaT.text("Please Fill The Email!");
          jQuery("#continueProcessButtonClose").hide();
          jQuery("#continueProcessButton").hide();
          jQuery("#tempClass").show();
      return false;
    }

    if (!emailRegex_vad.test(email_vad)) {
      detaT.text("Please enter a valid email address.");
      return false;
    }

    if (errorContainerEmail_vad.html().trim() == "") {
      if (
        firstName_vad === "" ||
        lastName_vad === "" ||
        email_vad === "" ||
        phoneNumber_vad === "" ||
        password_vad === ""
      ) {
        if (lastName_vad === "") {
          alphaT.text("Please Fill The Last Name!");
        }
        if (firstName_vad === "") {
          betaT.text("Please Fill The First Name!");
        }
        if (phoneNumber_vad === "") {
          cetaT.text("Please Fill The Phone Number!");
        }
        if (email_vad == "") {
          detaT.text("Please Fill The Email!");
          jQuery("#continueProcessButtonClose").hide();
          jQuery("#continueProcessButton").hide();
          jQuery("#tempClass").show();
        }
        if (password_vad === "") {
          fetaT.css("color", "red");
          fetaT.text("Please Fill The Password!");
        }
        return false;
      }

      if (phoneNumber_vad.replace(/\D/g, "").length != 10) {
        cetaT.text("Phone Number must have 10 digits!");
        return false;
      }

      if (!emailRegex_vad.test(email_vad)) {
        detaT.text("Please enter a valid email address.");
        return false;
      }
      if (
        errorContainerEmail_vad.html().trim() ==
        "Do you want to continue previous ?"
      ) {
        return false;
      }
    }

    if (
      errorContainerEmail_vad.html().trim() ==
      "Email already exists. Please choose a different one."
    ) {
      return false;
    }
    // if (industry === "") {
    //   var errorContainerIndustry_vad = jQuery("#industry-error-message");
    //   errorContainerIndustry_vad.text("Please Fill The Industry!");
    //   return false;
    // }

    // if (has_website === "") {
    //   has_website_error_container.text("Please Fill The Website!");
    //   return false;
    // }

    // if (has_domain === "") {
    //   has_domain_error_message.text("Please Fill The Domain!");
    //   return false;
    // }

    // if (has_website != "" && has_website != "no") {
    //   if (has_platform === "") {
    //     has_platform_error_container.text("Please Fill The Platform!");
    //     return false;
    //   }
    // }

    // if (has_domain != "" && has_domain != "no") {
    //   if (has_registered === "") {
    //     has_registered_error_message.text("Please Fill The Registered Domain!");
    //     return false;
    //   }
    // }
    // if (
    //   has_registered_error_message.html().trim() ==
    //   "Please Fill The Registered Domain!"
    // ) {
    //   return false;
    // }

    // if (
    //   errorContainerIndustry_vad.html().trim() == "Please Fill The Industry!"
    // ) {
    //   return false;
    // }

    // if (
    //   has_website_error_container.html().trim() == "Please Fill The Website!"
    // ) {
    //   return false;
    // }

    // if (
    //   errorContainerIndustry_vad.html().trim() == "Please Fill The Platform!"
    // ) {
    //   return false;
    // }

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

    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email = $("#email").val();
    var phone_number = $("#phone_number").val();
    var password = $("#password").val();
    var terms_and_conditions = $("#terms_and_conditions").val();
    var business_name = $("#business_name").val();
    var business_info_choice = $("#business_info_choice").val();
    var businessError = jQuery("#business-name-error-message");
    var loader = $(".loaderSending");

    if (business_name === "") {
      businessError.text("Please Fill The Business Name!");
      return false;
    }

    if (businessError.html().trim() == "Please Fill The Business Name!") {
      return false;
    }
    if (businessError.html().trim() == "Business Name already exists.") {
      return false;
    }

    var userIdGlobal;
    var businessIdGlobal;
    loader.css("display", "flex");

    // has_website = has_website === "" ? "no" : has_website;
    // has_platform = has_platform === "" ? "no" : has_platform;
    // has_domain = has_domain === "" ? "no" : has_domain;
    // has_registered = has_registered === "" ? "no" : has_registered;
    // industry = industry === "" ? "Retail" : industry;

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
        // has_website: has_website,
        // has_platform: has_platform,
        // has_domain: has_domain,
        // has_registered: has_registered,
        // industry: industry,
      },
      success: function (response) {
        loader.hide();
        console.log("Success:", response);
      },
      error: function (xhr, status, error) {
        loader.hide();
        console.error("Error:", error);
      },

      success: function (response) {
		// ----------------------------------------------
						//  For Quick Action we are removing loader Here
						jQuery(".putEmail").text(email);
						jQuery(".loaderSending").css("display", "none");
						jQuery("#step-1").fadeOut(500);
						jQuery("#step-2").fadeIn(500);
						jQuery("#submit-form").show();
						jQuery("#custom-registration-form").hide();
						jQuery(".firstStep").hide();
						jQuery(".main-container-email").show();
						var theOtpF = jQuery("#theOtpF");
						theOtpF.focus();
		// ----------------------------------------------
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
            // has_platform: has_platform,
            // has_registered: has_registered,
          },

          success: function (response) {
            if (response.error) {
              console.error(response);
              jQuery(".loaderVerifying").css("display", "none");
              jQuery(".loaderSending").css("display", "none");
              jQuery(".loaderErroring").css("display", "flex");
              return;
            }
            const parsedResponse = JSON.parse(response.body);
            console.log('parsedResponse thissssssss: ', parsedResponse);
            if (parsedResponse.success == false) {
              console.error(response);
              console.error(parsedResponse.message);
              console.error(
                "Error Occured in the Api responsible for Submitting User Info in WP"
              );
			  jQuery(".loaderVerifying").css("display", "none");
              jQuery(".loaderSending").css("display", "none");
              jQuery(".loaderTechErroring").css("display", "flex");
              return;
            } else {
              console.log(response);
              // Parse the 'body' property of the 'data' property as JSON
              var responseData = JSON.parse(response.body);

              // Access the 'data' property inside the parsed response
              var dataInsideData = responseData.data;
              userIdGlobal = responseData.data;
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
                    //   industry: industry
                    },

                    success: function (response) {
                      console.log(response);
                      console.log(response);
                      if (response.error) {
                        console.error(response);
                         jQuery(".loaderVerifying").css("display", "none");
              			 jQuery(".loaderSending").css("display", "none");
              			 jQuery(".loaderTechErroring").css("display", "flex");
                        return;
                      }
                      const parsedResponse = JSON.parse(response.body);
                      if (parsedResponse.success == false) {
                        console.error(response);
                        console.error(
                          "Error Occured in the Api responsible for Submitting Bussiness Name in WP and Making Business in Azure Api  "
                        );
                        console.error(parsedResponse.message);
						 jQuery(".loaderVerifying").css("display", "none");
              			 jQuery(".loaderSending").css("display", "none");
              			 jQuery(".loaderTechErroring").css("display", "flex");
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
								jQuery("#resendEmail").removeAttr("disabled");
                                console.log(response);
                                if (response.error) {
                                  console.error(response);

                                  jQuery(".loaderVerifying").css(
                                    "display",
                                    "none"
                                  );
                                  jQuery(".loaderSending").css(
                                    "display",
                                    "none"
                                  );
                                  jQuery(".loaderErroring").css(
                                    "display",
                                    "flex"
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
								   jQuery(".loaderVerifying").css("display", "none");
              					   jQuery(".loaderSending").css("display", "none");
              					   jQuery(".loaderTechErroring").css("display", "flex");
                                  return;
                                } else {
									/*
                                  jQuery("#step-1").fadeOut(500);
                                  jQuery("#step-2").fadeIn(500);
                                  jQuery("#submit-form").show();
                                  jQuery("#custom-registration-form").hide();
                                  jQuery(".firstStep").hide();
                                  jQuery(".main-container-email").show();
                                  var theOtpF = jQuery("#theOtpF");
                                  theOtpF.focus();
                                  loader.css("display", "none");
									*/
                                }
                              },
                              error: function (xhr, status, error) {
                                jQuery(".loaderVerifying").css(
                                  "display",
                                  "none"
                                );
                                jQuery(".loaderSending").css("display", "none");
                                jQuery(".loaderErroring").css(
                                  "display",
                                  "flex"
                                );
                                console.error("AJAX request failed:", error);
                              },
                            });
                          },
                          error: function (xhr, status, error) {
                            jQuery(".loaderSending").css("display", "none");
                            jQuery(".loaderErroring").css("display", "flex");
                            console.error("AJAX request failed:", error);
                          },
                        });
                      }
                    },
                    error: function (xhr, status, error) {
                      jQuery(".loaderVerifying").css("display", "none");
                      jQuery(".loaderSending").css("display", "none");
                      jQuery(".loaderErroring").css("display", "flex");
                      console.error("AJAX request failed:", error);
                    },
                  });
                },
                error: function (xhr, status, error) {
                  jQuery(".loaderVerifying").css("display", "none");
                  jQuery(".loaderSending").css("display", "none");
                  jQuery(".loaderErroring").css("display", "flex");
                  console.error("AJAX request failed:", error);
                },
              });
            }
          },
          error: function (xhr, status, error) {
            jQuery(".loaderVerifying").css("display", "none");
            jQuery(".loaderSending").css("display", "none");
            jQuery(".loaderErroring").css("display", "flex");
            console.error("AJAX request failed:", error);
          },
        });
      },
      error: function (xhr, status, error) {
        jQuery(".loaderVerifying").css("display", "none");
        jQuery(".loaderSending").css("display", "none");
        jQuery(".loaderErroring").css("display", "flex");
        console.error("AJAX request failed:", error);
      },
    });

    return false;
  });
});
