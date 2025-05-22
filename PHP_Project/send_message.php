<?php
global $conn;
session_start();
include("db_connection.php");

header('Content-Type: text/plain; charset=utf-8');

if (!isset($_SESSION['user']['id'])) {
    http_response_code(403);
    echo "You must be logged in to send a message.";
    exit;
}

$user_id = $_SESSION['user']['id'];
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phoneNum']);
$message = trim($_POST['msg']);
$created_at = date("Y-m-d H:i:s");

if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    http_response_code(400);
    echo "All fields are required.";
    exit;
}

$sql = "INSERT INTO contact_messages (user_id, name, email, phone, message, created_at)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $user_id, $name, $email, $phone, $message, $created_at);

if ($stmt->execute()) {
    echo "Message sent successfully!";
} else {
    http_response_code(500);
    echo "Failed to send message: " . $stmt->error;
}
?>
