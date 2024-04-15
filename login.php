<?php
include_once './templates/header.php';
?>


<section class="signup-form">
  
  <div class="signup-form-form">
  <form action="includes/login.inc.php" method="post">
    <h2>Log in</h2>
    <input type="text" name="uid" placeholder="Username/Email...">
    <input type="password" name="password" placeholder="Password...">
    <button type="submit" name="submit">Log in</button>
    <?php
    if(isset($_GET['error'])){
      if($_GET['error'] == "emptyinput"){
        echo "<p class='signup-error'>Fill in all fields!</p>";
      }
      else if($_GET['error'] == "wronglogin"){
        echo "<p class='signup-error'>Incorrect login information!</p>";
      }
    }

?>
  </form>
  </div>

</section>