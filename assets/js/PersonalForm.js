jQuery(document).ready(function ($) {
  // When password field changes,
  function closeForm() {
    document.querySelector(".main-container1").style.display = "none";
  }
  $("#first_name").on("change", function () {
    var beta = jQuery("#name-error-message");
    beta.text("");
  });

  $("#last_name").on("change", function () {
    var alpha = jQuery("#lastNameError");
    alpha.text("");
  });

  $("#phone_number").on("change", function () {
    var phoneNumber = document.getElementById("phone_number").value;
    var ceta = jQuery("#phone-error-message");

    if (phoneNumber.replace(/\D/g, "").length != 10) {
      ceta.text("Phone Number must have 10 digits!");
      return false;
    } else {
      ceta.text("");
      //  console.log(phoneNumber);
      return true;
    }
  });
});



//resend button timer

jQuery(document).ready(function ($) {
  var resendButton = $("#resendEmail");
  var countdownSpan = $("#countdownAlpha");
  var countdownDuration = 60; // in seconds

  function updateCountdown(seconds) {
    countdownSpan.text(seconds + " seconds");
  }

  function enableResendButton() {
    resendButton.prop("disabled", false);
    countdownSpan.hide();
    resendButton.html("Resend Code");
  }

  function startTimer() {
    resendButton.prop("disabled", true);
    countdownSpan.show();

    var secondsLeft = countdownDuration;
    updateCountdown(secondsLeft);

    var countdownInterval = setInterval(function () {
      secondsLeft--;
      updateCountdown(secondsLeft);

      if (secondsLeft <= 0) {
        clearInterval(countdownInterval);
        enableResendButton();
      }
    }, 1000); // update every 1 second (1000 milliseconds)
  }

  resendButton.on("click", startTimer);
});
