jQuery(document).ready(function ($) {
  $("#business_name").on("change", function () {
    var business_name = $("#business_name").val();
    var businessError = jQuery("#business-name-error-message");
    var impBtn = $(".impBtn");
    var email_loader_buzz = $(".email-loader-buzz");
    email_loader_buzz.css("visibility", "visible");
    impBtn.prop("disabled", true);
    $.ajax({
      url: customEmailForm.ajaxurl,
      type: "POST",
      data: {
        action: "custom_business_name_validation_ajax",
        business_name: business_name,
      },
      success: function (response) {
        console.log(response);
        if (response.error) {
          console.error(response);
		 jQuery("#business_name").trigger("change");
          return;
        }
        var gettingData = JSON.parse(response.body);
        var modifiedResponse = gettingData.data;
        if (modifiedResponse == true) {
          businessError.text("Company Name already exists.");
          businessError.css("color", "red");
          email_loader_buzz.css("visibility", "hidden");
          impBtn.prop("disabled", false);
          return;
        } else {
          businessError.text("");
		  email_loader_buzz.css("visibility", "hidden");
       	  impBtn.prop("disabled", false);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX request failed:", error);
		  setTimeout(function () {
			  email_loader_buzz.css("visibility", "visible");
			  impBtn.prop("disabled", true);
			  jQuery("#business_name").trigger("change");
		  }, 5000);
      }
    });
  });
});
