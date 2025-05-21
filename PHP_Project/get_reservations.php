<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['user'])) {
    echo json_encode(["success" => false, "message" => "Please log in to see your reservations"]);
    exit;
}

$user_name = $_SESSION['user']['name'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "golden_restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// جلب الحجوزات حسب اسم المستخدم
$stmt = $conn->prepare("SELECT id, date, time, guests, special_request FROM reservations WHERE name = ? ORDER BY date DESC, time DESC");
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();

$reservations = [];
while ($row = $result->fetch_assoc()) {
    $reservations[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode(["success" => true, "reservations" => $reservations]);
?>
