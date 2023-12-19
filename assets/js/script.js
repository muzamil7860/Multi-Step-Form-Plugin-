document
  .getElementById("custom-registration-form")
  .addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();
      return false;
    }
  });

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
document
  .getElementById("password")
  .addEventListener("input", checkPasswordStrength);

jQuery(document).ready(function ($) {
  jQuery(".Option3").css("background-color", "rgb(35 220 50 / 30%)");
  jQuery(".Option3").css("border-color", "#23DC32");

  jQuery(".Option1").css("background-color", "white");
  jQuery(".Option1").css("border-color", "#ccc");

  jQuery(".Option2").css("background-color", "white");
  jQuery(".Option2").css("border-color", "#ccc");
});

// Add this function to your existing script
function selectBusinessInfo(choice) {
  // You can access the selected choice here
  console.log("Selected Business Info:", choice);
  jQuery("#business_info_choice").val(choice);
  var test = jQuery("#business_info_choice").val();
  console.log("Input test value:", test);

  if (choice == "1623770609262") {
    jQuery(".Option1").css("background-color", "rgb(35 220 50 / 30%)");
    jQuery(".Option1").css("border-color", "#23DC32");

    jQuery(".Option2").css("background-color", "white");
    jQuery(".Option2").css("border-color", "#ccc");

    jQuery(".Option3").css("background-color", "white");
    jQuery(".Option3").css("border-color", "#ccc");
  } else if (choice == "1623770635155") {
    jQuery(".Option2").css("background-color", "rgb(35 220 50 / 30%)");
    jQuery(".Option2").css("border-color", "#23DC32");

    jQuery(".Option1").css("background-color", "white");
    jQuery(".Option1").css("border-color", "#ccc");

    jQuery(".Option3").css("background-color", "white");
    jQuery(".Option3").css("border-color", "#ccc");
  } else if (choice == "1623770624890") {
    jQuery(".Option3").css("background-color", "rgb(35 220 50 / 30%)");
    jQuery(".Option3").css("border-color", "#23DC32");

    jQuery(".Option1").css("background-color", "white");
    jQuery(".Option1").css("border-color", "#ccc");

    jQuery(".Option2").css("background-color", "white");
    jQuery(".Option2").css("border-color", "#ccc");
  }
}

jQuery(document).ready(function ($) {
  Inputmask({
    mask: "(999) 999-9999",
  }).mask("#phone_number");
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

  // var phoneNumberJquery = jQuery("#phone_number");
  // console.log(phoneNumberJquery.length);

  var alpha = jQuery("#lastNameError");
  var beta = jQuery("#name-error-message");
  var ceta = jQuery("#phone-error-message");
  var deta = jQuery("#email-error-message");
  var eeta = jQuery("#password-error-message");
  var feta = jQuery("#password-feedback");

  if (errorContainerEmail.html().trim() == "") {
    if (
      firstName === "" ||
      lastName === "" ||
      email === "" ||
      phoneNumber === "" ||
      password === "" ||
      confirmPassword === "" ||
      password !== confirmPassword
    ) {
      if (lastName === "") {
        alpha.text("Please Fill The Last Name !");
      }

      if (firstName === "") {
        beta.text("Please Fill The First Name !");
      }

      if (phoneNumber === "") {
        ceta.text("Please Fill The Phone Number !");
        console.log(phoneNumber.length);
      }

      if (email === "") {
        deta.text("Please Fill The Email !");
      }
      if (password === "") {
        feta.text("Please Fill The Password !");
      }
      if (confirmPassword === "") {
        eeta.text("Please Fill The Confirm Password !");
      }

      return false;
    }

    if (phoneNumber.replace(/\D/g, "").length != 10) {
      ceta.text("Phone Number must have 10 digits!");
      return false;
    }

    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address.");
      return false;
    }

    // Check if the terms and conditions checkbox is checked
    if (!termsCheckbox.checked) {
      toastr.error(
        "Please agree to the terms and conditions.",
        "Terms And Conditions!"
      );
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
    // alert("Please fill in all fields for Step 2.");
    businessError.text("Please Fill The Business Name!");
    return false;
  }
  if (
    businessError.html().trim() ==
    "Company Name already exists. Please choose a different one."
  ) {
    return false;
  }

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
//     jQuery(".secondClass").css("background-color", "#23DC32");
//     jQuery(".secondClass").css("color", "white");
//     jQuery("#firstClass").removeClass("fa-1").addClass("fa-check");
//     jQuery("#secondClass").css("color", "white");
//   }
// }

function nextStep() {
  // Validate Step 1 before moving to Step 2
  if (validateStep1()) {
    // Hide Step 1 with transition
    jQuery("#step-1").fadeOut(500, function () {
      // Callback function after fadeOut is complete
      // Show Step 2 with transition
      jQuery("#step-2").fadeIn(500);
    });

    // Additional styling changes with transitions
    jQuery(".secondClass").css({
      "background-color": "#23DC32",
      color: "white",
      transition: "background-color 0.5s, color 0.5s",
    });

    jQuery("#firstClass").removeClass("fa-1").addClass("fa-check");

    jQuery("#secondClass").css({
      color: "white",
      transition: "color 0.5s",
    });
  }
}

// function prevStep() {
//   jQuery("#step-2").hide();
//   jQuery("#step-1").show();
//   jQuery(".secondClass").css("background-color", "#DEF1FD");
//   jQuery(".secondClass").css("color", "#9E9E9E");
//   jQuery("#firstClass").removeClass("fa-check").addClass("fa-1");
//   jQuery("#secondClass").css("color", "#23DC32");
// }

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
    color: "#23DC32",
    transition: "color 0.5s",
  });
}

function emailStep() {
  // Validate Step 2 before submitting the form
  if (validateStep2()) {
    jQuery("#submit-form").show();
    jQuery("#custom-registration-form").hide();
  }
}
