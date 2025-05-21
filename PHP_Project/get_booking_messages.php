<?php
session_start();
header('Content-Type: application/json');
include("db_connection.php");
global $conn;

if (!isset($_SESSION['user']['email'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}

$user_email = $_SESSION['user']['email'];

$sql = "SELECT message FROM messages WHERE user_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row['message'];
}

echo json_encode([
    "status" => "success",
    "messages" => $messages
]);
?>
