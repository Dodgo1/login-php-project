<?php

if (isset($_POST["sumbit"])) {

  $name = $_POST["uid"];
  $pwd = $_POST["passwd"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputLogin($name, $pwd) !== false) {
    header("location: ../login.php?error=emptyinput");
    exit();
  }

  loginUser($conn, $name, $pwd);
}
else{
  header("location: ../login.php");
  exit();
}

function emptyInputLogin($name, $pwd) {
  $result;
  if (empty($name) || empty($pwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}
