<?php
require_once '../Connection.php';

if (isset($_POST['user'])) {
  $database = new Connection();
  $db = $database->open();

  $user   = htmlspecialchars(trim($_POST['user']));
  $result = $db->query("SELECT * FROM users WHERE userName='$user'");

  if ($result->rowCount())
    echo  "<span class='taken'>&nbsp;&#x2718; " .
      "The username '$user' is taken</span>";
  else
    echo "<span class='available'>&nbsp;&#x2714; " .
      "The username '$user' is available</span>";
}
