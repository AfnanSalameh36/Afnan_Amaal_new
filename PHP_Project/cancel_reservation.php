<?php
global $conn;
session_start();
header('Content-Type: application/json');
include("db_connection.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['user']['id'])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

$userId = $_SESSION['user']['id'];
$reservationId = $data['id'];

$sql = "DELETE FROM reservations WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $reservationId, $userId);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Reservation not found or not yours"]);
}
?>
