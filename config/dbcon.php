<?php 

// Connect to your database
$con = mysqli_connect("localhost", "root", "", "sultans");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the redirect function is already declared to avoid redeclaration
if (!function_exists('redirect')) {
    function redirect($page, $status) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Start the session only if not already started
        }
        $_SESSION['status'] = $status;
        header("Location: $page");
        exit(0);
    }
}

?>
