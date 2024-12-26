<?php session_start(); ?>
<?php include('../config/dbcon.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Booking</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    
</head>
<body>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-border shadow">
                    <div class="card-header login-head-border bg-primary">
                        <h3 class="heading fw-bold text-center text-white mb-1">Admin Login</h3>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    </body>
</html>    
