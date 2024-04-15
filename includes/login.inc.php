<?php
session_start();
if(isset($_POST['submit'])){
    require_once '../config/db_connect.php';
    require_once 'functions.inc.php';
  
    $username = $_POST['uid'];
    $password = $_POST['password'];
  
    // Check for empty input fields
    if(emptyInputLogin($username, $password) !== false){
        header("Location: ../login.php?error=emptyinput");
        exit();
    }
    // Attempt to log in the user
    loginUser($conn, $username, $password);
} else {
    // Redirect to login page if form not submitted
    header("Location: ../login.php");
    exit();
}