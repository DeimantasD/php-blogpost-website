<?php
  
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OurBlogPage</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <script src="assets/js/script.js"></script>
</head>
  <body>
  
  <header>
    <nav>
      <ul class="sidebar">
        <?php
        if(isset($_SESSION['username'])){
          echo '<li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>';
          echo '<li><a href="index.php">Home</a></li>';
          echo '<li><a href="profile.php">Profile</a></li>';
          echo '<li><a href="add.php">Add a Blog</a></li>';
          echo "<li><a href='includes/logout.inc.php'>Log out (@". $_SESSION['username'] . ")</a></li>";
        } else {
          echo '<li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>';
          echo '<li><a href="index.php">Home</a></li>';
          echo '<li><a href="login.php">Log in</a></li>';
          echo '<li><a href="signup.php">Sign up</a></li>';
        }
        ?>
        
      </ul>

      <ul>
       <?php
       if(isset($_SESSION['username'])){
        echo '<li><a href="index.php">OurBlogPage</a></li>';
        echo '<li class="hideOnMobile"><a href="index.php">Home</a></li>';
        echo '<li class="hideOnMobile"><a href="profile.php">Profile</a></li>';
        echo '<li class="hideOnMobile"><a href="add.php">Add a Blog</a></li>';
        echo '<li class="hideOnMobile"><a href="includes/logout.inc.php">Log out (@'.$_SESSION['username'].')</a></li>';
        echo '<li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>';
       } else {
        echo '<li><a href="index.php">OurBlogPage</a></li>';
        echo '<li class="hideOnMobile"><a href="login.php">Log in</a></li>';
        echo '<li class="hideOnMobile"><a href="signup.php">Sign up</a></li>';
        echo '<li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>';
       }
       ?>
        
        
        
        
        
        
      </ul>
    </nav>
  </header>