<?php
session_start();
header('Content-Type: application/json');
include("db_connection.php");
global $conn;

if (!isset($_SESSION['user']['id'])) {
    echo json_encode(["status" => "error", "message" => "You must be logged in first."]);
    exit;
}

$userId = $_SESSION['user']['id'];
$name = trim(isset($_POST['name']) ? $_POST['name'] : '');
$email = trim(isset($_POST['email']) ? $_POST['email'] : '');

if (empty($name) || empty($email)) {
    echo json_encode(["status" => "error", "message" => "Please fill in all fields."]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email address."]);
    exit;
}

$sql = "SELECT id FROM users WHERE email = ? AND id != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $email, $userId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Email is already used by another user."]);
    exit;
}

$updateSql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
$updateStmt = $conn->prepare($updateSql);
$updateStmt->bind_param("ssi", $name, $email, $userId);

if ($updateStmt->execute()) {
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['email'] = $email;

    if (!isset($_SESSION['notifications'])) {
        $_SESSION['notifications'] = [];
    }

    $_SESSION['notifications'][] = "تم تعديل معلومات الحساب بنجاح.";


    echo json_encode(["status" => "success", "message" => "تم تعديل معلوماتك بنجاح!"]);
} else {
    echo json_encode(["status" => "error", "message" => "حدث خطأ أثناء التحديث."]);
}
exit;
?>
