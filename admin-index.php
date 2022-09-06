<?php
include_once 'header.php';
  if (! isset($_SESSION["useruid"])) {
    die("Log in as admin");
  }
  else{

  }
?>

  <div class="main">
      <!-- <a class="a1" href="#">user1</a>

      <a class="a2" href="#">user2</a>

      <a class="a3" href="#">user3</a>

      <a class="a4" href="#">user4</a> -->
     <?php
        require_once 'includes/dbh.inc.php';

        $sql = "SELECT * FROM users";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
            echo "<a>id: " . $row["usersId"] . " - Name: " . $row["usersUID"]."</a>";
          }
        } else {
          echo "0 users in db";
        }
        mysqli_close($conn);
      ?>
  </div>
  <form class="form" action="includes/deleteUser.inc.php" method="post">
    <input type="number" name="id" min="0" placeholder="id" >

    <button type="submit" name="sumbit">Delete</button>
  </form>

<?php
  include_once 'footer.php'
 ?>
