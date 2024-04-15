<?php

session_start();

// Unset and destroy session
session_unset();
session_destroy();

// Redirect to index page
header("Location: ../index.php");