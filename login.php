<?php
  include_once 'header.php'
?>

  <section class="signup_section">
    <div class="div_signup_sign">
      <a class="signup_sign"> Log In </a>
    </div>
    <form class="form" action="includes/login.inc.php" method="post">
      <input type="text" name="uid" placeholder="Username">
      <input type="password" name="passwd" placeholder="Hasło">

      <button type="submit" name="sumbit">Sign Up</button>
    </form>
  <div class="error_div">
    <?php
      if(isset($_GET["error"])){
        if ($_GET["error"] == "emptyinput") {
          echo "<a class='error_message'> Wypełnij wszystkie pola</a>";
        }
        elseif ($_GET["error"] == "invalidUid") {
          echo "<a class='error_message'> Niepoprawny login </a>";
        }
        elseif ($_GET["error"] == "wronglogin") {
          echo "<a class='error_message'> Niepoprawny login </a>";
        }
      }
     ?>
  </section>
</div>

 <?php
   include_once 'footer.php'
?>
