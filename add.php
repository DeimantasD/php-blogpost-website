<?php
session_start();


// Redirect to login page if user is not logged in
if(!isset($_SESSION['username'])){
  header("Location: login.php");
  exit();
}

include('./includes/userInfo.inc.php');

include('./config/db_connect.php');

// Define and initialize variables
$errors = array( 'image' => '','title' => '', 'content' => '');
$title = '';
$content = '';
$image = '';


// Check if form submitted
if(isset($_POST['submit'])) {
  
 
  // Check title
  if(empty($_POST['title'])) {
      $errors['title'] = 'A title is required <br>';
  } else {
      $title = $_POST['title'];
      if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
          $errors['title'] = 'Title must be letters and spaces only <br>';
      };
  }

  // Validate content
  if(empty($_POST['content'])) {
      $errors['content'] = 'Content is required <br>';
  } else {
      $content = htmlspecialchars($_POST['content']);
  }


 // Validate image
  if ($_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
    // Image not uploaded
    $errors['image'] = 'Image is required';
} else {
  // Image uploaded, process it
  $file_name = $_FILES['image']['name'];
  $tempName = $_FILES['image']['tmp_name'];
  $folder = 'Images/'.$file_name;
}

// If no errors, proceed to save data to database
  if(!array_filter($errors)) {
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $content = mysqli_real_escape_string($conn, $_POST['content']);

      $sql = "INSERT INTO blogs(title, email, content, image) VALUES('$title', '$email', '$content', '$file_name')";

      // Save to db and check
      if(mysqli_query($conn, $sql)) {
          // Success
          if(move_uploaded_file($tempName, $folder)){
            header('Location: index.php');
          }
          
      } else {
          // Error
          echo 'Query error: ' . mysqli_error($conn);
      }
  }
}; 

?>


<!DOCTYPE html>
<html lang="en">

<?php include('./templates/header.php'); ?>

<section id="add-blog">
  
  <div class="form">
    <form action="add.php" method="post" enctype="multipart/form-data">
      <h4>Add a Blog</h4>
      <label>Your Title: </label>
      <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
      <div class="error"><?php echo $errors['title'];  ?></div>

      <label>Your content: </label>
      <textarea name="content" id="" cols="20" rows="10"><?php echo htmlspecialchars($content); ?></textarea>
      <div class="error"><?php echo $errors['content']; ?></div>

      <label>Your Image: </label>
      <input type="file" name="image"><br><br>
      <div class="error"><?php echo $errors['image']; ?></div>

      <input type="submit" name="submit" value="Upload">
      
    </form>
  </div>
  
</section>


<?php include('./templates/footer.php'); ?>
  
</html>