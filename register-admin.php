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
    <!-- Include your CSS and other head content here -->
</head>
<body>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card login-border shadow mt-3">
                    <div class="card-header login-head-border bg-primary">
                        <h2 class="heading fw-bold mb-1 text-center text-white">Register Now</h2>
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="POST">
                            <!-- Your form fields here -->
                            <section class="section">
    
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">First Name</label>
                                        <input type="text" class="form-control alphaonly" required name="fname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">Last Name</label>
                                        <input type="text" class="form-control alphaonly"  required name="lname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">Phone</label>
                                        <input type="number" onblur="PhoneNumvalidate()" id="mobilenumber" class="form-control" required name="phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">Email address</label>
                                        <input type="email" required class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="">Choose Gender</label>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="Male" id="male">
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="Female" id="female">
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">Password</label>
                                        <input type="password" required class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">Confirm Password</label>
                                        <input type="password" required class="form-control" name="cpassword">
                                    </div>
                                </div>
                               
                            </div>
                            
                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                            <!-- ... -->

                            <div class="text-center">
                                <button type="submit" name="reg_btn" class="btn btn-primary px-5">Register</button>
                                <div class="mt-3">
                                    Already have an account? <a href="login.php" class=" rem-ul">Log in Now</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include your footer content here -->

</body>
</html>





