<?php
global $conn;
include("db_connection.php");
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$code = $data['code'];
$discount = $data['discount'];
$email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : null;

if ($email && $code && $discount) {
    // 🔐 تحقق إذا المستخدم لعب اليوم
    $today = date('Y-m-d');
    $stmt = $conn->prepare("SELECT id FROM discount_coupons WHERE user_email = ? AND DATE(created_at) = ?");
    $stmt->bind_param("ss", $email, $today);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "You have already played today."]);
        exit;
    }

    // 💾 احفظ الكوبون
    $stmt = $conn->prepare("INSERT INTO discount_coupons (code, discount_percent, user_email) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $code, $discount, $email);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "DB Error"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Missing data"]);
}
?>
