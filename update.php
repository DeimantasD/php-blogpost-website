<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('config/db_connect.php');


$errors = array('title' => '', 'content' => '');
$title = '';
$content = '';

if (isset($_GET['id_to_update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_GET['id_to_update']);

    // Fetch blog post data from the database
    $sql = "SELECT * FROM blogs WHERE id = $id_to_update";
    $result = mysqli_query($conn, $sql);
    $blog = mysqli_fetch_assoc($result);
}

// Check if update form is submitted
if (isset($_POST['update'])) {

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize input data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

     // Validate title
    if (empty($title)) {
        $errors['title'] = 'Title cannot be empty';
    }

     // Validate content
    if (empty($content)) {
        $errors['content'] = 'Content cannot be empty';
    }

    // Check if there are any error messages in the $errors array
    if (empty($errors['title']) && empty($errors['content'])) {
        $sql = "UPDATE blogs SET title='$title', content='$content' WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            // Update successful
            header("Location: /blog/details.php?id=$id");
            exit();
        } else {
            // Update failed
            echo 'Update failed: ' . mysqli_error($conn);
        }
    } 
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('./templates/header.php'); ?>

<div class="update-blog">
    <form action="./update.php?id_to_update=<?php echo $blog['id']; ?>" method="post">
        <h2>Update Your Blog</h2>
        <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>">
        <div class="error"><?php echo $errors['title']; ?></div>

        <label for="content">Content:</label>
        <textarea id="content" name="content"><?php echo htmlspecialchars($blog['content']); ?></textarea>
        <div class="error"><?php echo $errors['content']; ?></div>
        <input type="submit" name="update" value="Update">
    </form>
</div>

<?php include('./templates/footer.php'); ?>

</html>