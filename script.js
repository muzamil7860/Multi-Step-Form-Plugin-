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
}

// Attach the checkPasswordStrength function to the input event of the password field
document
  .getElementById("password")
  .addEventListener("input", checkPasswordStrength);

// Add this function to your existing script
function selectBusinessInfo(choice) {
  // You can access the selected choice here
  console.log("Selected Business Info:", choice);
  jQuery("#business_info_choice").val(choice);
  var test = jQuery("#business_info_choice").val();
  console.log("Input test value:", test);

  if (choice === "Option1") {
    jQuery(".Option1").css("background-color", "rgb(35 220 50 / 30%)");
    jQuery(".Option1").css("border-color", "#23DC32");

    jQuery(".Option2").css("background-color", "white");
    jQuery(".Option2").css("border-color", "#ccc");

    jQuery(".Option3").css("background-color", "white");
    jQuery(".Option3").css("border-color", "#ccc");
  } else if (choice === "Option2") {
    jQuery(".Option2").css("background-color", "rgb(35 220 50 / 30%)");
    jQuery(".Option2").css("border-color", "#23DC32");

    jQuery(".Option1").css("background-color", "white");
    jQuery(".Option1").css("border-color", "#ccc");

    jQuery(".Option3").css("background-color", "white");
    jQuery(".Option3").css("border-color", "#ccc");
  } else if (choice === "Option3") {
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

function validateStep1() {
  // Validate fields for Step 1
  var firstName = document.getElementById("first_name").value;
  var lastName = document.getElementById("last_name").value;
  var email = document.getElementById("email").value;
  var phoneNumber = document.getElementById("phone_number").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirm_password").value;

  if (
    firstName === "" ||
    lastName === "" ||
    email === "" ||
    phoneNumber === "" ||
    password === "" ||
    confirmPassword === ""
  ) {
    alert("Please fill in all fields for Step 1.");
    return false;
  }

  // Validate email format
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert("Please enter a valid email address.");
    return false;
  }

  // Validate password match
  if (password !== confirmPassword) {
    alert("Passwords do not match.");
    return false;
  }

  return true;
}

function validateStep2() {
  // Validate fields for Step 2
  var businessName = document.getElementById("business_name").value;
  var businessAddress = document.getElementById("business_address").value;
  var businessPhone = document.getElementById("business_phone").value;

  // Add any additional validation logic for Step 2 if needed

  if (businessName === "" || businessAddress === "" || businessPhone === "") {
    alert("Please fill in all fields for Step 2.");
    return false;
  }

  return true;
}

function nextStep() {
  // Validate Step 1 before moving to Step 2
  if (validateStep1()) {
    jQuery("#step-1").hide();
    jQuery("#step-2").show();
    jQuery(".secondClass").css("background-color", "#23DC32");
    jQuery(".secondClass").css("color", "white");
    jQuery("#firstClass").removeClass("fa-1").addClass("fa-check");
    jQuery("#secondClass").css("color", "white");
  }
}

function prevStep() {
  jQuery("#step-2").hide();
  jQuery("#step-1").show();
  jQuery(".secondClass").css("background-color", "#DEF1FD");
  jQuery(".secondClass").css("color", "#9E9E9E");
  jQuery("#firstClass").removeClass("fa-check").addClass("fa-1");
  jQuery("#secondClass").css("color", "#23DC32");
}

function emailStep() {
  // Validate Step 2 before submitting the form
  if (validateStep2()) {
    jQuery("#submit-form").show();
    jQuery("#custom-registration-form").hide();
  }
}
