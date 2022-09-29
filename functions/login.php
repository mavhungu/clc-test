<?php
if ($_POST) {
  require_once '../Connection.php';
  require_once '../constant.php';

  $uname = htmlspecialchars(trim($_POST['uname']));
  $password = htmlspecialchars(trim($_POST['password']));

  $output = array('error' => false);

  $database = new Connection();
  $db = $database->open();


  if (empty($uname)) {
    $empty[] = "<b>userName</b>";
  }
  if (empty($password)) {
    $empty[] = "<b>Password</b>";
  }

  try {
    $sql = "SELECT * FROM users WHERE userName ='$uname'";
    foreach ($db->query($sql) as $row) {
      $isMatch = password_verify($password, $row['password']);
      if ($isMatch) {
        $output = json_encode(array('type' => 'message', 'text' => 'succefully log in.'));
        die($output);
      } else {
        $output = json_encode(array('type' => 'error', 'text' => 'Invalide credentials, please try again.'));
        die($output);
      }
    }
  } catch (PDOException $e) {
    $output = json_encode(array('type' => 'error', 'text' => 'Incorrect Credentials'));
    die($output);
  }


  $database->close();

  echo json_encode($output);
}
