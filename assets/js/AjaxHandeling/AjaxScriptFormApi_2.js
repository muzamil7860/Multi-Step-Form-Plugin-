jQuery(document).ready(function ($) {
  $("#custom-registration-form").on("submit", function (el) {
    el.preventDefault();

    //---------------------------Personal Info Data Attributes----------------
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email = $("#email").val();
    var phone_number = $("#phone_number").val();
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();
    var terms_and_conditions = $("#terms_and_conditions").val();
    var errorContainerEmail = jQuery("#email-error-message");
    var errorContainer = $("#password-error-message");

    //---------------------Businessinfo Info Data Attributes---------------------------------

    var business_name = $("#business_name").val();
    var business_info_choice = $("#business_info_choice").val();
    var businessError = jQuery("#business-name-error-message");
    var loader = $(".loader");
    var userIdGlobal;
    var businessIdGlobal;

    // -------------------Businessinfo Info Conditions--------------------------------------

    if (business_name === "") {
      businessError.text("Please Fill The Business Name!");
      return false;
    }
    if (businessError.html().trim() == "Company Name already exists.") {
      return false;
    }

    if (businessError.html().trim() == "Please Fill The Business Name!") {
      return false;
    }

    // Show loader before making the AJAX request
    loader.css("display", "block");

    //--------------------Personal Info Ajax Functions-------------------------
    // First Ajax Call that is storing personal information to API
    $.ajax({
      type: "post",
      url: customFormFullApi.ajaxurl,
      data: {
        action: "custom_form_ajax_full_form",
        firstName: first_name,
        lastName: last_name,
        email: email,
        confirmEmail: email,
        phone: phone_number,
        password: password,
        doAgree: true,
        userExist: false,
        userID: "",
        companyName: "",
      },

      success: function (response) {
        console.log(response);
        // Parse the 'body' property of the 'data' property as JSON
        var responseData = JSON.parse(response.data.body);

        // Access the 'data' property inside the parsed response
        var dataInsideData = responseData.data;
        userIdGlobal = responseData.data;
        //alert(userIdGlobal);
        console.log(typeof dataInsideData);

        // Check if any field is empty
        if (
          !first_name ||
          !last_name ||
          !email ||
          !phone_number ||
          !password ||
          !confirm_password ||
          !terms_and_conditions
        ) {
          // Handle the case where any field is empty
          //  alert("(from ajax) Please fill in all fields.");
          return false;
        }

        // Check if password and confirm_password match
        if (password !== confirm_password) {
          // Handle the case where passwords do not match
          //  alert("(from ajax) Passwords do not match.");
          return false;
        }

        // Third Ajax Call to Storing user id (data) in sessions and database
        $.ajax({
          type: "post",
          url: customFormFullApi.ajaxurl,
          data: {
            action: "store_data_in_options_table",
            dataInsideData: dataInsideData,
            email: email,
          },
          success: function (storeResponse) {
            // alert(storeResponse);
            console.log(
              "Data stored in options table (UserID):",
              storeResponse
            );

            // Forth Ajax Call to Storing business name and business type with the help of userid
            $.ajax({
              type: "post",
              url: customFormFull2Api.ajaxurl,
              data: {
                action: "custom_form_ajax_full_form_two",
                userIdGlobal: userIdGlobal,
                email: email,
                phone: phone_number,
                business_name: business_name,
                business_info_choice: business_info_choice,
                //business_info_choice: "1623770635155",
              },

              success: function (response) {
                // Parse the 'body' property of the 'data' property as JSON
                var responseData = JSON.parse(response.data.body);
                // Access the 'data' property inside the parsed response
                var dataInsideData = responseData.data;
                businessIdGlobal = responseData.data;
                //  alert(businessIdGlobal);
                console.log(dataInsideData);

                // Fifth Ajax Call Storing user bussinessid (data) to Sesssions
                $.ajax({
                  type: "post",
                  url: customFormFullApi.ajaxurl,
                  data: {
                    action: "store_business_data_in_options_table",
                    dataInsideData: dataInsideData,
                    email: email,
                  },
                  success: function (storeResponse) {
                    //  alert(storeResponse);
                    console.log(
                      "Data stored in session bussiness",
                      storeResponse
                    );
                    // Sixth Ajax Call to send request for otp by sending bussiness id and user id
                    $.ajax({
                      type: "post",
                      url: customFormFull2Api.ajaxurl,
                      data: {
                        action: "function_opt",
                        user_id_global: userIdGlobal,
                        business_id_global: businessIdGlobal,
                      },

                      success: function (response) {
                        jQuery(".putEmail").text(email);
                        console.log(response);
                      },
                      complete: function () {
                        // Hide overlay and loader after the AJAX request is complete
                        loader.css("display", "none");
                      },
                    });
                  },
                });
              },
            });
          },
        });
      },
    });

    return false;
  });
});
