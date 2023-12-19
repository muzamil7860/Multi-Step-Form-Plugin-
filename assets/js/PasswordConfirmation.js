jQuery(document).ready(function ($) {
  // When password field changes,
  $("#confirm_password").on("blur", function () {
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();
    var errorContainer = $("#password-error-message");

    if (password !== confirm_password) {
      errorContainer.text("Password Doesn't Match");
      return false;
    } else {
      errorContainer.text("");
      return true;
    }
  });
});
