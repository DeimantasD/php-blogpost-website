<?php

$result;

// Function to check for empty input during signup
function emptyInputSignup($name, $email, $username, $password, $passwordRepeat){
 
  if(empty($name) || empty($email) || empty($username) || empty($password) || empty($passwordRepeat)){
    $result = true;
  } else {
    $result = false;
  }
  return $result;
};

// Function to validate username
function invalidUsername($username){
  if(!preg_match("/^[a-zA-Z0-9]*$/",$username ) ){
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

// Function to validate email
function invalidEmail($email){
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

// Function to check if passwords match
function passwordMatch($password, $passwordRepeat){
  if($password !== $passwordRepeat){
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

// Function to check if username or email already exists
function usernameExists($conn, $username, $email){
  $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../signup.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData)){
      return $row;
  }else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);

}


// Function to create a new user
function createUser($conn, $name, $email, $username, $password){
  $sql = "INSERT INTO users (name, email, username, password) VALUES (?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../signup.php?error=stmtfailed");
    exit();
  }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  
  mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPassword);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
  header("Location: ../signup.php?error=none");
  exit();
}

// Function to check for empty input during login
function emptyInputLogin($username, $password){
 
  if(empty($username) || empty($password)){
    $result = true;
  } else {
    $result = false;
  }
  return $result;
};

// Function to login user
function loginUser($conn, $username, $password){
  $usernameExists = usernameExists($conn, $username, $username);

  if($usernameExists === false){
    header("Location: ../login.php?error=wronglogin");
     exit();
  }

  $passwordHashed = $usernameExists['password'];
  $checkPassword = password_verify($password, $passwordHashed);

  if($checkPassword === false){
    header("Location: ../login.php?error=wronglogin");
    exit();
  } 
  else if($checkPassword === true){
    session_start();
    $_SESSION["id"] = $usernameExists['id'];
    $_SESSION["username"] = $usernameExists['username'];
    header("Location: ../index.php");
    exit();
  }
}