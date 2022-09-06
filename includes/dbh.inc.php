<?php
// $serverName = "sql108.epizy.com";
// $dBUserName = "epiz_30363212";
// $dBPassword = "Q2QYKV3wOMnyQYb";
// $dBName = "epiz_30363212_site_karol";
// $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);
// if (!$conn) {
//   die("Conectionn failed: " . mysqli_connect_error());
// }
?>

<?php
$serverName = "localhost";
$dBUserName = "root";
$dBPassword = "";
$dBName = "phpproject01";
$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);
if (!$conn) {
  die("Conectionn failed: " . mysqli_connect_error());
}
?>
