<?php
session_start();
header('Content-Type: application/json');
include("db_connection.php");
global $conn;

if (!isset($_SESSION['user']['email'])) {
    echo json_encode([
        "status" => "error",
        "message" => "You must be logged in to receive a discount coupon."
    ]);
    exit;
}

$user_email = $_SESSION['user']['email'];
$data = json_decode(file_get_contents("php://input"), true);
$code = isset($data['code']) ? $data['code'] : '';
$discount = isset($data['discount']) ? intval($data['discount']) : 0;

if (empty($code) || $discount <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
    exit;
}

$today = date('Y-m-d');
$check_sql = "SELECT * FROM discount_coupons WHERE user_email = ? AND DATE(created_at) = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param("ss", $user_email, $today);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "You have already played today."
    ]);
    exit;
}

$insert_sql = "INSERT INTO discount_coupons (code, discount_percent, user_email, created_at) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($insert_sql);

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("sis", $code, $discount, $user_email);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Execute failed: " . $stmt->error]);
}
?>
