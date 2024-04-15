<?php

if(isset($_POST['submit'])){
  
  $name = $_POST['name'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $passwordRepeat = $_POST['passwordrepeat'];


  require_once './config/db_connect.php';
  require_once 'functions.inc.php';

  // Check for empty input fields
  if(emptyInputSignup($name, $email, $username, $password, $passwordRepeat) !== false){
    header("Location: ../signup.php?error=emptyinput");
    exit();
  }

  // Validate username
  if(invalidUsername($username) !== false){
    header("Location: ../signup.php?error=invalidusername");
    exit();
  }

  // Validate email
  if(invalidEmail($email) !== false){
    header("Location: ../signup.php?error=invalidemail");
    exit();
  }

  // Check if passwords match
  if(passwordMatch($password, $passwordRepeat) !== false){
    header("Location: ../signup.php?error=passwordsdontmatch");
    exit();
  }

  // Check if username or email already exists
  if(usernameExists($conn, $username, $email) !== false){
    header("Location: ../signup.php?error=usernametaken");
    exit();
  }

  // Create new user
  createUser($conn, $name, $email, $username, $password);

} else {
  // Redirect to signup page if form not submitted
  header("Location: ../signup.php");
  exit();
}