<?php
session_start();


// Redirect to login page if user is not logged in
if(!isset($_SESSION['username'])){
  header("Location: login.php");
  exit();
}

include('config/db_connect.php');


// Check if delete button clicked
if(isset($_POST['delete'])){
  // Get ID of the blog post to be deleted
  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

  $sql = "DELETE FROM blogs WHERE id = $id_to_delete";

  if(mysqli_query($conn, $sql)){
    // Deletion successful
    header('Location: index.php');
  } else {
    // Deletion failed
    echo 'query error: ' . mysqli_error($conn);
  }

}

// Check if GET request contains blog post ID
if(isset($_GET['id'])){
// Get ID of the blog post
$id = mysqli_real_escape_string($conn, $_GET['id']);

// make sql
$sql = "SELECT * FROM blogs where id = $id";

// get the query result

$result = mysqli_query($conn, $sql);

// fetch result in array format

$blog = mysqli_fetch_assoc($result);

// free memory
mysqli_free_result($result);

// mysqli close
mysqli_close($conn);
}

// Include user information
include('./includes/userInfo.inc.php');


?>

<!DOCTYPE html>
<html lang="en">

<?php include('./templates/header.php'); ?>

<div class="blog-details-wrapper">
  <?php if($blog): ?>
    <div class="blog-details">
      <h2><?php echo htmlspecialchars($blog['title']); ?></h2>
      <div class="blog-info">
        <p>Author: <span><?php echo htmlspecialchars($blog['email']); ?></span></p>
        <p class="date"><?php echo date("F j, Y", strtotime($blog['created_at'])); ?></p>
      </div>
      <div class="content">
        <p><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>
      </div>
      <?php if($blog['email'] == $email): ?>
        <div class="details-buttons">
  <!-- DELETE FORM -->
  <form action="details.php" method="post" class="delete-form">
    <input type="hidden" name="id_to_delete" value="<?php echo $blog['id'] ?>">
    <input type="submit" name="delete" value="Delete" class="delete-btn">
  </form>
  
  <!-- UPDATE BUTTON -->
  <form action="update.php" method="get" class="update-form">
    <input type="hidden" name="id_to_update" value="<?php echo $blog['id'] ?>">
    <input type="submit" value="Update" class="update-btn">
  </form>
</div>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <h2 class="noblogs">No such blog exists</h2>
  <?php endif; ?>
</div>


<?php include('./templates/footer.php'); ?>

</html>