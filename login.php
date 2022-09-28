<!DOCTYPE html>

<head>
  <title>login</title>
  <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="assets/css/normalize.css" type="text/css">
  <link rel="stylesheet" href="assets/css/styles.css" type="text/css">
  <script src="components/jquery/jquery-3.2.1.min.js"></script>
  <script>
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
              $("#mail-status").attr("class", "error");
            } else if (response.type == "message") {
              $("#mail-status").attr("class", "success");
            }
            $("#mail-status").html(response.text);
          },
          error: function() {}
        });
      }));
    });

  </script> 
</head>

<body>
  <form class="form file-form" id="loginForm" action="" method="POST" novalidate="novalidate">
    <h4>Login page</h4>

    <div class="form-row">
      <label for="userName" class="form-label">User name</label>
      <input type="text" id="userName" class="form-input" placeholder="Enter your username" name="userName" required>
    </div>
    <div class="form-row">
      <label for="userPassword" class="form-label">Password</label>
      <input type="password" id="userPassword" class="form-input" placeholder="Enter your password" name="userPassword" required>
    </div>

    <div id="mail-status"></div>
    <button type="submit" class="btn btn-block" id="send-message">Login</button>
    <div className='col text-center mt-4'>
      <label>Don't have an account?
        <a href='register.php' type='button' className='fw-bold'>Register</a>
      </label>
    </div>
    </div>
  </form>
</body>

</html>