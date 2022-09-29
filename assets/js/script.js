$(document).ready(function(e) {
  $("#loginForm").on('submit', (function(e) {
    e.preventDefault();
    $.ajax({
      url: "functions/login.php",
      type: "POST",
      dataType: 'json',
      data: {
        "uname": $('input[name="userName"]').val(),
        "password": $('input[name="userPassword"]').val(),
      },
      success: function(response) {
        if (response.type == "error") {
          $("#status-response").attr("class", "error");
        } else if (response.type == "message") {
          $("#status-response").attr("class", "success");
        }
        $("#status-response").html(response.text);
      },
      error: function() {}
    });
  }));

  $("#registerForm").on('submit', (function(e) {
    e.preventDefault();
    $.ajax({
      url: "functions/register.php",
      type: "POST",
      dataType: 'json',
      data: {
        "fname": $('input[name="firstName"]').val(),
        "lname": $('input[name="lastName"]').val(),
        "uname": $('input[name="userName"]').val(),
        "password": $('input[name="userPassword"]').val(),
        "g-recaptcha-response": $('textarea[id="g-recaptcha-response"]').val()
      },
      success: function(response) {
        if (response.type == "error") {
          $("#status-response").attr("class", "error");
        } else if (response.type == "message") {
          $("#status-response").attr("class", "success");
        }
        $("#status-response").html(response.text);
      },
      error: function() {}
    });
  }));

});