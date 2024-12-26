<?php
include("config/dbcon.php"); // Connect to the database
session_start();

$otp = $_SESSION["OTP"];
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOtp = $_POST['otpCode'];

    if ($enteredOtp == $otp) {
        $email = $_SESSION['Email']; // Retrieve email from the session
        $query = "SELECT * FROM users WHERE email = '$email'";
        $query_run = mysqli_query($con, $query);
        $user = mysqli_fetch_assoc($query_run);

        if ($user) {
            // Update active status to 1 for the verified user
            $update_query = "UPDATE users SET active = 1 WHERE email = '$email'";
            $update_query_run = mysqli_query($con, $update_query);

            if ($update_query_run) {
                $_SESSION['status'] = "Account verified successfully. You can log in now.";
                header('location: login.php');
                exit;
            } else {
                $message = '<label class="alert alert-danger">Error activating account. Please try again later.</label>';
            }
        } else {
            $message = '<label class="alert alert-danger">User not found. Please register again.</label>';
        }
    } else {
        $message = '<label class="alert alert-danger">Invalid OTP code. Please try again.</label>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <form method="POST" action="verify-otp.php">
        <div>
            <h2>Enter OTP</h2>
            <p><?php echo $message; ?></p>
            <div>
                <label>OTP Code:</label>
                <input type="text" name="otpCode" required placeholder="Enter OTP code">
            </div>
            <button type="submit">Verify</button>
        </div>
        <p>Didn't receive the OTP? <a href="./mail/mail.php">Resend OTP</a></p>
    </form>
</body>
</html>
