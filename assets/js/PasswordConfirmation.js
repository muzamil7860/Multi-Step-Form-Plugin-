<<<<<<< HEAD
jQuery(document).ready(function ($) {
  // When password field changes,
  $("#confirm_password").on("input", function () {
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

jQuery(document).ready(function ($) {
  // When password field changes,
  $("#password").on("input", function () {
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();
    var errorContainer = $("#password-error-message");
=======
// jQuery(document).ready(function ($) {
//   // When password field changes,
//   $("#confirm_password").on("input", function () {
//     var password = $("#password").val();
//     var confirm_password = $("#confirm_password").val();
//     var errorContainer = $("#password-error-message");
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d

//     if (password !== confirm_password) {
//       errorContainer.text("Password Doesn't Match");
//       return false;
//     } else {
//       errorContainer.text("");
//       return true;
//     }
//   });
// });

// jQuery(document).ready(function ($) {
//   // When password field changes,
//   $("#password").on("input", function () {
//     var password = $("#password").val();
//     var confirm_password = $("#confirm_password").val();
//     var errorContainer = $("#password-error-message");

//     if (password !== confirm_password) {
//       errorContainer.text("Password Doesn't Match");
//       return false;
//     } else {
//       errorContainer.text("");
//       return true;
//     }
//   });
// });
