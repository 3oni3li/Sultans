<?php
// require_once 'mail.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';
//  include("../../connection.php"); // Include your database connection


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

$phone = $result['phone'];

function generateOTP($phone) {
    // Ensure phone number is treated as a string
    $phone = (string)$phone;

    // Hash the phone number using SHA-256
    $hash = hash('sha256', $phone);

    // Extract digits from the hash
    $digits = preg_replace('/\D/', '', $hash);


    // new one
    // Shuffle the digits to randomize them
    $digitsArray = str_split($digits);
    shuffle($digitsArray);
    $shuffledDigits = implode('', $digitsArray);

    // Take the first 6 digits from the shuffled digits
    $otp = substr($shuffledDigits, 0, 6);


    // Take first 6 digits and perform modulus to ensure it's a 6-digit number
    // $otp = substr($digits, 0, 6);
    if (strlen($otp) < 6) {
        $otp = str_pad($otp, 6, '0', STR_PAD_LEFT); // Pad with zeros if less than 6 digits
    }

    return $otp;
}

$otp = generateOTP($phone);


// Set OTP to be the phone number for testing
//$otp = $phone;
// $otp = mt_rand(99999, 999999);
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
$phpmailer->setFrom('sultanssparesort@gmail.com', 'SULTANS SPA RESORT');
$phpmailer->addAddress($email);     //Add a recipient
$phpmailer->Subject = 'Verification Code';
$phpmailer->Body    =
    '<div style="margin:10 auto; text-align:center">
         <p>Email Verification for Your Account in Sultans</p>
    
    <h4>Your Code:</h4>
    <h1>' . $otp . '</h1>
</div>
    ';
// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if ($phpmailer->send()) {
    // $_SESSION["name"] = $name;
    $_SESSION["OTP"] = $otp;
    $_SESSION["Email"] = $email;
    $message = '<label class="alert alert-warning"><i class="ico">&#10004;</i> Your account has been Not Active. We has send in verify code in your email!</label>';

    header("refresh:3;url=verify-otp.php");
}
// echo 'Message could not be sent.';
// $_SESSION["name"] = $name;
$_SESSION["OTP"] = $otp;
$_SESSION["Email"] = $email;
$message = '<label class="alert alert-danger"><i class="ico">&#10004;</i> Your account has been Not Active. Something error to send in verify code in your email! try agin to send code</label>';

header("refresh:3;url=verify-otp.php");