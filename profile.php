<?php
session_start();
if(!isset($_SESSION['username'])){
  header("Location: login.php");
  exit();
}

include_once './templates/header.php';

include('./config/db_connect.php');

include('./includes/userInfo.inc.php');


// Prepare the email address for use in the SQL query
$email = mysqli_real_escape_string($conn, $email);

// Write query for fetching blogs associated with the user's email
$sql = "SELECT * FROM blogs WHERE email = '$email'";

// Make query & get result
$result = mysqli_query($conn, $sql);

// Fetch the resulting rows as an array
$blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result from memory
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>




<section class="profile"> 
  <div class="profile-container">
    <div class="profile-info">
      <h2>Your Profile</h2>
      <p class="label">Your name: <span class="value"> <?php echo $name; ?> </span></p>

      <p class="label">Your username: <span class="value"> <?php echo $username ; ?> </span></p>

      <p class="label">Your email: <span class="value"> <?php echo $email; ?> </span></p>
    </div>
  </div>


  <div class="profile-blogs">
    <h2>Your Blogs</h2>
  <div class="blogs-container">
    <?php
      if(!empty($blogs)){
    foreach($blogs as $blog): ?>
      <div class="blog">
                <a href="details.php?id=<?php echo $blog['id'] ?>" class="blog-link">
                  <div class="blog-image">
                    <img src="Images/<?php echo $blog['image'] ?>" alt="<?php echo htmlspecialchars($blog['title']) ?>">
                    <div class="overlay"></div>
                  </div>
                  <div class="blog-info">   
                    <h4 class="title"><?php echo htmlspecialchars($blog['title']) ?></h4>
                    <p class="date"><?php echo date("Y-m-d", strtotime($blog['created_at'])); ?></p>
                  </div>
                </a>
            </div>
      <?php endforeach; ?>
      <?php }else { ?>
              <h5 class="no-blogs">You haven't posted any blogs!</h5>
           <?php }; ?>
  </div>
  </div>
  
</section>
<?php include('./templates/footer.php'); ?>