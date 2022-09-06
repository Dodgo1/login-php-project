<?php
  include_once 'header.php'
?>

  <section class="signup_section">
    <div class="div_signup_sign">
      <a class="signup_sign"> Sign up </a>
    </div>
    
    <form class="form" action="includes/signup.inc.php" method="post">
      <input type="text" name="uid" placeholder="imię">
      <input type="password" name="passwd" placeholder="Hasło">
      <input type="password" name="passwd_repreat" placeholder="Powtórz hasło">

      <button type="submit" name="sumbit">Sign Up</button>
    </form>
  </section>

<div class="error_div">
  <?php
    if(isset($_GET["error"])){
      if ($_GET["error"] == "emptyinput") {
        echo "<a class='error_message'> Wypełnij wszystkie pola</a>";
      }
      elseif ($_GET["error"] == "invalidUid") {
        echo "<a class='error_message'> Niepoprawny login , nie używaj znaków specjalnych </a>";
      }
      elseif ($_GET["error"] == "passwordsdontmatch") {
        echo" <a class='error_message'> Hasła się nie zgadzają</a>";
      }
      elseif ($_GET["error"] == "usserexists") {
        echo "<a class='error_message'> Taki użytkownik już istnieje</a>";
      }
      elseif ($_GET["error"] == "none") {
        echo "<a class='error_message'> Udało ci się zarejestrować !</a>";
      }
    }
   ?>
</div>
 <?php
   include_once 'footer.php'
?>
