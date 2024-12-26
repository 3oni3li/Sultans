<?php
session_start();
include('../config/dbcon.php');

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['reg_btn'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // Validate inputs (you may add more validation as needed)
    // ...

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (fname, lname, phone, email, gender, password) VALUES ('$fname', '$lname', '$phone', '$email', '$gender', '$hashed_password')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Registration successful. You can now log in.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: register.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Include your CSS and other head content here -->
</head>
<body>
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-border shadow">
                    <div class="card-header login-head-border bg-primary">
                        <h3 class="heading fw-bold text-center text-white mb-1">Admin Register</h3>
                    </div>
                    <!-- <div class="card-body">
                        <div class="card-body">
                            <form action="code.php" method="POST">
                                <div class="form-group mb-3">
                                    <label class="">Email address</label>
                                    <input type="email" required class="form-control" name="email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="">Password</label>
                                    <input type="password" required class="form-control" name="password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" name="admin_login_btn" class="btn btn-primary btn-block">Login</button>
                                    <p class="mt-3 float-end">  Dont have an Account? <a href="register.php" class="rem-ul"> Sign up </a> </p>  
                                </div>
                            </form>
                        </div>
                    </div> -->
                    <!-- <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true"> -->
  <div class="card-body">
  <div class="card-body">
      <form action="code.php" method="POST">
        <div class="modal-body">
            <div class="form-group mb-3">
                <label for="">Name</label>
                <input type="text" class="form-control" name="admin_name">
            </div>
            <div class="form-group mb-3">
                <label for="">Email</label>
                <input type="text" class="form-control" name="admin_email">
            </div>
            <div class="form-group mb-3">
                <label for="">Phone number</label>
                <input type="text" class="form-control" name="admin_phone">
            </div>
            <div class="form-group mb-3">
                <label for="">Password</label>
                <input type="password" class="form-control" name="admin_password">
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" name="add_admin" class="btn btn-primary">Register Admin</button>
        </div>
        <a class="nav-link" href="logout.php">
                  <i class="fa fa-sign-out"></i>Log in
              </a>
      </form>
    </div>
  </div>
</div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>