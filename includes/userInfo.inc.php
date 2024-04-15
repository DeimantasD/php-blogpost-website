<?php

include('./config/db_connect.php');

if(isset($_SESSION['username'])){
// write query for user
$sql = "SELECT *
        FROM users
        WHERE username = ?";

// prepare the statement
$stmt = mysqli_prepare($conn, $sql);

// bind parameters
mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);

// execute the statement
mysqli_stmt_execute($stmt);

// get result
$result = mysqli_stmt_get_result($stmt);

// fetch the resulting rows as an array
$user = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close statement
mysqli_stmt_close($stmt);


$user = $user[0];
}

$name = $user['name'];
$username = $user['username'];
$email = $user['email'];
