<?php
if(isset($_POST["sumbit"])){
  $id = $_POST["id"];

  //jeśli to id admina - przerwij
  if($id == 32){
    header("location: ../admin-index.php?error=adminDelete");
    exit();
  }

  //pobiera zmienne
  require_once 'dbh.inc.php';
  $sql = "SELECT usersUID FROM users WHERE usersId = '$id'";
  $usersUID = mysqli_fetch_assoc(mysqli_query($conn, $sql));
  $fileName = $usersUID['usersUID'] . "-index.php";

  //usuwa index usera
  unlink("../$fileName");

  // usuwa z databaseu
  $sql = "DELETE FROM users WHERE usersId = '$id'";
  $delete = mysqli_query($conn, $sql);
}
// wyjdz
header("location: ../admin-index.php?error=none");
exit();
