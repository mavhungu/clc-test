<?php
require_once('constant.php');
echo <<<_END
  <script>
    function checkUser(user)
    {
      if (user.value == '')
      {
        $('#used').html('&nbsp;')
        return
      }
      $.post
      (
        'functions/checkuser.php',
        { user : user.value },
        function(data)
        {
          $('#used').html(data)
        }
      )
    }
  </script>  
_END;
?>

<!DOCTYPE html>

<head>
  <title>Registration</title>
  <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="assets/css/normalize.css" type="text/css">
  <link rel="stylesheet" href="assets/css/styles.css" type="text/css">
  <script src="components/jquery/jquery-3.2.1.min.js"></script>
  <script src="assets/js/script.js"></script>

  <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
  <form class="form file-form" id="registerForm" action="" method="POST" novalidate="novalidate">
    <h4>Registration page</h4>

    <div class="form-row">
      <label for="firstname" class="form-label">First Name</label>
      <input type="text" id="firstname" class="form-input" name="firstName" placeholder="Enter your first name" required>
    </div>

    <div class="form-row">
      <label for="lastName" class="form-label">Last Name</label>
      <input type="text" id="lastName" class="form-input" name="lastName" placeholder="Enter your last name">
    </div>

    <div class="form-row">
      <label for="userName" class="form-label">User name</label>
      <input type="text" id="userName" class="form-input" placeholder="Enter your username" onBlur='checkUser(this)' value="<?php $user ?>" name=" userName" required>
      <label></label>
      <div id='used'>&nbsp;</div>
    </div>
    <div class="form-row">
      <label for="userPassword" class="form-label">Password</label>
      <input type="password" id="userPassword" class="form-input" maxLength="8" minlength="8" placeholder="Enter your password" name="userPassword" required>
    </div>

    <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY; ?>"></div>
    <div id="status-response"></div>

    <button type="submit" class="btn btn-block" id="send-message" style="clear:both;">Register</button>
    <div className='col text-center mt-4' style="margin: top 5px;">
      <label>Have an account?
        <a href='login.php' type='button' className='fw-bold'>Login</a>
      </label>
    </div>
    </div>
  </form>

</body>

</html>