jQuery(document).ready(function ($) {
  // When business name field changes, make an AJAX call
  $("#business_name").on("change", function () {
    var businessName = $(this).val();
    var errorContainer = $("#business-name-error-message");
    var loader = $(".loader");
    // Show loader before making the AJAX request
    loader.css("display", "block");
    // Make AJAX request to custom API
    $.ajax({
      url: customEmailForm.ajaxurl, // Replace with your custom API endpoint
      type: "POST",
      data: {
        action: "custom_business_name_validation_ajax", // Keep the action identifier
        business_name: businessName,
        // security: custom2Form.ajax_nonce,
      },
      success: function (response) {
        if (response == "true") {
          //alert(response);
          // Email exists, show error message
          errorContainer.text("Company Name already exists.");
          errorContainer.css("color", "red");
        } else {
          // Email is unique, clear error message
          errorContainer.text("");
        }
      },
      error: function (error) {
        //  console.log(error);
      },
      complete: function () {
        // Hide overlay and loader after the AJAX request is complete
        loader.css("display", "none");
      },
    });
  });
});
