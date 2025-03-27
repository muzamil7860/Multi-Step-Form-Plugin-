jQuery(document).ready(function ($) {
  var localWpEmailSuccess = false;
  var ApiEmailSuccess = false;
  var verification_Status = false;
  $("#email").on("change", function () {
    var malFunctionCase = false;
    var mf1 = false;
    var mf2 = false;
    var errorContainer = jQuery("#email-error-message");
    var email = $("#email").val();
    var email_loader = $(".email-loader");
    var impBtn = $(".impBtn");
    // Validate the email using regex
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      errorContainer.text("Please enter a valid email address.");
      jQuery("#continueProcessButtonClose").hide();
      jQuery("#continueProcessButton").hide();
      jQuery("#tempClass").show();

      // toastr.error("Please enter a valid email address.", "Action Needed!");

      errorContainer.text("Please enter a valid email address.");
      return false;
    }
    // Show loader before making the AJAX request
    email_loader.css("visibility", "visible");
    impBtn.prop("disabled", true);
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
          if (
            (response.saasy_user_id == "" || response.business_id == "") &&
            response.verification_status == 0
          ) {
            // malFunctionCase = true;
            mf1 = true;
            console.log("mf1 (Although the userid and busid is empty) : ", mf1);
            // console.log("Malfunction Variable Value : ", malFunctionCase);
          }
          console.log(
            "Verification Status ([true Means => Not verified , false means: verified]) : ",
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
            console.log(response);
            if (response.error) {
              console.error(response);
              jQuery("#email").trigger("change");
              return;
            }
            var gettingData = JSON.parse(response.body);
            var modifiedResponse = gettingData.data;
            if (modifiedResponse == true) {
              ApiEmailSuccess = false; //false matlab api ma ha
              mf2 = true;
              if (mf1 == true && mf2 == true) {
                malFunctionCase = true;
              }
            } else {
              ApiEmailSuccess = true;
            }

            //Person who is a new user and never filled any form(" ")
            if (localWpEmailSuccess && ApiEmailSuccess) {
              errorContainer.text("");
              $("#continueProcessButtonClose").hide();
              $("#continueProcessButton").hide();
              $("#tempClass").show();
              console.log("In Local Wp Table :", localWpEmailSuccess);
              console.log("In Api  :", ApiEmailSuccess);
              console.log("Malfunction Status :", malFunctionCase);
              console.log("Verification Status  :", verification_Status);
              console.log("---------------------------------------------");
            }

            //Person who filled the two forms but not verified (In both api and local but not verified)
            else if (
              !localWpEmailSuccess &&
              !ApiEmailSuccess &&
              verification_Status &&
              !malFunctionCase
            ) {
              // errorContainer.text("In both api and local but not verified");
              errorContainer.text("Do you want to continue previous ?");
			  $(".loaderContinue").show();
              $("#continueProcessButtonClose").show();
              $("#continueProcessButton").show();
              $("#tempClass").show();
              console.log("In Local Wp Table :", localWpEmailSuccess);
              console.log("In Api  :", ApiEmailSuccess);
              console.log("Malfunction Status :", malFunctionCase);
              console.log("Verification Status  :", verification_Status);
              console.log("---------------------------------------------");
            }

            //Api ma nhi ha record lakin hmaray pass ha wp ma
            else if (
              !localWpEmailSuccess &&
              ApiEmailSuccess &&
              verification_Status &&
              !malFunctionCase
            ) {
              errorContainer.text("Do you want to continue previous ?");
			  $(".loaderContinue").show();
              $("#continueProcessButtonClose").show();
              $("#continueProcessButton").show();
              $("#tempClass").show();
              console.log("In Local Wp Table :", localWpEmailSuccess);
              console.log("In Api  :", ApiEmailSuccess);
              console.log("Malfunction Status :", malFunctionCase);
              console.log("Verification Status  :", verification_Status);
              console.log("new case added");
              console.log("---------------------------------------------");
            }

            //Person who filled the two forms and verified (In both api and local and  Verified)
            else if (
              !localWpEmailSuccess &&
              !ApiEmailSuccess &&
              !verification_Status &&
              !malFunctionCase
            ) {
              errorContainer.text(
                "Email already exists. Please choose a different one."
              );
              $("#continueProcessButtonClose").hide();
              $("#continueProcessButton").hide();
              $("#tempClass").show();
              console.log("In Local Wp Table :", localWpEmailSuccess);
              console.log("In Api  :", ApiEmailSuccess);
              console.log("Malfunction Status :", malFunctionCase);
              console.log("Verification Status  :", verification_Status);
              console.log("---------------------------------------------");
            }
            //if userid or bussid is not stored due to some error
            else if (malFunctionCase && !ApiEmailSuccess) {
              errorContainer.text(
                "Email already exists. Please choose a different one."
              );
              console.log("Condition meeted");
              $("#continueProcessButtonClose").hide();
              $("#continueProcessButton").hide();
              $("#tempClass").show();
              console.log("In Local Wp Table :", localWpEmailSuccess);
              console.log("In Api  :", ApiEmailSuccess);
              console.log("Malfunction Status :", malFunctionCase);
              console.log("Verification Status  :", verification_Status);
              console.log("---------------------------------------------");
              email_loader.css("visibility", "hidden");
              return;
            }
            //Person whoES EMAIL IS ONLY IN API MEANS BEFORE MAINTING LOCAL IT WAS THERE
            else if (
              !ApiEmailSuccess &&
              localWpEmailSuccess &&
              !malFunctionCase
            ) {
              errorContainer.text(
                "Email already exists. Please choose a different one."
              );
              $("#continueProcessButtonClose").hide();
              $("#continueProcessButton").hide();
              $("#tempClass").show();
              console.log("In Local Wp Table :", localWpEmailSuccess);
              console.log("In Api  :", ApiEmailSuccess);
              console.log("Verification Status  :", verification_Status);
              console.log("Malfunction Status :", malFunctionCase);
              console.log("---------------------------------------------");
            }
            email_loader.css("visibility", "hidden");
            impBtn.prop("disabled", false);
          },
         error: function (xhr, status, error) {
				console.error("AJAX request failed (1):", error);
				setTimeout(function () {
					jQuery("#email").trigger("change");
					email_loader.css("visibility", "visible");
					impBtn.prop("disabled", true);
				}, 5000);
			}
        });
      },
		error: function (xhr, status, error) {
			console.error("AJAX request failed (2):", error);
			setTimeout(function () {
				jQuery("#email").trigger("change");
				email_loader.css("visibility", "visible");
				impBtn.prop("disabled", true);
			}, 5000);
		}
    });
  });

  //Hadeling when continue process is clicked
  $("#continueProcessButton").on("click", function () {
	$(".loaderContinue").hide();
    // Make AJAX request
    var email = jQuery("#email").val();
    var loader = $(".loaderSending");
    loader.css("display", "flex");
    console.log("1", localWpEmailSuccess);
    console.log("2", ApiEmailSuccess);
    $.ajax({
      url: customFormFull2Api.ajaxurl,
      type: "POST",
      data: {
        action: "continueProcessButton",
        email: email,
        localWpEmailSuccess: localWpEmailSuccess,
        ApiEmailSuccess: ApiEmailSuccess,
      },
      success: function (response) {
        console.log(response);

        if (response.existing_row) {
          console.log(response.existing_row.id);
          $("#first_name").val(response.existing_row.first_name);
          $("#last_name").val(response.existing_row.last_name);
          $("#email").val(response.existing_row.email);
          $("#phone_number").val(response.existing_row.phone_number);
          $("#business_name").val(response.existing_row.business_name);
          $("#email-error-message").text("");
          $("#tempClass").hide();
          return;
        }
        const alpha = JSON.parse(response.body);
        // console.log(alpha.success);
        if (alpha.success) {
          console.log("OTP Sent to Email");
          jQuery(".firstStep").hide();
          jQuery(".putEmail").text(email);
          jQuery(".main-container-email").show();
          jQuery(".otpBox:first").focus();
		  jQuery("#resendEmail").removeAttr("disabled");
        } else {
          console.log("OTP Didnot sent to Email");
          console.log(alpha.message);
        }
      },
      error: function (error) {
        console.log("error: ", error);
      },
      complete: function () {
        loader.css("display", "none");
      },
    });
  });

  //Handeling close button
  $("#continueProcessButtonClose").on("click", function () {
//     if (!localWpEmailSuccess && !ApiEmailSuccess) { 
		$(".loaderContinue").hide();
      $("#email-error-message").text(
        "Email already exists. Please choose a different one."
      );
      $("#continueProcessButtonClose").hide();
      $("#continueProcessButton").hide();
      $("#tempClass").show();
      exit;
//     }  
    $("#email-error-message").text("");
    $("#tempClass").hide();
  });
});
