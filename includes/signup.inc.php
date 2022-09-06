<?php

if (isset($_POST["sumbit"])) {
  $name = $_POST["uid"];
  $pwd = $_POST["passwd"];
  $pwdRepeat = $_POST["passwd_repreat"];

   require_once 'dbh.inc.php';
   require_once 'functions.inc.php';

  if (emptyInputSignup($name, $pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  if (invalidUid($name) !== false) {
    header("location: ../signup.php?error=invalidUid");
    exit();
  }
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
  }
  if (uidExists($conn, $name) !== false) {
    header("location: ../signup.php?error=usserexists");
    exit();
  }

  createUser($conn, $name, $pwd );
}
else {
  header("location: ../signup.php");
  exit();
}
