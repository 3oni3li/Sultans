<?php

// require_once 'mail.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';
//include("../../connection.php"); // Include your database connection

//connection to database
$host = "localhost";
$db = "sultans";
$connect = new PDO("mysql:host=$host; dbname=$db", "root", "");

$con = mysqli_connect("$host","root","","$db");

date_default_timezone_set("Asia/Kuala_Lumpur");


// Retrieve email from session
$email = $_SESSION["Email"];

// Fetch the phone number from the database
$query = "SELECT phone FROM users WHERE email = :email";
$statement = $connect->prepare($query);
$statement->bindParam(':email', $email);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);



$otp = rand(99999, 999999);
$phpmailer = new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Host = 'smtp.gmail.com';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 587;
$phpmailer->Username = 'sultanssparesort@gmail.com';
$phpmailer->Password = 'mfaenrelmrtztlxu';
//Content
$phpmailer->isHTML(true);                               // Set email format to HTML
$phpmailer->CharSet = "UTF-8";                                   // لدعم اللغة العربية
// /Recipients
$phpmailer->setFrom('sultanssparesort@gmail.com', 'SULTANS SPA RESORT ');
$phpmailer->addAddress($email);     //Add a recipient
$phpmailer->Subject = 'Verification Code';
$phpmailer->Body    =
    '<div style="margin:10 auto; text-align:center">
         <p>Email Verification for Your Account in sutans</p>
    
    <h4>Your Code:</h4>
    <h1>' . $otp . '</h1>
</div>
    ';
// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if ($phpmailer->send()) {
    // $_SESSION["name"] = $name;
    $_SESSION["OTP"] = $otp;

    $message = '<label class="alert alert-warning"><i class="ico">&#10004;</i> Your account has been Not Active. We has send in verify code in your email!</label>';

    // header("refresh:3;location:verify-otp.php");
    header('Refresh: 1; URL=' . $_SESSION['previous_page']);
}
// echo 'Message could not be sent.';
// $_SESSION["name"] = $name;
$_SESSION["OTP"] = $otp;

$message = '<label class="alert alert-danger"><i class="ico">&#10004;</i> Your account has been Not Active. Something error to send in verify code in your email! try agin to send code</label>';

// header("location:verify-otp.php");
header('Refresh: 1; URL=' . $_SESSION['previous_page']);
