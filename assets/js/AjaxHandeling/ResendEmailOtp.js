jQuery(document).ready(function ($) {
  toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: "toast-bottom-center",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
  };
  $("#resendEmail").on("click", function () {
    $.ajax({
      type: "post",
      url: customFormFull2Api.ajaxurl,
      data: {
        action: "function_opt_emailpage",
      },

      success: function (response) {
        console.log(response);
        if (response.error) {
          console.error(response);
          jQuery(".loaderErroring").css("display", "flex");
          return;
        }
        const parsedResponse = JSON.parse(response.body);
        if (parsedResponse.success == false) {
          console.error(response);
          console.error(parsedResponse.message);
          console.error(parsedResponse.data.Message);
          console.error(
            "Error Occured in the Api responsible for ReSending OTP"
          );
         toastr.error("Unable to send verification code. Please refresh your page.");
          return;
        } else {
          console.log("Resend Otp Api Called ");
          toastr.success("Verification Code Resent");
        }
      },
      error: function (error) {
        console.log("These are the errors", error);
      },
    });
  });
});
