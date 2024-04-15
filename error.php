<?php
session_start();

include_once 'templates/header.php';

$error = $_SERVER['REDIRECT_STATUS'];

$error_title = '';
$error_message = '';

if($error == 404){
  $error_title = '404 Page not Found';
  $error_message = 'The document/file requested was not found on this server';
}

 ?>

<div class="error-container">
    <h1>404 - Page Not Found</h1>
    <p>We're sorry, but the page you requested does not exist.</p>
    <p>Please <a href="index.php">click here</a> to return to the homepage.</p>
</div>

<?php include_once 'templates/footer.php'; ?>