//comment added   
console.log("Script Working Successfully version time22");         



jQuery("#business_name").on("change", function () {
	var errorContainer = jQuery("#business-name-error-message");
	errorContainer.text("");
});

jQuery(".close-button").on("click", function () {
	jQuery(".loader").css('display','block');
  //   jQuery(".monster").delay(500).hide(0);
  //   jQuery(".page-template").css("overflow", "auto");
  location.reload(true); // true parameter forces a reload from the server and not from the cache
});

// Show the .monster element with a delay
//
/*
jQuery("#submit-button-trial").on("click", function () {
jQuery(".loader").show();
  jQuery(".monster").show();
	jQuery(".firstStep").show();
  jQuery(".page-template").css("overflow", "hidden");
	jQuery(".loader").hide();
});
*/

jQuery("#submit-button-trial").on("click", function () {
  jQuery('#header_custom').css('z-index', '0');
  jQuery("#monsterDiv").show();
// 	 if (jQuery('#monsterDiv').css('display') !== 'none') {
//         $('#back-to-top').css('display', 'none');
//       }
  var div = document.getElementById("monsterDiv");
  var backgroundImage = new Image();
  backgroundImage.src = getComputedStyle(div)
    .backgroundImage.replace('url("', "")
    .replace('")', "");

  backgroundImage.onload = function () {
    jQuery(".firstStep").show();
	jQuery(".close-button").show();
	jQuery("#first_name").focus();

  };

  jQuery(".page-template").css("overflow", "hidden");
});


jQuery("#button_header_cus_2").on("click", function () {
  jQuery('#header_custom').css('z-index', '0');
  jQuery("#monsterDiv").show();
// 	 if (jQuery('#monsterDiv').css('display') !== 'none') {
//         $('#back-to-top').css('display', 'none');
//       }
  var div = document.getElementById("monsterDiv");
  var backgroundImage = new Image();
  backgroundImage.src = getComputedStyle(div)
    .backgroundImage.replace('url("', "")
    .replace('")', "");

  backgroundImage.onload = function () {
    jQuery(".firstStep").show();
	jQuery(".close-button").show();
	jQuery("#first_name").focus();
  };

  jQuery(".page-template").css("overflow", "hidden");
});


jQuery("#button_header_cus_3").on("click", function () {
  jQuery("#stickey_sec").css("display", "none");
  jQuery(".eael-tabs-nav").css("display", "none");
  jQuery('#header_custom_pd').css('z-index', '0');
  jQuery('#header_custom_pm').css('z-index', '0');
  jQuery(".eael-tabs-nav").css("z-index", "1");
  jQuery("#monsterDiv").show();
// 	 if (jQuery('#monsterDiv').css('display') !== 'none') {
//         $('#back-to-top').css('display', 'none');
//       }
  var div = document.getElementById("monsterDiv");
  var backgroundImage = new Image();
  backgroundImage.src = getComputedStyle(div)
    .backgroundImage.replace('url("', "")
    .replace('")', "");

  backgroundImage.onload = function () {
    jQuery(".firstStep").show();
	jQuery(".close-button").show();
	jQuery("#first_name").focus();
  };

  jQuery(".page-template").css("overflow", "hidden");
});

jQuery("#button_header_cus_4").on("click", function () {
  jQuery("#stickey_sec").css("display", "none");
  jQuery(".eael-tabs-nav").css("display", "none");
  jQuery('#header_custom_pd').css('z-index', '0');
  jQuery('#header_custom_pm').css('z-index', '0');
  jQuery("#monsterDiv").show();
// 	 if (jQuery('#monsterDiv').css('display') !== 'none') {
//         $('#back-to-top').css('display', 'none');
//       }
  var div = document.getElementById("monsterDiv");
  var backgroundImage = new Image();
  backgroundImage.src = getComputedStyle(div)
    .backgroundImage.replace('url("', "")
    .replace('")', "");

  backgroundImage.onload = function () {
    jQuery(".firstStep").show();
	jQuery(".close-button").show();
	jQuery("#first_name").focus();
  };

  jQuery(".page-template").css("overflow", "hidden");
});




document
  .getElementById("custom-registration-form")
  .addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();
      return false;
    }
  });

// var registrationForm = document.getElementById("custom-registration-form");

// if (registrationForm) {
//   registrationForm.addEventListener("keydown", function (e) {
//     if (e.key === "Enter") {
//       e.preventDefault();
//       return false;
//     }
//   });
// }

function showPasswordStrengthMeter() {
  var passwordStrength = document.querySelector(".password-strength");
  passwordStrength.style.display = "block";
  jQuery("#suggestionModal").modal("show");
}

function checkPasswordStrength() {
  var password = document.getElementById("password").value;
  var meter = document.getElementById("password-strength-meter");
  var label = document.getElementById("password-strength-label");
  var progressBar = meter.querySelector(".progress-bar");
  var feedbackDiv = document.getElementById("password-feedback");
  feedbackDiv.style.color = "#B3B0B0";
  var strength = 0;

  // Check for various criteria and assign strength score
  strength += password.length >= 8 ? 1 : 0;
  strength += /[A-Z]/.test(password) ? 1 : 0;
  strength += /[a-z]/.test(password) ? 1 : 0;
  strength += /\d/.test(password) ? 1 : 0;
  strength += /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password) ? 1 : 0;

  // Update progress bar width and color based on strength
  progressBar.style.width = strength * 20 + "%";
  progressBar.className = "progress-bar";
  if (strength === 5) {
    progressBar.classList.add("bg-success");
  } else if (strength >= 3) {
    progressBar.classList.add("bg-info");
  } else if (strength >= 2) {
    progressBar.classList.add("bg-warning");
  } else {
    progressBar.classList.add("bg-danger");
  }

  // Update strength label text
  switch (strength) {
    case 5:
      label.textContent = "Very Strong";
      break;
    case 4:
    case 3:
      label.textContent = "Strong";
      break;
    case 2:
      label.textContent = "Moderate";
      break;
    case 1:
      label.textContent = "Weak";
      break;
    default:
      label.textContent = "Very Weak";
  }

  // Provide feedback on missing criteria
  var missingCriteria = [];
  if (!(password.length >= 8)) {
    missingCriteria.push("at least 8 characters");
  }
  if (!/[A-Z]/.test(password)) {
    missingCriteria.push("an uppercase letter");
  }
  if (!/[a-z]/.test(password)) {
    missingCriteria.push("a lowercase letter");
  }
  if (!/\d/.test(password)) {
    missingCriteria.push("a numeric digit");
  }
  if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password)) {
    missingCriteria.push("a special character");
  }

  // Update feedback div
  if (missingCriteria.length > 0) {
    feedbackDiv.innerHTML =
      "Password should contain " + missingCriteria.join(", ");
  } else {
    feedbackDiv.innerHTML = ""; // Clear feedback if all criteria are met
  }
}

//Attach the checkPasswordStrength function to the input event of the password field
var passwordVar = document.getElementById("password");
if (passwordVar) {
  document
    .getElementById("password")
    .addEventListener("input", checkPasswordStrength);
}

jQuery(document).ready(function ($) {
  jQuery(".Option3").css("background-color", "#142aef1a");
  jQuery(".Option3").css("border-color", "#1429ef");

  jQuery(".Option1").css("background-color", "white");
  jQuery(".Option1").css("border-color", "#ccc");

  jQuery(".Option2").css("background-color", "white");
  jQuery(".Option2").css("border-color", "#ccc");
});

// Add this function to your existing script
function selectBusinessInfoTest(choice) {
  // You can access the selected choice here
  console.log("Selected Business Info:", choice);
  jQuery("#business_info_choice").val(choice);
  var test = jQuery("#business_info_choice").val();
  console.log("Input test value:", test);

  if (choice == "1623770609262") {
    jQuery(".Option1").css("background-color", "#142aef1a");
    jQuery(".Option1").css("border-color", "#1429ef");

    jQuery(".Option2").css("background-color", "white");
    jQuery(".Option2").css("border-color", "#ccc");

    jQuery(".Option3").css("background-color", "white");
    jQuery(".Option3").css("border-color", "#ccc");
  } else if (choice == "1623770635155") {
    jQuery(".Option2").css("background-color", "#142aef1a");
    jQuery(".Option2").css("border-color", "#1429ef");

    jQuery(".Option1").css("background-color", "white");
    jQuery(".Option1").css("border-color", "#ccc");

    jQuery(".Option3").css("background-color", "white");
    jQuery(".Option3").css("border-color", "#ccc");
  } else if (choice == "1623770624890") {
    jQuery(".Option3").css("background-color", "#142aef1a");
    jQuery(".Option3").css("border-color", "#1429ef");

    jQuery(".Option1").css("background-color", "white");
    jQuery(".Option1").css("border-color", "#ccc");

    jQuery(".Option2").css("background-color", "white");
    jQuery(".Option2").css("border-color", "#ccc");
  }
}

// jQuery(document).ready(function ($) {
//   Inputmask({
//     mask: "(999) 999-9999",
//   }).mask("#phone_number");
// });

jQuery("#phone_number").on("input", function () {
  let value = jQuery(this).val().replace(/\D/g, "").substring(0, 10);
  let formattedValue = "";
  for (let i = 0; i < value.length; i++) {
    if (i == 3 || i == 6) {
      formattedValue += "-";
    }
    formattedValue += value[i];
  }
  jQuery(this).val(formattedValue);
});


function togglePasswordVisibility(fieldId) {
  var passwordField = document.getElementById(fieldId);
  var iconId = fieldId === "password" ? "aa" : "bb";
  var fieldType = passwordField.getAttribute("type");

  if (fieldType === "password") {
    jQuery("#" + iconId)
      .removeClass("fa-eye")
      .addClass("fa-eye-slash");
    passwordField.setAttribute("type", "text");
  } else {
    jQuery("#" + iconId)
      .removeClass("fa-eye-slash")
      .addClass("fa-eye");
    passwordField.setAttribute("type", "password");
  }
}

// ----------------------------------------------------------------------------------------------

function validateStep1() {
  // Validate fields for Step 1
  var firstName = document.getElementById("first_name").value;
  var lastName = document.getElementById("last_name").value;
  var email = document.getElementById("email").value;
  var phoneNumber = document.getElementById("phone_number").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirm_password").value;
  var termsCheckbox = document.getElementById("terms_and_conditions");
  var errorContainerEmail = jQuery("#email-error-message");
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  var businessName = document.getElementById("business_name").value;
  var businessError = jQuery("#business-name-error-message");

  var alpha = jQuery("#lastNameError");
  var beta = jQuery("#name-error-message");
  var ceta = jQuery("#phone-error-message");
  var deta = jQuery("#email-error-message");
  var eeta = jQuery("#password-error-message");
  var feta = jQuery("#password-feedback");

  // alert(email);
  if (errorContainerEmail.html().trim() == "") {
    if (
      firstName === "" ||
      lastName === "" ||
      email == "" ||
      phoneNumber === "" ||
      password === ""
      // ||
      // confirmPassword === "" ||
      // password !== confirmPassword
    ) {
      if (lastName === "") {
        alpha.text("Please Fill The Last Name!");
      }

      if (firstName === "") {
        beta.text("Please Fill The First Name!");
      }

      if (phoneNumber === "") {
        ceta.text("Please Fill The Phone Number!");
      }

      if (email == "") {
        deta.text("Please Fill The Email!");
        jQuery("#continueProcessButtonClose").hide();
        jQuery("#continueProcessButton").hide();
        jQuery("#tempClass").show();
        console.log(email);
        console.log(eeta);
      }
      if (password === "") {
        feta.css("color", "red");
        feta.text("Please Fill The Password!");
      }
      if (confirmPassword === "") {
        eeta.text("Please Fill The Confirm Password!");
      }

      return false;
    }

    if (phoneNumber.replace(/\D/g, "").length != 10) {
      ceta.text("Phone Number must have 10 digits!");
      return false;
    }

    if (!emailRegex.test(email)) {
      //       toastr.error(
      //         "Please enter a valid email address.",
      //         "Action Needed!"
      //       );
      deta.text("Please enter a valid email address.");
      //       jQuery("#continueProcessButtonClose").hide();
      //       jQuery("#continueProcessButton").hide();
      //       jQuery("#tempClass").show();
      return false;
    }
    //-----------------------------------------------------------------------------
    //handeling password
    // Regular expressions for validation
    var uppercaseRegex = /[A-Z]/;
    var lowercaseRegex = /[a-z]/;
    var digitRegex = /\d/;
    var specialCharRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/;

    // Check if all criteria are met
    if (
      password.length >= 8 &&
      uppercaseRegex.test(password) &&
      lowercaseRegex.test(password) &&
      digitRegex.test(password) &&
      specialCharRegex.test(password)
    ) {
    } else {
      jQuery("#password-feedback").css("color", "red");
      return false;
    }
    //-----------------------------------------------------------------------------
    if (businessName === "") {
      businessError.text("Please Fill The Business Name!");
      return false;
    }
//     if (businessError.html().trim() == "Company Name already exists.") {
//       return false;
//     }

    if (businessError.html().trim() == "Please Fill The Business Name!") {
      return false;
    }

    return true;
  }

  if (
    errorContainerEmail.html().trim() ==
    "Email already exists. Please choose a different one."
  ) {
    return false;
  }
}

// ---------------------------------------------------------------------------------------------------

function validateStep2() {
  // Validate fields for Step 2
  var businessName = document.getElementById("business_name").value;
  var businessError = jQuery("#business-name-error-message");

  // Add any additional validation logic for Step 2 if needed

  if (businessName === "") {
    businessError.text("Please Fill The Business Name!");
    return false;
  }
//   if (businessError.html().trim() == "Company Name already exists.") {
//     return false;
//   }

  if (businessError.html().trim() == "Please Fill The Business Name!") {
    return false;
  }

  return true;
}

// function nextStep() {
//   // Validate Step 1 before moving to Step 2
//   if (validateStep1()) {
//     jQuery("#step-1").hide();
//     jQuery("#step-2").show();
//     jQuery(".secondClass").css("background-color", "#1429ef");
//     jQuery(".secondClass").css("color", "white");
//     jQuery("#firstClass").removeClass("fa-1").addClass("fa-check");
//     jQuery("#secondClass").css("color", "white");
//   }
// }

function nextStep() {
  // Validate Step 1 before moving to Step 2
  if (validateStep1()) {
    // Hide Step 1 with transition
   // jQuery("#step-1").fadeOut(500, function () {
      // Callback function after fadeOut is complete
      // Show Step 2 with transition
      //jQuery("#step-2").fadeIn(500);
      //--------------------------------------------------------
     //  jQuery("#submit-form").show();
     // jQuery("#custom-registration-form").hide();
     // jQuery(".firstStep").hide();
     // jQuery(".main-container-email").show();
      //--------------------------------------------------------
  //  });

    // Additional styling changes with transitions
    jQuery(".secondClass").css({
      "background-color": "#1429ef",
      color: "white",
      transition: "background-color 0.5s, color 0.5s",
    });

    jQuery("#firstClass").removeClass("fa-1").addClass("fa-check");
    // jQuery("#theOne").css("padding", "12px !important");
    // jQuery("#theOne").removeClass(".theOne");
    // jQuery("#firstClass").css("font-size", "14px !important");

    jQuery("#secondClass").css({
      color: "white",
      transition: "color 0.5s",
    });
  }
}

function changeEmail() {
  // Hide Step 1 with transition
  jQuery("#step-1").fadeIn(500, function () {
    // Callback function after fadeOut is complete
    // Show Step 2 with transition
    //jQuery("#step-2").fadeIn(500);
    //--------------------------------------------------------
    jQuery("#submit-form").hide();
    jQuery("#custom-registration-form").show();
    jQuery(".firstStep").show();
    jQuery(".main-container-email").hide();
    jQuery("#email").val("");
    jQuery("#business_name").val("");
    //--------------------------------------------------------
  });
}

function prevStep() {
  // Hide Step 2 with transition
  jQuery("#step-2").fadeOut(500, function () {
    // Callback function after fadeOut is complete
    // Show Step 1 with transition
    jQuery("#step-1").fadeIn(500);
  });

  // Additional styling changes with transitions
  jQuery(".secondClass").css({
    "background-color": "#DEF1FD",
    color: "#9E9E9E",
    transition: "background-color 0.5s, color 0.5s",
  });

  jQuery("#firstClass").removeClass("fa-check").addClass("fa-1");

  jQuery("#secondClass").css({
    color: "#1429ef",
    transition: "color 0.5s",
  });
}

function emailStep() {
  // Validate Step 2 before submitting the form
  if (validateStep2()) {
    jQuery("#submit-form").show();
    jQuery("#custom-registration-form").hide();
    jQuery(".main-container1").hide();
    jQuery(".main-container-email").show();
  }
}
