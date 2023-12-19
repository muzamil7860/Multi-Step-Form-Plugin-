jQuery(document).ready(function ($) {
  $("#resendEmail").on("click", function () {
    $.ajax({
      type: "post",
      url: customFormFull2Api.ajaxurl,
      data: {
        action: "function_opt_emailpage",
      },

      success: function (response) {
        console.log(response);
      },
    });
  });
});
