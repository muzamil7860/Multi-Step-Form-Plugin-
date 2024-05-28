jQuery(document).ready(function ($) {
  function setCookieForSignupTrack(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + expiry * 24 * 60 * 60 * 1000);
    document.cookie =
      key + "=" + value + ";path=/" + ";expires=" + expires.toUTCString();
  }

  var today = new Date();
  var futureDate = new Date(today);
  futureDate.setDate(today.getDate() + 30);

  // Format the future date (adjust as needed)
  var formattedDate = futureDate.toLocaleDateString("en-US", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });

  $("#dateFormat").html(formattedDate);

  function oVerify() {
    var otp = $(".otpBox")
      .map(function () {
        return $(this).val();
      })
      .get()
      .join("");
    return otp;
  }
	

  // Handle the focus event on each OTP box
        $(".otpBox").on("focus", function () {
            $(this).addClass("visited");
        });

        // Handle the input event on each OTP box
        $(".otpBox").on("input", function (e) {
            var currentBox = $(this);
            if (e.originalEvent.inputType === "deleteContentBackward") {
                if (currentBox.val() === '') {
                    // Move focus to the previous input box when a digit is deleted
                    var prevBox = currentBox.prev(".otpBox");
                    if (prevBox.length) {
                        prevBox.focus().val('');
                    }
                }
            } else {
                // Move focus to the next input box when a number is entered
                var nextBox = currentBox.next(".otpBox");
                if (nextBox.length) {
                    nextBox.focus();
                }
                // Set the cursor position to the end of the input
                this.setSelectionRange(this.value.length, this.value.length);
                // Trigger verification when the last box is filled
                if ($(".otpBox:last").val().length === 1) {
                    oVerify();
                }
            }
        });

        // Handle the keydown event to properly handle backspace key
        $(".otpBox").on("keydown", function (e) {
            if (e.key === "Backspace" && this.selectionStart === 0) {
                var prevBox = $(this).prev(".otpBox");
                if (prevBox.length) {
                    prevBox.focus().val('');
                }
            }
        });
    

  //------------------------------------------------

  $("#verifyOtp").on("click", function () {
    var otp = oVerify();
    // alert(otp);
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
        if (response.error) {
          console.error(response);
          jQuery(".loaderError").css("display", "block");
          return;
        }
        const parsedResponse = JSON.parse(response.body);
        if (parsedResponse.success == false) {
          console.error(response);
          console.error(
            "Error Occured in the Api responsible for Verifying OTP"
          );
          console.error(parsedResponse.message);
          console.error(parsedResponse.data.Message);
          $("#otpError").html("Invalid OTP. Please enter a valid OTP.").show();
		  $(".loader").css("display", "none");
          return;
        } else {
          console.log(response);
          $("#otpError").html("").hide();
          // --------------------------------------------------------------

          //$(".main-container-email").css("display", "none");
          //$(".main-container-after-email").css("display", "block");

<<<<<<< HEAD
          $(".inner-div-email h6").html(
            '<h6 style="font-size:24px; font-weight:500; color:#23DC32; margin:0px; margin-bottom:5px">Your 30-day free trial has started!</h6>'
          );
          $(".inner-div-email p").html(
            "<p>Your free trial will end on <span style='font-weight:500'>" +
              formattedDate +
              "</span><br>Please Explore SaasyPOS and feel free to contact us if you have any questions!<br> <span style='color:#23DC32'>Redirecting To Login Dashboard</span></p>"
          );

          $(".hidPara").css("display", "none");
          $(".hidInput").css("display", "none");
          $(".hidButton").css("display", "none");
          $(".showButton").css("display", "block");
=======
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
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
            url: customFormFull2Api.ajaxurl, // WordPress AJAX URL
            data: {
              action: "after_verify_otp", // Action to be handled in WordPress functions.php
            },
            success: function (response) {
<<<<<<< HEAD
              console.log(response.success);

              // Assuming the response is already in JSON format
              var responseData = response; // No need to parse again

              // Parse the inner JSON string in the body property
              var bodyData = JSON.parse(responseData.data.body);
              console.log(bodyData);

              //  Redirect after a delay of 5 seconds (5000 milliseconds)
              //setTimeout(function () {
              //   window.location.href =
              //     "https://preapp.saasypos.com/#/pages/signin";
              // }, 5000);
              setTimeout(function () {
                window.location.href = customFormFull2Api.verification_url;
              }, 5000);
=======
              if (response.error) {
                console.error(response);
                jQuery(".loaderError").css("display", "block");
                return;
              }
              console.log(response);
              var parsedData = JSON.parse(response.body);
              if (parsedData.success == false) {
                console.error(
                  "Error Occured in the Api responsible for After Verifying OTP"
                );
                console.error(parsedData.message);
                return;
              } else {
                var responseData = response;
                // Parse the inner JSON string in the body property
                var bodyData = JSON.parse(responseData.body);
                console.log(bodyData);
                //window.location.href = customFormFull2Api.verification_url;
                var domain = window.location.hostname;
                domain = domain.replace(/\./g, "_");
                var setAlred = domain + "alred";
                setCookieForSignupTrack(setAlred, JSON.stringify(1), "1");
                window.location.href =
                  "/signup-success/?signup-plan=free-trial";

                // Update the text content dynamically
                // var seconds = 59;
                // function updateCountdown() {
                //   $("#countdown").text(seconds);
                //   if (seconds === 0) {
                //     return 0;
                //   } else {
                //     seconds--;
                //   }
                // }
                // // Call the updateCountdown function every second
                // setInterval(updateCountdown, 1000);

                // setTimeout(function () {
                //   window.location.href = customFormFull2Api.verification_url;
                // }, 60000);
              }
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
            },
            error: function (error) {
              console.log("AJAX error in finish Api:", error);
            },
            complete: function () {
             
            },
          });
        }
      },
      error: function (error) {
        console.log("AJAX error:", error);
      },
      complete: function () {
        // Hide overlay and loader after the AJAX request is complete
      //  $(".loader").css("display", "none");
      },
    });
  });
});
