<?php
include('./templates/header.php');
?>

<section class="signup-form">
  
  <div class="signup-form-form">
  <form action="./includes/signup.inc.php" method="post">
    <h2>Sign Up</h2>
    <input type="text" name="name" placeholder="Full name...">
    <input type="text" name="email" placeholder="Email...">
    <input type="text" name="username" placeholder="Username...">
    <input type="password" name="password" placeholder="Password...">
    <input type="password" name="passwordrepeat" placeholder="Repeat password...">
    <button type="submit" name="submit">Sign Up</button>

    <?php
if(isset($_GET['error'])){
  if($_GET['error'] == "emptyinput"){
    echo "<p class='signup-error'>Fill in all fields!</p>";
  }
  else if($_GET['error'] == "invalidusername"){
    echo "<p class='signup-error'>Choose a proper username</p>";
  }
  else if($_GET['error'] == "invalid email"){
    echo "<p class='signup-error'>Choose a proper email</p>";
  }
  else if($_GET['error'] == "passwordsdontmatch"){
    echo "<p class='signup-error'>Password doesn't match!</p>";
  }
  else if($_GET['error'] == "stmtfailed"){
    echo "<p class='signup-error'>Something went wrong!</p>";
  }
  else if($_GET['error'] == "usernametaken"){
    echo "<p class='signup-error'>This username or email is taken!</p>";
  }
  else if($_GET['error'] == "none"){
    echo "<p class='signup-succ'>You have signed up succesfully!</p>";
  }
}

?>
  </form>
  </div>
</section>



 <?php
  include('./templates/footer.php');

 ?>