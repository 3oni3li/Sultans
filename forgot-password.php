<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mt-3">
                    <div class="card-header bg-primary">
                        <h2 class="text-white text-center">Forgot Password</h2>
                    </div>
                    <div class="card-body">
                        <?php if (!isset($_GET['step'])) { ?>
                            <form action="code.php" method="POST">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                                </div>
                                <button type="submit" name="forgot_btn" class="btn btn-primary btn-block">Submit</button>
                            </form>
                        <?php } else { ?>
                            <form action="code.php?step=change-password&for_user=<?php echo $_GET['for_user']; ?>" method="POST">
                                <div class="form-group mb-3">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter your new password" required>
                                    <small>Password must contain at least 8 characters, letters, numbers, and symbols.</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm your new password" required>
                                </div>
                                <button type="submit" name="change_password_btn" class="btn btn-primary btn-block">Change Password</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>
