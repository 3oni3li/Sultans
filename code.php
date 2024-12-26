<?php
session_start();
include('config/dbcon.php');

// User login code
if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($query_run);

    if ($row) {
        if (password_verify($password, $row['password'])) { // Verify hashed password
            if ($row['active'] == 1) {
                // Login success for active user
                $_SESSION['auth'] = [
                    'auth_id' => $row['id'],
                    'email' => $row['email'],
                    'fname' => $row['fname'],
                    'lname' => $row['lname'],
                ];
                $_SESSION['login'] = "true";
                $_SESSION['last_activity'] = time(); // Initialize session timeout tracking
                $_SESSION['status'] = "Logged In Successfully";
                header('location: index.php');
            } else {
                // Not active, send OTP
                $_SESSION['Email'] = $email;
                include_once('./mail/index.php');
                $_SESSION['status'] = "Account not activated. Please verify your email.";
                header('location: verify-otp.php');
            }
        } else {
            $_SESSION['status'] = "Invalid credentials";
            header('location: login.php');
        }
    } else {
        $_SESSION['status'] = "Invalid credentials";
        header('location: login.php');
    }
}

// User register code
if (isset($_POST['reg_btn'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $active = 0; // New user not active by default

    // Check for password strength
    $password_errors = [];
    if (strlen($password) < 8) {
        $password_errors[] = "Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $password_errors[] = "Password must contain at least one uppercase letter.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        $password_errors[] = "Password must contain at least one lowercase letter.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $password_errors[] = "Password must contain at least one number.";
    }
    if (!preg_match('/[\W]/', $password)) {
        $password_errors[] = "Password must contain at least one special character.";
    }

    if (!empty($password_errors)) {
        $_SESSION['status'] = implode(" ", $password_errors);
        header('location: register.php');
        exit();
    }

    $check_email = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        redirect("register.php", "Email already registered");
    } else {
        if ($password != $cpassword) {
            $_SESSION['status'] = "Passwords do not match";
            header('location: register.php');
        } else {
            // Hash the password before storing in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (fname, lname, phone, gender, email, password, active) 
                      VALUES ('$fname', '$lname', '$phone', '$gender', '$email', '$hashed_password', '$active')";
            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                $_SESSION['Email'] = $email;
                include_once('./mail/index.php');
                $_SESSION['status'] = "Registration successful. Please verify your email.";
                header('location: verify-otp.php');
            } else {
                $_SESSION['status'] = "Something went wrong. Try again.";
                header('location: register.php');
            }
        }
    }
}

// Handle Forgot Password Request
if (isset($_POST['forgot_btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($query_run);

    if ($row) {
        $user_id = $row['id'];
        $_SESSION['changePasswordUserId'] = $user_id;
        $_SESSION['Email'] = $email;

        // Send Forgot Password Email
        include('./mail/forgot_password.php');

        $_SESSION['status'] = "A password reset link has been sent to your email.";
        header('location: forgot-password.php');
    } else {
        $_SESSION['status'] = "Email not found. Please try again.";
        header('location: forgot-password.php');
    }
}





// Confirm room booking
if(isset($_POST['confirm_book_btn']))
{
    if($_POST['confirm_book_btn'] == "1")
    {
        $paymentmode = "Cash";
    }
    else if($_POST['confirm_book_btn'] == "2")
    {
        $paymentmode = "Online Payment";
    }
    $roomid = $_POST['bookroomid'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $userid = $_SESSION['auth']['auth_id'];
    if(isset($_SESSION['login']))
    {
        $userid = $_SESSION['auth']['auth_id'];
    }
    else
    {
        redirect("login.php","Login to continue your booking");
        exit(0);
    }

    $chk_aval ="SELECT room_id FROM bookings WHERE room_id='$roomid'AND( 
    (checkin <= '$checkin' AND checkout >='$checkout') OR 
    (checkin >= '$checkin' AND checkin <='$checkout') OR 
    (checkin <= '$checkin' AND checkout >='$checkin')  )";


    $chk_aval_run = mysqli_query($con, $chk_aval);

    $roomqty_query = "SELECT * FROM rooms WHERE id='$roomid' LIMIT 1";
    $roomqty_query_run = mysqli_query($con, $roomqty_query);
    $omrow = mysqli_fetch_array($roomqty_query_run);
    $roomqty = $omrow['room_qty'];
    
    if(mysqli_num_rows($chk_aval_run) < $roomqty)
    {
        $conf_book_query = "INSERT INTO bookings (room_id, user_id, checkin, checkout, Status)
        VALUES ('$roomid', '$userid','$checkin','$checkout', 'Pending')";

        $conf_book_query_run = mysqli_query($con, $conf_book_query);

        if($conf_book_query_run)
        {
            redirect("bookings.php","Your room has been successfully booked");
        }
        else{
            redirect("index.php","Something went Wrong!");
        }       
    }
    else
    {
        redirect("index.php","Something went Wrong!");
    }
}

// Update User Profile
if(isset($_POST['update_profile_btn']))
{
    $uid = $_SESSION['auth']['auth_id']; 
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $update_query = "UPDATE users SET fname='$fname', lname='$lname', phone='$phone', gender='$gender' WHERE id='$uid' ";
    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        redirect("profile.php","Profile Updated Successfully");
    } 
    else{
        redirect("profile.php","Something went Wrong");
    }
}

?>

