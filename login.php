<?php
require_once 'header.php';
?>
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

  <div id="status-response"></div>
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