jQuery(document).ready(function ($) {
  // Handle the click event on the "Verify OTP" button
  $("#verifyOtp").on("click", function () {
    var otp = $("#otp").val();
    var loader = $(".loader");
    // Show loader before making the AJAX request
    loader.css("display", "block");

    // Make AJAX request
    $.ajax({
      type: "POST",
      url: customFormFullApi.ajaxurl, // WordPress AJAX URL
      data: {
        action: "verify_otp", // Action to be handled in WordPress functions.php
        otp: otp,
      },
      success: function (response) {
        console.log(response);
        console.log(response.data);
        console.log(response.data.body);
        var bodyData = JSON.parse(response.data.body);
        console.log(bodyData.success);
        var status = bodyData.success;
        if (status === true) {
          $("#otpError").html("").hide();
          // --------------------------------------------------------------
          var today = new Date();
          var futureDate = new Date(today);
          futureDate.setDate(today.getDate() + 30);

          // Format the future date (adjust as needed)
          var formattedDate = futureDate.toLocaleDateString("en-US", {
            year: "numeric",
            month: "long",
            day: "numeric",
          });
          // Update the text content dynamically

          $(".inner-div-email h6").html(
            '<h6 style="font-size:24px; font-weight:700; color:#32DC23; margin:0px; margin-bottom:5px">Your 30-day free trial has started!</h6>'
          );
          $(".inner-div-email p").html(
            "<p>Your free trial will end on <b>" +
              formattedDate +
              "</b><br>Please Explore SaasyPOS and feel free to contact us if you have any questions!<br> <span style='color:#32DC23'>Redirecting To Login Dashboard</span></p>"
          );

          $(".hidPara").css("display", "none");
          $(".hidInput").css("display", "none");
          $(".hidButton").css("display", "none");
          $(".showButton").css("display", "block");
          //---------------------------------------------------------------
          // Ajax to set the boolean value to true for local wp custom plugin table attribut verification_status
          $.ajax({
            type: "post",
            url: customFormFull2Api.ajaxurl,
            data: {
              action: "function_local_verification_status",
            },

            success: function (response) {
              console.log(response);
            },
          });
          //---------------------------------------------------------------
          $.ajax({
            type: "POST",
            url: customFormFullApi.ajaxurl, // WordPress AJAX URL
            data: {
              action: "after_verify_otp", // Action to be handled in WordPress functions.php
            },
            success: function (response) {
              console.log(response.success);

              // Assuming the response is already in JSON format
              var responseData = response; // No need to parse again

              // Parse the inner JSON string in the body property
              var bodyData = JSON.parse(responseData.data.body);
              console.log(bodyData);

              //  Redirect after a delay of 5 seconds (5000 milliseconds)
              setTimeout(function () {
                window.location.href =
                  "https://preapp.saasypos.com/#/pages/signin";
              }, 5000);
            },
            error: function (error) {
              console.log("AJAX error in finish Api:", error);
            },
            complete: function () {
              // Hide overlay and loader after the AJAX request is complete
              $(".loader").css("display", "none");
            },
          });
        } else {
          $("#otpError").html("Invalid OTP. Please enter a valid OTP.").show();
        }
      },
      error: function (error) {
        console.log("AJAX error:", error);
      },
      complete: function () {
        // Hide overlay and loader after the AJAX request is complete
        $(".loader").css("display", "none");
      },
    });
  });
});
