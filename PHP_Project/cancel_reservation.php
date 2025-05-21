<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

global $conn;
session_start();
header('Content-Type: application/json');
include("db_connection.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['user']['name'])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

if (!isset($data['id'])) {
    echo json_encode(["status" => "error", "message" => "Reservation ID not provided"]);
    exit;
}

$reservationId = $data['id'];
$userName = $_SESSION['user']['name']; // بنستخدم الاسم من الجلسة

$sql = "DELETE FROM reservations WHERE id = ? AND name = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "SQL prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("is", $reservationId, $userName); // id = int, name = string
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Reservation not found or not yours"]);
}
?>
