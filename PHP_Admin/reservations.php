<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "golden_restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT * FROM reservations ORDER BY date DESC, time DESC";
$result = $conn->query($sql);

$reservations = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

$conn->close();

echo json_encode($reservations);
?>
