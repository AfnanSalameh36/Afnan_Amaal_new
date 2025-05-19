<?php
global $conn;
include("../PHP_Project/db_connection.php");

$response = ["status" => "error", "message" => "Unexpected error occurred."];

if (!isset($_SESSION['user']['id'])) {
    $response["message"] = "You must be logged in.";
    echo json_encode($response);
    exit;
}

$userId = $_SESSION['user']['id'];
$current = trim(isset($_POST['current_password']) ? $_POST['current_password'] : '');
$new = trim(isset($_POST['new_password']) ? $_POST['new_password'] : '');
$confirm = trim(isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '');

if (empty($current) || empty($new) || empty($confirm)) {
    $response["message"] = "Please fill in all fields.";
    echo json_encode($response);
    exit;
}

if ($new !== $confirm) {
    $response["message"] = "New passwords do not match.";
    echo json_encode($response);
    exit;
}

// تحقق من كلمة المرور الحالية
$stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    $response["message"] = "User not found.";
    echo json_encode($response);
    exit;
}

$row = $result->fetch_assoc();
$hashedPassword = $row['password'];

if (!password_verify($current, $hashedPassword)) {
    $response["message"] = "Current password is incorrect.";
    echo json_encode($response);
    exit;
}

// تحديث كلمة المرور
$newHashed = password_hash($new, PASSWORD_DEFAULT);
$update = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
$update->bind_param("si", $newHashed, $userId);

if ($update->execute()) {
    $response["status"] = "success";
    $response["message"] = "Password changed successfully.";
} else {
    $response["message"] = "Failed to update password.";
}

echo json_encode($response);
exit;
?>
