// jQuery(document).ready(function ($) {
//   // When email field changes, make an AJAX call
//   $("#email").on("change", function () {
//     var email = $(this).val();
//     var errorContainer = $("#email-error-message");
//     var loader = $(".loader");

//     // Show loader before making the AJAX request
//     loader.css("display", "block");

//     // Make AJAX request to custom API
//     $.ajax({
//       url: customEmailForm.ajaxurl, // Replace with your custom API endpoint
//       type: "POST",
//       data: {
//         action: "custom_email_validation_ajax", // Keep the action identifier
//         email: email,
//         //  security: customForm.ajax_nonce,
//       },
//       success: function (response) {
//         console.log(response);
//         if (response == "true") {
//           //alert(response);
//           // Email exists, show error message
//           errorContainer.text(
//             "Email already exists. Please choose a different one."
//           );
//           errorContainer.css("color", "red");
//         } else {
//           // Email is unique, clear error message
//           errorContainer.text("");
//         }
//       },
//       error: function (error) {
//         console.log(error);
//       },
//       complete: function () {
//         // Hide overlay and loader after the AJAX request is complete
//         loader.css("display", "none");
//       },
//     });
//   });
// });
