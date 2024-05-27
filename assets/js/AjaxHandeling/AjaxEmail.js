jQuery(document).ready(function ($) {
  var localWpEmailSuccess = false;
  var ApiEmailSuccess = false;
  var verification_Status = false;
  $("#email").on("change", function () {
    var errorContainer = $("#email-error-message");
    var email = $(this).val();
    var loader = $(".loader");
    // Validate the email using regex
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      toastr.error("Please enter a valid email address.", "Action Needed!");
      return false;
    }
    // Show loader before making the AJAX request
    loader.css("display", "block");

    // Make AJAX request to local wp table
    $.ajax({
      url: customFormFullApi.ajaxurl,
      type: "POST",
      data: {
        action: "custom_email_validation_ajax_local",
        email: email,
      },
      success: function (response) {
        console.log(response);
        if (response) {
          localWpEmailSuccess = false;
          if (response.verification_status == 0) {
            verification_Status = true;
          } else {
            verification_Status = false;
          }
          console.log(
            "Verfication status O true 1 false : ",
            verification_Status
          );
          console.log("LocalWpemail Status :", localWpEmailSuccess);
        } else {
          localWpEmailSuccess = true;
          console.log("LocalWpemail Status :", localWpEmailSuccess);
        }

        // -----------------------------------

        // Make AJAX request to custom API
        $.ajax({
          url: customEmailForm.ajaxurl,
          type: "POST",
          data: {
            action: "custom_email_validation_ajax",
            email: email,
          },
          success: function (response) {
            if (response == "true") {
              ApiEmailSuccess = false;
            } else {
              // Email is unique, clear error message
              ApiEmailSuccess = true;
            }

            //Person who is a new user and never filled any form(" ")
            if (localWpEmailSuccess && ApiEmailSuccess) {
              errorContainer.text("");
              $("#continueProcessButtonClose").hide();
              $("#continueProcessButton").hide();
              $("#tempClass").show();
            }

            //Person who filled the two forms but not verified (In both api and local but not verified)
            else if (
              !localWpEmailSuccess &&
              !ApiEmailSuccess &&
              verification_Status
            ) {
              // errorContainer.text("In both api and local but not verified");
              errorContainer.text("Do you want to continue previous ?");
              $("#continueProcessButtonClose").show();
              $("#continueProcessButton").show();
              $("#tempClass").show();
            }

            //Person who filled the two forms and verified (In both api and local and  Verified)
            else if (
              !localWpEmailSuccess &&
              !ApiEmailSuccess &&
              !verification_Status
            ) {
              errorContainer.text(
                "Email already exists. Please choose a different one."
              );
              $("#continueProcessButtonClose").hide();
              $("#continueProcessButton").hide();
              $("#tempClass").show();
            }

            //Person who filled the first form and left(Sirf Local ma ha)
            else if (!localWpEmailSuccess) {
              // errorContainer.text("Sirf Local ma ha");
              errorContainer.text("Do you want to continue previous ?");
              $("#continueProcessButtonClose").show();
              $("#continueProcessButton").show();
              $("#tempClass").show();
            }

            //Person whoES EMAIL IS ONLY IN API MEANS BEFORE MAINTING LOCAL IT WAS THERE
            else if (!ApiEmailSuccess) {
              errorContainer.text(
                "Email already exists. Please choose a different one."
              );
              $("#continueProcessButtonClose").hide();
              $("#continueProcessButton").hide();
              $("#tempClass").show();
            }
          },
          error: function (error) {
            console.log(error);
          },
          complete: function () {
            // Hide overlay and loader after the AJAX request is complete
            loader.css("display", "none");
          },
        });

        //------------------------------------
      },
    });
  });

  //Hadeling when continue process is clicked
  $("#continueProcessButton").on("click", function () {
    // Make AJAX request
    var email = jQuery("#email").val();
    var loader = $(".loader");
    loader.css("display", "block");
    $.ajax({
      url: customFormFull2Api.ajaxurl,
      type: "POST",
      data: {
        action: "continueProcessButton",
        email: email,
      },
      success: function (response) {
        console.log(response);

        if (response.business_name !== null) {
          //  window.location.href = customFormFull2Api.verification_url;
          jQuery(".main-container1").hide();
          jQuery(".putEmail").text(email);
          jQuery(".main-container-email").show();
        }

        $("#first_name").val(response.first_name);
        $("#last_name").val(response.last_name);
        $("#email").val(response.email);
        // $("#password").val(response.password);
        // $("#confirm_password").val(response.email);
        //  $("#terms_and_conditions").val("1");
        $("#phone_number").val(response.phone_number);
        $("#business_name").val(response.business_name);
        $("#business_info_choice").val(response.business_info_choice);
        $("#email-error-message").text("");
        $("#tempClass").hide();
      },
      complete: function () {
        loader.css("display", "none");
      },
    });
  });

  //Handeling close button
  $("#continueProcessButtonClose").on("click", function () {
    if (!localWpEmailSuccess && !ApiEmailSuccess) {
      $("#email-error-message").text(
        "Email already exists. Please choose a different one."
      );
      $("#continueProcessButtonClose").hide();
      $("#continueProcessButton").hide();
      $("#tempClass").show();
      exit;
    }
    $("#email-error-message").text("");
    $("#tempClass").hide();
  });
});
