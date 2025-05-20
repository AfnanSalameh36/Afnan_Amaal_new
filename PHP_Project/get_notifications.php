<?php
session_start();
header('Content-Type: application/json');

$notifications = isset($_SESSION['notifications']) ? $_SESSION['notifications'] : [];

echo json_encode([
    "count" => count($notifications),
    "notifications" => $notifications
]);
?>
