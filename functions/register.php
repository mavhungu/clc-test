<?php

if ($_POST) {
  require_once '../Connection.php';
  require_once '../constant.php';


  $fname = htmlspecialchars(trim($_POST['fname']));
  $lname = htmlspecialchars(trim($_POST['lname']));
  $uname = htmlspecialchars(trim($_POST['uname']));
  $password = htmlspecialchars(trim($_POST['password']));

  $hashPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

  $output = array('error' => false);

  $database = new Connection();
  $db = $database->open();

  if (empty($fname)) {
    $empty[] = "<b>first Name</b>";
  }
  if (empty($uname)) {
    $empty[] = "<b>userName</b>";
  }
  if (empty($password)) {
    $empty[] = "<b>Password</b>";
  }

  if (!empty($empty)) {
    $output = json_encode(array('type' => 'error', 'text' => implode(", ", $empty) . ' Required!'));
    die($output);
  }

  //reCAPTCHA validation
  if (isset($_POST['g-recaptcha-response'])) {

    require('../components/recaptcha/src/autoload.php');

    $recaptcha = new \ReCaptcha\ReCaptcha(SECRET_KEY);

    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    if (!$resp->isSuccess()) {
      $output = json_encode(array('type' => 'error', 'text' => '<b>Captcha</b> Validation Required!'));
      die($output);
    }
  }

  try {
    $stmt = $db->prepare("INSERT INTO users (firstName, lastName, userName, password) VALUES (:fname, :lname, :uname, :password)");

    if ($stmt->execute(array(':fname' => $fname, ':lname' => $lname, ':uname' => $uname, ':password' => $hashPassword))) {
      $output = json_encode(array('type' => 'message', 'text' => 'Data is succefully saved.'));
      die($output);
    } else {
      $output = json_encode(array('type' => 'error', 'text' => 'Unable to save data, please try again.'));
      die($output);
    }
  } catch (PDOException $e) {
    $output['error'] = true;
    $output['message'] = $e->getMessage();
  }

  $database->close();

  echo json_encode($output);
}
