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

	//------------------------------------------------------------------------------------------------
	// Handle the input event on each OTP box
	/*
  $(".otpBox").on("input", function (e) {
    var currentBox = $(this);
    if (e.originalEvent.inputType === "deleteContentBackward") {
      if (currentBox.val() === "") {
        // Move focus to the previous input box when a digit is deleted
        var prevBox = currentBox.prev(".otpBox");
        if (prevBox.length) {
          prevBox.focus().val("");
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
	*/

	$(".otpBoox1").on("input", function (e) {
		//console.log("otpBoox1");
		$(".otpBoox2").focus();
	});
	$(".otpBoox2").on("input", function (e) {
		//	console.log("otpBoox2");
		$(".otpBoox3").focus();
	});
	$(".otpBoox3").on("input", function (e) {
		//	console.log("otpBoox3");
		$(".otpBoox4").focus();
	});
	$(".otpBoox4").on("input", function (e) {
		//	console.log("otpBoox4");
		$(".otpBoox5").focus();
	});
	$(".otpBoox5").on("input", function (e) {
		//	console.log("otpBoox5");
		$(".otpBoox6").focus();
	});


	// Handle the keydown event to properly handle backspace key
	$(".otpBox").on("keydown", function (e) {
		if (e.key === "Backspace" && this.selectionStart === 0) {
			var prevBox = $(this).prev(".otpBox");
			if (prevBox.length) {
				prevBox.focus().val("");
			}
		}
	});

	//-------------------------------------------------------------------------------------------------------------

	$(".otpBox").on("paste", function (event) {
		event.preventDefault();
		var clipboardData = event.originalEvent.clipboardData.getData("text");
		var otpArray = clipboardData.split("");
		var lastFilledIndex = 0;

		$(".otpBox").each(function (index) {
			if (otpArray[index]) {
				$(this).val(otpArray[index]);
				lastFilledIndex = index;
			} else {
				$(this).val("");
			}
		});

		$(".otpBox").eq(lastFilledIndex).focus();
	});

	//------------------------------------------------


	$("#verifyOtp").on("click", function () {
		var otp = oVerify();
		// alert(otp);
		var loader = $(".loaderVerifying");
		// Show loader before making the AJAX request
		loader.css("display", "flex");

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
					jQuery(".loaderVerifying").css("display", "none");
					jQuery(".loaderSending").css("display", "none");
					jQuery(".loaderErroring").css("display", "flex");
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
					$("#otpError").html("Verification code is invalid.").show();
					$(".loaderVerifying").css("display", "none");
					return;
				} else {
					jQuery('.verifying_init').html('Setting up your account.');
					console.log(response);
					$("#otpError").html("").hide();
					
					$.ajax({
						type: "post",
						url: customFormFull2Api.ajaxurl,
						data: {
							action: "function_local_verification_status",
						},

						success: function (response) {
							jQuery('.verifying_init').html('Getting your account info.');
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
							if (response.error) {
								console.error(response);
								jQuery(".loaderErroring").css("display", "flex");
								jQuery(".loaderSending").css("display", "none");
								jQuery(".loaderVerifying").css("display", "none");
								return;
							}
							console.log(response);
							var parsedData = JSON.parse(response.body);
							if (parsedData.success == false) {
								jQuery(".loaderVerifying").css("display", "none");
								jQuery(".loaderSending").css("display", "none");
								jQuery(".loaderTechErroring").css("display", "flex");
								console.error(
									"Error Occured in the Api responsible for After Verifying OTP"
								);
								console.error(parsedData.message);
								return;
							} else {
								jQuery('.verifying_init').html('Almost Done.');
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
						},
						error: function (error) {
							console.log("AJAX error in finish Api:", error);
							jQuery(".loaderVerifying").css("display", "none");
							jQuery(".loaderSending").css("display", "none");
							jQuery(".loaderTechErroring").css("display", "flex");
						},
						complete: function () {},
					});
				}
			},
			error: function (error) {
				console.log("AJAX error:", error);
				loader.css("display", "none");
			},
			complete: function () {
			
			},
		});
	});
});
