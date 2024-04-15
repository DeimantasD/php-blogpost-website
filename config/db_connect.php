<?php
// Connect to the database
$servername = "localhost";
$username = "deimis";
$password = "test123";
$dbname = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}