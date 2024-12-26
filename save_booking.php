<?php
session_start();

// Correctly include dbcon.php
include(__DIR__ . '/config/dbcon.php'); // Use __DIR__ to ensure an absolute path

header('Content-Type: application/json');

// Debug the session
error_log("Session Data: " . print_r($_SESSION, true));

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    error_log("Session user_id not set.");
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

// Get and validate JSON data
$data = json_decode(file_get_contents('php://input'), true);
error_log("Incoming Data: " . print_r($data, true));

if (!empty($data['room_id']) && !empty($data['checkin']) && !empty($data['checkout']) && !empty($data['total_price']) && !empty($data['order_id'])) {
    $stmt = mysqli_prepare($con, "INSERT INTO bookings (room_id, user_id, checkin, checkout, price, payment_mode, booking_status) VALUES (?, ?, ?, ?, ?, 'PayPal', 'Approved')");
    if (!$stmt) {
        error_log("MySQL Prepare Error: " . mysqli_error($con));
        echo json_encode(['success' => false, 'message' => 'Failed to prepare SQL statement.']);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "iissd", $data['room_id'], $_SESSION['user_id'], $data['checkin'], $data['checkout'], $data['total_price']);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Booking saved successfully.']);
    } else {
        error_log("MySQL Execution Error: " . mysqli_error($con));
        echo json_encode(['success' => false, 'message' => 'Failed to execute SQL statement.', 'error' => mysqli_error($con)]);
    }
    mysqli_stmt_close($stmt);
} else {
    error_log("Invalid data provided: " . print_r($data, true));
    echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
}

mysqli_close($con);
?>



