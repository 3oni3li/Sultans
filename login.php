<?php
include('includes/header.php');
include('includes/navbar.php');
if (isset($_SESSION['login'])) {
    redirect("index.php", "You are already Logged In");
}
?>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-border shadow">
                    <div class="card-header login-head-border bg-primary">
                        <h3 class="heading fw-bold text-center text-white mb-1">Login</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <form action="code.php" method="POST">
                                <div class="form-group mb-3">
                                    <label>Email Address</label>
                                    <input type="email" required class="form-control" name="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input type="password" required class="form-control" name="password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" name="login_btn" class="btn btn-primary btn-block">Login</button>
                                    <p class="mt-3 float-end">
                                        Don't have an account? <a href="register.php" class="rem-ul"> Sign up </a>
                                    </p>  
                                </div>
                            </form>
                            <div class="text-center mt-4">
                                <a href="forgot-password.php" class="btn btn-link">Forgot Password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>
