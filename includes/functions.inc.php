<?php
function emptyInputSignup($name, $pwd, $pwdRepeat) {
  $result;
  if (empty($name) || empty($pwd) || empty($pwdRepeat)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidUid($name) {
  $result;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
  $result;
  if ($pwd !== $pwdRepeat) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function uidExists($conn, $name){
  $sql = "SELECT * FROM users WHERE usersUID = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $name);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)){
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $pwd ){
  $sql = "INSERT INTO users (usersUID,usersPwd) VALUES (?,?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ss", $name, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  $newuser_index = fopen("../{$name}-index.php", "a") or die ("Unable to open file!");
  $template = "<?php
      include_once 'header.php';
      if (! isset(\$_SESSION['useruid'])) {
        die('Log in as user');
      }
      else{

      }
      if (strpos(basename(__FILE__, '.php'), \$_SESSION['useruid'])) {
        die('Log in as the user');
      }
      else{

      }
      \$files = '$name-files';
      \$name = '$name-files';
    ?>
      <div class='main1'>
      <a class = 'instruction'> Oto twoje plany, kliknij aby pobrać: </a>
        <?php
        // wypisuje wszystkie pliki z folderu do ktorego jest przypisany uzytkownik w kolejnosci od najnowszego do najstarszego
          \$files_names = array_slice(scandir(\$files),2);
          \$dni_tygodnia = array( 'Niedziela', 'Poniedzialek', 'Wtorek', 'Sroda', 'Czwartek', 'Piatek', 'Sobota' );
          \$length = count(\$files_names);
          \$array =  array();
          for (\$i=0; \$i < \$length ; \$i++) {
            \$string = strval(\$files_names[\$i]);
            \$files = str_replace(' ', '', \$files);
            \$time = filectime(\"\$files/\$string\");
            \$array[\$string]= \$time;
          }
            asort(\$array);
            \$array_values = array_reverse(array_values(\$array));
            \$array_keys = array_reverse(array_keys(\$array));
            for (\$i=0; \$i < \$length ; \$i++) {
              \$day_of_week = \$dni_tygodnia[date('w',\$array_values[\$i])];
              \$user_readable_time = date('d Y H:i:s.', \$array_values[\$i]);
              \$result_time = \$day_of_week . ' ' . substr(\$user_readable_time, 0, -1) . ':';

              echo \"<div class = 'user_list_item'>\";
              echo \"<p class = 'time_stamp'>\$result_time</p>\";
              echo \"<a class = 'file_download_link' href = 'download.php?fileName=\$array_keys[\$i]&filePath=\$files\'>\$array_keys[\$i]</a>\";
              echo \"</div>\";
            }

         ?>
      </div>
    <?php
      include_once 'footer.php';
    ?>
  ";
  if (!file_exists("../{$name}-index")) {
    fwrite($newuser_index,$template);
    fclose($newuser_index);
  }

  if (!file_exists("../{$name}-files")) {
    mkdir("../{$name}-files");
  }

  header("location: ../signup.php?error=none");
  exit();
}
// TO JEST POPRZEDNIA FUNKCJA, PRZENOSI DO ZWYKLEGO INDEXU A W INDEKSIE PODMIENIA GORNE GUZIKI
// function loginUser($conn, $name, $pwd){
//   $uidExists = uidExists($conn,$name);
//
//   if ($uidExists === false) {
//     header("location: ../login.php?error=wronglogin");
//     exit();
//   }
//   $hashedPwd = $uidExists["usersPwd"];
//   $checkPwd = password_verify($pwd,$hashedPwd);
//
//   if ($checkPwd === false) {
//     header("location: ../login.php?error=wronglogin");
//     exit();
//   }
//   else if ($checkPwd === true) {
//     session_start();
//     $_SESSION["userid"] = $uidExists["usersId"];
//     $_SESSION["useruid"] = $uidExists["usersUID"];
//     header("location: ../index.php");
//     exit();
//   }
// }

// NOWA FUNKCJA PRZENOSI DO OSOBNEGO PLIKU UZYTKOWNIKA W FOLDERZE profiles

function loginUser($conn, $name, $pwd){
  $uidExists = uidExists($conn,$name);

  if ($uidExists === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }
  $hashedPwd = $uidExists["usersPwd"];
  $checkPwd = password_verify($pwd,$hashedPwd);

  if ($checkPwd === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }
  else if ($checkPwd === true) {
    session_start();
    $_SESSION["userid"] = $uidExists["usersId"];
    $_SESSION["useruid"] = $uidExists["usersUID"];
    header("location: ../{$name}-index.php");
    exit();
  }
}
