<?php
  session_start();
 ?>

<!doctype html>
<html lang="pl">
<head>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <meta http-equiv="refresh" content="900;includes/logout.inc.php" />

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="A simple HTML5 Template for new projects.">
  <meta name="author" content="SitePoint">

  <title>_Strona_</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans">

</head>

<body>

  <div class="header">
    <!-- <img src="zdj/hero_zero.jpeg" class="img_logo"> -->
    <a class="hlogo" href="#">hlogo</a>
    <div class="hbuttons">
    <?php
      if (isset($_SESSION["useruid"])) {
        if ($_SESSION["useruid"] === "admin") {
          echo "<a class='helement1' href = 'admin-index.php'>ADMIN_PANEL</a>";
          echo "<a class='helement2' href='includes/logout.inc.php'>Log out</a>";
        }else{
        echo "<a class='helement1' href = '#'>PROFIL</a>";
        echo "<a class='helement2' href='includes/logout.inc.php'>Log out</a>";
      }
      } else {
        echo "<a class='helement1' href='login.php'>login</a>";
        echo "<a class='helement2' href='signup.php'>sign up</a>";
      }
     ?>
     <a class="helement3"href="info_page.php">info_page?</a>
    </div>

  </div>
