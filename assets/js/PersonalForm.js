jQuery(document).ready(function ($) {
  // When password field changes,

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
      console.log(phoneNumber);
      return true;
    }
  });
});
