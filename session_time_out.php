<?php

// Check if the time elapsed since the last activity is greater than 900 seconds (15 minutes)
if (time() - $_SESSION['last_activity'] > 900) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header('refresh:0;url=login.php');
} else {
    // Update the last activity time to the current time
    $_SESSION['last_activity'] = time();
}

