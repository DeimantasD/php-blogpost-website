<?php 
session_start();

// Redirect to login page if user is not logged in
if(!isset($_SESSION['username'])){
  header("Location: login.php");
  exit();
}

include('./config/db_connect.php');

// write query for latest 3 blogs
$sql = 'SELECT * FROM blogs ORDER BY created_at DESC LIMIT 3';
// make query & get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// write query for all blogs
$sql2 = 'SELECT * FROM blogs ORDER BY created_at DESC';
// make query & get result
$result2 = mysqli_query($conn, $sql2);

// fetch the resulting rows as an array
$blogs2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result2);

// close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('./templates/header.php'); ?>


<section id="recent">
      <div class="recent-blogs">
        <h1>Recent Blogs</h1>
        <div class="blogs-wrapper">
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
              <h5 class="no-blogs">No blogs found!</h5>
           <?php }; ?>
        </div>
      </div>
    </section>
    
    <section class="all-blogs">
      <h2>All Blogs</h2>
      <div class="all-blogs-wrapper">
        <?php
        if(!empty($blogs)){
        foreach($blogs2 as $blog2): ?>
                <div class="all-blogs-blog">
                <div class="blog">
                <a href="details.php?id=<?php echo $blog2['id'] ?>" class="blog-link">
                  <div class="blog-image">
                    <img src="Images/<?php echo $blog2['image'] ?>" alt="<?php echo htmlspecialchars($blog2['title']) ?>">
                    <div class="overlay"></div>
                  </div>
                  <div class="blog-info">   
                    <h4 class="title"><?php echo htmlspecialchars($blog2['title']) ?></h4>
                    <p class="author"><strong>Author:</strong>  <?php echo $blog2['email'] ?></p>
                    <p class="date"><?php echo date("Y-m-d", strtotime($blog2['created_at'])); ?></p>
                  </div>
                </a>
            </div>
                </div>
          <?php endforeach; ?>
          <?php }else { ?>
              <h5 class="no-blogs">No blogs found!</h5>
           <?php }; ?>
      </div>
    </section>

<?php include('./templates/footer.php'); ?>
  
</html>